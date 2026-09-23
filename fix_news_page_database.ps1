# Correction de la page actualités pour afficher les données de la base
# Le contrôleur utilise maintenant les vraies actualités au lieu des hardcodées

Write-Host "=== CORRECTION PAGE ACTUALITES ===" -ForegroundColor Green

cd C:\inetpub\wwwroot\nere_website

Write-Host "1. Recuperation de la correction..." -ForegroundColor Yellow
git pull origin production-stable

Write-Host "2. Nettoyage du cache pour appliquer les changements..." -ForegroundColor Yellow
php artisan config:clear
php artisan view:clear
php artisan route:clear

Write-Host "CORRIGE! La page actualites affiche maintenant :" -ForegroundColor Green
Write-Host "• Les actualites de la base de donnees en priorite" -ForegroundColor White
Write-Host "• Pagination automatique Laravel" -ForegroundColor White
Write-Host "• Fallback sur actualites hardcodees si base vide" -ForegroundColor White
Write-Host "• Gestion d'erreur en cas de probleme base de donnees" -ForegroundColor White

Write-Host "`nTestez sur : /actualites et /en/news" -ForegroundColor Yellow