<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceListing;
use App\Models\MarketplaceOrder;
use App\Models\Photo;
use App\Models\ShopPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $listings = MarketplaceListing::with('seller', 'photo', 'bids')
            ->where('status', 'active')
            ->when($request->filled('type'), function ($q) use ($request) {
                $q->where('listing_type', $request->type);
            })
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('marketplace.index', array_merge($this->frontData(), compact('listings')));
    }

    public function create()
    {
        return view('marketplace.create', $this->frontData());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:191'],
            'description' => ['nullable', 'string', 'max:2000'],
            'listing_type' => ['required', 'in:fixed,auction'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'price' => ['required_if:listing_type,fixed', 'nullable', 'numeric', 'min:0.01'],
            'quantity_available' => ['nullable', 'integer', 'min:1'],
            'starting_price' => ['required_if:listing_type,auction', 'nullable', 'numeric', 'min:0.01'],
            'bid_increment' => ['nullable', 'numeric', 'min:0.01'],
            'ends_at' => ['required_if:listing_type,auction', 'nullable', 'date', 'after:now'],
            'digital_file' => ['nullable', 'file', 'max:51200'],
            'digital_link' => ['nullable', 'string', 'max:191'],
        ]);

        $input = $data;
        unset($input['photo'], $input['digital_file']);

        if ($file = $request->file('photo')) {
            $input['photo_id'] = $this->storeUpload($file);
        }

        if ($file = $request->file('digital_file')) {
            $input['digital_file_id'] = $this->storeUpload($file);
        }

        $input['user_id'] = Auth::id();
        $input['status'] = 'active';
        $input['quantity_available'] = $data['listing_type'] === 'auction' ? 1 : ($data['quantity_available'] ?? 1);

        $listing = MarketplaceListing::create($input);

        return redirect()->route('marketplace.show', $listing->id)->with('marketplace_success', 'Your listing is live.');
    }

    public function show(MarketplaceListing $listing)
    {
        $listing->finalizeIfEnded();
        $listing->refresh();
        $listing->load('seller', 'photo', 'bids.bidder');

        return view('marketplace.show', array_merge($this->frontData(), [
            'listing' => $listing,
            'paymentMethods' => ShopPaymentMethod::where('is_active', 1)->orderBy('sort_order')->get(),
        ]));
    }

    public function buy(Request $request, MarketplaceListing $listing)
    {
        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        try {
            $order = MarketplaceOrder::reserve($listing, $request->user(), $data['quantity'] ?? 1);
        } catch (\RuntimeException $e) {
            return back()->with('marketplace_error', $e->getMessage());
        }

        return redirect()->route('marketplace.payment', $order->id);
    }

    public function bid(Request $request, MarketplaceListing $listing)
    {
        $listing->finalizeIfEnded();
        $listing->refresh();

        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        try {
            $listing->placeBid($request->user(), $data['amount']);
        } catch (\RuntimeException $e) {
            return back()->with('marketplace_error', $e->getMessage());
        }

        return back()->with('marketplace_success', 'Your bid is in!');
    }

    public function payment(MarketplaceOrder $order)
    {
        if ((int) $order->buyer_id !== (int) Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'awaiting_payment') {
            return redirect()->route('profile.show', ['tab' => 'marketplace'])->with('marketplace_info', 'This order already has a payment on file.');
        }

        return view('marketplace.payment', array_merge($this->frontData(), [
            'order' => $order,
            'paymentMethods' => ShopPaymentMethod::where('is_active', 1)->orderBy('sort_order')->get(),
        ]));
    }

    public function submitPayment(Request $request, MarketplaceOrder $order)
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
            return back()->with('marketplace_error', $e->getMessage());
        }

        return redirect()->route('profile.show', ['tab' => 'marketplace'])
            ->with('marketplace_success', "Payment submitted — you'll be notified once an admin confirms it and the order is released.");
    }

    /**
     * Seller confirms they've handed over the item/delivered the digital
     * good to the buyer whose receiving_details they can now see. Doesn't
     * touch the wallet — that's the admin's escrow release, separate.
     */
    public function sellerRelease(Request $request, MarketplaceOrder $order)
    {
        try {
            $order->sellerRelease($request->user());
        } catch (\RuntimeException $e) {
            return back()->with('marketplace_error', $e->getMessage());
        }

        return back()->with('marketplace_success', 'Marked as sent. The buyer can now confirm receipt.');
    }

    public function sellerReject(Request $request, MarketplaceOrder $order)
    {
        $data = $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        try {
            $order->sellerReject($request->user(), $data['reason']);
        } catch (\RuntimeException $e) {
            return back()->with('marketplace_error', $e->getMessage());
        }

        return back()->with('marketplace_success', 'Rejected — the buyer and admin can see your reason.');
    }

    public function buyerConfirm(Request $request, MarketplaceOrder $order)
    {
        try {
            $order->buyerConfirm($request->user());
        } catch (\RuntimeException $e) {
            return back()->with('marketplace_error', $e->getMessage());
        }

        return back()->with('marketplace_success', 'Confirmed — thanks!');
    }

    public function toggleListing(Request $request, MarketplaceListing $listing)
    {
        if ((int) $listing->user_id !== (int) Auth::id()) {
            abort(403);
        }

        if ($listing->isAuction()) {
            return back()->with('marketplace_error', "Auctions can't be paused — let it run or wait for it to end.");
        }

        $request->validate(['status' => ['required', 'in:active,paused,closed']]);

        $listing->update(['status' => $request->status]);

        return back()->with('marketplace_success', 'Listing updated.');
    }

    protected function storeUpload($file)
    {
        $name = time() . $file->getClientOriginalName();
        $file->move('images/media/', $name);
        $photo = Photo::create(['file' => $name]);

        return $photo->id;
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
