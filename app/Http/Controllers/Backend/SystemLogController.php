<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SystemLogController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'system-logs.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = SystemLog::with('user')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function view(Request $request, $uuid)
    {
        $row = SystemLog::with('user')->where('uuid', $uuid)->firstOrFail();

        return view($this->prefix.$this->folder.'view', compact('row'));
    }

    // Manual delete only, read-only log
    public function destroy(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $row = SystemLog::where('uuid', $uuid)->firstOrFail();
            $row->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.systemlog'), [
                'subject_type' => SystemLog::class,
                'subject_id' => $row->id,
                'description' => 'Deleted system log #'.$row->id.' ('.$row->action.').',
            ]);

            DB::commit();

            return back()->with('success', 'System log deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('SystemLog destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
