<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Table is `shop_orders`, not `orders` — this app already has an
    // unrelated legacy `orders` table (pricing/subscription purchases)
    // with a different schema, so the e-commerce orders live separately.
    protected $table = 'shop_orders';

    protected $fillable = [
        'order_number',
        'offline_id',
        'user_id',
        'served_by',
        'address_id',
        'pickup_location_id',
        'ship_name',
        'ship_phone',
        'ship_email',
        'ship_country',
        'ship_state',
        'ship_city',
        'ship_address_line',
        'ship_postal_code',
        'order_type',
        'status',
        'payment_method',
        'payment_method_id',
        'manual_reference',
        'payment_status',
        'subtotal',
        'tax',
        'shipping_charge',
        'discount',
        'coupon_code',
        'total',
        'currency',
        'note',
        'amount_tendered',
        'change_due',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'tax' => 'float',
        'shipping_charge' => 'float',
        'discount' => 'float',
        'total' => 'float',
        'amount_tendered' => 'float',
        'change_due' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The staff member (administrator/author) who rang up this sale.
     * Only ever set for order_type = 'pos'.
     */
    public function servedBy()
    {
        return $this->belongsTo(User::class, 'served_by');
    }

    public function isPos()
    {
        return $this->order_type === 'pos';
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(PickupLocation::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function refunds()
    {
        return $this->hasMany(PosRefund::class, 'order_id');
    }

    public function getRefundedTotalAttribute()
    {
        return $this->refunds->sum('total');
    }

    public function returns()
    {
        return $this->hasMany(OrderReturn::class, 'order_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(ShopPaymentMethod::class, 'payment_method_id');
    }

    /**
     * Admin confirms a manual-payment reference (bKash/Nagad/bank Trx ID)
     * against their own statement/SMS — same pattern as
     * Donation::markCompleted().
     */
    public function markPaid()
    {
        $wasPaid = $this->payment_status === 'paid';

        $this->update(['payment_status' => 'paid']);

        // Guarded so a duplicate verify click never double-emails.
        if (! $wasPaid) {
            \App\Support\OrderMailer::send($this, \App\Mail\OrderPaymentVerifiedMail::class);
        }
    }

    /**
     * The 4 steps shown on the order tracker. "cancelled" is handled
     * separately by the view (it isn't part of the normal progression).
     */
    public static function statusSteps()
    {
        return ['pending', 'confirmed', 'on_the_way', 'delivered'];
    }

    public function getStatusStepIndexAttribute()
    {
        return array_search($this->status, self::statusSteps());
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'Order Pending',
            'confirmed' => 'Order Confirmed',
            'on_the_way' => 'Order On The Way',
            'delivered' => 'Order Delivered',
            'cancelled' => 'Cancelled',
        ][$this->status] ?? ucfirst($this->status);
    }

    public function getPaymentMethodLabelAttribute()
    {
        if ($this->payment_method === 'cod') {
            return 'Cash On Delivery';
        }

        if ($this->paymentMethod) {
            return $this->paymentMethod->name;
        }

        return ucfirst($this->payment_method);
    }
}
