<?php

namespace App\Services;

use App\Models\GameAd;
use App\Models\GamePlay;
use App\Models\GameSetting;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * All of the mini-game rules live here so the controller stays thin:
 *
 *  1. start()        - checks the hourly limit, claims an ad, and decides
 *                      (server side, hidden from the player) win or lose.
 *  2. markAdLoaded() - the countdown only starts once the ad page has loaded.
 *  3. newQuestion()  - after the countdown, a simple addition question.
 *  4. submitAnswer() - a correct answer completes the play, reveals the
 *                      result and adds points on a win.
 */
class MiniGameService
{
    /** An unfinished play can be resumed (e.g. after a page refresh) for this long. */
    const PENDING_TTL_MINUTES = 15;

    /** Win percentage is enforced over blocks of this many plays per user per game. */
    const BLOCK_SIZE = 100;

    /**
     * How many plays this user has started for a game in the last 60 minutes.
     */
    public function playsInLastHour($userId, $gameKey)
    {
        return GamePlay::where('user_id', $userId)
            ->where('game_key', $gameKey)
            ->where('created_at', '>=', now()->subHour())
            ->count();
    }

    /**
     * Plays left this hour, or null when the game has no hourly limit.
     */
    public function remaining($userId, GameSetting $setting)
    {
        if ($setting->hourly_limit <= 0) {
            return null;
        }

        return max(0, $setting->hourly_limit - $this->playsInLastHour($userId, $setting->game_key));
    }

    /**
     * Whether the user has an unfinished play they can still resume.
     */
    public function hasPending($userId, $gameKey)
    {
        return GamePlay::where('user_id', $userId)
            ->where('game_key', $gameKey)
            ->where('status', 'pending')
            ->where('created_at', '>=', now()->subMinutes(self::PENDING_TTL_MINUTES))
            ->exists();
    }

    /**
     * Begin a play (or resume the user's unfinished one).
     *
     * $input carries what the player chose: 'choice' (coin: heads|tails),
     * or 'direction' / 'stake' / 'seconds' (Up or Down trade).
     *
     * @return array ['play' => GamePlay|null, 'error' => string|null]
     */
    public function start(User $user, $gameKey, array $input, $ip)
    {
        $setting = GameSetting::forGame($gameKey);

        if (! $setting || ! $setting->is_active) {
            return ['play' => null, 'error' => 'This game is currently unavailable.'];
        }

        return DB::transaction(function () use ($user, $gameKey, $input, $ip, $setting) {
            // Serialise this user's starts so two quick taps cannot both
            // slip in under the hourly limit (also gives us a fresh balance).
            $balance = (int) User::where('id', $user->id)->lockForUpdate()->value('points');

            $picked = $this->readChoice($gameKey, $setting, $input, $balance);
            if (is_string($picked)) {
                return ['play' => null, 'error' => $picked];
            }

            $pending = GamePlay::where('user_id', $user->id)
                ->where('game_key', $gameKey)
                ->where('status', 'pending')
                ->where('created_at', '>=', now()->subMinutes(self::PENDING_TTL_MINUTES))
                ->orderBy('id', 'desc')
                ->first();

            if ($pending) {
                // Same play, the user just reopened it. The win/lose result is
                // fixed already; they may only change what they picked.
                if ($gameKey === 'flip_coin') {
                    $pending->choice = $picked['choice'];
                    $pending->outcome = $pending->is_win ? $picked['choice'] : $this->oppositeSide($picked['choice']);
                } elseif ($gameKey === 'up_down') {
                    $pending->direction = $picked['direction'];
                    $pending->stake = $picked['stake'];
                    $pending->trade_seconds = $picked['seconds'];
                    $pending->outcome = $pending->is_win ? $picked['direction'] : $this->oppositeDirection($picked['direction']);
                }
                $pending->save();

                // The advertisement was switched off since this play began: finish it now.
                if (! $setting->showsAd()) {
                    $this->settle($pending, $setting, $user->id);
                }

                return ['play' => $pending, 'error' => null];
            }

            $remaining = $this->remaining($user->id, $setting);
            if ($remaining !== null && $remaining <= 0) {
                return ['play' => null, 'error' => 'You have reached the hourly limit for this game. Please try again later.'];
            }

            $showAd = $setting->showsAd();
            $ad = null;
            if ($showAd) {
                $ad = $this->claimAd();
                if (! $ad) {
                    return ['play' => null, 'error' => 'No advertisement is available right now. Please try again later.'];
                }
            }

            $isWin = $this->decideWin($user->id, $setting);

            $data = [
                'user_id' => $user->id,
                'game_key' => $gameKey,
                'ad_id' => $ad ? $ad->id : null,
                'is_win' => $isWin,
                'ad_duration' => $ad ? max(1, (int) $ad->duration) : 0,
                'status' => 'pending',
                'points_awarded' => 0,
                'points_change' => 0,
                'ip_address' => $ip,
            ];

            if ($gameKey === 'flip_coin') {
                $data['choice'] = $picked['choice'];
                $data['outcome'] = $isWin ? $picked['choice'] : $this->oppositeSide($picked['choice']);
            } elseif ($gameKey === 'up_down') {
                $data['direction'] = $picked['direction'];
                $data['stake'] = $picked['stake'];
                $data['trade_seconds'] = $picked['seconds'];
                $data['outcome'] = $isWin ? $picked['direction'] : $this->oppositeDirection($picked['direction']);
            } elseif ($gameKey === 'three_numbers') {
                // The number on the reels is the points won; 000 when it is a loss.
                $data['outcome'] = str_pad((string) ($isWin ? $this->pickPrize($setting) : 0), 3, '0', STR_PAD_LEFT);
            }

            $play = GamePlay::create($data);

            // Advertisement off for this game: no ad page, no countdown, no maths question.
            if (! $showAd) {
                $this->settle($play, $setting, $user->id);
            }

            return ['play' => $play, 'error' => null];
        });
    }

