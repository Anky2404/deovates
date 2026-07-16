<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CacheLockController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'settings.cache.locks.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = DB::table('cache_locks')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function clear(Request $request)
    {
        try {
            DB::table('cache_locks')->truncate();

            return back()->with('success', 'Cache locks cleared successfully.');
        } catch (\Throwable $e) {
            Log::error('Cache lock clear failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
