# Néré Mining - Site Web Officiel

![Néré Mining](public/images/logo-nere.png)

Site web institutionnel du groupe aurifère burkinabè Néré Mining, exploitant la mine de Karma dans la région du Nord du Burkina Faso.

## 🌐 URL de Production

- **Site principal :** https://www.nere-mining.bf
- **IP Serveur :** 41.138.102.58
- **Serveur :** Windows Server + IIS + PostgreSQL
- **SSL :** Actif (HTTPS forcé)

## 🏗️ Architecture Technique

### Stack
- **Framework :** Laravel 11.x
- **PHP :** 8.2+
- **Base de données :** PostgreSQL 15
- **Serveur web :** IIS (Windows Server)
- **Cache :** File cache
- **Session :** File driver
- **Storage :** Local public disk

### Structure du projet
```
REFONTESITE/
├── app/
│   ├── Console/Commands/
│   │   ├── CreateAdminUser.php
│   │   └── InitSiteSettings.php
│   ├── Helpers/
│   │   └── StorageHelper.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Panel d'administration
│   │   │   ├── CertificationController.php
│   │   │   ├── JobOfferController.php
│   │   │   ├── NewsController.php
│   │   │   └── ReportController.php
│   │   └── Middleware/
│   │       ├── AdminAuth.php
│   │       ├── ForceHttps.php
│   │       ├── SecurityHeaders.php
│   │       └── TrackVisitor.php
│   └── Models/                     # 15 modèles Eloquent
├── database/
│   ├── migrations/                 # 20+ migrations
│   └── seeders/
│       ├── SiteSettingsSeeder.php
│       └── production_data.sql
├── public/
│   ├── css/                        # Styles personnalisés
│   ├── js/                         # Scripts (carousel, animations)
│   ├── images/                     # Assets média
│   └── web.config                  # Configuration IIS
├── resources/
│   ├── lang/                       # Traductions FR/EN
│   └── views/
│       ├── admin/                  # Interface admin
│       ├── pages/                  # Pages publiques
│       ├── partials/               # Composants réutilisables
│       └── layouts/                # Layouts principaux
└── routes/
    └── web.php                     # Routes FR/EN

```

## ✨ Fonctionnalités Principales

### 🌍 Site Public (Bilingue FR/EN)

#### Pages Institutionnelles
- ✅ **Accueil** : Hero slideshow, statistiques, intro, actualités + album featured
- ✅ **Qui sommes-nous** : Présentation, CEO, identité, historique, valeurs, gouvernance
- ✅ **Mine Karma** : Exploitation, organisation, modèle opérationnel, impact local, ressources & réserves
- ✅ **Projets** : Projet CIL en développement
- ✅ **Développement Durable** : Communautés, environnement, HSE, contenu local
- ✅ **Actualités** : Blog avec catégories et pagination
- ✅ **Médiathèque** : Albums photos avec carousel auto-défilant et lightbox
- ✅ **Rapports** : Documents financiers et techniques téléchargeables
- ✅ **Espace Presse** : Communiqués et dossier de presse
- ✅ **Carrières** : Offres d'emploi avec candidatures en ligne
- ✅ **Contact** : Formulaire avec validation

#### Fonctionnalités UX
- ✅ Navigation sticky avec mega-menu
- ✅ Animations scroll reveal (IntersectionObserver)
- ✅ Breadcrumbs automatiques
- ✅ SEO optimisé (meta, OpenGraph, JSON-LD, canonical, hreflang)
- ✅ Footer avec liens légaux et signature designer
- ✅ Responsive design (mobile-first)
- ✅ Analytics visiteurs (IP, user agent, page, timestamp)

### 🎨 Médiathèque & Albums

#### Albums Photos
- ✅ Création d'albums avec titre, description, slug
- ✅ Upload d'images (simple ou bulk jusqu'à 50 images)
- ✅ Carousel auto-défilant (3 secondes, pause au survol)
- ✅ Lightbox avec navigation clavier
- ✅ Sélection multiple pour suppression en masse
- ✅ Album "featured" affiché sur homepage dans grille actualités
- ✅ Gestion des médias avec statut publié/brouillon

#### Carousel Features
- Auto-slide avec IntersectionObserver (performance)
- Navigation par dots cliquables
- Swipe touch pour mobile
- Lazy loading des images
- Format carte identique aux actualités sur homepage

### 🔐 Panel d'Administration

Accessible via `/gestion-nm` (authentification requise)

#### Modules Gestionaires
1. **Dashboard**
   - Statistiques en temps réel (visiteurs, contenus, candidatures)
   - Graphiques analytics (Chart.js)
   - Raccourcis actions rapides

2. **Contenus**
   - ✅ Actualités (CRUD, catégories, featured, publish/draft)
   - ✅ Albums photos (CRUD, bulk upload, carousel config)
   - ✅ Médiathèque (images, sélection multiple, filtres)
   - ✅ Rapports annuels (upload PDF, années, descriptions)
   - ✅ Dossier presse (documents, logos, contacts média)
   - ✅ Slides hero homepage (images/vidéos, textes, ordre)

