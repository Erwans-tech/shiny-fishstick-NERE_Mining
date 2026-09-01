#!/bin/sh

echo "🚀 Démarrage des services Laravel..."

# Exécuter les migrations seulement si DB est configurée
if [ -n "$DB_HOST" ] && [ -n "$DB_PASSWORD" ]; then
    echo "📊 Exécution des migrations..."
    php artisan migrate --force || echo "⚠️  Migrations échouées - DB non accessible"
else
    echo "⚠️  Variables DB non configurées - migrations ignorées"
fi

# Créer le lien symbolique storage
echo "🔗 Création du lien storage..."
php artisan storage:link

# Démarrer PHP-FPM en arrière-plan
echo "🐘 Démarrage PHP-FPM..."
php-fpm -D

# Démarrer Nginx en premier plan
echo "🌐 Démarrage Nginx sur port 10000..."
nginx -g "daemon off;"