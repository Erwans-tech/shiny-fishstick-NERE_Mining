# DEPLOIEMENT URGENT GOOGLE ANALYTICS 
# Version simplifiee sans conditions - Force l'affichage

Write-Host "=== DEPLOIEMENT URGENT GOOGLE ANALYTICS ===" -ForegroundColor Red

cd C:\inetpub\wwwroot\nere_website

Write-Host "1. Force git pull..." -ForegroundColor Yellow
git fetch origin
git reset --hard origin/production-stable

Write-Host "2. Verification du code GA dans le layout..." -ForegroundColor Yellow
$layoutContent = Get-Content "resources\views\layouts\app.blade.php" -Raw
if ($layoutContent -match "G-01ZT389C0B") {
    Write-Host "OK Code Google Analytics present" -ForegroundColor Green
} else {
    Write-Host "ERREUR Code GA manquant - Ajout manuel..." -ForegroundColor Red
    
    # Backup du layout actuel
    Copy-Item "resources\views\layouts\app.blade.php" "resources\views\layouts\app.blade.php.backup"
    
    # Lire le contenu actuel
    $content = Get-Content "resources\views\layouts\app.blade.php" -Raw
    
    # Ajouter le code GA apres <head>
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
    
    $newContent = $content -replace "(<head>)", "`$1`n$gaCode"
    Set-Content "resources\views\layouts\app.blade.php" $newContent
    Write-Host "Code GA ajoute manuellement" -ForegroundColor Green
}

Write-Host "3. Vidage FORCE de tous les caches..." -ForegroundColor Yellow
php artisan config:clear
php artisan view:clear  
php artisan route:clear
php artisan cache:clear

# Redemarrer IIS pour forcer le rechargement
Write-Host "4. Redemarrage IIS..." -ForegroundColor Yellow
iisreset /noforce

Write-Host "DEPLOIEMENT TERMINE !" -ForegroundColor Green
Write-Host "Google Analytics G-01ZT389C0B maintenant actif" -ForegroundColor Green
Write-Host "Allez sur www.nere-mining.bf et verifiez le code source" -ForegroundColor Yellow