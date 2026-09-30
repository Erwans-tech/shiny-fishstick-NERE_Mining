<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class JobApplicationNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Le mail part en tâche de fond : un serveur SMTP lent ou injoignable
     * ne peut plus faire expirer la soumission de la candidature (erreur 502).
     */
    public int $tries = 3;

    public int $backoff = 60;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public JobApplication $jobApplication
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
        $jobTitle = $this->jobApplication->jobOffer->title ?? 'Candidature spontanée';
        
        return new Envelope(
            subject: '[Néré Mining] Nouvelle candidature - ' . $jobTitle,
            replyTo: $this->jobApplication->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.job-application-notification',
            text: 'emails.job-application-notification-text',
            with: [
                'application' => $this->jobApplication,
                'jobOffer' => $this->jobApplication->jobOffer,
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
        $attachments = [];

        // Ajouter le CV s'il existe
        if ($this->jobApplication->cv_path && Storage::disk(config('filesystems.default'))->exists($this->jobApplication->cv_path)) {
            $attachments[] = Attachment::fromStorageDisk(
                config('filesystems.default'),
                $this->jobApplication->cv_path
            )->as('CV_' . $this->jobApplication->full_name . '.pdf');
        }

        // Ajouter la lettre de motivation s'elle existe
        if ($this->jobApplication->cover_letter_path && Storage::disk(config('filesystems.default'))->exists($this->jobApplication->cover_letter_path)) {
            $attachments[] = Attachment::fromStorageDisk(
                config('filesystems.default'),
                $this->jobApplication->cover_letter_path
            )->as('Lettre_motivation_' . $this->jobApplication->full_name . '.pdf');
        }

        return $attachments;
    }
}
