<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

// No error_reports table yet; degrades gracefully
class ErrorReportController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'error-reports.';
    private $table = 'error_reports';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        if (! Schema::hasTable($this->table)) {
            $rows = new LengthAwarePaginator([], 0, $this->pagerecords);
            return view($this->prefix . $this->folder . 'index', compact('rows'))
                ->with('warning', 'This log table has not been created yet.');
        }

        $rows = DB::table($this->table)->orderByDesc('id')->paginate($this->pagerecords);

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function view(Request $request, $uuid)
    {
        if (! Schema::hasTable($this->table)) {
            return back()->with('error', 'This log table has not been created yet.');
        }

        $row = DB::table($this->table)->where('id', $uuid)->orWhere('uuid', $uuid)->first();

        if (! $row) {
            abort(404);
        }

        return view($this->prefix . $this->folder . 'view', compact('row'));
    }

    public function destroy(Request $request, $uuid)
    {
        if (! Schema::hasTable($this->table)) {
            return back()->with('info', 'This log table has not been created yet — nothing to delete.');
        }

        try {
            $deleted = DB::table($this->table)->where('id', $uuid)->orWhere('uuid', $uuid)->delete();

            if (! $deleted) {
                return back()->with('error', 'Record not found.');
            }

            return back()->with('success', 'Error report deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('ErrorReport destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
