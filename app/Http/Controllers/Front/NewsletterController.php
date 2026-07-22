<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\NewsletterSubscriber;
use App\Services\EmailSenderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $subscriber = NewsletterSubscriber::withTrashed()->firstOrNew(['email' => $data['email']]);

            if ($subscriber->trashed()) {
                $subscriber->restore();
            }

            $wasNew = ! $subscriber->exists;

            $subscriber->fill([
                'uuid' => $subscriber->uuid ?? (string) Str::uuid(),
                'name' => $data['name'] ?? $subscriber->name,
                'is_active' => true,
                'subscribed_at' => $subscriber->subscribed_at ?? now(),
                'unsubscribed_at' => null,
                'source' => $subscriber->source ?? 'website',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ])->save();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.newslettersubscriber'), [
                'subject_type' => NewsletterSubscriber::class,
                'subject_id' => $subscriber->id,
                'is_system' => true,
                'description' => ($wasNew ? 'New newsletter subscription: ' : 'Newsletter re-subscription: ') . $subscriber->email,
            ]);

            $this->sendSubscriptionConfirmation($subscriber);
            $this->sendSubscriptionAdminNotification($subscriber, $wasNew);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Thanks for subscribing to our newsletter!']);
            }

            return back()->with('success', 'Thanks for subscribing to our newsletter!');
        } catch (\Throwable $e) {
            Log::error('Newsletter subscribe failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
            }

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Welcome/confirmation email sent right after subscribing — same
     * database-template pattern as the password-reset email.
     */
    private function sendSubscriptionConfirmation(NewsletterSubscriber $subscriber): void
    {
        try {
            app(EmailSenderService::class)->sendTemplated(
                toEmail: $subscriber->email,
                toName: $subscriber->name,
                templateSlug: 'newsletter-subscription-confirmation',
                templateDefaults: [
                    'name' => 'Newsletter — Subscription Confirmation',
                    'subject' => "You're subscribed to {{app_name}}!",
                    'body' => view('emails.notification', [
                        'greeting' => 'Welcome, {{name}}!',
                        'intro' => 'You\'re now subscribed to the {{app_name}} newsletter. We\'ll keep you posted with our latest updates, offers, and news — straight to your inbox.',
                        'outro' => 'Thanks for joining us!',
                    ])->render(),
                    'variables' => ['name', 'app_name'],
                    'module' => 'newsletter',
                ],
                variables: [
                    'name' => e($subscriber->name ?: 'there'),
                    'app_name' => config('constants.BUSINESS.name'),
                ],
                source: 'newsletter-subscription',
                mailableClass: \App\Mail\NewsletterSubscriptionConfirmationMail::class,
            );
        } catch (\Throwable $e) {
            Log::error('Newsletter confirmation email failed: ' . $e->getMessage(), ['exception' => $e]);
        }
    }

    /**
     * Notifies every admin address in config('constants.EMAIL.send') of
     * a new (or returning) newsletter subscriber.
     */
    private function sendSubscriptionAdminNotification(NewsletterSubscriber $subscriber, bool $wasNew): void
    {
        $sender = app(EmailSenderService::class);
        $appName = config('constants.BUSINESS.name');
        $adminEmails = array_values(array_filter(array_map('trim', (array) config('constants.EMAIL.send', []))));

        foreach ($adminEmails as $adminEmail) {
            try {
                $sender->sendTemplated(
                    toEmail: $adminEmail,
                    toName: null,
                    templateSlug: 'newsletter-subscription-admin-notification',
                    templateDefaults: [
                        'name' => 'Newsletter — Admin Notification',
                        'subject' => 'New newsletter subscriber: {{email}}',
                        'body' => view('emails.notification', [
                            'greeting' => 'New Newsletter Subscriber',
                            'intro' => '{{status}} on {{app_name}}.',
                            'fields' => [
                                'Name' => '{{name}}',
                                'Email' => '{{email}}',
                            ],
                            'outro' => 'Manage subscribers from the admin panel.',
                            'signoff' => '',
                        ])->render(),
                        'variables' => ['name', 'email', 'status', 'app_name'],
                        'module' => 'newsletter',
                    ],
                    variables: [
                        'name' => e($subscriber->name ?: '—'),
                        'email' => e($subscriber->email),
                        'status' => $wasNew ? 'New subscriber' : 'Re-subscribed',
                        'app_name' => $appName,
                    ],
                    source: 'newsletter-subscription',
                    mailableClass: \App\Mail\NewsletterSubscriptionAdminNotificationMail::class,
                );
            } catch (\Throwable $e) {
                Log::error('Newsletter admin notification email failed: ' . $e->getMessage(), ['exception' => $e]);
            }
        }
    }
}
