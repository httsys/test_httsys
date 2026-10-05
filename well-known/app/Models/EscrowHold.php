<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscrowHold extends Model
{
    protected $fillable = [
        'payer_id',
        'payee_id',
        'listing_type',
        'listing_id',
        'amount',
        'fee_amount',
        'payout_amount',
        'payment_method',
        'payment_reference',
        'status',
        'admin_note',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function payee()
    {
        return $this->belongsTo(User::class, 'payee_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Only meaningful when listing_type === 'currency_exchange' — the
     * relation itself doesn't filter on that, so check the type before
     * trusting this on a hold from a different module.
     */
    public function currencyOrder()
    {
        return $this->belongsTo(\App\Models\CurrencyOrder::class, 'listing_id');
    }

    /**
     * Only meaningful when listing_type === 'marketplace' or 'auction'.
     */
    public function marketplaceOrder()
    {
        return $this->belongsTo(\App\Models\MarketplaceOrder::class, 'listing_id');
    }

    /**
     * Open a hold for a payment a buyer says they've made. Computes and
     * freezes the fee at this moment — a later change to fee_settings must
     * not retroactively change what a pending hold will pay out.
     */
    public static function open(User $payer, User $payee, $amount, $listingType = null, $listingId = null, $paymentMethod = null, $paymentReference = null)
    {
        $calc = FeeSetting::calculate($listingType ?: 'marketplace', $amount);

        return static::create([
            'payer_id' => $payer->id,
            'payee_id' => $payee->id,
            'listing_type' => $listingType,
            'listing_id' => $listingId,
            'amount' => $amount,
            'fee_amount' => $calc['fee'],
            'payout_amount' => $calc['payout'],
            'payment_method' => $paymentMethod,
            'payment_reference' => $paymentReference,
            'status' => 'held',
        ]);
    }

    /**
     * Admin confirms the buyer's payment actually arrived — the seller's
     * wallet is credited with the amount minus the fee frozen at open().
     */
    public function release(User $admin)
    {
        if ($this->status !== 'held') {
            return false;
        }

        $wallet = Wallet::forUser($this->payee);
        $wallet->credit(
            $this->payout_amount,
            'escrow_release',
            $this->id,
            'Escrow release for ' . ($this->listing_type ?: 'transaction') . ' #' . ($this->listing_id ?: $this->id)
        );

        $this->update([
            'status' => 'released',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);

        return true;
    }

    /**
     * Admin didn't receive the payment, or it was invalid. Nothing is
     * credited — same as a rejected order/donation payment elsewhere in
     * this codebase, the buyer's money (which was paid outside the system,
     * e.g. via bKash) is refunded manually by the admin, not by this call.
     */
    public function reject(User $admin, $note = null)
    {
        if ($this->status !== 'held') {
            return false;
        }

        $this->update([
            'status' => 'rejected',
            'admin_note' => $note,
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);

        return true;
    }
}
