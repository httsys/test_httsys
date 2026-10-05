<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    /**
     * List every homepage section with its on/off state.
     */
    public function index()
    {
        $sections = HomeSection::allKeyed()->values();

        return view('settings.home-sections.index', compact('sections'));
    }

    /**
     * Save every section's on/off state in one go.
     */
    public function update(Request $request)
    {
        foreach (HomeSection::$sections as $key => $name) {
            HomeSection::where('key', $key)->update([
                'is_active' => $request->has("sections.$key"),
            ]);
        }

        return redirect()->route('home-section.index')->with('status', 'Homepage sections updated successfully!');
    }
}
