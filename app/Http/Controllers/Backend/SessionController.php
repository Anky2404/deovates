<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Sessions are Laravel's native session-storage rows: they're created and
 * refreshed automatically by the session driver, not by an admin form. The
 * model has no uuid/is_active/timestamps — its primary key is the session's
 * own string id. routes/admin.php nonetheless registers a full 5-route CRUD
 * block for this controller, so createoredit/saveorupdate/togglestatus are
 * implemented as safe no-ops (the shipped createoredit.blade.php in this
 * view folder is actually a leftover Blog form and posts to a different
 * route entirely — rendering it would be nonsensical, so we never do).
 * index/destroy are real and force-log-out a session by deleting its row.
 */
class SessionController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'sessions.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Session::with('user')->orderByDesc('last_activity')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Create / Edit Function — not applicable to sessions; see class docblock.
    public function createoredit(Request $request, $uuid = null)
    {
        return redirect()->route('admin.sessions.index')
            ->with('info', 'Sessions are created automatically and cannot be manually managed.');
    }

    // Save / Update Function — not applicable to sessions; see class docblock.
    public function saveorupdate(Request $request, $uuid = null)
    {
        return redirect()->route('admin.sessions.index')
            ->with('info', 'Sessions are created automatically and cannot be manually managed.');
    }

    // Destroy Function — {uuid} route parameter is actually the session's string id.
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

    // Toggle Status Function — not applicable to sessions; see class docblock.
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
