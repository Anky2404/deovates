<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Career;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'careers.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Career::with('department')
            ->orderBy('display_order')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function createoredit(?string $uuid = null)
    {
        $career = $uuid ? Career::where('uuid', $uuid)->firstOrFail() : null;
        $departments = Department::active()->orderBy('name')->get();

        return view($this->prefix.$this->folder.'createoredit', compact('career', 'departments'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $career = $uuid ? Career::where('uuid', $uuid)->firstOrFail() : null;

        $request->merge([
            'apply_url' => \App\Helper::normalizeUrl($request->input('apply_url')),
        ]);

        $data = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:careers,slug,'.($career->id ?? 'NULL')],
            'employment_type' => ['nullable', 'in:full-time,part-time,contract,internship,freelance'],
            'experience_level' => ['nullable', 'in:fresher,junior,mid,senior,lead'],
            'location' => ['nullable', 'string', 'max:255'],
            'openings' => ['nullable', 'integer', 'min:1'],
            'salary_min' => ['nullable', 'integer'],
            'salary_max' => ['nullable', 'integer'],
            'salary_currency' => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'responsibilities' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'benefits' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'apply_url' => ['nullable', 'url', 'max:255'],
            'apply_email' => ['nullable', 'email', 'max:255'],
            'application_deadline' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ]);

        $data['slug'] = Str::slug($data['slug']);
        $data['skills'] = $data['skills']
            ? array_values(array_filter(array_map('trim', explode(',', $data['skills']))))
            : [];
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_remote'] = $request->boolean('is_remote');
        $data['openings'] = $data['openings'] ?? 1;
        $data['description'] = $data['description'] ?? '';
        $data['published_at'] = $data['is_active'] ? ($career->published_at ?? now()) : $career?->published_at;

        try {
            if ($career) {
                $career->update($data);
                ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.career'), [
                    'subject_type' => Career::class,
                    'subject_id' => $career->id,
                    'description' => 'Updated career "'.$career->title.'".',
                ]);
                $message = 'Career updated successfully.';
            } else {
                $data['uuid'] = (string) Str::uuid();
                $career = Career::create($data);
                ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.career'), [
                    'subject_type' => Career::class,
                    'subject_id' => $career->id,
                    'description' => 'Created career "'.$career->title.'".',
                ]);
                $message = 'Career created successfully.';
            }

            return redirect()->route('admin.careers.index')->with('success', $message);
        } catch (\Throwable $e) {
            Log::error('Career save failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong while saving the career.');
        }
    }

    public function destroy(string $uuid)
    {
        try {
            $career = Career::where('uuid', $uuid)->firstOrFail();
            $career->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.career'), [
                'subject_type' => Career::class,
                'subject_id' => $career->id,
                'description' => 'Deleted career "'.$career->title.'".',
            ]);

            return back()->with('success', 'Career deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Career delete failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong while deleting the career.');
        }
    }

    public function togglestatus(string $uuid)
    {
        try {
            $career = Career::where('uuid', $uuid)->firstOrFail();
            $career->update(['is_active' => ! $career->is_active]);

            ActivityLog::log(
                $career->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.career'),
                [
                    'subject_type' => Career::class,
                    'subject_id' => $career->id,
                    'description' => ($career->is_active ? 'Activated' : 'Deactivated').' career "'.$career->title.'".',
                ]
            );

            return back()->with('success', 'Career status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Career toggle status failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong while updating status.');
        }
    }
}
