# Quick fix for Windows Server IIS Laravel cache issue
# Run as Administrator

$webRoot = "C:\inetpub\wwwroot\nere_website"
cd $webRoot

Write-Host "=== Laravel Windows Server Quick Fix ===" -ForegroundColor Cyan

# 1. Create missing cache directories
Write-Host "Creating cache directories..." -ForegroundColor Yellow
$directories = @(
    "bootstrap\cache",
    "storage\framework\cache",
    "storage\framework\cache\data", 
    "storage\framework\sessions",
    "storage\framework\views",
    "storage\logs"
)

foreach ($dir in $directories) {
    if (!(Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force
        Write-Host "  Created: $dir" -ForegroundColor Green
    } else {
        Write-Host "  Exists: $dir" -ForegroundColor Gray
    }
}

# 2. Set permissions for IIS
Write-Host "`nSetting IIS permissions..." -ForegroundColor Yellow
$paths = @("bootstrap\cache", "storage")

foreach ($path in $paths) {
    icacls $path /grant "IIS_IUSRS:(OI)(CI)F" /T /Q
    icacls $path /grant "IUSR:(OI)(CI)F" /T /Q
    Write-Host "  Set permissions: $path" -ForegroundColor Green
}

# 3. Create empty .gitkeep files
Write-Host "`nCreating .gitkeep files..." -ForegroundColor Yellow
$gitkeepDirs = @(
    "storage\framework\cache\data",
    "storage\framework\sessions", 
    "storage\framework\views"
)

foreach ($dir in $gitkeepDirs) {
    $gitkeepFile = "$dir\.gitkeep"
    if (!(Test-Path $gitkeepFile)) {
        New-Item -ItemType File -Path $gitkeepFile -Force
        Write-Host "  Created: $gitkeepFile" -ForegroundColor Green
    }
}

# 4. Test Laravel commands
Write-Host "`nTesting Laravel commands..." -ForegroundColor Yellow

Write-Host "Testing artisan..." -NoNewline
try {
    php artisan --version | Out-Null
    Write-Host " ✓" -ForegroundColor Green
} catch {
    Write-Host " ✗" -ForegroundColor Red
}

Write-Host "Testing config:clear..." -NoNewline  
try {
    php artisan config:clear | Out-Null
    Write-Host " ✓" -ForegroundColor Green
} catch {
    Write-Host " ✗" -ForegroundColor Red
    Write-Host "    Error: Check your .env file encoding" -ForegroundColor Red
}

Write-Host "`n=== Fix Complete ===" -ForegroundColor Cyan
Write-Host "If commands still fail, check .env file for special characters" -ForegroundColor Yellow