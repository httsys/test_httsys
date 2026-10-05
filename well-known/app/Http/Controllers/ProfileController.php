<?php

namespace App\Http\Controllers;

use App\Models\HeaderFooterSetting;
use App\Models\Language;
use App\Models\Menu;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Same header/footer/menu data every front-end page needs to render
     * inside layouts.front (see the identical helper in CartController /
     * CheckoutController).
     */
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
     * Show the logged-in user's own profile and private notepad.
     */
    public function show(Request $request)
    {
        $user = $request->user();

        // One-time migration: if the user had text in the old single-note field
        // and hasn't moved to the new multi-note system yet, carry it over.
        if (! empty($user->note) && $user->notes()->count() === 0) {
            $user->notes()->create([
                'title' => null,
                'content' => $user->note,
            ]);

            $user->forceFill(['note' => null])->save();
        }

        // Donations tied to this account, plus any made as a guest using
        // the same phone/email before or after signing up — so switching
        // between logged-in and guest donating still shows up in one place.
        $donations = \App\Models\Donation::with(['fund', 'paymentMethod'])
            ->where('user_id', $user->id)
            ->orWhere(function ($q) use ($user) {
                $q->where('status', '!=', 'cancelled');
                $q->where(function ($q2) use ($user) {
                    if (! empty($user->phone)) {
                        $q2->orWhere('donor_mobile', $user->phone);
                    }
                    if (! empty($user->email)) {
                        $q2->orWhere('donor_email', $user->email);
                    }
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        $orders = \App\Models\Order::where('user_id', $user->id)
            ->with('items.product.digitalFile')
            ->orderBy('id', 'desc')
            ->get();

        $returns = \App\Models\OrderReturn::where('user_id', $user->id)
            ->with(['order', 'items.orderItem'])
            ->orderBy('id', 'desc')
            ->get();

        // Every digital-product line item this user has ever ordered,
        // newest order first — the "My Digital Products" tab reads
        // straight off this instead of re-deriving it in the view.
        $digitalItems = $orders->flatMap(function ($order) {
            return $order->items
                ->filter(function ($item) {
                    return $item->product && $item->product->isDigital();
                })
                ->map(function ($item) use ($order) {
                    $item->setRelation('order', $order);
                    return $item;
                });
        })->values();

        $wallet = \App\Models\Wallet::forUser($user);

        return view('profile.show', array_merge($this->frontData(), [
            'user' => $user,
            'notes' => $user->notes()->get(),
            'donations' => $donations,
            'orders' => $orders,
            'returns' => $returns,
            'gamePlays' => \App\Models\GamePlay::where('user_id', $user->id)->where('status', 'completed')->orderBy('id', 'desc')->limit(70)->get(),
            'gameStats' => [
                'plays' => \App\Models\GamePlay::where('user_id', $user->id)->where('status', 'completed')->count(),
                'wins' => \App\Models\GamePlay::where('user_id', $user->id)->where('status', 'completed')->where('is_win', 1)->count(),
            ],
            'digitalItems' => $digitalItems,
            'pendingRequest' => $user->pendingProfileUpdateRequest(),
            'walletBalance' => $wallet->balance,
            'walletTransactions' => $wallet->transactions()->latest()->take(20)->get(),
            'withdrawalRequests' => \App\Models\WithdrawalRequest::where('user_id', $user->id)->latest()->get(),
            'topupRequests' => \App\Models\WalletTopupRequest::where('user_id', $user->id)->latest()->get(),
            'walletPaymentMethods' => \App\Models\ShopPaymentMethod::where('is_active', 1)->orderBy('sort_order')->get(),
            'myListings' => \App\Models\CurrencyListing::where('user_id', $user->id)->orderBy('id', 'desc')->get(),
            'myCurrencyOrders' => \App\Models\CurrencyOrder::with('listing')->where('buyer_id', $user->id)->orderBy('id', 'desc')->get(),
            'myCurrencySales' => \App\Models\CurrencyOrder::with('buyer', 'listing')->where('seller_id', $user->id)->whereIn('status', ['pending', 'completed'])->orderBy('id', 'desc')->get(),
            'myMarketListings' => \App\Models\MarketplaceListing::where('user_id', $user->id)->orderBy('id', 'desc')->get(),
            'myMarketOrders' => \App\Models\MarketplaceOrder::with('listing')->where('buyer_id', $user->id)->orderBy('id', 'desc')->get(),
            'myMarketSales' => \App\Models\MarketplaceOrder::with('buyer', 'listing')->where('seller_id', $user->id)->whereIn('status', ['pending', 'completed'])->orderBy('id', 'desc')->get(),
        ]));
    }

    /**
     * Customer submits a change to their name/phone/city/address/photo.
     * Never applied immediately — it's queued as a pending request for an
     * admin to approve or reject from the admin panel. Email is
     * intentionally not accepted here at all.
     */
    public function submitUpdateRequest(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:191',
            'photo' => 'nullable|image|max:4096',
        ]);

        $user = $request->user();

        // Only carry over fields that actually changed from the user's
        // current values — an untouched field stays null on the request,
        // which approve() reads as "leave this alone".
        $changes = [];
        foreach (['name', 'phone', 'city', 'address'] as $field) {
            $value = $request->input($field);
            if ($value !== null && $value !== '' && $value !== $user->{$field}) {
                $changes[$field] = $value;
            }
        }

        if ($file = $request->file('photo')) {
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move('images/media/', $name);
            $photo = \App\Models\Photo::create(['file' => $name]);
            $changes['photo_id'] = $photo->id;
        }

        if (empty($changes)) {
            return back()->with('profile_info', "You haven't changed anything.");
        }

        // Replace any earlier pending request rather than piling them up —
        // only the latest submission should be waiting on admin review.
        $user->profileUpdateRequests()->where('status', 'pending')->delete();

        $user->profileUpdateRequests()->create(array_merge($changes, [
            'status' => 'pending',
        ]));

        return redirect()->route('profile.show', ['tab' => 'account'])
            ->with('profile_success', 'Your changes have been submitted and are awaiting admin approval.');
    }
}
