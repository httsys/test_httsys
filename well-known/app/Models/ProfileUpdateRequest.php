<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUpdateRequest extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'city',
        'address',
        'photo_id',
        'status',
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

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Apply the requested fields onto the user's account. Only the fields
     * the customer actually changed are non-null on the request, so a
     * null value here means "leave that field as-is".
     */
    public function approve(User $admin)
    {
        $updates = array_filter([
            'name' => $this->name,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'photo_id' => $this->photo_id,
        ], function ($value) {
            return $value !== null;
        });

        if (! empty($updates)) {
            $this->user->update($updates);
        }

        $this->update([
            'status' => 'approved',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);
    }

    /**
     * Leave the user's account untouched — the request is just marked
     * rejected so it stops showing as pending.
     */
    public function reject(User $admin)
    {
        $this->update([
            'status' => 'rejected',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);
    }
}
