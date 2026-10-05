<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'fund_id',
        'payment_method_id',
        'user_id',
        'donor_name',
        'donor_mobile',
        'donor_email',
        'amount',
        'reference',
        'transaction_id',
        'manual_reference',
        'status',
        'gateway_response',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markCompleted($transactionId = null, $gatewayResponse = null)
    {
        $this->update([
            'status' => 'completed',
            'transaction_id' => $transactionId ?? $this->transaction_id,
            'gateway_response' => $gatewayResponse ?? $this->gateway_response,
            'paid_at' => now(),
        ]);

        // Keep the fund's running total in sync, and let the donor know —
        // both guarded so a duplicate webhook/verify call never double-counts
        // or double-emails.
        if ($this->wasChanged('status')) {
            $this->fund()->increment('collected_amount', $this->amount);
            \App\Support\DonationMailer::send($this, \App\Mail\DonationCompletedMail::class);
        }
    }
}
