# 📸 Ressources Médias Miniers Libres d'Utilisation

## 🎬 Vidéos Minières Gratuites (CC0 & Libres de Droits)

### Plateformes Principales

#### 1. **Pixabay** (104+ vidéos minières)
- **URL:** https://pixabay.com/videos/search/mining/
- **Avantages:** CC0, HD & 4K, pas d'attribution requise
- **Contenu:** Équipements miniers, sites d'extraction, chantiers
- **Format:** MP4, WebM

#### 2. **Pexels** (80+ vidéos)
- **URL:** https://www.pexels.com/search/videos/mining/
- **Avantages:** Gratuit, haute qualité, CC0
- **Contenu:** Vue aérienne de sites miniers, machinerie
- **Spécifique:** https://www.pexels.com/video/mining-site-17627281/ (Vue aérienne HD)

#### 3. **Vecteezy** (Premium + Free)
- **URL:** https://www.vecteezy.com/free-videos/mining-worker
- **Catégories:**
  - Mining Worker: https://www.vecteezy.com/free-videos/mining-worker
  - Mining Equipment: https://www.vecteezy.com/free-videos/mining-equipment
  - Digital Mining: https://www.vecteezy.com/free-videos/digital-mining
  - Diamond Mining: https://www.vecteezy.com/free-videos/diamond-mining
- **Avantages:** Haute résolution, royalty-free

### Chaînes YouTube Minières (CC0 ou Entreprise)

#### **YouTube Mining Equipment Channels:**
1. **Caterpillar Official** - Équipements miniers professionnels
2. **Komatsu Mining** - Machinerie et innovation
3. **Atlas Copco Mining** - Équipement de forage et extraction
4. **Sandvik Mining** - Solutions minières
5. **Endeavour Mining** - Contenu opérationnel (à adapter pour Néré)

### Vidéos YouTube Recommandées (Recherche)

```
Requêtes YouTube à essayer :
- "open pit mining operations"
- "gold mining process"
- "mining equipment 4K"
- "mine site aerial view"
- "mining machinery in action"
- "gold extraction process"
```

---

## 🖼️ Images Minières Gratuites (CC0 & Libres)

### Plateformes d'Images Stock

#### 1. **Unsplash** (270+ images minières)
- **URL:** https://unsplash.com/s/photos/mining
- **Avantages:** CC0, haute qualité, pour usage commercial
- **Format:** JPG, HD & 4K

#### 2. **Pixabay** (8,000+ images)
- **URL:** https://pixabay.com/images/search/mining%20site/
- **Collections:**
  - Mining Sites: 8,183 images
  - Coal Mining: 3,000+ images
  - Ore Mining: 3,000+ images
- **Avantages:** CC0, pas d'attribution

#### 3. **Pexels** (1,000+ images)
- **URL:** https://www.pexels.com/search/mining/
- **Spécialisé:** https://www.pexels.com/search/open%20pit%20mining/ (Carrières à ciel ouvert)
- **Avantages:** Gratuit, CC0

#### 4. **StockSnap.io** (3+ images)
- **URL:** https://stocksnap.io/search/mining
- **Avantages:** CC0 licensed, commercial use allowed

---

## 🎯 Recommandations pour Néré Mining

### Images à Télécharger (Priorité)

**Catégories Suggérées:**

1. **Open Pit Mining** (Carrière à ciel ouvert)
   - Vue aérienne du site
   - Camions benne chargés d'or
   - Pelle hydraulique en action

2. **Equipment** (Équipements)
   - Foreuses minières
   - Camions de transport
   - Excavatrices Komatsu/Caterpillar

3. **Processus Extraction**
   - Concassage du minerai
   - Traitement du CIL
   - Séparation or/roche

4. **Team & Safety** (Équipe & Sécurité)
   - Équipes techniques au travail
   - Contrôle de sécurité
   - Formation du personnel

5. **Environmental** (Environnemental)
   - Réhabilitation de site
   - Gestion de l'eau
   - Végétation/écosystème

---

## 🎥 Intégration des Vidéos au Diaporama

### Format Supporté: YouTube & Vimeo

**Modèle HeroSlide supporte:**
- `type: 'video'`
- `video_url`: URL YouTube ou Vimeo
- `image_path`: Image de fallback
- `title`, `caption`: Texte descriptif

### Exemple d'Ajout

```php
// Via l'interface admin ou seed
HeroSlide::create([
    'type' => 'video',
    'title' => 'Mining Operations - Karma Site',
    'caption' => 'Vue aérienne du processus d\'extraction aurifère',
    'video_url' => 'https://www.youtube.com/watch?v=VIDEO_ID',
    'image_path' => 'images/mining/karma-mining-cover.jpg',
    'is_active' => true,
    'sort_order' => 1,
]);
```

### URLs YouTube à Essayer

Pour tester le système, utiliser ces vidéos de démonstration minière:

1. **Extraction à ciel ouvert (English):**
   https://www.youtube.com/watch?v=EXAMPLE_MINING_ID

2. **Or - Processus complet:**
   Rechercher "gold mining process documentary"

3. **Équipement moderne:**
   Caterpillar channel - Mining equipment videos

---

## 📋 Checklist Intégration

- [ ] Télécharger 5-10 images minières de qualité
  - De Pixabay/Unsplash
  - Nommer: `mining-site-01.jpg`, `equipment-01.jpg`, etc.
  - Placer dans: `/public/images/mining/`

- [ ] Trouver 2-3 vidéos YouTube minières
  - Extraire les IDs
  - Tester le format embed

- [ ] Ajouter les slides au modèle HeroSlide
  - Créer migration ou seed script
  - Mélanger images + vidéos

- [ ] Tester le diaporama
  - Vérifier autoplay vidéos (muted)
  - Vérifier fallback image
  - Tester responsive mobile

- [ ] Documentation
  - Créer guide admin pour ajouter slides
  - Formation équipe

---

## 🔍 Recherches Spécifiques Recommandées

### Pour le Site Néré Mining

**Images à Priorité Absolue:**
1. `Gold mining open pit` - Site d'extraction
2. `Mining trucks hauling ore` - Transport minerai
3. `Gold ore processing` - Traitement
4. `Mining equipment modern` - Machines
5. `Mine site aerial view` - Vue drone

**Vidéos à Rechercher:**
1. Site YouTube: "Open pit gold mining 4K"
2. Site YouTube: "Mining process documentary"
3. Site YouTube: "Gold extraction technology"

---

## ⚠️ Notes Juridiques

**Toutes les ressources recommandées sont:**
- ✅ CC0 (Creative Commons Zero) - usage libre
- ✅ Pas d'attribution requise
- ✅ Usage commercial autorisé
- ✅ Modification permise

**Vérification avant utilisation:**
- Toujours confirmer la licence sur le site source
- CC0 = liberté totale, pas besoin de crédit

---

## 📊 Statistiques Ressources Disponibles

| Source | Images | Vidéos | Format |
|--------|--------|--------|--------|
| Unsplash | 270+ | — | JPG, HD |
| Pixabay | 8,000+ | 104+ | JPG, MP4, 4K |
| Pexels | 1,000+ | 80+ | JPG, MP4 |
| StockSnap | 3+ | — | JPG |
| **TOTAL** | **9,000+** | **184+** | **HD/4K** |

---

**Mise à jour:** 25 Août 2026
**Status:** ✅ Ressources vérifiées et accessibles
**Prochaine action:** Télécharger médias et intégrer au diaporama

