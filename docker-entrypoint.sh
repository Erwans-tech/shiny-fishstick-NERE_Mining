#!/bin/bash
set -e

echo "🐳 Starting Laravel on Render with Docker..."

# Attendre que la base de données soit prête
echo "⏳ Waiting for database..."
until php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null; do
    echo "Database not ready, waiting..."
    sleep 2
done

# Optimisations Laravel
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations
echo "📦 Running migrations..."
php artisan migrate --force

# Restaurer automatiquement le snapshot SQL de contenu éditorial exporté localement.
echo "📦 Loading local editorial content snapshot..."
php artisan db:seed --class=LocalContentSeeder --force || true

# Créer le lien symbolique storage
echo "🔗 Creating storage link..."
php artisan storage:link || true

echo "✅ Laravel ready!"

# Exécuter la commande par défaut (Apache)
exec "$@"