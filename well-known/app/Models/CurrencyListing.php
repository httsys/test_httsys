<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyListing extends Model
{
    protected $fillable = [
        'user_id',
        'currency',
        'rate',
        'amount_available',
        'amount_reserved',
        'amount_sold',
        'min_order',
        'max_order',
        'delivery_note',
        'status',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(CurrencyOrder::class, 'listing_id');
    }

    /**
     * How much of this listing is still available to buy — what's posted,
     * minus what's already tied up in an unreviewed order, minus what's
     * already sold.
     */
    public function remaining()
    {
        return bcsub(bcsub($this->amount_available, $this->amount_reserved, 2), $this->amount_sold, 2);
    }

    public function isBuyable()
    {
        return $this->status === 'active' && bccomp($this->remaining(), 0, 2) > 0;
    }
}
