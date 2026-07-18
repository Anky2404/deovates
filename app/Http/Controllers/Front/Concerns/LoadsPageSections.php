<?php

namespace App\Http\Controllers\Front\Concerns;

use App\Models\Page;

trait LoadsPageSections
{
    /**
     * Load a published Page (with its active Sections + their Forms) by
     * slug, plus a [section_id => data] map of saved PageSectionContent.
     * Returns [null, []] if the page doesn't exist yet, so callers can
     * always fall back to their existing static content.
     *
     * @return array{0: ?Page, 1: array}
     */
    protected function loadPageSections(string $slug): array
    {
        $page = Page::published()
            ->with(['sections' => fn ($q) => $q->wherePivot('is_active', true)->with('form.fields')])
            ->where('slug', $slug)
            ->first();

        $sectionContents = $page
            ? $page->sectionContents()->pluck('data', 'section_id')->toArray()
            : [];

        return [$page, $sectionContents];
    }
}
