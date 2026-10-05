<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
    protected $fillable = [
        'product_variant_group_id',
        'value',
        'color_code',
        'price_modifier',
        'sort_order',
    ];

    protected $casts = [
        'price_modifier' => 'float',
    ];

    public function group()
    {
        return $this->belongsTo(ProductVariantGroup::class, 'product_variant_group_id');
    }

    /**
     * Round-trips this option back into the "value|color|price" line format
     * used in the admin textarea, so the edit form can be pre-filled.
     */
    public function getAdminLineAttribute()
    {
        $parts = [$this->value];

        if (! empty($this->color_code) || ! empty($this->price_modifier)) {
            $parts[] = $this->color_code ?: '';
        }

        if (! empty($this->price_modifier)) {
            $parts[] = $this->price_modifier;
        }

        return implode('|', $parts);
    }
}
