<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $body)
    {
        $expiration = now('America/Mexico_City')->addHours(12);
        $this->name = $user->name;
        $this->url = URL::temporarySignedRoute(
            'forgot-password.attend',
            $expiration,
            ['body' => urlencode($body)
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contraseña olvidada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.forgot-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
