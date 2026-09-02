#!/bin/sh
# Script de démarrage — Production serveurs Néré Mining
# Base de données : PostgreSQL (Render)

echo "=== Nere Mining — Demarrage production ==="

# ── Port (Render : 10000, Apache/Nginx classique : 80) ───────
PORT=${PORT:-80}
echo "[INFO] Port web : $PORT"
sed -i "s/__PORT__/${PORT}/" /etc/nginx/nginx.conf

# ── 1. APP_KEY ────────────────────────────────────────────────
if [ -z "$APP_KEY" ]; then
    echo "[INFO] Generation APP_KEY..."
    php artisan key:generate --force || true
fi

# ── 2. Vider les caches ──────────────────────────────────────
echo "[INFO] Nettoyage des caches..."
php artisan config:clear  || true
php artisan cache:clear   || true
php artisan view:clear    || true
php artisan route:clear   || true

# ── 3. Attendre PostgreSQL ──────────────────────────────────
echo "[INFO] Attente de PostgreSQL..."
MAX=40
i=0
DB_READY=0

until [ $i -ge $MAX ]; do
    if php -r "
        try {
            \$host = getenv('DB_HOST') ?: 'localhost';
            \$port = getenv('DB_PORT') ?: '5432';
            \$db   = getenv('DB_DATABASE') ?: 'nere_mining';
            \$user = getenv('DB_USERNAME') ?: 'nere_user';
            \$pass = getenv('DB_PASSWORD') ?: '';
            \$pdo  = new PDO(\"pgsql:host={\$host};port={\$port};dbname={\$db}\",
                            \$user, \$pass,
                            [PDO::ATTR_TIMEOUT => 5, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            echo 'ok';
        } catch (Exception \$e) { exit(1); }
    " 2>/dev/null | grep -q "ok"; then
        DB_READY=1
        break
    fi
    i=$((i+1))
    echo "  Tentative $i/$MAX — attente 3s..."
    sleep 3
done

if [ $DB_READY -eq 0 ]; then
    echo "[ERREUR] PostgreSQL injoignable apres $MAX tentatives."
    exit 1
fi
echo "[INFO] PostgreSQL disponible."

# ── 4. Migrations ────────────────────────────────────────────
echo "[INFO] Migrations PostgreSQL..."

# Essayer les migrations, ignorer les erreurs de tables existantes
php artisan migrate --force --no-interaction 2>&1 | grep -v "already exists" || {
    echo "[INFO] Certaines migrations ont echoue (normal si tables existent deja)"
}

# ── 5. Seed initial (une seule fois) ─────────────────────────
SEEDED_FLAG=/var/www/html/storage/.seeded
if [ ! -f "$SEEDED_FLAG" ]; then
    echo "[INFO] Premier demarrage — seed..."
    php artisan db:seed --force --no-interaction && touch "$SEEDED_FLAG"
else
    echo "[INFO] Donnees deja seedees — skip."
fi

# ── 6. Cache production ──────────────────────────────────────
echo "[INFO] Mise en cache production..."
php artisan config:cache  || true
php artisan route:cache   || true
php artisan view:cache    || true

# ── 7. Dossiers d'upload et permissions ──────────────────────
echo "[INFO] Dossiers uploads et permissions..."
mkdir -p \
    /var/www/html/public/uploads/news \
    /var/www/html/public/uploads/media \
    /var/www/html/public/uploads/applications/cv \
    /var/www/html/public/uploads/applications/cover \
    /var/www/html/public/uploads/partners \
    /var/www/html/public/uploads/press \
    /var/www/html/public/uploads/reports/covers \
    /var/www/html/public/uploads/hero

chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/public/uploads

chmod -R 775 \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/public/uploads

# Test d'écriture
if su-exec www-data touch /var/www/html/public/uploads/.write_test 2>/dev/null; then
    rm -f /var/www/html/public/uploads/.write_test
    echo "[INFO] Permissions uploads OK."
else
    echo "[WARN] public/uploads non inscriptible — uploads pourraient echouer."
fi

# ── 8. Supervisord ───────────────────────────────────────────
echo "[INFO] Demarrage services (port $PORT)..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
