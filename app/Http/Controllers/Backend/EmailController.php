<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Email;
use App\Models\EmailLog;
use App\Models\EmailTemplate;
use App\Services\EmailSenderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'emails.';

    public function __construct(private EmailSenderService $emailSender)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $emails = Email::latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('emails'));
    }

    public function createoredit(?string $uuid = null)
    {
        $email = null;

        if ($uuid) {
            try {
                $email = Email::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Email createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.emails.index')->with('error', 'Unable to load the requested email.');
            }
        }

        $templates = EmailTemplate::active()->orderBy('name')->pluck('name', 'uuid');

        return view($this->prefix.$this->folder.'createoredit', compact('email', 'templates'));
    }

    public function details(string $uuid)
    {
        $email = Email::where('uuid', $uuid)->firstOrFail();

        return view($this->prefix.$this->folder.'details', compact('email'));
    }

    // Compose-and-send. Also bound to the legacy /send route for the same action.
    public function send(Request $request, ?string $uuid = null)
    {
        return $this->saveorupdate($request, $uuid);
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $email = $uuid ? Email::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'to_email' => ['required', 'email', 'max:255'],
            'to_name' => ['nullable', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'template_id' => ['nullable', 'integer', 'exists:email_templates,id'],
        ]);

        $fromEmail = config('mail.from.address');
        $fromName = config('mail.from.name');

        $result = $this->emailSender->send($validated['to_email'], $validated['subject'], $validated['body']);

        $data = [
            'from_email' => $fromEmail,
            'from_name' => $fromName,
            'to_email' => $validated['to_email'],
            'to_name' => $validated['to_name'] ?? null,
            'subject' => $validated['subject'],
            'body' => $validated['body'],
            'type' => 'manual',
            'direction' => 'outgoing',
            'user_id' => auth('admin')->id(),
            'status' => $result['status'],
            'failure_reason' => $result['error'],
            'sent_at' => $result['status'] === 'sent' ? now() : null,
            'source' => 'admin-compose',
            'ip_address' => $request->ip(),
        ];

        try {
            if ($email) {
                $email->update($data);
            } else {
                $email = Email::create($data);
            }

            // If this was composed from a template, mirror it into Email
            // Logs too — the Logs page tracks every template-driven send
            // (manual or automatic), the Emails page tracks every compose.
            if (! empty($validated['template_id'])) {
                EmailLog::create([
                    'to_email' => $data['to_email'],
                    'to_name' => $data['to_name'],
                    'from_email' => $fromEmail,
                    'from_name' => $fromName,
                    'subject' => $data['subject'],
                    'body' => $data['body'],
                    'template_id' => $validated['template_id'],
                    'status' => $result['status'],
                    'error_message' => $result['error'],
                    'sent_at' => $result['status'] === 'sent' ? now() : null,
                    'source' => 'admin-compose',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.email'), [
                'subject_type' => Email::class,
                'subject_id' => $email->id,
                'description' => 'Sent email to '.$email->to_email.' ('.$result['status'].')',
            ]);

            if ($result['status'] === 'sent') {
                return redirect()->route('admin.emails.index')->with('success', 'Email sent successfully.');
            }

            return redirect()->route('admin.emails.index')->with('error', 'Email could not be sent: '.$result['error']);
        } catch (\Throwable $e) {
            Log::error('Email saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            $email = Email::where('uuid', $uuid)->firstOrFail();
            $email->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.email'), [
                'subject_type' => Email::class,
                'subject_id' => $email->id,
                'description' => 'Deleted email to '.$email->to_email,
            ]);

            return back()->with('success', 'Email deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Email destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
