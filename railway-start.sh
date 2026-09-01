#!/bin/bash
set -e

echo "🚀 Starting Laravel on Railway..."

# Attendre que MySQL soit prêt
echo "⏳ Waiting for database..."
sleep 5

# Migrations
echo "📦 Running migrations..."
php artisan migrate --force

# Créer le lien symbolique storage
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Optimisations
echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer PHP-FPM en arrière-plan
echo "🔧 Starting PHP-FPM..."
php-fpm -y /etc/php/8.3/fpm/php-fpm.conf &

# Démarrer Nginx au premier plan
echo "🌐 Starting Nginx..."
nginx -c /app/nginx.conf -g 'daemon off;'
