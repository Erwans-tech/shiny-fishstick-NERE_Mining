# 🔧 Fix Admin Form - HeroSlide Validation Errors

**Problem:** Admin form was sending validation errors when adding YouTube videos or images.

## ✕ Erreurs Avant

```
Quand j'ajoute une vidéo YouTube:
✕ validation.in
✕ validation.prohibited
✕ validation.required

Quand j'ajoute une vidéo file:
✕ validation.in
✕ validation.url
✕ validation.mimes

Quand j'ajoute une image:
✕ validation.url
```

---

## 🎯 Root Cause

**Le formulaire envoyait TOUS les champs même s'ils n'étaient pas pertinents pour le type sélectionné.**

### Avant (Problème)
```
Sélection: type = 'video'
Envoyé au serveur:
├─ type: "video"          ✓ OK
├─ video_url: ""          ✓ OK (required)
├─ image: <empty file>    ✗ ERREUR! (prohibited mais envoyé)
├─ cover_image: <empty>   ✓ OK (nullable)
```

Laravel validation disait:
- "Le champ `image` est interdit" = `validation.prohibited`
- "Le champ `type` n'est pas valide" = `validation.in` (erreur cascade)

### Après (Solution)
```
Sélection: type = 'video'
Envoyé au serveur:
├─ type: "video"          ✓ OK
├─ video_url: "https://..." ✓ OK (required + regex)
├─ cover_image: <optional> ✓ OK (nullable)
```

---

## ✅ Solutions Appliquées

### 1️⃣ **Nettoyage des champs avant soumission (Frontend)**

**Fichier:** `resources/views/admin/hero/form.blade.php`

**Ajout:** Script JavaScript qui nettoie les champs conditionnels avant submit

```javascript
document.getElementById('hero-form').addEventListener('submit', function(e) {
    var selectedType = document.querySelector('input[name="type"]:checked').value;
    var conditionalFields = document.querySelectorAll('[data-conditional-field]');
    
    conditionalFields.forEach(function(field) {
        var fieldName = field.getAttribute('data-conditional-field');
        var isRelevant = false;
        
        // Déterminer si ce champ doit être envoyé
        if (selectedType === 'image' && fieldName === 'image') {
            isRelevant = true;
        } else if (selectedType === 'video' && (fieldName === 'video_url' || fieldName === 'cover_image')) {
            isRelevant = true;
        }
        
        // Si non pertinent, supprimer l'attribut name pour ne pas l'envoyer
        if (!isRelevant) {
            field.removeAttribute('name');
        } else {
            field.setAttribute('name', fieldName);
        }
    });
});
```

**Marquage des champs conditionnels:**
- `<input ... data-conditional-field="image">`
- `<input ... data-conditional-field="video_url">`
- `<input ... data-conditional-field="cover_image">`

### 2️⃣ **Changement des règles de validation (Backend)**

**Fichier:** `app/Http/Controllers/Admin/AdminHeroSlideController.php`

**Avant:**
```php
'image' => $type === 'image' ? ['required', ...] : ['prohibited'],
'video_url' => $type === 'video' ? ['required', ...] : ['nullable', ...],
'cover_image' => $type === 'video' ? ['nullable', ...] : ['prohibited'],
```

**Après:**
```php
'image' => $type === 'image' ? ['required', ...] : [],
'video_url' => $type === 'video' ? ['required', 'string', 'max:500', 'regex:/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i'] : [],
'cover_image' => $type === 'video' ? ['nullable', ...] : [],
```

**Changements:**
- Remplacer `['prohibited']` par `[]` (champ optionnel)
- Ajouter regex validation pour `video_url` (accepte YouTube et Vimeo)
- Supprimer `['nullable', 'string']` inutile pour les champs non envoyés

**Regex YouTube/Vimeo:**
```regex
^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i
```
✓ Accepte: 
- `https://www.youtube.com/watch?v=...`
- `https://youtu.be/...`
- `https://vimeo.com/...`

### 3️⃣ **Améliorations UI**

