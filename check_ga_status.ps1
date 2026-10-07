# VERIFICATION STATUS GOOGLE ANALYTICS
# Script simple pour verifier si GA est present

Write-Host "=== VERIFICATION GOOGLE ANALYTICS ===" -ForegroundColor Cyan

cd C:\inetpub\wwwroot\nere_website

# Verifier le fichier layout
$layoutFile = "resources\views\layouts\app.blade.php"

Write-Host "Verification du fichier layout..." -ForegroundColor Yellow

if (Test-Path $layoutFile) {
    $content = Get-Content $layoutFile -Raw
    
    if ($content.Contains("G-01ZT389C0B")) {
        Write-Host "✓ ID Google Analytics G-01ZT389C0B present" -ForegroundColor Green
    } else {
        Write-Host "✗ ID Google Analytics manquant" -ForegroundColor Red
    }
    
    if ($content.Contains("googletagmanager.com")) {
        Write-Host "✓ Script googletagmanager present" -ForegroundColor Green
    } else {
        Write-Host "✗ Script googletagmanager manquant" -ForegroundColor Red
    }
    
    if ($content.Contains("gtag('config'")) {
        Write-Host "✓ Configuration gtag presente" -ForegroundColor Green
    } else {
        Write-Host "✗ Configuration gtag manquante" -ForegroundColor Red
    }
    
} else {
    Write-Host "✗ Fichier layout non trouve" -ForegroundColor Red
}

# Test simple du site
Write-Host "`nTest acces au site..." -ForegroundColor Yellow

try {
    $webRequest = Invoke-WebRequest -Uri "https://www.nere-mining.bf" -UseBasicParsing -TimeoutSec 10
    
    if ($webRequest.Content.Contains("googletagmanager.com")) {
        Write-Host "✓ Google Analytics DETECTE sur le site web" -ForegroundColor Green
    } else {
        Write-Host "✗ Google Analytics NON DETECTE sur le site web" -ForegroundColor Red
    }
    
    Write-Host "Code de reponse HTTP: $($webRequest.StatusCode)" -ForegroundColor White
    
} catch {
    Write-Host "✗ Erreur d'acces au site" -ForegroundColor Red
}

Write-Host "`n=== VERIFICATION TERMINEE ===" -ForegroundColor Cyan