    /**
     * Validate what the player picked for this game.
     * Returns an error message (string) or the cleaned-up choice (array).
     */
    protected function readChoice($gameKey, GameSetting $setting, array $input, $balance)
    {
        if ($gameKey === 'flip_coin') {
            $choice = isset($input['choice']) ? $input['choice'] : null;
            if (! in_array($choice, ['heads', 'tails'], true)) {
                return 'Please choose Heads or Tails.';
            }

            return ['choice' => $choice];
        }

        if ($gameKey === 'up_down') {
            $direction = isset($input['direction']) ? $input['direction'] : null;
            if (! in_array($direction, ['up', 'down'], true)) {
                return 'Please choose Higher or Lower.';
            }

            $seconds = isset($input['seconds']) ? (int) $input['seconds'] : 0;
            if (! isset(GameSetting::$tradeDurations[$seconds])) {
                return 'Please choose a valid duration.';
            }

            $min = max(1, (int) $setting->option('min_stake', 1));
            $max = max($min, (int) $setting->option('max_stake', 100));
            $stake = isset($input['stake']) ? (int) $input['stake'] : 0;

            if ($stake < $min || $stake > $max) {
                return 'Your amount must be between ' . $min . ' and ' . $max . ' points.';
            }
            if ($stake > $balance) {
                return 'You do not have enough points. Your balance is ' . $balance . ' point(s).';
            }

            return ['direction' => $direction, 'stake' => $stake, 'seconds' => $seconds];
        }

        return [];
    }

    protected function oppositeDirection($direction)
    {
        return $direction === 'up' ? 'down' : 'up';
    }

    /**
     * 3 Numbers: choose the number shown on a winning play from the
     * admin's prize list (repeat a number in the list to make it likelier).
     */
    protected function pickPrize(GameSetting $setting)
    {
        $prizes = array_values(array_filter((array) $setting->option('prizes', [1]), function ($n) {
            return (int) $n >= 1 && (int) $n <= 999;
        }));

        if (! $prizes) {
            return 1;
        }

        return (int) $prizes[mt_rand(0, count($prizes) - 1)];
    }

    protected function oppositeSide($side)
    {
        return $side === 'heads' ? 'tails' : 'heads';
    }

