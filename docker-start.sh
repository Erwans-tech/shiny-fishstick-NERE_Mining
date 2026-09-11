#!/bin/sh

echo "🚀 Démarrage des services Laravel..."

# Load .env.render if it exists
if [ -f ".env.render" ]; then
    echo "📋 Chargement .env.render..."
    set -a
    . .env.render
    set +a
fi

# Clear any cached config from build time
echo "🗑️  Nettoyage du cache de configuration..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# IMPORTANT: Debug database configuration
echo "🔍 Configuration base de données détectée :"
echo "  DB_CONNECTION: $DB_CONNECTION"
echo "  DB_HOST: $DB_HOST"
echo "  DB_PORT: $DB_PORT"
echo "  DB_DATABASE: $DB_DATABASE"
echo "  DB_USERNAME: $DB_USERNAME"

# Copy production database if using SQLite
if [ "$DB_CONNECTION" = "sqlite" ]; then
    echo "📦 Utilisation de la base SQLite embarquée..."
    # Database is already in the image, just ensure it's writable
    chmod 664 "$DB_DATABASE" 2>/dev/null || true
fi

# Cache config with runtime environment variables AFTER database setup
echo "💾 Mise en cache de la configuration avec les variables d'environnement de runtime..."
php artisan config:cache
php artisan view:cache

# Only run migrations if using external database (not SQLite)
if [ "$DB_CONNECTION" != "sqlite" ]; then
    # Test database connection first
    echo "🔍 Test de connexion à la base de données..."
    php artisan db:show --database=pgsql || {
        echo "❌ Impossible de se connecter à PostgreSQL"
        echo "Variables d'environnement actuelles :"
        echo "  DB_HOST: '$DB_HOST'"
        echo "  DB_PORT: '$DB_PORT'"
        echo "  DB_DATABASE: '$DB_DATABASE'"
        echo "  DB_USERNAME: '$DB_USERNAME'"
        exit 1
    }
    
    echo "✅ Connexion à PostgreSQL réussie !"
    echo "📊 Exécution des migrations..."
    php artisan migrate --force
    
    echo "📥 Import des données de production..."
    php artisan data:import-production || {
        echo "⚠️  Avertissement: Import des données échoué, utilisation des seeders de base"
        php artisan db:seed --class=ProductionSeeder --force
    }
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
