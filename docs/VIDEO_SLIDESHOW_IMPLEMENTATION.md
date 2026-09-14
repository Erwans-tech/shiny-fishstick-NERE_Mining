# 🎬 Guide d'Implémentation: Vidéos dans le Diaporama

## Vue d'Ensemble

Le système de diaporama hero de Néré Mining supporte déjà les vidéos ! Le modèle `HeroSlide` inclut :
- Support YouTube/Vimeo
- Autoplay + muted (autoplay sans son)
- Fallback image de secours
- Intégration responsif

---

## Architecture Technique Existante

### Modèle: `HeroSlide`

```php
// app/Models/HeroSlide.php
protected $fillable = [
    'type',          // 'image' ou 'video'
    'title',         // Titre du slide
    'caption',       // Sous-titre
    'image_path',    // Chemin image (fallback pour vidéo)
    'video_url',     // URL YouTube/Vimeo
    'is_active',     // Visible ou non
    'sort_order',    // Ordre d'affichage (1, 2, 3...)
];
```

### Méthodes Clés

```php
// Déterminer le type
$slide->isImage()  // true si image
$slide->isVideo()  // true si vidéo

// Récupérer l'URL d'embed (YouTube/Vimeo)
$slide->embed_url  // ex: https://www.youtube.com/embed/dQw4w9WgXcQ

// Récupérer URL publique (image ou fallback)
$slide->url        // asset URL ou fallback par défaut
```

### Vue: `home.blade.php` (Ligne ~90)

```blade
@foreach($heroImages as $index => $heroImage)
    @if(is_array($heroImage) && ($heroImage['type'] ?? 'image') === 'video')
        {{-- Slide vidéo (YouTube / Vimeo) --}}
        <div class="hero-slide-video" style="background-image:url('{{ $heroImage['url'] ?? '' }}');">
            @if($heroImage['embed_url'])
            <iframe
                src="{{ $heroImage['embed_url'] }}"
                allow="autoplay; encrypted-media"
                title="{{ $heroImage['title'] ?? 'Hero video' }}"
                loading="lazy">
            </iframe>
            @endif
        </div>
    @else
        {{-- Slide image classique --}}
        <div class="hero-slide" style="background-image:url('...')"></div>
    @endif
@endforeach
```

---

## 🎯 Comment Ajouter des Vidéos

### Étape 1: Créer une Migration

```bash
php artisan make:migration add_mining_videos_to_hero_slides
```

**Contenu de la migration:**

```php
// database/migrations/2026_08_31_XXXXXX_add_mining_videos_to_hero_slides.php

Schema::create('hero_slide_videos', function (Blueprint $table) {
    // Cette migration ajoute des enregistrements, pas une table
});

// Dans la méthode up():
DB::table('hero_slides')->insert([
    // Vidéo 1: Open Pit Mining (4K)
    [
        'type' => 'video',
        'title' => 'Open Pit Mining Operations',
        'caption' => 'Vue aérienne du site d\'extraction aurifère à ciel ouvert',
        'video_url' => 'https://www.youtube.com/watch?v=XXXX',
        'image_path' => 'images/mining/video-cover-1.jpg',
        'is_active' => true,
        'sort_order' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    // Vidéo 2: Equipment & Machinery
    [
        'type' => 'video',
        'title' => 'Mining Equipment in Action',
        'caption' => 'Machinerie moderne d\'extraction - Caterpillar & Komatsu',
        'video_url' => 'https://www.youtube.com/watch?v=YYYY',
        'image_path' => 'images/mining/video-cover-2.jpg',
        'is_active' => true,
        'sort_order' => 2,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    // Vidéo 3: Gold Processing
    [
        'type' => 'video',
        'title' => 'Gold Processing Technology',
        'caption' => 'Processus de traitement CIL - De la roche à l\'or',
        'video_url' => 'https://www.youtube.com/watch?v=ZZZZ',
        'image_path' => 'images/mining/video-cover-3.jpg',
        'is_active' => true,
        'sort_order' => 3,
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
```

### Étape 2: Images de Fallback

Télécharger les images minières depuis:
- Pixabay: https://pixabay.com/images/search/mining%20site/
- Unsplash: https://unsplash.com/s/photos/mining

Placer dans `/public/images/mining/`:
- `video-cover-1.jpg` (Open pit)
- `video-cover-2.jpg` (Equipment)
- `video-cover-3.jpg` (Processing)

### Étape 3: Trouver les URLs YouTube

**Méthode 1: YouTube Search**
```
https://www.youtube.com/results?search_query=open+pit+mining+4k
```

**Méthode 2: Directement depuis le lien**
```
Si vidéo: https://www.youtube.com/watch?v=dQw4w9WgXcQ
ID = dQw4w9WgXcQ
Format embed = https://www.youtube.com/embed/dQw4w9WgXcQ
```

