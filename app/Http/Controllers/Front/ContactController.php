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
            
           

            $result=$this->sendEnquiryEmails($enquiry);
            dd($result);

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
     * in config('constants.EMAIL.send') — static, hardcoded mail designs
     * (App\Mail\ContactUserConfirmationMail / ContactAdminNotificationMail),
     * no database template lookup. Every send is still recorded in both
     * the Emails table and the Email Logs table.
     */
    private function sendEnquiryEmails(Enquiry $enquiry): void
    {
        $this->sendAndLog($enquiry->email, $enquiry->name, new ContactUserConfirmationMail($enquiry));

        foreach ($this->adminNotificationEmails() as $adminEmail) {
            $this->sendAndLog($adminEmail, null, new ContactAdminNotificationMail($enquiry));
        }
    }

    private function sendAndLog(string $toEmail, ?string $toName, $mailable): void
    {
        $fromEmail = config('mail.from.address');
        $fromName = config('mail.from.name');
        $subject = $mailable->build()->subject;
        $body = $mailable->render();
        $status = 'sent';
        $error = null;

        try {
            Mail::to($toEmail)->send($mailable);
        } catch (\Throwable $e) {
            $status = 'failed';
            $error = $e->getMessage();
            Log::error('Contact email send failed: ' . $e->getMessage(), ['exception' => $e]);
        }

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
