# 🚀 Quick Start - Néré Mining

Guide de démarrage rapide pour reprendre le développement du site.

## 📦 Informations Essentielles

### URLs
- **Production :** https://www.nere-mining.bf (41.138.102.58)
- **Admin :** https://www.nere-mining.bf/gestion-nm
- **Repository :** https://github.com/Erwans-tech/shiny-fishstick-NERE_Mining

### Stack
- Laravel 11.x + PHP 8.2
- PostgreSQL 15
- Windows Server + IIS
- Branche : `production-stable`

---

## ⚡ Démarrage Local (5 min)

```bash
# 1. Clone
git clone https://github.com/Erwans-tech/shiny-fishstick-NERE_Mining.git
cd REFONTESITE

# 2. Install
composer install
npm install && npm run build

# 3. Config
cp .env.example .env
# Éditer .env avec vos credentials BDD
php artisan key:generate

# 4. Database
php artisan migrate
php artisan db:seed
php artisan settings:init

# 5. Storage & Admin
php artisan storage:link
php artisan admin:create

# 6. Serve
php artisan serve
# → http://localhost:8000
```

---

## 🔧 Commandes Utiles

### Développement
```bash
# Dev server
php artisan serve

# Watch assets
npm run dev

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Base de données
```bash
# Migrations
php artisan migrate
php artisan migrate:fresh --seed  # Reset + seed

# Seeders
php artisan db:seed
php artisan settings:init
php artisan admin:create
```

### Production
```bash
# Sur le serveur Windows
cd C:\inetpub\wwwroot\nere-mining
git pull origin production-stable
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
iisreset
```

---

## 📂 Structure Clé

```
app/
├── Http/Controllers/Admin/  # 18 contrôleurs admin
├── Models/                  # 15 modèles (User, News, PhotoAlbum, etc.)
├── Console/Commands/        # 2 commandes (admin:create, settings:init)
└── Helpers/                 # StorageHelper

resources/views/
├── admin/                   # Panel admin (50+ vues)
├── pages/                   # Pages publiques (20+)
├── partials/                # Nav, footer, etc.
└── layouts/app.blade.php    # Layout principal

public/
├── css/                     # 10+ fichiers CSS
├── js/                      # 5+ fichiers JS
└── images/                  # 500+ assets

