<?php

namespace App\Http\Controllers;

use App\Models\GameAd;
use Illuminate\Http\Request;

/**
 * Admin CRUD for the advertisements shown during the mini games
 * (Title, Duration, Maximum Show, Type, Link).
 */
class GameAdController extends Controller
{
    protected function rules()
    {
        return [
            'title' => 'required|string|max:191',
            'ad_type' => 'required|in:link,image,code',
            'duration' => 'required|integer|min:5|max:600',
            'max_show' => 'required|integer|min:0|max:100000000',
            'link' => 'required_if:ad_type,link|nullable|url|max:2000',
            'image_url' => 'required_if:ad_type,image|nullable|url|max:2000',
            'code' => 'required_if:ad_type,code|nullable|string',
        ];
    }

    /**
     * Keep only the fields that belong to the chosen ad type.
     */
    protected function payload(Request $request)
    {
        $type = $request->input('ad_type');

        return [
            'title' => $request->input('title'),
            'ad_type' => $type,
            'link' => in_array($type, ['link', 'image'], true) ? ($request->input('link') ?: null) : null,
            'image_url' => $type === 'image' ? $request->input('image_url') : null,
            'code' => $type === 'code' ? $request->input('code') : null,
            'duration' => (int) $request->input('duration'),
            'max_show' => (int) $request->input('max_show'),
            'is_active' => $request->boolean('is_active'),
        ];
    }

    public function index()
    {
        $ads = GameAd::orderBy('id', 'desc')->paginate(20);

        return view('admin.games.ads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.games.ads.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        GameAd::create($this->payload($request));

        return redirect()->route('game-ads.index')->with('game_success', 'Advertisement added.');
    }

    public function edit(GameAd $gameAd)
    {
        return view('admin.games.ads.edit', ['ad' => $gameAd]);
    }

    public function update(Request $request, GameAd $gameAd)
    {
        $request->validate($this->rules());

        $gameAd->update($this->payload($request));

        return redirect()->route('game-ads.index')->with('game_success', 'Advertisement updated.');
    }

    public function destroy(GameAd $gameAd)
    {
        $gameAd->delete();

        return redirect()->route('game-ads.index')->with('game_success', 'Advertisement deleted.');
    }
}
