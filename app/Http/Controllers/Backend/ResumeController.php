<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'careers.resumes.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Resume::latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function view(Request $request, $uuid)
    {
        $row = Resume::with('applications')->where('uuid', $uuid)->firstOrFail();

        return view($this->prefix . $this->folder . 'view', compact('row'));
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $row = Resume::where('uuid', $uuid)->firstOrFail();

            // Soft delete, file kept on disk
            $row->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.resume'), [
                'subject_type' => Resume::class,
                'subject_id' => $row->id,
                'description' => 'Deleted resume for ' . $row->full_name . '.',
            ]);

            DB::commit();

            return back()->with('success', 'Resume deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Resume destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
