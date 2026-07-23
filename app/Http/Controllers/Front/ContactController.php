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
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        try {

            // Save enquiry
            $enquiry = Enquiry::create([
                'uuid'       => (string) Str::uuid(),
                'type'       => 'contact',
                'name'       => $data['name'],
                'email'      => $data['email'],
                'phone'      => $data['phone'] ?? null,
                'subject'    => $data['subject'] ?? null,
                'message'    => $data['message'],
                'source'     => 'website',
                'status'     => 'new',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.create'),
                config('constants.MODULES.enquiry'),
                [
                    'subject_type' => Enquiry::class,
                    'subject_id'   => $enquiry->id,
                    'is_system'    => true,
                    'description'  => $enquiry->name . ' submitted a contact enquiry.',
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Send Confirmation Email to User
            |--------------------------------------------------------------------------
            */

            $userMail = new ContactUserConfirmationMail($enquiry);

            Mail::to($enquiry->email)->send($userMail);

            $userBody = view('emails.contact-user-static', compact('enquiry'))->render();

            Email::create([
                'uuid'         => Str::uuid(),
                'from_email'   => config('mail.from.address'),
                'from_name'    => config('mail.from.name'),
                'to_email'     => $enquiry->email,
                'to_name'      => $enquiry->name,
                'subject'      => 'Thanks for contacting ' . config('constants.BUSINESS.name'),
                'body'         => $userBody,
                'type'         => 'contact_confirmation',
                'direction'    => 'outgoing',
                'enquiry_id'   => $enquiry->id,
                'status'       => 'sent',
                'retry_count'  => 0,
                'sent_at'      => now(),
                'source'       => 'website',
                'ip_address'   => $request->ip(),
            ]);

            EmailLog::create([
                'uuid'         => Str::uuid(),
                'to_email'     => $enquiry->email,
                'to_name'      => $enquiry->name,
                'from_email'   => config('mail.from.address'),
                'from_name'    => config('mail.from.name'),
                'subject'      => 'Thanks for contacting ' . config('constants.BUSINESS.name'),
                'body'         => $userBody,
                'status'       => 'sent',
                'retry_count'  => 0,
                'sent_at'      => now(),
                'source'       => 'website',
                'ip_address'   => $request->ip(),
                'user_agent'   => $request->userAgent(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Send Notification Email to Admin
            |--------------------------------------------------------------------------
            */

           $adminEmail = config('mail.admin.address');
            $adminName  = config('mail.admin.name');

            $adminMail = new ContactAdminNotificationMail($enquiry);
            

            Mail::to($adminEmail)->send($adminMail);

            $adminBody = view('emails.contact-admin-static', compact('enquiry'))->render();

            Email::create([
    'uuid'         => Str::uuid(),
    'from_email'   => $adminEmail,
    'from_name'    => $adminName,
    'to_email'     => $adminEmail,
    'to_name'      => $adminName,
    'subject'      => 'New Contact Enquiry',
    'body'         => $adminBody,
    'type'         => 'contact_notification',
    'direction'    => 'outgoing',
    'enquiry_id'   => $enquiry->id,
    'status'       => 'sent',
    'retry_count'  => 0,
    'sent_at'      => now(),
    'source'       => 'website',
    'ip_address'   => $request->ip(),
]);

            EmailLog::create([
    'uuid'         => Str::uuid(),
    'to_email'     => $adminEmail,
    'to_name'      => $adminName,
    'from_email'   => config('mail.from.address'),
    'from_name'    => config('mail.from.name'),
    'subject'      => 'New Contact Enquiry',
    'body'         => $adminBody,
    'status'       => 'sent',
    'retry_count'  => 0,
    'sent_at'      => now(),
    'source'       => 'website',
    'ip_address'   => $request->ip(),
    'user_agent'   => $request->userAgent(),
]);

            return back()->with('success', 'Thanks! Your message has been noted.');

        } catch (\Exception $e) {

            Log::error($e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->with('error', $e->getMessage());
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
