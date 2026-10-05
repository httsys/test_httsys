<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTopupRequest;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function requestWithdrawal(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'method' => ['required', 'string', 'max:60'],
            'account_details' => ['required', 'string', 'max:255'],
        ]);

        $user = $request->user();
        $wallet = Wallet::forUser($user);

        $alreadyPending = WithdrawalRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->sum('amount');

        $available = bcsub($wallet->balance, $alreadyPending, 2);

        if (bccomp($data['amount'], $available, 2) > 0) {
            return back()->withInput()->with('wallet_error',
                'That amount is more than your available balance' .
                ($alreadyPending > 0 ? ' (some of it is already tied up in a pending withdrawal request).' : '.')
            );
        }

        WithdrawalRequest::create([
            'user_id' => $user->id,
            'amount' => $data['amount'],
            'method' => $data['method'],
            'account_details' => $data['account_details'],
            'status' => 'pending',
        ]);

        return redirect()->route('profile.show', ['tab' => 'wallet'])
            ->with('wallet_success', 'Your withdrawal request has been submitted and is awaiting admin approval.');
    }

    /**
     * "Load Money" — buyer pays the site's own payment method (same
     * dropdown/pay-to-box pattern as everywhere else) and submits a
     * reference; nothing is credited until an admin confirms it.
     */
    public function requestTopup(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_method_id' => ['required', 'exists:shop_payment_methods,id'],
            'payment_reference' => ['required', 'string', 'max:191'],
        ]);

        WalletTopupRequest::create([
            'user_id' => $request->user()->id,
            'amount' => $data['amount'],
            'payment_method_id' => $data['payment_method_id'],
            'payment_reference' => $data['payment_reference'],
            'status' => 'pending',
        ]);

        return redirect()->route('profile.show', ['tab' => 'wallet'])
            ->with('wallet_success', 'Your top-up request has been submitted and is awaiting admin approval.');
    }

    /**
     * 1 point = 1 Taka, both directions. Purely internal — no real money
     * crosses the boundary either way, so unlike top-ups/withdrawals this
     * needs no admin approval, just an atomic swap.
     */
    public function convertPointsToWallet(Request $request)
    {
        $data = $request->validate([
            'points' => ['required', 'integer', 'min:1'],
        ]);

        $user = $request->user();

        if ($data['points'] > $user->points) {
            return back()->with('wallet_error', "You don't have that many points.");
        }

        DB::transaction(function () use ($user, $data) {
            $user->decrement('points', $data['points']);
            Wallet::forUser($user)->credit(
                (string) $data['points'],
                'points_conversion',
                null,
                $data['points'] . ' points converted to wallet balance'
            );
        });

        return redirect()->route('profile.show', ['tab' => 'wallet'])
            ->with('wallet_success', $data['points'] . ' points converted to ৳' . number_format($data['points'], 2) . '.');
    }

    public function convertWalletToPoints(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'integer', 'min:1'],
        ]);

        $user = $request->user();
        $wallet = Wallet::forUser($user);

        if (bccomp((string) $data['amount'], $wallet->balance, 2) > 0) {
            return back()->with('wallet_error', "You don't have that much in your wallet.");
        }

        DB::transaction(function () use ($user, $wallet, $data) {
            $wallet->debit(
                (string) $data['amount'],
                'points_conversion',
                null,
                '৳' . number_format($data['amount'], 2) . ' converted to points'
            );
            $user->increment('points', $data['amount']);
        });

        return redirect()->route('profile.show', ['tab' => 'wallet'])
            ->with('wallet_success', '৳' . number_format($data['amount'], 2) . ' converted to ' . $data['amount'] . ' points.');
    }
}
