<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\GoogleReview;
use App\Models\SiteSetting;
use App\Services\GoogleReviewSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoogleReviewController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'google-reviews.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = GoogleReview::latest('review_time')->paginate($this->pagerecords)->withQueryString();

        $averageRating = SiteSetting::get('google_reviews_average_rating');
        $totalCount = SiteSetting::get('google_reviews_total_count');
        $lastSyncedAt = SiteSetting::get('google_reviews_last_synced_at');

        return view($this->prefix.$this->folder.'index', compact('rows', 'averageRating', 'totalCount', 'lastSyncedAt'));
    }

    public function sync(Request $request, GoogleReviewSyncService $service)
    {
        $result = $service->sync();

        ActivityLog::log(config('constants.ACTIVITY_ACTIONS.import'), config('constants.MODULES.googlereview'), [
            'description' => $result['message'],
        ]);

        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function togglestatus(string $uuid)
    {
        try {
            $review = GoogleReview::where('uuid', $uuid)->firstOrFail();
            $review->update(['is_active' => ! $review->is_active]);

            ActivityLog::log(
                $review->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.googlereview'),
                [
                    'subject_type' => GoogleReview::class,
                    'subject_id' => $review->id,
                    'description' => ($review->is_active ? 'Showed' : 'Hid').' Google review from '.$review->author_name,
                ]
            );

            return back()->with('success', 'Review visibility updated.');
        } catch (\Throwable $e) {
            Log::error('Google review toggle status failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(string $uuid)
    {
        try {
            $review = GoogleReview::where('uuid', $uuid)->firstOrFail();
            $review->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.googlereview'), [
                'subject_type' => GoogleReview::class,
                'subject_id' => $review->id,
                'description' => 'Deleted Google review from '.$review->author_name,
            ]);

            return back()->with('success', 'Review deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Google review delete failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
