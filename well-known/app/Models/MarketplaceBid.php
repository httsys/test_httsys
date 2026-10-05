<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketplaceBid extends Model
{
    protected $fillable = ['listing_id', 'user_id', 'amount'];

    public function listing()
    {
        return $this->belongsTo(MarketplaceListing::class, 'listing_id');
    }

    public function bidder()
    {
        // Explicit FK: Eloquent's naming convention would otherwise look
        // for bidder_id (from the relation method name) instead of the
        // actual user_id column, silently returning null for every bid.
        return $this->belongsTo(User::class, 'user_id');
    }
}
