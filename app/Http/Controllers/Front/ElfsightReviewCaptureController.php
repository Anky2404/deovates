<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\GoogleReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Stores reviews scraped client-side from the Elfsight Google Reviews
 * widget's rendered DOM (see the JS in resources/views/front/testimonials/
 * index.blade.php) into the same google_reviews table the (currently
 * dormant) Places API sync used to populate.
 *
 * This is a deliberate, explicitly-approved exception to this app's
 * normal "never scrape third-party widgets" stance — accepted risk:
 * Elfsight's DOM structure isn't a public API and can change without
 * notice, silently breaking this; it may also run against Elfsight's own
 * free-tier terms of service. If it stops working, the fallback is
 * manually adding reviews via Admin > Testimonials.
 */
class ElfsightReviewCaptureController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'reviews' => ['required', 'array', 'max:20'],
            'reviews.*.author_name' => ['required', 'string', 'max:255'],
            'reviews.*.rating' => ['nullable', 'integer', 'min:0', 'max:5'],
            'reviews.*.review_text' => ['nullable', 'string'],
            'reviews.*.relative_time_description' => ['nullable', 'string', 'max:255'],
            'reviews.*.author_photo_url' => ['nullable', 'string', 'max:2048'],
        ]);

        $saved = 0;

        foreach ($data['reviews'] as $review) {
            try {
                $stableId = 'elfsight-' . md5(
                    $review['author_name'] . '|' . ($review['review_text'] ?? '') . '|' . ($review['relative_time_description'] ?? '')
                );

                GoogleReview::updateOrCreate(
                    ['google_review_id' => $stableId],
                    [
                        'uuid' => (string) Str::uuid(),
                        'author_name' => $review['author_name'],
                        'author_photo_url' => $review['author_photo_url'] ?? null,
                        'rating' => $review['rating'] ?? 5,
                        'review_text' => $review['review_text'] ?? null,
                        'relative_time_description' => $review['relative_time_description'] ?? null,
                        'fetched_at' => now(),
                    ]
                );

                $saved++;
            } catch (\Throwable $e) {
                Log::error('Elfsight review capture failed for one review: ' . $e->getMessage(), ['exception' => $e]);
            }
        }

        return response()->json(['success' => true, 'saved' => $saved]);
    }
}
