# Script simple de mise a jour du message du PDG
# Compatible Windows Server - encodage US-ASCII

Write-Host "=== MISE A JOUR MESSAGE PDG ===" -ForegroundColor Green

# Aller dans le repertoire du site
cd C:\inetpub\wwwroot\nere_website

# Recuperer les mises a jour
Write-Host "1. Recuperation des fichiers..." -ForegroundColor Yellow
git pull origin production-stable

# Mettre a jour le message du PDG
Write-Host "2. Mise a jour du message..." -ForegroundColor Yellow  
php artisan db:seed --class=UpdateCeoMessageSeeder --force

# Nettoyer le cache
Write-Host "3. Nettoyage du cache..." -ForegroundColor Yellow
php artisan config:clear
php artisan route:clear
php artisan view:clear

Write-Host "TERMINE! Message du PDG mis a jour." -ForegroundColor Green
Write-Host "Verifiez sur: /qui-sommes-nous/mot-du-pdg" -ForegroundColor White