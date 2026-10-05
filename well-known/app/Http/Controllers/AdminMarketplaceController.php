<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceListing;
use Illuminate\Http\Request;

class AdminMarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $listings = MarketplaceListing::with('seller')
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('type'), function ($q) use ($request) {
                $q->where('listing_type', $request->type);
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return view('marketplace.admin-index', compact('listings'));
    }

    public function close(MarketplaceListing $listing)
    {
        $listing->update(['status' => 'closed']);

        return back()->with('marketplace_admin_success', 'Listing closed.');
    }
}
