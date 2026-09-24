# Resolution du conflit Git pour deployer Google Analytics
# Ce script resout automatiquement le conflit

Write-Host "=== RESOLUTION CONFLIT GIT ===" -ForegroundColor Yellow

cd C:\inetpub\wwwroot\nere_website

Write-Host "1. Sauvegarde des modifications locales..." -ForegroundColor Yellow
git stash push -m "Sauvegarde avant resolution conflit GA"

Write-Host "2. Force la recuperation de la version distante..." -ForegroundColor Yellow
git fetch origin production-stable
git reset --hard origin/production-stable

Write-Host "3. Verification que Google Analytics est present..." -ForegroundColor Yellow
$layoutContent = Get-Content "resources\views\layouts\app.blade.php" -Raw

if ($layoutContent -match "googletagmanager\.com/gtag/js\?id=G-01ZT389C0B") {
    Write-Host "✓ Google Analytics G-01ZT389C0B present dans le layout" -ForegroundColor Green
} else {
    Write-Host "✗ Google Analytics manquant - Ajout manuel..." -ForegroundColor Red
    
    # Ajouter le code GA manuellement
    $gaCode = @"

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-01ZT389C0B"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-01ZT389C0B');
    </script>
"@
    
    $content = Get-Content "resources\views\layouts\app.blade.php" -Raw
    $newContent = $content -replace "(<head>)", "`$1$gaCode"
    Set-Content "resources\views\layouts\app.blade.php" $newContent -Encoding UTF8
    
    Write-Host "✓ Code Google Analytics ajoute manuellement" -ForegroundColor Green
}

Write-Host "4. Nettoyage des caches..." -ForegroundColor Yellow
php artisan config:clear
php artisan view:clear
php artisan route:clear

Write-Host "5. Redemarrage IIS..." -ForegroundColor Yellow
iisreset /noforce

Write-Host "" -ForegroundColor White
Write-Host "=== CONFLIT RESOLU - GOOGLE ANALYTICS ACTIF ===" -ForegroundColor Green
Write-Host "Le code Google Analytics est maintenant deploye sur votre site" -ForegroundColor White
Write-Host "Verifiez sur www.nere-mining.bf" -ForegroundColor Yellow