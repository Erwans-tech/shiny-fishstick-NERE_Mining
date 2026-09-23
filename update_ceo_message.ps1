# Script de mise a jour du message du PDG - Windows Server
# A executer sur le serveur de production

$webRoot = "C:\inetpub\wwwroot\nere_website"
cd $webRoot

Write-Host "=======================================================" -ForegroundColor Cyan
Write-Host "        MISE A JOUR DU MESSAGE DU PDG                 " -ForegroundColor Cyan  
Write-Host "=======================================================" -ForegroundColor Cyan

# 1. Recuperer les dernieres modifications depuis GitHub
Write-Host "`n1. Recuperation des mises a jour..." -ForegroundColor Yellow
try {
    git pull origin production-stable
    Write-Host "   OK Code mis a jour depuis GitHub" -ForegroundColor Green
} catch {
    Write-Host "   ERREUR lors du git pull" -ForegroundColor Red
}

# 2. Executer le seeder pour mettre a jour le message du PDG
Write-Host "`n2. Mise a jour du message du PDG..." -ForegroundColor Yellow
try {
    php artisan db:seed --class=UpdateCeoMessageSeeder --force
    Write-Host "   OK Message du PDG mis a jour en francais et anglais" -ForegroundColor Green
} catch {
    Write-Host "   ERREUR lors de la mise a jour du message" -ForegroundColor Red
}

# 3. Vider le cache pour appliquer les changements
Write-Host "`n3. Application des changements..." -ForegroundColor Yellow
try {
    php artisan config:clear
    php artisan route:clear  
    php artisan view:clear
    Write-Host "   OK Cache vide, changements appliques" -ForegroundColor Green
} catch {
    Write-Host "   ERREUR lors du nettoyage du cache" -ForegroundColor Red
}

Write-Host "`n=======================================================" -ForegroundColor Cyan
Write-Host "           MESSAGE DU PDG MIS A JOUR                  " -ForegroundColor Cyan
Write-Host "=======================================================" -ForegroundColor Cyan

Write-Host "`nLe nouveau message du PDG est maintenant actif sur :" -ForegroundColor Green
Write-Host "• Page francaise : https://www.nere-mining.bf/qui-sommes-nous/mot-du-pdg" -ForegroundColor White
Write-Host "• Page anglaise : https://www.nere-mining.bf/en/about/ceo-message" -ForegroundColor White
Write-Host "`nLe message contient maintenant vos nouvelles valeurs :" -ForegroundColor Green  
Write-Host "NERE MINING: Integrite, Professionnalisme, Respect, Esprit d'equipe!" -ForegroundColor Yellow