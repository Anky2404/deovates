<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CareerApplicationController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'careers.applications.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = CareerApplication::with(['career', 'department'])
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function details(string $uuid)
    {
        $application = CareerApplication::with(['career', 'department', 'resume', 'statusLogs.changedByUser'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        return view($this->prefix.$this->folder.'details', compact('application'));
    }

    public function createoredit(?string $uuid = null)
    {
        $application = $uuid ? CareerApplication::where('uuid', $uuid)->firstOrFail() : null;
        $careers = Career::orderBy('title')->get();

        return view($this->prefix.$this->folder.'createoredit', compact('application', 'careers'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $application = $uuid ? CareerApplication::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'career_id' => ['required', 'exists:careers,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'cover_letter' => ['nullable', 'string'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'current_company' => ['nullable', 'string', 'max:255'],
            'current_ctc' => ['nullable', 'integer'],
            'expected_ctc' => ['nullable', 'integer'],
            'notice_period' => ['nullable', 'integer'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $career = Career::findOrFail($data['career_id']);
        $data['department_id'] = $career->department_id;

        try {
            if ($application) {
                $application->update($data);
                ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.careerapplication'), [
                    'subject_type' => CareerApplication::class,
                    'subject_id' => $application->id,
                    'description' => 'Updated application for "'.$application->full_name.'".',
                ]);
                $message = 'Application updated successfully.';
            } else {
                $data['status'] = 'new';
                $data['source'] = 'admin';
                $data['applied_at'] = now();
                $application = CareerApplication::create($data);
                ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.careerapplication'), [
                    'subject_type' => CareerApplication::class,
                    'subject_id' => $application->id,
                    'description' => 'Created application for "'.$application->full_name.'".',
                ]);
                $message = 'Application created successfully.';
            }

            return redirect()->route('admin.careers.applications.index')->with('success', $message);
        } catch (\Throwable $e) {
            Log::error('Application save failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong while saving.');
        }
    }

    public function updateStatus(Request $request, string $uuid)
    {
        $data = $request->validate([
            'new_status' => ['required', 'string', 'in:new,shortlisted,interview,offered,hired,rejected'],
            'remarks' => ['nullable', 'string'],
        ]);

        try {
            $application = CareerApplication::where('uuid', $uuid)->firstOrFail();
            $oldStatus = $application->status;

            $application->updateStatus($data['new_status'], Auth::guard('admin')->id(), $data['remarks'] ?? null);

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.'.$data['new_status'], config('constants.ACTIVITY_ACTIONS.update')),
                config('constants.MODULES.careerapplication'),
                [
                    'subject_type' => CareerApplication::class,
                    'subject_id' => $application->id,
                    'old_values' => ['status' => $oldStatus],
                    'new_values' => ['status' => $data['new_status']],
                    'description' => 'Changed status of "'.$application->full_name.'" from '.$oldStatus.' to '.$data['new_status'].'.',
                ]
            );

            return back()->with('success', 'Application status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Application status update failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong while updating status.');
        }
    }

    public function rejectStatus(Request $request)
    {
        return $this->updateStatus($request, $request->query('uuid'));
    }

    public function downloadresume(string $uuid)
    {
        $application = CareerApplication::with('resume')->where('uuid', $uuid)->firstOrFail();

        if (! $application->resume || ! $application->resume->resume_file || ! Storage::disk('public')->exists($application->resume->resume_file)) {
            abort(404);
        }

        ActivityLog::log(config('constants.ACTIVITY_ACTIONS.download'), config('constants.MODULES.careerapplication'), [
            'subject_type' => CareerApplication::class,
            'subject_id' => $application->id,
            'description' => 'Downloaded resume for "'.$application->full_name.'".',
        ]);

        return Storage::disk('public')->download($application->resume->resume_file);
    }

    public function destroy(string $uuid)
    {
        try {
            $application = CareerApplication::where('uuid', $uuid)->firstOrFail();
            $application->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.careerapplication'), [
                'subject_type' => CareerApplication::class,
                'subject_id' => $application->id,
                'description' => 'Deleted application for "'.$application->full_name.'".',
            ]);

            return back()->with('success', 'Application deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Application delete failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong while deleting the application.');
        }
    }
}
