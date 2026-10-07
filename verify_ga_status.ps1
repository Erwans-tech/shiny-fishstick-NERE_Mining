# VERIFICATION STATUS GOOGLE ANALYTICS - VERSION PROPRE
# Script de diagnostic sans erreurs de syntaxe

Write-Host "=== DIAGNOSTIC GOOGLE ANALYTICS G-01ZT389C0B ===" -ForegroundColor Cyan

Set-Location "C:\inetpub\wwwroot\nere_website"

Write-Host "`n1. VERIFICATION DU FICHIER SOURCE..." -ForegroundColor Yellow
$layoutFile = "resources\views\layouts\app.blade.php"

if (Test-Path $layoutFile) {
    $content = Get-Content $layoutFile -Raw -Encoding UTF8
    
    Write-Host "   Fichier layout trouve: $layoutFile" -ForegroundColor Green
    
    # Compter les occurrences
    $googleIdCount = ([regex]::Matches($content, "G-01ZT389C0B")).Count
    $googleScriptCount = ([regex]::Matches($content, "googletagmanager\.com")).Count
    $gtagConfigCount = ([regex]::Matches($content, "gtag\('config'")).Count
    
    Write-Host "   Occurrences ID G-01ZT389C0B: $googleIdCount" -ForegroundColor White
    Write-Host "   Occurrences googletagmanager: $googleScriptCount" -ForegroundColor White
    Write-Host "   Occurrences gtag config: $gtagConfigCount" -ForegroundColor White
    
    if ($googleIdCount -gt 0 -and $googleScriptCount -gt 0) {
        Write-Host "   ✓ Google Analytics present dans le fichier" -ForegroundColor Green
        
        if ($googleIdCount -gt 1 -or $googleScriptCount -gt 1) {
            Write-Host "   ⚠ ATTENTION: Code duplique detecte!" -ForegroundColor Red
        }
    } else {
        Write-Host "   ✗ Google Analytics manquant dans le fichier" -ForegroundColor Red
    }
    
} else {
    Write-Host "   ✗ Fichier layout introuvable!" -ForegroundColor Red
}

Write-Host "`n2. TEST DU SITE WEB EN DIRECT..." -ForegroundColor Yellow

try {
    Write-Host "   Connexion a https://www.nere-mining.bf..." -ForegroundColor White
    $response = Invoke-WebRequest -Uri "https://www.nere-mining.bf" -UseBasicParsing -TimeoutSec 20
    
    Write-Host "   Code de reponse: $($response.StatusCode)" -ForegroundColor White
    Write-Host "   Taille du contenu: $($response.Content.Length) caracteres" -ForegroundColor White
    
    # Verification du contenu HTML
    $htmlContent = $response.Content
    
    if ($htmlContent.Contains("googletagmanager.com")) {
        Write-Host "   ✓ GOOGLE ANALYTICS DETECTE DANS LE HTML!" -ForegroundColor Green
        
        # Extraire la ligne avec Google Analytics
        $lines = $htmlContent -split "`n"
        foreach ($line in $lines) {
            if ($line.Contains("googletagmanager.com")) {
                Write-Host "   Script GA trouve: " -NoNewline -ForegroundColor Green
                Write-Host $line.Trim() -ForegroundColor White
                break
            }
        }
        
    } else {
        Write-Host "   ✗ GOOGLE ANALYTICS NON DETECTE DANS LE HTML" -ForegroundColor Red
    }
    
    if ($htmlContent.Contains("G-01ZT389C0B")) {
        Write-Host "   ✓ ID G-01ZT389C0B detecte dans le HTML" -ForegroundColor Green
    } else {
        Write-Host "   ✗ ID G-01ZT389C0B non detecte dans le HTML" -ForegroundColor Red
    }
    
} catch {
    Write-Host "   ✗ Erreur lors du test du site web" -ForegroundColor Red
    Write-Host "   Erreur: $($_.Exception.Message)" -ForegroundColor Yellow
}

Write-Host "`n3. VERIFICATION DES CACHES..." -ForegroundColor Yellow

# Verifier si les caches peuvent etre problematiques
$cacheFiles = @(
    "bootstrap\cache\config.php",
    "bootstrap\cache\routes.php"
)

foreach ($cacheFile in $cacheFiles) {
    if (Test-Path $cacheFile) {
        $fileAge = (Get-Date) - (Get-Item $cacheFile).LastWriteTime
        if ($fileAge.TotalHours -gt 1) {
            Write-Host "   ⚠ Cache ancien detecte: $cacheFile" -ForegroundColor Yellow
        } else {
            Write-Host "   ✓ Cache recent: $cacheFile" -ForegroundColor Green
        }
    }
}

Write-Host "`n4. VERIFICATION ENVIRONNEMENT..." -ForegroundColor Yellow
if (Test-Path ".env") {
    $envContent = Get-Content ".env" -Raw
    if ($envContent.Contains("APP_ENV=production")) {
        Write-Host "   ✓ Environnement: PRODUCTION" -ForegroundColor Green
    } else {
        Write-Host "   ⚠ Environnement: AUTRE" -ForegroundColor Yellow
    }
    
    if ($envContent.Contains("APP_DEBUG=false")) {
        Write-Host "   ✓ Debug: DESACTIVE" -ForegroundColor Green
    } else {
        Write-Host "   ⚠ Debug: ACTIVE" -ForegroundColor Yellow
    }
}

Write-Host "`n=== DIAGNOSTIC TERMINE ===" -ForegroundColor Cyan

# Resume
Write-Host "`nRESUME DU DIAGNOSTIC:" -ForegroundColor White
Write-Host "- Si Google Analytics est present dans le fichier ET dans le HTML: SUCCESS ✓" -ForegroundColor Green
Write-Host "- Si present dans le fichier mais PAS dans le HTML: probleme de cache" -ForegroundColor Yellow
Write-Host "- Si absent partout: le code n'a pas ete deploye correctement" -ForegroundColor Red

Write-Host "`nPROCHAINES ETAPES:" -ForegroundColor White
Write-Host "1. Si tout est OK, attendez 5-10 minutes pour la detection Google" -ForegroundColor Yellow
Write-Host "2. Si probleme de cache, executez: deploy_ga_final_clean.ps1" -ForegroundColor Yellow
Write-Host "3. Verifiez ensuite sur https://analytics.google.com/" -ForegroundColor Yellow