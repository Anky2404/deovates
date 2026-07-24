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
        $seoAudit = $data['type'] === 'seo' ? $this->runOnPageSeoAudit($url) : null;

        if (! $mobile['success'] && ! $desktop['success'] && ! $seoAudit) {
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
                'seo_audit' => $seoAudit,
                'status' => ($mobile['success'] && $desktop['success']) ? 'completed' : 'partial',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.websiteauditlead', 'WebsiteAuditLead'), [
                'subject_type' => WebsiteAuditLead::class,
                'subject_id' => $lead->id,
                'is_system' => true,
                'description' => $lead->name.' ran a '.$data['type'].' check on '.$url,
            ]);
        } catch (\Throwable $e) {
            Log::error('WebsiteAuditLead save failed: '.$e->getMessage(), ['exception' => $e]);
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
            'seo_audit' => $seoAudit,
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

        return 'https://'.$url;
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
                    'message' => $response->json('error.message') ?? 'Could not analyze this URL for '.$strategy.'. Please check it and try again.',
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
            Log::error('PageSpeed check failed ('.$strategy.'): '.$e->getMessage(), ['exception' => $e]);

            return [
                'success' => false,
                'status' => 500,
                'message' => 'Something went wrong while analyzing this URL. Please try again.',
            ];
        }
    }

    /**
     * @return array<string, mixed>|null
     */
    private function runOnPageSeoAudit(string $url): ?array
    {
        try {
            $response = Http::timeout(20)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; DeovateSeoAuditBot/1.0)'])
                ->get($url);

            if (! $response->ok()) {
                return [
                    'success' => false,
                    'message' => 'Could not fetch this URL for SEO analysis (HTTP '.$response->status().').',
                ];
            }

            $html = $response->body();

            libxml_use_internal_errors(true);
            $dom = new \DOMDocument;
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xpath = new \DOMXPath($dom);

            $getMeta = function (string $attr, string $value) use ($xpath): ?string {
                $nodes = $xpath->query("//meta[@{$attr}='{$value}']");

                return $nodes && $nodes->length ? trim((string) $nodes->item(0)->getAttribute('content')) : null;
            };

            $titleNode = $xpath->query('//title');
            $title = $titleNode && $titleNode->length ? trim($titleNode->item(0)->textContent) : null;

            $metaDescription = $getMeta('name', 'description');
            $robots = $getMeta('name', 'robots');
            $viewport = $getMeta('name', 'viewport');

            $canonicalNodes = $xpath->query("//link[@rel='canonical']");
            $canonical = $canonicalNodes && $canonicalNodes->length ? $canonicalNodes->item(0)->getAttribute('href') : null;

            $faviconNodes = $xpath->query("//link[contains(@rel,'icon')]");
            $hasFavicon = $faviconNodes && $faviconNodes->length > 0;

            $htmlNode = $xpath->query('//html');
            $lang = $htmlNode && $htmlNode->length ? $htmlNode->item(0)->getAttribute('lang') : null;

            $headings = [];
            foreach (range(1, 6) as $level) {
                $nodes = $xpath->query("//h{$level}");
                $headings["h{$level}"] = $nodes ? $nodes->length : 0;
            }

            $ogTags = [
                'og:title' => $getMeta('property', 'og:title'),
                'og:description' => $getMeta('property', 'og:description'),
                'og:image' => $getMeta('property', 'og:image'),
                'og:type' => $getMeta('property', 'og:type'),
                'og:url' => $getMeta('property', 'og:url'),
            ];

            $twitterTags = [
                'twitter:card' => $getMeta('name', 'twitter:card'),
                'twitter:title' => $getMeta('name', 'twitter:title'),
                'twitter:description' => $getMeta('name', 'twitter:description'),
                'twitter:image' => $getMeta('name', 'twitter:image'),
            ];

            $images = $xpath->query('//img');
            $totalImages = $images ? $images->length : 0;
            $missingAlt = 0;
            if ($images) {
                foreach ($images as $img) {
                    $alt = trim((string) $img->getAttribute('alt'));
                    if ($alt === '') {
                        $missingAlt++;
                    }
                }
            }

            $anchors = $xpath->query('//a[@href]');
            $internalLinks = 0;
            $externalLinks = 0;
            $host = parse_url($url, PHP_URL_HOST);
            if ($anchors) {
                foreach ($anchors as $a) {
                    $href = trim((string) $a->getAttribute('href'));
                    if ($href === '' || str_starts_with($href, '#') || str_starts_with($href, 'javascript:') || str_starts_with($href, 'mailto:')) {
                        continue;
                    }
                    $linkHost = parse_url($href, PHP_URL_HOST);
                    if ($linkHost === null || $linkHost === $host) {
                        $internalLinks++;
                    } else {
                        $externalLinks++;
                    }
                }
            }

            $hasSchema = str_contains($html, 'application/ld+json') || str_contains($html, 'itemscope');

            return [
                'success' => true,
                'title' => [
                    'value' => $title,
                    'length' => $title ? mb_strlen($title) : 0,
                    'ok' => $title !== null && mb_strlen($title) >= 10 && mb_strlen($title) <= 60,
                ],
                'meta_description' => [
                    'value' => $metaDescription,
                    'length' => $metaDescription ? mb_strlen($metaDescription) : 0,
                    'ok' => $metaDescription !== null && mb_strlen($metaDescription) >= 50 && mb_strlen($metaDescription) <= 160,
                ],
                'headings' => $headings,
                'h1_ok' => ($headings['h1'] ?? 0) === 1,
                'canonical' => [
                    'value' => $canonical,
                    'ok' => ! empty($canonical),
                ],
                'robots' => [
                    'value' => $robots,
                    'ok' => $robots === null || (! str_contains($robots, 'noindex')),
                ],
                'viewport' => [
                    'value' => $viewport,
                    'ok' => ! empty($viewport),
                ],
                'lang' => [
                    'value' => $lang ?: null,
                    'ok' => ! empty($lang),
                ],
                'favicon_ok' => $hasFavicon,
                'open_graph' => $ogTags,
                'open_graph_ok' => ! empty($ogTags['og:title']) && ! empty($ogTags['og:description']),
                'twitter_card' => $twitterTags,
                'twitter_card_ok' => ! empty($twitterTags['twitter:card']),
                'images' => [
                    'total' => $totalImages,
                    'missing_alt' => $missingAlt,
                    'ok' => $totalImages === 0 || $missingAlt === 0,
                ],
                'links' => [
                    'internal' => $internalLinks,
                    'external' => $externalLinks,
                ],
                'schema_ok' => $hasSchema,
            ];
        } catch (\Throwable $e) {
            Log::error('On-page SEO audit failed: '.$e->getMessage(), ['exception' => $e]);

            return [
                'success' => false,
                'message' => 'Something went wrong while analyzing this page for SEO.',
            ];
        }
    }

    private function scoreOf(array $categories, string $key): ?int
    {
        $score = $categories[$key]['score'] ?? null;

        return $score === null ? null : (int) round($score * 100);
    }
}
