#!/bin/bash
# ═══════════════════════════════════════════════════════════════════════
#  NÉRÉ MINING — Script de rollback production
#  Usage : bash rollback.sh [COMMIT_SHA]
#  Sans argument : revient au commit précédent
# ═══════════════════════════════════════════════════════════════════════

set -e
CYAN='\033[0;36m'; GREEN='\033[0;32m'; RED='\033[0;31m'; YELLOW='\033[1;33m'; NC='\033[0m'
info()  { echo -e "${CYAN}[INFO]${NC} $1"; }
ok()    { echo -e "${GREEN}[OK]${NC}   $1"; }
warn()  { echo -e "${YELLOW}[WARN]${NC} $1"; }
error() { echo -e "${RED}[ERREUR]${NC} $1"; exit 1; }

APP_DIR="/var/www/nere-mining"
BACKUP_DIR="/var/backups/nere-mining"
TARGET_COMMIT="${1:-HEAD~1}"

echo ""
echo "═══════════════════════════════════════════════════════"
echo "  NÉRÉ MINING — Rollback vers : $TARGET_COMMIT"
echo "═══════════════════════════════════════════════════════"
echo ""

cd "$APP_DIR"

CURRENT=$(git log --oneline -1)
info "Commit actuel : $CURRENT"
warn "Cette opération va revenir à : $TARGET_COMMIT"

if [ "${FORCE:-false}" != "true" ]; then
    read -p "Confirmer le rollback ? (oui/non) : " confirm
    [ "$confirm" = "oui" ] || error "Rollback annulé."
fi

# ── Mode maintenance ──────────────────────────────────────────
info "Activation du mode maintenance..."
php artisan down --message="Maintenance en cours." --retry=300

# ── Restaurer la base de données ──────────────────────────────
LATEST_BACKUP=$(ls -t "$BACKUP_DIR"/*.sql.gz 2>/dev/null | head -1)
if [ -n "$LATEST_BACKUP" ]; then
    warn "Dernier backup disponible : $LATEST_BACKUP"
    read -p "Restaurer ce backup ? (oui/non) : " restore_db
    if [ "$restore_db" = "oui" ]; then
        info "Restauration de la base de données..."
        DB_NAME=$(grep '^DB_DATABASE=' "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")
        DB_USER=$(grep '^DB_USERNAME=' "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")
        DB_PASS=$(grep '^DB_PASSWORD=' "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")
        DB_HOST=$(grep '^DB_HOST='     "$APP_DIR/.env" | cut -d'=' -f2 | tr -d '"' | tr -d "'")
        gunzip < "$LATEST_BACKUP" | mysql -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME"
        ok "Base de données restaurée depuis $LATEST_BACKUP"
    fi
fi

# ── Revenir au commit cible ───────────────────────────────────
info "Retour au commit $TARGET_COMMIT..."
git checkout "$TARGET_COMMIT"
ok "Code revert : $(git log --oneline -1)"

# ── Reconstruire ─────────────────────────────────────────────
info "Reconstruction des dépendances..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

if [ -f "package.json" ]; then
    npm ci --ignore-scripts && npm run build
fi

php artisan config:clear && php artisan route:clear && php artisan view:clear
php artisan config:cache  && php artisan route:cache  && php artisan view:cache

chown -R www-data:www-data storage bootstrap/cache public/uploads
chmod -R 775 storage bootstrap/cache public/uploads

systemctl reload php8.3-fpm 2>/dev/null || service php-fpm reload 2>/dev/null || true

php artisan up

echo ""
echo "═══════════════════════════════════════════════════════"
ok "Rollback terminé ! $(git log --oneline -1)"
echo "═══════════════════════════════════════════════════════"
echo ""
