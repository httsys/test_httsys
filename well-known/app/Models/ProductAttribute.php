<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'value',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Multi-option attributes (like Color) are stored comma-separated so
     * they can render as selectable pills on the product page.
     */
    public function getOptionsAttribute()
    {
        return collect(explode(',', $this->value))
            ->map(function ($v) { return trim($v); })
            ->filter()
            ->values();
    }
}
