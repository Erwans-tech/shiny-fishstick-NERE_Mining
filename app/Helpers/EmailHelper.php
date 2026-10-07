<?php

namespace App\Helpers;

use App\Services\MailService;
use App\Models\SiteSetting;

class EmailHelper
{
    /**
     * Envoyer un email de notification de candidature au RH
     *
     * @param \App\Models\JobApplication $application
     * @return bool
     */
    public static function sendJobApplicationNotification($application)
    {
        try {
            $application->load('jobOffer');
            
            $mailService = new MailService();
            
            // Construire le corps HTML de l'email
            $body = view('emails.job-application', [
                'application' => $application,
                'job' => $application->jobOffer,
            ])->render();
            
            // Récupérer l'email du RH
            $hrEmail = SiteSetting::get('hr_email_address') ?? config('mail.from.address');
            
            // Déterminer si des pièces jointes existent
            $cvPath = null;
            if ($application->cv_path && file_exists(storage_path('app/' . $application->cv_path))) {
                $cvPath = storage_path('app/' . $application->cv_path);
            }
            
            // Envoyer
            if ($cvPath) {
                return $mailService->sendWithAttachment(
                    to: $hrEmail,
                    subject: 'Nouvelle candidature - ' . $application->first_name . ' ' . $application->last_name,
                    body: $body,
                    attachmentPath: $cvPath,
                    from: config('mail.from.address'),
                    fromName: config('mail.from.name')
                );
            } else {
                return $mailService->send(
                    to: $hrEmail,
                    subject: 'Nouvelle candidature - ' . $application->first_name . ' ' . $application->last_name,
                    body: $body,
                    from: config('mail.from.address'),
                    fromName: config('mail.from.name')
                );
            }
        } catch (\Exception $e) {
            \Log::error('Erreur envoi notification candidature: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoyer un email de notification de message de contact au RH
     *
     * @param \App\Models\ContactMessage $message
     * @return bool
     */
    public static function sendContactMessageNotification($message)
    {
        try {
            $mailService = new MailService();
            
            // Construire le corps HTML de l'email
            $body = view('emails.contact-message', [
                'message' => $message,
            ])->render();
            
            // Récupérer l'email du RH
            $hrEmail = SiteSetting::get('hr_email_address') ?? config('mail.from.address');
            
            return $mailService->send(
                to: $hrEmail,
                subject: 'Nouveau message de contact: ' . ($message->subject ?? $message->type),
                body: $body,
                from: config('mail.from.address'),
                fromName: config('mail.from.name')
            );
        } catch (\Exception $e) {
            \Log::error('Erreur envoi notification contact: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoyer un email de confirmation au candidat
     *
     * @param \App\Models\JobApplication $application
     * @param string $locale
     * @return bool
     */
    public static function sendJobApplicationConfirmation($application, string $locale = 'fr')
    {
        try {
            $mailService = new MailService();
            
            $subject = $locale === 'en'
                ? 'Application Confirmation - Néré Mining'
                : 'Confirmation de candidature - Néré Mining';
            
            $body = $locale === 'en'
                ? '<p>Dear ' . $application->first_name . ',</p>' .
                  '<p>Thank you for submitting your application to Néré Mining. We have received your candidacy and will review it shortly.</p>' .
                  '<p>Best regards,<br>The Néré Mining Team</p>'
                : '<p>Bonjour ' . $application->first_name . ',</p>' .
                  '<p>Merci de nous avoir soumis votre candidature. Nous avons bien reçu votre dossier et l\'examinerons prochainement.</p>' .
                  '<p>Cordialement,<br>L\'équipe Néré Mining</p>';
            
            return $mailService->send(
                to: $application->email,
                subject: $subject,
                body: $body,
                from: config('mail.from.address'),
                fromName: config('mail.from.name')
            );
        } catch (\Exception $e) {
            \Log::error('Erreur envoi confirmation candidature: ' . $e->getMessage());
            return false;
        }
    }
}
