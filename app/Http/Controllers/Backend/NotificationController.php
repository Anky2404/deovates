<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'notifications.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = NotificationLog::with('user')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function markAsRead(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $row = NotificationLog::where('uuid', $uuid)->firstOrFail();
            $row->markAsRead();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.notificationlog'), [
                'subject_type' => NotificationLog::class,
                'subject_id' => $row->id,
                'description' => 'Marked notification "'.$row->title.'" as read.',
            ]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'is_read' => true]);
            }

            return back()->with('success', 'Notification marked as read.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Notification markAsRead failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $row = NotificationLog::where('uuid', $uuid)->firstOrFail();
            $row->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.notificationlog'), [
                'subject_type' => NotificationLog::class,
                'subject_id' => $row->id,
                'description' => 'Deleted notification "'.$row->title.'".',
            ]);

            DB::commit();

            return back()->with('success', 'Notification deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Notification destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
