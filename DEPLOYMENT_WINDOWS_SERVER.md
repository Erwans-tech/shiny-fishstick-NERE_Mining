# 🚀 Guide de Déploiement - Windows Server IIS

## 🎯 Configuration pour Windows Server avec IIS

Le serveur de production (`41.138.102.58`) utilise **Windows Server + IIS**, pas Apache.

## 📁 Fichiers Modifiés

```
public/web.config                         (nouveau - remplace .htaccess)
public/css/image-optimization.css         (nouveau)
public/js/image-optimization.js           (nouveau)
resources/views/pages/communities.blade.php (mis à jour)
```

## 🔧 Déploiement sur Windows Server

### Étape 1 : Se connecter au serveur

```powershell
# Via Remote Desktop
mstsc /v:41.138.102.58

# OU via PowerShell Remote
Enter-PSSession -ComputerName 41.138.102.58 -Credential (Get-Credential)
```

### Étape 2 : Aller dans le dossier du site

```powershell
# Exemple de chemin typique IIS
cd C:\inetpub\wwwroot\nere-mining
# OU
cd D:\websites\nere-mining
```

### Étape 3 : Pull les changements Git

```powershell
git pull origin production-stable
```

### Étape 4 : Vérifier que web.config est bien en place

```powershell
# Vérifier le fichier
Get-Content public\web.config

# Devrait afficher le contenu XML avec:
# - URL Rewrite pour Laravel
# - Compression GZIP
# - Cache Control headers
# - MIME types pour WebP
```

### Étape 5 : Activer la compression IIS

```powershell
# Ouvrir IIS Manager
Start-Process inetmgr

# OU via PowerShell (nécessite admin)
Import-Module WebAdministration

# Activer compression statique
Set-WebConfigurationProperty -PSPath 'MACHINE/WEBROOT/APPHOST' `
    -Filter "system.webServer/urlCompression" `
    -Name "doStaticCompression" `
    -Value "True"

# Activer compression dynamique
Set-WebConfigurationProperty -PSPath 'MACHINE/WEBROOT/APPHOST' `
    -Filter "system.webServer/urlCompression" `
    -Name "doDynamicCompression" `
    -Value "True"

# Installer Dynamic Content Compression si absent
Install-WindowsFeature -Name Web-Dyn-Compression

# Installer Static Content Compression si absent
Install-WindowsFeature -Name Web-Stat-Compression
```

### Étape 6 : Vérifier les MIME types pour WebP

```powershell
# Ajouter MIME type WebP si manquant
Add-WebConfigurationProperty -PSPath 'MACHINE/WEBROOT/APPHOST' `
    -Filter "system.webServer/staticContent" `
    -Name "." `
    -Value @{fileExtension='.webp'; mimeType='image/webp'}

# Vérifier
Get-WebConfigurationProperty -PSPath 'MACHINE/WEBROOT/APPHOST' `
    -Filter "system.webServer/staticContent" `
    -Name "collection" | Where-Object {$_.fileExtension -eq '.webp'}
```

### Étape 7 : Installer URL Rewrite Module (si pas déjà fait)

Si le module URL Rewrite n'est pas installé :

1. Télécharger depuis : https://www.iis.net/downloads/microsoft/url-rewrite
2. Ou via PowerShell :

```powershell
# Télécharger et installer URL Rewrite 2.1
$urlRewriteUrl = "https://download.microsoft.com/download/1/2/8/128E2E22-C1B9-44A4-BE2A-5859ED1D4592/rewrite_amd64_en-US.msi"
$installerPath = "$env:TEMP\urlrewrite.msi"

Invoke-WebRequest -Uri $urlRewriteUrl -OutFile $installerPath
Start-Process msiexec.argv -ArgumentList "/i `"$installerPath`" /quiet /norestart" -Wait
Remove-Item $installerPath
```

### Étape 8 : Vider le cache Laravel

```powershell
# Dans le dossier du site
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear
```

### Étape 9 : Recycler l'Application Pool IIS

```powershell
# Lister les Application Pools
Get-IISAppPool

# Recycler le pool du site (remplacer NereMining par le nom réel)
Restart-WebAppPool -Name "NereMining"

# OU via IIS Manager:
# 1. Ouvrir IIS Manager
# 2. Aller dans Application Pools
# 3. Clic droit sur le pool → Recycle
```

### Étape 10 : Vérifier les permissions fichiers

```powershell
# Le compte IIS doit avoir accès en lecture
$sitePath = "C:\inetpub\wwwroot\nere-mining\public"

# Donner permissions à IIS_IUSRS
icacls $sitePath /grant "IIS_IUSRS:(OI)(CI)RX" /T

# Donner permissions au dossier storage (lecture/écriture)
icacls "C:\inetpub\wwwroot\nere-mining\storage" /grant "IIS_IUSRS:(OI)(CI)M" /T
```

## ✅ Vérifications Post-Déploiement

### 1. Vérifier la compression GZIP

```powershell
# Tester si GZIP fonctionne
$headers = @{
    "Accept-Encoding" = "gzip, deflate"
}
$response = Invoke-WebRequest -Uri "http://41.138.102.58/css/image-optimization.css" -Headers $headers -UseBasicParsing

# Vérifier Content-Encoding
$response.Headers["Content-Encoding"]
# Devrait afficher: gzip
```

