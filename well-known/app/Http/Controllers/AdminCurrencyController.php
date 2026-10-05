<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\CurrencyListing;
use Illuminate\Http\Request;

class AdminCurrencyController extends Controller
{
    public function index(Request $request)
    {
        $listings = CurrencyListing::with('seller')
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return view('currency.admin-index', compact('listings'));
    }

    /**
     * Admin force-closing a listing (moderation) — same effect as the
     * seller closing it themselves, just triggered from the admin side.
     */
    public function close(CurrencyListing $listing)
    {
        $listing->update(['status' => 'closed']);

        return back()->with('currency_admin_success', 'Listing closed.');
    }

    /**
     * What shows in the "Post a Currency Listing" dropdown. Kept on this
     * same controller rather than a new one — it's a small, closely
     * related settings screen, not its own module.
     */
    public function currenciesIndex()
    {
        $currencies = Currency::orderBy('sort_order')->orderBy('code')->get();

        return view('currency.admin-currencies', compact('currencies'));
    }

    public function currenciesStore(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:10', 'unique:currencies,code'],
            'name' => ['required', 'string', 'max:60'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        Currency::create([
            'code' => strtoupper($data['code']),
            'name' => $data['name'],
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => 1,
        ]);

        return back()->with('currency_admin_success', 'Currency added.');
    }

    public function currenciesToggle(Currency $currency)
    {
        $currency->update(['is_active' => ! $currency->is_active]);

        return back()->with('currency_admin_success', 'Updated.');
    }

    public function currenciesDestroy(Currency $currency)
    {
        $currency->delete();

        return back()->with('currency_admin_success', 'Currency removed from the list.');
    }
}
