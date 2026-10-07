# 📧 PHPMailer Integration - Documentation

## 🎯 Vue d'ensemble

PHPMailer a été intégré au projet Néré Mining pour gérer les envois d'emails robustement et fiablement.

**Fichiers ajoutés :**
- `app/Services/MailService.php` - Service principal pour envoyer des emails
- `app/Facades/Mail.php` - Facade pour usage simplifié
- `config/mail.php` - Configuration des mailers
- `app/Examples/MailExample.php` - Exemples d'utilisation

**Dépendance ajoutée :**
```json
"phpmailer/phpmailer": "^6.9"
```

---

## ⚙️ Configuration

### 1. Variables d'environnement (.env)

Configurez les paramètres SMTP :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@nere-mining.bf
MAIL_FROM_NAME="Néré Mining"
```

### 2. Configuration pour différents services

#### Gmail SMTP
```env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password  # App password, pas le mot de passe Gmail
```

#### Outlook/Hotmail
```env
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-email@outlook.com
MAIL_PASSWORD=your-password
```

#### MailGun
```env
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@your-domain.mailgun.org
MAIL_PASSWORD=your-mailgun-password
```

---

## 🚀 Utilisation

### Utilisation simple avec le service directement

```php
<?php

use App\Services\MailService;

// Créer une instance du service
$mail = new MailService();

// Envoyer un email simple
$mail->send(
    to: 'user@example.com',
    subject: 'Sujet du message',
    body: '<h1>Bienvenue</h1><p>Contenu HTML du message</p>'
);
```

### Avec la Facade

```php
<?php

use App\Facades\Mail;

Mail::send(
    to: 'user@example.com',
    subject: 'Sujet',
    body: '<p>Contenu du message</p>'
);
```

---

## 📝 Méthodes disponibles

### 1. send() - Email simple

```php
$mail->send(
    to: 'user@example.com',           // Email destinataire (requis)
    subject: 'Sujet',                 // Sujet (requis)
    body: '<p>Contenu</p>',          // Corps HTML (requis)
    from: 'admin@nere-mining.bf',     // Expéditeur (optionnel)
    fromName: 'Néré Mining'           // Nom expéditeur (optionnel)
);

// Retourne : true si succès, false sinon
```

### 2. sendToMultiple() - Email multiple

```php
$recipients = [
    'user1@example.com',
    'user2@example.com',
    'user3@example.com'
];

$mail->sendToMultiple(
    recipients: $recipients,          // Tableau d'emails
    subject: 'Sujet',
    body: '<p>Contenu</p>',
    from: 'newsletter@nere-mining.bf',
    fromName: 'Newsletter Néré Mining'
);

// Retourne : true si succès, false sinon
```

### 3. sendWithAttachment() - Email avec pièce jointe

```php
$mail->sendWithAttachment(
    to: 'user@example.com',
    subject: 'Rapport mensuel',
    body: '<p>Veuillez trouver ci-joint...</p>',
    attachmentPath: storage_path('app/reports/report.pdf'),
    from: 'reports@nere-mining.bf',
    fromName: 'Rapports Néré Mining'
);

// Retourne : true si succès, false sinon
```

### 4. reset() - Réinitialiser

```php
// Réinitialiser les destinataires pour un nouvel email
$mail->reset();
```

---

## 📚 Exemples pratiques

### Email de contact du site

```php
// Dans un contrôleur
use App\Services\MailService;

public function sendContact(Request $request)
{
    $mail = new MailService();
    
    $success = $mail->send(
        to: config('mail.from.address'), // Envoyer à l'admin
        subject: 'Nouveau message du formulaire contact',
        body: view('emails.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ])->render()
    );
    
    if ($success) {
        return back()->with('success', 'Message envoyé avec succès');
    } else {
        return back()->with('error', 'Erreur lors de l\'envoi');
    }
}
```

### Newsletter

```php
// Dans un contrôleur ou comando
use App\Services\MailService;
use App\Models\NewsletterSubscriber;

public function sendNewsletter($newsId)
{
    $subscribers = NewsletterSubscriber::where('active', true)->pluck('email')->toArray();
    
    $mail = new MailService();
    
    $success = $mail->sendToMultiple(
        recipients: $subscribers,
        subject: 'Newsletter Néré Mining - Actualités',
        body: view('emails.newsletter', [
            'news' => News::find($newsId)
        ])->render()
    );
    
    return $success;
}
```

### Email avec rapport en pièce jointe

```php
use App\Services\MailService;

$mail = new MailService();

$success = $mail->sendWithAttachment(
    to: 'manager@nere-mining.bf',
    subject: 'Rapport analytique - ' . now()->format('F Y'),
    body: '<h2>Rapport du mois</h2><p>Veuillez trouver ci-joint le rapport détaillé.</p>',
    attachmentPath: storage_path('app/reports/analytics-' . now()->format('Y-m') . '.pdf')
);
```

---

## 🧪 Tests

### Test en développement

Dans le fichier `.env` de développement :
```env
MAIL_MAILER=log  # Les emails seront loggés au lieu d'être envoyés
```

Vérifiez les logs dans `storage/logs/laravel.log`

### Test avec Mailtrap

Excellent service gratuit pour tester les emails :

1. Inscrivez-vous sur https://mailtrap.io
2. Créez une boîte mail test
3. Récupérez les credentials SMTP
4. Configurez dans `.env` :

```env
MAIL_HOST=live.smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=api
MAIL_PASSWORD=your-mailtrap-token
MAIL_ENCRYPTION=tls
```

---

## 🔐 Sécurité

### 1. Ne jamais commiter les credentials

Assurez-vous que `.env` n'est pas commité :
```
# .gitignore
.env
.env.local
```

### 2. Utiliser des variables d'environnement en production

Sur le serveur de production, configurez les variables via :
- Panel d'administration du serveur
- Variables d'environnement système
- Fichiers `.env` locaux sécurisés

### 3. Valider les emails destinataires

```php
use Illuminate\Support\Facades\Validator;

$validator = Validator::make(['email' => $email], [
    'email' => 'required|email:rfc,dns'
]);

if ($validator->fails()) {
    // Email invalide
}
```

---

## 🐛 Troubleshooting

### Erreur: "SMTP connect() failed"

**Cause :** Impossible de se connecter au serveur SMTP

**Solutions :**
1. Vérifier les credentials (username/password)
2. Vérifier le HOST et PORT
3. Vérifier les pare-feu/restrictions réseau
4. Vérifier que le chiffrement (TLS/SSL) est correct

### Erreur: "Error: Could not instantiate mail function"

**Cause :** Le serveur n'a pas PHP mail() activé (et pas de SMTP configuré)

**Solution :** Configurer SMTP dans .env

### Email n'est pas reçu

**Cause :** Probablement filtré en spam

**Solutions :**
1. Vérifier le dossier spam
2. Configurer correctement MAIL_FROM_ADDRESS et MAIL_FROM_NAME
3. Vérifier les enregistrements DNS (SPF, DKIM, DMARC)

### "Too many login attempts"

**Cause :** Trop d'essais de connexion SMTP

**Solution :** Attendre quelques minutes avant de réessayer

---

## 📞 Support

Pour toute question ou problème, consultez :
- Documentation PHPMailer : https://github.com/PHPMailer/PHPMailer
- Documentation Laravel Mail : https://laravel.com/docs/mail
