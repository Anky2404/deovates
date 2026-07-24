<?php

namespace App\Traits;

trait ParsesMetaKeywords
{
    /**
     * Accepts either a JSON array (`["a","b"]`) or a comma-separated list
     * (`a, b`) and normalizes to a clean array of trimmed, non-empty strings.
     */
    private function parseMetaKeywords(?string $raw): array
    {
        if (empty($raw)) {
            return [];
        }

        $decoded = json_decode($raw, true);

        if (is_array($decoded)) {
            return array_values(array_filter(array_map('trim', $decoded), fn ($item) => $item !== ''));
        }

        return array_values(array_filter(array_map('trim', explode(',', $raw)), fn ($item) => $item !== ''));
    }
}
