#!/bin/bash
set -e

echo "🚀 Déploiement Néré Mining..."

# Vérification de la base de données
echo "🔍 Vérification de la connexion DB..."
if [ "$DB_CONNECTION" != "pgsql" ]; then
    echo "⚠️  ATTENTION: DB_CONNECTION devrait être 'pgsql', pas '$DB_CONNECTION'"
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
php artisan admin:create --email="$ADMIN_EMAIL" --password="$ADMIN_PASSWORD" || echo "❌ Erreur création admin"

# Seeders (seulement si pas déjà fait)
echo "🌱 Initialisation des données..."
php artisan db:seed --force --class=EnrichedNewsSeeder || echo "Seeder déjà exécuté ou erreur"

echo "✅ Déploiement terminé !
🔗 Admin: ${APP_URL}/gestion-nm
📧 Email: ${ADMIN_EMAIL}
🔑 Mot de passe: ${ADMIN_PASSWORD}"