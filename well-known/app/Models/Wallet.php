<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    /**
     * Get-or-create the wallet for a user. Every user effectively has a
     * wallet — it's just only actually created in the database the first
     * time something needs to touch it.
     */
    public static function forUser(User $user)
    {
        return static::firstOrCreate(['user_id' => $user->id], ['balance' => 0]);
    }

    /**
     * Add money and record why. Wrapped in a transaction with a row lock
     * so two releases landing at the same moment can't both read the same
     * starting balance and silently drop one of them.
     */
    public function credit($amount, $source, $sourceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $source, $sourceId, $description) {
            $wallet = static::where('id', $this->id)->lockForUpdate()->first();

            $wallet->balance = bcadd($wallet->balance, $amount, 2);
            $wallet->save();

            $entry = $wallet->transactions()->create([
                'type' => 'credit',
                'amount' => $amount,
                'balance_after' => $wallet->balance,
                'source' => $source,
                'source_id' => $sourceId,
                'description' => $description,
            ]);

            $this->balance = $wallet->balance;

            return $entry;
        });
    }

    /**
     * Same locking approach as credit(), and refuses to take the balance
     * negative — a withdrawal approval that would overdraw the account
     * fails loudly instead of quietly going negative.
     */
    public function debit($amount, $source, $sourceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $source, $sourceId, $description) {
            $wallet = static::where('id', $this->id)->lockForUpdate()->first();

            if (bccomp($wallet->balance, $amount, 2) < 0) {
                throw new \RuntimeException('Insufficient wallet balance.');
            }

            $wallet->balance = bcsub($wallet->balance, $amount, 2);
            $wallet->save();

            $entry = $wallet->transactions()->create([
                'type' => 'debit',
                'amount' => $amount,
                'balance_after' => $wallet->balance,
                'source' => $source,
                'source_id' => $sourceId,
                'description' => $description,
            ]);

            $this->balance = $wallet->balance;

            return $entry;
        });
    }
}
