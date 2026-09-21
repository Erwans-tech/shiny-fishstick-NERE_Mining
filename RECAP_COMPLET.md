# 📋 RÉCAPITULATIF COMPLET - Site Néré Mining

**Date de ce récap :** 18 septembre 2026  
**Version site :** 2.0.0  
**Statut :** ✅ En production sur https://www.nere-mining.bf

---

## 🎯 CONTEXTE DU PROJET

### Client
**Néré Mining** - Groupe aurifère burkinabè  
Mine de Karma, Région du Nord, Burkina Faso

### Objectifs
1. Site institutionnel bilingue (FR/EN) moderne et professionnel
2. Panel d'administration complet pour gestion autonome
3. Médiathèque avec albums photos et carousel
4. Espace carrières avec candidatures en ligne
5. SEO optimisé et performance maximale
6. Sécurité HTTPS et conformité RGPD

### Stack Technique
- **Backend :** Laravel 11.x + PHP 8.2
- **Database :** PostgreSQL 15
- **Server :** Windows Server + IIS
- **Frontend :** Blade + Vanilla JS + CSS custom
- **Déploiement :** Git (production-stable branch)

---

## ✅ FONCTIONNALITÉS COMPLÈTES IMPLÉMENTÉES

### 🌐 SITE PUBLIC (Frontend)

#### 1. Pages Institutionnelles

**Page d'accueil (`/` et `/en`)**
- Hero slideshow avec 4 images + overlay texte animé
- Statistiques clés (4 tuiles animées)
- Section intro entreprise (2 colonnes : texte + points clés)
- **Album featured** : Premier élément de la grille actualités (carousel auto 3s)
- Dernières actualités (grille 4 colonnes avec featured album)
- Partenaires institutionnels (marquee scroll horizontal)
- SEO : balises OG, JSON-LD, canonical, hreflang

