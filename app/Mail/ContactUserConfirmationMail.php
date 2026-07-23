<?php

namespace App\Mail;

use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Static, hardcoded design (no database template lookup) — confirms
 * receipt of a contact form submission to the person who submitted it.
 */
class ContactUserConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Enquiry $enquiry,
    ) {}

    public function build(): static
    {
        $subject = 'Thanks for contacting '.config('constants.BUSINESS.name')
            .' — '.($this->enquiry->subject ?: 'your enquiry');

        return $this->subject($subject)
            ->view('emails.layout')
            ->with([
                'subject' => $subject,
                'body' => view('emails.contact-user-static', ['enquiry' => $this->enquiry])->render(),
            ]);
    }
}
