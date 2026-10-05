<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class AdminDonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::with(['fund', 'paymentMethod', 'user'])
            ->when($request->filled('fund_id'), function ($q) use ($request) {
                $q->where('fund_id', $request->fund_id);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->orderBy('id', 'desc')
            ->paginate(25)
            ->withQueryString();

        return view('donations.admin-index', compact('donations'));
    }

    /**
     * Admin confirms they've checked a manual-payment reference (bank
     * statement, wallet SMS, etc) against what the donor submitted.
     */
    public function verify(Donation $donation)
    {
        if ($donation->status !== 'completed') {
            $donation->markCompleted($donation->manual_reference);
        }

        return back()->with('donation_success', 'Donation marked as completed.');
    }

    public function reject(Donation $donation)
    {
        $donation->update(['status' => 'failed']);

        \App\Support\DonationMailer::send($donation, \App\Mail\DonationRejectedMail::class);

        return back()->with('donation_success', 'Donation marked as failed.');
    }
}
