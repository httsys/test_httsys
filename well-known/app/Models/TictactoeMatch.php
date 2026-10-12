<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One Tic Tac Toe match: either a player against the computer (mode "ai",
 * the computer is always O) or two real players in an online room.
 */
class TictactoeMatch extends Model
{
    protected $table = 'tictactoe_matches';

    protected $fillable = [
        'code', 'mode', 'size', 'win_len', 'board', 'turn', 'status', 'winner', 'win_cells', 'end_reason',
        'last_cell', 'x_user_id', 'o_user_id', 'x_play_id', 'o_play_id', 'x_ip', 'o_ip',
        'points_awarded', 'last_move_at', 'stake', 'fee_percent', 'settled', 'declined_name', 'declined_at',
    ];

    protected $casts = [
        'size' => 'integer',
        'win_len' => 'integer',
        'last_cell' => 'integer',
        'points_awarded' => 'integer',
        'stake' => 'integer',
        'fee_percent' => 'integer',
        'settled' => 'boolean',
        'last_move_at' => 'datetime',
        'declined_at' => 'datetime',
    ];

    public function xUser()
    {
        return $this->belongsTo(User::class, 'x_user_id');
    }

    public function oUser()
    {
        return $this->belongsTo(User::class, 'o_user_id');
    }

    public function isAi()
    {
        return $this->mode === 'ai';
    }

    public function isFinished()
    {
        return in_array($this->status, ['finished', 'cancelled'], true);
    }

    /**
     * 'X', 'O' or null for the given user id.
     */
    public function symbolOf($userId)
    {
        if ((int) $this->x_user_id === (int) $userId) {
            return 'X';
        }
        if ($this->o_user_id !== null && (int) $this->o_user_id === (int) $userId) {
            return 'O';
        }

        return null;
    }
}
