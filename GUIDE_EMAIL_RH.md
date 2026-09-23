# Guide d'activation du système email automatique RH

## ✅ Système réactivé avec succès !

Le système de redirection automatique des emails est maintenant **actif** sur votre site. Voici comment terminer la configuration :

## 🔧 Configuration sur le serveur Windows

### 1. Exécuter le script d'activation

Sur votre serveur Windows, dans PowerShell en tant qu'Administrateur :

```powershell
cd C:\inetpub\wwwroot\nere_website
.\activate_email_system.ps1
```

### 2. Configurer le SMTP dans .env

Modifiez votre fichier `.env` sur le serveur pour activer l'envoi d'emails :

```env
# Configuration email SMTP
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre_email@gmail.com
MAIL_PASSWORD=votre_mot_de_passe_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@nere-mining.bf"
MAIL_FROM_NAME="Nere Mining"
```

**Pour Gmail :**
- Activez l'authentification à 2 facteurs
- Générez un "mot de passe d'application" 
- Utilisez ce mot de passe (pas votre mot de passe principal)

### 3. Configurer l'adresse email RH

Allez dans l'admin panel : `https://www.nere-mining.bf/gestion-nm/parametres`

Dans la section "Configuration Email RH" :
- **Adresse email RH** : `hr@nere-mining.bf` (ou l'adresse souhaitée)
- **Transfert messages** : ✅ Activé
- **Transfert candidatures** : ✅ Activé

### 4. Tester le système

```powershell
php test_email_rh.php
```

Ce script va :
- Vérifier la configuration
- Envoyer un email de test
- Vous informer si tout fonctionne

## 📧 Fonctionnement du système

### Messages de contact
Quand un visiteur envoie un message via le formulaire de contact :
1. ✅ Le message est enregistré dans l'admin panel
2. ✅ Un email automatique est envoyé aux RH avec :
   - Nom et email du visiteur
   - Sujet et message complet
   - Date et heure de réception

### Candidatures d'emploi
Quand quelqu'un postule à une offre d'emploi :
1. ✅ La candidature est enregistrée dans l'admin panel
2. ✅ Un email automatique est envoyé aux RH avec :
   - Informations du candidat
   - Poste visé
   - CV et lettre de motivation en pièce jointe
   - Lien vers la candidature complète

## ⚙️ Paramétrage avancé

Dans l'admin panel, vous pouvez :
- **Activer/désactiver** le transfert automatique
- **Changer l'adresse email RH** à tout moment
- **Configurer séparément** les messages et candidatures

## 🔍 Dépannage

### Email pas reçu ?
1. Vérifiez les logs : `storage/logs/laravel.log`
2. Testez avec : `php test_email_rh.php`
3. Vérifiez les spams de votre boîte mail

### Configuration SMTP
- **Gmail** : Utilisez un mot de passe d'application
- **Outlook** : Port 587, STARTTLS
- **SMTP personnalisé** : Contactez votre fournisseur

### Permissions fichiers
Si erreur de permissions :
```powershell
icacls storage /grant "IIS_IUSRS:(OI)(CI)F" /T
```

## 📞 Support

En cas de problème :
1. Consultez les logs dans `storage/logs/laravel.log`
2. Vérifiez la config email avec `php artisan config:show mail`
3. Testez avec le script fourni

---

**🎉 Le système est maintenant opérationnel !**

Tous les messages et candidatures seront automatiquement transférés vers l'adresse email RH configurée, tout en restant disponibles dans l'interface d'administration.