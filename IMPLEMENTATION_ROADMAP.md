# Plan d'Implémentation - Enrichissement du Site Néré Mining

**Date:** 25 Août 2026  
**Statut:** 3 phases prioritaires identifiées

---

## 📋 Audit Comparatif

### État Actuel vs. Potentiel

```
PAGES EXISTANTES:
✅ Accueil (50%) - Améliorable
✅ Karma (20%) - À enrichir considérablement  
✅ Projets/CIL (80%) - Bien enrichi
❌ Durabilité (0%)
❌ Carrières (0%)
❌ À Propos (0%)
❌ Ressources (0%)
```

---

## 🎯 Phase 1: Fondations (Semaines 1-2)

### 1.1 Améliorer Page Accueil
**Fichier:** `resources/views/pages/home.blade.php` ou `resources/views/welcome.blade.php`

**Actions:**
- [ ] Remplacer lorem ipsum par vraies statistiques
  - Tonnes extraites (cumul depuis 2007)
  - Emplois créés (472+)
  - Années d'expérience
  - Onces d'or produites
- [ ] Enrichir services exploration (4 cartes)
  - Icônes spécifiques
  - Description technique
  - Exemples concrets
- [ ] Section production timeline
- [ ] Témoignages investisseurs/partenaires

**Données requises:**
- Stats actualisées (2024/2025)
- Photos d'équipes
- Témoignages

---

### 1.2 Compléter Page Karma Mine
**Fichier:** `resources/views/pages/karma.blade.php` (ou resources.blade.php)

**Actions:**
- [ ] Hero section avec stats clés
  - Production annuelle
  - Réserves totales
  - Type de gisements (Oxydé, sulfuré)
- [ ] Carte interactive localisation
  - Position GPS
  - Accès routier
  - Région Yatenga
- [ ] Timeline historique
  - 2007: Acquisition True Gold
  - 20XX: Transition Néré Mining
  - Milestones majeurs
- [ ] Gisements détails
  - Nami, GG1, GG2, Kao, Goulagou
  - Tonnage par zone
  - Teneur moyenne
  - État exploitation

**Données requises:**
- Production annuelle par année
- Historique développement
- Photos aériennes du site
- Cartes géologiques

---

### 1.3 Créer Section About (À Propos)
**Fichier:** Nouveau `resources/views/pages/about.blade.php`

**Structure:**
```
1. Mission & Vision
   - Engagement durabilité
   - Valeurs Néré Mining
   
2. Leadership
   - Organigramme
   - Bios des cadres
   - Photos
   
3. Historique
   - Timeline 2007-2026
   - Jalons clés
   - Evolution
   
4. Engagements Clés
   - ESG
   - Sécurité
   - Environnement
   - Communauté
```

**Données requises:**
- Bios des leaders
- Dates importantes
- Vision/Mission statement
- Photos d'équipes

---

## 🌱 Phase 2: Expansion (Semaines 3-4)

### 2.1 Créer Section Durabilité
**Fichier:** Nouveau `resources/views/pages/sustainability.blade.php`

**Structure:**
```
1. Engagements ESG
   - Environmental
   - Social
   - Governance
   
2. Initiatives Communautaires
   - Éducation
   - Santé
   - Infrastructure
   
3. Impact Environnemental
   - Monitoring
   - Mitigation
   - Biodiversité
   
4. Rapports & Certifications
   - Durabilité annuelle
   - Accréditations ICMM
   - JORC compliance
```

**Données requises:**
- Initiatives en cours
- Métriques d'impact
- Photos projects communautaires
- Rapports de durabilité

---

### 2.2 Créer Section Carrières
**Fichier:** Nouveau `resources/views/pages/careers.blade.php`

**Structure:**
```
1. Pourquoi Rejoindre Néré
   - Culture
   - Avantages
   - Développement
   
2. Annonces d'Emploi
   - Formulaire filtrage
   - Détails positions
   - Apply button
   
3. Nos Talents (472+)
   - Employee spotlights
   - Success stories
   - Testimonials
   
4. Formation & Développement
   - Programmes
   - Certifications
   - Mentorship
```

**Données requises:**
- Job listings actifs
- Salaire/avantages ranges
- Photos équipes
- Employee testimonials
- Org hierarchy

---

### 2.3 Enrichir Section Opérations
**Fichiers:**
- `resources/views/pages/exploration.blade.php` (nouveau)
- `resources/views/pages/extraction.blade.php` (nouveau)
- `resources/views/pages/processing.blade.php` (existant/améliorer)

**Exploration:**
- Méthodologies
- Résultats de forage
- Cartes géologiques
- Zones prospectives

**Extraction:**
- Équipements utilisés
- Techniques de dynamitage
- Sécurité
- Production par zone

**Processing:**
- CIL details (déjà bon)
- Autres procédés
- Capacités
- Rendements

---

## 🎨 Phase 3: Polissage (Semaines 5-6)

### 3.1 Créer Centre Ressources
**Fichier:** Nouveau `resources/views/pages/resources.blade.php`

**Sections:**
- Téléchargements (Reports, Docs)
- Présentations investisseurs
- Données géologiques
- Certifications
- Press kit

---

### 3.2 Créer Section Actualités
**Fichier:** Nouveau `resources/views/pages/news.blade.php` ou posts

**Contenu:**
- News items (5-10 articles)
- Press releases
- Event announcements
- Archive par date/catégorie

---

### 3.3 Améliorer Navigation & Footer
- Links vers nouvelles sections
- Breadcrumbs cohérents
- Footer avec tous contacts
- Sitemap actualisé

---

## 📊 Checklist d'Implémentation

### Phase 1
- [ ] Collecte données Phase 1
- [ ] Création About page
- [ ] Enrichissement Karma mine
- [ ] Update homepage stats
- [ ] Commit & Test
- [ ] Review & Refinement

### Phase 2
- [ ] Collecte données Phase 2
- [ ] Création Sustainability
- [ ] Création Careers
- [ ] Opérations breakdown
- [ ] Commit & Test
- [ ] Review & Refinement

### Phase 3
- [ ] Création Resources center
- [ ] Création News section
- [ ] Navigation updates
- [ ] SEO optimization
- [ ] Final testing
- [ ] Deployment

---

## 📐 Estimations Effort

| Tâche | Effort | Dépendances |
|-------|--------|-------------|
| Homepage enrichie | 2-3h | Données |
| About page | 2-3h | Bios, Photos |
| Karma enrichie | 4-5h | Maps, Cartes géo |
| Sustainability | 4-5h | ESG data |
| Careers | 3-4h | Job listings |
| Resources | 2-3h | Docs |
| News | 2-3h | Articles |
| **TOTAL** | **20-26h** | **Data completeness** |

---

## 🎬 Next Steps

1. **Valider priorités** avec stakeholders
2. **Collecter données** pour Phase 1
3. **Commencer implémentation** semaine prochaine
4. **Weekly reviews** avec équipe
5. **Deployment progressif** par phase

---

## 📞 Points de Contact Données

**À identifier:**
- [ ] Responsible: Production data
- [ ] Responsible: ESG/Sustainability
- [ ] Responsible: HR/Careers
- [ ] Responsible: Communications
- [ ] Responsible: Geology/Technical

---

**Document de Travail:** À adapter selon ressources disponibles  
**Dernière mise à jour:** 25 Août 2026
