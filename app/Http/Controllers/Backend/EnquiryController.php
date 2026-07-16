<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Enquiry;
use App\Models\EnquiryStatusLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'enquiries.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Enquiry::with('assignedUser')->latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function details(Request $request, $uuid)
    {
        $enquiry = Enquiry::where('uuid', $uuid)->firstOrFail();
        $users = User::orderBy('name')->pluck('name', 'id');

        return view($this->prefix . $this->folder . 'details', compact('enquiry', 'users'));
    }

    public function markspam(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $enquiry = Enquiry::where('uuid', $uuid)->firstOrFail();
            $oldStatus = $enquiry->status;

            $enquiry->markAsSpam();

            if ($oldStatus !== $enquiry->status) {
                EnquiryStatusLog::create([
                    'enquiry_id' => $enquiry->id,
                    'old_status' => $oldStatus,
                    'new_status' => $enquiry->status,
                    'changed_by' => auth()->id(),
                    'notes' => 'Marked as spam from the admin panel.',
                ]);
            }

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.enquiry'), [
                'subject_type' => Enquiry::class,
                'subject_id' => $enquiry->id,
                'description' => 'Marked enquiry from ' . $enquiry->name . ' as spam',
            ]);

            DB::commit();

            return back()->with('success', 'Enquiry marked as spam.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Enquiry markspam failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function updatestatus(Request $request, $uuid)
    {
        $enquiry = Enquiry::where('uuid', $uuid)->firstOrFail();

        $data = $request->validate([
            'status' => 'required|string|in:new,in_progress,converted,closed,spam',
            'assigned_to' => 'nullable|integer|exists:users,id',
            'follow_up_at' => 'nullable|date',
            'admin_notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $oldStatus = $enquiry->status;

            $enquiry->update($data);

            if ($oldStatus !== $enquiry->status) {
                EnquiryStatusLog::create([
                    'enquiry_id' => $enquiry->id,
                    'old_status' => $oldStatus,
                    'new_status' => $enquiry->status,
                    'changed_by' => auth()->id(),
                    'notes' => $data['admin_notes'] ?? null,
                    'follow_up_at' => $data['follow_up_at'] ?? null,
                ]);
            }

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.enquiry'), [
                'subject_type' => Enquiry::class,
                'subject_id' => $enquiry->id,
                'new_values' => $enquiry->getChanges(),
                'description' => 'Updated enquiry status for ' . $enquiry->name,
            ]);

            DB::commit();

            return redirect()->route('admin.enquiries.details', $enquiry->uuid)->with('success', 'Enquiry updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Enquiry updatestatus failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $enquiry = Enquiry::where('uuid', $uuid)->firstOrFail();
            $enquiry->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.enquiry'), [
                'subject_type' => Enquiry::class,
                'subject_id' => $enquiry->id,
                'description' => 'Deleted enquiry from ' . $enquiry->name,
            ]);

            return back()->with('success', 'Enquiry deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Enquiry destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
