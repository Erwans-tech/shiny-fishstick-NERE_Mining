# Script d'activation du système d'email automatique RH - Windows Server
# À exécuter sur le serveur de production

$webRoot = "C:\inetpub\wwwroot\nere_website"
cd $webRoot

Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "   ACTIVATION SYSTÈME EMAIL AUTOMATIQUE RH            " -ForegroundColor Cyan  
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan

# 1. Exécuter le seeder pour les paramètres RH
Write-Host "`n1. Installation des paramètres RH..." -ForegroundColor Yellow
try {
    php artisan db:seed --class=HRSettingsSeeder --force
    Write-Host "   ✓ Paramètres RH installés" -ForegroundColor Green
} catch {
    Write-Host "   ⚠ Erreur lors de l'installation des paramètres" -ForegroundColor Red
    Write-Host "   Vérifiez que la base de données est accessible" -ForegroundColor Yellow
}

# 2. Afficher les étapes de configuration email
Write-Host "`n2. Configuration requise pour les emails..." -ForegroundColor Yellow
Write-Host "   Pour activer l'envoi d'emails, vous devez configurer:" -ForegroundColor White
Write-Host "   " -ForegroundColor White
Write-Host "   📧 SMTP dans le fichier .env:" -ForegroundColor White
Write-Host "      MAIL_MAILER=smtp" -ForegroundColor Gray
Write-Host "      MAIL_HOST=smtp.gmail.com" -ForegroundColor Gray
Write-Host "      MAIL_PORT=587" -ForegroundColor Gray
Write-Host "      MAIL_USERNAME=votre_email@gmail.com" -ForegroundColor Gray
Write-Host "      MAIL_PASSWORD=votre_mot_de_passe_app" -ForegroundColor Gray
Write-Host "      MAIL_ENCRYPTION=tls" -ForegroundColor Gray
Write-Host "   " -ForegroundColor White
Write-Host "   ⚙️  Adresse email RH dans l'admin panel:" -ForegroundColor White
Write-Host "      https://www.nere-mining.bf/gestion-nm/parametres" -ForegroundColor Gray
Write-Host "   " -ForegroundColor White

# 3. Créer un script de test d'email
Write-Host "`n3. Création du script de test..." -ForegroundColor Yellow
$testEmailScript = @"
<?php
// Script de test email pour Néré Mining - À exécuter une fois la config terminée

require_once 'vendor/autoload.php';

use App\Models\SiteSetting;
use App\Models\ContactMessage;
use App\Mail\ContactMessageNotification;
use Illuminate\Support\Facades\Mail;

`$app = require_once 'bootstrap/app.php';
`$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== TEST EMAIL AUTOMATIQUE RH ===\n";

// Vérifier les paramètres RH
`$hrEmail = SiteSetting::get('hr_email_address');
`$autoForwardMessages = SiteSetting::get('hr_auto_forward_messages', 'true') === 'true';

echo "Email RH configuré: " . (`$hrEmail ?: 'NON CONFIGURÉ') . "\n";
echo "Transfert automatique activé: " . (`$autoForwardMessages ? 'OUI' : 'NON') . "\n";

if (!`$hrEmail) {
    echo "\n❌ ERREUR: Aucune adresse email RH configurée\n";
    echo "Allez dans l'admin panel pour configurer l'adresse email RH\n";
    exit(1);
}

// Créer un message de test
`$testMessage = ContactMessage::create([
    'name' => 'Test Automatique',
    'email' => 'test@example.com', 
    'subject' => 'Test du système email automatique',
    'message' => 'Ceci est un message de test pour vérifier le système de redirection automatique des emails vers les RH.',
    'type' => 'general'
]);

// Tenter l'envoi
try {
    Mail::to(`$hrEmail)->send(new ContactMessageNotification(`$testMessage));
    echo "\n✓ EMAIL DE TEST ENVOYÉ AVEC SUCCÈS vers `$hrEmail\n";
    echo "Vérifiez votre boîte mail RH pour confirmer la réception.\n";
} catch (Exception `$e) {
    echo "\n❌ ERREUR LORS DE L'ENVOI: " . `$e->getMessage() . "\n";
    echo "Vérifiez la configuration SMTP dans le fichier .env\n";
}

// Nettoyer le message de test
`$testMessage->delete();
echo "\nMessage de test supprimé de la base de données.\n";
"@

$testEmailScript | Out-File -FilePath "test_email_rh.php" -Encoding UTF8
Write-Host "   ✓ Script de test créé: test_email_rh.php" -ForegroundColor Green

# 4. Instructions finales
Write-Host "`n4. Étapes suivantes:" -ForegroundColor Yellow
Write-Host "   " -ForegroundColor White
Write-Host "   📝 1. Configurez le SMTP dans .env (voir exemple ci-dessus)" -ForegroundColor White
Write-Host "   📝 2. Allez dans l'admin panel: /gestion-nm/parametres" -ForegroundColor White
Write-Host "   📝 3. Renseignez l'adresse email RH" -ForegroundColor White
Write-Host "   📝 4. Testez avec: php test_email_rh.php" -ForegroundColor White
Write-Host "   " -ForegroundColor White

Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "          SYSTÈME EMAIL AUTOMATIQUE ACTIVÉ           " -ForegroundColor Cyan
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan

Write-Host "`nLe système de redirection automatique est maintenant actif!" -ForegroundColor Green
Write-Host "Les messages de contact et candidatures seront automatiquement" -ForegroundColor Green  
Write-Host "transférés vers l'adresse email RH une fois configurée." -ForegroundColor Green