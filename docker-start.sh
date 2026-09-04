#!/bin/sh

echo "🚀 Démarrage des services Laravel..."

# Clear any cached config from build time
echo "🗑️  Nettoyage du cache de configuration..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Cache config with runtime environment variables
echo "💾 Mise en cache de la configuration..."
php artisan config:cache
# NOTE: route:cache disabled because routes use closures (not serializable)
php artisan view:cache

# Exécuter les migrations sur la base configurée par l'environnement
echo "📊 Exécution des migrations..."
php artisan migrate --force

# Synchroniser les données éditoriales versionnées avec la base Render.
# Les tables sensibles (users, sessions, candidatures) ne sont pas concernées.
echo "🗃️  Synchronisation du contenu éditorial versionné..."
php artisan db:seed --class=LocalContentSeeder --force

# Créer ou mettre à jour l'administrateur depuis les secrets Render
if [ -n "$ADMIN_EMAIL" ] && [ -n "$ADMIN_PASSWORD" ]; then
	echo "👤 Initialisation du compte administrateur..."
	php artisan db:seed --class=AdminSeeder --force
else
	echo "⚠️ ADMIN_EMAIL/ADMIN_PASSWORD absents : aucun compte administrateur initialisé."
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