# Manual Cache Fix for Windows Server

## 1. Create Missing Directories
```powershell
cd C:\inetpub\wwwroot\nere_website

# Create cache directories
New-Item -ItemType Directory -Path "bootstrap\cache" -Force
New-Item -ItemType Directory -Path "storage\framework\cache\data" -Force  
New-Item -ItemType Directory -Path "storage\framework\sessions" -Force
New-Item -ItemType Directory -Path "storage\framework\views" -Force
New-Item -ItemType Directory -Path "storage\logs" -Force
```

## 2. Set Permissions (Run as Administrator)
```powershell
# Give IIS full access to cache folders
icacls "bootstrap\cache" /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls "storage" /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls "bootstrap\cache" /grant "IUSR:(OI)(CI)F" /T  
icacls "storage" /grant "IUSR:(OI)(CI)F" /T
```

## 3. Alternative: Use PHP to Create Cache
If artisan commands still fail, create a cache setup script:

Create `setup_cache.php` in your web root:
```php
<?php
// Create cache directories using PHP
$dirs = [
    'bootstrap/cache',
    'storage/framework/cache/data', 
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs'
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "Created: $dir\n";
    }
}

echo "Cache directories created!\n";
?>
```

Then run: `php setup_cache.php`

## 4. Check .env File
Make sure your .env doesn't have special characters that break parsing:
- Check for unquoted values with spaces
- Look for accented characters like é, è  
- Ensure values are properly quoted

## 5. Test Commands One by One
```powershell
php artisan --version    # Test basic artisan
php artisan list        # Test command list
php artisan config:clear # Test cache clear
```