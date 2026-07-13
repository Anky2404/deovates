<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationStatus;
use App\Models\CareerApplication;
use Illuminate\Http\Request;

class CareerApplicationStatusController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'careers.application-status.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = ApplicationStatus::with(['application', 'changedByUser'])
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // History Function — full status progression for a single application
    public function history(Request $request, $applicationUuid)
    {
        $application = CareerApplication::where('uuid', $applicationUuid)->firstOrFail();

        $statuses = ApplicationStatus::with('changedByUser')
            ->where('career_application_id', $application->id)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view($this->prefix . $this->folder . 'history', compact('application', 'statuses'));
    }
}
