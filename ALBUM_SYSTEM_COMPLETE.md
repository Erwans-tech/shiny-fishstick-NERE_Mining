# 📸 Système d'Albums Photo - Médiathèque

## ✅ Fonctionnalités Implémentées

### 1. **Base de Données**
- ✅ Table `photo_albums` (titre, description, cover_image, is_published, sort_order)
- ✅ Colonne `album_id` dans `media_assets` (relation nullable)
- ✅ Relations Eloquent bidirectionnelles

### 2. **Backend (Laravel)**
- ✅ Modèle `PhotoAlbum` avec relations et accessors
- ✅ Modèle `MediaAsset` mis à jour avec relation album
- ✅ `AdminPhotoAlbumController` : CRUD complet
- ✅ `AdminMediaController` : sélection d'album ajoutée
- ✅ Routes admin et publiques (FR + EN)

### 3. **Interface Admin**
- ✅ Liste des albums avec recherche et stats
- ✅ Formulaire création/édition avec upload d'image de couverture
- ✅ Vue détail : grid des photos de l'album
- ✅ Sélecteur d'album dans le formulaire des médias
- ✅ Colonne "Album" dans la liste des médias

### 4. **Interface Publique**
- ✅ Page médiathèque : grid d'albums avec carousel auto-sliding
- ✅ Page détail album : grid photos + lightbox
- ✅ Support bilingue (FR/EN)

### 5. **Carousel Auto-Sliding**
- ✅ Défilement automatique (3 secondes)
- ✅ Pause au survol
- ✅ Navigation par dots cliquables
- ✅ Support swipe mobile
- ✅ IntersectionObserver (pause hors vue)
- ✅ Page Visibility API (pause onglet inactif)

### 6. **Lightbox**
- ✅ Ouverture au clic sur photo
- ✅ Navigation prev/next
- ✅ Clavier (flèches, Escape)
- ✅ Compteur de photos
- ✅ Légendes
- ✅ Zoom au clic sur l'image

### 7. **Performance & UX**
- ✅ Lazy loading des images
- ✅ Transitions fluides
- ✅ Animations progressives
- ✅ Responsive design (mobile, tablette, desktop)
- ✅ Accessibilité (ARIA, keyboard)
- ✅ Dark mode support
- ✅ Reduced motion support

## 📁 Fichiers Créés/Modifiés

### Migrations
```
database/migrations/2026_09_17_160000_create_photo_albums_table.php
database/migrations/2026_09_17_160100_add_album_id_to_media_assets_table.php
```

### Modèles
```
app/Models/PhotoAlbum.php (nouveau)
app/Models/MediaAsset.php (modifié - relation album)
```

### Contrôleurs
```
app/Http/Controllers/Admin/AdminPhotoAlbumController.php (nouveau)
app/Http/Controllers/Admin/AdminMediaController.php (modifié - album_id)
```

### Routes
```
routes/web.php (ajout routes albums admin + public)
```

### Vues Admin
```
resources/views/admin/albums/index.blade.php
resources/views/admin/albums/form.blade.php
resources/views/admin/albums/show.blade.php
resources/views/admin/media/form.blade.php (modifié)
resources/views/admin/media/index.blade.php (modifié)
```

### Vues Public
```
resources/views/gallery/album.blade.php (nouveau)
resources/views/resources/gallery.blade.php (modifié)
resources/views/resources.blade.php (modifié - CSS/JS)
```

### Assets
```
public/css/album-carousel.css
public/js/album-carousel.js
```

## 🚀 Déploiement

### 1. Migrer la base de données

```bash
php artisan migrate
```

### 2. Vérifier les permissions

```bash
# Le dossier albums doit être accessible en écriture
chmod 755 storage/app/public/albums
```

### 3. Tester en local

```bash
php artisan serve
```

Puis accéder à :
- Admin albums : `http://localhost:8000/admin/albums`
- Médiathèque publique : `http://localhost:8000/mediatheque`

## 📝 Guide d'Utilisation Admin

### Créer un album

