<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'account_details',
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

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Admin has actually sent the money outside the system (bKash/bank) —
     * this just debits the wallet to match what already happened.
     */
    public function approve(User $admin)
    {
        if ($this->status !== 'pending') {
            return false;
        }

        $wallet = Wallet::forUser($this->user);
        $wallet->debit(
            $this->amount,
            'withdrawal',
            $this->id,
            'Withdrawal via ' . $this->method
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
