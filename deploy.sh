#!/bin/bash
# ═══════════════════════════════════════════════════════════════════════
#  NÉRÉ MINING — Script de déploiement production
#  Usage : bash deploy.sh [--skip-backup] [--force]
#  Serveur cible : Ubuntu/Debian/AlmaLinux avec Apache2/Nginx + PHP 8.3+ + MySQL
# ═══════════════════════════════════════════════════════════════════════

set -e
CYAN='\033[0;36m'; GREEN='\033[0;32m'; RED='\033[0;31m'; YELLOW='\033[1;33m'; NC='\033[0m'
info()  { echo -e "${CYAN}[INFO]${NC} $1"; }
ok()    { echo -e "${GREEN}[OK]${NC}   $1"; }
warn()  { echo -e "${YELLOW}[WARN]${NC} $1"; }
error() { echo -e "${RED}[ERREUR]${NC} $1"; exit 1; }

APP_DIR="/var/www/nere-mining"
BACKUP_DIR="/var/backups/nere-mining"
BRANCH="production"
SKIP_BACKUP=false
FORCE=false

for arg in "$@"; do
    case $arg in
        --skip-backup) SKIP_BACKUP=true ;;
        --force)       FORCE=true ;;
    esac
done

echo ""
echo "═══════════════════════════════════════════════════════"
echo "  NÉRÉ MINING — Déploiement production (branche: $BRANCH)"
echo "═══════════════════════════════════════════════════════"
echo ""

# ── Vérifications préalables ──────────────────────────────────
info "Vérification des prérequis..."
command -v php  >/dev/null || error "PHP non trouvé"
command -v git  >/dev/null || error "Git non trouvé"
command -v mysql >/dev/null || error "MySQL CLI non trouvé"
php -r "if(version_compare(PHP_VERSION,'8.3.0','<')) exit(1);" || error "PHP 8.3+ requis ($(php -v | head -1))"
ok "PHP $(php -v | head -1 | cut -d' ' -f2) — OK"

if [ ! -f "$APP_DIR/.env" ]; then
    error "Fichier .env manquant dans $APP_DIR. Copiez .env.example en .env et configurez-le."
fi

# ── Backup avant déploiement ──────────────────────────────────
if [ "$SKIP_BACKUP" = false ]; then
    info "Sauvegarde de la base de données..."
    mkdir -p "$BACKUP_DIR"
    BACKUP_FILE="$BACKUP_DIR/db_$(date +%Y%m%d_%H%M%S).sql.gz"

    DB_NAME=$(grep '^DB_DATABASE=' "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")
    DB_USER=$(grep '^DB_USERNAME=' "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")
    DB_PASS=$(grep '^DB_PASSWORD=' "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")
    DB_HOST=$(grep '^DB_HOST='     "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")

    mysqldump -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" | gzip > "$BACKUP_FILE"
    ok "Backup créé : $BACKUP_FILE"

    # Garder seulement les 10 derniers backups
    ls -t "$BACKUP_DIR"/*.sql.gz 2>/dev/null | tail -n +11 | xargs rm -f 2>/dev/null || true
fi

# ── Mode maintenance ──────────────────────────────────────────
info "Activation du mode maintenance..."
cd "$APP_DIR"
php artisan down --message="Mise à jour en cours, revenez dans quelques minutes." --retry=60

# ── Récupérer le code ─────────────────────────────────────────
info "Mise à jour du code (git pull branche $BRANCH)..."
git fetch origin
git checkout "$BRANCH"
git pull origin "$BRANCH"
ok "Code mis à jour : $(git log --oneline -1)"

# ── Dépendances PHP ───────────────────────────────────────────
info "Installation des dépendances Composer..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
ok "Composer OK"

# ── Assets front-end ──────────────────────────────────────────
if [ -f "package.json" ]; then
    info "Build des assets front-end..."
    npm ci --ignore-scripts
    npm run build
    ok "Assets compilés"
fi

# ── Cache Laravel ─────────────────────────────────────────────
info "Vidage des caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# ── Migrations ────────────────────────────────────────────────
info "Exécution des migrations..."
php artisan migrate --force --no-interaction
ok "Migrations OK"

# ── Cache production ──────────────────────────────────────────
info "Mise en cache production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
ok "Cache production OK"

# ── Permissions ───────────────────────────────────────────────
info "Application des permissions..."
chown -R www-data:www-data storage bootstrap/cache public/uploads
chmod -R 775 storage bootstrap/cache public/uploads
ok "Permissions OK"

# ── Redémarrer PHP-FPM ────────────────────────────────────────
info "Redémarrage de PHP-FPM..."
systemctl reload php8.3-fpm 2>/dev/null || \
systemctl reload php-fpm     2>/dev/null || \
service php8.3-fpm reload    2>/dev/null || \
warn "Impossible de recharger PHP-FPM automatiquement — faites-le manuellement"

# ── Désactiver maintenance ────────────────────────────────────
info "Désactivation du mode maintenance..."
php artisan up

echo ""
echo "═══════════════════════════════════════════════════════"
ok "Déploiement terminé ! $(git log --oneline -1)"
echo "═══════════════════════════════════════════════════════"
echo ""
