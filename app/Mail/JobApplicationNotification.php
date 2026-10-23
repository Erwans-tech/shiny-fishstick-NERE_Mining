<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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

    public function build(): static
    {
        $mail = $this
            ->subject('Nouvelle candidature - ' . $this->application->full_name)
            ->view('emails.job-application', [
                'application' => $this->application,
                'job' => $this->application->jobOffer,
            ]);

        foreach ([
            'cv_path' => 'CV',
            'cover_letter_path' => 'Lettre_de_motivation',
        ] as $pathAttribute => $label) {
            $path = $this->application->{$pathAttribute}
                ? Storage::disk('local')->path($this->application->{$pathAttribute})
                : null;

            if ($path && is_file($path)) {
                $mail->attach($path, [
                    'as' => $label . '_' . $this->application->full_name . '.' . pathinfo($path, PATHINFO_EXTENSION),
                ]);
            }
        }

        return $mail;
    }

}
