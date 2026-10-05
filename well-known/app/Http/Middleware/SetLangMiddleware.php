<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;
use App\Models\Setting;
use App\Models;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SetLangMiddleware
{
    /**
     * Country code => language code. Only languages that actually exist in
     * the `languages` table (added via the admin panel) are ever applied —
     * so adding new rows here for a country is safe even before that
     * language's translations exist; it simply won't take effect until the
     * language is added in the admin.
     */
    protected $countryToLanguage = [
        // Bangla
        'BD' => 'bn',

        // English
        'US' => 'en', 'GB' => 'en', 'CA' => 'en', 'AU' => 'en', 'NZ' => 'en',
        'IE' => 'en', 'ZA' => 'en', 'SG' => 'en', 'IN' => 'en', 'PK' => 'en',

        // Arabic (RTL) — ready for when Arabic is added in the admin
        'SA' => 'ar', 'AE' => 'ar', 'EG' => 'ar', 'QA' => 'ar', 'KW' => 'ar',
        'OM' => 'ar', 'BH' => 'ar', 'IQ' => 'ar', 'JO' => 'ar', 'LB' => 'ar',
        'DZ' => 'ar', 'MA' => 'ar', 'TN' => 'ar', 'LY' => 'ar', 'YE' => 'ar',

        // Portuguese
        'PT' => 'pt', 'BR' => 'pt',

        // Spanish
        'ES' => 'es', 'MX' => 'es', 'AR' => 'es', 'CO' => 'es', 'CL' => 'es',
        'PE' => 'es', 'VE' => 'es', 'EC' => 'es', 'GT' => 'es', 'CU' => 'es',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {

         $this->applyTimezone();

         if (session()->has('lang')) {
           // A language was already picked for this visitor this session —
           // either by them manually, or by our own auto-detect below on an
           // earlier request. Either way, don't override it again.
           app()->setLocale(session()->get('lang'));
         } else {
           $detected = $this->ipDetectionEnabled() ? $this->detectLanguageFromIp($request->ip()) : null;

           if ($detected) {
             session()->put('lang', $detected);
             app()->setLocale($detected);
           } else {
             $defaultLang = Language::where('is_default', 1)->first();
             if (!empty($defaultLang)) {
               app()->setLocale($defaultLang->code);
             }
           }
         }

         return $next($request);
     }

    /**
     * Apply the timezone chosen in Settings for this request, so every
     * date shown in the admin panel (and every new created_at/updated_at
     * timestamp saved) uses it — instead of the fixed value in
     * config/app.php, which would need a code change + cache clear to
     * update.
     */
    protected function applyTimezone()
    {
        $setting = Setting::first();
        $timezone = $setting->timezone ?? null;

        if (empty($timezone)) {
            return;
        }

        try {
            date_default_timezone_set($timezone);
            config(['app.timezone' => $timezone]);
        } catch (\Exception $e) {
            // Invalid timezone string somehow saved — ignore and keep
            // whatever timezone was already active rather than breaking
            // the request.
        }
    }

    /**
     * Whether the admin has the "detect language by visitor IP" toggle
     * switched on in Settings. Off by default behaviour = the site just
     * uses the normal default-language logic, no IP lookup at all.
     */
    protected function ipDetectionEnabled()
    {
        $setting = Setting::first();

        return (bool) ($setting->ip_language_detection_enabled ?? false);
    }

    /**
     * Look up the visitor's country by IP and map it to one of the
     * languages actually configured in the admin panel. Returns null (and
     * falls back to the site default) on any failure, on private/local
     * IPs, or when the visitor's country isn't in our mapping / doesn't
     * have an active language yet.
     */
    protected function detectLanguageFromIp($ip)
    {
        if (empty($ip) || ! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            // Local/dev environment or unusable IP — nothing to detect.
            return null;
        }

        try {
            $response = Http::timeout(2)->get("http://ip-api.com/json/{$ip}", [
                'fields' => 'status,countryCode',
            ]);

            if (! $response->ok()) {
                return null;
            }

            $countryCode = strtoupper($response->json('countryCode', ''));

            if (empty($countryCode) || ! isset($this->countryToLanguage[$countryCode])) {
                return null;
            }

            $langCode = $this->countryToLanguage[$countryCode];

            // Only actually switch to it if that language is live in the
            // admin panel (e.g. Arabic/Portuguese/Spanish before they're
            // added would otherwise silently 404/fall back to English).
            $exists = Language::where('code', $langCode)->exists();

            return $exists ? $langCode : null;
        } catch (\Exception $e) {
            // Geolocation lookup failing (timeout, API down, etc.) should
            // never break the page — just fall back to the default language.
            Log::warning('IP-based language detection failed: ' . $e->getMessage());
            return null;
        }
    }
}
