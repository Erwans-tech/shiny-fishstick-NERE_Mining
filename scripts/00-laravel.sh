#!/usr/bin/env bash
# 🚀 Script de démarrage Laravel pour Render Docker
echo "Running Laravel deployment script..."

# Exécuter les migrations
php artisan migrate --force --no-interaction

# Créer le lien symbolique storage
php artisan storage:link

echo "Laravel deployment completed successfully!"