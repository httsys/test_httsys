<?php

namespace App\Http\Controllers;

use App\Models\CurrencyListing;
use App\Models\CurrencyOrder;
use App\Models\ShopPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyExchangeController extends Controller
{
    /**
     * Browse active listings — every logged-in-or-not visitor can look,
     * only a logged-in user can buy or post.
     */
    public function index(Request $request)
    {
        $listings = CurrencyListing::with('seller')
            ->where('status', 'active')
            ->when($request->filled('currency'), function ($q) use ($request) {
                $q->where('currency', $request->currency);
            })
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('currency.index', array_merge($this->frontData(), compact('listings')));
    }

    public function create()
    {
        return view('currency.create', array_merge($this->frontData(), [
            'currencies' => \App\Models\Currency::activeList(),
        ]));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'currency' => ['required', 'string', 'max:10'],
            'rate' => ['required', 'numeric', 'min:0.01'],
            'amount_available' => ['required', 'numeric', 'min:1'],
            'min_order' => ['nullable', 'numeric', 'min:0'],
            'max_order' => ['nullable', 'numeric', 'min:0'],
        ]);

        $listing = CurrencyListing::create(array_merge($data, [
            'user_id' => Auth::id(),
            'status' => 'active',
        ]));

        return redirect()->route('currency.show', $listing->id)
            ->with('currency_success', 'Your listing is live.');
    }

    public function show(CurrencyListing $listing)
    {
        $listing->load('seller');

        return view('currency.show', array_merge($this->frontData(), [
            'listing' => $listing,
            'paymentMethods' => ShopPaymentMethod::where('is_active', 1)->orderBy('sort_order')->get(),
        ]));
    }

    /**
     * Step 1 of buying — reserve the amount, create the order in
     * awaiting_payment state, send the buyer straight to the payment page.
     */
    public function buy(Request $request, CurrencyListing $listing)
    {
        $data = $request->validate([
            'currency_amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        if ((int) $listing->user_id === (int) Auth::id()) {
            return back()->with('currency_error', "You can't buy your own listing.");
        }

        if ($listing->min_order && bccomp($data['currency_amount'], $listing->min_order, 2) < 0) {
            return back()->with('currency_error', 'That is below the minimum order for this listing.');
        }
        if ($listing->max_order && bccomp($data['currency_amount'], $listing->max_order, 2) > 0) {
            return back()->with('currency_error', 'That is above the maximum order for this listing.');
        }

        try {
            $order = CurrencyOrder::reserve($listing, $request->user(), $data['currency_amount']);
        } catch (\RuntimeException $e) {
            return back()->with('currency_error', $e->getMessage());
        }

        return redirect()->route('currency.payment', $order->id);
    }

    public function payment(CurrencyOrder $order)
    {
        if ((int) $order->buyer_id !== (int) Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'awaiting_payment') {
            return redirect()->route('profile.show', ['tab' => 'currency'])->with('currency_info', 'This order already has a payment on file.');
        }

        return view('currency.payment', array_merge($this->frontData(), [
            'order' => $order,
            'paymentMethods' => ShopPaymentMethod::where('is_active', 1)->orderBy('sort_order')->get(),
        ]));
    }

    public function submitPayment(Request $request, CurrencyOrder $order)
    {
        if ((int) $order->buyer_id !== (int) Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'receiving_details' => ['required', 'string', 'max:500'],
            'payment_method_id' => ['required', 'exists:shop_payment_methods,id'],
            'payment_reference' => ['required', 'string', 'max:191'],
        ]);

        try {
            $order->submitPayment($data['receiving_details'], $data['payment_method_id'], $data['payment_reference']);
        } catch (\RuntimeException $e) {
            return back()->with('currency_error', $e->getMessage());
        }

        return redirect()->route('profile.show', ['tab' => 'currency'])
            ->with('currency_success', "Payment submitted — you'll be paid out once an admin confirms it arrived. Wait for that confirmation before handing over the {$order->currency}.");
    }

    /**
     * Seller confirms they've handed over the currency to the buyer whose
     * receiving_details they can now see. Does not touch the wallet —
     * that only happens once an admin releases the escrow hold. This is
     * just the seller's own signal, shown to the buyer and to admin.
     */
    public function sellerRelease(Request $request, CurrencyOrder $order)
    {
        try {
            $order->sellerRelease($request->user());
        } catch (\RuntimeException $e) {
            return back()->with('currency_error', $e->getMessage());
        }

        return back()->with('currency_success', "Marked as sent. The buyer can now confirm they've received it.");
    }

    public function sellerReject(Request $request, CurrencyOrder $order)
    {
        $data = $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        try {
            $order->sellerReject($request->user(), $data['reason']);
        } catch (\RuntimeException $e) {
            return back()->with('currency_error', $e->getMessage());
        }

        return back()->with('currency_success', 'Rejected — the buyer and admin can see your reason.');
    }

    public function buyerConfirm(Request $request, CurrencyOrder $order)
    {
        try {
            $order->buyerConfirm($request->user());
        } catch (\RuntimeException $e) {
            return back()->with('currency_error', $e->getMessage());
        }

        return back()->with('currency_success', 'Confirmed — thanks! This now shows as confirmed on the admin side too.');
    }

    /**
     * A seller pausing/resuming/closing their own listing. Closing does
     * not touch orders already in progress against it.
     */
    public function toggleListing(Request $request, CurrencyListing $listing)
    {
        if ((int) $listing->user_id !== (int) Auth::id()) {
            abort(403);
        }

        $request->validate(['status' => ['required', 'in:active,paused,closed']]);

        $listing->update(['status' => $request->status]);

        return back()->with('currency_success', 'Listing updated.');
    }

    protected function frontData()
    {
        $currentLang = session()->has('lang')
            ? \App\Models\Language::where('code', session()->get('lang'))->first()
            : \App\Models\Language::where('is_default', 1)->first();

        $lang_id = $currentLang->id;

        return [
            'currentLang' => $currentLang,
            'langs' => \App\Models\Language::all(),
            'headerfooter' => \App\Models\HeaderFooterSetting::find($lang_id),
            'menus' => \App\Models\Menu::where('language_id', $lang_id)->get(),
        ];
    }
}
