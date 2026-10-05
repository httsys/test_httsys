<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosRefund extends Model
{
    use HasFactory;

    protected $fillable = [
        'refund_number',
        'order_id',
        'reason',
        'refund_method',
        'restock',
        'notes',
        'subtotal',
        'tax',
        'total',
        'processed_by',
    ];

    protected $casts = [
        'restock' => 'boolean',
        'subtotal' => 'float',
        'tax' => 'float',
        'total' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function items()
    {
        return $this->hasMany(PosRefundItem::class, 'refund_id');
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
