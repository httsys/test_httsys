<?php

namespace App\Services;

use App\Models\GamePlay;
use App\Models\GameSetting;
use App\Models\TictactoeMatch;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Everything the Tic Tac Toe game needs on the server:
 *
 *  - vs computer   : startAi() then move() (the computer answers inside move())
 *  - online rooms  : createRoom() (host picks the points and gets a share code),
 *                    previewRoom() (what the friend sees before deciding),
 *                    joinRoom() / declineRoom(), then state() (polling) and move()
 *  - the winner gets points once, in finish(). Points, history and the hourly
 *    play limit reuse the existing game_plays / users.points system.
 *
 * Online matches are played for points ("stake"):
 *   - the host's stake is taken from his balance when the room is created
 *     and given back if nobody plays (room closed / expired / left);
 *   - the friend's stake is taken when he presses Join Game;
 *   - the winner receives both stakes minus the admin's fee percent;
 *   - a draw gives every player his stake back.
 * Money moves exactly once per match (tictactoe_matches.settled).
 *
 * The browser never decides who won - it only sends "I clicked cell N".
 */
class TicTacToeService
{
    const GAME_KEY = 'tic_tac_toe';

    /** Letters/numbers for room codes (no 0/O/1/I so they are easy to read out). */
    const CODE_CHARS = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    protected $games;

    public function __construct(MiniGameService $games)
    {
        $this->games = $games;
    }

    /* ------------------------------------------------------------------
     | Settings
     * ---------------------------------------------------------------- */

    public function setting()
    {
        return GameSetting::forGame(self::GAME_KEY);
    }

    public function aiMistakePercent(GameSetting $s)
    {
        return max(0, min(100, (int) $s->option('ai_mistake_percent', 25)));
    }

    public function moveSeconds(GameSetting $s)
    {
        return max(10, min(600, (int) $s->option('move_seconds', 60)));
    }

    public function roomMinutes(GameSetting $s)
    {
        return max(1, min(120, (int) $s->option('room_minutes', 10)));
    }

    public function aiPoints(GameSetting $s)
    {
        return max(0, (int) $s->points_per_win);
    }

    /** Percent of the pot the site keeps from an online match. */
    public function feePercent(GameSetting $s)
    {
        return max(0, min(100, (int) $s->option('online_fee_percent', 10)));
    }

    /**
     * What the game page needs besides the usual mini-game data.
     */
    public function pageData($user, GameSetting $s)
    {
        // Give back points that are stuck in abandoned rooms (nobody has to be polling for that).
        $this->sweepStale($s);

        return [
            'activeMatchId' => $user ? $this->activeMatchId($user->id) : null,
            'aiPoints' => $this->aiPoints($s),
            'feePercent' => $this->feePercent($s),
            'moveSeconds' => $this->moveSeconds($s),
            'winLengths' => TicTacToeEngine::$winLengths,
        ];
    }

    public function activeMatchId($userId)
    {
        $m = TictactoeMatch::where(function ($q) use ($userId) {
                $q->where('x_user_id', $userId)->orWhere('o_user_id', $userId);
            })
            ->whereIn('status', ['waiting', 'active'])
            ->orderBy('id', 'desc')
            ->first();

        return $m ? $m->id : null;
    }

    /**
     * Close rooms nobody joined and online matches nobody is playing any more,
     * so the points held in them are returned / paid out even if both players left.
     */
    public function sweepStale(GameSetting $s)
    {
        try {
            $waiting = TictactoeMatch::where('status', 'waiting')
                ->where('created_at', '<', now()->subMinutes($this->roomMinutes($s)))
                ->orderBy('id')->limit(20)->pluck('id')->all();

            $active = TictactoeMatch::where('status', 'active')
                ->where('mode', 'online')
                ->where('last_move_at', '<', now()->subSeconds($this->moveSeconds($s)))
                ->orderBy('id')->limit(20)->pluck('id')->all();

            foreach (array_merge($waiting, $active) as $id) {
                DB::transaction(function () use ($id, $s) {
                    $m = TictactoeMatch::where('id', $id)->lockForUpdate()->first();
                    if ($m) {
                        $this->applyTimeouts($m, $s);
                    }
                });
            }
        } catch (\Throwable $e) {
            // A clean-up problem must never stop the page from opening.
            report($e);
        }
    }