3. **Ressources Humaines**
   - ✅ Offres d'emploi (CRUD, départements, statut)
   - ✅ Candidatures reçues (consultation, export, archivage)

4. **Partenaires & Certifications**
   - ✅ Partenaires institutionnels (logos, catégories, URLs)
   - ✅ Certifications (images, descriptions, validité)
   - ✅ Départements Karma (organigramme, responsables)

5. **Configuration**
   - ✅ Paramètres du site (25+ settings : contact, SEO, social, carousel)
   - ✅ Utilisateurs admin (création, modification, rôles)
   - ✅ Messages de contact (lecture, réponse, archivage)
   - ✅ Abonnés newsletter (import/export CSV)

6. **Système**
   - ✅ Logs système
   - ✅ Cache management
   - ✅ Maintenance mode
   - ✅ Backup database

### 🔒 Sécurité & Performance

#### Sécurité
- ✅ HTTPS forcé (middleware + web.config redirect)
- ✅ HSTS headers (1 an)
- ✅ CSP headers (upgrade-insecure-requests)
- ✅ CSRF protection sur tous les formulaires
- ✅ Authentification admin avec sessions
- ✅ Input validation (FormRequests)
- ✅ XSS protection (Blade escaping)
- ✅ SQL injection protection (Eloquent ORM)

#### Performance
- ✅ Eager loading (N+1 queries évitées)
- ✅ Image optimization (compression, lazy loading)
- ✅ Asset minification
- ✅ Browser caching headers
- ✅ IntersectionObserver pour animations
- ✅ Pagination sur listes longues

## 📦 Installation & Déploiement

### Prérequis
```bash
PHP >= 8.2
PostgreSQL >= 15
Composer 2.x
Node.js >= 18 (pour assets)
```

### Installation Locale
```bash
# Clone
git clone https://github.com/Erwans-tech/shiny-fishstick-NERE_Mining.git
cd REFONTESITE

# Dependencies
composer install
npm install && npm run build

# Configuration
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed
php artisan settings:init

# Storage
php artisan storage:link

# Créer admin
php artisan admin:create
```

### Déploiement Production (Windows IIS)

```bash
# Sur le serveur
cd C:\inetpub\wwwroot\nere-mining
git pull origin production-stable

# Migrations & cache
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Redémarrer IIS
iisreset
```

### Configuration IIS
- Document root : `public/`
- PHP-CGI activé
- URL Rewrite module installé
- HTTPS binding configuré
- web.config avec redirections et limites upload

## 🗄️ Base de Données

### Modèles Principaux
- **User** : Utilisateurs admin
- **SiteSetting** : Configuration site (25 paramètres)
- **News** : Actualités avec catégories
- **PhotoAlbum** : Albums photos
- **MediaAsset** : Images médiathèque (relation album)
- **HeroSlide** : Slides homepage
- **JobOffer** : Offres d'emploi
- **JobApplication** : Candidatures (CV + lettre)
- **Report** : Rapports annuels (PDFs)
- **PressDocument** : Dossier presse
- **Partner** : Partenaires institutionnels
- **Certification** : Certifications mine
- **KarmaDepartment** : Organigramme Karma
- **ContactMessage** : Messages formulaire contact
- **NewsletterSubscriber** : Abonnés newsletter
- **SiteAnalytics** : Tracking visiteurs

### Commandes Artisan Custom
```bash
# Créer un utilisateur admin
php artisan admin:create

# Initialiser les paramètres du site
php artisan settings:init
php artisan settings:init --force  # Écraser existants
```

## 🎨 Design & Branding

### Palette de Couleurs
```css
--ink:   #281d18  /* Texte principal */
--green: #4b1716  /* Vert institutionnel */
--red:   #d72f2f  /* Rouge accent */
--gold:  #ffc247  /* Or primaire */
--gold2: #e5a72f  /* Or secondaire */
--sand:  #fff4dc  /* Fond sable */
--muted: #70645c  /* Texte secondaire */
--line:  #eadcc5  /* Bordures */
```

### Typographie
- **Police principale :** Inter (Google Fonts)
- **Hiérarchie :** 400, 500, 600, 700
- **Taille base :** 17px (responsive avec clamp())

### Assets Principaux
- Logo : `public/images/logo-nere.png`
- Favicon : `public/favicon.svg`
- Images mining : `public/images/mining/`
- Headers pages : `public/images/headers/`
- Partenaires : `public/images/partners/`

## 🌍 Internationalisation (i18n)

### Langues Supportées
- **Français (FR)** : Langue par défaut
- **Anglais (EN)** : Version complète

