<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'country',
        'state',
        'city',
        'address_line',
        'postal_code',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One-line summary for order confirmations / receipts, e.g.
     * "House 3, Road 1, Block C, Mirpur 2, Dhaka, Dhaka, Bangladesh, 1216".
     */
    public function getFullAddressAttribute()
    {
        return collect([$this->address_line, $this->city, $this->state, $this->country, $this->postal_code])
            ->filter()
            ->implode(', ');
    }
}
