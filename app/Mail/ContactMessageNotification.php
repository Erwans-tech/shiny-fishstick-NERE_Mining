<?php

namespace App\Mail;

use App\Models\ContactMessage;
use App\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public ContactMessage $message
    ) {
    }

    /**
     * Send the message using PHPMailer
     */
    public function send()
    {
        try {
            $mailService = new MailService();
            
            // Préparer le corps du mail HTML
            $body = $this->buildEmailBody();
            
            $mailService->send(
                to: $this->to[0]['address'] ?? config('mail.from.address'),
                subject: 'Nouveau message de contact: ' . ($this->message->subject ?? $this->message->type),
                body: $body,
                from: config('mail.from.address'),
                fromName: config('mail.from.name')
            );
        } catch (\Exception $e) {
            \Log::error('Erreur envoi notification contact: ' . $e->getMessage());
        }
    }

    /**
     * Construire le corps du mail HTML
     */
    private function buildEmailBody(): string
    {
        return view('emails.contact-message', [
            'message' => $this->message,
        ])->render();
    }
}
