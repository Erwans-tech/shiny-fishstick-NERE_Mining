# ========================================
# Script de Résolution Merge Git Bloqué
# Site Néré Mining - Production
# ========================================

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  FIX MERGE GIT BLOQUÉ - PRODUCTION    " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Vérifier qu'on est dans le bon répertoire
$expectedPath = "C:\inetpub\wwwroot\nere-mining"
$currentPath = Get-Location

if ($currentPath.Path -ne $expectedPath) {
    Write-Host "⚠️  Attention : Répertoire actuel différent de $expectedPath" -ForegroundColor Yellow
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
# DIAGNOSTIC
# ========================================
Write-Host "🔍 ÉTAPE 1 : Diagnostic de l'état Git..." -ForegroundColor Yellow
Write-Host ""

try {
    git status
    Write-Host ""
} catch {
    Write-Host "❌ Erreur lors de git status" -ForegroundColor Red
    exit
}

# ========================================
# OPTIONS DE RÉSOLUTION
# ========================================
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  OPTIONS DE RÉSOLUTION                " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. Annuler le merge et forcer le pull (RECOMMANDÉ)" -ForegroundColor Green
Write-Host "   → Abandonne le merge en cours" -ForegroundColor Gray
Write-Host "   → Récupère la dernière version depuis GitHub" -ForegroundColor Gray
Write-Host ""
Write-Host "2. Compléter le merge (Si vous savez ce que vous faites)" -ForegroundColor Yellow
Write-Host "   → Termine le merge en cours" -ForegroundColor Gray
Write-Host ""
Write-Host "3. Reset hard au dernier commit GitHub (DANGEREUX)" -ForegroundColor Red
Write-Host "   → Perd TOUTES les modifications locales" -ForegroundColor Gray
Write-Host ""
Write-Host "4. Annuler et quitter" -ForegroundColor White
Write-Host ""

$choice = Read-Host "Choisissez une option (1-4)"

switch ($choice) {
    "1" {
        Write-Host ""
        Write-Host "🔄 Option 1 : Annulation du merge + Pull propre" -ForegroundColor Green
        Write-Host ""
        
        # Annuler le merge
        Write-Host "→ Annulation du merge en cours..." -ForegroundColor Yellow
        try {
            git merge --abort
            Write-Host "  ✓ Merge annulé" -ForegroundColor Green
        } catch {
            Write-Host "  ⚠ Aucun merge à annuler ou déjà annulé" -ForegroundColor Yellow
        }
        
        # Stash les changements locaux
        Write-Host "→ Sauvegarde des modifications locales..." -ForegroundColor Yellow
        try {
            git stash push -m "Backup avant fix merge $(Get-Date -Format 'yyyyMMdd-HHmmss')"
            Write-Host "  ✓ Modifications sauvegardées" -ForegroundColor Green
        } catch {
            Write-Host "  ⚠ Aucune modification à sauvegarder" -ForegroundColor Yellow
        }
        
        # Fetch
        Write-Host "→ Récupération des dernières modifications..." -ForegroundColor Yellow
        try {
            git fetch origin production-stable
            Write-Host "  ✓ Fetch réussi" -ForegroundColor Green
        } catch {
            Write-Host "  ❌ Erreur fetch" -ForegroundColor Red
            exit
        }
        
        # Reset au remote
        Write-Host "→ Alignement sur origin/production-stable..." -ForegroundColor Yellow
        try {
            git reset --hard origin/production-stable
            Write-Host "  ✓ Reset réussi" -ForegroundColor Green
        } catch {
            Write-Host "  ❌ Erreur reset" -ForegroundColor Red
            exit
        }
        
        # Pull
        Write-Host "→ Pull de la dernière version..." -ForegroundColor Yellow
        try {
            git pull origin production-stable
            Write-Host "  ✓ Pull réussi" -ForegroundColor Green
        } catch {
            Write-Host "  ❌ Erreur pull" -ForegroundColor Red
            exit
        }
        
        Write-Host ""
        Write-Host "✅ Résolution terminée !" -ForegroundColor Green
    }
    
    "2" {
        Write-Host ""
        Write-Host "🔄 Option 2 : Compléter le merge" -ForegroundColor Yellow
        Write-Host ""
        
        Write-Host "Fichiers en conflit (s'il y en a) :" -ForegroundColor Yellow
        git diff --name-only --diff-filter=U
        Write-Host ""
        
        Write-Host "⚠️  Vous devez résoudre les conflits manuellement" -ForegroundColor Yellow
        Write-Host "Après résolution :" -ForegroundColor Cyan
        Write-Host "  git add <fichiers-résolus>" -ForegroundColor White
        Write-Host "  git commit -m 'Merge resolved'" -ForegroundColor White
        Write-Host ""
        
        Write-Host "Voulez-vous commiter automatiquement (si pas de conflits) ? (O/N)" -ForegroundColor Yellow
        $auto = Read-Host
        
        if ($auto -eq "O" -or $auto -eq "o") {
            try {
                git add .
                git commit -m "Merge completed on $(Get-Date -Format 'yyyy-MM-dd HH:mm')"
                Write-Host "✓ Merge complété" -ForegroundColor Green
            } catch {
                Write-Host "❌ Erreur lors du commit" -ForegroundColor Red
            }
        }
    }
    
    "3" {
        Write-Host ""
        Write-Host "⚠️  ATTENTION : OPTION DANGEREUSE" -ForegroundColor Red
        Write-Host ""
        Write-Host "Cela va supprimer TOUTES les modifications locales !" -ForegroundColor Red
        Write-Host "Êtes-vous ABSOLUMENT sûr ? Tapez 'OUI' en majuscules" -ForegroundColor Yellow
        $confirm = Read-Host
        
        if ($confirm -eq "OUI") {
            Write-Host ""
            Write-Host "🔄 Reset hard en cours..." -ForegroundColor Red
            
            try {
                git fetch origin production-stable
                git reset --hard origin/production-stable
                git clean -fd
                Write-Host "✓ Reset hard terminé" -ForegroundColor Green
            } catch {
                Write-Host "❌ Erreur lors du reset" -ForegroundColor Red
                exit
            }
        } else {
            Write-Host "Opération annulée" -ForegroundColor Yellow
            exit
        }
    }
    
    "4" {
        Write-Host ""
        Write-Host "Opération annulée" -ForegroundColor Yellow
        exit
    }
    
    default {
        Write-Host ""
        Write-Host "❌ Choix invalide" -ForegroundColor Red
        exit
    }
}

# ========================================
# NETTOYAGE POST-FIX
# ========================================
Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  NETTOYAGE & VÉRIFICATION             " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "→ Clear caches Laravel..." -ForegroundColor Yellow
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
Write-Host "  ✓ Caches vidés" -ForegroundColor Green

Write-Host "→ Rebuild caches..." -ForegroundColor Yellow
php artisan config:cache
php artisan route:cache
Write-Host "  ✓ Caches reconstruits" -ForegroundColor Green

Write-Host "→ Vérifier migrations..." -ForegroundColor Yellow
php artisan migrate:status
Write-Host ""

Write-Host "Voulez-vous exécuter les migrations manquantes ? (O/N)" -ForegroundColor Yellow
$migrate = Read-Host
if ($migrate -eq "O" -or $migrate -eq "o") {
    php artisan migrate --force
    Write-Host "  ✓ Migrations exécutées" -ForegroundColor Green
}

Write-Host ""
Write-Host "→ Initialiser settings..." -ForegroundColor Yellow
php artisan settings:init
Write-Host "  ✓ Settings initialisés" -ForegroundColor Green

Write-Host ""
Write-Host "→ Redémarrage IIS..." -ForegroundColor Yellow
try {
    iisreset
    Write-Host "  ✓ IIS redémarré" -ForegroundColor Green
} catch {
    Write-Host "  ❌ Erreur IIS (nécessite droits admin)" -ForegroundColor Red
    Write-Host "     Exécutez manuellement : iisreset" -ForegroundColor Yellow
}

# ========================================
# STATUT FINAL
# ========================================
Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  STATUT FINAL                         " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "Git Status :" -ForegroundColor Cyan
git status
Write-Host ""

Write-Host "Dernier commit :" -ForegroundColor Cyan
git log --oneline -1
Write-Host ""

Write-Host "✅ Script terminé !" -ForegroundColor Green
Write-Host ""
Write-Host "🌐 Testez le site : https://www.nere-mining.bf" -ForegroundColor Cyan
Write-Host ""

Write-Host "Appuyez sur une touche pour voir les logs..." -ForegroundColor Yellow
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")

Write-Host ""
Write-Host "📄 Dernières lignes du log Laravel :" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
if (Test-Path "storage\logs\laravel.log") {
    Get-Content "storage\logs\laravel.log" -Tail 30
} else {
    Write-Host "Fichier de log introuvable" -ForegroundColor Red
}

Write-Host ""
Write-Host "🎉 Terminé ! Bonne chance !" -ForegroundColor Green
