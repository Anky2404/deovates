<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;


class ActivityLogController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'logs.activities.';


    public function  __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    //Index Function
    public function index(Request $request)
{
    $query = ActivityLog::with('user');

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    if ($request->filled('module')) {
        $query->where('module', $request->module);
    }

    if ($request->filled('action')) {
        $query->where('action', $request->action);
    }

    if ($request->filled('subject_id')) {
        $query->where('subject_id', $request->subject_id);
    }

    $rows = $query
        ->latest('id')
        ->paginate($this->pagerecords)
        ->withQueryString();

    $users = User::active()
        ->orderBy('name')
        ->pluck('name', 'id');

    $modules = array_values(config('constants.modules', []));

    $actions = array_values(config('constants.activities_actions', []));

    $subjectIds = ActivityLog::when($request->module, function ($q) use ($request) {
            $q->where('module', $request->module);
        })
        ->whereNotNull('subject_id')
        ->distinct()
        ->orderBy('subject_id')
        ->pluck('subject_id');

        // dd($rows);

    return view(
        $this->prefix . $this->folder . 'index',
        compact(
            'rows',
            'users',
            'modules',
            'actions',
            'subjectIds'
        )
    );
}
}
