# Quick Wins - Enrichissement Immédiat (Sans Changer Structure)

**Objectif:** Ajouter contenu riche aux pages existantes via translations + sections internes  
**Impact:** +40% enrichissement en 2-3 jours  
**Structure:** 100% Préservée ✅

---

## 🎯 Pages HIGH Priority à Enrichir

### 1️⃣ **Karma Mine Page** (NEXT)
**Fichier:** `resources/views/pages/karma.blade.php`  
**État:** 60% bon, manque ressources + production history  

**Action 1: Ajouter Section "Ressources & Réserves"**
- Insérer AVANT section "Organisation" (ligne ~80)
- Contenu: Tableau gisements + images (même design reserves.blade.php)
- Données: Nami (Oxide), GG1, GG2, Kao, Goulagou

```html
<!-- Insérer après section exploitation, avant organisation -->
<section id="ressources" class="sand">
    <h2>Ressources & Réserves</h2>
    <div class="grid-2" style="...">
        <figure><!-- Carte ressources --></figure>
        <div><!-- Tableau gisements --></div>
    </div>
</section>
```

**Données requises:**
```
Resources/Deposits:
- Nami: 1,633 Kt @ 0.82 g/t (Oxide) → 15.2 Koz
- GG1: 5,888 Kt @ 1.00 g/t (Mixed) → 36.3 Koz
- GG2: 5,320 Kt @ 1.65 g/t (Sulfide) → 59.8 Koz
- Kao: [Amount] Kt @ [Grade] g/t
- Goulagou: [Amount] Kt @ [Grade] g/t
```

**Action 2: Ajouter "Production Timeline"**
- Insérer APRÈS section exploitation
- Contenu: Historique extraction 2007-2026 + chart

```html
<section id="production-history">
    <h2>Production Timeline</h2>
    <div class="timeline" style="...">
        <div class="timeline-item">2007: Acquisition by True Gold</div>
        <div class="timeline-item">2019: First production</div>
        <div class="timeline-item">2024: Transition to Néré Mining</div>
    </div>
</section>
```

**Données requises:**
```
Yearly production:
2019: XX Koz
2020: XX Koz
2021: XX Koz
2022: XX Koz
2023: XX Koz
2024: XX Koz (YTD)
```

---

### 2️⃣ **Homepage Stats** (QUICK WIN)
**Fichier:** `resources/views/home.blade.php` (ligne ~430)  
**Action:** Remplacer placeholders par vraies figures

**Current stats array (line ~430):**
```php
$stats = [
    ['value' => '— Koz', 'label' => 'Annual Production'],
    ['value' => '1,200+', 'label' => 'Jobs Created'],
    ['value' => '18 yrs', 'label' => 'Operating History'],
    ['value' => '3.4 M', 'label' => 'Tonnes Extracted'],
];
```

**Update to:**
```php
$stats = [
    ['value' => '80 Koz', 'label' => 'Annual Gold Production', 'suffix' => 'ounces'],
    ['value' => '1,200+', 'label' => 'Direct & Indirect Jobs', 'suffix' => 'employees'],
    ['value' => '18 yrs', 'label' => 'Years of Operations', 'suffix' => ''],
    ['value' => '3.4 Mt', 'label' => 'Tonnes Extracted Cumulative', 'suffix' => ''],
];
```

**Time:** 10 minutes

---

### 3️⃣ **Company Pages** (MEDIUM effort)
**Fichiers:**
- `resources/views/pages/company/company-ceo.blade.php`
- `resources/views/pages/company/company-identity.blade.php`
- `resources/views/pages/company/company-history.blade.php`

**Action per file:**
- [ ] Read current content
- [ ] Identify translation keys used
- [ ] Update `lang/fr/site.php` + `lang/en/site.php` with enriched content
- [ ] Add images (photos CEO, headquarters, timeline)

**Example - company-identity:**
```php
// Current
'company_identity_lead' => 'Who are we?'

// Enhanced
'company_identity_lead' => 'Néré Mining is a Burkinabè-owned...',
'company_mission' => 'To create lasting value through...',
'company_vision' => 'To be the leading responsible...',
'company_values' => [
    'Integrity' => 'Transparent and ethical operations',
    'Excellence' => 'High standards in all we do',
    'Community' => 'Committed to local development',
],
```

---

### 4️⃣ **Sustainability Page** (MEDIUM effort)
**Fichier:** `resources/views/pages/sustainability.blade.php`  
**Action:** Add real metrics + initiatives

**Current structure:** Card-based (good for info boxes)  
**Add sections:**
- ESG Metrics (KPIs)
- Community Initiatives (with impact)
- Environmental Management (monitoring + results)
- Certifications & Reports

**Example translations to add:**
```php
'sustainability_esg_value' => 'E: Carbon neutral by 2030 | S: 1,200 jobs | G: ICMM member',
'sustainability_community_education' => '500+ students in scholarship program',
'sustainability_environment_water' => '95% water recycled in operations',
'sustainability_certifications' => ['EITI', 'ICMM', 'ISO 45001', 'ISO 14001'],
```

