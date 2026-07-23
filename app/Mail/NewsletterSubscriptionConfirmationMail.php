<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscriptionConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $mailSubject,
        public string $renderedBody,
    ) {}

    public function build(): static
    {
        return $this->subject($this->mailSubject)
            ->view('emails.layout')
            ->with([
                'subject' => $this->mailSubject,
                'body' => $this->renderedBody,
            ]);
    }
}
