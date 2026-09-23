# Script de réparation pour le serveur Windows Néré Mining
# À exécuter en tant qu'Administrateur dans PowerShell

$webRoot = "C:\inetpub\wwwroot\nere_website"
cd $webRoot

Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "   RÉPARATION SERVEUR NÉRÉ MINING - WINDOWS SERVER    " -ForegroundColor Cyan  
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan

# 1. Sauvegarder l'ancien .env corrompu
Write-Host "`n1. Sauvegarde de l'ancien .env..." -ForegroundColor Yellow
if (Test-Path ".env") {
    Copy-Item ".env" ".env.corrupted.backup"
    Write-Host "   ✓ Ancien .env sauvegardé vers .env.corrupted.backup" -ForegroundColor Green
}

# 2. Créer un nouveau .env propre
Write-Host "`n2. Création d'un nouveau .env propre..." -ForegroundColor Yellow
$cleanEnv = @"
# NÉRÉ MINING - Configuration PRODUCTION Windows Server
APP_NAME="Nere Mining"
APP_ENV=production
APP_KEY=base64:94Pj32zaWfACkDUY5e37eYB0P9D8FDkxJkuidcIHTbY=
APP_DEBUG=false
APP_URL=https://www.nere-mining.bf
APP_TIMEZONE=Africa/Ouagadougou

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr

# Base de données PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=nere_website_db
DB_USERNAME=postgres
DB_PASSWORD=/NereMINING/

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync

# Logs
LOG_CHANNEL=daily
LOG_LEVEL=warning

# Email (à configurer si nécessaire)
MAIL_MAILER=smtp
MAIL_FROM_ADDRESS="noreply@nere-mining.bf"
MAIL_FROM_NAME="Nere Mining"

# Admin
ADMIN_EMAIL=admin@nere-mining.bf
ADMIN_PASSWORD=NereMining2026!
"@

$cleanEnv | Out-File -FilePath ".env" -Encoding UTF8 -NoNewline
Write-Host "   ✓ Nouveau .env créé avec encodage UTF-8" -ForegroundColor Green

# 3. Créer les répertoires cache manquants
Write-Host "`n3. Création des répertoires cache..." -ForegroundColor Yellow
$directories = @(
    "bootstrap\cache",
    "storage\framework\cache",
    "storage\framework\cache\data",
    "storage\framework\sessions", 
    "storage\framework\views",
    "storage\logs",
    "storage\app\public"
)

foreach ($dir in $directories) {
    if (!(Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
        Write-Host "   ✓ Créé: $dir" -ForegroundColor Green
    } else {
        Write-Host "   - Existe: $dir" -ForegroundColor Gray
    }
}

# 4. Définir les permissions IIS
Write-Host "`n4. Configuration des permissions IIS..." -ForegroundColor Yellow
$folders = @("bootstrap", "storage")

foreach ($folder in $folders) {
    if (Test-Path $folder) {
        icacls $folder /grant "IIS_IUSRS:(OI)(CI)F" /T /Q 2>$null
        icacls $folder /grant "IUSR:(OI)(CI)F" /T /Q 2>$null
        icacls $folder /grant "Everyone:(OI)(CI)F" /T /Q 2>$null
        Write-Host "   ✓ Permissions définies pour: $folder" -ForegroundColor Green
    }
}

# 5. Créer les fichiers .gitkeep
Write-Host "`n5. Création des fichiers .gitkeep..." -ForegroundColor Yellow
$gitkeepDirs = @(
    "storage\framework\cache\data",
    "storage\framework\sessions",
    "storage\framework\views"
)

foreach ($dir in $gitkeepDirs) {
    $gitkeepPath = "$dir\.gitkeep"
    if (!(Test-Path $gitkeepPath)) {
        "" | Out-File -FilePath $gitkeepPath -Encoding UTF8
        Write-Host "   ✓ Créé: $gitkeepPath" -ForegroundColor Green
    }
}

# 6. Test des commandes Laravel
Write-Host "`n6. Test des commandes Laravel..." -ForegroundColor Yellow

Write-Host "   Test artisan --version..." -NoNewline
try {
    $version = php artisan --version 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host " ✓" -ForegroundColor Green
    } else {
        Write-Host " ✗ ($version)" -ForegroundColor Red
    }
} catch {
    Write-Host " ✗ Exception" -ForegroundColor Red
}

Write-Host "   Test config:clear..." -NoNewline
try {
    php artisan config:clear 2>&1 | Out-Null
    if ($LASTEXITCODE -eq 0) {
        Write-Host " ✓" -ForegroundColor Green
    } else {
        Write-Host " ✗" -ForegroundColor Red
    }
} catch {
    Write-Host " ✗" -ForegroundColor Red
}

Write-Host "   Test route:clear..." -NoNewline  
try {
    php artisan route:clear 2>&1 | Out-Null
    if ($LASTEXITCODE -eq 0) {
        Write-Host " ✓" -ForegroundColor Green
    } else {
        Write-Host " ✗" -ForegroundColor Red  
    }
} catch {
    Write-Host " ✗" -ForegroundColor Red
}

Write-Host "   Test view:clear..." -NoNewline
try {
    php artisan view:clear 2>&1 | Out-Null 
    if ($LASTEXITCODE -eq 0) {
        Write-Host " ✓" -ForegroundColor Green
    } else {
        Write-Host " ✗" -ForegroundColor Red
    }
} catch {
    Write-Host " ✗" -ForegroundColor Red
}

# 7. Redémarrer IIS
Write-Host "`n7. Redémarrage d'IIS..." -ForegroundColor Yellow
try {
    iisreset /noforce 2>&1 | Out-Null
    Write-Host "   ✓ IIS redémarré" -ForegroundColor Green
} catch {
    Write-Host "   ⚠ Impossible de redémarrer IIS automatiquement" -ForegroundColor Yellow
    Write-Host "   → Redémarrez manuellement via le Gestionnaire IIS" -ForegroundColor Yellow
}

Write-Host "`n═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "                    RÉPARATION TERMINÉE                 " -ForegroundColor Cyan
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan

Write-Host "`nÉtapes suivantes:" -ForegroundColor White
Write-Host "1. Vérifiez que le site fonctionne dans le navigateur" -ForegroundColor White  
Write-Host "2. Configurez les paramètres email si nécessaire" -ForegroundColor White
Write-Host "3. Testez les fonctionnalités (contact, candidatures)" -ForegroundColor White

if (Test-Path ".env.corrupted.backup") {
    Write-Host "`nNote: L'ancien .env corrompu est sauvegardé dans .env.corrupted.backup" -ForegroundColor Gray
}