### 2. Vérifier les headers de cache

```powershell
# Tester une image
$response = Invoke-WebRequest -Uri "http://41.138.102.58/images/communaute/session-comite-suivi-liaison-ouahigouya-2026.webp" -UseBasicParsing

# Vérifier Cache-Control
$response.Headers["Cache-Control"]
# Devrait afficher: public, max-age=31536000, immutable
```

### 3. Tester la page dans le navigateur

1. Ouvrir : `http://41.138.102.58/developpement-durable/nos-communautes`
2. Ouvrir DevTools (F12) → Network
3. Recharger (Ctrl+Shift+R)

**Vérifier :**
- [ ] Images en format WebP
- [ ] `Cache-Control` headers présents
- [ ] `Content-Encoding: gzip`
- [ ] Lazy loading fonctionne au scroll
- [ ] Pas d'erreurs 404

## 🐛 Troubleshooting Windows Server

### Erreur 500.19 - Configuration invalide

**Cause :** Module URL Rewrite manquant

**Solution :**
```powershell
# Installer URL Rewrite Module
Install-WindowsFeature Web-Url-Rewrite
```

### Les images WebP ne s'affichent pas

**Cause :** MIME type WebP manquant

**Solution :**
```powershell
# Ajouter manuellement dans IIS Manager:
# 1. Sélectionner le site
# 2. Double-clic sur "MIME Types"
# 3. Ajouter:
#    Extension: .webp
#    MIME type: image/webp
```

OU via web.config (déjà inclus dans le fichier fourni).

### La compression GZIP ne fonctionne pas

**Solution :**
```powershell
# Vérifier que les modules sont installés
Get-WindowsFeature Web-Stat-Compression
Get-WindowsFeature Web-Dyn-Compression

# Installer si STATE = Available (pas Installed)
Install-WindowsFeature Web-Stat-Compression
Install-WindowsFeature Web-Dyn-Compression

# Redémarrer IIS
iisreset
```

### Erreur "Handler not found"

**Solution :**
```powershell
# S'assurer que le module FastCGI est installé
Install-WindowsFeature Web-CGI

# Vérifier le handler PHP dans IIS Manager
# Applications Pools → PHP Version → Handler Mappings
```

### Cache-Control headers ne s'appliquent pas

**Solution :**
```powershell
# Installer URL Rewrite pour les outbound rules
Install-WindowsFeature Web-Url-Rewrite

# Vérifier que ApplicationRequestRouting est installé
# Sinon, télécharger depuis:
# https://www.iis.net/downloads/microsoft/application-request-routing
```

## 📊 Tests de Performance

### Via PowerShell

```powershell
# Mesurer temps de chargement
Measure-Command {
    Invoke-WebRequest -Uri "http://41.138.102.58/developpement-durable/nos-communautes" -UseBasicParsing
}

# Devrait être < 2 secondes
```

### Via navigateur

1. **PageSpeed Insights** : https://pagespeed.web.dev/
2. **GTmetrix** : https://gtmetrix.com/
3. **WebPageTest** : https://www.webpagetest.org/

**Score attendu :** > 80/100

## 🔒 Sécurité

Le `web.config` inclut des headers de sécurité :

```xml
<add name="X-Content-Type-Options" value="nosniff" />
<add name="X-Frame-Options" value="SAMEORIGIN" />
<add name="X-XSS-Protection" value="1; mode=block" />
```

Pour renforcer (optionnel) :

```powershell
# Ajouter HSTS (HTTPS only)
Add-WebConfigurationProperty -PSPath 'MACHINE/WEBROOT/APPHOST' `
    -Filter "system.webServer/httpProtocol/customHeaders" `
    -Name "." `
    -Value @{name='Strict-Transport-Security'; value='max-age=31536000'}
```

## 📝 Checklist Finale

- [ ] Git pull effectué
- [ ] `web.config` présent dans `/public`
- [ ] URL Rewrite Module installé
- [ ] Compression GZIP activée
- [ ] MIME type WebP configuré
- [ ] Application Pool recyclé
- [ ] Cache Laravel vidé
- [ ] Permissions IIS_IUSRS correctes
- [ ] Page testée dans navigateur
- [ ] Images WebP chargent
- [ ] Headers Cache-Control présents
- [ ] Compression GZIP active
- [ ] Score PageSpeed > 80

## 🎯 Commande Rapide de Déploiement

```powershell
# Script complet (exécuter en tant qu'admin)
cd C:\inetpub\wwwroot\nere-mining

# Pull
git pull origin production-stable

# Vider cache Laravel
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Recycler IIS
Restart-WebAppPool -Name "NereMining"

# Optionnel : Redémarrer IIS complètement
# iisreset

Write-Host "✓ Déploiement terminé!" -ForegroundColor Green
```

## 📞 Support

Logs IIS : `C:\inetpub\logs\LogFiles\`
Logs Laravel : `storage\logs\laravel.log`

---

**Déploiement préparé le** : 2 septembre 2026  
**Serveur** : Windows Server @ 41.138.102.58  
**Status** : ✅ Prêt pour déploiement
