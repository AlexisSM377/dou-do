<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

/**
 * Class to build a verification email
 */
class VerifyAccount extends Mailable
{
    use Queueable, SerializesModels;

    //* Variables
    public $name;
    public $url;

    /**
     * Undocumented function
     *
     * @param User $user
     * @param string $token
     */
    public function __construct($user, $body)
    {
        $expiration = now('America/Mexico_City')->addHours(12);
        $this->name = $user->name;
        $this->url = URL::temporarySignedRoute(
            'verification.attend',
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
            subject: 'Verificación de cuenta',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.verify-account',
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
