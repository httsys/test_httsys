<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One row per mini game holding the rules the admin controls:
 * how often the user wins ("win_percent" wins out of every "win_block"
 * plays), the plays-per-hour limit, and game specific options.
 */
class GameSetting extends Model
{
    protected $fillable = [
        'game_key', 'name', 'win_percent', 'win_block', 'hourly_limit', 'points_per_win', 'is_active', 'options',
    ];

    protected $casts = [
        'win_percent' => 'integer',
        'win_block' => 'integer',
        'hourly_limit' => 'integer',
        'points_per_win' => 'integer',
        'is_active' => 'boolean',
        'options' => 'array',
    ];

    /**
     * Every game the site offers. game_key is what is stored in the DB,
     * slug is what appears in the public URL.
     */
    public static $games = [
        'spin_wheel' => ['name' => 'Spin The Wheel', 'slug' => 'spin-the-wheel', 'tagline' => 'Spin to win amazing rewards!'],
        'flip_coin' => ['name' => 'Flip The Coin', 'slug' => 'flip-the-coin', 'tagline' => 'Pick a side and test your luck!'],
        'three_numbers' => ['name' => '3 Numbers', 'slug' => '3-numbers', 'tagline' => 'Spin the reels - the 3-digit number you land on is your points!'],
        'up_down' => ['name' => 'Up or Down', 'slug' => 'up-or-down', 'tagline' => 'Will the price finish higher or lower? Stake your points!'],
    ];

    /**
     * Trade game: the durations a player can choose (seconds => label).
     */
    public static $tradeDurations = [
        10 => '10 seconds',
        30 => '30 seconds',
        60 => '1 minute',
        300 => '5 minutes',
    ];

    /**
     * Starting values for game specific options.
     */
    public static function defaultOptions($key)
    {
        // show_ad: whether the advertisement page (countdown + maths question) comes before the result
        $options = ['show_ad' => true];

        if ($key === 'three_numbers') {
            $options['prizes'] = [1, 2, 5, 10, 20, 50, 100];
        } elseif ($key === 'up_down') {
            $options['min_stake'] = 1;
            $options['max_stake'] = 100;
            $options['payout_percent'] = 100;
        }

        return $options;
    }

    /**
     * Does this game send the player through the advertisement page first?
     */
    public function showsAd()
    {
        return (bool) $this->option('show_ad', true);
    }

    /**
     * Read one game specific option (falls back to the default).
     */
    public function option($name, $fallback = null)
    {
        $options = is_array($this->options) ? $this->options : [];

        if (array_key_exists($name, $options) && $options[$name] !== null && $options[$name] !== []) {
            return $options[$name];
        }

        $defaults = self::defaultOptions($this->game_key);

        return array_key_exists($name, $defaults) ? $defaults[$name] : $fallback;
    }

    /**
     * Wins per block, never more than the block itself.
     */
    public function winsPerBlock()
    {
        return max(0, min((int) $this->win_percent, $this->blockSize()));
    }

    public function blockSize()
    {
        return max(1, (int) ($this->win_block ?: 100));
    }

    /**
     * Fetch the settings row for a game, creating it with safe defaults
     * the first time it is needed (so nothing has to be seeded).
     */
    public static function forGame($key)
    {
        if (! isset(self::$games[$key])) {
            return null;
        }

        return self::firstOrCreate(
            ['game_key' => $key],
            [
                'name' => self::$games[$key]['name'],
                'win_percent' => 30,
                'win_block' => 100,
                'hourly_limit' => 10,
                'points_per_win' => 1,
                'is_active' => true,
                'options' => self::defaultOptions($key),
            ]
        );
    }

    public static function keyFromSlug($slug)
    {
        foreach (self::$games as $key => $game) {
            if ($game['slug'] === $slug) {
                return $key;
            }
        }

        return null;
    }
}
