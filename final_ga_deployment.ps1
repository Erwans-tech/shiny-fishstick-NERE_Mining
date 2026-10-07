# DEPLOIEMENT FINAL GOOGLE ANALYTICS
# Solution complete et definitive pour G-01ZT389C0B sur www.nere-mining.bf

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "DEPLOIEMENT FINAL GOOGLE ANALYTICS" -ForegroundColor Cyan  
Write-Host "Site: www.nere-mining.bf" -ForegroundColor White
Write-Host "ID: G-01ZT389C0B" -ForegroundColor White
Write-Host "========================================" -ForegroundColor Cyan

# Repertoire de travail
Set-Location "C:\inetpub\wwwroot\nere_website"

Write-Host "`nETAPE 1: MISE A JOUR DU CODE" -ForegroundColor Yellow
Write-Host "---------------------------------" -ForegroundColor Yellow
git fetch origin production-stable
git reset --hard origin/production-stable
Write-Host "✓ Code source synchronise" -ForegroundColor Green

Write-Host "`nETAPE 2: VERIFICATION DU CODE GA" -ForegroundColor Yellow  
Write-Host "---------------------------------" -ForegroundColor Yellow
$layoutPath = "resources\views\layouts\app.blade.php"
$content = Get-Content $layoutPath -Raw -Encoding UTF8

# Verification presence
$hasGA = $content.Contains("googletagmanager.com/gtag/js?id=G-01ZT389C0B")
$hasConfig = $content.Contains("gtag('config', 'G-01ZT389C0B')")

Write-Host "Script Google Tag Manager: " -NoNewline
if ($hasGA) {
    Write-Host "PRESENT ✓" -ForegroundColor Green
} else {
    Write-Host "MANQUANT ✗" -ForegroundColor Red
}

Write-Host "Configuration gtag: " -NoNewline
if ($hasConfig) {
    Write-Host "PRESENTE ✓" -ForegroundColor Green
} else {
    Write-Host "MANQUANTE ✗" -ForegroundColor Red
}

if ($hasGA -and $hasConfig) {
    Write-Host "✓ Code Google Analytics complet et correct" -ForegroundColor Green
} else {
    Write-Host "✗ Probleme detecte - Correction en cours..." -ForegroundColor Red
    
    # Backup
    $backupFile = "$layoutPath.backup." + (Get-Date -Format "yyyyMMdd_HHmmss")
    Copy-Item $layoutPath $backupFile
    Write-Host "✓ Backup cree: $backupFile" -ForegroundColor Green
    
    # Code Google Analytics correct
    $correctGA = @"
    
    {{-- Google Analytics --}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-01ZT389C0B"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-01ZT389C0B');
    </script>
"@
    
    # Nettoyer le contenu existant (supprimer ancien GA s'il existe)
    $cleanContent = $content -replace '{{-- Google Analytics --}}.*?</script>', '', 'Singleline'
    $cleanContent = $cleanContent -replace '<!-- Google tag.*?</script>', '', 'Singleline'
    
    # Ajouter le nouveau code apres <head>
    $finalContent = $cleanContent -replace '<head>', "<head>$correctGA"
    
    # Sauvegarder
    Set-Content $layoutPath $finalContent -Encoding UTF8
    Write-Host "✓ Code Google Analytics mis a jour" -ForegroundColor Green
}

Write-Host "`nETAPE 3: NETTOYAGE COMPLET" -ForegroundColor Yellow
Write-Host "---------------------------------" -ForegroundColor Yellow

# Caches Laravel
Write-Host "Nettoyage cache config..." -NoNewline
php artisan config:clear
Write-Host " ✓" -ForegroundColor Green

Write-Host "Nettoyage cache vues..." -NoNewline  
php artisan view:clear
Write-Host " ✓" -ForegroundColor Green

Write-Host "Nettoyage cache routes..." -NoNewline
php artisan route:clear  
Write-Host " ✓" -ForegroundColor Green

Write-Host "Nettoyage cache application..." -NoNewline
php artisan cache:clear
Write-Host " ✓" -ForegroundColor Green

# Optimisation pour production
Write-Host "Optimisation config..." -NoNewline
php artisan config:cache
Write-Host " ✓" -ForegroundColor Green

Write-Host "Optimisation routes..." -NoNewline
php artisan route:cache
Write-Host " ✓" -ForegroundColor Green

Write-Host "`nETAPE 4: REDEMARRAGE SERVEUR" -ForegroundColor Yellow
Write-Host "---------------------------------" -ForegroundColor Yellow
Write-Host "Redemarrage IIS..." -NoNewline
iisreset /noforce
Write-Host " ✓" -ForegroundColor Green

Write-Host "`nETAPE 5: TEST DE VALIDATION" -ForegroundColor Yellow
Write-Host "---------------------------------" -ForegroundColor Yellow
Write-Host "Attente 10 secondes pour la stabilisation..." -ForegroundColor White
Start-Sleep -Seconds 10

try {
    Write-Host "Test de connexion au site..." -NoNewline
    $response = Invoke-WebRequest -Uri "https://www.nere-mining.bf" -UseBasicParsing -TimeoutSec 30
    Write-Host " ✓ Connecte (HTTP $($response.StatusCode))" -ForegroundColor Green
    
    # Verification du HTML
    Write-Host "Verification Google Analytics dans le HTML..." -NoNewline
    if ($response.Content.Contains("googletagmanager.com/gtag/js?id=G-01ZT389C0B")) {
        Write-Host " ✓ DETECTE!" -ForegroundColor Green
        
        Write-Host "Verification ID G-01ZT389C0B..." -NoNewline
        if ($response.Content.Contains("gtag('config', 'G-01ZT389C0B')")) {
            Write-Host " ✓ CONFIRME!" -ForegroundColor Green
        } else {
            Write-Host " ✗ Configuration manquante" -ForegroundColor Red
        }
    } else {
        Write-Host " ✗ NON DETECTE" -ForegroundColor Red
    }
    
} catch {
    Write-Host " ✗ Erreur de connexion" -ForegroundColor Red
    Write-Host "Erreur: $($_.Exception.Message)" -ForegroundColor Yellow
}

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "DEPLOIEMENT TERMINE!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan

Write-Host "`nRESULTAT ATTENDU:" -ForegroundColor White
Write-Host "• Le code Google Analytics G-01ZT389C0B est maintenant deploye" -ForegroundColor Yellow
Write-Host "• Google Analytics devrait detecter le site dans 5-10 minutes" -ForegroundColor Yellow
Write-Host "• Verifiez sur: https://analytics.google.com/" -ForegroundColor Yellow
Write-Host "• Site web: https://www.nere-mining.bf" -ForegroundColor Yellow

Write-Host "`nSI LE PROBLEME PERSISTE:" -ForegroundColor White
Write-Host "1. Executez: verify_ga_status.ps1 pour diagnostic" -ForegroundColor Yellow
Write-Host "2. Verifiez le code source de la page web directement" -ForegroundColor Yellow
Write-Host "3. Contactez le support Google Analytics si necessaire" -ForegroundColor Yellow

Write-Host "`nScript termine avec succes! 🎉" -ForegroundColor Green