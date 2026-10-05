<?php

namespace App\Http\Controllers;

use App\Models\EscrowHold;
use App\Models\FeeSetting;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminWalletController extends Controller
{
    /**
     * Wallet overview: every user's balance, so an admin can spot-check
     * without opening each account individually.
     */
    public function index()
    {
        $users = User::with('wallet')
            ->join('wallets', 'wallets.user_id', '=', 'users.id')
            ->orderByDesc('wallets.balance')
            ->select('users.*')
            ->paginate(30);

        return view('wallet.admin-index', compact('users'));
    }

    public function escrowIndex(Request $request)
    {
        $holds = EscrowHold::with(['payer', 'payee', 'currencyOrder', 'marketplaceOrder.listing'])
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            }, function ($q) {
                $q->where('status', 'held');
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return view('wallet.escrow-index', compact('holds'));
    }

    public function releaseEscrow(EscrowHold $escrowHold)
    {
        if (! $escrowHold->release(Auth::user())) {
            return back()->with('wallet_error', 'This hold was already reviewed.');
        }

        $this->syncListingModule($escrowHold, 'onEscrowReleased');

        return back()->with('wallet_admin_success', 'Released — the payout has been credited to the seller\'s wallet.');
    }

    public function rejectEscrow(Request $request, EscrowHold $escrowHold)
    {
        if (! $escrowHold->reject(Auth::user(), $request->input('note'))) {
            return back()->with('wallet_error', 'This hold was already reviewed.');
        }

        $this->syncListingModule($escrowHold, 'onEscrowRejected');

        return back()->with('wallet_admin_success', 'Rejected — no funds were credited. Refund the buyer outside the system if payment was actually received.');
    }

    /**
     * Escrow holds are generic (see the wallet foundation) — whichever
     * module actually created this hold (currency exchange today,
     * marketplace/auction later) gets told the outcome so it can update
     * its own listing/order state. Keeps this controller from needing to
     * know about every module directly.
     */
    protected function syncListingModule(EscrowHold $escrowHold, $method)
    {
        if (! $escrowHold->listing_id) {
            return;
        }

        if ($escrowHold->listing_type === 'currency_exchange') {
            $order = \App\Models\CurrencyOrder::find($escrowHold->listing_id);
        } elseif (in_array($escrowHold->listing_type, ['marketplace', 'auction'], true)) {
            $order = \App\Models\MarketplaceOrder::find($escrowHold->listing_id);
        } else {
            return;
        }

        if ($order) {
            $order->{$method}();
        }
    }

    public function withdrawalIndex(Request $request)
    {
        $requests = WithdrawalRequest::with('user')
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            }, function ($q) {
                $q->where('status', 'pending');
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return view('wallet.withdrawals-index', compact('requests'));
    }

    public function approveWithdrawal(WithdrawalRequest $withdrawalRequest)
    {
        try {
            if (! $withdrawalRequest->approve(Auth::user())) {
                return back()->with('wallet_error', 'This request was already reviewed.');
            }
        } catch (\RuntimeException $e) {
            return back()->with('wallet_error', "Couldn't approve: " . $e->getMessage());
        }

        return back()->with('wallet_admin_success', 'Approved — mark this as sent once you\'ve actually transferred the money.');
    }

    public function rejectWithdrawal(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        if (! $withdrawalRequest->reject(Auth::user(), $request->input('note'))) {
            return back()->with('wallet_error', 'This request was already reviewed.');
        }

        return back()->with('wallet_admin_success', 'Rejected — the amount stays in the customer\'s wallet.');
    }

    public function topupIndex(Request $request)
    {
        $requests = \App\Models\WalletTopupRequest::with('user', 'paymentMethod')
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            }, function ($q) {
                $q->where('status', 'pending');
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return view('wallet.topups-index', compact('requests'));
    }

    public function approveTopup(\App\Models\WalletTopupRequest $walletTopupRequest)
    {
        if (! $walletTopupRequest->approve(Auth::user())) {
            return back()->with('wallet_error', 'This request was already reviewed.');
        }

        return back()->with('wallet_admin_success', 'Approved — the amount has been credited to the customer\'s wallet.');
    }

    public function rejectTopup(Request $request, \App\Models\WalletTopupRequest $walletTopupRequest)
    {
        if (! $walletTopupRequest->reject(Auth::user(), $request->input('note'))) {
            return back()->with('wallet_error', 'This request was already reviewed.');
        }

        return back()->with('wallet_admin_success', 'Rejected — nothing was credited.');
    }

    public function feesEdit()
    {
        $fees = FeeSetting::orderBy('service_type')->get()->keyBy('service_type');

        // Make sure a row exists for every known service type even if the
        // migration seed didn't cover one added later.
        foreach (['currency_exchange', 'marketplace', 'auction'] as $type) {
            if (! $fees->has($type)) {
                $fees[$type] = FeeSetting::create(['service_type' => $type, 'fixed_fee' => 0, 'percent_fee' => 0]);
            }
        }

        return view('wallet.fees-edit', compact('fees'));
    }

    public function feesUpdate(Request $request)
    {
        $data = $request->validate([
            'fees' => ['required', 'array'],
            'fees.*.fixed_fee' => ['required', 'numeric', 'min:0'],
            'fees.*.percent_fee' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        foreach ($data['fees'] as $serviceType => $values) {
            FeeSetting::updateOrCreate(
                ['service_type' => $serviceType],
                ['fixed_fee' => $values['fixed_fee'], 'percent_fee' => $values['percent_fee']]
            );
        }

        return back()->with('wallet_admin_success', 'Fee settings updated.');
    }
}
