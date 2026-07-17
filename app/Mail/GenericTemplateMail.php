<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * One shared Mailable for every outgoing email in the app — compose,
 * templates, and any future transactional trigger all send through this,
 * wrapped in the same branded layout (logo header / body / footer).
 */
class GenericTemplateMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $mailSubject,
        public string $renderedBody,
    ) {
    }

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
