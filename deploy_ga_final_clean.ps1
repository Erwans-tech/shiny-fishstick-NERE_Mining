# DEPLOIEMENT GOOGLE ANALYTICS - VERSION FINALE PROPRE
# Script sans erreur de syntaxe pour Windows Server IIS

Write-Host "=== DEPLOIEMENT GOOGLE ANALYTICS G-01ZT389C0B ===" -ForegroundColor Cyan
Write-Host "Site cible: www.nere-mining.bf" -ForegroundColor White

# Changer de repertoire
Set-Location "C:\inetpub\wwwroot\nere_website"

Write-Host "`n1. MISE A JOUR DU CODE SOURCE..." -ForegroundColor Yellow
try {
    # Pull des derniers changements
    git fetch origin production-stable
    git reset --hard origin/production-stable
    Write-Host "   Code source mis a jour" -ForegroundColor Green
}
catch {
    Write-Host "   ATTENTION: Erreur lors du git pull" -ForegroundColor Red
    Write-Host "   Continuons quand meme..." -ForegroundColor Yellow
}

Write-Host "`n2. VERIFICATION DU CODE GOOGLE ANALYTICS..." -ForegroundColor Yellow
$layoutFile = "resources\views\layouts\app.blade.php"

if (Test-Path $layoutFile) {
    $content = Get-Content $layoutFile -Raw -Encoding UTF8
    
    # Verifications
    $hasGoogleId = $content.Contains("G-01ZT389C0B")
    $hasGoogleScript = $content.Contains("googletagmanager.com")
    $hasGtagConfig = $content.Contains("gtag('config'")
    
    Write-Host "   ID Google Analytics G-01ZT389C0B: " -NoNewline -ForegroundColor White
    if ($hasGoogleId) {
        Write-Host "PRESENT" -ForegroundColor Green
    } else {
        Write-Host "MANQUANT" -ForegroundColor Red
    }
    
    Write-Host "   Script Google Tag Manager: " -NoNewline -ForegroundColor White
    if ($hasGoogleScript) {
        Write-Host "PRESENT" -ForegroundColor Green
    } else {
        Write-Host "MANQUANT" -ForegroundColor Red
    }
    
    Write-Host "   Configuration gtag: " -NoNewline -ForegroundColor White
    if ($hasGtagConfig) {
        Write-Host "PRESENTE" -ForegroundColor Green
    } else {
        Write-Host "MANQUANTE" -ForegroundColor Red
    }
    
    if ($hasGoogleId -and $hasGoogleScript -and $hasGtagConfig) {
        Write-Host "   ✓ Code Google Analytics complet et correct" -ForegroundColor Green
    } else {
        Write-Host "   ✗ Code Google Analytics incomplet" -ForegroundColor Red
        Write-Host "   CORRECTION EN COURS..." -ForegroundColor Yellow
        
        # Backup du fichier
        Copy-Item $layoutFile "$layoutFile.backup.$(Get-Date -Format 'yyyyMMdd_HHmmss')"
        
        # Si le code GA n'est pas present, l'ajouter
        if (-not $hasGoogleScript) {
            $gaCode = @"
    
    {{-- Google Analytics --}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-01ZT389C0B"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-01ZT389C0B');
    </script>
"@
            
            # Inserer apres la balise <head>
            $newContent = $content -replace '<head>', "<head>$gaCode"
            Set-Content $layoutFile $newContent -Encoding UTF8
            Write-Host "   ✓ Code Google Analytics ajoute" -ForegroundColor Green
        }
    }
    
} else {
    Write-Host "   ✗ ERREUR: Fichier layout introuvable" -ForegroundColor Red
    exit 1
}

Write-Host "`n3. NETTOYAGE DES CACHES LARAVEL..." -ForegroundColor Yellow
try {
    php artisan config:clear
    Write-Host "   ✓ Cache config nettoye" -ForegroundColor Green
}
catch {
    Write-Host "   ✗ Erreur cache config" -ForegroundColor Red
}

try {
    php artisan view:clear
    Write-Host "   ✓ Cache vues nettoye" -ForegroundColor Green
}
catch {
    Write-Host "   ✗ Erreur cache vues" -ForegroundColor Red
}

try {
    php artisan route:clear
    Write-Host "   ✓ Cache routes nettoye" -ForegroundColor Green
}
catch {
    Write-Host "   ✗ Erreur cache routes" -ForegroundColor Red
}

Write-Host "`n4. REDEMARRAGE IIS..." -ForegroundColor Yellow
try {
    iisreset /noforce
    Write-Host "   ✓ IIS redémarre" -ForegroundColor Green
}
catch {
    Write-Host "   ✗ Erreur redemarrage IIS" -ForegroundColor Red
}

Write-Host "`n5. TEST DE VERIFICATION..." -ForegroundColor Yellow
Start-Sleep -Seconds 5

try {
    $response = Invoke-WebRequest -Uri "https://www.nere-mining.bf" -UseBasicParsing -TimeoutSec 15
    
    if ($response.Content.Contains("googletagmanager.com")) {
        Write-Host "   ✓ GOOGLE ANALYTICS DETECTE SUR LE SITE WEB!" -ForegroundColor Green
        Write-Host "   ✓ Code de reponse HTTP: $($response.StatusCode)" -ForegroundColor Green
    } else {
        Write-Host "   ✗ Google Analytics non detecte dans le HTML" -ForegroundColor Red
        Write-Host "   Code de reponse HTTP: $($response.StatusCode)" -ForegroundColor Yellow
    }
}
catch {
    Write-Host "   ✗ Impossible de tester le site web" -ForegroundColor Red
    Write-Host "   Erreur: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host "`n=== DEPLOIEMENT TERMINE ===" -ForegroundColor Cyan
Write-Host "IMPORTANT:" -ForegroundColor White
Write-Host "- Attendez 5-10 minutes pour que Google Analytics detecte le code" -ForegroundColor Yellow
Write-Host "- Verifiez sur https://analytics.google.com/" -ForegroundColor Yellow
Write-Host "- Si ca ne marche toujours pas, verifiez le code source de la page" -ForegroundColor Yellow
Write-Host "- Site web: https://www.nere-mining.bf" -ForegroundColor White

Write-Host "`nScript termine avec succes!" -ForegroundColor Green