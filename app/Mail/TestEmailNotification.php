<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email de test envoyé depuis l'admin pour valider la configuration SMTP.
 * Volontairement NON ShouldQueue : l'admin a besoin du résultat immédiat.
 */
class TestEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $targetEmail
    ) {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Néré Mining] Test de configuration e-mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.test-notification',
            text: 'emails.test-notification-text',
            with: [
                'targetEmail' => $this->targetEmail,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
