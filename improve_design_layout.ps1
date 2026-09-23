# Script d'amelioration du design et de la mise en page
# Agrandit les textes, cartes et photos selon le theme du site

Write-Host "=== AMELIORATION DU DESIGN NERE MINING ===" -ForegroundColor Green

# Aller dans le repertoire du site
cd C:\inetpub\wwwroot\nere_website

# Recuperer les dernieres modifications avec le nouveau design
Write-Host "1. Recuperation des ameliorations de design..." -ForegroundColor Yellow
git pull origin production-stable

# Vider le cache pour appliquer les nouveaux styles
Write-Host "2. Application des nouveaux styles..." -ForegroundColor Yellow
php artisan view:clear
php artisan config:clear

Write-Host "TERMINE! Design ameliore avec :" -ForegroundColor Green
Write-Host "• Textes agrandis et plus lisibles" -ForegroundColor White
Write-Host "• Cartes plus grandes avec meilleurs effets" -ForegroundColor White
Write-Host "• Photos agrandies avec bordures dorees" -ForegroundColor White
Write-Host "• Design harmonise avec le theme du site" -ForegroundColor White
Write-Host "• Responsive optimise pour tous les ecrans" -ForegroundColor White