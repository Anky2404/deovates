<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class CacheController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'settings.cache.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $currentDriver = config('cache.default');
        $availableDrivers = array_keys(config('cache.stores', []));

        return view($this->prefix.$this->folder.'index', compact('currentDriver', 'availableDrivers'));
    }

    public function clear(Request $request)
    {
        try {
            Artisan::call('cache:clear');

            return back()->with('success', 'Application cache cleared successfully.');
        } catch (\Throwable $e) {
            Log::error('Cache clear failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
