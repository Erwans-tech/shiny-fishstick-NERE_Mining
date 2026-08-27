# 🪨 Néré Mining — Guide de présentation du site

> Site web institutionnel bilingue (français / anglais) de la société minière **Néré Mining**, opérant la mine d'or de **Karma** au Burkina Faso.
> Développé avec **Laravel 11** + MySQL + Vite.

---

## 🗺️ Vue d'ensemble

```
Visiteur public ──→ Site FR / EN  (lecture seule, contenu dynamique BDD)
Administrateur ──→ /gestion-nm   (interface privée, gestion complète du contenu)
```

Le site est **100 % géré en BDD** : aucun contenu n'est codé en dur dans les templates — tout passe par l'admin.

---

## 🌐 Pages publiques

### Navigation principale

| URL (FR) | URL (EN) | Contenu |
|---|---|---|
| `/` | `/en` | Page d'accueil |
| `/qui-sommes-nous` | `/en/about` | Présentation société |
| `/qui-sommes-nous/mot-du-pdg` | `/en/about/ceo-message` | Mot du PDG |
| `/qui-sommes-nous/identite` | `/en/about/identity` | Identité & symbole |
| `/qui-sommes-nous/histoire` | `/en/about/history` | Histoire |
| `/qui-sommes-nous/valeurs` | `/en/about/values` | Vision & valeurs |
| `/qui-sommes-nous/gouvernance` | `/en/about/governance` | Gouvernance |
| `/karma` | `/en/karma` | Mine de Karma |
| `/projets` | `/en/projects` | Projets d'exploration |
| `/developpement-durable` | `/en/sustainability` | Hub DD |
| `/developpement-durable/communautes` | `/en/sustainability/communities` | Communautés |
| `/developpement-durable/environnement` | `/en/sustainability/environment` | Environnement |
| `/developpement-durable/sante-securite` | `/en/sustainability/health-safety` | HSE |
| `/developpement-durable/contenu-local` | `/en/sustainability/local-content` | Contenu local |
| `/actualites` | `/en/news` | Liste des actualités |
| `/actualites/{slug}` | `/en/news/{slug}` | Détail article |
| `/mediatheque` | `/en/media` | Galerie photos/vidéos |
| `/communiques` | `/en/press-releases` | Communiqués de presse |
| `/publications` | `/en/publications` | Rapports & documents |
| `/partenaires` | — | Partenaires institutionnels |
| `/carrieres` | `/en/careers` | Carrières |
| `/offres-emploi/{slug}` | `/en/jobs/{slug}` | Détail offre d'emploi |
| `/candidature-spontanee` | `/en/spontaneous-application` | Candidature spontanée |
| `/contact` | `/en/contact` | Contact |

### Page d'accueil — éléments dynamiques

- **Chiffres clés** (hardcodés dans les routes, modifiables) :
  - 80 000 oz / an de production d'or
  - 1 200+ emplois directs et indirects
  - 80 % de main-d'œuvre nationale
  - 18 Mrd CFA de retombées fiscales
- **3 dernières actualités** publiées (depuis la BDD)
- **Logos partenaires** (depuis la BDD, triés par `sort_order`)

---

## 🔐 Interface d'administration

### Accès
```
URL   : http://localhost:8000/gestion-nm
Login : email + mot de passe (compte utilisateur avec is_admin = true)
```

> ⚠️ L'URL `/admin` n'existe pas — c'est volontairement masqué pour la sécurité.

**Sécurité intégrée :** Rate limiting à 5 tentatives/minute par IP. Blocage automatique en cas d'attaque.

### Tableau de bord (`/gestion-nm/tableau-de-bord`)

Vue synthétique avec :
- Compteurs : actualités, offres, candidatures, médias, messages non lus
- 5 dernières actualités
- 5 derniers messages de contact
- 5 dernières candidatures reçues
- Offres d'emploi expirant dans 7 jours ⚠️

### Modules de gestion

| Module | URL admin | Ce qu'on peut faire |
|---|---|---|
| **Actualités** | `/gestion-nm/actualites` | Créer, modifier, supprimer des articles avec image et date de publication |
| **Publications** | `/gestion-nm/publications` | Gérer les rapports PDF (RSE, annuels, etc.) |
| **Offres d'emploi** | `/gestion-nm/emploi` | Créer des offres avec deadline, département, type de contrat |
| **Candidatures** | `/gestion-nm/candidatures` | Consulter les CV reçus, changer leur statut, télécharger les fichiers |
| **Partenaires** | `/gestion-nm/partenaires` | Gérer les logos partenaires affichés en accueil |
| **Communiqués** | `/gestion-nm/communiques` | Gérer les communiqués de presse PDF |
| **Médiathèque** | `/gestion-nm/media` | Uploader images/vidéos/documents affichés dans la galerie |
| **Messages** | `/gestion-nm/messages` | Lire les messages du formulaire de contact |

---

## 🗄️ Base de données

Le site utilise **MySQL** (ou SQLite en local) avec les tables suivantes :

### `news` — Actualités
| Champ | Description |
|---|---|
| `title` | Titre de l'article |
| `category` | Catégorie (ex : "Opérations", "RSE") |
| `excerpt` | Résumé court |
| `content` | Corps de l'article (HTML) |
| `image_path` | Chemin vers l'image (dans `public/uploads/news/`) |
| `published_at` | Date de publication (null = brouillon) |

