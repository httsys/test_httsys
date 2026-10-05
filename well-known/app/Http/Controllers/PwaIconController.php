<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PwaIconController extends Controller
{
    protected $allowedSizes = [192, 512];

    /**
     * Serve a properly-sized square PNG icon generated from the site's
     * logo/favicon, caching the result to disk so it's only generated
     * once per size (regenerated automatically if the source logo file
     * changes).
     */
    public function show($size)
    {
        $size = (int) $size;

        if (! in_array($size, $this->allowedSizes)) {
            abort(404);
        }

        $setting = Setting::first();
        $sourceUrl = $setting->favicon ?? null;

        $cachePath = public_path("pwa-icons/icon-{$size}.png");
        $sourcePath = $this->resolveLocalPath($sourceUrl);

        $needsRegen = true;
        if (file_exists($cachePath) && $this->isValidPng($cachePath)) {
            $needsRegen = $sourcePath && file_exists($sourcePath)
                ? filemtime($sourcePath) > filemtime($cachePath)
                : false;
        }

        if ($needsRegen) {
            $generated = $this->generateIcon($sourceUrl, $sourcePath, $size, $cachePath);

            if (! $generated || ! $this->isValidPng($cachePath)) {
                // Generation failed or produced a broken file — don't
                // leave a corrupt cache around to be served forever.
                @unlink($cachePath);
                // Fall back to the raw logo so the page doesn't break,
                // even though it won't satisfy Chrome's install-icon-size
                // requirement.
                return $sourceUrl ? redirect($sourceUrl) : abort(404);
            }
        }

        return response()->file($cachePath, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    /**
     * Make sure a cached icon file is actually a real, decodable image —
     * not an empty/truncated/corrupted leftover from a failed generation.
     */
    protected function isValidPng($path)
    {
        if (! file_exists($path) || filesize($path) === 0) {
            return false;
        }

        return @getimagesize($path) !== false;
    }

    protected function resolveLocalPath($url)
    {
        if (! $url) {
            return null;
        }

        $path = parse_url($url, PHP_URL_PATH);
        if (! $path) {
            return null;
        }

        // Stored URLs look like https://domain.com/public/images/media/xxx.png
        $marker = '/public/';
        $pos = strpos($path, $marker);
        if ($pos === false) {
            return null;
        }

        return base_path(substr($path, $pos + 1));
    }

    protected function generateIcon($sourceUrl, $sourcePath, $size, $cachePath)
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

        // Transparent square canvas — standard for adaptive/maskable PWA
        // icons, looks correct on any home-screen background color.
        $canvas = imagecreatetruecolor($size, $size);
        imagesavealpha($canvas, true);
        $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
        imagefill($canvas, 0, 0, $transparent);

        // Fit the logo within ~80% of the canvas (a small margin looks
        // better for maskable icons, which get cropped/inset by the OS).
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
