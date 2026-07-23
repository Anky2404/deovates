<?php

namespace App\Mail;

use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Static, hardcoded design (no database template lookup) — notifies an
 * admin address of a new contact form submission.
 */
class ContactAdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Enquiry $enquiry,
    ) {
    }

    public function build(): static
    {
        $subject = 'New contact enquiry from ' . $this->enquiry->name
            . ' — ' . ($this->enquiry->subject ?: 'your enquiry');

        return $this->subject($subject)
            ->view('emails.layout')
            ->with([
                'subject' => $subject,
                'body' => view('emails.contact-admin-static', ['enquiry' => $this->enquiry])->render(),
            ]);
    }
}
