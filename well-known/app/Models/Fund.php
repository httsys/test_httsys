<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'title',
        'slug',
        'short_description',
        'description',
        'photo_id',
        'target_amount',
        'collected_amount',
        'is_active',
        'sort_order',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function completedDonations()
    {
        return $this->hasMany(Donation::class)->where('status', 'completed');
    }

    /**
     * 0-100 progress toward target_amount, or null when the fund has no
     * target (open-ended collection) so the view can skip the progress bar.
     */
    public function getProgressPercentAttribute()
    {
        if (empty($this->target_amount) || $this->target_amount <= 0) {
            return null;
        }

        return min(100, round(($this->collected_amount / $this->target_amount) * 100));
    }
}