### `reports` — Publications
| Champ | Description |
|---|---|
| `title` | Titre du rapport |
| `category` | Catégorie (RSE, Annuel, Technique…) |
| `description` | Description courte |
| `file_path` | Chemin vers le PDF |
| `published_at` | Date de publication |

### `job_offers` — Offres d'emploi
| Champ | Description |
|---|---|
| `title` | Intitulé du poste |
| `slug` | URL-friendly (ex: `ingenieur-minier-senior`) |
| `department` | Département (Mining, HSE, Finance…) |
| `location` | Lieu (ex: Karma, Burkina Faso) |
| `contract_type` | CDI, CDD, Stage… |
| `experience_level` | junior / mid / senior |
| `description` | Description du poste |
| `requirements` | Prérequis |
| `deadline` | Date limite de candidature |
| `is_published` | Visible sur le site ? |
| `is_spontaneous` | Offre de candidature spontanée ? |

### `job_applications` — Candidatures reçues
| Champ | Description |
|---|---|
| `first_name`, `last_name` | Identité du candidat |
| `email`, `phone` | Coordonnées |
| `cv_path` | CV uploadé (dans `public/uploads/applications/cv/`) |
| `cover_letter_path` | Lettre de motivation |
| `status` | `new` / `reviewed` / `shortlisted` / `rejected` |
| `job_offer_id` | Offre concernée (null si candidature spontanée) |

### `media_assets` — Médiathèque
| Champ | Description |
|---|---|
| `title` | Nom du média |
| `type` | `image`, `video`, `document` |
| `file_path` | Chemin du fichier |
| `caption` | Légende |
| `is_published` | Visible sur le site ? |
| `sort_order` | Ordre d'affichage |

### `partners` — Partenaires
| Champ | Description |
|---|---|
| `name` | Nom du partenaire |
| `category` | Institutionnel / Technique / Développement |
| `logo_path` | Chemin vers le logo SVG |
| `website_url` | Lien vers leur site |
| `is_published` | Visible sur le site ? |
| `sort_order` | Ordre d'affichage |

### `press_documents` — Communiqués de presse
| Champ | Description |
|---|---|
| `title` | Titre du communiqué |
| `document_type` | Presse, Annonce, etc. |
| `description` | Résumé |
| `file_path` | PDF associé |
| `published_at` | Date de publication |

### `contact_messages` — Messages de contact
| Champ | Description |
|---|---|
| `name`, `email` | Expéditeur |
| `subject` | Sujet |
| `message` | Corps du message |
| `type` | Catégorie de demande |
| `read_at` | Date de lecture (null = non lu) |

### `newsletter_subscribers` — Abonnés newsletter
| Champ | Description |
|---|---|
| `email` | Adresse e-mail |
| `subscribed_at` | Date d'inscription |

### `users` — Comptes admin
| Champ | Description |
|---|---|
| `name`, `email` | Identité |
| `password` | Mot de passe hashé (bcrypt) |
| `is_admin` | Doit être `true` pour accéder à l'admin |

---

## 📁 Stockage des fichiers

Tous les fichiers uploadés via l'admin atterrissent dans `public/uploads/` :

```
public/
└── uploads/
    ├── news/          ← images des articles
    ├── media/         ← galerie médiathèque
    ├── partners/      ← logos partenaires
    ├── press/         ← PDFs communiqués
    ├── reports/       ← PDFs publications
    └── applications/
        └── cv/        ← CV candidats
```

Les images seedées (données initiales) sont dans :
```
public/images/
    ├── mining/        ← photos de la mine Karma
    └── partners/      ← logos SVG partenaires institutionnels
```

---

## 🔄 Flux de données — exemple Actualités

```
Admin crée un article
        │
        ▼
Formulaire validé (titre, catégorie, image, date)
        │
        ▼
Image uploadée → public/uploads/news/
        │
        ▼
Enregistrement en BDD (table news)
        │
        ▼
Visiteur sur /actualites → Laravel charge les articles publiés
        │
        ▼
Vue Blade affiche les articles avec image = asset('uploads/' + image_path)
```

---

## 🌍 Fonctionnement bilingue

Le site est **entièrement bilingue FR/EN** :

- **Routes séparées** : `/actualites` (FR) vs `/en/news` (EN)
- **Traductions** dans `lang/fr/site.php` et `lang/en/site.php`
- **Contenu BDD** : les articles, rapports, offres sont partagés entre les deux langues (même contenu)
- **Basculement** : lien FR/EN dans le header de chaque page

---

## 🚀 Lancer le site en local

```bash
# 1. Démarrer le serveur
php artisan serve
# → http://localhost:8000

# 2. Site public
http://localhost:8000/

# 3. Admin
http://localhost:8000/gestion-nm
```

> **Compte admin par défaut** : créé automatiquement par le seeder (`AdminSeeder`).
> Vérifier dans `database/seeders/AdminSeeder.php` pour l'email et le mot de passe initiaux.

---

## ✅ Points forts à mentionner en présentation

- 🌐 **Bilingue natif** — FR et EN avec URLs propres
- 🔐 **Admin sécurisé** — URL masquée, rate limiting, session PHP
- 📱 **Responsive** — conçu pour mobile, tablette et desktop
- ♻️ **Contenu 100 % dynamique** — tout est gérable sans toucher au code
- 📎 **Gestion documentaire** — upload PDF, CV, images directement en admin
- 👥 **Module RH complet** — offres, candidatures, statuts, téléchargement CV
- 📧 **Formulaires intégrés** — contact, newsletter, candidature spontanée
- 🏗️ **Architecture MVC propre** — Laravel 11, facilement évolutif
