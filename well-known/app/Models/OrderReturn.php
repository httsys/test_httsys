<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A customer-initiated return request for a delivered online order.
 * Separate from PosRefund, which is the staff-initiated, immediate,
 * in-person refund flow used at the POS — this one goes through a
 * pending -> accepted/rejected admin review first, and nothing is
 * actually refunded/restocked by this model alone (that step, once the
 * request is accepted, is a manual admin action for now — see
 * AdminOrderReturnController).
 */
class OrderReturn extends Model
{
    protected $table = 'order_returns';

    protected $fillable = [
        'order_id',
        'user_id',
        'reason',
        'status',
        'admin_note',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function items()
    {
        return $this->hasMany(OrderReturnItem::class, 'return_id');
    }

    public function getAmountAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * optional($item->orderItem)->unit_price;
        });
    }
}
