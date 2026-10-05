<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'shop_order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_title',
        'product_image',
        'variant_summary',
        'unit_price',
        'tax_rate',
        'line_tax',
        'quantity',
        'refunded_quantity',
        'line_total',
    ];

    protected $casts = [
        'unit_price' => 'float',
        'tax_rate' => 'float',
        'line_tax' => 'float',
        'line_total' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * How many units of this line are still eligible for a refund —
     * enforced server-side in PosController@refundProcess so nobody can
     * refund more than was actually sold.
     */
    public function getReturnableQuantityAttribute()
    {
        return max(0, $this->quantity - $this->refunded_quantity);
    }
}
