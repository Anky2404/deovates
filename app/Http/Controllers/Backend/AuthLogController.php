<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AuthLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// create/edit are no-ops, logs are auto-written
class AuthLogController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'auth.logs.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = AuthLog::with('user')->latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function view(Request $request, $uuid)
    {
        try {
            $log = AuthLog::with('user')->where('uuid', $uuid)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('AuthLog view lookup failed: '.$e->getMessage(), ['exception' => $e]);

            return redirect()->route('admin.auth.logs.index')->with('error', 'Unable to load the requested authentication log.');
        }

        return view($this->prefix.$this->folder.'view', compact('log'));
    }

    // no-op, see class note
    public function createoredit(Request $request, $uuid = null)
    {
        return redirect()->route('admin.auth.logs.index')
            ->with('info', 'Authentication logs are recorded automatically and cannot be manually managed.');
    }

    // no-op, see class note
    public function saveorupdate(Request $request, $uuid = null)
    {
        return redirect()->route('admin.auth.logs.index')
            ->with('info', 'Authentication logs are recorded automatically and cannot be manually managed.');
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $log = AuthLog::where('uuid', $uuid)->firstOrFail();
            $log->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.authlog'), [
                'subject_type' => AuthLog::class,
                'subject_id' => $log->id,
                'description' => 'Deleted authentication log for event '.$log->event,
            ]);

            return back()->with('success', 'Authentication log deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('AuthLog destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // flips is_success field
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $log = AuthLog::where('uuid', $uuid)->firstOrFail();
            $log->is_success = ! $log->is_success;
            $log->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.update'),
                config('constants.MODULES.authlog'),
                [
                    'subject_type' => AuthLog::class,
                    'subject_id' => $log->id,
                    'description' => 'Marked authentication log as '.($log->is_success ? 'success' : 'failed'),
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $log->is_success]);
            }

            return back()->with('success', 'Authentication log status updated.');
        } catch (\Throwable $e) {
            Log::error('AuthLog togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