### Fichiers de Traduction
- `resources/lang/fr.json` : Traductions françaises
- `resources/lang/en.json` : Traductions anglaises
- `resources/lang/fr/site.php` : Clés FR (fallback)
- `resources/lang/en/site.php` : Clés EN (fallback)

### Routes Bilingues
```php
// Français
/qui-sommes-nous
/karma/exploitation
/actualites
/mediatheque
/carrieres
/contact

// Anglais
/en/about
/en/karma/exploitation
/en/news
/en/media
/en/careers
/en/contact
```

### SEO Multilingue
- ✅ Balises hreflang automatiques
- ✅ Canonical URLs
- ✅ OpenGraph localisé
- ✅ Sitemap XML bilingue

## 🔧 Configuration Importante

### Fichiers .env Clés
```bash
APP_URL=https://www.nere-mining.bf
ASSET_URL=https://www.nere-mining.bf

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nere_mining
DB_USERNAME=postgres
DB_PASSWORD=***

FILESYSTEM_DISK=public
```

### Uploads & Limites
- **Images :** Max 10MB, formats: jpg, jpeg, png, gif, webp
- **PDFs :** Max 50MB
- **Bulk upload :** Max 50 images simultanées
- **Configuration :** `public/.user.ini` + `web.config`

### Cache & Storage
- **Cache :** File driver (storage/framework/cache)
- **Sessions :** File driver (storage/framework/sessions)
- **Uploads :** `public/uploads/` (symlinked to `storage/app/public/uploads/`)

## 📝 Documentation Additionnelle

- **HTTPS_SETUP.md** : Configuration SSL et sécurité
- **SETTINGS_INIT.md** : Guide initialisation paramètres
- **IMAGE_UPDATE.md** : Mise à jour images (cache busting)
- **ADMIN_FORM_FIX.md** : Corrections formulaires admin
- **ANALYSIS_IMPROVEMENTS.md** : Améliorations techniques

## 🐛 Debugging & Logs

### Logs Laravel
```bash
storage/logs/laravel.log
```

### Activer Debug Mode (LOCAL ONLY)
```bash
APP_DEBUG=true  # .env local
APP_ENV=local
```

### Common Issues

**Images ne s'affichent pas :**
```bash
php artisan storage:link
# Vérifier APP_URL et ASSET_URL dans .env
```

**Erreur 500 admin :**
```bash
php artisan config:clear
php artisan cache:clear
php artisan settings:init
```

**Upload échoue :**
```bash
# Vérifier limites dans public/.user.ini
# Vérifier requestLimits dans public/web.config
```

## 👥 Équipe & Crédits

### Développement
- **Backend & Frontend :** Full-stack Laravel
- **Design :** Interface moderne avec animations
- **Intégration :** IIS Windows Server + PostgreSQL

### Designer Signature
Un point discret dans le footer renvoie vers le portfolio du créateur du site :
- **URL :** https://erwans2003.github.io/ERWAN-PORTFOLIO/

## 📊 Statistiques du Projet

- **Lignes de code PHP :** ~15,000+
- **Fichiers Blade :** 80+
- **Migrations :** 20+
- **Modèles Eloquent :** 15
- **Routes :** 100+ (FR + EN)
- **Controllers :** 20+
- **Middleware custom :** 4
- **Artisan commands :** 2
- **Seeders :** 2
- **Assets CSS :** 10+ fichiers
- **Assets JS :** 5+ fichiers

## 🚀 Roadmap & Améliorations Possibles

### Phase 1 (Court terme)
- [ ] Système de notifications email (candidatures, messages)
- [ ] Export Excel des candidatures
- [ ] Multilingue admin panel
- [ ] API REST pour mobile app

### Phase 2 (Moyen terme)
- [ ] Système de cache Redis
- [ ] CDN pour assets statiques
- [ ] Compression WebP automatique
- [ ] Newsletter automatisée (Mailchimp/SendGrid)

### Phase 3 (Long terme)
- [ ] Portail investisseurs sécurisé
- [ ] Module e-learning formations HSE
- [ ] Carte interactive projets miniers
- [ ] Chatbot support multilingue

## 📞 Support & Maintenance

### Contact Technique
- **Email :** contact@nere-mining.bf
- **Téléphone :** +226 25 33 35 69

### Mise à Jour du Site
```bash
# Toujours travailler sur la branche production-stable
git checkout production-stable
git pull origin production-stable

# Faire les modifications
git add .
git commit -m "description des changements"
git push origin production-stable

# Déployer sur serveur
ssh serveur
cd /path/to/site
git pull origin production-stable
php artisan migrate --force
iisreset
```

## 📜 Licence

© 2024-2026 Néré Mining. Tous droits réservés.

Ce projet est propriétaire et confidentiel. Toute reproduction, distribution ou utilisation non autorisée est strictement interdite.

---

**Version :** 2.0.0  
**Dernière mise à jour :** 18 septembre 2026  
**Statut :** ✅ En production  
**URL :** https://www.nere-mining.bf
