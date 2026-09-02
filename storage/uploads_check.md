# Vérification des répertoires d'uploads

## Structure attendue

### public/uploads/ (uploads publics accessibles par URL)
```
public/uploads/
├── .gitkeep
├── applications/       ← CV et lettres de motivation (JobApplication)
├── certifications/     ← Images certifications (Certification)
├── hero/              ← Hero slideshow images (HeroSlide)
├── media/             ← Galerie médias (MediaAsset)
├── news/              ← Images actualités (News)
├── partners/          ← Logos partenaires (Partner)
├── press/             ← Images communiqués (PressDocument)
└── reports/           ← Images rapports (Report)
```

### storage/app/public/ (alias: public/storage)
```
storage/app/public/
├── applications/      ← Fichiers privés candidatures (temporaire avant move)
└── (autre contenu sensible)
```

## Permissions requises

- **Web server (www-data/IIS AppPool)** doit avoir:
  - ✅ Read/Write sur `public/uploads/**`
  - ✅ Read/Write sur `storage/app/public/**`
  - ✅ Read/Write sur `storage/logs/`
  - ✅ Read/Write sur `bootstrap/cache/`

## Checks à faire

### 1. Répertoires existent
- [✓] public/uploads/ existe
- [✓] public/uploads/applications/ existe
- [✓] public/uploads/certifications/ existe
- [✓] public/uploads/hero/ existe
- [✓] public/uploads/media/ existe
- [✓] public/uploads/news/ existe
- [✓] public/uploads/partners/ existe
- [✓] public/uploads/press/ existe
- [✓] public/uploads/reports/ existe
- [✓] storage/app/public/ existe
- [✓] storage/logs/ existe
- [✓] bootstrap/cache/ existe

### 2. Permissions
Sur production (Render/serveur Linux):
```bash
# Permissions générales
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod -R 755 public/uploads/

# Owner
chown -R www-data:www-data storage/
chown -R www-data:www-data public/uploads/
chown -R www-data:www-data bootstrap/cache/
```

### 3. .gitignore correct
- [✓] `public/uploads/*` est ignoré (sauf .gitkeep)
- [✓] `storage/app/` gère les répertoires privé/public

## Fichiers à uploader en production

Dossiers à créer vides ou avec .gitkeep:
```
public/uploads/.gitkeep ✓
public/uploads/applications/.gitkeep (à créer si besoin)
public/uploads/certifications/.gitkeep (à créer si besoin)
public/uploads/hero/.gitkeep (à créer si besoin)
public/uploads/media/.gitkeep (à créer si besoin)
public/uploads/news/.gitkeep (à créer si besoin)
public/uploads/partners/.gitkeep (à créer si besoin)
public/uploads/press/.gitkeep (à créer si besoin)
public/uploads/reports/.gitkeep (à créer si besoin)
```

## Checklist déploiement

- [ ] SSH en production
- [ ] Créer répertoires manquants
- [ ] Vérifier permissions (755 pour répertoires, 644 pour fichiers)
- [ ] Tester upload depuis admin (test une image news, une candidature)
- [ ] Vérifier logs (`storage/logs/laravel.log`)
- [ ] Vérifier que fichiers sont accessibles depuis navigateur
