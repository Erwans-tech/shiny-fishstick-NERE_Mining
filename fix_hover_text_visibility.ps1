# Correction de la lisibilite du texte au survol de la carte PDG
# Fix du probleme de texte illisible au hover

Write-Host "=== CORRECTION HOVER CARTE PDG ===" -ForegroundColor Green

cd C:\inetpub\wwwroot\nere_website

Write-Host "1. Recuperation de la correction..." -ForegroundColor Yellow
git pull origin production-stable

Write-Host "2. Application du fix CSS..." -ForegroundColor Yellow
php artisan view:clear

Write-Host "CORRIGE! Le texte reste maintenant lisible au survol." -ForegroundColor Green
Write-Host "• Texte blanc force avec !important" -ForegroundColor White
Write-Host "• Ombres portees pour plus de lisibilite" -ForegroundColor White
Write-Host "• Fond sombre conserve au hover" -ForegroundColor White