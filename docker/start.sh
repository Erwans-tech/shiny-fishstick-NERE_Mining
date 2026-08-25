#!/bin/sh
set -e

echo "=== Néré Mining — Démarrage ==="

# ── 1. Générer APP_KEY si absent ──────────────────────────────
if [ -z "$APP_KEY" ]; then
    echo "[INFO] Génération APP_KEY..."
    php artisan key:generate --force
fi

# ── 2. Vider les caches ──────────────────────────────────────
echo "[INFO] Vidage des caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# ── 3. Attendre que MySQL soit prêt ─────────────────────────
echo "[INFO] Attente de la base de données..."
MAX=30
i=0
until php artisan db:monitor --max=1 > /dev/null 2>&1 || [ $i -eq $MAX ]; do
    echo "  Tentative $i/$MAX..."
    sleep 3
    i=$((i+1))
done

# ── 4. Migrations ────────────────────────────────────────────
echo "[INFO] Exécution des migrations..."
php artisan migrate --force --no-interaction

# ── 5. Seeder si première installation ───────────────────────
SEEDED_FLAG=/var/www/html/storage/.seeded
if [ ! -f "$SEEDED_FLAG" ]; then
    echo "[INFO] Premier démarrage — seed des données..."
    php artisan db:seed --force --no-interaction
    touch "$SEEDED_FLAG"
fi

# ── 6. Mettre les caches en prod ────────────────────────────
echo "[INFO] Mise en cache prod..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ── 7. Corriger les permissions storage ─────────────────────
chown -R www-data:www-data storage bootstrap/cache public/uploads 2>/dev/null || true

# ── 8. Démarrer php-fpm + nginx via supervisord ─────────────
echo "[INFO] Démarrage des services..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
