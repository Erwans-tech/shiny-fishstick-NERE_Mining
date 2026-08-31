# Stratégie d'Enrichissement Intelligent (Structure Existante Préservée)

**Date:** 25 Août 2026  
**Principe:** Améliorer le contenu SANS modifier la structure existante

---

## 🎯 Approche Smart Enrichment

Les pages structurées avec translations permettent enrichissement:
- ✅ Via fichiers de langue (`lang/en/site.php` et `lang/fr/site.php`)
- ✅ Via contenu structuré (cards, grids, sections)
- ✅ Via images & assets (sans changer HTML)
- ✅ Via données en base (models & migrations)

---

## 📋 Pages Existantes à Enrichir (In-Place)

### 1. **Homepage / Welcome** 
**Fichier:** `resources/views/welcome.blade.php`  
**Enrichissement:**
- [ ] Remplacer placeholders par vraies stats
  - Tonnes extraites (cumul)
  - Emplois créés
  - Onces d'or produites
  - Années d'expérience
- [ ] Via: `lang/*/site.php` translations

### 2. **Karma Mine Page** ✅ (50% done)
**Fichier:** `resources/views/pages/karma.blade.php`  
**État:** Structure bonne, contenu correct  
**Enrichissement restant:**
- [ ] Ajouter section "Ressources & Réserves" (avant Organisation)
  - Tableau gisements (Nami, GG1, GG2, Kao, Goulagou)
  - Tonnage, teneur, état exploitation
  - Même design que reserves.blade.php
- [ ] Ajouter "Production Timeline" (après Exploitation)
  - Historique 2007-2026
  - Graphique production annuelle
- [ ] Enrichir "Organisation" avec vraies données

### 3. **Reserves Page** ✅ (DONE)
**Fichier:** `resources/views/pages/reserves.blade.php`  
**État:** Complet avec lightbox, design premium

### 4. **Resources Page** 
**Fichier:** `resources/views/pages/resources.blade.php`  
**Enrichissement:**
- [ ] Garder galerie existante
- [ ] Ajouter section "Resource Details" avec:
  - Tableau mineral resources (JORC classified)
  - Figures clés par gisement
  - Courbes tonnage/teneur

### 5. **Projects Page** ✅ (CIL done)
**Fichier:** `resources/views/pages/projects.blade.php`  
**État:** CIL enrichi, structure maintenue

### 6. **Company Hub & Subpages**
**Fichiers:** 
- `resources/views/pages/company.blade.php` (Hub)
- `resources/views/pages/company/company-ceo.blade.php`
- `resources/views/pages/company/company-identity.blade.php`
- `resources/views/pages/company/company-history.blade.php`
- `resources/views/pages/company/company-values.blade.php`
- `resources/views/pages/company/company-governance.blade.php`

**Enrichissement (Via translations + images):**
- [ ] CEO: Ajouter photo, statement plus détaillé
- [ ] Identity: Mission, Vision, Valeurs (plus détaillé)
- [ ] History: Timeline plus riche (2007-2026)
- [ ] Values: Engagements détaillés
- [ ] Governance: Organigramme, leadership team

### 7. **Sustainability Pages**
**Fichiers:**
- `resources/views/pages/sustainability.blade.php` (Hub)
- `resources/views/pages/sustainability/*.blade.php` (Subpages)

**Enrichissement:**
- [ ] Ajouter métriques ESG réelles
- [ ] Initiatives communautaires avec KPIs
- [ ] Impact environnemental chiffré
- [ ] Rapports téléchargeables

### 8. **HSE (Health, Safety, Environment)**
**Fichier:** `resources/views/pages/hse.blade.php`  
**Enrichissement:**
- [ ] Stats sécurité (LTI, TRIFR, etc.)
- [ ] Certifications (ISO, etc.)
- [ ] Initiatives environnementales

### 9. **Environment Page**
**Fichier:** `resources/views/pages/environment.blade.php`  
**Enrichissement:**
- [ ] Données monitoring environnemental
- [ ] Biodiversité monitoring
- [ ] Programs de mitigation

### 10. **Communities Page**
**Fichier:** `resources/views/pages/communities.blade.php`  
**Enrichissement:**
- [ ] Initiatives détaillées (éducation, santé, infrastructure)
- [ ] Impact metrics par programme
- [ ] Success stories & photos

### 11. **Local Content Page**
**Fichier:** `resources/views/pages/local-content.blade.php`  
**Enrichissement:**
- [ ] Sourcing local détaillé
- [ ] Supplier statistics
- [ ] Economic impact

### 12. **Careers Page**
**Fichier:** `resources/views/pages/careers.blade.php`  
**Enrichissement:**
- [ ] Job listings dynamiques
- [ ] Employee spotlights
- [ ] Training programs
- [ ] Culture description

### 13. **Reports Page**
**Fichier:** `resources/views/pages/reports.blade.php`  
**Enrichissement:**
- [ ] Rapports PDF organisés
- [ ] Sustainability reports
- [ ] Technical documents
- [ ] Investor presentations

