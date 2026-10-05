<?php

namespace App\Http\Controllers;

use App\Models\GamePlay;
use App\Models\GameSetting;
use App\Models\HeaderFooterSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Services\MiniGameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * The player-facing side of the mini games: the game list, each game's
 * page, the full-page advertisement with its countdown, and the maths
 * question that unlocks the result.
 */
class MiniGameController extends Controller
{
    protected $games;

    public function __construct(MiniGameService $games)
    {
        // Anyone can browse the game list and a game's page; logging in is only
        // required to actually play (start, the ad page, and everything on it).
        $this->middleware('auth')->except(['index', 'show']);
        $this->games = $games;
    }

    /**
     * Same header/footer/menu data every front-end page needs to render
     * inside layouts.front (see the identical helper in ProfileController).
     */
    protected function frontData()
    {
        $currentLang = session()->has('lang')
            ? Language::where('code', session()->get('lang'))->first()
            : Language::where('is_default', 1)->first();

        $lang_id = $currentLang->id;

        return [
            'currentLang' => $currentLang,
            'langs' => Language::all(),
            'headerfooter' => HeaderFooterSetting::find($lang_id),
            'menus' => Menu::where('language_id', $lang_id)->get(),
        ];
    }

    /**
     * A play that belongs to the logged-in user, or 404.
     */
    protected function ownPlay($id)
    {
        return GamePlay::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    /**
     * Game list ("Mini Games" page).
     */
    public function index()
    {
        $user = Auth::user();
        $cards = [];

        foreach (GameSetting::$games as $key => $game) {
            $setting = GameSetting::forGame($key);
            $cards[] = [
                'key' => $key,
                'name' => $game['name'],
                'slug' => $game['slug'],
                'tagline' => $game['tagline'],
                'setting' => $setting,
                // A guest has no account to count plays against, so show the
                // configured limit itself rather than a per-user count.
                'remaining' => $user ? $this->games->remaining($user->id, $setting) : ($setting->hourly_limit ?: null),
            ];
        }

        return view('games.index', array_merge($this->frontData(), [
            'cards' => $cards,
            'points' => $user ? (int) $user->points : null,
            'isGuest' => ! $user,
        ]));
    }

    /**
     * One game's page. With ?play=ID it also shows (and animates) the
     * result of that finished play.
     */
    public function show(Request $request, $slug)
    {
        $key = GameSetting::keyFromSlug($slug);
        if (! $key) {
            abort(404);
        }

        $user = Auth::user();
        $setting = GameSetting::forGame($key);

        $result = null;
        if ($user && $request->filled('play')) {
            $play = GamePlay::where('id', (int) $request->input('play'))
                ->where('user_id', $user->id)
                ->where('game_key', $key)
                ->where('status', 'completed')
                ->first();

            if ($play) {
                $result = $this->games->resultPayload($play);
            }
        }

        $views = [
            'spin_wheel' => 'games.spin',
            'flip_coin' => 'games.coin',
            'three_numbers' => 'games.slot',
            'up_down' => 'games.trade',
        ];
        $view = $views[$key];

        $points = null;
        if ($user) {
            // While the result is still being revealed, show the balance from before this play
            // so the pill doesn't give the outcome away; the page updates it when the reveal ends.
            $points = (int) $user->points - ($result ? (int) $result['change'] : 0);
        }

        return view($view, array_merge($this->frontData(), [
            'setting' => $setting,
            'game' => GameSetting::$games[$key],
            'remaining' => $user ? $this->games->remaining($user->id, $setting) : ($setting->hourly_limit ?: null),
            'hasPending' => $user ? $this->games->hasPending($user->id, $key) : false,
            'result' => $result,
            'points' => $points,
            'isGuest' => ! $user,
        ]));
    }

    /**
     * "Spin to earn" / "Heads" / "Tails" was pressed: create the play and
     * send the player to the advertisement page.
     */
    public function start(Request $request, $slug)
    {
        $key = GameSetting::keyFromSlug($slug);
        if (! $key) {
            return response()->json(['ok' => false, 'message' => 'Game not found.'], 404);
        }

        $outcome = $this->games->start(Auth::user(), $key, $request->only(['choice', 'direction', 'stake', 'seconds']), $request->ip());

        if ($outcome['error']) {
            return response()->json(['ok' => false, 'message' => $outcome['error']], 422);
        }

        $play = $outcome['play'];

        // Advertisement turned off for this game: the play is already finished,
        // go straight to the result.
        if ($play->isCompleted()) {
            return response()->json([
                'ok' => true,
                'redirect' => route('games.show', ['slug' => GameSetting::$games[$key]['slug'], 'play' => $play->id]),
            ]);
        }

        return response()->json([
            'ok' => true,
            'redirect' => route('games.ad', $play->id),
        ]);
    }

    /**
     * The full-page advertisement with countdown and maths question.
     */
    public function ad($id)
    {
        $play = $this->ownPlay($id);
        $game = GameSetting::$games[$play->game_key];

        if ($play->isCompleted()) {
            return redirect()->route('games.show', ['slug' => $game['slug'], 'play' => $play->id]);
        }

        // Left (abandoned) plays can never be reopened.
        if ($play->status !== 'pending') {
            return redirect()->route('games.show', $game['slug']);
        }

        return view('games.ad', [
            'play' => $play,
            'ad' => $play->ad,
            'game' => $game,
            'secondsLeft' => $this->games->secondsLeft($play),
            'alreadyLoaded' => $play->ad_loaded_at !== null,
            'backUrl' => route('games.show', $game['slug']),
        ]);
    }

    /**
     * The ad has fully loaded on the player's screen: start the countdown.
     */
    public function adLoaded($id)
    {
        $play = $this->ownPlay($id);

        if ($play->isCompleted()) {
            return response()->json(['ok' => true, 'seconds_left' => 0]);
        }

        if ($play->status !== 'pending') {
            return $this->closedResponse($play);
        }

        return response()->json([
            'ok' => true,
            'seconds_left' => $this->games->markAdLoaded($play),
        ]);
    }

    /**
     * Countdown finished: hand out the addition question.
     */
    public function question($id)
    {
        $play = $this->ownPlay($id);

        if ($play->status === 'abandoned') {
            return $this->closedResponse($play);
        }

        $question = $this->games->newQuestion($play);

        if ($question === null) {
            return response()->json([
                'ok' => false,
                'message' => 'Please wait for the countdown to finish.',
                'seconds_left' => $this->games->secondsLeft($play),
            ], 422);
        }

        return response()->json(['ok' => true, 'question' => $question]);
    }

    /**
     * Heartbeat from the ad page: how many seconds the player has actively
     * watched so far. Returns how many are left.
     */
    public function progress(Request $request, $id)
    {
        $request->validate(['seconds' => 'required|numeric|min:0']);

        $play = $this->ownPlay($id);

        if ($play->status !== 'pending') {
            return $this->closedResponse($play);
        }

        return response()->json([
            'ok' => true,
            'seconds_left' => $this->games->recordProgress($play, $request->input('seconds')),
        ]);
    }

    /**
     * Leave button: the play is closed and cannot be resumed.
     */
    public function leave($id)
    {
        $play = $this->ownPlay($id);
        $this->games->abandon($play->id, Auth::id());

        return response()->json([
            'ok' => true,
            'redirect' => route('games.show', GameSetting::$games[$play->game_key]['slug']),
        ]);
    }

    /**
     * Response for a play that can no longer be used (left / finished).
     */
    protected function closedResponse($play)
    {
        $game = GameSetting::$games[$play->game_key];
        $params = $play->isCompleted() ? ['slug' => $game['slug'], 'play' => $play->id] : ['slug' => $game['slug']];

        return response()->json([
            'ok' => false,
            'code' => 'closed',
            'message' => 'This game session has ended.',
            'redirect' => route('games.show', $params),
        ], 410);
    }

    /**
     * Check the answer. Right: the result is revealed. Wrong: a new question.
     */
    public function answer(Request $request, $id)
    {
        $request->validate(['answer' => 'required|numeric']);

        $play = $this->ownPlay($id);
        $outcome = $this->games->submitAnswer($play->id, Auth::id(), $request->input('answer'));

        if (! $outcome['ok']) {
            return response()->json($outcome, 422);
        }

        $game = GameSetting::$games[$play->game_key];

        return response()->json([
            'ok' => true,
            'result' => $outcome['result'],
            'redirect' => route('games.show', ['slug' => $game['slug'], 'play' => $play->id]),
        ]);
    }
}
