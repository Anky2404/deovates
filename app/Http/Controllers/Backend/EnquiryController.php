<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Enquiry;
use App\Models\EnquiryStatusLog;
use App\Models\User;
use App\Services\EmailSenderService;
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

        if (! $enquiry->is_read) {
            $enquiry->markAsRead();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.view'), config('constants.MODULES.enquiry'), [
                'subject_type' => Enquiry::class,
                'subject_id' => $enquiry->id,
                'description' => 'Viewed enquiry from ' . $enquiry->name,
            ]);
        }

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

            if ($oldStatus !== $enquiry->status) {
                $this->sendStatusUpdateEmail($enquiry, $oldStatus, $data['admin_notes'] ?? null);
            }

            return redirect()->route('admin.enquiries.details', $enquiry->uuid)->with('success', 'Enquiry updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Enquiry updatestatus failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Emails the enquirer whenever an admin changes their enquiry's
     * status — same database-template pattern as the password-reset
     * and contact-form emails.
     */
    private function sendStatusUpdateEmail(Enquiry $enquiry, ?string $oldStatus, ?string $adminNotes): void
    {
        try {
            app(EmailSenderService::class)->sendTemplated(
                toEmail: $enquiry->email,
                toName: $enquiry->name,
                templateSlug: 'enquiry-status-update',
                templateDefaults: [
                    'name' => 'Enquiry — Status Update',
                    'subject' => 'Update on your enquiry to {{app_name}}',
                    'body' => view('emails.notification', [
                        'intro' => 'There\'s an update on the enquiry you submitted to {{app_name}}.',
                        'fields' => [
                            'Previous Status' => '{{old_status}}',
                            'New Status' => '{{new_status}}',
                        ],
                        'quote' => '{{admin_notes}}',
                        'outro' => 'Thanks for reaching out to {{app_name}} — we\'ll follow up if anything further is needed.',
                    ])->render(),
                    'variables' => ['name', 'old_status', 'new_status', 'admin_notes', 'app_name'],
                    'module' => 'enquiries',
                ],
                variables: [
                    'name' => e($enquiry->name),
                    'old_status' => $oldStatus ? ucfirst(str_replace('_', ' ', $oldStatus)) : '—',
                    'new_status' => ucfirst(str_replace('_', ' ', $enquiry->status)),
                    'admin_notes' => $adminNotes ? nl2br(e($adminNotes)) : '',
                    'app_name' => config('constants.BUSINESS.name'),
                ],
                source: 'enquiry-status',
            );
        } catch (\Throwable $e) {
            Log::error('Enquiry status update email failed: ' . $e->getMessage(), ['exception' => $e]);
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
