<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTopupRequest extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payment_method_id',
        'payment_reference',
        'status',
        'admin_note',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(ShopPaymentMethod::class, 'payment_method_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Admin has actually verified the payment arrived — credit the
     * wallet now.
     */
    public function approve(User $admin)
    {
        if ($this->status !== 'pending') {
            return false;
        }

        Wallet::forUser($this->user)->credit(
            $this->amount,
            'topup',
            $this->id,
            'Wallet top-up via ' . (optional($this->paymentMethod)->name ?: 'manual payment')
        );

        $this->update([
            'status' => 'approved',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);

        return true;
    }

    public function reject(User $admin, $note = null)
    {
        if ($this->status !== 'pending') {
            return false;
        }

        $this->update([
            'status' => 'rejected',
            'admin_note' => $note,
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);

        return true;
    }
}
