<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosRefundItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'refund_id',
        'order_item_id',
        'quantity',
        'unit_price',
        'tax_rate',
        'line_total',
    ];

    protected $casts = [
        'unit_price' => 'float',
        'tax_rate' => 'float',
        'line_total' => 'float',
    ];

    public function refund()
    {
        return $this->belongsTo(PosRefund::class, 'refund_id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
