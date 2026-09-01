<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data)
    {
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission — ' . ($this->data['company'] ?? 'Sewgo Website'))
            ->replyTo($this->data['work_email'], trim($this->data['first_name'] . ' ' . $this->data['last_name']))
            ->view('emails.contact-form');
    }
}
