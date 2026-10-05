<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * An advertisement shown to a player between pressing "Spin to earn" /
 * "Heads" / "Tails" and seeing the result.
 */
class GameAd extends Model
{
    protected $fillable = [
        'title', 'ad_type', 'link', 'image_url', 'code', 'duration', 'max_show', 'shown_count', 'is_active',
    ];

    protected $casts = [
        'duration' => 'integer',
        'max_show' => 'integer',
        'shown_count' => 'integer',
        'is_active' => 'boolean',
    ];

    public static $types = [
        'link' => 'Link / URL',
        'image' => 'Banner Image',
        'code' => 'HTML / Script Code',
    ];

    /**
     * Ads that can still be handed out: switched on, and either unlimited
     * (max_show = 0) or not yet shown max_show times.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_active', 1)
            ->whereRaw('(max_show = 0 OR shown_count < max_show)');
    }

    public function hasReachedLimit()
    {
        return $this->max_show > 0 && $this->shown_count >= $this->max_show;
    }
}
