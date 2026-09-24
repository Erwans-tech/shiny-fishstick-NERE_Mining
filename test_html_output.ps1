# TEST SIMPLE - Verification du HTML genere par le site

Write-Host "=== TEST HTML OUTPUT ===" -ForegroundColor Green

try {
    Write-Host "Recuperation du HTML de www.nere-mining.bf..." -ForegroundColor Yellow
    $response = Invoke-WebRequest -Uri "https://www.nere-mining.bf" -UseBasicParsing -TimeoutSec 20
    $html = $response.Content
    
    Write-Host "`nRecherche du code Google Analytics..." -ForegroundColor Yellow
    
    if ($html -match "googletagmanager\.com") {
        Write-Host "✓ GOOGLE ANALYTICS DETECTE dans le HTML !" -ForegroundColor Green
        
        # Extraire la ligne GA
        $gaLines = $html -split "`n" | Where-Object { $_ -match "googletagmanager|gtag" }
        Write-Host "`nLignes Google Analytics trouvees:" -ForegroundColor Cyan
        foreach ($line in $gaLines) {
            Write-Host $line.Trim() -ForegroundColor White
        }
    } else {
        Write-Host "✗ Google Analytics NON DETECTE dans le HTML" -ForegroundColor Red
        
        Write-Host "`nPremiers 50 lignes du HTML:" -ForegroundColor Gray
        $lines = $html -split "`n" | Select-Object -First 50
        foreach ($line in $lines) {
            Write-Host $line -ForegroundColor Gray
        }
    }
    
    Write-Host "`nTaille du HTML: $($html.Length) caracteres" -ForegroundColor Yellow
    Write-Host "Code de reponse: $($response.StatusCode)" -ForegroundColor Yellow
    
} catch {
    Write-Host "✗ Erreur: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host "`n=== TEST TERMINE ===" -ForegroundColor Green