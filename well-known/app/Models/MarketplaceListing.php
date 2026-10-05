<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MarketplaceListing extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'photo_id',
        'listing_type',
        'price',
        'quantity_available',
        'quantity_reserved',
        'quantity_sold',
        'starting_price',
        'current_bid',
        'bid_increment',
        'ends_at',
        'winning_bid_id',
        'digital_file_id',
        'digital_link',
        'status',
    ];

    protected $casts = [
        'ends_at' => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function bids()
    {
        return $this->hasMany(MarketplaceBid::class, 'listing_id')->orderByDesc('amount');
    }

    public function winningBid()
    {
        return $this->belongsTo(MarketplaceBid::class, 'winning_bid_id');
    }

    public function orders()
    {
        return $this->hasMany(MarketplaceOrder::class, 'listing_id');
    }

    public function isDigital()
    {
        return ! empty($this->digital_file_id) || ! empty($this->digital_link);
    }

    public function digitalFile()
    {
        return $this->belongsTo(Photo::class, 'digital_file_id');
    }

    public function isAuction()
    {
        return $this->listing_type === 'auction';
    }

    /**
     * Fixed-price only — what's still sellable after what other buyers
     * already have reserved or bought.
     */
    public function remainingQuantity()
    {
        return $this->quantity_available - $this->quantity_reserved - $this->quantity_sold;
    }

    public function isBuyable()
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->isAuction()) {
            return $this->ends_at && $this->ends_at->isFuture();
        }

        return $this->remainingQuantity() > 0;
    }

    /**
     * The amount a new bid has to beat: current highest bid, or the
     * starting price if nobody has bid yet.
     */
    public function minimumNextBid()
    {
        if ($this->current_bid !== null) {
            return bcadd($this->current_bid, $this->bid_increment ?: 0, 2);
        }

        return $this->starting_price;
    }

    /**
     * Place a bid. Locks the row so two simultaneous bids can't both think
     * they're the new highest.
     */
    public function placeBid(User $bidder, $amount)
    {
        return DB::transaction(function () use ($bidder, $amount) {
            $listing = static::where('id', $this->id)->lockForUpdate()->first();

            if (! $listing->isAuction() || ! $listing->isBuyable()) {
                throw new \RuntimeException('This auction is no longer open for bids.');
            }

            if ((int) $listing->user_id === (int) $bidder->id) {
                throw new \RuntimeException("You can't bid on your own listing.");
            }

            if (bccomp($amount, $listing->minimumNextBid(), 2) < 0) {
                throw new \RuntimeException('Your bid must be at least ৳' . number_format($listing->minimumNextBid(), 2) . '.');
            }

            $bid = $listing->bids()->create([
                'user_id' => $bidder->id,
                'amount' => $amount,
            ]);

            $listing->current_bid = $amount;
            $listing->save();

            return $bid;
        });
    }

    /**
     * Called once ends_at has passed for a still-active auction — either
     * when the finalize-auctions command runs, or lazily when someone
     * views the listing (so this works even without a cron job set up).
     * Highest bidder becomes the buyer of a new awaiting_payment order; no
     * bids means the listing just expires unsold.
     */
    public function finalizeIfEnded()
    {
        if (! $this->isAuction() || $this->status !== 'active' || ! $this->ends_at || $this->ends_at->isFuture()) {
            return null;
        }

        return DB::transaction(function () {
            $listing = static::where('id', $this->id)->lockForUpdate()->first();

            if ($listing->status !== 'active' || ! $listing->ends_at || $listing->ends_at->isFuture()) {
                return null;
            }

            $topBid = $listing->bids()->first();

            if (! $topBid) {
                $listing->update(['status' => 'expired']);
                return null;
            }

            $order = MarketplaceOrder::create([
                'listing_id' => $listing->id,
                'buyer_id' => $topBid->user_id,
                'seller_id' => $listing->user_id,
                'quantity' => 1,
                'amount' => $topBid->amount,
                'status' => 'awaiting_payment',
            ]);

            $listing->update([
                'status' => 'sold',
                'winning_bid_id' => $topBid->id,
            ]);

            return $order;
        });
    }
}
