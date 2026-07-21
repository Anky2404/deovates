<?php

namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisit
{
    /**
     * Records one row per browser session (not per pageview), so the
     * footer counter reflects unique visitors rather than raw hits.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && ! $request->ajax() && ! $request->session()->get('site_visit_recorded')) {
            $request->session()->put('site_visit_recorded', true);

            try {
                $userAgent = (string) $request->userAgent();

                SiteVisit::create([
                    'uuid' => (string) Str::uuid(),
                    'session_id' => $request->session()->getId(),
                    'ip_address' => $request->ip(),
                    'path' => $request->path(),
                    'referrer' => $request->headers->get('referer'),
                    'user_agent' => $userAgent,
                    'browser' => $this->detectBrowser($userAgent),
                    'platform' => $this->detectPlatform($userAgent),
                    'device_type' => $this->detectDeviceType($userAgent),
                ]);
            } catch (\Throwable $e) {
                Log::error('Site visit tracking failed: ' . $e->getMessage(), ['exception' => $e]);
            }
        }

        return $next($request);
    }

    private function detectBrowser(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'Edg/') => 'Edge',
            str_contains($userAgent, 'OPR/') || str_contains($userAgent, 'Opera') => 'Opera',
            str_contains($userAgent, 'Chrome/') && ! str_contains($userAgent, 'Chromium') => 'Chrome',
            str_contains($userAgent, 'Firefox/') => 'Firefox',
            str_contains($userAgent, 'Safari/') && str_contains($userAgent, 'Version/') => 'Safari',
            str_contains($userAgent, 'MSIE') || str_contains($userAgent, 'Trident/') => 'Internet Explorer',
            default => 'Other',
        };
    }

    private function detectPlatform(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'Windows') => 'Windows',
            str_contains($userAgent, 'Mac OS X') && ! str_contains($userAgent, 'iPhone') && ! str_contains($userAgent, 'iPad') => 'macOS',
            str_contains($userAgent, 'Android') => 'Android',
            str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad') => 'iOS',
            str_contains($userAgent, 'Linux') => 'Linux',
            default => 'Other',
        };
    }

    private function detectDeviceType(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'iPad') || str_contains($userAgent, 'Tablet') => 'Tablet',
            str_contains($userAgent, 'Mobi') || str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'Android') => 'Mobile',
            default => 'Desktop',
        };
    }
}
