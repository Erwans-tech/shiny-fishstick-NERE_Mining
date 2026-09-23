# Amelioration du design des cartes actualites
# Harmonisation avec le design de l'accueil et correction des images

Write-Host "=== AMELIORATION DESIGN CARTES ACTUALITES ===" -ForegroundColor Green

cd C:\inetpub\wwwroot\nere_website

Write-Host "1. Recuperation des ameliorations..." -ForegroundColor Yellow
git pull origin production-stable

Write-Host "2. Nettoyage du cache..." -ForegroundColor Yellow
php artisan view:clear
php artisan config:clear

Write-Host "TERMINE! Cartes actualites ameliorees :" -ForegroundColor Green
Write-Host "• Design identique a celui de l'accueil" -ForegroundColor White
Write-Host "• Images corrigees avec StorageHelper" -ForegroundColor White
Write-Host "• Effets hover elegants avec animation" -ForegroundColor White
Write-Host "• Bordure doree animee au survol" -ForegroundColor White
Write-Host "• Responsive 3->2->1 colonnes" -ForegroundColor White
Write-Host "• Pagination amelioree avec effet" -ForegroundColor White

Write-Host "`nTestez sur : /actualites et /en/news" -ForegroundColor Yellow