1. Aller dans **Admin → Albums Photo**
2. Cliquer sur **"+ Créer un album"**
3. Remplir :
   - Titre (ex: "Visite du Ministre - Février 2026")
   - Description (optionnelle)
   - Image de couverture (optionnelle, sinon 1ère photo de l'album)
   - Ordre d'affichage (0 par défaut)
4. Cocher **"Publier sur le site"** si prêt
5. Cliquer **"+ Créer l'album"**

### Ajouter des photos à un album

**Option A : Depuis Médiathèque**
1. Aller dans **Admin → Médiathèque**
2. Cliquer **"+ Ajouter un média"**
3. Uploader la photo
4. Dans **"Album (optionnel)"**, sélectionner l'album
5. Définir l'ordre d'affichage (0, 1, 2...)
6. Enregistrer

**Option B : Modifier un média existant**
1. Dans la liste des médias, cliquer **"Modifier"**
2. Sélectionner l'album dans le menu déroulant
3. Enregistrer

### Réorganiser les photos

- Modifier l'**ordre d'affichage** de chaque photo (0, 1, 2, 3...)
- Les photos sont affichées du plus petit au plus grand numéro

### Voir les photos d'un album

1. Dans la liste des albums, cliquer **"👁️ Voir"**
2. Voir toutes les photos en grid
3. Cliquer **"Modifier"** pour éditer une photo

## 🎨 Personnalisation

### Modifier l'intervalle du carousel

```javascript
// Dans public/js/album-carousel.js, ligne 10
const SLIDE_INTERVAL = 3000; // 3 secondes (modifiable)
```

### Modifier le nombre d'images preview

```php
// Dans app/Models/PhotoAlbum.php, méthode getPreviewImagesAttribute()
->limit(4) // Modifier ce nombre (actuellement 4 images max)
```

### Modifier la grid des albums

```css
/* Dans public/css/album-carousel.css, ligne 8 */
grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
/* Changer 320px pour ajuster la largeur minimum */
```

## 🐛 Troubleshooting

### Les images ne s'affichent pas dans le carousel

**Problème** : Le carousel affiche le placeholder 📷

**Solutions** :
1. Vérifier que les photos ont `is_published = true`
2. Vérifier que les photos sont assignées à l'album
3. Vérifier les chemins dans `storage/app/public/media`
4. Vérifier `php artisan storage:link` a été exécuté

### Le carousel ne défile pas

**Problème** : Les images sont figées

**Solutions** :
1. Vérifier que le JS `album-carousel.js` est chargé (F12 → Console)
2. Vérifier qu'il y a plus d'une image dans l'album
3. Vérifier la console pour erreurs JavaScript

### Les albums n'apparaissent pas sur la page publique

**Problème** : La grid est vide

**Solutions** :
1. Vérifier que les albums ont `is_published = true`
2. Vérifier que `$albums` est passé à la vue dans `routes/web.php`
3. Vérifier les migrations sont exécutées

### Erreur 500 lors de la création d'album

**Problème** : Erreur serveur

**Solutions** :
1. Vérifier les logs : `storage/logs/laravel.log`
2. Vérifier permissions : `chmod -R 775 storage bootstrap/cache`
3. Vérifier que le dossier `storage/app/public/albums` existe

## 📊 Statistiques & Analytics

### Compter les albums

```php
$totalAlbums = PhotoAlbum::count();
$publishedAlbums = PhotoAlbum::published()->count();
```

### Album le plus populaire (par nombre de photos)

```php
$mostPopular = PhotoAlbum::withCount('publishedMedia')
    ->orderBy('published_media_count', 'desc')
    ->first();
```

### Photos non assignées à un album

```php
$orphanPhotos = MediaAsset::whereNull('album_id')
    ->where('placement', 'gallery')
    ->count();
```

## 🔐 Sécurité

- ✅ Validation CSRF sur tous les formulaires
- ✅ Validation des uploads (types MIME, taille max)
- ✅ Protection contre injection SQL (Eloquent)
- ✅ Sanitization des inputs
- ✅ Relations avec `onDelete('set null')` (pas de cascade delete des photos)

## 🌍 Multilingue

Le système supporte FR et EN :

**Routes FR** :
- `/mediatheque` → Liste albums
- `/mediatheque/album/{id}` → Détail album

**Routes EN** :
- `/en/media` → Liste albums
- `/en/media/album/{id}` → Détail album

## 📱 Responsive Breakpoints

- **Desktop** : > 768px (grid 3-4 colonnes)
- **Tablette** : 481px - 768px (grid 2 colonnes)
- **Mobile** : < 480px (grid 1 colonne)

## ⚡ Performance

- **Lazy loading** : Images chargées 200px avant visibilité
- **WebP support** : Format moderne avec fallback
- **Pagination** : 20 albums par page admin
- **Cache** : Browser cache 1 an pour images
- **Compression** : GZIP activé (web.config)

## 🎯 Prochaines Améliorations (Optionnelles)

1. **Drag & drop** pour réorganiser photos dans album
2. **Upload multiple** : ajouter plusieurs photos en une fois
3. **Filtres** : par date, catégorie, tags
4. **Recherche** : dans titres et descriptions d'albums
5. **Partage social** : boutons Facebook, Twitter
6. **Statistiques** : vues par album, photos les plus populaires
7. **Galerie masonry** : layout Pinterest-style
8. **Fullscreen mode** : slideshow automatique
9. **Download album** : ZIP de toutes les photos
10. **Commentaires** : système de commentaires sur albums

---

**Système créé le** : 18 septembre 2026  
**Status** : ✅ Complet et prêt pour production  
**Version** : 1.0
