#!/bin/sh
# Pas de set -e global : on gère nous-mêmes les erreurs critiques
# pour éviter qu'une commande échoue silencieusement et tue le démarrage.

echo "=== Nere Mining — Demarrage ==="

# ── Render injecte le port via $PORT (défaut 10000) ──────────
PORT=${PORT:-10000}
echo "[INFO] Port nginx : $PORT"
sed -i "s/__PORT__/${PORT}/" /etc/nginx/nginx.conf

# ── 1. APP_KEY ────────────────────────────────────────────────
if [ -z "$APP_KEY" ]; then
    echo "[INFO] Generation APP_KEY..."
    php artisan key:generate --force || true
fi

# ── 2. Vider les caches Laravel ──────────────────────────────
echo "[INFO] Nettoyage des caches..."
php artisan config:clear  || true
php artisan cache:clear   || true
php artisan view:clear    || true
php artisan route:clear   || true

# ── 3. Attendre PostgreSQL (60 tentatives × 3s = 3 min max) ──
echo "[INFO] Attente de la base de donnees PostgreSQL..."
MAX=60
i=0
DB_READY=0

until [ $i -ge $MAX ]; do
    # Test de connexion simple via PHP PDO sans passer par Artisan
    if php -r "
        \$url = getenv('DATABASE_URL');
        if (\$url) {
            // Extraire les composants de DATABASE_URL
            \$p = parse_url(\$url);
            \$dsn = 'pgsql:host='.\$p['host'].';port='.(\$p['port'] ?? 5432).';dbname='.ltrim(\$p['path'],'/');
            \$pdo = new PDO(\$dsn, \$p['user'], \$p['pass'], [PDO::ATTR_TIMEOUT => 5]);
            echo 'ok';
        } else {
            \$dsn = 'pgsql:host='.getenv('DB_HOST').';port='.(getenv('DB_PORT') ?: 5432).';dbname='.getenv('DB_DATABASE');
            \$pdo = new PDO(\$dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'), [PDO::ATTR_TIMEOUT => 5]);
            echo 'ok';
        }
    " 2>/dev/null | grep -q "ok"; then
        DB_READY=1
        break
    fi
    i=$((i+1))
    echo "  Tentative $i/$MAX — attente 3s..."
    sleep 3
done

if [ $DB_READY -eq 0 ]; then
    echo "[ERREUR] Impossible de joindre PostgreSQL apres $MAX tentatives. Abandon."
    exit 1
fi
echo "[INFO] Base de donnees disponible."

# ── 4. Migrations ────────────────────────────────────────────
echo "[INFO] Migrations..."
php artisan migrate --force --no-interaction
if [ $? -ne 0 ]; then
    echo "[ERREUR] Migrations echouees."
    exit 1
fi

# ── 5. Seed (une seule fois) — flag persistant dans storage ──
SEEDED_FLAG=/var/www/html/storage/.seeded
if [ ! -f "$SEEDED_FLAG" ]; then
    echo "[INFO] Premier demarrage — seed des donnees initiales..."
    php artisan db:seed --force --no-interaction && touch "$SEEDED_FLAG"
else
    echo "[INFO] Donnees deja seedees, skip."
fi

# ── 6. Mise en cache production ──────────────────────────────
echo "[INFO] Mise en cache production..."
php artisan config:cache  || true
php artisan route:cache   || true
php artisan view:cache    || true

# ── 7. Permissions et dossiers d'upload ─────────────────────
echo "[INFO] Creation des dossiers d'upload..."
mkdir -p \
    /var/www/html/public/uploads/news \
    /var/www/html/public/uploads/media \
    /var/www/html/public/uploads/applications/cv \
    /var/www/html/public/uploads/applications/cover \
    /var/www/html/public/uploads/partners \
    /var/www/html/public/uploads/press \
    /var/www/html/public/uploads/reports/covers \
    /var/www/html/public/uploads/hero

echo "[INFO] Application des permissions..."
chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/public/uploads

chmod -R 775 \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/public/uploads

# Vérification que l'écriture fonctionne
if ! su-exec www-data touch /var/www/html/public/uploads/.write_test 2>/dev/null; then
    echo "[WARN] Le dossier public/uploads n'est pas inscriptible par www-data"
    echo "[WARN] Les uploads pourraient echouer. Verifiez les permissions."
else
    rm -f /var/www/html/public/uploads/.write_test
    echo "[INFO] Permissions uploads OK."
fi

# ── 8. Lancer supervisord (php-fpm + nginx) ──────────────────
echo "[INFO] Demarrage services (port $PORT)..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
