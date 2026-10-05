<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CurrencyOrder extends Model
{
    use \App\Models\Concerns\HasFulfillmentSteps;

    protected $fillable = [
        'listing_id',
        'buyer_id',
        'seller_id',
        'currency',
        'currency_amount',
        'rate',
        'total_bdt',
        'receiving_details',
        'payment_method_id',
        'payment_reference',
        'escrow_hold_id',
        'status',
        'seller_status',
        'seller_note',
        'seller_acted_at',
        'buyer_confirmed_at',
    ];

    protected $casts = [
        'seller_acted_at' => 'datetime',
        'buyer_confirmed_at' => 'datetime',
    ];

    public function listing()
    {
        return $this->belongsTo(CurrencyListing::class, 'listing_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(ShopPaymentMethod::class, 'payment_method_id');
    }

    public function escrowHold()
    {
        return $this->belongsTo(EscrowHold::class);
    }

    /**
     * Step 1 of buying: reserve this amount against the listing so two
     * buyers can't both claim the same dollars, and create the order in
     * awaiting_payment state. No escrow hold yet — that's only opened once
     * the buyer actually submits a payment reference in submitPayment(),
     * since only then is there a real payment claim to hold.
     */
    public static function reserve(CurrencyListing $listing, User $buyer, $currencyAmount)
    {
        return DB::transaction(function () use ($listing, $buyer, $currencyAmount) {
            $locked = CurrencyListing::where('id', $listing->id)->lockForUpdate()->first();

            if (! $locked->isBuyable() || bccomp($currencyAmount, $locked->remaining(), 2) > 0) {
                throw new \RuntimeException('That amount is no longer available on this listing.');
            }

            $locked->amount_reserved = bcadd($locked->amount_reserved, $currencyAmount, 2);
            $locked->save();

            $totalBdt = bcmul($currencyAmount, $locked->rate, 2);

            return static::create([
                'listing_id' => $locked->id,
                'buyer_id' => $buyer->id,
                'seller_id' => $locked->user_id,
                'currency' => $locked->currency,
                'currency_amount' => $currencyAmount,
                'rate' => $locked->rate,
                'total_bdt' => $totalBdt,
                'status' => 'awaiting_payment',
            ]);
        });
    }

    /**
     * Step 2: buyer says they've sent the Taka and gives a reference. Opens
     * the actual escrow hold — from here it's reviewed on the same Escrow
     * Holds admin page every other escrow-backed feature uses.
     */
    public function submitPayment($receivingDetails, $paymentMethodId, $paymentReference)
    {
        if ($this->status !== 'awaiting_payment') {
            throw new \RuntimeException('This order already has a payment submitted.');
        }

        $methodName = $paymentMethodId
            ? optional(\App\Models\ShopPaymentMethod::find($paymentMethodId))->name
            : null;

        $hold = EscrowHold::open(
            $this->buyer,
            $this->seller,
            $this->total_bdt,
            'currency_exchange',
            $this->id,
            $methodName,
            $paymentReference
        );

        $this->update([
            'receiving_details' => $receivingDetails,
            'payment_method_id' => $paymentMethodId,
            'payment_reference' => $paymentReference,
            'escrow_hold_id' => $hold->id,
            'status' => 'pending',
        ]);

        return $hold;
    }

    /**
     * Called by AdminWalletController right after it releases the linked
     * escrow hold — moves this order's reserved amount into sold.
     */
    public function onEscrowReleased()
    {
        DB::transaction(function () {
            $listing = CurrencyListing::where('id', $this->listing_id)->lockForUpdate()->first();
            if ($listing) {
                $listing->amount_reserved = bcsub($listing->amount_reserved, $this->currency_amount, 2);
                $listing->amount_sold = bcadd($listing->amount_sold, $this->currency_amount, 2);
                $listing->save();
            }

            $this->update(['status' => 'completed']);
        });
    }

    /**
     * Called by AdminWalletController right after it rejects the linked
     * escrow hold — frees the reserved amount back to the pool so other
     * buyers can purchase it.
     */
    public function onEscrowRejected()
    {
        DB::transaction(function () {
            $listing = CurrencyListing::where('id', $this->listing_id)->lockForUpdate()->first();
            if ($listing) {
                $listing->amount_reserved = bcsub($listing->amount_reserved, $this->currency_amount, 2);
                $listing->save();
            }

            $this->update(['status' => 'rejected']);
        });
    }
}
