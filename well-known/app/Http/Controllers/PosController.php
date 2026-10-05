<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PosRefund;
use App\Models\PosRefundItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariantOption;
use App\Models\Setting;
use App\Models\User;
use App\Services\PosCartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * The admin POS (Point of Sale) screen — a single-page "ring up a sale"
 * tool for in-store staff. Routes for this controller are registered
 * inside the existing `Route::middleware(['author'])` group in
 * routes/web.php, so — exactly like Products/Orders — only users whose
 * role is "author" or "administrator" (see User::isAuthor()) can reach
 * any of this.
 *
 * The whole screen works without a page reload: index() renders the
 * shell once, every other action here is called over fetch()/AJAX and
 * returns JSON (see cartPayload()), which admin-pos.js uses to re-render
 * the cart panel in place.
 */
class PosController extends Controller
{
    /**
     * Main POS screen: product grid (first page), category/brand filter
     * options, the customer list, and whatever is already sitting in this
     * cashier's in-progress sale (if they refreshed the page mid-sale).
     */
    public function index(Request $request, PosCartService $cart)
    {
        $categories = ProductCategory::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $customers = $this->customerList();

        return view('admin.pos.index', [
            'categories' => $categories,
            'brands' => $brands,
            'customers' => $customers,
            'canRefund' => Auth::user()->hasPermission('pos.refunds.process'),
            'products' => $this->productQuery($request)->paginate(18)->withQueryString()->withPath(route('pos.products')),
            'cart' => $this->cartPayload($cart),
        ]);
    }

    /**
     * AJAX product grid refresh — same filters as index(), called
     * whenever the search box / category / brand / pagination changes so
     * the cart panel next to it never has to reload.
     */
    public function products(Request $request)
    {
        $products = $this->productQuery($request)->paginate(18)->withQueryString()->withPath(route('pos.products'));

        return response()->json([
            'html' => view('admin.pos._product-grid', compact('products'))->render(),
            'has_pages' => $products->hasPages(),
        ]);
    }

