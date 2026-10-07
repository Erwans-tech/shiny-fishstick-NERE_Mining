# FIX GOOGLE ANALYTICS - VERSION SIMPLE SANS ERREURS
# Solution directe et propre

Write-Host "=== FIX GOOGLE ANALYTICS SIMPLE ===" -ForegroundColor Green

cd C:\inetpub\wwwroot\nere_website

# Etape 1: Git pull force
Write-Host "1. Mise a jour du code..." -ForegroundColor Yellow
git fetch origin production-stable
git reset --hard origin/production-stable

# Etape 2: Verification du layout
Write-Host "2. Verification du fichier layout..." -ForegroundColor Yellow
$layoutPath = "resources\views\layouts\app.blade.php"

if (Test-Path $layoutPath) {
    $content = Get-Content $layoutPath -Raw -Encoding UTF8
    
    if ($content.Contains("googletagmanager.com")) {
        Write-Host "OK - Code Google Analytics trouve" -ForegroundColor Green
    } else {
        Write-Host "ERREUR - Code Google Analytics manquant" -ForegroundColor Red
        Write-Host "Ajout du code Google Analytics..." -ForegroundColor Yellow
        
        # Backup
        Copy-Item $layoutPath ($layoutPath + ".backup")
        
        # Code GA simple
        $gaCode = "`n    <!-- Google tag (gtag.js) -->`n" +
                  "    <script async src=`"https://www.googletagmanager.com/gtag/js?id=G-01ZT389C0B`"></script>`n" +
                  "    <script>`n" +
                  "      window.dataLayer = window.dataLayer || [];`n" +
                  "      function gtag(){dataLayer.push(arguments);}`n" +
                  "      gtag('js', new Date());`n" +
                  "      gtag('config', 'G-01ZT389C0B');`n" +
                  "    </script>`n"
        
        # Remplacer <head> par <head> + code GA
        $newContent = $content.Replace("<head>", "<head>" + $gaCode)
        
        # Sauvegarder
        Set-Content $layoutPath $newContent -Encoding UTF8
        Write-Host "OK - Code Google Analytics ajoute" -ForegroundColor Green
    }
} else {
    Write-Host "ERREUR - Fichier layout introuvable" -ForegroundColor Red
    exit 1
}

# Etape 3: Nettoyer les caches
Write-Host "3. Nettoyage des caches..." -ForegroundColor Yellow
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Etape 4: Redemarrage IIS
Write-Host "4. Redemarrage IIS..." -ForegroundColor Yellow
iisreset /noforce

Write-Host "`n=== GOOGLE ANALYTICS ACTIVE ===" -ForegroundColor Green
Write-Host "Verifiez maintenant sur www.nere-mining.bf" -ForegroundColor White
Write-Host "Le code devrait etre detecte dans 5-10 minutes" -ForegroundColor Yellow