<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupLocation extends Model
{
    protected $fillable = [
        'name', 'address_line', 'city', 'state', 'country', 'postal_code', 'phone', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getFullAddressAttribute()
    {
        return collect([$this->address_line, $this->city, $this->state, $this->country, $this->postal_code])
            ->filter()
            ->implode(', ');
    }
}