**Qui sommes-nous** (`/qui-sommes-nous`)
- Vue d'ensemble de l'entreprise
- Message du CEO avec photo
- Identité corporate
- Historique chronologique
- Valeurs IPRE (Intégrité, Professionnalisme, Respect, Esprit d'équipe)
- Gouvernance et structure

**Mine Karma** (`/karma`)
- Présentation générale mine
- **Exploitation** : Extraction + traitement or (image: `gold-extraction-plant.jpg`)
- Organisation : Départements + organigramme
- Modèle opérationnel : 4 étapes process
- Impact local : Communautés + routes + infrastructures
- **Ressources & Réserves** : Carte interactive, chiffres consolidés 2025

**Projets** (`/projets`)
- Projet CIL (Carbon-in-Leach) en développement
- Timeline et objectifs
- Investissements et retombées

**Développement Durable** (`/developpement-durable`)
- Communautés : Programmes sociaux, emploi local
- Environnement : Gestion eau, biodiversité, réhabilitation
- HSE : Santé, sécurité, certifications
- Contenu local : Achats locaux, formation, sous-traitance

**Actualités** (`/actualites`)
- Liste des news avec pagination
- Catégories : Actualités, Événement, Partenariats, Portrait
- Page détail article avec image, date, catégorie
- Articles hardcodés + BDD
- Featured articles sur homepage

**Médiathèque** (`/mediatheque`)
- Grille d'albums photos
- **Carousel auto-défilant** dans chaque carte (3 secondes, pause hover)
- Dots navigation cliquables
- Page album détail : lightbox + navigation clavier
- Compteur de photos par album

**Rapports** (`/rapports`)
- Liste rapports annuels téléchargeables (PDFs)
- Filtres par année
- Preview et download

**Espace Presse** (`/presse`)
- Communiqués de presse
- Dossier de presse (logos, photos HD, contacts média)

**Carrières** (`/carrieres`)
- Liste offres d'emploi actives
- Filtres par département
- Page détail offre : description, requis, responsabilités
- Formulaire candidature : upload CV + lettre motivation
- Candidature spontanée

**Contact** (`/contact`)
- Formulaire contact avec validation
- Coordonnées entreprise
- Google Maps intégré
- Confirmation envoi

**Pages légales**
- Mentions légales
- Politique de confidentialité
- Politique cookies

#### 2. Fonctionnalités UX/UI

**Navigation**
- Header sticky avec logo + menu horizontal
- Mega-menu avec sous-menus dropdown
- Breadcrumbs automatiques sur toutes les pages
- Footer avec 4 colonnes + liens légaux + **signature designer** (point discret)
- Langue switcher FR/EN
- Mobile responsive (burger menu)

**Animations & Performance**
- Scroll reveal (IntersectionObserver) sur tous les éléments
- Delays et stagger effects
- Particles background subtil
- Smooth scrolling
- Lazy loading images
- Asset caching avec versioning

**SEO & Meta**
- Balises title et description personnalisées par page
- OpenGraph (Facebook, LinkedIn)
- Twitter Cards
- JSON-LD schema.org (Organization, MiningCompany)
- Canonical URLs
- Hreflang FR/EN
- Sitemap XML

**Sécurité Frontend**
- HTTPS forcé (redirect automatique)
- HSTS headers (1 an)
- CSP headers (upgrade-insecure-requests)
- Forms avec CSRF tokens
- XSS protection via Blade escaping

---

### 🔐 PANEL ADMINISTRATEUR

**URL :** `/gestion-nm`  
**Authentification :** Login/password + sessions

#### 1. Dashboard (`/gestion-nm`)
- Statistiques en temps réel
  - Visiteurs aujourd'hui / cette semaine / ce mois
  - Nombre actualités publiées / brouillons
  - Nombre albums photos
  - Candidatures reçues / traitées
  - Messages contact non lus
- Graphiques Chart.js (visiteurs 7 derniers jours)
- Raccourcis actions rapides
- Dernières candidatures
- Derniers messages

#### 2. Gestion Contenus

**Actualités** (`/gestion-nm/actualites`)
- CRUD complet (Create, Read, Update, Delete)
- Champs : Titre (FR/EN), Slug, Catégorie, Image, Contenu, Extrait
- Upload image avec preview
- Statut : Publié / Brouillon
- Featured toggle (mise en avant homepage)
- Date de publication
- Liste avec recherche + filtres + pagination

**Albums Photos** (`/gestion-nm/albums`)
- CRUD albums (Titre, Description, Slug, Date)
- **Upload multiple** : Jusqu'à 50 images simultanées
- Drag & drop support
- Preview avant upload
- Gestion des médias de l'album (page dédiée)
- **Sélection multiple pour suppression** en masse
- Compteur photos
- Statut publié/brouillon

**Médiathèque** (`/gestion-nm/media`)
- Liste tous les médias (images)
- Upload simple ou **bulk** (50 max)
- Association à un album (dropdown)
- Champs : Titre, Alt text, Description
- Preview image
- **Sélection multiple** avec checkboxes
- **Suppression en masse** (action bar fixe en bas)
- Filtres : Album, Statut, Date
- Recherche par nom

**Slides Hero Homepage** (`/gestion-nm/hero-slides`)
- CRUD slides du hero homepage
- Types : Image ou Vidéo (YouTube/Vimeo embed)
- Upload image ou URL vidéo
- Textes overlay : Kicker + Titre + Description
- Ordre d'affichage (drag & drop)
- Actif/Inactif

**Rapports Annuels** (`/gestion-nm/rapports`)
- CRUD rapports
- Upload PDF (max 50MB)
- Champs : Titre, Année, Description, Type
- Langues : FR / EN
- Téléchargement / Preview

**Dossier Presse** (`/gestion-nm/presse`)
- CRUD documents presse
- Upload fichiers (PDF, images, ZIP)
- Catégories : Logo, Photo HD, Communiqué, Kit presse
- Description et date

#### 3. Ressources Humaines

**Offres d'emploi** (`/gestion-nm/emplois`)
- CRUD offres
- Champs : Titre, Département, Type contrat, Localisation
- Description poste, Requis, Responsabilités
- Date limite candidature
- Statut : Ouverte / Fermée / Pourvue
- Nombre de candidatures reçues

**Candidatures** (`/gestion-nm/candidatures`)
- Liste toutes les candidatures reçues
- Filtres : Offre, Statut, Date
- Détail candidat : Nom, Email, Téléphone, Message
- **Téléchargement CV + Lettre** (PDFs)
- Statut : Nouvelle / En cours / Acceptée / Refusée
- Notes internes
- Archivage

#### 4. Partenaires & Certifications

**Partenaires Institutionnels** (`/gestion-nm/partenaires`)
- CRUD partenaires
- Upload logo
- Champs : Nom, Catégorie, URL site
- Ordre affichage
- Actif/Inactif

**Certifications** (`/gestion-nm/certifications`)
- CRUD certifications mine
- Upload image certification
- Champs : Nom, Description, Organisme, Date obtention, Date expiration
- Statut : Valide / Expiré

**Départements Karma** (`/gestion-nm/departements`)
- CRUD départements mine
- Champs : Nom, Responsable, Description, Effectif
- Ordre hiérarchique (organigramme)

#### 5. Configuration Site

**Paramètres Généraux** (`/gestion-nm/parametres`)
- **25+ paramètres configurables** :
  - Contact : Téléphone, Email, Adresse
  - Social : Facebook, LinkedIn, Twitter, YouTube
  - SEO : Meta title, description, keywords
  - Carousel : Durée slides, Auto-play
  - **Album featured homepage** : Dropdown sélection album
  - Footer : Copyright, Description
  - Analytics : Google Analytics ID
  - Maintenance mode
- Initialisation : `php artisan settings:init`

**Utilisateurs Admin** (`/gestion-nm/utilisateurs`)
- CRUD utilisateurs admin
- Champs : Nom, Email, Mot de passe
- Rôles : Admin / Super Admin
- Dernière connexion
- Actif/Inactif

**Messages Contact** (`/gestion-nm/messages`)
- Liste messages formulaire contact
- Filtres : Lu/Non lu, Date
- Détail : Nom, Email, Sujet, Message, Date
- Marquer comme lu
- Répondre (lien mailto)
- Archiver / Supprimer

**Abonnés Newsletter** (`/gestion-nm/newsletter`)
- Liste emails abonnés
- Import CSV
- Export CSV
- Suppression multiple
- Statut : Actif / Désabonné

#### 6. Système

**Logs Système** (`/gestion-nm/logs`)
- Consultation logs Laravel
- Filtres par niveau (error, warning, info)
- Recherche par mot-clé
- Téléchargement log file

**Cache Management** (`/gestion-nm/cache`)
- Vider cache config
- Vider cache routes
- Vider cache views
- Rebuild cache

**Analytics** (`/gestion-nm/analytics`)
- Tableau visiteurs (IP, Page, Date, User Agent)
- Graphiques par page
- Export CSV

---

## 🎨 SYSTÈME D'ALBUMS PHOTOS (Fonctionnalité Clé)

### Architecture
- **Model :** `PhotoAlbum` (id, title, description, slug, date, is_published)
- **Relation :** `hasMany MediaAsset` via `album_id`
- **Routes :** 
  - Admin CRUD : `/gestion-nm/albums/*`
  - Public : `/mediatheque` (liste) + `/mediatheque/album/{slug}` (détail)

### Fonctionnalités Admin

**Création Album**
1. Formulaire : Titre, Description, Slug auto, Date
2. Validation : Slug unique, titre requis
3. Sauvegarde dans BDD

**Ajout d'Images**
1. **Upload simple** : 1 image à la fois
2. **Upload multiple** : Jusqu'à 50 images simultanées
   - Drag & drop zone
   - Preview thumbnails avant envoi
   - Barre de progression
   - Validation : Max 10MB par image, formats jpg/png/gif/webp
3. Association automatique à l'album
4. Champs par image : Titre, Alt, Description

**Gestion Images Album**
- Page dédiée `/gestion-nm/albums/{id}/show`
- Grille images de l'album
- **Sélection multiple** : Checkboxes sur chaque image
- **Action bar fixe** en bas : "Supprimer sélectionnées" + Compteur
- Suppression en masse avec confirmation
- Réorganisation ordre (futur : drag & drop)

**Album Featured Homepage**
1. Admin → Paramètres → `home_featured_album_id`
2. Dropdown liste tous les albums
3. Sélection d'un album
4. Album affiché en **première position de la grille actualités** sur homepage
5. Format carte identique aux actualités
6. Carousel auto-défilant (voir ci-dessous)

### Fonctionnalités Public

**Liste Albums** (`/mediatheque`)
- Grille responsive (3-4 colonnes)
- Chaque carte album affiche :
  - **Mini-carousel** : 4 premières images auto-défilent (3 secondes)
  - Dots navigation en bas
  - Titre album
  - Description (tronquée 120 chars)
  - Compteur photos
  - Lien "Voir l'album →"
- Hover effects (scale, ombre)
- Animations scroll reveal

**Détail Album** (`/mediatheque/album/{slug}`)
- En-tête : Titre + Description + Date + Compteur
- Grille images (3-4 colonnes responsive)
- Clic image → **Lightbox fullscreen**
  - Navigation : Flèches gauche/droite
  - Clavier : ← → pour naviguer, Esc pour fermer
  - Zoom image
  - Titre + description en overlay
  - Compteur "3 / 24"
  - Fond sombre semi-transparent
- Bouton retour à la médiathèque

**Album Featured Homepage**
- Affiché dans la grille actualités (section 4)
- Même format que cartes actualités :
  - Hauteur image : 170px
  - Mini-carousel avec 4 images max
  - Dots navigation
  - Badge "Album · X photos"
  - Titre + lien "Voir l'album →"
- Auto-slide 3 secondes
- Pause au survol
- Performance : IntersectionObserver (démarre seulement si visible)

### Carousel Technique

**CSS (`public/css/album-carousel.css`)**
- `.album-carousel` : Container principal
- `.album-carousel-slide` : Slides individuelles (absolute positioning)
- `.active` : Slide visible (opacity 1)
- `.album-carousel-dots` : Container dots
- `.dot.active` : Dot actif (background gold, width 20px)
- Transitions smooth (0.6s ease-in-out)
- Responsive breakpoints

**JavaScript (`public/js/album-carousel.js`)**
```javascript
// Sélectionne tous les carousels
document.querySelectorAll('.album-carousel, .album-carousel-mini')

// Pour chaque carousel :
1. Initialise index courant = 0
2. Fonction showSlide(index) : Toggle classes active
3. Fonction nextSlide() : Incrémente index (boucle)
4. setInterval 3000ms : Auto-slide si pas hover
5. Event listeners :
   - Dots : Clic change slide + restart timer 5s
   - Mouseenter : isHovered = true (pause)
   - Mouseleave : isHovered = false (reprend)
6. IntersectionObserver :
   - Démarre autoplay si visible (threshold 0.3)
   - Stop autoplay si invisible (économie ressources)
```

**Performance**
- IntersectionObserver : Démarre seulement si viewport
- Lazy loading images : `loading="lazy"`
- Transitions CSS (GPU accelerated)
- Event delegation pour dots

---

## 🔒 SÉCURITÉ IMPLÉMENTÉE

### HTTPS & Headers

**Middleware ForceHttps** (`app/Http/Middleware/ForceHttps.php`)
```php
// Redirige HTTP → HTTPS
if (!$request->secure()) {
    return redirect()->secure($request->getRequestUri(), 301);
}
```

**SecurityHeaders Middleware**
```php
// HSTS : Force HTTPS 1 an
'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains'

// CSP : Upgrade insecure requests
'Content-Security-Policy' => "upgrade-insecure-requests"

// X-Frame-Options : Pas d'iframe
'X-Frame-Options' => 'SAMEORIGIN'

// X-Content-Type-Options
'X-Content-Type-Options' => 'nosniff'
```

**IIS web.config** (`public/web.config`)
```xml
<!-- Redirect HTTP → HTTPS -->
<rule name="Force HTTPS" stopProcessing="true">
    <match url="(.*)" />
    <conditions>
        <add input="{HTTPS}" pattern="off" ignoreCase="true" />
    </conditions>
    <action type="Redirect" url="https://{HTTP_HOST}/{R:1}" redirectType="Permanent" />
</rule>

<!-- HSTS Header -->
<add name="Strict-Transport-Security" value="max-age=31536000; includeSubDomains" />

<!-- Request Limits (512MB uploads) -->
<requestLimits maxAllowedContentLength="536870912" />
```

### Authentification Admin

**Middleware AdminAuth** (`app/Http/Middleware/AdminAuth.php`)
```php
// Vérifie session auth
if (!session('admin_logged_in')) {
    return redirect()->route('admin.login');
}
```

**Login Controller** (`AdminLoginController`)
- Validation credentials vs BDD
- Hash password (bcrypt)
- Session stockée
- Logout = session flush

### Protection Formulaires

**CSRF**
- Tous les forms Blade : `@csrf`
- Vérification automatique Laravel

**Validation**
- FormRequest classes pour validation serveur
- Rules : required, email, max, mimes, etc.
- Messages d'erreur français/anglais

**SQL Injection**
- Eloquent ORM (prepared statements)
- Jamais de query raw avec input utilisateur

**XSS**
- Blade auto-escape : `{{ $var }}`
- HTML safe : `{!! $var !!}` (seulement contenu trusted)

### Upload Sécurisé

**Validation Fichiers**
```php
'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:10240'
'pdf' => 'required|mimes:pdf|max:51200'
'cv' => 'required|mimes:pdf,doc,docx|max:5120'
```

**Storage Sécurisé**
- Fichiers dans `storage/app/public/uploads/`
- Symlink vers `public/uploads/`
- Pas d'exécution PHP dans uploads
- Noms fichiers hashés (uuid)

---

## ⚡ PERFORMANCE & OPTIMISATION

### Backend

**Database**
- **Eager Loading** : `->with(['media', 'album'])` (évite N+1)
- **Pagination** : `->paginate(12)` sur listes longues
- **Indexation** : Index sur colonnes recherchées (slug, email, is_published)
- **Query caching** : Config cache pour settings

**Cache**
```bash
php artisan config:cache    # Cache config
php artisan route:cache     # Cache routes
php artisan view:cache      # Compile Blade templates
```

### Frontend

**Images**
- Lazy loading : `loading="lazy"` sur images fold
- Compression : Images optimisées avant upload
- Dimensions appropriées (pas de 4K pour thumbnails)
- Format moderne : WebP support

**CSS/JS**
- Minification assets
- Versioning cache busting : `?v={{ filemtime() }}`
- Critical CSS inline (hero)
- Async/defer scripts non-critiques

**Animations**
- IntersectionObserver (pas de scroll listener)
- CSS transforms (GPU accelerated)
- `will-change` sur éléments animés
- `requestAnimationFrame` pour JS animations

**Fonts**
- Google Fonts avec `preconnect`
- `font-display: swap` (évite FOIT)
- Subset limité (400, 500, 600, 700)

---

## 🌍 INTERNATIONALISATION (i18n)

### Configuration

**Langues supportées**
- Français (FR) - Défaut
- Anglais (EN) - Complet

**Détection langue**
- URL prefix : `/` (FR) vs `/en` (EN)
- Session storage : `app()->getLocale()`
- Switcher dans header

### Fichiers Traductions

**JSON** (`resources/lang/{locale}.json`)
```json
{
    "Welcome": "Bienvenue",
    "Read more": "Lire la suite",
    "Contact us": "Nous contacter"
}
```

**PHP Arrays** (`resources/lang/{locale}/site.php`)
```php
return [
    'nav_company' => 'Qui sommes-nous',
    'nav_karma' => 'Mine Karma',
    'home_intro_h2' => 'Un groupe minier...',
];
```

### Usage dans Blade

```blade
{{ __('Welcome') }}
{{ __('site.nav_company', [], $loc) }}
{{ $en ? 'News' : 'Actualités' }}
```

### Routes Bilingues

**Structure**
```php
// Français (root)
Route::get('/qui-sommes-nous', fn() => $page('fr', 'company'))
Route::get('/actualites', [NewsController::class, 'index'])

// Anglais (prefixé /en)
Route::get('/en/about', fn() => $page('en', 'company'))
Route::get('/en/news', [NewsController::class, 'index'])
```

**Named Routes**
```php
route('company')              // FR
route('english.company')      // EN
```

### SEO Multilingue

**Hreflang**
```html
<link rel="alternate" hreflang="fr" href="https://www.nere-mining.bf/qui-sommes-nous" />
<link rel="alternate" hreflang="en" href="https://www.nere-mining.bf/en/about" />
<link rel="alternate" hreflang="x-default" href="https://www.nere-mining.bf/qui-sommes-nous" />
```

**Canonical**
```html
<link rel="canonical" href="https://www.nere-mining.bf/qui-sommes-nous" />
```

**OpenGraph**
```html
<meta property="og:locale" content="fr_FR" />
<meta property="og:locale:alternate" content="en_US" />
```

---

## 📦 DÉPLOIEMENT & WORKFLOW

### Branches Git

**production-stable**
- Branche de production
- Code stable et testé
- Déployé sur serveur live

**Workflow**
```bash
# Développement local
git checkout production-stable
git pull origin production-stable

# Modifications
# ...

# Commit & Push
git add .
git commit -m "feat: description du changement"
git push origin production-stable
```

### Déploiement Serveur

**Étapes manuelles**
```bash
# SSH ou RDP sur serveur Windows
cd C:\inetpub\wwwroot\nere-mining

# Pull derniers changements
git pull origin production-stable

# Migrations BDD
php artisan migrate --force

# Clear & rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage link (si première fois)
php artisan storage:link

# Redémarrer IIS
iisreset
```

**Vérifications Post-Deploy**
1. Vérifier homepage charge : https://www.nere-mining.bf
2. Tester admin login : https://www.nere-mining.bf/gestion-nm
3. Vérifier images s'affichent
4. Tester formulaire contact
5. Vérifier carousel homepage
6. Tester upload dans admin

### Environnements

**Local (Dev)**
```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
DB_DATABASE=nere_mining_local
```

**Production**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://www.nere-mining.bf
DB_DATABASE=nere_mining
```

---

## 🐛 PROBLÈMES RÉSOLUS & FIXES

### 1. Album Images Ne S'Affichent Pas
**Symptôme :** Images uploadées mais non visibles sur site  
**Cause :** URLs pointent vers IP privée 196.168.10.202 au lieu du domaine  
**Solution :**
```env
APP_URL=https://www.nere-mining.bf
ASSET_URL=https://www.nere-mining.bf
```
**Commande :** `php artisan config:cache`

### 2. Page Paramètres Vide
**Symptôme :** `/gestion-nm/parametres` affiche page blanche  
**Cause :** Table `site_settings` vide, pas de seed  
**Solution :**
```bash
php artisan settings:init        # Première fois
php artisan settings:init --force # Réinitialiser
```

### 3. Upload Multiple Échoue (HTTP2_PROTOCOL_ERROR)
**Symptôme :** Erreur lors upload 50 images  
**Cause :** Limite IIS trop basse (30MB par défaut)  
**Solution :**
- `public/web.config` : `maxAllowedContentLength="536870912"` (512MB)
- `public/.user.ini` : `upload_max_filesize = 512M` + `post_max_size = 512M`

### 4. Erreur 500 sur Ajout Média
**Symptôme :** Crash lors accès formulaire média  
**Cause :** Query `PhotoAlbum::withCount()` avant migration table  
**Solution :** Try-catch dans controller
```php
try {
    $albums = PhotoAlbum::withCount('media')->get();
} catch (\Exception $e) {
    $albums = collect([]);
}
```

### 5. Mixed Content Warnings (HTTP/HTTPS)
**Symptôme :** Edge affiche "connexion non sécurisée"  
**Cause :** Requêtes HTTP dans page HTTPS  
**Solution :**
- Middleware `ForceHttps`
- CSP header `upgrade-insecure-requests`
- web.config redirect HTTP → HTTPS
- HSTS header 1 an

### 6. Image Karma Exploitation Ne Change Pas
**Symptôme :** Nouvelle image uploadée mais ancienne s'affiche  
**Cause :** Cache navigateur + même nom fichier  
**Solution :** Nouveau nom `gold-extraction-plant.jpg` au lieu de `karma-04.jpg`  
**Résultat :** Force re-download navigateur

---

## 📊 DONNÉES & SEEDS

### Database Seeds

**SiteSettingsSeeder** (25 paramètres)
```php
'company_phone' => '+226 25 33 35 69'
'company_email' => 'contact@nere-mining.bf'
'company_address' => 'Ouagadougou, Burkina Faso'
'footer_copyright' => '© 2024 Néré Mining...'
'carousel_duration' => '5'
'carousel_autoplay' => true
'home_featured_album_id' => null
'seo_meta_title' => 'Néré Mining - Mine de Karma'
'seo_meta_description' => 'Groupe aurifère...'
// ... 16 autres
```

**Fichier SQL Production** (`database/seeders/production_data.sql`)
- Contient données réelles (news, albums, etc.)
- Import : `psql -U postgres -d nere_mining -f production_data.sql`

### Commandes Artisan

**Créer admin**
```bash
php artisan admin:create
# Prompts : name, email, password
```

**Initialiser settings**
```bash
php artisan settings:init
php artisan settings:init --force  # Écrase existants
```

---

## 🎨 DESIGN SYSTEM

### Couleurs (Variables CSS)
```css
--ink:   #281d18  /* Texte principal noir chaud */
--green: #4b1716  /* Vert institutionnel bordeaux */
--red:   #d72f2f  /* Rouge accent CTA */
--gold:  #ffc247  /* Or primaire éclat */
--gold2: #e5a72f  /* Or secondaire foncé */
--sand:  #fff4dc  /* Fond sable clair */
--muted: #70645c  /* Texte secondaire gris chaud */
--line:  #eadcc5  /* Bordures beige */
--light: #fbfaf7  /* Blanc cassé */
```

### Typographie
- **Police :** Inter (Google Fonts)
- **Weights :** 300, 400, 500, 600, 700
- **Base size :** 17px (1rem)
- **Headings :**
  - H1 : 64px (clamp 34-64px)
  - H2 : 52px (clamp 30-52px)
  - H3 : 32px (clamp 24-32px)
  - H4 : 16px uppercase letterspacing

### Composants

**Boutons**
```css
.btn-gold   /* Fond or, hover scale */
.btn-dark   /* Fond vert, hover foncé */
.btn-ghost  /* Bordure blanc, hover fill */
.btn-outline /* Bordure or, hover fill */
```

**Cards**
```css
.card {
  background: rgba(255,255,255,.88);
  border: 1px solid var(--line);
  border-radius: 14px;
  padding: 30px;
  transition: transform .3s, box-shadow .3s;
}
.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(75,23,22,.08);
}
.card::before { /* Barre or top, scale X au hover */ }
```

**Grilles**
```css
.grid-2 { grid-template-columns: repeat(2, 1fr); }
.grid-3 { grid-template-columns: repeat(3, 1fr); }
.grid-4 { grid-template-columns: repeat(4, 1fr); } /* News */
```

### Animations

**Scroll Reveal**
```css
.sr {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity .7s cubic-bezier(.22,1,.36,1),
              transform .7s cubic-bezier(.22,1,.36,1);
}
.sr.is-visible {
  opacity: 1;
  transform: translateY(0);
}
.sr-delay-1 { transition-delay: .1s; }
.sr-delay-2 { transition-delay: .2s; }
/* ... */
```

**JavaScript**
```javascript
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('is-visible');
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.sr').forEach(el => observer.observe(el));
```

---

## 🔗 ROUTES PRINCIPALES

### Frontend Public

**Français**
```
/                           → Accueil
/qui-sommes-nous            → Company overview
/qui-sommes-nous/pdg        → CEO message
/qui-sommes-nous/identite   → Identity
/qui-sommes-nous/histoire   → History
/qui-sommes-nous/valeurs    → Values
/qui-sommes-nous/gouvernance → Governance
/karma                      → Karma mine overview
/karma/exploitation         → Operations
/karma/organisation         → Organization
/karma/modele-operationnel  → Operating model
/karma/impact-local         → Local impact
/karma/ressources-reserves  → Resources & reserves
/projets                    → Projects
/projets/cil                → CIL project
/developpement-durable      → Sustainability
/developpement-durable/communautes → Communities
/developpement-durable/environnement → Environment
/developpement-durable/hse  → HSE
/developpement-durable/contenu-local → Local content
/actualites                 → News list
/actualites/{slug}          → News detail
/mediatheque                → Gallery albums
/mediatheque/album/{slug}   → Album detail
/rapports                   → Annual reports
/presse                     → Press
/presse/contact             → Press contact
/carrieres                  → Careers
/carrieres/offre/{id}       → Job offer detail
/carrieres/candidature-spontanee → Spontaneous application
/contact                    → Contact form
/mentions-legales           → Legal notice
/politique-confidentialite  → Privacy policy
/politique-cookies          → Cookies policy
```

**Anglais** (même structure avec prefix `/en`)

### Backend Admin

```
/gestion-nm                     → Login page
/gestion-nm/dashboard           → Dashboard
/gestion-nm/actualites          → News CRUD
/gestion-nm/albums              → Albums CRUD
/gestion-nm/albums/{id}/show    → Album media management
/gestion-nm/media               → Media library
/gestion-nm/media/upload-multiple → Bulk upload
/gestion-nm/hero-slides         → Hero slides CRUD
/gestion-nm/rapports            → Reports CRUD
/gestion-nm/presse              → Press documents CRUD
/gestion-nm/emplois             → Job offers CRUD
/gestion-nm/candidatures        → Job applications
/gestion-nm/partenaires         → Partners CRUD
/gestion-nm/certifications      → Certifications CRUD
/gestion-nm/departements        → Karma departments CRUD
/gestion-nm/parametres          → Site settings
/gestion-nm/utilisateurs        → Admin users CRUD
/gestion-nm/messages            → Contact messages
/gestion-nm/newsletter          → Newsletter subscribers
/gestion-nm/analytics           → Site analytics
/gestion-nm/cache               → Cache management
/gestion-nm/logout              → Logout
```

---

## 📄 FICHIERS CLÉS À CONNAÎTRE

### Configuration
```
.env                            # Variables environnement
config/app.php                  # Config Laravel (locale, timezone)
config/database.php             # Config PostgreSQL
config/filesystems.php          # Storage disks
public/web.config               # Config IIS (redirects, limits)
public/.user.ini                # Limites upload PHP
```

### Routes
```
routes/web.php                  # Toutes les routes FR/EN
```

### Controllers
```
app/Http/Controllers/Admin/
  AdminDashboardController.php  # Dashboard stats
  AdminNewsController.php        # News CRUD
  AdminPhotoAlbumController.php  # Albums CRUD
  AdminMediaController.php       # Media + bulk upload/delete
  AdminJobController.php         # Job offers CRUD
  AdminJobApplicationController.php # Applications
  AdminSiteSettingController.php # Settings
  # ... 10+ autres
