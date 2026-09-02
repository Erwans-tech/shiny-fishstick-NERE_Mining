#!/bin/bash
set -e

echo "🎯 Deploying Néré Mining to Render..."

# Installation des dépendances
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Vérifications avant déploiement
echo "🔍 Running pre-deployment checks..."

# Vérifier que les variables d'environnement critiques sont présentes
if [ -z "$APP_KEY" ]; then
    echo "❌ APP_KEY is not set!"
    exit 1
fi

if [ -z "$DB_HOST" ]; then
    echo "❌ Database configuration missing!"
    exit 1
fi

# Optimisations Laravel
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache 
php artisan view:cache

# Migrations de base de données
echo "🗃️ Running database migrations..."
php artisan migrate --force

# Création du lien symbolique storage
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Nettoyage
echo "🧹 Cleaning up..."
php artisan optimize

echo "✅ Deployment completed successfully!"
echo "🌐 Your app should be available at: $APP_URL"