    protected function productQuery(Request $request)
    {
        return Product::with(['photo', 'variantGroups.options', 'reviews'])
            ->where('is_active', 1)
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%' . $request->search . '%';
                $q->where(function ($q2) use ($term) {
                    $q2->where('title', 'like', $term)->orWhere('sku', 'like', $term);
                });
            })
            ->when($request->filled('category_id'), function ($q) use ($request) {
                $q->where('product_category_id', $request->category_id);
            })
            ->when($request->filled('brand_id'), function ($q) use ($request) {
                $q->where('brand_id', $request->brand_id);
            })
            ->orderBy('title');
    }

    /**
     * Barcode box: exact match on products.sku first, then (so a barcode
     * scanner that happens to encode a numeric id still works, and so
     * staff can just type a product's id if it has no barcode yet) an
     * exact match on products.id.
     */
    public function barcode(Request $request, PosCartService $cart)
    {
        $request->validate(['code' => 'required|string|max:191']);
        $code = trim($request->code);

        $product = Product::where('sku', $code)->first();

        if (! $product && ctype_digit($code)) {
            $product = Product::find((int) $code);
        }

        if (! $product || ! $product->is_active) {
            return response()->json(['found' => false, 'message' => 'No product matches that barcode.'], 404);
        }

        $groups = $product->variantGroups;

        if ($groups->isNotEmpty()) {
            return response()->json([
                'found' => true,
                'needs_variation' => true,
                'product' => $this->productPayload($product),
            ]);
        }

        $cart->add($product->id, [], 1);

        return response()->json(array_merge(['found' => true, 'needs_variation' => false], $this->cartPayload($cart)));
    }

    /**
     * Clicking a product card. If it has variant groups (color/size/etc.)
     * we don't add it yet — we hand the product + its groups back so the
     * front-end can open the "Product Variation" picker, matching the
     * reference design. A plain product with no variants adds straight
     * away.
     */
    public function showVariation(Request $request, Product $product)
    {
        return response()->json(['product' => $this->productPayload($product)]);
    }

    protected function productPayload(Product $product)
    {
        $product->load('variantGroups.options', 'photo');

        return [
            'id' => $product->id,
            'title' => $product->title,
            'sku' => $product->sku,
            'product_category_id' => $product->product_category_id,
            'brand_id' => $product->brand_id,
            'is_active' => (bool) $product->is_active,
            'is_flash_sale' => (bool) $product->is_flash_sale,
            'image' => $this->productImage($product),
            'gallery' => $product->gallery,
            'price' => $product->price,
            'sale_price' => $product->sale_price,
            'effective_price' => $product->effective_price,
            'tax_rate' => $product->effective_tax_rate,
            'stock' => $product->stock,
            'average_rating' => $product->average_rating,
            'reviews_count' => $product->reviews_count,
            'variant_groups' => $product->variantGroups->map(function ($group) {
                return [
                    'id' => $group->id,
                    'name' => $group->name,
                    'options' => $group->options->map(function ($option) {
                        return [
                            'id' => $option->id,
                            'value' => $option->value,
                            'color_code' => $option->color_code,
                            'price_modifier' => $option->price_modifier,
                        ];
                    }),
                ];
            }),
        ];
    }

    protected function productImage(Product $product)
    {
        return $product->photo ? '/public/images/media/' . $product->photo->file : '/public/img/200x200.png';
    }

    public function addItem(Request $request, PosCartService $cart)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'option_ids' => 'nullable|array',
            'option_ids.*' => 'exists:product_variant_options,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $optionIds = array_values($request->input('option_ids', []));

        if ($optionIds) {
            $validCount = ProductVariantOption::whereIn('id', $optionIds)
                ->whereHas('group', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })
                ->count();

            if ($validCount !== count($optionIds)) {
                return response()->json(['message' => 'Invalid product options selected.'], 422);
            }
        }

        $cart->add($product->id, $optionIds, (int) $request->input('quantity', 1));

        return response()->json($this->cartPayload($cart));
    }

    public function updateQuantity(Request $request, PosCartService $cart)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart->updateQuantity($request->key, (int) $request->quantity);

        return response()->json($this->cartPayload($cart));
    }

    public function removeItem(Request $request, PosCartService $cart)
    {
        $request->validate(['key' => 'required|string']);
        $cart->remove($request->key);

        return response()->json($this->cartPayload($cart));
    }

    /**
     * "Cancel" button — wipes the whole sale-in-progress (items, chosen
     * customer, applied discount) and starts fresh.
     */
    public function cancel(PosCartService $cart)
    {
        $cart->clear();

        return response()->json($this->cartPayload($cart));
    }

    public function setCustomer(Request $request, PosCartService $cart)
    {
        $request->validate(['customer_id' => 'nullable|exists:users,id']);
        $cart->setCustomer($request->customer_id ?: null);

        return response()->json($this->cartPayload($cart));
    }

    /**
     * "Customers" quick-add modal — creates a real `users` row (role:
     * subscriber, same as any storefront customer) and immediately
     * selects them as the customer for the sale in progress.
     */
    public function storeCustomer(Request $request, PosCartService $cart)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'country_code' => 'required|string|max:5',
            'phone' => 'required|string|max:30',
            'is_active' => 'required|in:0,1',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $localNumber = ltrim(preg_replace('/\D/', '', $request->phone), '0');

        $customer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->country_code . $localNumber,
            'is_active' => (bool) $request->is_active,
            'role_id' => 3, // subscriber
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'email_verification_override' => true,
        ]);

        $cart->setCustomer($customer->id);

        return response()->json(array_merge([
            'customer_created' => ['id' => $customer->id, 'name' => $customer->name],
        ], $this->cartPayload($cart)));
    }

    public function applyDiscount(Request $request, PosCartService $cart)
    {
        $request->validate([
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
        ]);

        $cart->setDiscount($request->type, $request->value);

        return response()->json($this->cartPayload($cart));
    }

    public function removeDiscount(PosCartService $cart)
    {
        $cart->clearDiscount();

        return response()->json($this->cartPayload($cart));
    }

    /**
     * "Order" → Order Payment modal → "Confirm & Print Receipt". Creates
     * the real shop_orders + shop_order_items rows (order_type=pos,
     * status=delivered, payment_status=paid — a POS sale is, by
     * definition, already complete and paid for in person), decrements
     * stock, and clears the cart.
     */
    public function checkout(Request $request, PosCartService $cart)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,card,mfs,other',
            'amount_tendered' => 'nullable|numeric|min:0',
        ]);

        if ($cart->isEmpty()) {
            return response()->json(['message' => 'The cart is empty.'], 422);
        }

        $totals = $cart->totals();
        $items = $cart->items();

        $customer = $cart->customer() ?: User::walkingCustomer();

        if (! $customer) {
            return response()->json([
                'message' => 'The "Walking Customer" account is missing — please run the POS database patch (see the setup instructions) before using the POS.',
            ], 500);
        }

        $amountTendered = $request->filled('amount_tendered') ? (float) $request->amount_tendered : $totals['total'];

        $order = $this->createPosOrder($items, $totals, $customer, $request->payment_method, $amountTendered);

        $cart->clear();

        return response()->json([
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ]);
    }

    /**
     * Creates the real shop_orders + shop_order_items rows and decrements
     * stock — shared by checkout() (sale rung up live, online) and
     * sync() (sale rung up earlier while offline, uploaded now). Always
     * runs in a DB transaction so a sale is never left half-written.
     */
    protected function createPosOrder($items, array $totals, User $customer, string $paymentMethod, float $amountTendered, ?string $offlineId = null)
    {
        $changeDue = max(0, round($amountTendered - $totals['total'], 2));
        $setting = Setting::first();

        return DB::transaction(function () use ($items, $totals, $customer, $paymentMethod, $amountTendered, $changeDue, $setting, $offlineId) {
            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'offline_id' => $offlineId,
                'user_id' => $customer->id,
                'served_by' => Auth::id(),
                'address_id' => null,
                'pickup_location_id' => null,
                'ship_name' => $customer->name,
                'ship_phone' => $customer->phone ?: '-',
                'ship_email' => $customer->email,
                'ship_country' => $setting->country ?? 'Bangladesh',
                'ship_state' => $setting->country ?? '-',
                'ship_city' => $setting->address ?? '-',
                'ship_address_line' => $setting->address ?? 'In-store purchase',
                'ship_postal_code' => null,
                'order_type' => 'pos',
                'status' => 'delivered',
                'payment_method' => $paymentMethod,
                'payment_method_id' => null,
                'payment_status' => 'paid',
                'subtotal' => $totals['subtotal'],
                'tax' => $totals['tax'],
                'shipping_charge' => 0,
                'discount' => $totals['discount'],
                'coupon_code' => null,
                'total' => $totals['total'],
                'currency' => config('shop.currency_symbol'),
                'amount_tendered' => $amountTendered,
                'change_due' => $changeDue,
            ]);

            foreach ($items as $line) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $line->product->id,
                    'product_title' => $line->product->title,
                    'product_image' => optional($line->product->photo)->file,
                    'variant_summary' => $line->variant_summary,
                    'unit_price' => $line->unit_price,
                    'tax_rate' => $line->tax_rate,
                    'line_tax' => $line->line_tax,
                    'quantity' => $line->quantity,
                    'line_total' => $line->line_total,
                ]);

                // Live in-store sale — decrement stock immediately.
                // (The normal online storefront checkout does not do
                // this; left untouched to avoid changing existing
                // behaviour there.)
                if ($line->product->stock !== null) {
                    Product::where('id', $line->product->id)
                        ->where('stock', '>=', $line->quantity)
                        ->decrement('stock', $line->quantity);
                }
            }

            return $order;
        });
    }

    /**
     * Full product/category/brand/customer snapshot for the POS's
     * offline cache (IndexedDB). Called on page load and by the
     * "Refresh data now" button, and re-called automatically by the
     * front-end every few minutes while online so the offline copy
     * doesn't go too stale. Kept deliberately light — no descriptions,
     * reviews, etc. — since it may run right before the connection
     * drops.
     */
    public function catalog()
    {
        $products = Product::with(['photo', 'variantGroups.options'])
            ->where('is_active', 1)
            ->get()
            ->map(function ($product) {
                return $this->productPayload($product);
            });

        return response()->json([
            'products' => $products,
            'categories' => ProductCategory::orderBy('name')->get(['id', 'name']),
            'brands' => Brand::orderBy('name')->get(['id', 'name']),
            'customers' => $this->customerList(),
            'currency' => config('shop.currency_symbol'),
            'synced_at' => now()->toIso8601String(),
        ]);
    }

    /**
     * Uploads one sale that was rung up while the browser was offline
     * (see admin-pos.js's IndexedDB pending-sales queue). Recomputes
     * price/tax from today's real product data — never trusts amounts
     * the client sent, since prices may have changed since the device
     * went offline. `offline_id` makes this safe to POST more than once
     * (e.g. the connection drops again right after a successful sync):
     * if that id was already synced, the existing order is just
     * returned instead of creating a duplicate.
     */
    public function sync(Request $request, PosCartService $cart)
    {
        $request->validate([
            'offline_id' => 'required|string|max:64',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.option_ids' => 'nullable|array',
            'items.*.quantity' => 'required|integer|min:1',
            'customer_id' => 'nullable|exists:users,id',
            'payment_method' => 'required|in:cash,card,mfs,other',
            'amount_tendered' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:percentage,fixed',
            'discount_value' => 'nullable|numeric|min:0',
        ]);

        $existing = Order::where('offline_id', $request->offline_id)->first();
        if ($existing) {
            return response()->json(['order_id' => $existing->id, 'order_number' => $existing->order_number, 'already_synced' => true]);
        }

        $rawLines = collect($request->items)->map(function ($item) {
            return [
                'product_id' => $item['product_id'],
                'option_ids' => $item['option_ids'] ?? [],
                'quantity' => $item['quantity'],
            ];
        })->all();

        $lines = $cart->hydrateLines($rawLines);

        if ($lines->isEmpty()) {
            return response()->json(['message' => 'None of the products in this offline sale exist any more.'], 422);
        }

        $totals = PosCartService::totalsFor($lines, $request->input('discount_type', 'percentage'), $request->input('discount_value', 0));

        $customer = $request->customer_id ? User::find($request->customer_id) : null;
        $customer = $customer ?: User::walkingCustomer();

        if (! $customer) {
            return response()->json(['message' => 'The "Walking Customer" account is missing.'], 500);
        }

        $amountTendered = $request->filled('amount_tendered') ? (float) $request->amount_tendered : $totals['total'];

        $order = $this->createPosOrder($lines, $totals, $customer, $request->payment_method, $amountTendered, $request->offline_id);

        return response()->json(['order_id' => $order->id, 'order_number' => $order->order_number, 'already_synced' => false]);
    }

    // ------------------------------------------------------------------
    // Refunds
    // ------------------------------------------------------------------

    /**
     * "Refund a sale" search box — recent POS sales by default, narrowed
     * by order number or customer name when the cashier types something.
     * Deliberately POS sales only (order_type='pos'): refunding a normal
     * online order goes through a different flow, not this screen.
     */
    public function refundSearch(Request $request)
    {
        $orders = Order::where('order_type', 'pos')
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%' . $request->q . '%';
                $q->where(function ($q2) use ($term) {
                    $q2->where('order_number', 'like', $term)->orWhere('ship_name', 'like', $term);
                });
            })
            ->orderBy('id', 'desc')
            ->limit(15)
            ->get(['id', 'order_number', 'ship_name', 'total', 'created_at']);

        return response()->json([
            'orders' => $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'customer_name' => $order->ship_name,
                    'total' => $order->total,
                    'total_formatted' => number_format($order->total, 2),
                    'created_at' => $order->created_at->format('M j · g:i A'),
                ];
            }),
        ]);
    }

    /**
     * Line items + how much of each is still returnable, for the
     * "Process refund" modal.
     */
    public function refundDetail(Order $order)
    {
        abort_unless($order->order_type === 'pos', 404);

        return response()->json([
            'order' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->ship_name,
            ],
            'items' => $order->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->product_title,
                    'variant' => $item->variant_summary,
                    'sku' => optional($item->product)->sku,
                    'unit_price' => $item->unit_price,
                    'tax_rate' => $item->tax_rate,
                    'returnable_quantity' => $item->returnable_quantity,
                ];
            })->filter(function ($item) {
                return $item['returnable_quantity'] > 0;
            })->values(),
        ]);
    }

    /**
     * Executes a refund: validates every line stays within what's still
     * returnable, records it, bumps refunded_quantity so it can't be
     * refunded twice, and (optionally) puts the stock back.
     */
    public function refundProcess(Request $request, Order $order)
    {
        abort_unless($order->order_type === 'pos', 404);

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.order_item_id' => 'required|exists:shop_order_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:191',
            'refund_method' => 'required|in:cash,card,mfs,other',
            'restock' => 'nullable|boolean',
            'notes' => 'nullable|string|max:2000',
        ]);

        $orderItems = $order->items->keyBy('id');
        $restock = (bool) $request->boolean('restock');

        $lines = collect($request->items)->map(function ($row) use ($orderItems) {
            $item = $orderItems->get($row['order_item_id']);

            abort_if(! $item, 422, 'That line item does not belong to this sale.');
            abort_if($row['quantity'] > $item->returnable_quantity, 422, 'Cannot refund more than was sold (and not already refunded) for "' . $item->product_title . '".');

            $unitPrice = $item->unit_price;
            $qty = (int) $row['quantity'];
            $lineTotal = round($unitPrice * $qty, 2);
            $taxRate = $item->tax_rate;
            $lineTax = $taxRate ? round($lineTotal * ($taxRate / 100), 2) : 0;

            return [
                'order_item' => $item,
                'quantity' => $qty,
                'unit_price' => $unitPrice,
                'tax_rate' => $taxRate,
                'line_total' => $lineTotal,
                'line_tax' => $lineTax,
            ];
        });

        $subtotal = round($lines->sum('line_total'), 2);
        $tax = round($lines->sum('line_tax'), 2);
        $total = round($subtotal + $tax, 2);

        $refund = DB::transaction(function () use ($request, $order, $lines, $subtotal, $tax, $total, $restock) {
            $refund = PosRefund::create([
                'refund_number' => $this->generateRefundNumber(),
                'order_id' => $order->id,
                'reason' => $request->reason,
                'refund_method' => $request->refund_method,
                'restock' => $restock,
                'notes' => $request->notes,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'processed_by' => Auth::id(),
            ]);

            foreach ($lines as $line) {
                PosRefundItem::create([
                    'refund_id' => $refund->id,
                    'order_item_id' => $line['order_item']->id,
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['unit_price'],
                    'tax_rate' => $line['tax_rate'],
                    'line_total' => $line['line_total'],
                ]);

                $line['order_item']->increment('refunded_quantity', $line['quantity']);

                if ($restock && $line['order_item']->product_id) {
                    Product::where('id', $line['order_item']->product_id)->increment('stock', $line['quantity']);
                }
            }

            return $refund;
        });

        return response()->json([
            'refund_number' => $refund->refund_number,
            'total' => $refund->total,
            'total_formatted' => number_format($refund->total, 2),
            'order_number' => $order->order_number,
        ]);
    }

    protected function generateRefundNumber()
    {
        do {
            $number = 'REFUND-' . now()->format('Ym') . '-' . random_int(1000, 9999);
        } while (PosRefund::where('refund_number', $number)->exists());

        return $number;
    }

    protected function generateOrderNumber()
    {
        do {
            $number = (string) random_int(1000000, 9999999);
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }

    protected function customerList()
    {
        return User::where('role_id', 3)
            ->where('email', '!=', User::WALKING_CUSTOMER_EMAIL)
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'phone', 'is_active']);
    }

    protected function cartPayload(PosCartService $cart)
    {
        $items = $cart->items()->map(function ($line) {
            return [
                'key' => $line->key,
                'product_id' => $line->product->id,
                'title' => $line->product->title,
                'image' => $this->productImage($line->product),
                'variant' => $line->variant_summary,
                'unit_price' => $line->unit_price,
                'unit_price_formatted' => number_format($line->unit_price, 2),
                'quantity' => $line->quantity,
                'line_total' => $line->line_total,
                'line_total_formatted' => number_format($line->line_total, 2),
                'tax_rate' => $line->tax_rate,
            ];
        })->values();

        $customer = $cart->customer();

        return [
            'items' => $items,
            'count' => $cart->count(),
            'customer' => $customer ? ['id' => $customer->id, 'name' => $customer->name] : null,
            'discount_type' => $cart->discountType(),
            'discount_value' => $cart->discountValue(),
            'totals' => $cart->totals(),
            'currency' => config('shop.currency_symbol'),
        ];
    }
}