**Vidéos Recommandées à Chercher:**
- "Open Pit Gold Mining 4K" - Endeavour Mining ou Barrick Gold
- "Gold Mining Process" - MineMind ou Mining Education
- "Modern Mining Equipment" - Caterpillar official channel

### Étape 4: Exécuter la Migration

```bash
php artisan migrate
```

---

## 🎨 Styling des Vidéos

Les vidéos utilisent les classes:
- `.hero-slide-video` (conteneur)
- `iframe` (lecteur)

**CSS Existant:**
```css
.hero-slide-video {
    position:absolute;
    inset:0;
    opacity:0;
    pointer-events:none;
}

.hero-slide-video iframe {
    position:absolute;
    top:50%;
    left:50%;
    width:177.78vh;
    height:100vh;
    transform:translate(-50%,-50%);
    border:0;
}
```

Ce CSS:
- Centre la vidéo
- Maintient ratio 16:9
- Couvre le fond entièrement
- Respecte le responsive

---

## 🔧 Paramètres URL YouTube

L'embed supporte plusieurs paramètres:

```
https://www.youtube.com/embed/VIDEO_ID?
  autoplay=1          // Lecture auto
  mute=1              // Sans son (nécessaire pour autoplay)
  loop=1              // Boucle infinie
  playlist=VIDEO_ID   // Essentiellement requis pour loop
  controls=0          // Pas de barre de contrôle
  showinfo=0          // Pas d'info vidéo
  rel=0               // Pas de vidéos suggérées
```

**Exemple Complet:**
```
https://www.youtube.com/embed/dQw4w9WgXcQ?
  autoplay=1&mute=1&loop=1&
  playlist=dQw4w9WgXcQ&
  controls=0&showinfo=0&rel=0
```

---

## ✅ Checklist Implémentation

- [ ] **Étape 1: Images de Fallback**
  - [ ] Télécharger 3-5 images minières
  - [ ] Placer dans `/public/images/mining/video-cover-*.jpg`
  - [ ] Vérifier dimension (16:9 recommandé, min 1280x720)

- [ ] **Étape 2: Migration**
  - [ ] Créer la migration
  - [ ] Ajouter enregistrements avec URLs
  - [ ] Exécuter `php artisan migrate`

- [ ] **Étape 3: Tester**
  - [ ] Accédez à `http://localhost:8000/`
  - [ ] Vérifier que les vidéos s'affichent
  - [ ] Tester l'autoplay (doit être muet)
  - [ ] Tester sur mobile

- [ ] **Étape 4: Ajustements**
  - [ ] Ajuster l'ordre avec `sort_order`
  - [ ] Modifier captions si nécessaire
  - [ ] Tester les fallbacks (désactiver JS pour vérifier)

---

## 🎬 Via Interface Admin (Future)

Pour les administrateurs:

```
/gestion-nm/hero-slides
- ✓ Créer nouveau slide
- ✓ Type: Image ou Vidéo
- ✓ Si Vidéo: Coller URL YouTube
- ✓ Ajouter image de secours
- ✓ Sauvegarder & tester
```

(À implémenter avec Livewire/Vue)

---

## 🚨 Troubleshooting

### Vidéo ne s'affiche pas
```
1. Vérifier l'URL YouTube (copier depuis barre adresse)
2. Vérifier video_url en base de données
3. Vérifier is_active = true
4. Vérifier sort_order > 0
```

### Autoplay ne marche pas
```
1. Vérifier mute=1 dans URL (obligatoire)
2. Tester dans navigateur incognito (cache)
3. Vérifier allow="autoplay" sur iframe
```

### Image de fallback ne s'affiche pas
```
1. Vérifier chemin image: /public/images/mining/...
2. Vérifier permissions fichier
3. Vérifier img_path en base de données
```

### Responsive cassé
```
1. CSS .hero-slide-video doit être présent
2. Vérifier width:177.78vh (ratio 16:9)
3. Tester sur devtools mobile
```

---

## 📊 Stats Configuration

**Slideshow Actuel:**
- Image par défaut: karma-01 à karma-05.jpg
- Durée totale: 25 secondes (5 slides × 5s)
- Transitions: Fade smooth

**Avec 3 vidéos:**
- Durée totale: 35 secondes (8 slides × 5s)
- Vidéos: 30-60s chacune (boucle)
- Expérience: Dynamique & moderne

---

## 🔗 Ressources

- [YouTube Embed Player](https://developers.google.com/youtube/iframe_api_reference)
- [Vimeo Embed](https://developer.vimeo.com/player/sdk)
- [MDN: Responsive iframe](https://developer.mozilla.org/en-US/docs/Web/Media/Audio_and_video_delivery)

---

**Documentation:** 25 Août 2026  
**Version:** 1.0  
**Status:** ✅ Prêt à implémenter

