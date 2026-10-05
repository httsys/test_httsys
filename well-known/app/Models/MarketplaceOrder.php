<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MarketplaceOrder extends Model
{
    use \App\Models\Concerns\HasFulfillmentSteps;

    protected $fillable = [
        'listing_id',
        'buyer_id',
        'seller_id',
        'quantity',
        'amount',
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
        return $this->belongsTo(MarketplaceListing::class, 'listing_id');
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
     * "Buy Now" on a fixed-price listing — reserves the quantity so it
     * can't be double-sold while this buyer is still on the payment page,
     * same locking approach as CurrencyOrder::reserve(). Not used for
     * auction wins, which are created directly by
     * MarketplaceListing::finalizeIfEnded() since there's only ever one
     * winner to reserve against.
     */
    public static function reserve(MarketplaceListing $listing, User $buyer, $quantity)
    {
        return DB::transaction(function () use ($listing, $buyer, $quantity) {
            $locked = MarketplaceListing::where('id', $listing->id)->lockForUpdate()->first();

            if ($locked->isAuction()) {
                throw new \RuntimeException('This is an auction listing — place a bid instead.');
            }

            if (! $locked->isBuyable() || $quantity > $locked->remainingQuantity()) {
                throw new \RuntimeException('That quantity is no longer available.');
            }

            if ((int) $locked->user_id === (int) $buyer->id) {
                throw new \RuntimeException("You can't buy your own listing.");
            }

            $locked->quantity_reserved += $quantity;
            $locked->save();

            return static::create([
                'listing_id' => $locked->id,
                'buyer_id' => $buyer->id,
                'seller_id' => $locked->user_id,
                'quantity' => $quantity,
                'amount' => bcmul($locked->price, $quantity, 2),
                'status' => 'awaiting_payment',
            ]);
        });
    }

    /**
     * Buyer says they've paid — opens the escrow hold. Auctions and fixed
     * listings both use 'marketplace' as the fee service type except
     * auctions use 'auction', matching the two fee_settings rows seeded by
     * the wallet foundation migration.
     */
    public function submitPayment($receivingDetails, $paymentMethodId, $paymentReference)
    {
        if ($this->status !== 'awaiting_payment') {
            throw new \RuntimeException('This order already has a payment submitted.');
        }

        $feeType = $this->listing && $this->listing->isAuction() ? 'auction' : 'marketplace';

        $methodName = $paymentMethodId
            ? optional(ShopPaymentMethod::find($paymentMethodId))->name
            : null;

        $hold = EscrowHold::open(
            $this->buyer,
            $this->seller,
            $this->amount,
            $feeType,
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
     * Called by AdminWalletController after it releases the linked escrow
     * hold. Fixed-price: moves reserved → sold. Auction: the listing is
     * already 'sold' from finalizeIfEnded(), nothing more to touch there.
     */
    public function onEscrowReleased()
    {
        DB::transaction(function () {
            if ($this->listing && ! $this->listing->isAuction()) {
                $listing = MarketplaceListing::where('id', $this->listing_id)->lockForUpdate()->first();
                $listing->quantity_reserved -= $this->quantity;
                $listing->quantity_sold += $this->quantity;
                if ($listing->remainingQuantity() <= 0) {
                    $listing->status = 'sold';
                }
                $listing->save();
            }

            $this->update(['status' => 'completed']);
        });
    }

    /**
     * Called after an admin rejects the linked escrow hold. Fixed-price:
     * frees the reservation back to the pool. Auction: reopens the
     * listing so the seller isn't stuck with a non-paying winner forever.
     */
    public function onEscrowRejected()
    {
        DB::transaction(function () {
            if ($this->listing) {
                $listing = MarketplaceListing::where('id', $this->listing_id)->lockForUpdate()->first();

                if ($listing->isAuction()) {
                    $listing->status = 'expired';
                    $listing->save();
                } else {
                    $listing->quantity_reserved -= $this->quantity;
                    $listing->save();
                }
            }

            $this->update(['status' => 'rejected']);
        });
    }
}