    /**
     * Pick a random ad that still has views left and count this showing
     * against its "Maximum Show" limit. The increment is a single guarded
     * UPDATE so two players can never push an ad past its limit.
     */
    protected function claimAd()
    {
        for ($i = 0; $i < 5; $i++) {
            $ad = GameAd::available()->inRandomOrder()->first();

            if (! $ad) {
                return null;
            }

            $claimed = GameAd::where('id', $ad->id)
                ->where('is_active', 1)
                ->whereRaw('(max_show = 0 OR shown_count < max_show)')
                ->increment('shown_count');

            if ($claimed) {
                return $ad;
            }
        }

        return null;
    }

    /**
     * Decide win/lose for a new play.
     *
     * The admin sets "W wins out of every N plays" (30 out of 100, 2 out
     * of 5 ...). That is honoured exactly for each user and game: in every
     * block of N plays the user gets exactly W wins, in random order. No
     * extra storage is needed - we look at how many plays and wins the user
     * already has in the current block and pick the odds that still make
     * the block come out right.
     */
    public function decideWin($userId, GameSetting $setting)
    {
        $block = $setting->blockSize();
        $target = $setting->winsPerBlock();

        if ($target <= 0) {
            return false;
        }
        if ($target >= $block) {
            return true;
        }

        $total = GamePlay::where('user_id', $userId)
            ->where('game_key', $setting->game_key)
            ->count();

        $position = $total % $block;
        $winsSoFar = 0;

        if ($position > 0) {
            $winsSoFar = GamePlay::where('user_id', $userId)
                ->where('game_key', $setting->game_key)
                ->orderBy('id')
                ->skip($total - $position)
                ->take($position)
                ->get(['id', 'is_win'])
                ->filter(function ($play) {
                    return $play->is_win;
                })
                ->count();
        }

        $winsNeeded = $target - $winsSoFar;
        $playsLeft = $block - $position;

        if ($winsNeeded <= 0) {
            return false;
        }
        if ($winsNeeded >= $playsLeft) {
            return true;
        }

        return mt_rand(1, $playsLeft) <= $winsNeeded;
    }

    /**
     * Seconds of countdown still to go. Only time the player really spent
     * watching counts (page visible, mouse on the page), as reported by
     * recordProgress(); full duration until the ad has loaded.
     */
    public function secondsLeft(GamePlay $play)
    {
        if (! $play->ad_loaded_at) {
            return (int) $play->ad_duration;
        }

        return max(0, (int) $play->ad_duration - (int) $play->ad_progress);
    }

    /**
     * The ad page reports how many seconds the player has actively watched.
     * It can never be more than the real time since the ad loaded, and it
     * only ever goes up, so refreshing the page resumes where they were.
     */
    public function recordProgress(GamePlay $play, $seconds)
    {
        if ($play->status !== 'pending' || ! $play->ad_loaded_at) {
            return $this->secondsLeft($play);
        }

        $wall = max(0, time() - $play->ad_loaded_at->getTimestamp()) + 1;
        $progress = min(max(0, (int) $seconds), $wall, (int) $play->ad_duration);

        if ($progress > (int) $play->ad_progress) {
            $play->ad_progress = $progress;
            $play->save();
        }

        return $this->secondsLeft($play);
    }

    /**
     * The player pressed Leave: this play is closed for good. It still
     * counts towards the hourly limit and its result is never revealed.
     */
    public function abandon($playId, $userId)
    {
        return GamePlay::where('id', $playId)
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->update(['status' => 'abandoned']);
    }

    /**
     * The ad page reports that it has fully loaded: this is the moment the
     * countdown starts. Calling it again (refresh) does not restart it.
     */
    public function markAdLoaded(GamePlay $play)
    {
        if ($play->status === 'pending' && ! $play->ad_loaded_at) {
            $play->ad_loaded_at = now();
            $play->save();
        }

        return $this->secondsLeft($play);
    }

    /**
     * Give the player an addition question (a fresh one each call).
     * Returns null while the countdown has not finished.
     */
    public function newQuestion(GamePlay $play)
    {
        if ($play->status !== 'pending' || ! $play->ad_loaded_at || $this->secondsLeft($play) > 1) {
            return null;
        }

        if ($play->math_a === null || $play->math_b === null) {
            $play->math_a = mt_rand(2, 15);
            $play->math_b = mt_rand(2, 15);
            $play->save();
        }

        return $play->math_a . ' + ' . $play->math_b;
    }

