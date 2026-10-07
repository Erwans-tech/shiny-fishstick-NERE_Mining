<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    /**
     * Instance de PHPMailer
     */
    private $mail;

    /**
     * Constructeur - Initialise PHPMailer
     */
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        
        // Configuration SMTP
        $this->mail->isSMTP();
        $this->mail->Host = config('mail.host', 'smtp.gmail.com');
        $this->mail->Port = config('mail.port', 587);
        $this->mail->SMTPAuth = true;
        $this->mail->Username = config('mail.username');
        $this->mail->Password = config('mail.password');
        $this->mail->SMTPSecure = config('mail.encryption', 'tls');
        $this->mail->CharSet = 'UTF-8';
    }

    /**
     * Envoyer un email simple
     *
     * @param string $to Email destinataire
     * @param string $subject Sujet
     * @param string $body Corps du message (HTML ou texte)
     * @param string|null $from Email d'envoi (optionnel)
     * @param string|null $fromName Nom d'envoi (optionnel)
     * @return bool
     */
    public function send($to, $subject, $body, $from = null, $fromName = null)
    {
        try {
            // Expéditeur
            $this->mail->setFrom(
                $from ?? config('mail.from.address'),
                $fromName ?? config('mail.from.name')
            );

            // Destinataire
            $this->mail->addAddress($to);

            // Sujet et corps
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->isHTML(true);

            // Envoyer
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            \Log::error('Erreur envoi email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoyer un email à plusieurs destinataires
     *
     * @param array $recipients Tableau d'emails destinataires
     * @param string $subject Sujet
     * @param string $body Corps du message
     * @param string|null $from Email d'envoi
     * @param string|null $fromName Nom d'envoi
     * @return bool
     */
    public function sendToMultiple(array $recipients, $subject, $body, $from = null, $fromName = null)
    {
        try {
            // Expéditeur
            $this->mail->setFrom(
                $from ?? config('mail.from.address'),
                $fromName ?? config('mail.from.name')
            );

            // Destinataires
            foreach ($recipients as $recipient) {
                $this->mail->addAddress($recipient);
            }

            // Sujet et corps
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->isHTML(true);

            // Envoyer
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            \Log::error('Erreur envoi email multiple: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoyer un email avec pièce jointe
     *
     * @param string $to Email destinataire
     * @param string $subject Sujet
     * @param string $body Corps du message
     * @param string $attachmentPath Chemin de la pièce jointe
     * @param string|null $from Email d'envoi
     * @param string|null $fromName Nom d'envoi
     * @return bool
     */
    public function sendWithAttachment($to, $subject, $body, $attachmentPath, $from = null, $fromName = null)
    {
        try {
            // Expéditeur
            $this->mail->setFrom(
                $from ?? config('mail.from.address'),
                $fromName ?? config('mail.from.name')
            );

            // Destinataire
            $this->mail->addAddress($to);

            // Pièce jointe
            if (file_exists($attachmentPath)) {
                $this->mail->addAttachment($attachmentPath);
            }

            // Sujet et corps
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->isHTML(true);

            // Envoyer
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            \Log::error('Erreur envoi email avec pièce jointe: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Réinitialiser le destinataire pour un nouvel email
     */
    public function reset()
    {
        $this->mail->clearAllRecipients();
        return $this;
    }
}
