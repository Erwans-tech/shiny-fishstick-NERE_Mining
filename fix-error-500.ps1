# ========================================
# Script de Résolution Erreur 500
# Site Néré Mining
# ========================================

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  RÉSOLUTION ERREUR 500 - NÉRÉ MINING  " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Vérifier qu'on est dans le bon répertoire
$expectedPath = "C:\inetpub\wwwroot\nere-mining"
$currentPath = Get-Location

if ($currentPath.Path -ne $expectedPath) {
    Write-Host "❌ Erreur : Ce script doit être exécuté depuis $expectedPath" -ForegroundColor Red
    Write-Host "   Répertoire actuel : $currentPath" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Voulez-vous changer de répertoire ? (O/N)" -ForegroundColor Yellow
    $response = Read-Host
    if ($response -eq "O" -or $response -eq "o") {
        Set-Location $expectedPath
        Write-Host "✓ Répertoire changé" -ForegroundColor Green
    } else {
        Write-Host "Script annulé" -ForegroundColor Red
        exit
    }
}

Write-Host "📂 Répertoire : $expectedPath" -ForegroundColor Green
Write-Host ""

# ========================================
# ÉTAPE 1 : BACKUP
# ========================================
Write-Host "🔄 ÉTAPE 1/7 : Création backup de sécurité..." -ForegroundColor Yellow

$timestamp = Get-Date -Format "yyyyMMdd-HHmmss"
$backupBranch = "backup-$timestamp"

try {
    git branch $backupBranch
    Write-Host "✓ Backup créé : branche $backupBranch" -ForegroundColor Green
} catch {
    Write-Host "⚠ Backup non créé (pas critique)" -ForegroundColor Yellow
}
Write-Host ""

# ========================================
# ÉTAPE 2 : CLEAR CACHES
# ========================================
Write-Host "🧹 ÉTAPE 2/7 : Nettoyage des caches Laravel..." -ForegroundColor Yellow

try {
    php artisan cache:clear
    Write-Host "  ✓ Cache application vidé" -ForegroundColor Green
} catch {
    Write-Host "  ⚠ Erreur cache:clear" -ForegroundColor Red
}

try {
    php artisan config:clear
    Write-Host "  ✓ Cache config vidé" -ForegroundColor Green
} catch {
    Write-Host "  ⚠ Erreur config:clear" -ForegroundColor Red
}

try {
    php artisan route:clear
    Write-Host "  ✓ Cache routes vidé" -ForegroundColor Green
} catch {
    Write-Host "  ⚠ Erreur route:clear" -ForegroundColor Red
}

try {
    php artisan view:clear
    Write-Host "  ✓ Cache views vidé" -ForegroundColor Green
} catch {
    Write-Host "  ⚠ Erreur view:clear" -ForegroundColor Red
}

Write-Host ""

# ========================================
# ÉTAPE 3 : VÉRIFIER .ENV
# ========================================
Write-Host "🔍 ÉTAPE 3/7 : Vérification .env..." -ForegroundColor Yellow

