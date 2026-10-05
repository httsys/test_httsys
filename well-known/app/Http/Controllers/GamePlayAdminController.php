<?php

namespace App\Http\Controllers;

use App\Models\GamePlay;
use App\Models\GameSetting;
use Illuminate\Http\Request;

/**
 * Read-only log of every mini game play, so the admin can see who is
 * playing, how often they win and how many points have been handed out.
 */
class GamePlayAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = GamePlay::with(['user', 'ad'])->where('status', 'completed');

        if ($request->filled('game') && isset(GameSetting::$games[$request->input('game')])) {
            $query->where('game_key', $request->input('game'));
        }

        if ($request->input('result') === 'win') {
            $query->where('is_win', 1);
        } elseif ($request->input('result') === 'lose') {
            $query->where('is_win', 0);
        }

        if ($request->filled('q')) {
            $term = '%' . $request->input('q') . '%';
            $query->whereHas('user', function ($q) use ($term) {
                $q->where('name', 'like', $term)->orWhere('email', 'like', $term);
            });
        }

        $totals = [
            'plays' => GamePlay::where('status', 'completed')->count(),
            'wins' => GamePlay::where('status', 'completed')->where('is_win', 1)->count(),
            'points' => (int) GamePlay::where('status', 'completed')->sum('points_awarded'),
        ];

        $plays = $query->orderBy('id', 'desc')->paginate(30)->appends($request->only(['game', 'result', 'q']));

        return view('admin.games.plays', [
            'plays' => $plays,
            'totals' => $totals,
            'games' => GameSetting::$games,
        ]);
    }
}
