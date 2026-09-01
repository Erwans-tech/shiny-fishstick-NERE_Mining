#!/bin/bash
set -e

echo "🚀 Déploiement Néré Mining..."

# Configuration Laravel
echo "📦 Configuration de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Base de données
echo "🗄️  Mise à jour de la base de données..."
php artisan migrate --force

# Seeders (seulement si pas déjà fait)
echo "🌱 Initialisation des données..."
php artisan db:seed --force --class=AdminSeeder

echo "✅ Déploiement terminé !
🔗 Admin: ${APP_URL}/gestion-nm
📧 Email: ${ADMIN_EMAIL}
🔑 Mot de passe: ${ADMIN_PASSWORD}"