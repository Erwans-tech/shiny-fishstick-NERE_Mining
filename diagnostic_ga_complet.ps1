# DIAGNOSTIC COMPLET GOOGLE ANALYTICS
# Verifie tous les aspects du deploiement GA

Write-Host "=== DIAGNOSTIC COMPLET GOOGLE ANALYTICS ===" -ForegroundColor Cyan

cd C:\inetpub\wwwroot\nere_website

Write-Host "`n1. VERIFICATION GIT STATUS..." -ForegroundColor Yellow
git status
git log --oneline -3

Write-Host "`n2. VERIFICATION FICHIER LAYOUT..." -ForegroundColor Yellow
$layoutFile = "resources\views\layouts\app.blade.php"
if (Test-Path $layoutFile) {
    Write-Host "✓ Fichier layout existe" -ForegroundColor Green
    
    # Chercher le code GA
    $content = Get-Content $layoutFile -Raw
    if ($content -match "googletagmanager\.com") {
        Write-Host "✓ Code googletagmanager trouve dans le layout" -ForegroundColor Green
        
        # Extraire la ligne exacte
        $gaLine = Get-Content $layoutFile | Select-String "googletagmanager"
        Write-Host "Ligne GA: $gaLine" -ForegroundColor White
    } else {
        Write-Host "✗ Code googletagmanager MANQUANT dans le layout" -ForegroundColor Red
    }
    
    if ($content -match "G-01ZT389C0B") {
        Write-Host "✓ ID G-01ZT389C0B trouve" -ForegroundColor Green
    } else {
        Write-Host "✗ ID G-01ZT389C0B MANQUANT" -ForegroundColor Red
    }
} else {
    Write-Host "✗ Fichier layout MANQUANT" -ForegroundColor Red
}

Write-Host "`n3. VERIFICATION CACHE LARAVEL..." -ForegroundColor Yellow
Write-Host "Nettoyage de tous les caches..."
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear
Write-Host "✓ Caches vides" -ForegroundColor Green

Write-Host "`n4. TEST URL DIRECTE..." -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "https://www.nere-mining.bf" -UseBasicParsing -TimeoutSec 15
    $htmlContent = $response.Content
    
    if ($htmlContent -match "googletagmanager\.com") {
        Write-Host "✓ Code Google Analytics PRESENT sur le site web" -ForegroundColor Green
    } else {
        Write-Host "✗ Code Google Analytics ABSENT du HTML genere" -ForegroundColor Red
        
        # Montrer les premieres lignes du HTML
        Write-Host "`nPREMIERES LIGNES DU HTML:" -ForegroundColor Gray
        $htmlLines = $htmlContent -split "`n" | Select-Object -First 20
        foreach ($line in $htmlLines) {
            Write-Host $line -ForegroundColor Gray
        }
    }
} catch {
    Write-Host "✗ Erreur lors de l'acces au site: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host "`n5. AJOUT MANUEL DU CODE GA (si necessaire)..." -ForegroundColor Yellow
$content = Get-Content $layoutFile -Raw
if ($content -notmatch "googletagmanager\.com") {
    Write-Host "Ajout manuel du code Google Analytics..." -ForegroundColor Yellow
    
    # Code GA exact
    $gaCode = @"

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-01ZT389C0B"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-01ZT389C0B');
    </script>
"@
    
    # Backup
    Copy-Item $layoutFile "$layoutFile.backup"
    
    # Ajouter apres <head>
    $newContent = $content -replace "(<head>)", "`$1$gaCode"
    Set-Content $layoutFile $newContent -Encoding UTF8
    
    Write-Host "✓ Code Google Analytics ajoute manuellement" -ForegroundColor Green
    
    # Re-vider les caches
    php artisan view:clear
    php artisan config:clear
}

Write-Host "`n6. REDEMARRAGE IIS..." -ForegroundColor Yellow
iisreset /noforce
Write-Host "✓ IIS redemarre" -ForegroundColor Green

Write-Host "`n=== DIAGNOSTIC TERMINE ===" -ForegroundColor Cyan
Write-Host "Attendez 2-3 minutes puis testez a nouveau:" -ForegroundColor Yellow
Write-Host "https://www.nere-mining.bf" -ForegroundColor White