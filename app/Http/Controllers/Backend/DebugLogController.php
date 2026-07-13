<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * There is no `debug_logs` table or Eloquent model in this application yet.
 * This controller is built defensively so the admin nav entry never crashes:
 * every action checks Schema::hasTable() first and degrades to an empty
 * state / friendly flash message instead of throwing.
 */
class DebugLogController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'debug-logs.';
    private $table = 'debug_logs';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
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

    // View Function
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

    // Destroy Function
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

            return back()->with('success', 'Debug log deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('DebugLog destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
