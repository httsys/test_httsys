<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A single attempt at a mini game. The win/lose outcome is decided by the
 * server the moment the play starts and stays hidden from the player until
 * the ad countdown has finished and the maths question is answered.
 */
class GamePlay extends Model
{
    protected $fillable = [
        'user_id', 'game_key', 'ad_id', 'choice', 'is_win', 'outcome', 'ad_duration',
        'math_a', 'math_b', 'math_attempts', 'ad_progress', 'stake', 'direction', 'trade_seconds', 'points_change', 'ad_loaded_at', 'completed_at',
        'status', 'points_awarded', 'ip_address',
    ];

    protected $casts = [
        'is_win' => 'boolean',
        'ad_duration' => 'integer',
        'math_a' => 'integer',
        'math_b' => 'integer',
        'math_attempts' => 'integer',
        'ad_progress' => 'integer',
        'stake' => 'integer',
        'trade_seconds' => 'integer',
        'points_change' => 'integer',
        'points_awarded' => 'integer',
        'ad_loaded_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ad()
    {
        return $this->belongsTo(GameAd::class, 'ad_id');
    }

    /**
     * Net points this play added (+) or took away (-).
     */
    public function netPoints()
    {
        return (int) $this->points_change !== 0 ? (int) $this->points_change : (int) $this->points_awarded;
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
