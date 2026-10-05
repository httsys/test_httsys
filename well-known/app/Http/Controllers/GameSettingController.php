<?php

namespace App\Http\Controllers;

use App\Models\GameAd;
use App\Models\GameSetting;
use Illuminate\Http\Request;

/**
 * Admin screen where each mini game's win rate, hourly play limit and
 * game specific options (3 Numbers prizes, Up or Down stake limits) are set.
 */
class GameSettingController extends Controller
{
    public function edit()
    {
        $settings = [];
        foreach (GameSetting::$games as $key => $game) {
            $settings[$key] = GameSetting::forGame($key);
        }

        return view('admin.games.settings', [
            'settings' => $settings,
            'games' => GameSetting::$games,
            'availableAds' => GameAd::available()->count(),
            'anyGameNeedsAd' => collect($settings)->contains(function ($setting) {
                return $setting->is_active && $setting->showsAd();
            }),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.win_percent' => 'required|integer|min:0|max:200',
            'settings.*.win_block' => 'required|integer|min:1|max:200',
            'settings.*.hourly_limit' => 'required|integer|min:0|max:100000',
            'settings.*.points_per_win' => 'nullable|integer|min:0|max:100000',
            'settings.three_numbers.prizes' => 'nullable|string|max:500',
            'settings.up_down.min_stake' => 'nullable|integer|min:1|max:1000000',
            'settings.up_down.max_stake' => 'nullable|integer|min:1|max:1000000',
            'settings.up_down.payout_percent' => 'nullable|integer|min:0|max:1000',
        ]);

        $errors = [];
        $updates = [];

        foreach (GameSetting::$games as $key => $game) {
            $input = $request->input('settings.' . $key);

            if (! is_array($input)) {
                continue;
            }

            $wins = (int) $input['win_percent'];
            $block = (int) $input['win_block'];

            if ($wins > $block) {
                $errors[] = $game['name'] . ': wins (' . $wins . ') cannot be more than the number of plays (' . $block . ').';
                continue;
            }

            $setting = GameSetting::forGame($key);
            $data = [
                'win_percent' => $wins,
                'win_block' => $block,
                'hourly_limit' => (int) $input['hourly_limit'],
                'is_active' => isset($input['is_active']),
            ];

            if (isset($input['points_per_win']) && $input['points_per_win'] !== '') {
                $data['points_per_win'] = (int) $input['points_per_win'];
            }

            $options = is_array($setting->options) ? $setting->options : [];
            $options['show_ad'] = isset($input['show_ad']);

            if ($key === 'three_numbers') {
                $prizes = [];
                $raw = isset($input['prizes']) ? trim($input['prizes']) : '';
                foreach (preg_split('/[\s,]+/', $raw, -1, PREG_SPLIT_NO_EMPTY) as $piece) {
                    if (! ctype_digit($piece) || (int) $piece < 1 || (int) $piece > 999) {
                        $errors[] = $game['name'] . ': every prize must be a whole number from 1 to 999 (got "' . $piece . '").';
                        $prizes = [];
                        break;
                    }
                    $prizes[] = (int) $piece;
                }
                if (! $prizes) {
                    if (! $errors) {
                        $errors[] = $game['name'] . ': please enter at least one prize number, for example 1, 2, 5, 10, 50, 100.';
                    }
                    continue;
                }
                $options['prizes'] = $prizes;
            }

            if ($key === 'up_down') {
                $min = isset($input['min_stake']) && $input['min_stake'] !== '' ? (int) $input['min_stake'] : 1;
                $max = isset($input['max_stake']) && $input['max_stake'] !== '' ? (int) $input['max_stake'] : 100;
                if ($max < $min) {
                    $errors[] = $game['name'] . ': the highest amount cannot be less than the lowest amount.';
                    continue;
                }
                $options['min_stake'] = $min;
                $options['max_stake'] = $max;
                $options['payout_percent'] = isset($input['payout_percent']) && $input['payout_percent'] !== '' ? (int) $input['payout_percent'] : 100;
            }

            $data['options'] = $options;
            $updates[] = [$setting, $data];
        }

        if ($errors) {
            return redirect()->route('game-settings.edit')->withErrors($errors)->withInput();
        }

        foreach ($updates as $pair) {
            $pair[0]->update($pair[1]);
        }

        return redirect()->route('game-settings.edit')->with('game_success', 'Game settings saved.');
    }
}