    /* ------------------------------------------------------------------
     | Starting matches
     * ---------------------------------------------------------------- */

    /**
     * Player against the computer. The player is X and moves first.
     *
     * @return array ['match' => TictactoeMatch|null, 'error' => string|null]
     */
    public function startAi(User $user, $size, $ip)
    {
        return DB::transaction(function () use ($user, $size, $ip) {
            $setting = $this->setting();

            if ($error = $this->cannotStart($user->id, $size, $setting)) {
                return ['match' => null, 'error' => $error];
            }

            $play = $this->newPlay($user->id, 'ai-' . $size . 'x' . $size, $ip);

            $match = TictactoeMatch::create([
                'mode' => 'ai',
                'size' => (int) $size,
                'win_len' => TicTacToeEngine::winLength($size),
                'board' => TicTacToeEngine::emptyBoard($size),
                'turn' => 'X',
                'status' => 'active',
                'x_user_id' => $user->id,
                'x_play_id' => $play->id,
                'x_ip' => $ip,
                'last_move_at' => now(),
            ]);

            return ['match' => $match, 'error' => null];
        });
    }

    /**
     * Open an online room for $stake points and get its share code.
     * The host is X and moves first. The stake is taken from his balance now.
     */
    public function createRoom(User $user, $size, $stake, $ip)
    {
        return DB::transaction(function () use ($user, $size, $stake, $ip) {
            $setting = $this->setting();

            if ($error = $this->cannotStart($user->id, $size, $setting)) {
                return ['match' => null, 'error' => $error];
            }

            $stake = (int) $stake;
            if ($stake < 1) {
                return ['match' => null, 'error' => 'Please enter how many points you want to play for.'];
            }

            // Read after cannotStart(): it may just have returned points from an older room.
            $balance = (int) User::where('id', $user->id)->value('points');
            if ($stake > $balance) {
                return ['match' => null, 'error' => 'You do not have enough points. Your balance is ' . $balance . ' point(s).'];
            }

            $play = $this->newPlay($user->id, 'online-' . $size . 'x' . $size, $ip);

            $match = TictactoeMatch::create([
                'code' => $this->freshCode(),
                'mode' => 'online',
                'size' => (int) $size,
                'win_len' => TicTacToeEngine::winLength($size),
                'board' => TicTacToeEngine::emptyBoard($size),
                'turn' => 'X',
                'status' => 'waiting',
                'x_user_id' => $user->id,
                'x_play_id' => $play->id,
                'x_ip' => $ip,
                'stake' => $stake,
                'fee_percent' => 0,
                'settled' => 0,
            ]);

            User::where('id', $user->id)->decrement('points', $stake);

            return ['match' => $match, 'error' => null];
        });
    }

    /**
     * The friend typed a room code: look at the room (nothing is changed or paid yet)
     * so he can see the points before saying yes or no.
     *
     * @return array ['match', 'error', 'rejoin' => bool, 'balance' => int]
     */
    public function previewRoom(User $user, $rawCode)
    {
        $code = $this->cleanCode($rawCode);
        if (strlen($code) < 4) {
            return ['match' => null, 'error' => 'Please enter the room code.'];
        }

        return DB::transaction(function () use ($user, $code) {
            $setting = $this->setting();

            if (! $setting->is_active) {
                return ['match' => null, 'error' => 'This game is currently unavailable.'];
            }

            $match = $this->findRoom($code);
            if (! $match) {
                return ['match' => null, 'error' => 'Room not found. Please check the code and try again.'];
            }

            $this->applyTimeouts($match, $setting);

            // Already one of the two players (e.g. re-entering the code): no question to ask.
            if ($match->symbolOf($user->id)) {
                if ($match->status === 'waiting') {
                    return ['match' => null, 'error' => 'This is your own room. Share the code with your friend instead.'];
                }

                return ['match' => $match, 'error' => null, 'rejoin' => true, 'balance' => 0];
            }

            if ($match->status !== 'waiting') {
                return ['match' => null, 'error' => 'This room is no longer available.'];
            }

            if ($setting->option('block_same_ip', false) && $match->x_ip && $match->x_ip === request()->ip()) {
                return ['match' => null, 'error' => 'You cannot join a room that was opened from the same network.'];
            }

            return [
                'match' => $match,
                'error' => null,
                'rejoin' => false,
                'balance' => (int) User::where('id', $user->id)->value('points'),
            ];
        });
    }

