<?php

namespace App\Http\Controllers\Front\Concerns;

use App\Helper;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

trait LoadsPageSections
{
    /**
     * Load a published Page (with its active Sections + their Forms) by
     * slug, plus a [section_id => data] map of saved PageSectionContent.
     * Returns [null, []] if the page doesn't exist yet, so callers can
     * always fall back to their existing static content.
     *
     * Cached for CACHE_TTL since this hits the DB on every front-end page
     * load; hit /deploy/optimize-clear after an admin content edit to see
     * it live immediately instead of waiting out the TTL.
     *
     * @return array{0: ?Page, 1: array}
     */
    protected function loadPageSections(string $slug): array
    {
        return Cache::remember("front.page_sections.{$slug}", Helper::CACHE_TTL, function () use ($slug) {
            $page = Page::published()
                ->with(['sections' => fn ($q) => $q->wherePivot('is_active', true)->with('form.fields')])
                ->where('slug', $slug)
                ->first();

            $sectionContents = $page
                ? $page->sectionContents()->pluck('data', 'section_id')
                    ->map(fn ($data) => Helper::replacePlaceholders($data))
                    ->toArray()
                : [];

            return [$page, $sectionContents];
        });
    }
}