- Ajout d'attributs `data-conditional-field` sur les inputs
- JavaScript affiche/masque les sections basé sur le type
- Les champs non affichés ne sont pas envoyés

---

## 📋 Fichiers Modifiés

### ✏️ `resources/views/admin/hero/form.blade.php`
```diff
- <input type="file" id="image-input" name="image">
+ <input type="file" id="image-input" name="image" data-conditional-field="image">

- <input id="video_url" type="text" name="video_url">
+ <input id="video_url" type="text" name="video_url" data-conditional-field="video_url">

- <input type="file" id="cover-input" name="cover_image">
+ <input type="file" id="cover-input" name="cover_image" data-conditional-field="cover_image">

+ [Ajout du script de nettoyage avant submit]
```

### ✏️ `app/Http/Controllers/Admin/AdminHeroSlideController.php`
```diff
- 'image' => $type === 'image' ? ['required', ...] : ['prohibited'],
+ 'image' => $type === 'image' ? ['required', ...] : [],

- 'video_url' => $type === 'video' ? ['required', 'string', 'max:500'] : ['nullable', ...],
+ 'video_url' => $type === 'video' ? ['required', 'string', 'max:500', 'regex:/...youtube|vimeo.../i'] : [],

- 'cover_image' => [...] : ['prohibited'],
+ 'cover_image' => [...] : [],
```

---

## 🧪 Test Scénarios

### ✅ Scénario 1: Ajouter une IMAGE

1. Cliquer sur "Image" (tab)
2. Sélectionner un fichier JPG/PNG
3. Cliquer "Ajouter au carrousel"
4. ✅ Succès (champs `video_url` et `cover_image` non envoyés)

### ✅ Scénario 2: Ajouter une VIDÉO YOUTUBE

1. Cliquer sur "Vidéo" (tab)
2. Coller URL: `https://www.youtube.com/watch?v=wZWkNKdNlR8`
3. Vérifier l'aperçu s'affiche
4. Optionnel: Ajouter image de couverture
5. Cliquer "Ajouter au carrousel"
6. ✅ Succès (champ `image` non envoyé)

### ✅ Scénario 3: Ajouter une VIDÉO VIMEO

1. Cliquer sur "Vidéo" (tab)
2. Coller URL: `https://vimeo.com/12345`
3. Cliquer "Ajouter au carrousel"
4. ✅ Succès (regex accepte Vimeo)

### ✅ Scénario 4: URL YouTube invalide

1. Cliquer sur "Vidéo" (tab)
2. Entrer: `https://example.com/video`
3. Cliquer "Ajouter au carrousel"
4. ✅ Erreur de validation (regex rejette)

---

## 📊 Avant/Après

| Aspect | Avant | Après |
|--------|-------|-------|
| **Ajout image** | ✕ Erreur | ✅ OK |
| **Ajout vidéo YouTube** | ✕ Erreur | ✅ OK |
| **Ajout vidéo Vimeo** | ✕ Erreur | ✅ OK |
| **Validation URL** | Stricte (none) | Regex YouTube/Vimeo |
| **Champs envoyés** | Tous (même vides) | Seulement pertinents |
| **UX** | Confus | Clair |

---

## 🚀 Impact

✅ **Utilisateur peut maintenant:**
- ✅ Ajouter des images au diaporama
- ✅ Ajouter des vidéos YouTube
- ✅ Ajouter des vidéos Vimeo
- ✅ Voir validation errors pertinentes

✅ **Admin peut:**
- ✅ Gérer le diaporama sans errors
- ✅ Ajouter les 5 vidéos minières manquelles

---

## 🔗 Commits

```
git commit -m "fix: admin hero slides form validation - conditional fields cleanup"
```

---

## 📝 Notes

- **Browser Support:** Modern browsers (Chrome, Firefox, Safari, Edge)
- **Fallback:** Si JS désactivé, tous les champs sont envoyés (nécessite backend fixes)
- **Test:** Vérifier sur localhost:8000/gestion-nm/hero-slides (ou route admin)
- **Documentation:** Consulter `/app/Http/Controllers/Admin/AdminHeroSlideController.php`

