<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\ActivityLog;
use App\Models\Enquiry;
use App\Services\EmailSenderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'contact.';

    public function index()
    {
        $data = Helper::readJSONData($this->folder . 'json');

        [$page, $sectionContents] = $this->loadPageSections('contact');

        return view($this->prefix . $this->folder . 'index', compact('data', 'page', 'sectionContents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string'],
        ]);

        try {
            $enquiry = Enquiry::create([
                'uuid' => (string) Str::uuid(),
                'type' => 'contact',
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'message' => $data['message'],
                'source' => 'website',
                'status' => 'new',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.enquiry'), [
                'subject_type' => Enquiry::class,
                'subject_id' => $enquiry->id,
                'is_system' => true,
                'description' => $enquiry->name . ' submitted a contact enquiry.',
            ]);

            $this->sendEnquiryEmails($enquiry);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Thanks! Your message has been noted.']);
            }

            return back()->with('success', 'Thanks! Your message has been noted.');
        } catch (\Throwable $e) {
            Log::error('Contact enquiry submit failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
            }

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Confirmation to the enquirer + notification to every admin address
     * in config('constants.EMAIL.send') — both rendered from their own
     * database template (auto-created from the fallback view on first
     * use, then fully editable from Admin > Emails > Templates).
     */
    private function sendEnquiryEmails(Enquiry $enquiry): void
    {
        $appName = config('constants.BUSINESS.name');
        $sender = app(EmailSenderService::class);

        try {
            $sender->sendTemplated(
                toEmail: $enquiry->email,
                toName: $enquiry->name,
                templateSlug: 'contact-user-confirmation',
                templateDefaults: [
                    'name' => 'Contact — User Confirmation',
                    'subject' => 'Thanks for contacting {{app_name}}',
                    'body' => view('emails.contact-user-confirmation-fallback')->render(),
                    'variables' => ['name', 'message', 'app_name'],
                    'module' => 'contact',
                ],
                variables: [
                    'name' => e($enquiry->name),
                    'message' => nl2br(e($enquiry->message)),
                    'app_name' => $appName,
                ],
                source: 'contact-enquiry',
            );
        } catch (\Throwable $e) {

        dd($e->getMessage());
            Log::error('Contact confirmation email failed: ' . $e->getMessage(), ['exception' => $e]);
        }

        foreach ($this->adminNotificationEmails() as $adminEmail) {
            try {
                $sender->sendTemplated(
                    toEmail: $adminEmail,
                    toName: null,
                    templateSlug: 'contact-admin-notification',
                    templateDefaults: [
                        'name' => 'Contact — Admin Notification',
                        'subject' => 'New contact enquiry from {{name}}',
                        'body' => view('emails.contact-admin-notification-fallback')->render(),
                        'variables' => ['name', 'email', 'phone', 'message', 'app_name'],
                        'module' => 'contact',
                    ],
                    variables: [
                        'name' => e($enquiry->name),
                        'email' => e($enquiry->email),
                        'phone' => e($enquiry->phone ?? '—'),
                        'message' => nl2br(e($enquiry->message)),
                        'app_name' => $appName,
                    ],
                    source: 'contact-enquiry',
                );
            } catch (\Throwable $e) {
                Log::error('Contact admin notification email failed: ' . $e->getMessage(), ['exception' => $e]);
            }
        }
    }

    /**
     * @return array<int, string>
     */
    private function adminNotificationEmails(): array
    {
        $configured = config('constants.EMAIL.send', []);

        return array_values(array_filter(array_map('trim', is_array($configured) ? $configured : [$configured])));
    }
}
