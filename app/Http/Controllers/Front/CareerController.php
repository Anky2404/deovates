<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\ActivityLog;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\Resume;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'career.';

    public function index()
    {
        $careers = Career::with('department')
            ->active()
            ->latest('id')
            ->get();

        // Pad grid with placeholder roles
        $placeholders = collect([
            (object) ['slug' => null, 'title' => 'Frontend Developer', 'department' => (object) ['name' => 'Engineering'], 'location' => 'ludhiana', 'is_remote' => true, 'employment_type' => 'full-time'],
            (object) ['slug' => null, 'title' => 'Backend Developer', 'department' => (object) ['name' => 'Engineering'], 'location' => 'ludhiana', 'is_remote' => true, 'employment_type' => 'full-time'],
            (object) ['slug' => null, 'title' => 'UI/UX Designer', 'department' => (object) ['name' => 'Design'], 'location' => 'ludhiana', 'is_remote' => false, 'employment_type' => 'full-time'],
        ])->take(max(0, 4 - $careers->count()));

        $careers = $careers->concat($placeholders);

        [$page, $sectionContents] = $this->loadPageSections('career');

        return view($this->prefix . $this->folder . 'index', compact('careers', 'page', 'sectionContents'));
    }

    public function details($slug)
    {
        $career = Career::with('department')
            ->active()
            ->where('slug', $slug)
            ->first();

        if (! $career) {
            abort(404);
        }

        $related = Career::active()
            ->where('id', '!=', $career->id)
            ->latest('id')
            ->take(3)
            ->get();

        return view($this->prefix . $this->folder . 'details', compact('career', 'related'));
    }

    public function apply(Request $request, $slug)
    {
        $career = Career::active()->where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'cover_letter' => ['nullable', 'string'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'current_company' => ['nullable', 'string', 'max:255'],
            'current_ctc' => ['nullable', 'integer'],
            'expected_ctc' => ['nullable', 'integer'],
            'notice_period' => ['nullable', 'integer'],
            'resume_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        try {
            $resumeUuid = (string) Str::uuid();
            $resumePath = app(MediaUploader::class)->uploadSingle(
                $request->file('resume_file'),
                'resumes',
                null,
                [],
                $data['full_name'],
                $resumeUuid
            );

            $resume = Resume::create([
                'uuid' => $resumeUuid,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'resume_file' => $resumePath,
                'portfolio_url' => $data['portfolio_url'] ?? null,
                'current_company' => $data['current_company'] ?? null,
                'notice_period' => $data['notice_period'] ?? null,
                'source' => 'website',
                'status' => 'new',
                'is_active' => true,
            ]);

            $application = CareerApplication::create([
                'career_id' => $career->id,
                'department_id' => $career->department_id,
                'resume_id' => $resume->id,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'cover_letter' => $data['cover_letter'] ?? null,
                'portfolio_url' => $data['portfolio_url'] ?? null,
                'current_company' => $data['current_company'] ?? null,
                'current_ctc' => $data['current_ctc'] ?? null,
                'expected_ctc' => $data['expected_ctc'] ?? null,
                'notice_period' => $data['notice_period'] ?? null,
                'status' => 'new',
                'source' => 'website',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'applied_at' => now(),
            ]);

            $career->increment('total_applications');

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.careerapplication'), [
                'subject_type' => CareerApplication::class,
                'subject_id' => $application->id,
                'is_system' => true,
                'description' => $application->full_name . ' applied for "' . $career->title . '".',
            ]);

            return back()->with('success', 'Your application has been submitted successfully. We will get back to you soon.');
        } catch (\Throwable $e) {
            Log::error('Career application submit failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong while submitting your application. Please try again.');
        }
    }
}
