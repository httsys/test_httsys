<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\HeaderFooterSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PickupLocation;
use App\Models\ShopPaymentMethod;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected function frontData()
    {
        $currentLang = session()->has('lang')
            ? Language::where('code', session()->get('lang'))->first()
            : Language::where('is_default', 1)->first();

        $lang_id = $currentLang->id;

        return [
            'currentLang' => $currentLang,
            'langs' => Language::all(),
            'headerfooter' => HeaderFooterSetting::find($lang_id),
            'menus' => Menu::where('language_id', $lang_id)->get(),
        ];
    }

    /**
     * Step 1: shipping address (or pickup location) + coupon code.
     * Requires an item in the cart and a logged-in user.
     */
    public function address(CartService $cart)
    {
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('cart_error', 'Your cart is empty.');
        }

        $addresses = Auth::user()->addresses;
        $pickupLocations = PickupLocation::where('is_active', 1)->orderBy('sort_order')->get();

        return view('checkout.address', array_merge($this->frontData(), [
            'addresses' => $addresses,
            'pickupLocations' => $pickupLocations,
            'items' => $cart->items(),
            'totals' => $this->totals($cart),
            'appliedCoupon' => $this->appliedCoupon(),
        ]));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address_line' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:30',
        ]);

        $isFirst = Auth::user()->addresses()->count() === 0;

        Address::create($request->only([
            'name', 'phone', 'email', 'country', 'state', 'city', 'address_line', 'postal_code',
        ]) + [
            'user_id' => Auth::id(),
            'is_default' => $isFirst,
        ]);

        return back()->with('cart_success', 'Address saved.');
    }

    /**
     * Apply / remove a coupon code — stored in the session so it survives
     * across the address → payment steps without being tied to an order
     * yet (the order only exists once placeOrder() runs).
     */
    public function applyCoupon(Request $request, CartService $cart)
    {
        $request->validate(['code' => 'required|string|max:50']);

        $coupon = Coupon::whereRaw('UPPER(code) = ?', [strtoupper($request->code)])->first();

        if (! $coupon || ! $coupon->isValidFor($cart->subtotal())) {
            return back()->with('cart_error', 'This coupon code is invalid or not applicable to your order.');
        }

        session(['applied_coupon' => $coupon->code]);

        return back()->with('cart_success', 'Coupon "' . $coupon->code . '" applied.');
    }

    public function removeCoupon()
    {
        session()->forget('applied_coupon');

        return back()->with('cart_success', 'Coupon removed.');
    }

    protected function appliedCoupon()
    {
        $code = session('applied_coupon');

        return $code ? Coupon::whereRaw('UPPER(code) = ?', [strtoupper($code)])->first() : null;
    }

    /**
     * The original static "coming soon" placeholder names shown on the
     * payment step before the shop-payment work started. Kept exactly as
     * they were — any name here that now has a matching active +
     * shop-enabled Payment Method is swapped for the real, selectable
     * card instead of staying locked.
     */
    protected $comingSoonPlaceholders = ['PayPal', 'Stripe', 'SSLCommerz', 'bKash', 'Nagad'];

    /**
     * Step 2: payment method. Cash On Delivery is always available. Any
     * Shop Payment Method the admin created and marked Active — from its
     * own admin screen under Shop > Payment Methods — is offered
     * alongside it as a real, selectable option. Everything else keeps
     * showing as a locked "coming soon" placeholder.
     */
    public function payment(Request $request, CartService $cart)
    {
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('cart_error', 'Your cart is empty.');
        }

        $orderType = $request->query('type', 'delivery');
        $address = null;
        $pickupLocation = null;

        if ($orderType === 'pickup') {
            $pickupLocation = PickupLocation::where('is_active', 1)->findOrFail($request->query('id'));
        } else {
            $orderType = 'delivery';
            $address = Address::where('user_id', Auth::id())->findOrFail($request->query('id'));
        }

        $enabledMethods = ShopPaymentMethod::where('is_active', 1)->orderBy('sort_order')->get();

        $enabledNames = $enabledMethods->pluck('name')->map(function ($name) {
            return strtolower(trim($name));
        })->all();

        $lockedPlaceholders = array_values(array_filter($this->comingSoonPlaceholders, function ($name) use ($enabledNames) {
            return ! in_array(strtolower($name), $enabledNames);
        }));

        return view('checkout.payment', array_merge($this->frontData(), [
            'orderType' => $orderType,
            'address' => $address,
            'pickupLocation' => $pickupLocation,
            'items' => $cart->items(),
            'totals' => $this->totals($cart),
            'enabledMethods' => $enabledMethods,
            'lockedPlaceholders' => $lockedPlaceholders,
        ]));
    }

    /**
     * Place the order and clear the cart.
     *
     * - Cash On Delivery: order is created "pending / unpaid" and goes
     *   straight to the confirmation page.
     * - A manual payment method the admin enabled for Shop: order is
     *   created "pending / unpaid" too, but the buyer is sent on to the
     *   manual-payment page (read instructions, pay outside the site,
     *   paste back a reference). An admin verifies it from the Orders
     *   panel and marks it paid.
     * - Delivery vs Pick Up decides where the ship_* snapshot comes from
     *   (a saved Address, or a PickupLocation).
     */
    public function placeOrder(Request $request, CartService $cart)
    {
        $request->validate([
            'order_type' => 'required|in:delivery,pickup',
            'address_id' => 'required_if:order_type,delivery|nullable|exists:addresses,id',
            'pickup_location_id' => 'required_if:order_type,pickup|nullable|exists:pickup_locations,id',
            'payment_option' => 'required|string',
        ]);

        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('cart_error', 'Your cart is empty.');
        }

        $paymentMethod = null;
        if ($request->payment_option !== 'cod') {
            $paymentMethodId = (int) str_replace('pm_', '', $request->payment_option);
            $paymentMethod = ShopPaymentMethod::where('is_active', 1)->findOrFail($paymentMethodId);
        }

        $totals = $this->totals($cart);
        $items = $cart->items();
        $coupon = $this->appliedCoupon();

        $shipData = $request->order_type === 'pickup'
            ? $this->shipDataFromPickup(PickupLocation::findOrFail($request->pickup_location_id))
            : $this->shipDataFromAddress(Address::where('user_id', Auth::id())->findOrFail($request->address_id));

        $order = DB::transaction(function () use ($request, $shipData, $totals, $items, $coupon, $paymentMethod) {
            $order = Order::create(array_merge($shipData, [
                'order_number' => $this->generateOrderNumber(),
                'user_id' => Auth::id(),
                'order_type' => $request->order_type,
                'status' => 'pending',
                'payment_method' => $paymentMethod ? $paymentMethod->slug : 'cod',
                'payment_method_id' => $paymentMethod ? $paymentMethod->id : null,
                'payment_status' => 'unpaid',
                'subtotal' => $totals['subtotal'],
                'tax' => $totals['tax'],
                'shipping_charge' => $totals['shipping_charge'],
                'discount' => $totals['discount'],
                'coupon_code' => $coupon ? $coupon->code : null,
                'total' => $totals['total'],
                'currency' => config('shop.currency_symbol'),
            ]));

            foreach ($items as $line) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $line->product->id,
                    'product_title' => $line->product->title,
                    'product_image' => optional($line->product->photo)->file,
                    'variant_summary' => $line->variant_summary,
                    'unit_price' => $line->unit_price,
                    'quantity' => $line->quantity,
                    'line_total' => $line->line_total,
                ]);
            }

            if ($coupon) {
                $coupon->increment('used_count');
            }

            return $order;
        });

        $cart->clear();
        session()->forget('applied_coupon');

        \App\Support\OrderMailer::send($order, \App\Mail\OrderPlacedMail::class);

        // Belt-and-suspenders: on this host, Auth::id() has occasionally
        // not been reliably readable on the very next request right after
        // an order is placed (same symptom as the earlier 403 issue). This
        // session flag lets the immediately-following manual/thanks pages
        // recognize "the order this exact browser just placed" even if
        // that happens again, without weakening the check for anyone else.
        session(['recent_order_id' => $order->id]);

        if ($paymentMethod) {
            return redirect()->route('checkout.manual', $order->id);
        }

        // One-shot flag (auto-expires after this exact next page load, via
        // session()->pull() in confirmation() below) so the WhatsApp
        // button auto-opens only on the page load immediately after
        // placing the order — never again on a later revisit via Order
        // History, and never for someone else's order.
        session()->flash('whatsapp_auto_open_order_id', $order->id);

        return redirect()->route('checkout.confirmation', $order->id);
    }

    protected function shipDataFromAddress(Address $address)
    {
        return [
            'address_id' => $address->id,
            'pickup_location_id' => null,
            'ship_name' => $address->name,
            'ship_phone' => $address->phone,
            'ship_email' => $address->email,
            'ship_country' => $address->country,
            'ship_state' => $address->state,
            'ship_city' => $address->city,
            'ship_address_line' => $address->address_line,
            'ship_postal_code' => $address->postal_code,
        ];
    }

    protected function shipDataFromPickup(PickupLocation $location)
    {
        return [
            'address_id' => null,
            'pickup_location_id' => $location->id,
            'ship_name' => Auth::user()->name,
            'ship_phone' => Auth::user()->phone,
            'ship_email' => Auth::user()->email,
            'ship_country' => $location->country,
            'ship_state' => $location->state,
            'ship_city' => $location->city,
            'ship_address_line' => $location->name . ' — ' . $location->address_line,
            'ship_postal_code' => $location->postal_code,
        ];
    }

    protected function ownsOrder(Order $order)
    {
        // Compare as integers — comparing an Eloquent attribute straight
        // against Auth::id() with === can false-negative if the DB driver
        // hands back the id as a numeric string for one side and not the
        // other, which incorrectly bounces a user off their own order.
        if (Auth::check() && (int) $order->user_id === (int) Auth::id()) {
            return true;
        }

        return session('recent_order_id') === $order->id;
    }

    /**
     * Manual payment instructions page for a shop order — same idea as
     * DonationController@manual: show the account number/instructions
     * for the payment method the buyer picked, and let them paste back
     * their own transaction reference.
     */
    public function manual(Order $order)
    {
        if (! $this->ownsOrder($order)) {
            return redirect()->route('cart.index')->with('cart_error', "That order isn't associated with the account you're currently logged into.");
        }

        if (! $order->payment_method_id) {
            return redirect()->route('checkout.confirmation', $order->id);
        }

        return view('checkout.manual', array_merge($this->frontData(), [
            'order' => $order->load(['items', 'paymentMethod']),
        ]));
    }

    public function manualSubmit(Request $request, Order $order)
    {
        if (! $this->ownsOrder($order)) {
            return redirect()->route('cart.index')->with('cart_error', "That order isn't associated with the account you're currently logged into.");
        }

        if (! $order->payment_method_id) {
            return redirect()->route('checkout.confirmation', $order->id);
        }

        $request->validate([
            'manual_reference' => 'required|string|max:191',
        ]);

        // Stays 'unpaid' — an admin verifies the reference against their
        // bank/wallet statement and marks it paid from the admin panel.
        $order->update(['manual_reference' => $request->manual_reference]);

        return redirect()->route('checkout.thanks', $order->id);
    }

    /**
     * Simple "Order Submitted" confirmation — mirrors
     * DonationController@thanks. Shown right after a manual payment
     * reference is submitted (and can be reused for COD if wanted later).
     */
    public function thanks(Order $order)
    {
        if (! $this->ownsOrder($order)) {
            return redirect()->route('cart.index')->with('cart_error', "That order isn't associated with the account you're currently logged into.");
        }

        return view('checkout.thanks', array_merge($this->frontData(), [
            'order' => $order->load(['items', 'paymentMethod']),
            'setting' => \App\Models\Setting::first(),
        ]));
    }

    /**
     * "View My Orders" now lives inside the unified account dashboard
     * (profile.show) as its own tab, so this just redirects there.
     */
    public function myOrders()
    {
        return redirect()->route('profile.show', ['tab' => 'orders']);
    }

    public function confirmation(Order $order)
    {
        if (! $this->ownsOrder($order)) {
            return redirect()->route('cart.index')->with('cart_error', "That order isn't associated with the account you're currently logged into.");
        }

        // pull() reads AND removes in one step, so this is true on exactly
        // the one page load right after placing the order, never again.
        $justPlaced = (int) session()->pull('whatsapp_auto_open_order_id') === (int) $order->id;

        return view('checkout.confirmation', array_merge($this->frontData(), [
            'order' => $order->load(['items.product.digitalFile', 'paymentMethod']),
            'justPlaced' => $justPlaced,
            // frontData() doesn't include this — the WhatsApp order
            // button needs settings.whatsapp_order_number, which was
            // silently never reaching this view before (Blade's ??
            // quietly treated the wholly-undefined $setting as empty,
            // so the button just never rendered — not a display glitch,
            // a genuinely missing variable).
            'setting' => \App\Models\Setting::first(),
        ]));
    }

    /**
     * Print-styled receipt page the customer can save as a PDF (Ctrl+P →
     * "Save as PDF") — same zero-dependency approach as the admin POS
     * receipts, since this app has no PDF library installed.
     */
    public function downloadReceipt(Order $order)
    {
        if (! $this->ownsOrder($order)) {
            abort(403);
        }

        return view('checkout.receipt-print', [
            'order' => $order->load('items'),
            'setting' => \App\Models\Setting::first(),
        ]);
    }

    /**
     * Customer cancels their own order — only while it's still 'pending'
     * (nothing has been confirmed/shipped/paid for yet). A POS sale is
     * already a completed in-person transaction and isn't cancellable
     * this way.
     */
    public function cancelOrder(Order $order)
    {
        if (! $this->ownsOrder($order)) {
            abort(403);
        }

        if ($order->order_type === 'pos' || $order->status !== 'pending') {
            return back()->with('cart_error', 'This order can no longer be cancelled — please contact us if you need help with it.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('checkout.confirmation', $order->id)
            ->with('profile_success', 'Order #' . $order->order_number . ' has been cancelled.');
    }

    /**
     * Customer requests a return on a delivered order. This only records
     * the request as 'pending' for an admin/author to review (see
     * AdminOrderReturnController) — accepting a request here is a
     * signal to the store, not an automatic refund or stock change;
     * the store still handles the actual pickup/refund itself.
     */
    public function requestReturn(Request $request, Order $order)
    {
        if (! $this->ownsOrder($order)) {
            abort(403);
        }

        if ($order->status !== 'delivered') {
            return back()->with('cart_error', 'Only delivered orders are eligible for a return request.');
        }

        $request->validate([
            'reason' => 'required|string|max:191',
            'items' => 'required|array|min:1',
            'items.*.order_item_id' => 'required|exists:shop_order_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $orderItems = $order->items->keyBy('id');

        foreach ($request->items as $row) {
            $item = $orderItems->get($row['order_item_id']);
            abort_if(! $item, 422, 'That item does not belong to this order.');

            $alreadyRequested = \App\Models\OrderReturnItem::where('order_item_id', $item->id)
                ->whereHas('orderReturn', function ($q) {
                    $q->where('status', '!=', 'rejected');
                })
                ->sum('quantity');

            abort_if($alreadyRequested + $row['quantity'] > $item->quantity, 422, 'You can\'t request a return for more than you ordered of "' . $item->product_title . '".');
        }

        $return = DB::transaction(function () use ($request, $order) {
            $return = \App\Models\OrderReturn::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'reason' => $request->reason,
                'status' => 'pending',
            ]);

            foreach ($request->items as $row) {
                \App\Models\OrderReturnItem::create([
                    'return_id' => $return->id,
                    'order_item_id' => $row['order_item_id'],
                    'quantity' => $row['quantity'],
                ]);
            }

            return $return;
        });

        return redirect()->route('profile.show', ['tab' => 'returns'])
            ->with('profile_success', 'Your return request has been submitted and is awaiting review.');
    }

    protected function totals(CartService $cart)
    {
        $subtotal = $cart->subtotal();
        $tax = round($subtotal * config('shop.tax_rate'), 2);
        $shipping = $subtotal > 0 ? config('shop.shipping_charge') : 0;

        $discount = 0;
        $coupon = $this->appliedCoupon();
        if ($coupon && $coupon->isValidFor($subtotal)) {
            $discount = $coupon->discountFor($subtotal);
        }

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping_charge' => $shipping,
            'discount' => $discount,
            'total' => max(0, $subtotal + $tax + $shipping - $discount),
        ];
    }

    protected function generateOrderNumber()
    {
        do {
            $number = (string) random_int(1000000, 9999999);
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}
