<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FailedJobController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'settings.jobs.failed.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = DB::table('failed_jobs')->orderByDesc('failed_at')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function retry(Request $request, $id)
    {
        try {
            Artisan::call('queue:retry', ['id' => [$id]]);

            return back()->with('success', 'Job has been queued for retry.');
        } catch (\Throwable $e) {
            Log::error('Failed job retry failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            DB::table('failed_jobs')->where('id', $id)->delete();

            return back()->with('success', 'Failed job deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Failed job destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
