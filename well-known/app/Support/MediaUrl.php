<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Builds and verifies the short-lived, visitor-bound media links
 * (/m/{token}) that replace the original /public/images/media/{file}
 * URLs in the pages that are sent to visitors.
 *
 * A token is stateless (nothing is stored in the database or cache):
 *   base64url( iv(16) | expiry(4) | AES-256-CTR(file name) | mac(12) )
 *
 *  - iv is random, so the same file gets a different token every time.
 *  - the file name is encrypted, so it never appears in the URL.
 *  - mac also covers the visitor's private cookie id, so a token only
 *    works in the browser it was issued to, and only until it expires.
 */
class MediaUrl
{
    const COOKIE = 'mvid';
    const TTL    = 7200;  // a link can be used for at most 2 hours
    const GRACE  = 8;     // seconds in which the same link may be fetched again (duplicate loads of one page)
    const PREFIX = '/m/';

    /** Why the last resolve() failed (for logs / the media check page). */
    public static $error = '';

    public static function enabled()
    {
        return (bool) config('media.random_links', true);
    }

    public static function mediaDir()
    {
        return public_path('images' . DIRECTORY_SEPARATOR . 'media');
    }

    public static function newVisitorId()
    {
        return bin2hex(random_bytes(16));
    }

    public static function validVisitorId($id)
    {
        return is_string($id) && preg_match('/^[a-f0-9]{32}$/', $id) === 1;
    }

    protected static function keys()
    {
        $key = (string) config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        return [
            hash_hmac('sha256', 'media-url:enc', $key, true),
            hash_hmac('sha256', 'media-url:mac', $key, true),
        ];
    }

    /**
     * A random link works ONCE. The first request "claims" it; the same
     * link requested again later is refused. Exceptions:
     *  - the same page loading the same link twice within GRACE seconds
     *    (e.g. cloned slider images);
     *  - video/audio players that ask for further byte ranges while playing.
     * If the tracking table does not exist yet, links stay usable (fail open).
     */
    public static function claim($token, $isMedia, $hasRange)
    {
        $hash = md5($token);
        $now = time();

        try {
            $inserted = DB::affectingStatement(
                'INSERT IGNORE INTO media_link_uses (token_hash, used_at) VALUES (?, ?)',
                [$hash, $now]
            );

            if ($inserted > 0) {
                if (mt_rand(1, 40) === 1) {
                    DB::delete('DELETE FROM media_link_uses WHERE used_at < ?', [$now - self::TTL - 120]);
                }

                return true;
            }

            $row = DB::selectOne('SELECT used_at FROM media_link_uses WHERE token_hash = ?', [$hash]);
            $age = $row ? $now - (int) $row->used_at : 0;

            if ($age <= self::GRACE || ($isMedia && $hasRange)) {
                return true;
            }

            self::$error = 'already-used';

            return false;
        } catch (\Throwable $e) {
            Log::warning('media_link_uses table problem: ' . $e->getMessage());

            return true;
        }
    }

    /**
     * Files whose "Random link" switch is OFF in Admin > Media. They keep
     * their normal /public/images/media/<file> URL. Returns [file => index].
     * (If the photos.random_link column does not exist yet, nothing is off.)
     */
    public static function disabledFiles()
    {
        static $cache = null;

        if ($cache === null) {
            try {
                $cache = array_flip(DB::table('photos')->where('random_link', 0)->pluck('file')->all());
            } catch (\Throwable $e) {
                $cache = [];
            }
        }

        return $cache;
    }

    /**
     * Is $name a plain file name that really exists in the media folder?
     */
    public static function isUsableFile($name)
    {
        return is_string($name)
            && $name !== ''
            && strpos($name, "\0") === false
            && $name === basename($name)
            && $name[0] !== '.'
            && is_file(self::mediaDir() . DIRECTORY_SEPARATOR . $name);
    }

    /**
     * Create a new random link (e.g. "/m/Zk3x...") for a media file.
     */
    public static function make($filename, $visitorId)
    {
        list($encKey, $macKey) = self::keys();

        $iv  = random_bytes(16);
        $exp = pack('N', time() + self::TTL);
        $enc = openssl_encrypt($filename, 'aes-256-ctr', $encKey, OPENSSL_RAW_DATA, $iv);

        if ($enc === false) {
            return null;
        }

        $raw = $iv . $exp . $enc;
        $mac = substr(hash_hmac('sha256', $raw . $visitorId, $macKey, true), 0, 12);

        return self::PREFIX . rtrim(strtr(base64_encode($raw . $mac), '+/', '-_'), '=');
    }

