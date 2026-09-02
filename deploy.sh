#!/bin/bash
set -e

echo "🚀 Déploiement Néré Mining..."

# Vérification de la base de données
echo "🔍 Vérification de la connexion DB..."
if [ "$DB_CONNECTION" != "pgsql" ]; then
    echo "⚠️  Using DB_CONNECTION: $DB_CONNECTION"
fi

# Assurer que SQLite est writable si utilisé
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    echo "🗄️  Configuration SQLite pour écriture..."
    mkdir -p /opt/render/project/src/database
    touch /opt/render/project/src/database/database.sqlite
    chmod 666 /opt/render/project/src/database/database.sqlite
fi

# Configuration Laravel
echo "📦 Configuration de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Base de données
echo "🗄️  Mise à jour de la base de données..."
php artisan migrate --force

# Création de l'admin via commande artisan
echo "👤 Création de l'utilisateur admin..."
# Essayer avec PostgreSQL d'abord, puis SQLite en fallback
php artisan admin:create --email="$ADMIN_EMAIL" --password="$ADMIN_PASSWORD" || {
    echo "⚠️ PostgreSQL failed, trying with SQLite..."
    export DB_CONNECTION=sqlite
    export DB_DATABASE=/opt/render/project/src/database/database.sqlite
    php artisan config:clear
    php artisan migrate --force
    php artisan admin:create --email="$ADMIN_EMAIL" --password="$ADMIN_PASSWORD"
}

# Seeders (seulement si pas déjà fait)
echo "🌱 Initialisation des données..."
php artisan db:seed --force --class=EnrichedNewsSeeder || echo "Seeder déjà exécuté ou erreur"

echo "✅ Déploiement terminé !
🔗 Admin: ${APP_URL}/gestion-nm
📧 Email: ${ADMIN_EMAIL}
🔑 Mot de passe: ${ADMIN_PASSWORD}"