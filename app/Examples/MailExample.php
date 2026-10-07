<?php

namespace App\Examples;

use App\Services\MailService;

class MailExample
{
    /**
     * Exemple 1: Envoyer un email simple
     */
    public static function sendSimpleEmail()
    {
        $mail = new MailService();
        
        $success = $mail->send(
            to: 'recipient@example.com',
            subject: 'Bienvenue chez Néré Mining',
            body: '<h1>Bienvenue!</h1><p>Merci de nous avoir contacté.</p>',
            from: 'contact@nere-mining.bf',
            fromName: 'Néré Mining'
        );

        return $success ? 'Email envoyé avec succès' : 'Erreur lors de l\'envoi';
    }

    /**
     * Exemple 2: Envoyer un email à plusieurs destinataires
     */
    public static function sendToMultiple()
    {
        $mail = new MailService();
        
        $recipients = [
            'user1@example.com',
            'user2@example.com',
            'user3@example.com',
        ];

        $success = $mail->sendToMultiple(
            recipients: $recipients,
            subject: 'Notification importante',
            body: '<h2>Actualité Néré Mining</h2><p>Voici les dernières nouvelles...</p>',
            from: 'newsletter@nere-mining.bf',
            fromName: 'Newsletter Néré Mining'
        );

        return $success ? 'Emails envoyés' : 'Erreur lors de l\'envoi';
    }

    /**
     * Exemple 3: Envoyer un email avec pièce jointe
     */
    public static function sendWithAttachment()
    {
        $mail = new MailService();
        
        $success = $mail->sendWithAttachment(
            to: 'manager@example.com',
            subject: 'Rapport mensuel Néré Mining',
            body: '<h2>Rapport du mois</h2><p>Veuillez trouver ci-joint le rapport détaillé.</p>',
            attachmentPath: storage_path('app/reports/monthly-report.pdf'),
            from: 'reports@nere-mining.bf',
            fromName: 'Rapports Néré Mining'
        );

        return $success ? 'Email avec pièce jointe envoyé' : 'Erreur lors de l\'envoi';
    }
}