routes/web.php               # 100+ routes FR/EN
```

---

## 🎯 Fonctionnalités Principales

### Site Public (✅ Complet)
- [x] Homepage bilingue FR/EN
- [x] Pages institutionnelles (Qui sommes-nous, Karma, Durabilité)
- [x] Actualités avec pagination
- [x] **Médiathèque : Albums photos + carousel auto**
- [x] Rapports téléchargeables (PDFs)
- [x] Carrières + candidatures en ligne
- [x] Formulaire contact
- [x] SEO optimisé (meta, OG, hreflang, canonical)

### Admin Panel (✅ Opérationnel)
- [x] Dashboard avec statistiques
- [x] Gestion actualités
- [x] **Gestion albums : CRUD + bulk upload (50 images)**
- [x] **Médiathèque : Upload + sélection multiple + suppression masse**
- [x] Offres emploi + candidatures
- [x] Paramètres site (25+ settings)
- [x] **Album featured homepage** (sélection dans paramètres)
- [x] Partenaires, certifications, rapports
- [x] Messages contact + newsletter

---

## 🎨 Système Albums (Feature Principale)

### Admin
```
/gestion-nm/albums           → Liste albums
/gestion-nm/albums/creer     → Créer album
/gestion-nm/albums/{id}/show → Gérer photos album
/gestion-nm/media/upload-multiple → Upload bulk
```

### Public
```
/mediatheque                 → Grille albums avec carousel
/mediatheque/album/{slug}    → Détail album + lightbox
```

### Carousel
- **Auto-slide :** 3 secondes
- **Pause hover :** Oui
- **Navigation :** Dots cliquables + clavier
- **Performance :** IntersectionObserver (démarre si visible)
- **Featured homepage :** Album affiché dans grille actualités

---

## 🐛 Problèmes Courants

### Images ne s'affichent pas
```bash
php artisan storage:link
# Vérifier .env :
APP_URL=https://www.nere-mining.bf
ASSET_URL=https://www.nere-mining.bf
```

### Page paramètres vide
```bash
php artisan settings:init
# ou
php artisan settings:init --force
```

### Upload échoue
Vérifier limites dans :
- `public/.user.ini` : `upload_max_filesize = 512M`
- `public/web.config` : `maxAllowedContentLength="536870912"`

### Erreur 500 admin
```bash
php artisan config:clear
php artisan cache:clear
php artisan migrate
```

---

## 📝 Modifications Récentes

### Derniers commits (18 sept 2026)

1. **e3377cf** - docs: README complet + RECAP_COMPLET
2. **0edb3c2** - docs: IMAGE_UPDATE.md
3. **eecc63c** - fix: Image extraction or (nouveau nom cache bust)
4. **834a228** - feat: Album featured dans grille actualités
5. **c694b6b** - fix: Lien portfolio public
6. **0fa01ea** - feat: Signature designer footer

### Fonctionnalités ajoutées
- ✅ Album featured sur homepage (intégré grille actualités)
- ✅ Carousel mini dans cartes actualités
- ✅ Upload bulk 50 images simultanées
- ✅ Sélection multiple + suppression masse
- ✅ Signature designer discrète footer
- ✅ HTTPS forcé + HSTS headers
- ✅ Image extraction or mise à jour

---

## 🔗 Liens Documentation

### Documentation Complète
- **README.md** : Vue d'ensemble projet
- **RECAP_COMPLET.md** : Guide exhaustif (1700+ lignes)
- **HTTPS_SETUP.md** : Configuration SSL
- **SETTINGS_INIT.md** : Paramètres site
- **IMAGE_UPDATE.md** : Mise à jour images

### Documentation Externe
- [Laravel 11](https://laravel.com/docs/11.x)
- [PostgreSQL](https://www.postgresql.org/docs/)
- [IIS Windows](https://learn.microsoft.com/en-us/iis/)

---

## 🚀 Workflow Git

### Développement
```bash
git checkout production-stable
git pull origin production-stable

# Modifications...

git add .
git commit -m "type: description"
git push origin production-stable
```

### Types de commit
- `feat:` Nouvelle fonctionnalité
- `fix:` Correction bug
- `docs:` Documentation
- `style:` Formatting
- `refactor:` Refactoring code
- `perf:` Performance
- `test:` Tests

---

## 📊 Statistiques Projet

- **Commits :** 100+
- **Lignes code PHP :** 15,000+
- **Fichiers Blade :** 80+
- **Migrations :** 20+
- **Modèles :** 15
- **Routes :** 100+ (FR + EN)
- **Controllers :** 20+
- **Assets :** 500+ images

---

## 👤 Contact

### Site
- **Email :** contact@nere-mining.bf
- **Téléphone :** +226 25 33 35 69
- **Adresse :** Ouagadougou, Burkina Faso

### Développeur
- **Portfolio :** https://erwans2003.github.io/ERWAN-PORTFOLIO/

---

## ✅ Checklist Avant de Commencer

- [ ] Repository cloné
- [ ] Dependencies installées (`composer install`)
- [ ] .env configuré (BDD, APP_URL)
- [ ] Migrations exécutées
- [ ] Settings initialisés (`php artisan settings:init`)
- [ ] Admin créé (`php artisan admin:create`)
- [ ] Storage linked (`php artisan storage:link`)
- [ ] README.md et RECAP_COMPLET.md lus
- [ ] Site local fonctionne (`php artisan serve`)
- [ ] Admin panel accessible

---

**Prêt à développer !** 🎯

Pour plus de détails, consulter **RECAP_COMPLET.md** (guide exhaustif).