```

### Models
```
app/Models/
  User.php                      # Admin users
  SiteSetting.php               # Site settings (key-value)
  News.php                      # News articles
  PhotoAlbum.php                # Photo albums
  MediaAsset.php                # Images (relation album)
  HeroSlide.php                 # Homepage hero slides
  JobOffer.php                  # Job offers
  JobApplication.php            # Applications (CV + letter)
  Report.php                    # Annual reports
  PressDocument.php             # Press documents
  Partner.php                   # Partners
  Certification.php             # Certifications
  KarmaDepartment.php           # Karma departments
  ContactMessage.php            # Contact form messages
  NewsletterSubscriber.php      # Newsletter emails
  SiteAnalytics.php             # Visitor tracking
```

### Views Principales
```
resources/views/
  layouts/app.blade.php         # Layout principal (header, footer)
  home.blade.php                # Homepage
  pages/
    company*.blade.php          # Pages qui-sommes-nous
    karma*.blade.php            # Pages Karma
    cil-project.blade.php       # Projet CIL
    sustainability*.blade.php   # Développement durable
    contact.blade.php           # Contact
  news/
    index.blade.php             # Liste actualités
    show.blade.php              # Détail article
    *.blade.php                 # Articles hardcodés
  gallery/
    index.blade.php             # Liste albums
    album.blade.php             # Détail album
  careers/
    index.blade.php             # Liste offres
    show.blade.php              # Détail offre
    spontaneous.blade.php       # Candidature spontanée
  admin/                        # 50+ vues admin
  partials/
    _nav.blade.php              # Header navigation
    _footer.blade.php           # Footer
