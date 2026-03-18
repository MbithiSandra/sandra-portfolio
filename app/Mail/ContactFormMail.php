<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public string $senderName;
    public string $senderEmail;
    public string $emailSubject;
    public string $messageBody;
    public string $messageType;

    
    public function __construct(array $formData)
    {
        $this->senderName  = $formData['name'];
        $this->senderEmail = $formData['email'];
        $this->emailSubject = $formData['subject'];
        $this->messageBody = $formData['message'];
        $this->messageType = $formData['type'];
    }

    // Defines the email subject line
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Portfolio] ' . $this->emailSubject,
        );
    }

    // Defines which blade view to use as the email body
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
        );
    }
}
