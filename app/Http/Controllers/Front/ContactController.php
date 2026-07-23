<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Mail\ContactAdminNotificationMail;
use App\Mail\ContactUserConfirmationMail;
use App\Models\ActivityLog;
use App\Models\Email;
use App\Models\EmailLog;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        try {
            $enquiry = Enquiry::create([
                'uuid' => (string) Str::uuid(),
                'type' => 'contact',
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'subject' => $data['subject'] ?? null,
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

            $mailSent = $this->sendEnquiryEmails($enquiry);

            if (! $mailSent) {
                $message = 'Your message was saved, but we could not send a confirmation email. Our team will still follow up.';

                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 500);
                }

                return back()->withInput()->with('error', $message);
            }

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Thanks! Your message has been noted.']);
            }

            return back()->with('success', 'Thanks! Your message has been noted.');
        } catch (\Throwable $e) {
            Log::error('Contact enquiry submit failed: ' . $e->getMessage(), ['exception' => $e]);

            if (app()->environment('local')) {
                dd($e);
            }

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
            }

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }


    private function sendEnquiryEmails(Enquiry $enquiry): bool
    {
        $userMailSent = $this->sendAndLog($enquiry->email, $enquiry->name, new ContactUserConfirmationMail($enquiry));

        foreach ($this->adminNotificationEmails() as $adminEmail) {
            $this->sendAndLog($adminEmail, null, new ContactAdminNotificationMail($enquiry));
        }

        return $userMailSent;
    }

    private function sendAndLog(string $toEmail, ?string $toName, $mailable): bool
    {
        $fromEmail = config('mail.from.address');
        $fromName = config('mail.from.name');
        $subject = \Illuminate\Support\Str::limit($mailable->build()->subject, 255, '');
        $body = $mailable->render();
        $status = 'sent';
        $error = null;

        try {
            Mail::to($toEmail)->send($mailable);
        } catch (\Throwable $e) {
            $status = 'failed';
            $error = $e->getMessage();
            Log::error('Contact email send failed: ' . $e->getMessage(), ['exception' => $e]);

            if (app()->environment('local')) {
                dd($e);
            }
        }

        // Record-keeping only — must never let a logging failure mask an
        // otherwise successful (or failed) send result back to the caller.
        try {
            Email::create([
                'from_email' => $fromEmail,
                'from_name' => $fromName,
                'to_email' => $toEmail,
                'to_name' => $toName,
                'subject' => $subject,
                'body' => $body,
                'type' => 'system',
                'direction' => 'outgoing',
                'status' => $status,
                'failure_reason' => $error,
                'sent_at' => $status === 'sent' ? now() : null,
                'source' => 'contact-enquiry',
            ]);

            EmailLog::create([
                'to_email' => $toEmail,
                'to_name' => $toName,
                'from_email' => $fromEmail,
                'from_name' => $fromName,
                'subject' => $subject,
                'body' => $body,
                'status' => $status,
                'error_message' => $error,
                'sent_at' => $status === 'sent' ? now() : null,
                'source' => 'contact-enquiry',
            ]);
        } catch (\Throwable $e) {
            Log::error('Contact email record-keeping failed: ' . $e->getMessage(), ['exception' => $e]);

            if (app()->environment('local')) {
                dd($e);
            }
        }

        return $status === 'sent';
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
