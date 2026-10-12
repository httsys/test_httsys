<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Support\MediaUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * Admin-only self test page for the random media links:
 * /admin/media-check
 */
class MediaCheckController extends Controller
{
    public function index(Request $request)
    {
        $rows = [];
        $add = function ($label, $value, $ok = null) use (&$rows) {
            $rows[] = [$label, (string) $value, $ok];
        };

        $add('PHP version', PHP_VERSION);
        $add('openssl extension', function_exists('openssl_encrypt') ? 'yes' : 'NO', function_exists('openssl_encrypt'));
        $ctr = function_exists('openssl_get_cipher_methods') && in_array('aes-256-ctr', openssl_get_cipher_methods());
        $add('cipher aes-256-ctr', $ctr ? 'yes' : 'NO', $ctr);
        $add('APP_KEY set', config('app.key') ? 'yes' : 'NO', (bool) config('app.key'));
        $add('random links switched on (config/media.php)', MediaUrl::enabled() ? 'yes' : 'NO (MEDIA_RANDOM_LINKS=false)', MediaUrl::enabled());

        $dir = MediaUrl::mediaDir();
        $add('media folder', $dir);
        $add('media folder exists', is_dir($dir) ? 'yes' : 'NO', is_dir($dir));

        $add('routes cached', app()->routesAreCached() ? 'YES - run: php artisan route:clear' : 'no', !app()->routesAreCached());
        $add('route /m/{token} registered', Route::has('media.file') ? 'yes' : 'NO', Route::has('media.file'));

        $add('request host', $request->getHost());
        $add('request is https', $request->isSecure() ? 'yes' : 'no');
        $add('cookies received', implode(', ', array_keys($request->cookies->all())));

        $vid = $request->cookies->get(MediaUrl::COOKIE);
        $hasCookie = MediaUrl::validVisitorId($vid);
        $newCookie = null;
        if (!$hasCookie) {
            $vid = MediaUrl::newVisitorId();
            $newCookie = new Cookie(MediaUrl::COOKIE, $vid, 0, '/', null, $request->isSecure(), true, false, 'lax');
        }
        $add('visitor cookie "' . MediaUrl::COOKIE . '" present', $hasCookie ? 'yes' : 'no (just set now, reload this page once)');

        // Pick a real file for the test.
        $testFile = null;
        $photo = Photo::where('file', 'like', '%.jpg')->orWhere('file', 'like', '%.png')->orWhere('file', 'like', '%.jpeg')->orderBy('id', 'desc')->first();
        if ($photo && MediaUrl::isUsableFile($photo->file)) {
            $testFile = $photo->file;
        }
        $add('test file', $testFile ?: 'none found', (bool) $testFile);

        $link = null;
        if ($testFile) {
            $link = MediaUrl::make($testFile, $vid);
            $link2 = MediaUrl::make($testFile, $vid);
            $token = $link ? substr($link, strlen(MediaUrl::PREFIX)) : '';
            $back = $link ? MediaUrl::resolve($token, $vid) : null;
            $add('token create + verify in PHP', $back === $testFile ? 'OK' : 'FAILED (' . MediaUrl::$error . ')', $back === $testFile);
            $add('token length', strlen($link));
        }

        $add('files switched OFF in Admin > Media', count(MediaUrl::disabledFiles()));

        $add('PHP output_buffering', ini_get('output_buffering'));

        $tableOk = true;
        try {
            \Illuminate\Support\Facades\DB::selectOne('SELECT COUNT(*) AS c FROM media_link_uses');
        } catch (\Throwable $ex) {
            $tableOk = false;
        }
        $add('table media_link_uses (one-time use tracking)', $tableOk ? 'yes' : 'MISSING - run the SQL, otherwise links can be reused', $tableOk);

        // PHP files that print stray output (BOM or spaces at the start, or text after the closing tag).
        $bad = [];
        foreach (['app', 'config', 'routes', 'bootstrap', 'database'] as $folder) {
            $root = base_path($folder);
            if (!is_dir($root)) { continue; }
            $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS));
            foreach ($it as $file) {
                if (strtolower($file->getExtension()) !== 'php') { continue; }
                $code = @file_get_contents($file->getPathname());
                if ($code === false || $code === '') { continue; }
                $rel = $folder . '/' . ltrim(str_replace(base_path($folder), '', $file->getPathname()), '/\\');
                if (substr($code, 0, 3) === "\xEF\xBB\xBF") {
                    $bad[] = $rel . ' (BOM at start)';
                } elseif (substr($code, 0, 5) !== '<?php') {
                    $bad[] = $rel . ' (text before <?php)';
                } elseif (preg_match('/\?>\s+$/', $code)) {
                    $bad[] = $rel . ' (space/newline after ?>)';
                }
            }
        }
        $add('PHP files that print stray output', $bad ? implode("\n", $bad) : 'none', !$bad);

        $e = function ($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); };

        $html = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Media check</title>'
            . '<style>body{font-family:Arial;margin:20px;max-width:900px}td,th{border:1px solid #ccc;padding:6px 10px;text-align:left;vertical-align:top}table{border-collapse:collapse;width:100%}.ok{background:#e6f7e6}.bad{background:#fde8e8}pre{background:#f4f4f4;padding:8px;white-space:pre-wrap}</style></head><body>'
            . '<h2>Random media link - self test</h2><table>';

        foreach ($rows as $r) {
            $cls = $r[2] === null ? '' : ($r[2] ? 'ok' : 'bad');
            $html .= '<tr class="' . $cls . '"><th>' . $e($r[0]) . '</th><td>' . $e($r[1]) . '</td></tr>';
        }
        $html .= '</table>';

        if ($link) {
            $orig = \App\Support\MediaUpload::urlFor($testFile);
            $html .= '<h3>Browser test (real requests)</h3>'
                . '<p>Test image through a random link:<br><img id="t1" src="' . $e($link) . '" style="max-height:80px;border:1px solid #999"></p>'
                . '<pre id="out">running... (takes ~12 seconds)</pre>'
                . '<script>(function(){var out=document.getElementById("out");var lines=[];'
                . 'function log(s){lines.push(s);out.textContent=lines.join("\n");}'
                . 'function hex(b){var a=new Uint8Array(b.slice(0,8));return Array.prototype.map.call(a,function(x){return ("0"+x.toString(16)).slice(-2);}).join(" ");}'
                . 'document.getElementById("t1").onload=function(){log("<img> random link: LOADED OK");};'
                . 'document.getElementById("t1").onerror=function(){log("<img> random link: FAILED to load");};'
                . 'function get(url,label,cb){fetch(url,{credentials:"same-origin"}).then(function(r){var ct=r.headers.get("content-type")||"";'
                . 'return r.arrayBuffer().then(function(b){log(label+": HTTP "+r.status+" "+ct+" size="+b.byteLength+" first bytes="+hex(b)+(r.ok?"":" body: "+new TextDecoder().decode(b).slice(0,120)));if(cb)cb();});}).catch(function(x){log(label+" error: "+x);if(cb)cb();});}'
                . 'get(' . json_encode($orig) . ',"original file (PNG starts with 89 50 4e 47)",function(){'
                . 'get(' . json_encode($link2) . ',"random link, 1st use",function(){'
                . 'setTimeout(function(){get(' . json_encode($link2) . ',"same random link again after 10s (must be refused)");},10000);});});'
                . '})();</script>';
        }

        $html .= '<p style="margin-top:20px;color:#666">Send a screenshot of this whole page.</p></body></html>';

        $response = response($html, 200, ['Content-Type' => 'text/html; charset=UTF-8', 'Cache-Control' => 'no-store']);
        if ($newCookie) {
            $response->headers->setCookie($newCookie);
        }

        return $response;
    }
}
