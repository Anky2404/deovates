<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\WebsiteAuditLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebsiteAuditLeadController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'website-audit-leads.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = WebsiteAuditLead::latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function details(string $uuid)
    {
        $lead = WebsiteAuditLead::where('uuid', $uuid)->firstOrFail();

        ActivityLog::log(config('constants.ACTIVITY_ACTIONS.view'), config('constants.MODULES.websiteauditlead'), [
            'subject_type' => WebsiteAuditLead::class,
            'subject_id' => $lead->id,
            'description' => 'Viewed audit lead for ' . $lead->name,
        ]);

        return view($this->prefix . $this->folder . 'details', compact('lead'));
    }

    public function destroy(string $uuid)
    {
        try {
            $lead = WebsiteAuditLead::where('uuid', $uuid)->firstOrFail();
            $lead->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.websiteauditlead'), [
                'subject_type' => WebsiteAuditLead::class,
                'subject_id' => $lead->id,
                'description' => 'Deleted audit lead for ' . $lead->name,
            ]);

            return back()->with('success', 'Lead deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('WebsiteAuditLead destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
