<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\WebsiteAuditLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageSpeedController extends Controller
{
    public function index()
    {
        return view('front.page-speed.index');
    }

    /**
     * Standalone /speed-test page — single-strategy check, no lead capture.
     */
    public function check(Request $request)
    {
        $data = $request->validate([
            'url' => ['required', 'string', 'max:2048'],
            'strategy' => ['nullable', 'in:mobile,desktop'],
        ]);

        $url = $this->normalizeUrl($data['url']);
        $strategy = $data['strategy'] ?? 'mobile';

        $result = $this->runPageSpeed($url, $strategy);

        if (! $result['success']) {
            return response()->json($result, $result['status'] ?? 422);
        }

        return response()->json([
            'success' => true,
            'url' => $url,
            'strategy' => $strategy,
            'scores' => $result['scores'],
            'metrics' => $result['metrics'],
        ]);
    }

    /**
     * Homepage popup flow — captures a lead (name/email/phone/url), then
     * runs BOTH mobile and desktop checks in one go and stores the full
     * results against the lead. Used for both the "Track Speed" and
     * "Track SEO" hero buttons (same underlying Google PageSpeed Insights
     * report powers both — the SEO tool surfaces the seo/best-practices/
     * accessibility categories instead of the performance one).
     */
    public function submitLead(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:speed,seo'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'url' => ['required', 'string', 'max:2048'],
        ]);

        $url = $this->normalizeUrl($data['url']);

        $mobile = $this->runPageSpeed($url, 'mobile');
        $desktop = $this->runPageSpeed($url, 'desktop');

        if (! $mobile['success'] && ! $desktop['success']) {
            $message = $mobile['message'] ?? $desktop['message'] ?? 'Could not analyze this URL. Please check it and try again.';

            return response()->json(['success' => false, 'message' => $message], 422);
        }

        try {
            $lead = WebsiteAuditLead::create([
                'uuid' => (string) Str::uuid(),
                'type' => $data['type'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'url' => $url,
                'mobile_scores' => $mobile['scores'] ?? null,
                'mobile_metrics' => $mobile['metrics'] ?? null,
                'desktop_scores' => $desktop['scores'] ?? null,
                'desktop_metrics' => $desktop['metrics'] ?? null,
                'status' => ($mobile['success'] && $desktop['success']) ? 'completed' : 'partial',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.websiteauditlead', 'WebsiteAuditLead'), [
                'subject_type' => WebsiteAuditLead::class,
                'subject_id' => $lead->id,
                'is_system' => true,
                'description' => $lead->name . ' ran a ' . $data['type'] . ' check on ' . $url,
            ]);
        } catch (\Throwable $e) {
            Log::error('WebsiteAuditLead save failed: ' . $e->getMessage(), ['exception' => $e]);
        }

        return response()->json([
            'success' => true,
            'url' => $url,
            'mobile' => [
                'success' => $mobile['success'],
                'message' => $mobile['message'] ?? null,
                'scores' => $mobile['scores'] ?? null,
                'metrics' => $mobile['metrics'] ?? null,
            ],
            'desktop' => [
                'success' => $desktop['success'],
                'message' => $desktop['message'] ?? null,
                'scores' => $desktop['scores'] ?? null,
                'metrics' => $desktop['metrics'] ?? null,
            ],
        ]);
    }

    /**
     * Strips any http:// or https:// the visitor may have pasted in, then
     * always re-adds https:// — avoids "https://https://..." double-scheme
     * errors while still accepting whatever they type.
     */
    private function normalizeUrl(string $url): string
    {
        $url = trim($url);
        $url = preg_replace('#^https?://#i', '', $url);
        $url = ltrim($url, '/');

        return 'https://' . $url;
    }

    /**
     * @return array{success: bool, status?: int, message?: string, scores?: array, metrics?: array}
     */
    private function runPageSpeed(string $url, string $strategy): array
    {
        $apiKey = config('services.google_pagespeed.api_key');

        if (empty($apiKey)) {
            return [
                'success' => false,
                'status' => 500,
                'message' => 'Speed checker is not configured yet. Please try again later.',
            ];
        }

        try {
            $response = Http::timeout(30)->get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
                'url' => $url,
                'key' => $apiKey,
                'strategy' => $strategy,
                'category' => ['performance', 'seo', 'accessibility', 'best-practices'],
            ]);

            if (! $response->ok()) {
                return [
                    'success' => false,
                    'status' => 422,
                    'message' => $response->json('error.message') ?? 'Could not analyze this URL for ' . $strategy . '. Please check it and try again.',
                ];
            }

            $result = $response->json();
            $lighthouse = $result['lighthouseResult'] ?? [];
            $audits = $lighthouse['audits'] ?? [];
            $categories = $lighthouse['categories'] ?? [];

            return [
                'success' => true,
                'scores' => [
                    'performance' => $this->scoreOf($categories, 'performance'),
                    'seo' => $this->scoreOf($categories, 'seo'),
                    'accessibility' => $this->scoreOf($categories, 'accessibility'),
                    'best_practices' => $this->scoreOf($categories, 'best-practices'),
                ],
                'metrics' => [
                    'first_contentful_paint' => $audits['first-contentful-paint']['displayValue'] ?? '—',
                    'largest_contentful_paint' => $audits['largest-contentful-paint']['displayValue'] ?? '—',
                    'total_blocking_time' => $audits['total-blocking-time']['displayValue'] ?? '—',
                    'cumulative_layout_shift' => $audits['cumulative-layout-shift']['displayValue'] ?? '—',
                    'speed_index' => $audits['speed-index']['displayValue'] ?? '—',
                ],
            ];
        } catch (\Throwable $e) {
            Log::error('PageSpeed check failed (' . $strategy . '): ' . $e->getMessage(), ['exception' => $e]);

            return [
                'success' => false,
                'status' => 500,
                'message' => 'Something went wrong while analyzing this URL. Please try again.',
            ];
        }
    }

    private function scoreOf(array $categories, string $key): ?int
    {
        $score = $categories[$key]['score'] ?? null;

        return $score === null ? null : (int) round($score * 100);
    }
}
