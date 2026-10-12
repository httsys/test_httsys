<?php

namespace App\Http\Middleware;

use App\Support\MediaUrl;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Hides the real media file names from the pages visitors receive:
 * every /public/images/media/<file> becomes a random /m/<token> link that
 * changes on every page load and only works in the visitor's own browser.
 */
class ObfuscateMediaUrls
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!$this->shouldProcess($request, $response)) {
            return $response;
        }

        $content = $response->getContent();
        if (!is_string($content) || $content === '') {
            return $response;
        }

        $visitorId = $request->cookies->get(MediaUrl::COOKIE);
        $isNew = false;
        if (!MediaUrl::validVisitorId($visitorId)) {
            $visitorId = MediaUrl::newVisitorId();
            $isNew = true;
        }

        $hosts = [strtolower($request->getHost())];
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
        if ($appHost) {
            $hosts[] = strtolower($appHost);
        }

        $new = MediaUrl::rewriteHtml($content, $visitorId, $hosts);

        if ($new === $content) {
            return $response;
        }

        $response->setContent($new);
        $response->headers->remove('Content-Length');
        // Links are single-use: the page (and its links) must be fetched fresh
        // every time, also when the visitor presses Back.
        $response->headers->set('Cache-Control', 'no-store, private');

        if ($isNew) {
            // Session cookie (expires when the browser closes), only read by us.
            $response->headers->setCookie(new Cookie(
                MediaUrl::COOKIE, $visitorId, 0, '/', null, $request->isSecure(), true, false, 'lax'
            ));
        }

        return $response;
    }

    protected function shouldProcess($request, $response)
    {
        if (!MediaUrl::enabled() || !$request->isMethod('GET')) {
            return false;
        }

        if ($response instanceof JsonResponse
            || $response instanceof RedirectResponse
            || $response instanceof BinaryFileResponse
            || $response instanceof StreamedResponse
            || $response->getStatusCode() !== 200) {
            return false;
        }

        $type = strtolower((string) $response->headers->get('Content-Type'));
        if ($type !== '' && strpos($type, 'text/html') === false) {
            return false;
        }

        // The admin panel and the file manager work with the real file
        // paths (editors, POS, forms) - only the media list is protected.
        $path = trim($request->path(), '/');
        if ($path !== 'admin/media' && preg_match('#^(admin|laravel-filemanager|filemanager)(/|$)#', $path)) {
            return false;
        }

        // Search engines / social crawlers get the normal URLs so image
        // search and link previews keep working.
        if (class_exists('\Jaybizzle\CrawlerDetect\CrawlerDetect')) {
            try {
                $detector = new \Jaybizzle\CrawlerDetect\CrawlerDetect();
                if ($detector->isCrawler($request->userAgent())) {
                    return false;
                }
            } catch (\Throwable $e) {
                // ignore detector problems, treat as a normal visitor
            }
        }

        return true;
    }
}
