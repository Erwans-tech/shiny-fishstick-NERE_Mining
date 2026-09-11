#!/bin/sh

echo "🚀 Démarrage des services Laravel..."

# Clear any cached config from build time
echo "🗑️  Nettoyage du cache de configuration..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Copy production database if using SQLite
if [ "$DB_CONNECTION" = "sqlite" ]; then
    echo "📦 Utilisation de la base SQLite embarquée..."
    # Database is already in the image, just ensure it's writable
    chmod 664 "$DB_DATABASE" 2>/dev/null || true
fi

# Cache config with runtime environment variables
echo "💾 Mise en cache de la configuration..."
php artisan config:cache
php artisan view:cache

# Only run migrations if using external database (not SQLite)
if [ "$DB_CONNECTION" != "sqlite" ]; then
    echo "📊 Exécution des migrations..."
    php artisan migrate --force
    echo "🗃️  Synchronisation du contenu éditorial..."
    php artisan db:seed --class=ProductionSeeder --force
fi

# Créer ou mettre à jour l'administrateur
if [ -n "$ADMIN_EMAIL" ] && [ -n "$ADMIN_PASSWORD" ]; then
	echo "👤 Initialisation du compte administrateur..."
	php artisan db:seed --class=AdminSeeder --force
fi

# Créer le lien symbolique storage
echo "🔗 Création du lien storage..."
php artisan storage:link || true

# Démarrer PHP-FPM en arrière-plan
echo "🐘 Démarrage PHP-FPM..."
php-fpm -D

# Démarrer Nginx en premier plan
echo "🌐 Démarrage Nginx sur port 10000..."
nginx -g "daemon off;"
