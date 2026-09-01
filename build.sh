#!/bin/bash
set -e

echo "🔨 Building NERE Mining for Render..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --prefer-dist --optimize-autoloader

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --show > /tmp/app_key.txt
    export APP_KEY=$(cat /tmp/app_key.txt)
fi

# Clear old caches
echo "🧹 Clearing caches..."
php artisan config:clear || true
php artisan cache:clear || true

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force || true

# Rebuild caches
echo "⚙️ Building caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build completed successfully!"
