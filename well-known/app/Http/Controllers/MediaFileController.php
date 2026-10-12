<?php

namespace App\Http\Controllers;

use App\Support\MediaUrl;
use Illuminate\Http\Request;

/**
 * Serves a media file for a random /m/{token} link, but only to the
 * browser the link was issued to, and only while it is used by one of
 * our own pages. A link that is copied, pasted into the address bar,
 * shared or opened on another site/device returns 403.
 *
 * This route is registered WITHOUT the "web" middleware group (see
 * RouteServiceProvider) so that serving many images does not start a
 * session for every single file.
 */
class MediaFileController extends Controller
{
    protected $inlineTypes = [
        'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png',
        'gif' => 'image/gif', 'webp' => 'image/webp', 'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon', 'bmp' => 'image/bmp',
        'mp4' => 'video/mp4', 'webm' => 'video/webm', 'mov' => 'video/quicktime',
        'ogg' => 'audio/ogg', 'mp3' => 'audio/mpeg', 'wav' => 'audio/wav',
        'm4a' => 'audio/mp4', 'pdf' => 'application/pdf',
    ];

    public function show(Request $request, $token)
    {
        try {
            // Throw away anything that was printed before this point (a stray
            // space/BOM in some PHP file would otherwise corrupt the image).
            while (ob_get_level() > 0) {
                @ob_end_clean();
            }

            if (!$this->comesFromOurPages($request)) {
                return $this->deny($request, 'not-from-our-page');
            }

            $name = MediaUrl::resolve($token, $request->cookies->get(MediaUrl::COOKIE));
            if ($name === null) {
                return $this->deny($request, MediaUrl::$error ?: 'invalid');
            }

            $path = MediaUrl::mediaDir() . DIRECTORY_SEPARATOR . $name;
            $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            // One link = one use (video/audio may keep asking for ranges).
            $isMedia = in_array($ext, ['mp4', 'webm', 'mov', 'avi', 'mkv', 'mp3', 'wav', 'ogg', 'm4a'], true);
            if (!MediaUrl::claim($token, $isMedia, $request->headers->has('Range'))) {
                return $this->deny($request, MediaUrl::$error ?: 'already-used');
            }

            $headers = [
                'Cache-Control' => 'private, no-store',
                'X-Content-Type-Options' => 'nosniff',
            ];

            if (isset($this->inlineTypes[$ext])) {
                $headers['Content-Type'] = $this->inlineTypes[$ext];
            }

            $response = response()->file($path, $headers);

            // Files that browsers cannot display are downloaded with their real name.
            if (!isset($this->inlineTypes[$ext])) {
                $fallback = str_replace(['%', '/', '\\', '"'], '_', preg_replace('/[^\x20-\x7e]/', '_', $name));
                $response->setContentDisposition('attachment', $name, $fallback);
            }

            return $response;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('media link error: ' . get_class($e) . ': ' . $e->getMessage() . ' @ ' . basename($e->getFile()) . ':' . $e->getLine());

            return response('Media error (see storage/logs/laravel.log).', 500, [
                'Content-Type' => 'text/plain; charset=UTF-8',
                'Cache-Control' => 'no-store',
            ]);
        }
    }

    protected function comesFromOurPages(Request $request)
    {
        // Modern browsers: the request was started by a page of this site.
        $site = strtolower((string) $request->headers->get('Sec-Fetch-Site', ''));
        if ($site === 'same-origin' || $site === 'same-site') {
            return true;
        }

        // Older browsers: the Referer must be one of our own pages.
        $referer = $request->headers->get('Referer');
        if ($referer) {
            $host = parse_url($referer, PHP_URL_HOST);
            if ($host && in_array(strtolower($host), $this->allowedHosts($request), true)) {
                return true;
            }
        }

        return false;
    }

    protected function allowedHosts(Request $request)
    {
        $hosts = [strtolower($request->getHost())];
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
        if ($appHost) {
            $hosts[] = strtolower($appHost);
        }

        return $hosts;
    }

    protected function deny(Request $request, $reason)
    {
        \Illuminate\Support\Facades\Log::notice('media link denied: ' . $reason, [
            'sec_fetch_site' => $request->headers->get('Sec-Fetch-Site'),
            'referer' => $request->headers->get('Referer'),
            'has_cookie' => $request->cookies->has(MediaUrl::COOKIE),
        ]);

        return response('This media link is not valid or has expired. [' . $reason . ']', 403, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'no-store',
        ]);
    }
}