    /**
     * Link for a single file name, for places that build URLs in PHP
     * (e.g. JSON). Falls back to the plain URL if the visitor has no id yet.
     */
    public static function forFile($filename)
    {
        $original = '/public/images/media/' . $filename;
        $vid = request()->cookies->get(self::COOKIE);

        if (!self::enabled() || !self::validVisitorId($vid) || !self::isUsableFile($filename) || isset(self::disabledFiles()[$filename])) {
            return $original;
        }

        $token = self::make($filename, $vid);

        return $token === null ? $original : $token;
    }

    /**
     * Check a token for this visitor. Returns the file name or null.
     */
    public static function resolve($token, $visitorId)
    {
        self::$error = '';

        if (!self::validVisitorId($visitorId)) {
            self::$error = 'no-cookie';
            return null;
        }

        if (!is_string($token) || $token === '') {
            self::$error = 'bad-token';
            return null;
        }

        $b64  = strtr($token, '-_', '+/');
        $b64 .= str_repeat('=', (4 - strlen($b64) % 4) % 4);
        $bin  = base64_decode($b64, true);

        // iv(16) + expiry(4) + at least 1 byte of name + mac(12)
        if ($bin === false || strlen($bin) < 33) {
            self::$error = 'bad-token';
            return null;
        }

        list($encKey, $macKey) = self::keys();

        $mac = substr($bin, -12);
        $raw = substr($bin, 0, -12);

        $expected = substr(hash_hmac('sha256', $raw . $visitorId, $macKey, true), 0, 12);
        if (!hash_equals($expected, $mac)) {
            self::$error = 'wrong-browser-or-key';
            return null;
        }

        $expiry = unpack('N', substr($raw, 16, 4));
        if ($expiry[1] < time()) {
            self::$error = 'expired';
            return null;
        }

        $name = openssl_decrypt(substr($raw, 20), 'aes-256-ctr', $encKey, OPENSSL_RAW_DATA, substr($raw, 0, 16));

        if (!self::isUsableFile($name)) {
            self::$error = 'file-missing';
            return null;
        }

        return $name;
    }

    /**
     * Replace every "/public/images/media/<file>" in an HTML page with a
     * fresh random link. Scripts, <textarea>, <input>, <meta> and <link>
     * tags are left untouched on purpose (editors/forms must keep saving
     * the real file path, and social-media crawlers need the real image).
     *
     * @param string $html
     * @param string $visitorId
     * @param array  $hosts lower-case host names that count as "this site"
     */
    public static function rewriteHtml($html, $visitorId, array $hosts)
    {
        if (stripos($html, 'images/media/') === false) {
            return $html;
        }

        $saved = [];
        $protected = preg_replace_callback(
            '~<script\b.*?</script>|<textarea\b.*?</textarea>|<(?:meta|link|input)\b[^>]*>~is',
            function ($m) use (&$saved) {
                $key = '<!--mvp' . count($saved) . '-->';
                $saved[$key] = $m[0];

                return $key;
            },
            $html
        );

        if ($protected === null) {
            return $html;
        }

        $dir = self::mediaDir() . DIRECTORY_SEPARATOR;
        $disabled = self::disabledFiles();

        $rewritten = preg_replace_callback(
            '~(?<![\w.\-])(?P<host>https?://[^/"\'\s<>]+)?(?P<pre>/(?:public/)?images/media/)(?P<name>[^"\'<>?#)\\\\/]+)~i',
            function ($m) use ($dir, $visitorId, $hosts, $disabled) {
                if ($m['host'] !== '') {
                    $host = parse_url($m['host'], PHP_URL_HOST);
                    if (!$host || !in_array(strtolower($host), $hosts, true)) {
                        return $m[0]; // somebody else's site
                    }
                }

                $name = $m['name'];
                $cand = $name;
                $file = null;

                while ($cand !== '') {
                    $plain = html_entity_decode($cand, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    foreach ([$plain, rawurldecode($plain)] as $try) {
                        if (self::isUsableFile($try)) {
                            $file = $try;
                            break 2;
                        }
                    }

                    // e.g. srcset="a.jpg 1x, b.jpg 2x": drop the trailing part
                    $pos = strrpos($cand, ' ');
                    if ($pos === false) {
                        break;
                    }
                    $cand = substr($cand, 0, $pos);
                }

                if ($file === null || isset($disabled[$file])) {
                    return $m[0]; // not found, or switched OFF in Admin > Media
                }

                $link = self::make($file, $visitorId);
                if ($link === null) {
                    return $m[0];
                }

                return $link . substr($name, strlen($cand));
            },
            $protected
        );

        if ($rewritten === null) {
            return $html;
        }

        return $saved ? strtr($rewritten, $saved) : $rewritten;
    }
}
