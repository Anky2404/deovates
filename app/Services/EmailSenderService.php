<?php

namespace App\Services;

use App\Mail\GenericTemplateMail;
use App\Models\Email;
use App\Models\EmailLog;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailSenderService
{
    /**
     * Send one email through the shared branded layout.
     *
     * @return array{status: string, error: ?string, message_id: ?string}
     */
    public function send(string $toEmail, string $subject, string $body, string $mailableClass = GenericTemplateMail::class): array
    {
        try {
            Mail::to($toEmail)->send(new $mailableClass($subject, $body));

            return [
                'status' => 'sent',
                'error' => null,
                'message_id' => null,
            ];
        } catch (\Throwable $e) {
            Log::error('Email send failed: '.$e->getMessage(), ['exception' => $e]);

            return [
                'status' => 'failed',
                'error' => $e->getMessage(),
                'message_id' => null,
            ];
        }
    }

    /**
     * Single entry point for every system-triggered email (password reset,
     * and anything else added later) — looks up the database template by
     * slug (auto-creating it with the given defaults the first time so
     * it's immediately editable from Admin > Emails > Templates), renders
     * it with $variables, sends it, and records the send in BOTH the
     * Emails table and the Email Logs table so nothing is ever missing
     * from either list.
     *
     * @param  array{name:string,subject:string,body:string,type?:string,module?:string,variables?:array}  $templateDefaults
     * @return array{status: string, error: ?string, template: EmailTemplate, email: Email, log: EmailLog}
     */
    public function sendTemplated(
        string $toEmail,
        ?string $toName,
        string $templateSlug,
        array $templateDefaults,
        array $variables = [],
        string $source = 'system',
        string $mailableClass = GenericTemplateMail::class,
    ): array {
        $template = EmailTemplate::firstOrCreate(
            ['slug' => $templateSlug],
            array_merge([
                'name' => $templateDefaults['name'],
                'subject' => $templateDefaults['subject'],
                'body' => $templateDefaults['body'],
                'type' => $templateDefaults['type'] ?? 'transactional',
                'module' => $templateDefaults['module'] ?? null,
                'variables' => $templateDefaults['variables'] ?? array_keys($variables),
                'is_active' => true,
                'is_default' => true,
            ])
        );

        $subject = $template->renderSubject($variables);
        $body = $template->render($variables);

        $result = $this->send($toEmail, $subject, $body, $mailableClass);

        $fromEmail = config('mail.from.address');
        $fromName = config('mail.from.name');

        $email = Email::create([
            'from_email' => $fromEmail,
            'from_name' => $fromName,
            'to_email' => $toEmail,
            'to_name' => $toName,
            'subject' => $subject,
            'body' => $body,
            'type' => 'system',
            'direction' => 'outgoing',
            'status' => $result['status'],
            'failure_reason' => $result['error'],
            'sent_at' => $result['status'] === 'sent' ? now() : null,
            'source' => $source,
        ]);

        $log = EmailLog::create([
            'to_email' => $toEmail,
            'to_name' => $toName,
            'from_email' => $fromEmail,
            'from_name' => $fromName,
            'subject' => $subject,
            'body' => $body,
            'template_id' => $template->id,
            'status' => $result['status'],
            'error_message' => $result['error'],
            'sent_at' => $result['status'] === 'sent' ? now() : null,
            'source' => $source,
        ]);

        return array_merge($result, [
            'template' => $template,
            'email' => $email,
            'log' => $log,
        ]);
    }
}
