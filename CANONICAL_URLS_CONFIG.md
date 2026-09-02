# Canonical URLs & Hreflang Configuration - NERE MINING

**Purpose:** Éviter le duplicate content sur un site bilingue (FR/EN)

---

## 📋 Implémentation

### 1. **Canonical Tags**
- Chaque page a un `<link rel="canonical">` pointant vers elle-même
- Format: `https://nere-mining.bf/path` pour FR
- Format: `https://nere-mining.bf/en/path` pour EN

### 2. **Hreflang Tags**
- `rel="alternate" hreflang="fr"` → URL française
- `rel="alternate" hreflang="en"` → URL anglaise
- `rel="alternate" hreflang="x-default"` → Version par défaut (FR)

### 3. **Implémentation dans le code**

```blade
<!-- Dans resources/views/layouts/app.blade.php -->
{!! App\Helpers\CanonicalHelper::render($section, $loc) !!}
{!! App\Helpers\CanonicalHelper::renderHreflang($section, $loc) !!}
```

**Output généré:**
```html
<!-- Page FR /qui-sommes-nous -->
<link rel="canonical" href="https://nere-mining.bf/qui-sommes-nous" />
<link rel="alternate" hreflang="fr" href="https://nere-mining.bf/qui-sommes-nous" />
<link rel="alternate" hreflang="en" href="https://nere-mining.bf/en/about" />
<link rel="alternate" hreflang="x-default" href="https://nere-mining.bf/qui-sommes-nous" />

<!-- Page EN /en/about -->
<link rel="canonical" href="https://nere-mining.bf/en/about" />
<link rel="alternate" hreflang="en" href="https://nere-mining.bf/en/about" />
<link rel="alternate" hreflang="fr" href="https://nere-mining.bf/qui-sommes-nous" />
<link rel="alternate" hreflang="x-default" href="https://nere-mining.bf/qui-sommes-nous" />
```

---

## 🗺️ Mapping des routes

### Routes Françaises (canonique = FR)
| Section | Chemin | Canonical |
|---------|--------|-----------|
| home | `/` | `https://nere-mining.bf/` |
| company | `/qui-sommes-nous` | `https://nere-mining.bf/qui-sommes-nous` |
| company-ceo | `/qui-sommes-nous/mot-du-pdg` | `https://nere-mining.bf/qui-sommes-nous/mot-du-pdg` |
| karma | `/karma` | `https://nere-mining.bf/karma` |
| sustainability | `/developpement-durable` | `https://nere-mining.bf/developpement-durable` |
| news | `/actualites` | `https://nere-mining.bf/actualites` |
| careers | `/carrieres` | `https://nere-mining.bf/carrieres` |
| contact | `/contact` | `https://nere-mining.bf/contact` |

### Routes Anglaises (canonique = EN)
| Section | Chemin | Canonical |
|---------|--------|-----------|
| home | `/en` | `https://nere-mining.bf/en` |
| company | `/en/about` | `https://nere-mining.bf/en/about` |
| company-ceo | `/en/about/ceo-message` | `https://nere-mining.bf/en/about/ceo-message` |
| karma | `/en/karma` | `https://nere-mining.bf/en/karma` |
| sustainability | `/en/sustainability` | `https://nere-mining.bf/en/sustainability` |
| news | `/en/news` | `https://nere-mining.bf/en/news` |
| careers | `/en/careers` | `https://nere-mining.bf/en/careers` |
| contact | `/en/contact` | `https://nere-mining.bf/en/contact` |

---

## ✅ Avantages

1. **SEO Optimization**
   - ✅ Évite penalties pour duplicate content
   - ✅ Consolide signals de ranking pour une seule version
   - ✅ Google comprend les variantes linguistiques

2. **User Experience**
   - ✅ Utilisateurs français → version FR
   - ✅ Utilisateurs anglais → version EN
   - ✅ Moteurs de recherche → version appropriée

3. **Analytics**
   - ✅ Trafic FR séparé de EN
   - ✅ Métriques précises par langue
   - ✅ Pas de double-comptage

---

## 🔍 Vérification

### Test avec curl
```bash
# Page FR
curl -s https://nere-mining.bf/qui-sommes-nous | grep -A2 "rel=\"canonical\""
# Attendu: <link rel="canonical" href="https://nere-mining.bf/qui-sommes-nous" />

# Page EN
curl -s https://nere-mining.bf/en/about | grep -A2 "rel=\"canonical\""
# Attendu: <link rel="canonical" href="https://nere-mining.bf/en/about" />
```

### Google Search Console
1. Aller à Google Search Console
2. Sélectionner property `nere-mining.bf`
3. International targeting → Language
4. Vérifier que FR et EN sont correctement assignées
5. Monitoring → Hreflang issues → Vérifier aucune erreur

### Google Lighthouse
```bash
# Test avec Lighthouse
lighthouse https://nere-mining.bf/qui-sommes-nous --view
# Vérifier: "Document has a valid rel=canonical" ✓
```

---

## ⚙️ Configuration SEO Avancée

### robots.txt
```
Sitemap: https://nere-mining.bf/sitemap.xml
```

### Hreflang dans sitemap.xml (optionnel, mais recommandé)
```xml
<url>
  <loc>https://nere-mining.bf/qui-sommes-nous</loc>
  <xhtml:link rel="alternate" hreflang="fr" href="https://nere-mining.bf/qui-sommes-nous"/>
  <xhtml:link rel="alternate" hreflang="en" href="https://nere-mining.bf/en/about"/>
  <xhtml:link rel="alternate" hreflang="x-default" href="https://nere-mining.bf/qui-sommes-nous"/>
</url>
```

**Note:** Actuellement, le sitemap est généré par `SitemapController` sans hreflang. C'est optionnel mais recommandé pour très gros sites.

---

## 🚀 Production Checklist

- [x] Canonical tags implémentés dans layout
- [x] Hreflang tags implémentés
- [x] Toutes les pages couvrent tous les sections
- [ ] Vérifier Google Search Console après déploiement
- [ ] Monitorer hreflang errors pendant 2 semaines
- [ ] Vérifier trafic séparé FR/EN dans Google Analytics

---

## 📚 Ressources

- [Google: Localized versions](https://developers.google.com/search/docs/crawling-indexing/localized-versions)
- [Google: Canonical tag guide](https://developers.google.com/search/docs/crawling-indexing/consolidate-duplicate-urls)
- [Moz: Hreflang guide](https://moz.com/blog/hreflang-for-multilingual-sites)

---

Generated: 2026-09-02 | CanonicalHelper Implementation
