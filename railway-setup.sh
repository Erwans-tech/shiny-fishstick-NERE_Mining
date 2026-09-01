#!/bin/bash
# 🚀 Script de préparation locale avant push sur Railway

set -e

echo "═══════════════════════════════════════════════════════════"
echo "  Néré Mining — Railway Deployment Setup"
echo "═══════════════════════════════════════════════════════════"

# 1. Vérifier PHP
echo ""
echo "✓ Checking PHP version..."
PHP_VERSION=$(php -v | head -n 1)
echo "  $PHP_VERSION"

# 2. Vérifier Composer
echo ""
echo "✓ Checking Composer..."
php composer.phar --version

# 3. Générer APP_KEY si absent
echo ""
if grep -q "APP_KEY=base64" .env; then
    echo "✓ APP_KEY already set"
else
    echo "⚠ Generating APP_KEY..."
    APP_KEY=$(php artisan key:generate --show)
    sed -i "s/APP_KEY=/APP_KEY=$APP_KEY/" .env
    echo "  Generated: $APP_KEY"
fi

# 4. Vérifier dépendances
echo ""
echo "✓ Checking dependencies..."
if [ ! -d "vendor" ]; then
    echo "  Installing Composer dependencies..."
    php composer.phar install --no-dev --optimize-autoloader
fi

# 5. Vérifier base de données
echo ""
echo "✓ Database setup:"
echo "  Make sure MySQL is running locally"
echo "  Run: php artisan migrate"

# 6. Préparer assets
echo ""
echo "✓ Preparing assets..."
php artisan view:cache
php artisan config:cache
php artisan route:cache

# 7. Vérifier fichiers Railway
echo ""
echo "✓ Checking Railway config files..."
[ -f "railway.toml" ] && echo "  ✓ railway.toml" || echo "  ✗ railway.toml MISSING"
[ -f "nixpacks.toml" ] && echo "  ✓ nixpacks.toml" || echo "  ✗ nixpacks.toml MISSING"
[ -f "nginx.conf" ] && echo "  ✓ nginx.conf" || echo "  ✗ nginx.conf MISSING"
[ -f "Procfile" ] && echo "  ✓ Procfile" || echo "  ✗ Procfile MISSING"

echo ""
echo "═══════════════════════════════════════════════════════════"
echo "  ✅ Setup complete!"
echo ""
echo "  Next steps:"
echo "  1. Push to production branch: git push origin production"
echo "  2. Go to https://railway.app"
echo "  3. Connect your GitHub repository"
echo "  4. Set environment variables in Railway dashboard"
echo "  5. Railway will auto-deploy!"
echo ""
echo "═══════════════════════════════════════════════════════════"
