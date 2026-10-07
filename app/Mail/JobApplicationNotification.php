<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public JobApplication $application
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
            
            // Envoyer avec pièce jointe si présente
            if ($this->application->cv_path) {
                $cvPath = storage_path('app/' . $this->application->cv_path);
                $mailService->sendWithAttachment(
                    to: $this->to[0]['address'] ?? config('mail.from.address'),
                    subject: 'Nouvelle candidature - ' . $this->application->first_name . ' ' . $this->application->last_name,
                    body: $body,
                    attachmentPath: $cvPath,
                    from: config('mail.from.address'),
                    fromName: config('mail.from.name')
                );
            } else {
                $mailService->send(
                    to: $this->to[0]['address'] ?? config('mail.from.address'),
                    subject: 'Nouvelle candidature - ' . $this->application->first_name . ' ' . $this->application->last_name,
                    body: $body,
                    from: config('mail.from.address'),
                    fromName: config('mail.from.name')
                );
            }
        } catch (\Exception $e) {
            \Log::error('Erreur envoi notification candidature: ' . $e->getMessage());
        }
    }

    /**
     * Construire le corps du mail HTML
     */
    private function buildEmailBody(): string
    {
        return view('emails.job-application', [
            'application' => $this->application,
            'job' => $this->application->jobOffer,
        ])->render();
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->application->cv_path && file_exists(storage_path('app/' . $this->application->cv_path))) {
            $attachments[] = [
                'path' => storage_path('app/' . $this->application->cv_path),
                'name' => 'CV_' . $this->application->first_name . '_' . $this->application->last_name . '.pdf',
            ];
        }

        if ($this->application->cover_letter_path && file_exists(storage_path('app/' . $this->application->cover_letter_path))) {
            $attachments[] = [
                'path' => storage_path('app/' . $this->application->cover_letter_path),
                'name' => 'CoverLetter_' . $this->application->first_name . '_' . $this->application->last_name . '.pdf',
            ];
        }

        return $attachments;
    }
}