    /**
     * The friend looked at the room and pressed Cancel. The room stays open
     * (the host decides what to do) but the host is told.
     */
    public function declineRoom(User $user, $rawCode)
    {
        $code = $this->cleanCode($rawCode);
        if (strlen($code) < 4) {
            return;
        }

        DB::transaction(function () use ($user, $code) {
            $match = TictactoeMatch::where('code', $code)
                ->where('mode', 'online')
                ->where('status', 'waiting')
                ->orderBy('id', 'desc')
                ->lockForUpdate()
                ->first();

            if (! $match || $match->symbolOf($user->id)) {
                return;
            }

            $match->declined_name = $this->shortName($user->name);
            $match->declined_at = now();
            $match->save();
        });
    }

    /**
     * Enter a friend's room (Join Game). The joiner is O and his stake is taken now.
     *
     * @return array ['match', 'error', 'low_balance' => ['need', 'balance']|absent]
     */
    public function joinRoom(User $user, $rawCode, $ip)
    {
        $code = $this->cleanCode($rawCode);
        if (strlen($code) < 4) {
            return ['match' => null, 'error' => 'Please enter the room code.'];
        }

        return DB::transaction(function () use ($user, $code, $ip) {
            $setting = $this->setting();

            if (! $setting->is_active) {
                return ['match' => null, 'error' => 'This game is currently unavailable.'];
            }

            // Serialise this user's starts (same trick as the other mini games).
            User::where('id', $user->id)->lockForUpdate()->value('points');

            $match = $this->findRoom($code, true);
            if (! $match) {
                return ['match' => null, 'error' => 'Room not found. Please check the code and try again.'];
            }

            $this->applyTimeouts($match, $setting);

            // Already one of the two players (e.g. re-entering the code): just go back in.
            if ($match->symbolOf($user->id)) {
                if ($match->status === 'waiting') {
                    return ['match' => null, 'error' => 'This is your own room. Share the code with your friend instead.'];
                }

                return ['match' => $match, 'error' => null];
            }

            if ($match->status !== 'waiting') {
                return ['match' => null, 'error' => 'This room is no longer available.'];
            }

            if ($setting->option('block_same_ip', false) && $match->x_ip && $match->x_ip === $ip) {
                return ['match' => null, 'error' => 'You cannot join a room that was opened from the same network.'];
            }

            $this->closeUnfinished($user->id, $setting);

            $remaining = $this->games->remaining($user->id, $setting);
            if ($remaining !== null && $remaining <= 0) {
                return ['match' => null, 'error' => 'You have reached the hourly limit for this game. Please try again later.'];
            }

            // The friend must put in the same points as the host.
            $stake = (int) $match->stake;
            if ($stake > 0) {
                $balance = (int) User::where('id', $user->id)->value('points');
                if ($balance < $stake) {
                    return [
                        'match' => null,
                        'error' => 'You do not have enough points to join this game. You need ' . $stake . ' point(s) but your balance is ' . $balance . '. Please add points to your account and try again.',
                        'low_balance' => ['need' => $stake, 'balance' => $balance],
                    ];
                }

                User::where('id', $user->id)->decrement('points', $stake);
            }

            $play = $this->newPlay($user->id, 'online-' . $match->size . 'x' . $match->size, $ip);

            $match->o_user_id = $user->id;
            $match->o_play_id = $play->id;
            $match->o_ip = $ip;
            $match->status = 'active';
            $match->turn = 'X';
            $match->fee_percent = $this->feePercent($setting);   // fixed for this match from now on
            $match->declined_at = null;
            $match->last_move_at = now();
            $match->save();

            return ['match' => $match, 'error' => null];
        });
    }