```

### Assets
```
public/css/
  chrome.css                    # Header/footer/navigation
  album-carousel.css            # Carousel albums
  animations.css                # Scroll reveal
  text-fixes.css                # Typo responsive
  # ... 6+ autres

public/js/
  album-carousel.js             # Carousel logic
  sustainability-animations.js  # Page sustainability
  # ... 3+ autres

public/images/
  logo-nere.png                 # Logo principal
  mining/                       # Images mine
    gold-extraction-plant.jpg   # Image exploitation or
    karma-*.jpg                 # Images Karma
    open-pit-mining.jpg         # Extraction ciel ouvert
  headers/                      # Images mastheads pages
  partners/                     # Logos partenaires
  news/                         # Images actualités
  hero/                         # Slides homepage
  resources/                    # Images ressources & réserves
```

### Migrations
```
database/migrations/
  *_create_users_table.php
  *_create_site_settings_table.php
  *_create_news_table.php
  *_create_photo_albums_table.php
  *_create_media_assets_table.php
  *_add_album_id_to_media_assets.php
  *_create_hero_slides_table.php
  *_create_job_offers_table.php
  *_create_job_applications_table.php
  *_create_reports_table.php
  *_create_press_documents_table.php
  *_create_partners_table.php
  *_create_certifications_table.php
  *_create_karma_departments_table.php
  *_create_contact_messages_table.php
  *_create_newsletter_subscribers_table.php
  *_create_site_analytics_table.php
  *_add_featured_album_home_setting.php
  # ... 20+ total
