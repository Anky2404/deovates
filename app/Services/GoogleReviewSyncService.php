<?php

namespace App\Services;

use App\Models\GoogleReview;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Pulls reviews for the configured Google Place via the official Places
 * API (Place Details, "reviews" field) — the only Google-sanctioned
 * source of review data. Google's own API only ever returns up to 5
 * reviews per place (a hard platform limit, not something this service
 * can work around), but the place's overall rating + total review count
 * come back separately and are stored as site settings for the footer.
 *
 * Superseded by the Elfsight widget (config('constants.ELFSIGHT_WIDGET_ID'))
 * once that's configured — Elfsight pulls reviews on its own backend, no
 * Google Cloud billing needed, so this Places-API sync (and its hourly
 * cron in routes/console.php) becomes redundant and skips itself rather
 * than spamming the log every hour with an unconfigured-key message.
 */
class GoogleReviewSyncService
{
    public function sync(): array
    {
        if (! empty(config('constants.ELFSIGHT_WIDGET_ID'))) {
            return [
                'success' => true,
                'message' => 'Skipped — Google Reviews are now served via the Elfsight widget, no Places API sync needed.',
                'count' => 0,
            ];
        }

        $apiKey = config('services.google_places.api_key');
        $placeId = config('services.google_places.place_id');

        if (empty($apiKey) || empty($placeId)) {
            return [
                'success' => false,
                'message' => 'Google Places API key or Place ID is not configured. Add GOOGLE_PLACES_API_KEY and GOOGLE_PLACE_ID to .env first.',
                'count' => 0,
            ];
        }

        try {
            $response = Http::timeout(15)->get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $placeId,
                'fields' => 'name,rating,user_ratings_total,reviews',
                'key' => $apiKey,
            ]);

            if (! $response->ok() || $response->json('status') !== 'OK') {
                $message = $response->json('error_message') ?? $response->json('status') ?? 'Unknown error from Google Places API.';
                Log::error('Google Places API sync failed: '.$message);

                return ['success' => false, 'message' => $message, 'count' => 0];
            }

            $result = $response->json('result', []);
            $reviews = $result['reviews'] ?? [];
            $now = now();
            $synced = 0;

            foreach ($reviews as $review) {
                $googleReviewId = $this->stableReviewId($review);

                GoogleReview::updateOrCreate(
                    ['google_review_id' => $googleReviewId],
                    [
                        'uuid' => (string) Str::uuid(),
                        'author_name' => $review['author_name'] ?? 'Anonymous',
                        'author_photo_url' => $review['profile_photo_url'] ?? null,
                        'author_url' => $review['author_url'] ?? null,
                        'rating' => $review['rating'] ?? 0,
                        'review_text' => $review['text'] ?? null,
                        'relative_time_description' => $review['relative_time_description'] ?? null,
                        'language' => $review['language'] ?? null,
                        'review_time' => isset($review['time']) ? now()->createFromTimestamp($review['time']) : null,
                        'fetched_at' => $now,
                    ]
                );

                $synced++;
            }

            SiteSetting::set('google_reviews_average_rating', $result['rating'] ?? null);
            SiteSetting::set('google_reviews_total_count', $result['user_ratings_total'] ?? null);
            SiteSetting::set('google_reviews_last_synced_at', $now->toDateTimeString());

            return [
                'success' => true,
                'message' => "Synced {$synced} review(s) from Google.",
                'count' => $synced,
            ];
        } catch (\Throwable $e) {
            Log::error('Google Places API sync exception: '.$e->getMessage(), ['exception' => $e]);

            return ['success' => false, 'message' => 'Something went wrong while contacting Google. Check the log for details.', 'count' => 0];
        }
    }

    /**
     * Google's legacy Place Details response has no per-review id, so
     * author + timestamp (stable across syncs) is hashed into one.
     */
    private function stableReviewId(array $review): string
    {
        return md5(($review['author_name'] ?? '').'|'.($review['time'] ?? ''));
    }
}