    /**
     * Check the player's answer. A correct one completes the play, reveals
     * the result and adds the points when it is a win.
     *
     * @return array
     */
    public function submitAnswer($playId, $userId, $answer)
    {
        return DB::transaction(function () use ($playId, $userId, $answer) {
            $play = GamePlay::where('id', $playId)
                ->where('user_id', $userId)
                ->lockForUpdate()
                ->first();

            if (! $play) {
                return ['ok' => false, 'code' => 'not_found', 'message' => 'This game session was not found.'];
            }

            // Already finished (double tap / refresh): just show the same result again.
            if ($play->isCompleted()) {
                return ['ok' => true, 'result' => $this->resultPayload($play)];
            }

            if ($play->status !== 'pending') {
                return ['ok' => false, 'code' => 'abandoned', 'message' => 'This game session was closed.'];
            }

            if (! $play->ad_loaded_at || $this->secondsLeft($play) > 1) {
                return [
                    'ok' => false,
                    'code' => 'too_early',
                    'message' => 'Please wait for the countdown to finish.',
                    'seconds_left' => $this->secondsLeft($play),
                ];
            }

            if ($play->math_a === null || $play->math_b === null) {
                return ['ok' => false, 'code' => 'no_question', 'message' => 'Please request the question first.'];
            }

            if (! is_numeric($answer) || (int) $answer !== ($play->math_a + $play->math_b)) {
                $play->math_attempts = $play->math_attempts + 1;
                $play->math_a = mt_rand(2, 15);
                $play->math_b = mt_rand(2, 15);
                $play->save();

                return [
                    'ok' => false,
                    'code' => 'wrong',
                    'message' => 'Wrong answer. Please try this one.',
                    'question' => $play->math_a . ' + ' . $play->math_b,
                ];
            }

            $this->settle($play, GameSetting::forGame($play->game_key), $userId);

            return ['ok' => true, 'result' => $this->resultPayload($play)];
        });
    }

    /**
     * Work out the points for a finished play, close it and pay / charge the
     * player. Called once the ad + maths question were passed, or straight
     * away for a game that has the advertisement turned off.
     * Must run inside a transaction (the caller holds the user row lock).
     */
    protected function settle(GamePlay $play, $setting, $userId)
    {
        $change = 0;

        if ($play->game_key === 'three_numbers') {
            $change = $play->is_win ? (int) $play->outcome : 0;
        } elseif ($play->game_key === 'up_down') {
            if ($play->is_win) {
                $payout = max(0, (int) ($setting ? $setting->option('payout_percent', 100) : 100));
                $change = max(1, (int) round($play->stake * $payout / 100));
            } else {
                // Lose the stake, but never more than the balance the player has.
                $balance = (int) User::where('id', $userId)->lockForUpdate()->value('points');
                $change = -min((int) $play->stake, $balance);
            }
        } else {
            $change = ($play->is_win && $setting) ? max(0, (int) $setting->points_per_win) : 0;
        }

        $play->status = 'completed';
        $play->completed_at = now();
        $play->points_awarded = max(0, $change);
        $play->points_change = $change;
        $play->save();

        if ($change > 0) {
            User::where('id', $userId)->increment('points', $change);
        } elseif ($change < 0) {
            User::where('id', $userId)->decrement('points', -$change);
        }
    }

    /**
     * What the game page needs to animate and announce the result.
     */
    public function resultPayload(GamePlay $play)
    {
        $elapsed = 0;
        if ($play->completed_at) {
            $elapsed = max(0, time() - $play->completed_at->getTimestamp());
        }

        return [
            'win' => (bool) $play->is_win,
            'points' => (int) $play->points_awarded,
            'change' => $play->netPoints(),
            'choice' => $play->choice,
            'outcome' => $play->outcome,
            'direction' => $play->direction,
            'stake' => (int) $play->stake,
            'seconds' => (int) $play->trade_seconds,
            'seed' => (int) $play->id,
            'elapsed' => $elapsed,
            'balance' => (int) User::where('id', $play->user_id)->value('points'),
        ];
    }
}
