#!/bin/sh

echo "🚀 Démarrage des services Laravel..."

# Exécuter les migrations
echo "📊 Exécution des migrations..."
php artisan migrate --force

# Créer le lien symbolique storage
echo "🔗 Création du lien storage..."
php artisan storage:link

# Démarrer PHP-FPM en arrière-plan
echo "🐘 Démarrage PHP-FPM..."
php-fpm -D

# Démarrer Nginx en premier plan
echo "🌐 Démarrage Nginx..."
nginx -g "daemon off;"