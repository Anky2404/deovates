<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Pre-populates every system email template so they're all visible and
 * editable from Admin > Emails > Templates immediately — instead of each
 * one only appearing the first time its flow actually fires. Uses
 * firstOrCreate so re-running this seeder never overwrites a template an
 * admin has already customized.
 */
class EmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->templates() as $template) {
            EmailTemplate::firstOrCreate(
                ['slug' => $template['slug']],
                array_merge($template, [
                    'uuid' => (string) Str::uuid(),
                    'is_active' => true,
                    'is_default' => true,
                ])
            );
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function templates(): array
    {
        return [
            [
                'slug' => 'password-reset',
                'name' => 'Password Reset',
                'subject' => 'Reset Your {{app_name}} Password',
                'body' => view('emails.notification', [
                    'greeting' => 'Hello {{name}},',
                    'intro' => 'You are receiving this email because we received a password reset request for your account.',
                    'button' => ['url' => '{{reset_url}}', 'text' => 'Reset Password'],
                    'outro' => 'This password reset link will expire in 60 minutes.<br><br>If you did not request a password reset, no further action is required.',
                ])->render(),
                'variables' => ['name', 'reset_url', 'app_name'],
                'type' => 'transactional',
                'module' => 'auth',
            ],
            [
                'slug' => 'contact-user-confirmation',
                'name' => 'Contact — User Confirmation',
                'subject' => 'Thanks for contacting {{app_name}} — {{subject}}',
                'body' => view('emails.notification', [
                    'intro' => 'Thanks for reaching out to {{app_name}} regarding <strong>{{subject}}</strong>. We\'ve received your message and our team will get back to you shortly.',
                    'quote' => '{{message}}',
                    'outro' => 'We usually respond within a few hours on working days.',
                ])->render(),
                'variables' => ['name', 'subject', 'message', 'app_name'],
                'type' => 'transactional',
                'module' => 'contact',
            ],
            [
                'slug' => 'contact-admin-notification',
                'name' => 'Contact — Admin Notification',
                'subject' => 'New contact enquiry from {{name}} — {{subject}}',
                'body' => view('emails.notification', [
                    'greeting' => 'New Contact Enquiry',
                    'intro' => 'A new enquiry was submitted on {{app_name}}.',
                    'fields' => [
                        'Name' => '{{name}}',
                        'Email' => '{{email}}',
                        'Phone' => '{{phone}}',
                        'Subject' => '{{subject}}',
                    ],
                    'quote' => '{{message}}',
                    'outro' => 'View and manage this enquiry from the admin panel.',
                    'signoff' => '',
                ])->render(),
                'variables' => ['name', 'email', 'phone', 'subject', 'message', 'app_name'],
                'type' => 'transactional',
                'module' => 'contact',
            ],
            [
                'slug' => 'career-application-confirmation',
                'name' => 'Career Application — Confirmation',
                'subject' => 'We received your application for {{career_title}}',
                'body' => view('emails.notification', [
                    'intro' => 'Thanks for applying for <strong>{{career_title}}</strong> at {{app_name}}. We\'ve received your application and resume, and our hiring team will review it shortly.',
                    'outro' => 'We\'ll email you again as soon as there\'s an update on your application status.',
                    'signoff' => 'Best regards,<br>{{app_name}} Hiring Team',
                ])->render(),
                'variables' => ['name', 'career_title', 'app_name'],
                'type' => 'transactional',
                'module' => 'careers',
            ],
            [
                'slug' => 'career-application-admin-notification',
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
                'type' => 'transactional',
                'module' => 'careers',
            ],
            [
                'slug' => 'career-application-status-update',
                'name' => 'Career Application — Status Update',
                'subject' => 'Your application for {{career_title}} — {{new_status}}',
                'body' => view('emails.notification', [
                    'intro' => 'There\'s an update on your application for <strong>{{career_title}}</strong>.',
                    'fields' => [
                        'Previous Status' => '{{old_status}}',
                        'New Status' => '{{new_status}}',
                    ],
                    'quote' => '{{remarks}}',
                    'outro' => 'Thank you for your interest in joining {{app_name}}. We\'ll keep you posted as things progress.',
                    'signoff' => 'Best regards,<br>{{app_name}} Hiring Team',
                ])->render(),
                'variables' => ['name', 'career_title', 'old_status', 'new_status', 'remarks', 'app_name'],
                'type' => 'transactional',
                'module' => 'careers',
            ],
            [
                'slug' => 'enquiry-status-update',
                'name' => 'Enquiry — Status Update',
                'subject' => 'Update on your enquiry to {{app_name}}',
                'body' => view('emails.notification', [
                    'intro' => 'There\'s an update on the enquiry you submitted to {{app_name}}.',
                    'fields' => [
                        'Previous Status' => '{{old_status}}',
                        'New Status' => '{{new_status}}',
                    ],
                    'quote' => '{{admin_notes}}',
                    'outro' => 'Thanks for reaching out to {{app_name}} — we\'ll follow up if anything further is needed.',
                ])->render(),
                'variables' => ['name', 'old_status', 'new_status', 'admin_notes', 'app_name'],
                'type' => 'transactional',
                'module' => 'enquiries',
            ],
            [
                'slug' => 'newsletter-subscription-confirmation',
                'name' => 'Newsletter — Subscription Confirmation',
                'subject' => "You're subscribed to {{app_name}}!",
                'body' => view('emails.notification', [
                    'greeting' => 'Welcome, {{name}}!',
                    'intro' => 'You\'re now subscribed to the {{app_name}} newsletter. We\'ll keep you posted with our latest updates, offers, and news — straight to your inbox.',
                    'outro' => 'Thanks for joining us!',
                ])->render(),
                'variables' => ['name', 'app_name'],
                'type' => 'transactional',
                'module' => 'newsletter',
            ],
            [
                'slug' => 'newsletter-subscription-admin-notification',
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
                'type' => 'transactional',
                'module' => 'newsletter',
            ],
        ];
    }
}
