<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class PwaIconGenerator
{
    public static $sizes = [192, 512];

    /**
     * Make sure a properly-sized PNG icon exists on disk (as a real static
     * file, not something served through a dynamic route) for every size
     * we need, (re)generating it if missing, stale, or corrupted.
     *
     * @return array<int,string> size => public URL of the icon
     */
    public static function ensureIcons()
    {
        $setting = Setting::first();
        $sourceUrl = $setting->favicon ?? null;
        $sourcePath = static::resolveLocalPath($sourceUrl);

        $urls = [];

        foreach (static::$sizes as $size) {
            $cachePath = public_path("pwa-icons/icon-{$size}.png");

            $needsRegen = true;
            if (file_exists($cachePath) && static::isValidPng($cachePath)) {
                $needsRegen = $sourcePath && file_exists($sourcePath)
                    ? filemtime($sourcePath) > filemtime($cachePath)
                    : false;
            }

            if ($needsRegen) {
                $ok = static::generateIcon($sourceUrl, $sourcePath, $size, $cachePath);
                if (! $ok || ! static::isValidPng($cachePath)) {
                    @unlink($cachePath);
                }
            }

            // Real static file URL — served directly by the web server,
            // not through a PHP route. (A dynamic route serving a binary
            // PNG was getting corrupted by the server's own compression
            // layer on this host; plain static files are unaffected,
            // exactly like every other uploaded image on the site.)
            // Note: this project serves everything under /public/ manually
            // (not via Laravel's asset() helper), so we match that here.
            $urls[$size] = file_exists($cachePath)
                ? url('/public/pwa-icons/icon-' . $size . '.png') . '?v=' . filemtime($cachePath)
                : $sourceUrl;
        }

        return $urls;
    }

    protected static function resolveLocalPath($url)
    {
        if (! $url) {
            return null;
        }

        $path = parse_url($url, PHP_URL_PATH);
        if (! $path) {
            return null;
        }

        $marker = '/public/';
        $pos = strpos($path, $marker);
        if ($pos === false) {
            return null;
        }

        return base_path(substr($path, $pos + 1));
    }

    protected static function isValidPng($path)
    {
        if (! file_exists($path) || filesize($path) === 0) {
            return false;
        }

        return @getimagesize($path) !== false;
    }

    protected static function generateIcon($sourceUrl, $sourcePath, $size, $cachePath)
    {
        if (! extension_loaded('gd')) {
            return false;
        }

        $imageData = null;

        if ($sourcePath && file_exists($sourcePath)) {
            $imageData = @file_get_contents($sourcePath);
        } elseif ($sourceUrl) {
            try {
                $response = Http::timeout(5)->get($sourceUrl);
                if ($response->ok()) {
                    $imageData = $response->body();
                }
            } catch (\Exception $e) {
                $imageData = null;
            }
        }

        if (! $imageData) {
            return false;
        }

        $source = @imagecreatefromstring($imageData);
        if (! $source) {
            return false;
        }

        $srcWidth = imagesx($source);
        $srcHeight = imagesy($source);

        $canvas = imagecreatetruecolor($size, $size);
        imagesavealpha($canvas, true);
        $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
        imagefill($canvas, 0, 0, $transparent);

        $targetArea = $size * 0.8;
        $scale = min($targetArea / $srcWidth, $targetArea / $srcHeight);
        $newWidth = (int) round($srcWidth * $scale);
        $newHeight = (int) round($srcHeight * $scale);
        $dstX = (int) (($size - $newWidth) / 2);
        $dstY = (int) (($size - $newHeight) / 2);

        imagecopyresampled($canvas, $source, $dstX, $dstY, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);
        imagedestroy($source);

        if (! is_dir(dirname($cachePath))) {
            mkdir(dirname($cachePath), 0755, true);
        }

        $ok = imagepng($canvas, $cachePath);
        imagedestroy($canvas);

        return $ok;
    }
}
