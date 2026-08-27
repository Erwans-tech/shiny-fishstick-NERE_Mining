#!/bin/sh
set -e

echo "=== Nere Mining — Demarrage ==="

# Render/Railway fournissent le port public via PORT ; conserver 80 en local/Docker.
PORT=${PORT:-80}
sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/nginx.conf

# ── 1. APP_KEY ────────────────────────────────────────────────
if [ -z "$APP_KEY" ]; then
    echo "[INFO] Generation APP_KEY..."
    php artisan key:generate --force
fi

# ── 2. Vider les caches ──────────────────────────────────────
php artisan config:clear  2>/dev/null || true
php artisan cache:clear   2>/dev/null || true
php artisan view:clear    2>/dev/null || true
php artisan route:clear   2>/dev/null || true

# ── 3. Attendre PostgreSQL ──────────────────────────────────
echo "[INFO] Attente de la base de donnees PostgreSQL..."
MAX=40
i=0
until php artisan db:show --no-interaction; do
    if [ $i -ge $MAX ]; then
        break
    fi
    echo "  Tentative $((i+1))/$MAX..."
    sleep 3
    i=$((i+1))
done

if [ $i -ge $MAX ]; then
    echo "[ERREUR] Impossible de joindre PostgreSQL apres $MAX tentatives."
    exit 1
fi
echo "[INFO] Base de donnees disponible."

# ── 4. Migrations ────────────────────────────────────────────
echo "[INFO] Migrations..."
php artisan migrate --force --no-interaction

# ── 5. Seed (une seule fois) ─────────────────────────────────
SEEDED_FLAG=/var/www/html/storage/.seeded
if [ ! -f "$SEEDED_FLAG" ]; then
    echo "[INFO] Premier demarrage — seed..."
    php artisan db:seed --force --no-interaction
    touch "$SEEDED_FLAG"
fi

# ── 6. Cache prod ────────────────────────────────────────────
echo "[INFO] Mise en cache production..."
php artisan config:cache
php artisan view:cache

# ── 7. Permissions ───────────────────────────────────────────
chown -R www-data:www-data storage bootstrap/cache public/uploads 2>/dev/null || true

# ── 8. Supervisord (php-fpm + nginx) ────────────────────────
echo "[INFO] Demarrage services..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
