<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Le mail part en tâche de fond : un serveur SMTP lent ou injoignable
     * ne peut plus faire expirer la soumission du formulaire (erreur 502).
     */
    public int $tries = 3;

    public int $backoff = 60;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public ContactMessage $contactMessage
    ) {
        // Ne dispatcher qu'une fois la transaction validée, sinon le worker
        // pourrait charger le modèle avant qu'il n'existe en base.
        $this->afterCommit();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Néré Mining] Nouveau message de contact - ' . ($this->contactMessage->subject ?: 'Sans sujet'),
            replyTo: $this->contactMessage->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.contact-message-notification',
            text: 'emails.contact-message-notification-text',
            with: [
                'contactMessage' => $this->contactMessage,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