    protected function cleanCode($raw)
    {
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string) $raw));
    }

    protected function findRoom($code, $lock = true)
    {
        $q = TictactoeMatch::where('code', $code)
            ->where('mode', 'online')
            ->whereIn('status', ['waiting', 'active'])
            ->orderBy('id', 'desc');

        if ($lock) {
            $q->lockForUpdate();
        }

        return $q->first();
    }

    /**
     * Common checks before a player may open a new match.
     * Also closes whatever match they left unfinished.
     */
    protected function cannotStart($userId, $size, GameSetting $setting)
    {
        if (! $setting->is_active) {
            return 'This game is currently unavailable.';
        }

        if (! TicTacToeEngine::isValidSize($size)) {
            return 'Please choose a grid size.';
        }

        // Serialise this user's starts so two quick taps cannot both slip in.
        User::where('id', $userId)->lockForUpdate()->value('points');

        $this->closeUnfinished($userId, $setting);

        $remaining = $this->games->remaining($userId, $setting);
        if ($remaining !== null && $remaining <= 0) {
            return 'You have reached the hourly limit for this game. Please try again later.';
        }

        return null;
    }

    protected function newPlay($userId, $label, $ip)
    {
        return GamePlay::create([
            'user_id' => $userId,
            'game_key' => self::GAME_KEY,
            'choice' => $label,        // e.g. "ai-3x3" / "online-5x5" (shown in the admin play log)
            'is_win' => 0,
            'ad_duration' => 0,
            'status' => 'pending',
            'ip_address' => $ip,
        ]);
    }

    protected function freshCode()
    {
        $chars = self::CODE_CHARS;
        $max = strlen($chars) - 1;

        for ($try = 0; $try < 20; $try++) {
            $code = '';
            for ($i = 0; $i < 6; $i++) {
                $code .= $chars[mt_rand(0, $max)];
            }

            $taken = TictactoeMatch::where('code', $code)
                ->whereIn('status', ['waiting', 'active'])
                ->exists();

            if (! $taken) {
                return $code;
            }
        }

        // Practically impossible; make it longer rather than fail.
        return $code . $chars[mt_rand(0, $max)] . $chars[mt_rand(0, $max)];
    }

    /* ------------------------------------------------------------------
     | Playing
     * ---------------------------------------------------------------- */

    /**
     * The player clicked a cell.
     *
     * @return array ['match' => TictactoeMatch|null, 'error' => string|null, 'ai_cell' => int|null]
     */
    public function move(User $user, $matchId, $cell)
    {
        return DB::transaction(function () use ($user, $matchId, $cell) {
            $setting = $this->setting();

            $match = TictactoeMatch::where('id', $matchId)->lockForUpdate()->first();
            if (! $match || ! $match->symbolOf($user->id)) {
                return ['match' => null, 'error' => 'Match not found.', 'ai_cell' => null];
            }

            $this->applyTimeouts($match, $setting);

            if ($match->status === 'waiting') {
                return ['match' => $match, 'error' => 'Waiting for your friend to join.', 'ai_cell' => null];
            }

            // Finished meanwhile (timeout, opponent left): the caller shows the result.
            if ($match->status !== 'active') {
                return ['match' => $match, 'error' => null, 'ai_cell' => null];
            }

            $symbol = $match->symbolOf($user->id);
            if ($match->turn !== $symbol) {
                return ['match' => $match, 'error' => "It's not your turn.", 'ai_cell' => null];
            }

            $cell = filter_var($cell, FILTER_VALIDATE_INT);
            $cells = $match->size * $match->size;
            if ($cell === false || $cell < 0 || $cell >= $cells || $match->board[$cell] !== '-') {
                return ['match' => $match, 'error' => 'That square is already taken.', 'ai_cell' => null];
            }

            $aiCell = null;

            $match->board = TicTacToeEngine::place($match->board, $cell, $symbol);
            $match->last_cell = $cell;
            $match->last_move_at = now();

            $e = TicTacToeEngine::evaluate($match->board, $match->size, $match->win_len);

            if ($e['status'] === 'win') {
                $this->finish($match, $symbol, 'line', $e['cells'], $setting);
            } elseif ($e['status'] === 'draw') {
                $this->finish($match, 'draw', 'draw', [], $setting);
            } elseif ($match->isAi()) {
                // The computer (always O) answers straight away.
                $aiCell = TicTacToeEngine::computerMove($match->board, $match->size, $match->win_len, 'O', $this->aiMistakePercent($setting));
                $match->board = TicTacToeEngine::place($match->board, $aiCell, 'O');
                $match->last_cell = $aiCell;

                $e = TicTacToeEngine::evaluate($match->board, $match->size, $match->win_len);
                if ($e['status'] === 'win') {
                    $this->finish($match, 'O', 'line', $e['cells'], $setting);
                } elseif ($e['status'] === 'draw') {
                    $this->finish($match, 'draw', 'draw', [], $setting);
                } else {
                    $match->turn = 'X';
                    $match->save();
                }
            } else {
                $match->turn = TicTacToeEngine::other($symbol);
                $match->save();
            }

            return ['match' => $match, 'error' => null, 'ai_cell' => $aiCell];
        });
    }

    /**
     * Current state of a match for one of its players (used for polling).
     * Cheap when nothing is due: it only takes a lock if a timeout has to be applied.
     *
     * @return TictactoeMatch|null
     */
    public function state(User $user, $matchId)
    {
        $match = TictactoeMatch::where('id', $matchId)->first();
        if (! $match || ! $match->symbolOf($user->id)) {
            return null;
        }

        if ($this->timeoutDue($match, $this->setting())) {
            return DB::transaction(function () use ($user, $matchId) {
                $locked = TictactoeMatch::where('id', $matchId)->lockForUpdate()->first();
                if ($locked) {
                    $this->applyTimeouts($locked, $this->setting());
                }

                return $locked;
            });
        }

        return $match;
    }

    /**
     * The player pressed Leave (or opened another match).
     */
    public function leave(User $user, $matchId)
    {
        return DB::transaction(function () use ($user, $matchId) {
            $match = TictactoeMatch::where('id', $matchId)->lockForUpdate()->first();
            if (! $match || ! $match->symbolOf($user->id)) {
                return null;
            }

            $this->leaveLocked($match, $user->id, $this->setting());

            return $match;
        });
    }

    /* ------------------------------------------------------------------
     | Ending matches
     * ---------------------------------------------------------------- */

    protected function timeoutDue(TictactoeMatch $m, GameSetting $s)
    {
        if ($m->status === 'waiting') {
            return $m->created_at && $m->created_at->lt(now()->subMinutes($this->roomMinutes($s)));
        }

        if ($m->status === 'active' && $m->mode === 'online') {
            $last = $m->last_move_at ?: $m->updated_at;

            return $last && $last->lt(now()->subSeconds($this->moveSeconds($s)));
        }

        return false;
    }

    /**
     * Expired room -> cancelled (host gets his points back). Online player who
     * ran out of time -> loses. Call with the match row locked.
     */
    protected function applyTimeouts(TictactoeMatch $m, GameSetting $s)
    {
        if (! $this->timeoutDue($m, $s)) {
            return;
        }

        if ($m->status === 'waiting') {
            $this->cancelWaiting($m, 'timeout');

            return;
        }

        // The player whose turn it is took too long.
        $this->finish($m, TicTacToeEngine::other($m->turn), 'timeout', [], $s);
    }

    /**
     * A room nobody joined: close it, give the host his points back and take
     * its play out of the hourly count (no game was played).
     * Call with the match row locked.
     */
    protected function cancelWaiting(TictactoeMatch $m, $reason)
    {
        if ((int) $m->stake > 0 && ! $m->settled) {
            User::where('id', $m->x_user_id)->increment('points', (int) $m->stake);
            $m->settled = 1;
        }

        if ($m->x_play_id) {
            GamePlay::where('id', $m->x_play_id)->where('status', 'pending')->delete();
        }

        $m->status = 'cancelled';
        $m->end_reason = $reason;
        $m->save();
    }

    /**
     * A player gives up. Call with the match row locked.
     */
    protected function leaveLocked(TictactoeMatch $m, $userId, GameSetting $s)
    {
        if ($m->status === 'waiting') {
            $this->cancelWaiting($m, 'left');

            return;
        }

        if ($m->status !== 'active') {
            return;
        }

        $symbol = $m->symbolOf($userId);
        // Leaving a match hands the win to the other side (the computer, or the friend).
        $this->finish($m, TicTacToeEngine::other($symbol ?: 'X'), 'left', [], $s);
    }

    /**
     * End every unfinished match of this user (before they open a new one).
     */
    protected function closeUnfinished($userId, GameSetting $s)
    {
        $matches = TictactoeMatch::where(function ($q) use ($userId) {
                $q->where('x_user_id', $userId)->orWhere('o_user_id', $userId);
            })
            ->whereIn('status', ['waiting', 'active'])
            ->lockForUpdate()
            ->get();

        foreach ($matches as $m) {
            $this->leaveLocked($m, $userId, $s);
        }
    }

    /**
     * Finish the match and pay out. $winner is 'X', 'O' or 'draw'.
     * Saves the match. Call with the match row locked.
     *
     *  vs computer : the player gets "points for beating the computer".
     *  online      : the winner gets (2 x stake) minus the fee percent, a draw
     *                returns each player's stake. The stakes were already taken
     *                from both balances, so a loser simply does not get his back.
     */
    protected function finish(TictactoeMatch $m, $winner, $reason, array $cells, GameSetting $s)
    {
        $m->status = 'finished';
        $m->winner = $winner;
        $m->end_reason = $reason;
        $m->win_cells = $cells ? implode(',', $cells) : null;

        $isAi = $m->isAi();
        $stake = (int) $m->stake;
        $money = ! $isAi && $stake > 0 && ! $m->settled;   // are there held stakes to pay out?
        $payout = $this->payoutFor($stake, (int) $m->fee_percent);

        $paid = 0;
        $players = [
            ['X', $m->x_user_id, $m->x_play_id],
            ['O', $m->o_user_id, $m->o_play_id],
        ];

        foreach ($players as $p) {
            list($symbol, $userId, $playId) = $p;
            if (! $userId || ! $playId) {
                continue; // the computer has no account
            }

            $play = GamePlay::where('id', $playId)->lockForUpdate()->first();
            if (! $play || in_array($play->status, ['completed', 'draw'], true)) {
                continue;
            }

            $play->completed_at = now();
            $credit = 0;   // points put on the player's balance now
            $net = 0;      // what the match changed for him overall (shown in his history)

            if ($winner === 'draw') {
                // Not "completed" so it does not show up as a loss in the history,
                // but it still counts towards the hourly limit.
                $play->status = 'draw';
                $play->outcome = 'draw';
                $play->is_win = 0;
                if ($money) {
                    $credit = $stake;   // his own stake comes back, net change is 0
                }
            } elseif ($winner === $symbol) {
                $play->status = 'completed';
                $play->outcome = 'win';
                $play->is_win = 1;
                if ($isAi) {
                    $credit = $this->aiPoints($s);
                    $net = $credit;
                } elseif ($money) {
                    $credit = $payout;
                    $net = $payout - $stake;
                }
                $paid = $credit;
            } else {
                $play->status = 'completed';
                $play->outcome = 'lose';
                $play->is_win = 0;
                if ($money) {
                    $net = -$stake;
                }
            }

            $play->points_awarded = max(0, $net);
            $play->points_change = $net;
            $play->save();

            if ($credit > 0) {
                User::where('id', $userId)->increment('points', $credit);
            }
        }

        if ($money) {
            $m->settled = 1;
        }
        $m->points_awarded = $paid;
        $m->save();
    }

    /**
     * What the winner receives: both stakes minus the fee percent (rounded down for the fee).
     */
    public function payoutFor($stake, $feePercent)
    {
        $pot = max(0, (int) $stake) * 2;
        $fee = (int) floor($pot * max(0, min(100, (int) $feePercent)) / 100);

        return $pot - $fee;
    }

    /* ------------------------------------------------------------------
     | What the browser gets
     * ---------------------------------------------------------------- */

    /**
     * What the friend sees in the "Join this game?" dialog.
     */
    public function roomInfo(TictactoeMatch $m, $balance, $rejoin)
    {
        $s = $this->setting();
        $stake = (int) $m->stake;
        $feeP = $this->feePercent($s);
        $payout = $this->payoutFor($stake, $feeP);

        return [
            'code' => $m->code,
            'size' => (int) $m->size,
            'win_len' => (int) $m->win_len,
            'host' => $this->shortName(User::where('id', $m->x_user_id)->value('name')),
            'stake' => $stake,
            'pot' => $stake * 2,
            'fee_percent' => $feeP,
            'fee_amount' => $stake * 2 - $payout,
            'payout' => $payout,
            'balance' => (int) $balance,
            'enough' => (int) $balance >= $stake,
            'rejoin' => (bool) $rejoin,
        ];
    }

    public function payload(TictactoeMatch $m, $viewerId)
    {
        $s = $this->setting();
        $symbol = $m->symbolOf($viewerId);

        $opponent = null;
        if ($m->isAi()) {
            $opponent = 'Computer';
        } else {
            $oppId = $symbol === 'X' ? $m->o_user_id : $m->x_user_id;
            if ($oppId) {
                $opponent = $this->shortName(User::where('id', $oppId)->value('name'));
            }
        }

        $result = null;
        if ($m->status === 'finished') {
            $result = $m->winner === 'draw' ? 'draw' : ($m->winner === $symbol ? 'win' : 'lose');
        }

        $moveLeft = null;
        if ($m->status === 'active' && ! $m->isAi()) {
            $elapsed = $m->last_move_at ? (int) now()->diffInSeconds($m->last_move_at) : 0;
            $moveLeft = max(0, $this->moveSeconds($s) - $elapsed);
        }

        // Points: what each player put in, the pot and what the winner receives.
        $stake = $m->isAi() ? 0 : (int) $m->stake;
        $feeP = $m->status === 'waiting' ? $this->feePercent($s) : (int) $m->fee_percent;
        $payout = $this->payoutFor($stake, $feeP);

        $net = 0;
        if ($m->isAi()) {
            $net = $result === 'win' ? (int) $m->points_awarded : 0;
        } elseif ($result === 'win') {
            $net = $payout - $stake;
        } elseif ($result === 'lose') {
            $net = -$stake;
        }

        // Only the host is told that a friend said no to the points.
        $declined = null;
        if ($symbol === 'X' && $m->status === 'waiting' && $m->declined_at) {
            $declined = ['name' => $m->declined_name ?: 'Player', 'at' => $m->declined_at->getTimestamp()];
        }

        return [
            'id' => $m->id,
            'mode' => $m->mode,
            'size' => (int) $m->size,
            'win_len' => (int) $m->win_len,
            'board' => $m->board,
            'turn' => $m->turn,
            'status' => $m->status,
            'you' => $symbol,
            'opponent' => $opponent,
            'code' => ($symbol === 'X' && $m->status === 'waiting') ? $m->code : null,
            'winner' => $m->winner,
            'result' => $result,
            'reason' => $m->end_reason,
            'win_cells' => ($m->win_cells !== null && $m->win_cells !== '') ? array_map('intval', explode(',', $m->win_cells)) : [],
            'last_cell' => $m->last_cell,
            'move_left' => $moveLeft,
            'move_seconds' => $this->moveSeconds($s),
            'stake' => $stake,
            'pot' => $stake * 2,
            'fee_percent' => $feeP,
            'fee_amount' => $stake * 2 - $payout,
            'payout' => $payout,
            'points' => ($result === 'win') ? (int) $m->points_awarded : 0,
            'net' => $net,
            'declined' => $declined,
            'balance' => (int) User::where('id', $viewerId)->value('points'),
        ];
    }

    /**
     * Only the first name is shown to the other player.
     */
    protected function shortName($name)
    {
        $name = trim((string) $name);
        if ($name === '') {
            return 'Player';
        }

        $parts = preg_split('/\s+/', $name);

        return mb_substr($parts[0], 0, 14);
    }
}
