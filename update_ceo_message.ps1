# Script de mise à jour du message du PDG - Windows Server
# À exécuter sur le serveur de production

$webRoot = "C:\inetpub\wwwroot\nere_website"
cd $webRoot

Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "        MISE À JOUR DU MESSAGE DU PDG                  " -ForegroundColor Cyan  
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan

# 1. Récupérer les dernières modifications depuis GitHub
Write-Host "`n1. Récupération des mises à jour..." -ForegroundColor Yellow
try {
    git pull origin production-stable
    Write-Host "   ✓ Code mis à jour depuis GitHub" -ForegroundColor Green
} catch {
    Write-Host "   ⚠ Erreur lors du git pull" -ForegroundColor Red
}

# 2. Exécuter le seeder pour mettre à jour le message du PDG
Write-Host "`n2. Mise à jour du message du PDG..." -ForegroundColor Yellow
try {
    php artisan db:seed --class=UpdateCeoMessageSeeder --force
    Write-Host "   ✓ Message du PDG mis à jour en français et anglais" -ForegroundColor Green
} catch {
    Write-Host "   ⚠ Erreur lors de la mise à jour du message" -ForegroundColor Red
}

# 3. Vider le cache pour appliquer les changements
Write-Host "`n3. Application des changements..." -ForegroundColor Yellow
try {
    php artisan config:clear
    php artisan route:clear  
    php artisan view:clear
    Write-Host "   ✓ Cache vidé, changements appliqués" -ForegroundColor Green
} catch {
    Write-Host "   ⚠ Erreur lors du nettoyage du cache" -ForegroundColor Red
}

Write-Host "`n═══════════════════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "           MESSAGE DU PDG MIS À JOUR                   " -ForegroundColor Cyan
Write-Host "═══════════════════════════════════════════════════════" -ForegroundColor Cyan

Write-Host "`nLe nouveau message du PDG est maintenant actif sur :" -ForegroundColor Green
Write-Host "• Page française : https://www.nere-mining.bf/qui-sommes-nous/mot-du-pdg" -ForegroundColor White
Write-Host "• Page anglaise : https://www.nere-mining.bf/en/about/ceo-message" -ForegroundColor White
Write-Host "`nLe message contient maintenant vos nouvelles valeurs :" -ForegroundColor Green  
Write-Host "NERE MINING: Intégrité, Professionnalisme, Respect, Esprit d'équipe!" -ForegroundColor Yellow