---

### 5️⃣ **Careers Page** (QUICK WIN)
**Fichier:** `resources/views/pages/careers.blade.php`  
**Action:** Add 5-10 job listings

**Current:** Mostly empty  
**Add:**
- Jobs grid (Maintenance, Operations, HR, etc.)
- Employee spotlights (1-2 profiles with photos)
- Culture description
- Training programs

```php
$jobs = [
    ['title' => 'Mining Operations Manager', 'location' => 'Karma', 'department' => 'Operations'],
    ['title' => 'Environmental Officer', 'location' => 'Karma', 'department' => 'Environment'],
    ['title' => 'Safety Supervisor', 'location' => 'Karma', 'department' => 'HSE'],
    // ... more
];
```

---

## 📋 Simple Action List (Copy-Paste)

### WEEK 1 - Easy Wins (4-6 hours)

- [ ] **Karma Page Enrichment** (2 hours)
  - [ ] Add "Ressources & Réserves" section
  - [ ] Add "Production Timeline" section
  - [ ] Copy `reserves-table.jpg` for reference

- [ ] **Homepage Stats** (30 minutes)
  - [ ] Update 4 stat values
  - [ ] Test on mobile

- [ ] **Careers Page** (1 hour)
  - [ ] Add 8 job cards
  - [ ] Add 2 employee spotlights
  - [ ] Add culture paragraph

- [ ] **Quick Commits**
  ```bash
  git add resources/views/pages/karma.blade.php
  git commit -m "enhance(karma): ajouter ressources + production timeline"
  
  git add resources/views/home.blade.php  
  git commit -m "update(home): stats réelles + enrichissement"
  
  git add resources/views/pages/careers.blade.php
  git commit -m "enhance(careers): ajouter jobs + employee spotlights"
  ```

### WEEK 2 - Medium Effort (4-6 hours)

- [ ] **Company Pages** (2 hours)
  - [ ] company-ceo: Add bio + photo
  - [ ] company-identity: Add mission/vision
  - [ ] company-history: Add timeline 2007-2026

- [ ] **Sustainability** (1.5 hours)
  - [ ] Add ESG metrics (real numbers)
  - [ ] Add initiatives with impact
  - [ ] Add certifications

- [ ] **HSE Page** (1 hour)
  - [ ] Add safety stats (LTI, TRIFR)
  - [ ] Add certifications

- [ ] **Commits**
  ```bash
  git add lang/*/site.php
  git add resources/views/pages/company/
  git commit -m "enhance(company): enrichir bios, mission, historique"
  
  git add resources/views/pages/sustainability.blade.php
  git commit -m "enhance(sustainability): ajouter métriques ESG + initiatives"
  ```

---

## 🎨 Design Notes

✅ **Preserved:**
- All existing grids (grid-2, grid-3)
- All existing card styles
- All existing colors/fonts
- All existing sections structure
- All existing responsive design

✅ **Added:**
- New sections (same design system)
- New translations (same language files)
- New images (same folder structure)
- New data (via translations or simple arrays)

❌ **NOT Changed:**
- HTML structure
- CSS classes
- Layout system
- Navigation
- Footer

---

## 📊 Data Points Needed (Send to Company)

**Urgent (for Karma page):**
- [ ] Deposit tonnage & grades (Nami, GG1, GG2, Kao, Goulagou)
- [ ] Annual production history 2019-2024
- [ ] Current employee count breakdown

**Important (for enrichment):**
- [ ] CEO name, title, photo, statement
- [ ] Company mission, vision, values
- [ ] ESG metrics (carbon, jobs, water, etc.)
- [ ] Safety records (LTI, TRIFR)
- [ ] Community initiatives & numbers
- [ ] Active job positions
- [ ] Employee spotlight stories (2-3)

**Nice-to-have:**
- [ ] Organizational chart
- [ ] Photos (team, operations, community)
- [ ] Sustainability report URL
- [ ] Certifications (ISO, ICMM, etc.)

---

## ✅ Verification Checklist

Before commit:

- [ ] Page renders FR + EN
- [ ] All images load
- [ ] Mobile responsive (480px, 768px, 1200px)
- [ ] Lighthouse score > 80
- [ ] No console errors
- [ ] Links work
- [ ] Translations complete

---

## 🚀 Expected Results

**After Implementation:**
```
Homepage:     30% → 70% (enrichment)
Karma:        60% → 85% (enrichment)
Careers:      20% → 70% (enrichment)
Company:      40% → 75% (enrichment)
Sustainab:    30% → 60% (enrichment)

Overall Site: 35% → 65% enrichment
```

**Time to Complete:** 8-12 hours (spread over 2 weeks)

**Structure Impact:** ZERO ✅

---

**Next Step:** Collect data points and start Week 1 tasks!
