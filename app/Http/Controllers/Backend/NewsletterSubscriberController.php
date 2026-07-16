<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsletterSubscriberController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'newsletter-subscribers.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = NewsletterSubscriber::latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function details(Request $request, $uuid)
    {
        $subscriber = NewsletterSubscriber::where('uuid', $uuid)->firstOrFail();
        return view($this->prefix . $this->folder . 'details', compact('subscriber'));
    }

    // Keeps unsubscribed_at flag in sync
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $subscriber = NewsletterSubscriber::where('uuid', $uuid)->firstOrFail();

            if ($subscriber->is_active) {
                $subscriber->unsubscribe();
            } else {
                $subscriber->resubscribe();
            }

            ActivityLog::log(
                $subscriber->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.newslettersubscriber'),
                [
                    'subject_type' => NewsletterSubscriber::class,
                    'subject_id' => $subscriber->id,
                    'description' => ($subscriber->is_active ? 'Resubscribed' : 'Unsubscribed') . ' ' . $subscriber->email,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $subscriber->is_active]);
            }

            return back()->with('success', 'Subscriber status updated.');
        } catch (\Throwable $e) {
            Log::error('NewsletterSubscriber togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $subscriber = NewsletterSubscriber::where('uuid', $uuid)->firstOrFail();
            $subscriber->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.newslettersubscriber'), [
                'subject_type' => NewsletterSubscriber::class,
                'subject_id' => $subscriber->id,
                'description' => 'Deleted subscriber ' . $subscriber->email,
            ]);

            return back()->with('success', 'Subscriber deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('NewsletterSubscriber destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
