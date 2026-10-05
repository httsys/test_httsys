<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'max_discount', 'min_subtotal', 'usage_limit', 'used_count', 'expires_at', 'is_active',
    ];

    protected $casts = [
        'value' => 'float',
        'max_discount' => 'float',
        'min_subtotal' => 'float',
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Whether this coupon can currently be applied to a cart with the
     * given subtotal — checks active flag, expiry, usage limit, and the
     * minimum-subtotal requirement.
     */
    public function isValidFor($subtotal)
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return false;
        }

        if ($this->min_subtotal && $subtotal < $this->min_subtotal) {
            return false;
        }

        return true;
    }

    public function discountFor($subtotal)
    {
        if ($this->type === 'percent') {
            $discount = $subtotal * ($this->value / 100);

            if ($this->max_discount) {
                $discount = min($discount, $this->max_discount);
            }
        } else {
            $discount = $this->value;
        }

        return round(min($discount, $subtotal), 2);
    }
}