### 14. **Press Contact Page**
**Fichier:** `resources/views/pages/press-contact.blade.php`  
**Enrichissement:**
- [ ] Press kit complet
- [ ] Recent press releases
- [ ] Media gallery
- [ ] Contact forms

---

## 🛠️ Mécanismes d'Enrichissement (Sans Changer Structure)

### A. Translations (lang/*/site.php)
```php
// Avant
'karma_prod_h2' => 'Chiffres de production'

// Après
'karma_prod_h2' => 'Chiffres de Production & Réserves',
'karma_reserves_section' => 'Section complète avec tableau',
'karma_gisement_nami' => 'Nami - Minerai Oxydé',
// ... etc
```

### B. Migration de Données + Model
```php
// Créer model ResourceDeposit avec data
// Afficher via page template existant
// Aucun changement HTML
@forelse($deposits ?? collect() as $deposit)
  <div class="card">...</div>
@endforelse
```

### C. Images & Assets
```
public/images/
  └── mining/
      ├── karma-*.jpg (existant)
      ├── reserves-*.jpg (existant)
      ├── cil-*.jpg (existant)
      └── [NEW] production-chart.jpg
          [NEW] team-photos/
          [NEW] sustainability-initiatives/
```

### D. Sections Additionnelles (Meme Grid/Design)
Ajouter entre sections existantes (preserving structure):
```html
<section id="new-section" class="sand">
  <h2>New Title</h2>
  <div class="grid-3">
    <!-- Nouveau contenu, design existant -->
  </div>
</section>
```

---

## 📊 Priorité Enrichissement (In-Place)

### 🔴 HIGH (Immédiat Impact - 1 semaine)
1. ✅ Reserves page (DONE)
2. ✅ CIL project (DONE)
3. **Karma mine** - Ajouter section ressources + timeline
4. **Homepage** - Stats réelles + metriques

### 🟡 MEDIUM (2-3 semaines)
1. **Company pages** - Ajouter photos, bios, org chart
2. **Sustainability** - ESG metrics, initiatives
3. **Careers** - Job listings, spotlights
4. **Communities** - Initiatives détaillées
5. **HSE** - Safety stats, certifications

### 🟢 LOW (Polish - 3-4 semaines)
1. **Reports** - PDF downloads
2. **Press** - News items, releases
3. **Exploration** - Drilling results
4. **Local content** - Sourcing data

---

## 🔧 Implementation Approach

**Pour chaque page :**

1. **Analyser structure existante**
   - Sections, grids, cards
   - Translation keys utilisées
   - Images associées

2. **Identifier enrichissements possibles**
   - Nouvelles sections (same design)
   - Translations augmentées
   - Images/data additionnelles

3. **Implémenter IN-PLACE**
   - Ajouter translations
   - Ajouter sections
   - Copier images
   - Aucun changement HTML base

4. **Tester**
   - FR & EN rendez
   - Images load
   - Layout preserve
   - Mobile responsive

5. **Commit**
   - Message clair
   - Changes granulaires

---

## 📋 Checklist Enrichissement

### ✅ Completed
- [x] Reserves page (full design + lightbox)
- [x] CIL project (4 new images + sections)

### ⏳ In Progress
- [ ] Karma mine (resources + timeline)
- [ ] Homepage (real stats)

### ⏭️ Planned
- [ ] Company subpages (photos + content)
- [ ] Sustainability metrics
- [ ] Careers listings
- [ ] Communities initiatives
- [ ] HSE stats
- [ ] Reports PDFs
- [ ] Press releases

---

## 📐 Estimated Effort (In-Place)

| Page | Type | Effort | Status |
|------|------|--------|--------|
| Reserves | Full | 3h | ✅ DONE |
| CIL | Full | 4h | ✅ DONE |
| Karma | Enhance | 2-3h | ⏳ NEXT |
| Homepage | Update | 1-2h | ⏳ NEXT |
| Company | Enhance | 2-3h | ⏭️ |
| Sustainability | Update | 2h | ⏭️ |
| Careers | Enhance | 2h | ⏭️ |
| Communities | Enhance | 1-2h | ⏭️ |
| HSE | Update | 1-2h | ⏭️ |
| Reports | Enhance | 1h | ⏭️ |
| Press | Enhance | 1h | ⏭️ |
| **TOTAL** | | **20-23h** | |

---

## 💾 Data Requirements

**Required from Company:**
- [ ] Production stats (2007-2025)
- [ ] Employment figures & profiles
- [ ] ESG/Sustainability initiatives & metrics
- [ ] Community program details
- [ ] Safety records & certifications
- [ ] Leadership team bios & photos
- [ ] Organizational chart
- [ ] Recent press releases
- [ ] Sustainability reports
- [ ] Technical documents
- [ ] Deposit information & JORC classification

---

**Next Action:** 
1. Prioritize data collection (HIGH priority items)
2. Start with Karma enhancement (resources + timeline)
3. Update homepage with real stats
4. Weekly commits per page enrichment

**Structure:** PRESERVED ✅  
**Content:** ENHANCED ✅  
**Design:** IMPROVED ✅
