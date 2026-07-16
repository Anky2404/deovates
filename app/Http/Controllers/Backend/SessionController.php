<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// Sessions are framework-managed, not admin-editable
class SessionController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'sessions.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Session::with('user')->orderByDesc('last_activity')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // No-op: sessions are auto-created
    public function createoredit(Request $request, $uuid = null)
    {
        return redirect()->route('admin.sessions.index')
            ->with('info', 'Sessions are created automatically and cannot be manually managed.');
    }

    // No-op: sessions are auto-created
    public function saveorupdate(Request $request, $uuid = null)
    {
        return redirect()->route('admin.sessions.index')
            ->with('info', 'Sessions are created automatically and cannot be manually managed.');
    }

    // uuid param is actually session id
    public function destroy(Request $request, $uuid)
    {
        try {
            $deleted = Session::where('id', $uuid)->delete();

            if (! $deleted) {
                return back()->with('error', 'Session not found or already expired.');
            }

            return back()->with('success', 'Session terminated successfully.');
        } catch (\Throwable $e) {
            Log::error('Session destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // No-op: sessions are auto-created
    public function togglestatus(Request $request, $uuid)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Sessions are created automatically and cannot be manually managed.',
            ]);
        }

        return redirect()->route('admin.sessions.index')
            ->with('info', 'Sessions are created automatically and cannot be manually managed.');
    }
}