```

---

## 🚀 PROCHAINES ÉTAPES / AMÉLIORATIONS POSSIBLES

### Court Terme (Quick Wins)
- [ ] Export Excel candidatures (PhpSpreadsheet)
- [ ] Notifications email auto (new candidature, message contact)
- [ ] Multi-upload videos dans médiathèque
- [ ] Drag & drop réordonnancement images album
- [ ] Galerie filtres (année, catégorie)
- [ ] Recherche globale site (actualités + albums)

### Moyen Terme (Features)
- [ ] API REST pour application mobile
- [ ] Module commentaires actualités (modération)
- [ ] Newsletter automatisée (Mailchimp/SendGrid)
- [ ] Portail investisseurs sécurisé (login, documents confidentiels)
- [ ] Multi-langue admin panel
- [ ] Backup automatique BDD (cron job)
- [ ] Logs admin actions (audit trail)

### Long Terme (Strategic)
- [ ] Cache Redis (performances)
- [ ] CDN Cloudflare (assets statiques)
- [ ] Compression WebP automatique (Intervention Image)
- [ ] Elasticsearch (recherche avancée)
- [ ] Module e-learning formations HSE
- [ ] Carte interactive projets miniers (Leaflet/Mapbox)
- [ ] Chatbot support multilingue (Dialogflow)
- [ ] Intranet employés (accès sécurisé, documents RH)

---

## 📞 INFORMATIONS IMPORTANTES

### Accès Production
- **URL Site :** https://www.nere-mining.bf
- **URL Admin :** https://www.nere-mining.bf/gestion-nm
- **IP Serveur :** 41.138.102.58
- **Serveur :** Windows Server (IIS)
- **BDD :** PostgreSQL 15
- **SSH/RDP :** Accès via credentials client

### Credentials (SÉCURISÉ - Ne pas partager)
Stockés dans gestionnaire mots de passe client :
- Admin panel login/password
- Database user/password
- Server RDP credentials
- Git repository access

### Contact Technique
- **Email :** contact@nere-mining.bf
- **Téléphone :** +226 25 33 35 69
- **Adresse :** Ouagadougou, Burkina Faso

### Repository Git
- **URL :** https://github.com/Erwans-tech/shiny-fishstick-NERE_Mining
- **Branche principale :** `production-stable`
- **Branche dev :** `development` (si besoin)

---

## 📚 RESSOURCES & DOCUMENTATION

### Documentation Créée
1. **README.md** : Vue d'ensemble projet
2. **RECAP_COMPLET.md** : Ce fichier (guide exhaustif)
3. **HTTPS_SETUP.md** : Configuration SSL et sécurité
4. **SETTINGS_INIT.md** : Initialisation paramètres site
5. **IMAGE_UPDATE.md** : Mise à jour image extraction or
6. **ADMIN_FORM_FIX.md** : Corrections formulaires admin
7. **ANALYSIS_IMPROVEMENTS.md** : Analyses techniques

### Documentation Laravel
- **Officielle :** https://laravel.com/docs/11.x
- **Eloquent :** https://laravel.com/docs/11.x/eloquent
- **Blade :** https://laravel.com/docs/11.x/blade
- **Validation :** https://laravel.com/docs/11.x/validation

### Technologies Utilisées
- **Laravel 11 :** https://laravel.com
- **PostgreSQL :** https://www.postgresql.org
- **IIS :** https://www.iis.net
- **Inter Font :** https://fonts.google.com/specimen/Inter
- **Chart.js :** https://www.chartjs.org (dashboard graphs)

---

## ✅ CHECKLIST TRANSFERT PROJET

Pour continuer sur une autre IA ou avec un autre développeur :

### Code & Repository
- [x] Code pushé sur Git (production-stable)
- [x] README.md à jour
- [x] RECAP_COMPLET.md créé
- [x] Documentation technique complète
- [x] .env.example fourni
- [x] web.config configuré

### Base de Données
- [x] Migrations à jour
- [x] Seeders créés (SiteSettingsSeeder)
- [x] production_data.sql exporté
- [x] Commandes artisan documentées

### Fonctionnalités
- [x] Site public complet (FR/EN)
- [x] Panel admin fonctionnel
- [x] Albums photos + carousel
- [x] Upload bulk images
- [x] Sélection multiple suppression
- [x] Album featured homepage
- [x] Sécurité HTTPS
- [x] Performance optimisée
- [x] SEO configuré

### Déploiement
- [x] Serveur production configuré (IIS)
- [x] HTTPS actif
- [x] BDD PostgreSQL opérationnelle
- [x] Storage symlinked
- [x] Cache configuré
- [x] Procédure déploiement documentée

### Tests & Vérifications
- [x] Homepage charge correctement
- [x] Navigation FR/EN fonctionne
- [x] Admin login opérationnel
- [x] Upload images OK
- [x] Carousel auto-slide OK
- [x] Formulaire contact OK
- [x] Candidatures emploi OK
- [x] Toutes les pages accessibles

---

## 🎯 RÉSUMÉ EXÉCUTIF

**Site Néré Mining - Version 2.0.0**

✅ **Site institutionnel bilingue** (FR/EN) complet et professionnel  
✅ **Panel d'administration** puissant avec 15+ modules gestion  
✅ **Médiathèque avancée** : Albums, carousel auto, lightbox, bulk upload  
✅ **Carrières en ligne** : Offres + candidatures avec CV  
✅ **Sécurité renforcée** : HTTPS, HSTS, CSP, CSRF, XSS protection  
✅ **Performance optimisée** : Eager loading, lazy images, cache, IntersectionObserver  
✅ **SEO complet** : Meta, OG, JSON-LD, canonical, hreflang, sitemap  
✅ **Design moderne** : Animations scroll, responsive, accessibility  
✅ **En production** : https://www.nere-mining.bf (IP 41.138.102.58)

**Stack :** Laravel 11 + PostgreSQL 15 + IIS Windows Server  
**Commits :** 100+ sur branche `production-stable`  
**Lignes de code :** 15,000+ PHP/Blade  
**Assets :** 500+ images, 10+ CSS, 5+ JS  

**Ready to continue development. All documentation provided.**

---

**Dernière mise à jour :** 18 septembre 2026  
**Auteur :** Erwan (https://erwans2003.github.io/ERWAN-PORTFOLIO/)  
**Version :** 2.0.0
