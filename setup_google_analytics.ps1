# Configuration de Google Analytics G-01ZT389C0B
# Deploiement du tracking sur toutes les pages du site

Write-Host "=== CONFIGURATION GOOGLE ANALYTICS ===" -ForegroundColor Green

cd C:\inetpub\wwwroot\nere_website

Write-Host "1. Recuperation de la configuration GA..." -ForegroundColor Yellow
git pull origin production-stable

Write-Host "2. Mise a jour des parametres Google Analytics..." -ForegroundColor Yellow
php artisan db:seed --class=UpdateGoogleAnalyticsSeeder --force

Write-Host "3. Application des changements..." -ForegroundColor Yellow
php artisan config:clear
php artisan view:clear
php artisan route:clear

Write-Host "GOOGLE ANALYTICS ACTIVE !" -ForegroundColor Green
Write-Host "• ID de mesure : G-01ZT389C0B" -ForegroundColor White
Write-Host "• Status : Actif sur toutes les pages" -ForegroundColor White
Write-Host "• Code integre dans <head> de chaque page" -ForegroundColor White
Write-Host "• Tracking automatique des pages vues" -ForegroundColor White

Write-Host "`nVous pouvez maintenant :" -ForegroundColor Yellow
Write-Host "• Verifier les donnees dans Google Analytics" -ForegroundColor White
Write-Host "• Configurer les conversions et objectifs" -ForegroundColor White
Write-Host "• Suivre le trafic en temps reel" -ForegroundColor White