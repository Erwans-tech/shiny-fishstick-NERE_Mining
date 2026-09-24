# DEPLOIEMENT FINAL GOOGLE ANALYTICS
# Utilise exactement le code officiel Google fourni

Write-Host "=== DEPLOIEMENT FINAL GOOGLE ANALYTICS ===" -ForegroundColor Green

cd C:\inetpub\wwwroot\nere_website

Write-Host "1. Recuperation de la version finale..." -ForegroundColor Yellow
git pull origin production-stable

Write-Host "2. Verification du code Google exact..." -ForegroundColor Yellow
$layoutPath = "resources\views\layouts\app.blade.php"
$layoutContent = Get-Content $layoutPath -Raw

if ($layoutContent -match "googletagmanager\.com/gtag/js\?id=G-01ZT389C0B") {
    Write-Host "✓ Code Google Analytics G-01ZT389C0B trouve" -ForegroundColor Green
} else {
    Write-Host "✗ Code GA manquant - Ajout du code officiel Google..." -ForegroundColor Yellow
    
    # Backup
    Copy-Item $layoutPath "$layoutPath.backup"
    
    # Code officiel Google exact
    $googleCode = @"

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-01ZT389C0B"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-01ZT389C0B');
    </script>
"@
    
    # Ajouter apres <head>
    $newContent = $layoutContent -replace "(<head>)", "`$1$googleCode"
    Set-Content $layoutPath $newContent -Encoding UTF8
    
    Write-Host "✓ Code Google officiel ajoute" -ForegroundColor Green
}

Write-Host "3. Nettoyage complet des caches..." -ForegroundColor Yellow
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear

Write-Host "4. Redemarrage IIS..." -ForegroundColor Yellow
iisreset /noforce

Write-Host "" -ForegroundColor White
Write-Host "=== GOOGLE ANALYTICS ACTIVE ===" -ForegroundColor Green
Write-Host "Code deploye : G-01ZT389C0B" -ForegroundColor White
Write-Host "Site : www.nere-mining.bf" -ForegroundColor White
Write-Host "" -ForegroundColor White
Write-Host "Allez sur votre site et verifiez le code source !" -ForegroundColor Yellow
Write-Host "Recherchez : googletagmanager.com/gtag/js" -ForegroundColor Gray