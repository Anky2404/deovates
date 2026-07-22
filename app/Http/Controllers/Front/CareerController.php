<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\ActivityLog;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\Resume;
use App\Helper;
use App\Services\EmailSenderService;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'career.';

    public function index()
    {
        $careers = Cache::remember('front.career.index', Helper::CACHE_TTL, function () {
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

            return $careers->concat($placeholders);
        });

        [$page, $sectionContents] = $this->loadPageSections('career');

        return view($this->prefix . $this->folder . 'index', compact('careers', 'page', 'sectionContents'));
    }

    public function details($slug)
    {
        $career = Cache::remember("front.career.details.{$slug}", Helper::CACHE_TTL, function () use ($slug) {
            return Career::with('department')
                ->active()
                ->where('slug', $slug)
                ->first();
        });

        if (! $career) {
            abort(404);
        }

        $related = Cache::remember("front.career.related.{$career->id}", Helper::CACHE_TTL, function () use ($career) {
            return Career::active()
                ->where('id', '!=', $career->id)
                ->latest('id')
                ->take(3)
                ->get();
        });

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

            $this->sendApplicationConfirmation($application, $career);
            $this->sendApplicationAdminNotification($application, $career);

            return back()->with('success', 'Your application has been submitted successfully. We will get back to you soon.');
        } catch (\Throwable $e) {
            Log::error('Career application submit failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong while submitting your application. Please try again.');
        }
    }

    /**
     * Confirms receipt of the application to the applicant — same
     * database-template pattern as the password-reset email.
     */
    private function sendApplicationConfirmation(CareerApplication $application, Career $career): void
    {
        try {
            app(EmailSenderService::class)->sendTemplated(
                toEmail: $application->email,
                toName: $application->full_name,
                templateSlug: 'career-application-confirmation',
                templateDefaults: [
                    'name' => 'Career Application — Confirmation',
                    'subject' => 'We received your application for {{career_title}}',
                    'body' => view('emails.notification', [
                        'intro' => 'Thanks for applying for <strong>{{career_title}}</strong> at {{app_name}}. We\'ve received your application and resume, and our hiring team will review it shortly.',
                        'outro' => 'We\'ll email you again as soon as there\'s an update on your application status.',
                        'signoff' => 'Best regards,<br>{{app_name}} Hiring Team',
                    ])->render(),
                    'variables' => ['name', 'career_title', 'app_name'],
                    'module' => 'careers',
                ],
                variables: [
                    'name' => e($application->full_name),
                    'career_title' => e($career->title),
                    'app_name' => config('constants.BUSINESS.name'),
                ],
                source: 'career-application',
                mailableClass: \App\Mail\CareerApplicationConfirmationMail::class,
            );
        } catch (\Throwable $e) {
            Log::error('Career application confirmation email failed: ' . $e->getMessage(), ['exception' => $e]);
        }
    }

    /**
     * Notifies every admin address in config('constants.EMAIL.send') as
     * soon as a new job application comes in — same database-template
     * pattern as the contact-form admin notification.
     */
    private function sendApplicationAdminNotification(CareerApplication $application, Career $career): void
    {
        $sender = app(EmailSenderService::class);
        $appName = config('constants.BUSINESS.name');
        $adminEmails = array_values(array_filter(array_map('trim', (array) config('constants.EMAIL.send', []))));

        foreach ($adminEmails as $adminEmail) {
            try {
                $sender->sendTemplated(
                    toEmail: $adminEmail,
                    toName: null,
                    templateSlug: 'career-application-admin-notification',
                    templateDefaults: [
                        'name' => 'Career Application — Admin Notification',
                        'subject' => 'New job application: {{name}} for {{career_title}}',
                        'body' => view('emails.notification', [
                            'greeting' => 'New Job Application',
                            'intro' => 'A new application was submitted on {{app_name}} for <strong>{{career_title}}</strong>.',
                            'fields' => [
                                'Name' => '{{name}}',
                                'Email' => '{{email}}',
                                'Phone' => '{{phone}}',
                            ],
                            'quote' => '{{cover_letter}}',
                            'outro' => 'Review the full application and resume from the admin panel.',
                            'signoff' => '',
                        ])->render(),
                        'variables' => ['name', 'email', 'phone', 'career_title', 'cover_letter', 'app_name'],
                        'module' => 'careers',
                    ],
                    variables: [
                        'name' => e($application->full_name),
                        'email' => e($application->email),
                        'phone' => e($application->phone ?? '—'),
                        'career_title' => e($career->title),
                        'cover_letter' => $application->cover_letter ? nl2br(e($application->cover_letter)) : '—',
                        'app_name' => $appName,
                    ],
                    source: 'career-application',
                    mailableClass: \App\Mail\CareerApplicationAdminNotificationMail::class,
                );
            } catch (\Throwable $e) {
                Log::error('Career application admin notification failed: ' . $e->getMessage(), ['exception' => $e]);
            }
        }
    }
}
