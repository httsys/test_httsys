<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\PwaIconGenerator;
use Illuminate\Http\Request;

class ManifestController extends Controller
{
    public function show()
    {
        $setting = Setting::first();

        $name = $setting->title ?? config('app.name', 'Website');

        // Generates the icon files on disk if missing/stale/corrupted,
        // and returns their plain static URLs.
        $icons = PwaIconGenerator::ensureIcons();

        $manifest = [
            'name' => $name,
            'short_name' => $name,
            'description' => $setting->meta_description ?? '',
            'start_url' => url('/') . '/?source=pwa',
            'scope' => '/',
            // "standalone" hides the browser's address bar/UI, giving a
            // native-app-like full-screen experience once added to the
            // home screen.
            'display' => 'standalone',
            'orientation' => 'portrait-primary',
            'background_color' => '#ffffff',
            'theme_color' => '#0097ff',
            'icons' => [
                [
                    'src' => $icons[192],
                    'sizes' => '192x192',
                    'type' => 'image/png',
                    'purpose' => 'any maskable',
                ],
                [
                    'src' => $icons[512],
                    'sizes' => '512x512',
                    'type' => 'image/png',
                    'purpose' => 'any maskable',
                ],
            ],
        ];

        return response()->json($manifest)->header('Content-Type', 'application/manifest+json');
    }
}
