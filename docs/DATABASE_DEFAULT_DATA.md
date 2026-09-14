# 📊 Données par Défaut de la Base de Données

## Vue d'ensemble

Le fichier `database/seeders/RobustSyncSeeder.php` contient **toutes les données par défaut** du site Néré Mining.

Lorsque vous déployez le site (en local ou en production), ces données sont automatiquement importées pour avoir un site **immédiatement fonctionnel** avec du contenu réel.

## Contenu Inclus

### 📰 Actualités (3 articles)
1. **Annulation du contrat d'achat d'or** - Gouvernance (20 juillet 2026)
2. **Forum Mines 2026** - HSE (16 juillet 2026)
3. **Semaine des Activités Minières de l'Afrique de l'Ouest** - Événement (29 novembre 2024)

### 🤝 Partenaires (1 partenaire)
- NEMMBA (catégorie: TECHNIQUE)

### 🎬 Carrousel Hero (6 slides)
1. Une mine de classe mondiale
2. Des opérations responsables
3. L'excellence industrielle
4. Des équipes engagées
5. Un territoire en mouvement
6. Karma, notre mine d'or (vidéo)

### 🏢 Départements Karma (9 départements)
1. Administration
2. Ressources humaines
3. Sûreté
4. Opérations (Mining)
5. HSE (Hygiène, Santé, Sécurité, Environnement)
6. Traitement (Processing)
7. Approvisionnement (Supply Chain)
8. Technologies (IT)
9. Dialogue local (Relations communautaires)

### ⚙️ Paramètres du Site (12 settings)
- Configuration du carrousel (autoplay, intervalle, vitesse, indicateurs, flèches)
- Coordonnées du contact presse

### 👥 Leadership (5 membres)
1. Dr. Justin Elie OUEDRAOGO - Président Directeur Général
2. Justin SAVADOGO - DGA Administration & Finance
3. Pascal Y. OUEDRAOGO - DGA Approvisionnements
4. Laurent Michel DABIRE - DGA Affaires Corporatives & Juridiques
5. Augustine OBENG-FORI - DGA par intérim Opérations

## 📁 Images Associées

Toutes les images uploadées sont versionnées dans Git :
- `public/uploads/news/` - Images des actualités
- `public/uploads/partners/` - Logos des partenaires
- `public/uploads/leadership/` - Photos des dirigeants
- `public/images/carousel/` - Images et vidéos du carrousel

## 🚀 Utilisation

### En Local
```bash
php artisan migrate:fresh
php artisan db:seed --class=RobustSyncSeeder
```

### En Production (Render)
Le seeder est **automatiquement exécuté** lors du déploiement via `deploy.sh`.

## 🔄 Mise à Jour des Données Par Défaut

Si tu veux modifier les données par défaut :

1. **Modifier le seeder** : édite `database/seeders/RobustSyncSeeder.php`
2. **Tester en local** :
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class=RobustSyncSeeder
   ```
3. **Commiter et pusher** :
   ```bash
   git add database/seeders/RobustSyncSeeder.php
   git commit -m "chore: update default database content"
   git push origin production-stable
   ```
4. **Redéployer** sur Render pour appliquer les changements

## 📝 Notes Techniques

- **Utilise Eloquent ORM** : pas de problèmes de syntaxe SQL MySQL/PostgreSQL
- **Gère les caractères spéciaux** : les apostrophes et accents français fonctionnent correctement
- **Type-safe** : les booléens PostgreSQL sont gérés automatiquement
- **Idempotent** : peut être exécuté plusieurs fois (TRUNCATE avant INSERT)

## ⚠️ Important

Ce seeder **supprime toutes les données existantes** (`TRUNCATE`) avant d'insérer les données par défaut.

**Ne l'exécute PAS en production sur un site actif sans backup !**

Pour un site en production avec des données utilisateurs, crée plutôt un seeder distinct qui n'utilise pas `TRUNCATE`.
