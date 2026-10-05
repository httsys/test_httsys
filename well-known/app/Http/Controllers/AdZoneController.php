<?php

namespace App\Http\Controllers;

use App\Models\AdZone;
use Illuminate\Http\Request;

class AdZoneController extends Controller
{
    /**
     * Every ad placement available across the site. Keeping this list here
     * guarantees the admin page always shows every zone, even ones whose
     * page hasn't been visited yet on the live site.
     */
    public static $zones = [
        'site_top' => 'Site-wide - Top of Page (every page)',
        'site_below_header' => 'Site-wide - Below Header (every page)',
        'site_above_footer' => 'Site-wide - Above Footer (every page)',
        'site_bottom' => 'Site-wide - Bottom of Page / popup scripts (every page)',
        'home_top' => 'Home Page - Top',
        'home_bottom' => 'Home Page - Bottom',
        'blog_sidebar_top' => 'Blog Listing - Sidebar Top',
        'blog_infeed' => 'Blog Listing - In Feed (after every 3rd post)',
        'blog_below_posts' => 'Blog Listing - Below Post List',
        'post_sidebar_top' => 'Single Post - Sidebar Top',
        'post_sidebar_bottom' => 'Single Post - Sidebar Bottom',
        'post_in_content_top' => 'Single Post - In Content Top',
        'post_in_content_bottom' => 'Single Post - In Content Bottom',
        'page_top' => 'Generic Page - Top',
        'page_bottom' => 'Generic Page - Bottom',
    ];

    /**
     * List every ad zone, creating any that don't exist yet in the DB.
     */
    public function index()
    {
        foreach (self::$zones as $key => $label) {
            AdZone::firstOrCreate(['key' => $key], ['name' => $label, 'is_active' => false]);
        }

        $zones = AdZone::orderBy('name')->get();

        return view('settings.ads.index', compact('zones'));
    }

    /**
     * Save every zone's ad code and on/off state in one go.
     */
    public function update(Request $request)
    {
        $request->validate([
            'zones' => 'required|array',
        ]);

        foreach ($request->input('zones', []) as $zoneId => $zoneInput) {
            AdZone::where('id', $zoneId)->update([
                'code' => $zoneInput['code'] ?? null,
                'is_active' => isset($zoneInput['is_active']),
            ]);
        }

        return redirect()->route('ad-zone.index')->with('status', 'Ad placements updated successfully!');
    }
}
