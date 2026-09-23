# Fix Laravel cache permissions on Windows Server IIS
# Run this script as Administrator in PowerShell

$webRoot = "C:\inetpub\wwwroot\nere_website"
cd $webRoot

Write-Host "Creating Laravel cache directories..." -ForegroundColor Green

# Create bootstrap/cache directory if missing
if (!(Test-Path "bootstrap\cache")) {
    New-Item -ItemType Directory -Path "bootstrap\cache" -Force
    Write-Host "Created bootstrap/cache"
}

# Create storage framework directories
$storageDirs = @(
    "storage\framework\cache\data",
    "storage\framework\sessions", 
    "storage\framework\views",
    "storage\logs",
    "storage\app\public"
)

foreach ($dir in $storageDirs) {
    if (!(Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force
        Write-Host "Created $dir"
    }
}

Write-Host "Setting IIS permissions..." -ForegroundColor Green

# Set permissions for IIS users
$folders = @(
    "bootstrap\cache",
    "storage\framework",
    "storage\logs", 
    "storage\app"
)

foreach ($folder in $folders) {
    if (Test-Path $folder) {
        # Give IIS_IUSRS full control
        icacls $folder /grant "IIS_IUSRS:(OI)(CI)F" /T /Q
        # Give IUSR modify access
        icacls $folder /grant "IUSR:(OI)(CI)M" /T /Q
        Write-Host "Set permissions for $folder"
    }
}

Write-Host "Testing Laravel commands..." -ForegroundColor Yellow

# Test each command individually
php artisan config:clear
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Config cleared successfully" -ForegroundColor Green
} else {
    Write-Host "✗ Config clear failed" -ForegroundColor Red
}

php artisan route:clear  
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Routes cleared successfully" -ForegroundColor Green
} else {
    Write-Host "✗ Route clear failed" -ForegroundColor Red
}

php artisan view:clear
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Views cleared successfully" -ForegroundColor Green  
} else {
    Write-Host "✗ View clear failed" -ForegroundColor Red
}

# Check if site is accessible
Write-Host "Checking site accessibility..." -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "http://localhost" -UseBasicParsing -TimeoutSec 10
    if ($response.StatusCode -eq 200) {
        Write-Host "✓ Site is accessible" -ForegroundColor Green
    } else {
        Write-Host "Site returned status: $($response.StatusCode)" -ForegroundColor Yellow
    }
} catch {
    Write-Host "✗ Site not accessible: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host "Cache fix completed!" -ForegroundColor Green
Write-Host "If issues persist, check the Laravel log at: storage\logs\laravel.log"