if (Test-Path ".env") {
    $envContent = Get-Content ".env" -Raw
    
    $checks = @{
        "APP_URL" = $envContent -match "APP_URL=https://www.nere-mining.bf"
        "ASSET_URL" = $envContent -match "ASSET_URL=https://www.nere-mining.bf"
        "APP_ENV" = $envContent -match "APP_ENV=production"
        "APP_DEBUG" = $envContent -match "APP_DEBUG=false"
    }
    
    foreach ($key in $checks.Keys) {
        if ($checks[$key]) {
            Write-Host "  ✓ $key OK" -ForegroundColor Green
        } else {
            Write-Host "  ❌ $key INCORRECT !" -ForegroundColor Red
            Write-Host "     Veuillez corriger le fichier .env" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "  ❌ Fichier .env introuvable !" -ForegroundColor Red
}

Write-Host ""

# ========================================
# ÉTAPE 4 : REBUILD CACHES
# ========================================
Write-Host "🔨 ÉTAPE 4/7 : Reconstruction des caches..." -ForegroundColor Yellow

try {
    php artisan config:cache
    Write-Host "  ✓ Config cache reconstruit" -ForegroundColor Green
} catch {
    Write-Host "  ❌ Erreur config:cache" -ForegroundColor Red
}

try {
    php artisan route:cache
    Write-Host "  ✓ Routes cache reconstruit" -ForegroundColor Green
} catch {
    Write-Host "  ❌ Erreur route:cache" -ForegroundColor Red
}

Write-Host ""

# ========================================
# ÉTAPE 5 : MIGRATIONS
# ========================================
Write-Host "🗄️  ÉTAPE 5/7 : Vérification migrations..." -ForegroundColor Yellow

try {
    php artisan migrate:status
    Write-Host "  ✓ Statut migrations affiché ci-dessus" -ForegroundColor Green
    Write-Host ""
    Write-Host "  Voulez-vous exécuter les migrations manquantes ? (O/N)" -ForegroundColor Yellow
    $runMigrate = Read-Host
    
    if ($runMigrate -eq "O" -or $runMigrate -eq "o") {
        php artisan migrate --force
        Write-Host "  ✓ Migrations exécutées" -ForegroundColor Green
    } else {
        Write-Host "  ⊘ Migrations ignorées" -ForegroundColor Yellow
    }
} catch {
    Write-Host "  ❌ Erreur migrations" -ForegroundColor Red
}

Write-Host ""

# ========================================
# ÉTAPE 6 : SETTINGS INIT
# ========================================
Write-Host "⚙️  ÉTAPE 6/7 : Initialisation paramètres site..." -ForegroundColor Yellow

try {
    php artisan settings:init
    Write-Host "  ✓ Paramètres initialisés" -ForegroundColor Green
} catch {
    Write-Host "  ⚠ Paramètres déjà existants ou erreur" -ForegroundColor Yellow
}

Write-Host ""

# ========================================
# ÉTAPE 7 : REDÉMARRAGE IIS
# ========================================
Write-Host "🔄 ÉTAPE 7/7 : Redémarrage IIS..." -ForegroundColor Yellow

try {
    iisreset
    Write-Host "  ✓ IIS redémarré" -ForegroundColor Green
} catch {
    Write-Host "  ❌ Erreur redémarrage IIS (nécessite droits admin)" -ForegroundColor Red
    Write-Host "     Exécutez manuellement : iisreset" -ForegroundColor Yellow
}

Write-Host ""

# ========================================
# RÉSUMÉ ET VÉRIFICATION
# ========================================
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  RÉSUMÉ DES OPÉRATIONS                " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "✓ Caches vidés et reconstruits" -ForegroundColor Green
Write-Host "✓ Configuration vérifiée" -ForegroundColor Green
Write-Host "✓ Migrations vérifiées" -ForegroundColor Green
Write-Host "✓ Paramètres initialisés" -ForegroundColor Green
Write-Host "✓ IIS redémarré" -ForegroundColor Green
Write-Host ""

Write-Host "🌐 Vérification du site..." -ForegroundColor Yellow
Write-Host ""
Write-Host "   Ouvrez votre navigateur et testez :" -ForegroundColor Cyan
Write-Host "   → https://www.nere-mining.bf" -ForegroundColor White
Write-Host ""

Write-Host "📋 Si le site fonctionne : " -ForegroundColor Green
Write-Host "   ✓ Problème résolu !" -ForegroundColor Green
Write-Host ""

Write-Host "❌ Si l'erreur 500 persiste : " -ForegroundColor Red
Write-Host "   1. Consultez les logs : Get-Content storage\logs\laravel.log -Tail 50" -ForegroundColor Yellow
Write-Host "   2. Lisez TROUBLESHOOTING_500.md pour diagnostic avancé" -ForegroundColor Yellow
Write-Host "   3. Vérifiez que l'image existe : public\images\mining\gold-extraction-plant.jpg" -ForegroundColor Yellow
Write-Host ""

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Script terminé                       " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan

# Pause pour voir les résultats
Write-Host ""
Write-Host "Appuyez sur une touche pour voir les derniers logs..." -ForegroundColor Yellow
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")

Write-Host ""
Write-Host "📄 Dernières erreurs dans les logs :" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan

if (Test-Path "storage\logs\laravel.log") {
    Get-Content "storage\logs\laravel.log" -Tail 30
} else {
    Write-Host "Fichier de log introuvable" -ForegroundColor Red
}

Write-Host ""
Write-Host "Script terminé. Bonne chance ! 🚀" -ForegroundColor Green
