# Test rapide Google Analytics - Version simplifiee
# Si les autres methodes ne marchent pas

cd C:\inetpub\wwwroot\nere_website

Write-Host "=== TEST RAPIDE GOOGLE ANALYTICS ===" -ForegroundColor Green

# Verifier si le code GA est present
Write-Host "1. Verification du code GA dans le layout..." -ForegroundColor Yellow
$gaFound = Get-Content "resources\views\layouts\app.blade.php" | Select-String "gtag"
if ($gaFound) {
    Write-Host "OK Code GA trouve dans le layout" -ForegroundColor Green
} else {
    Write-Host "ERREUR Code GA manquant dans le layout" -ForegroundColor Red
    Write-Host "Ajoutez manuellement le code GA apres <head>" -ForegroundColor Yellow
}

# Verifier la config .env  
Write-Host "2. Verification de la config .env..." -ForegroundColor Yellow
$envGA = Get-Content ".env" | Select-String "GA_MEASUREMENT_ID"
if ($envGA -match "G-01ZT389C0B") {
    Write-Host "OK ID Google Analytics configure" -ForegroundColor Green
} else {
    Write-Host "ERREUR ID GA manquant ou incorrect" -ForegroundColor Red
    Write-Host "Ajoutez: GA_MEASUREMENT_ID=`"G-01ZT389C0B`"" -ForegroundColor Yellow
}

# Vider les caches
Write-Host "3. Nettoyage des caches..." -ForegroundColor Yellow
php artisan config:clear
php artisan view:clear

Write-Host "TEST TERMINE" -ForegroundColor Green
Write-Host "Allez sur votre site et verifiez le code source" -ForegroundColor Yellow
Write-Host "Vous devriez voir: googletagmanager.com/gtag/js" -ForegroundColor White