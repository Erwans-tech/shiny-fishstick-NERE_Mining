# 🚨 Résolution Erreur 500 - Site Production

**Date :** 18 septembre 2026  
**Symptôme :** Erreur 500 Internal Server Error sur https://www.nere-mining.bf

---

## 🔍 DIAGNOSTIC RAPIDE

### Étape 1 : Vérifier les Logs Laravel (OBLIGATOIRE)

```bash
# Sur le serveur Windows
cd C:\inetpub\wwwroot\nere-mining

# Voir les dernières erreurs
Get-Content storage\logs\laravel.log -Tail 50

# Ou ouvrir avec notepad
notepad storage\logs\laravel.log
```

**Ce qu'on cherche :**
- Stack trace de l'erreur
- Fichier et ligne exacte
- Message d'erreur explicite

---

## ⚡ SOLUTIONS RAPIDES (Dans l'ordre)

### Solution 1 : Clear All Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
iisreset
```

### Solution 2 : Vérifier .env
```bash
# Ouvrir .env et vérifier :
APP_URL=https://www.nere-mining.bf
ASSET_URL=https://www.nere-mining.bf
APP_ENV=production
APP_DEBUG=false

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nere_mining
DB_USERNAME=postgres
DB_PASSWORD=***

# Puis reconstruire cache
php artisan config:cache
```

### Solution 3 : Vérifier Migrations BDD
```bash
# Voir statut migrations
php artisan migrate:status

# Si migrations manquantes
php artisan migrate --force
```

### Solution 4 : Vérifier Storage Permissions
```bash
# Sur Windows, vérifier que IIS a accès en écriture
icacls storage /grant "IIS_IUSRS:(OI)(CI)F"
icacls bootstrap\cache /grant "IIS_IUSRS:(OI)(CI)F"
```

### Solution 5 : Rebuild Autoloader
```bash
composer dump-autoload
php artisan optimize:clear
```

---

## 🔧 CAUSES PROBABLES & FIXES SPÉCIFIQUES

### Cause A : Changements Récents (Album Featured)

**Symptôme :** Erreur après ajout album featured dans grille actualités

**Solution :**
```bash
# Vérifier que la migration existe
php artisan migrate:status | findstr featured

# Si manquante, migrer
php artisan migrate --force

# Initialiser settings
php artisan settings:init
```

### Cause B : Image gold-extraction-plant.jpg Manquante

**Symptôme :** Erreur sur page /karma/exploitation

**Solution :**
```bash
# Vérifier fichier existe
Test-Path public\images\mining\gold-extraction-plant.jpg

# Si manquant, recopier depuis backup ou recréer
# Vérifier aussi que open-pit-mining.jpg existe
```

### Cause C : PhotoAlbum Query Échoue

**Symptôme :** Erreur "Table photo_albums doesn't exist"

**Solution :**
```bash
# Migrer table albums
php artisan migrate --force

# Si ça échoue, vérifier connexion BDD
php artisan tinker
>>> DB::connection()->getPdo();
```

### Cause D : Carousel JS Erreur

**Symptôme :** Page charge mais carousel plante

**Vérification :**
1. Ouvrir Console Browser (F12)
2. Voir erreurs JS
3. Vérifier fichier existe : `public/js/album-carousel.js`

**Solution :**
```bash
# Rebuild assets
npm run build

# Ou vérifier fichier existe
Test-Path public\js\album-carousel.js
```

### Cause E : Composer Dependencies

**Symptôme :** Class not found

**Solution :**
```bash
composer install --no-dev --optimize-autoloader
composer dump-autoload
```

---

## 🚨 SI RIEN NE FONCTIONNE : ROLLBACK

### Option 1 : Rollback Git (Dernier Commit Stable)

```bash
# Voir commits récents
git log --oneline -10

# Identifier dernier commit stable (avant erreur)
# Exemple : c85682d était stable

# Rollback (ATTENTION : perte des derniers changements)
git reset --hard c85682d
git push origin production-stable --force

# Rebuild cache
php artisan config:cache
php artisan route:cache
iisreset
```

### Option 2 : Rollback Spécifique (Annuler Album Featured)

Si l'erreur vient de l'album featured sur homepage :

**Fichier : `resources/views/home.blade.php`**

Remplacer section 4 par l'ancienne version :

```blade
{{-- Section 4b UNIQUEMENT : Actualités --}}
<section class="sec news-sec sa-animated-section" id="actualites">
    <div class="sa-particles-container" data-count="3"></div>
    <div class="news-head sa-reveal">
        <div>
            <span class="sec-tag">{{ $en ? 'News' : 'Actualités' }}</span>
            <h2 id="news-h" class="sec-h">{{ $en ? 'Latest News' : 'Dernières actualités' }}</h2>
        </div>
    </div>
    <div class="news-grid">
        @forelse($news as $i => $item)
        {{-- Cartes actualités normales --}}
        @endforeach
    </div>
</section>
```

Supprimer la condition `@if(isset($featuredAlbum))` et la carte album.

---

## 📊 VÉRIFICATIONS POST-FIX

Après chaque tentative de fix :

1. **Vérifier homepage**
   ```
   https://www.nere-mining.bf
   ```

2. **Vérifier admin**
   ```
   https://www.nere-mining.bf/gestion-nm
   ```

3. **Vérifier médiathèque**
   ```
   https://www.nere-mining.bf/mediatheque
   ```

4. **Vérifier page Karma**
   ```
   https://www.nere-mining.bf/karma/exploitation
   ```

5. **Logs propres**
   ```bash
   Get-Content storage\logs\laravel.log -Tail 20
   # Pas d'erreurs récentes
   ```

---

## 🔍 DEBUG MODE (TEMPORAIRE - SEULEMENT SI BLOQUÉ)

**⚠️ ATTENTION : NE PAS LAISSER EN PRODUCTION**

```env
# Dans .env
APP_DEBUG=true
APP_ENV=local
```

Puis :
```bash
php artisan config:cache
iisreset
```

Recharger page → Voir erreur détaillée

**IMPORTANT : Remettre après diagnostic :**
```env
APP_DEBUG=false
APP_ENV=production
```

---

## 📞 COMMANDES COMPLÈTES DE RÉSOLUTION

### Séquence Complète (Copier-Coller)

```powershell
# 1. Aller dans répertoire
cd C:\inetpub\wwwroot\nere-mining

# 2. Clear tous les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 3. Vérifier .env correct
notepad .env
# Vérifier APP_URL, ASSET_URL, DB_*

# 4. Reconstruire cache
php artisan config:cache
php artisan route:cache

# 5. Vérifier migrations
php artisan migrate:status
php artisan migrate --force

# 6. Settings init
php artisan settings:init

# 7. Rebuild autoloader
composer dump-autoload

# 8. Permissions
icacls storage /grant "IIS_IUSRS:(OI)(CI)F"
icacls bootstrap\cache /grant "IIS_IUSRS:(OI)(CI)F"

# 9. Redémarrer IIS
iisreset

# 10. Vérifier logs
Get-Content storage\logs\laravel.log -Tail 50
```

---

## 🆘 SI TOUJOURS BLOQUÉ

### Contacter Support

1. **Copier les logs Laravel**
   ```bash
   Get-Content storage\logs\laravel.log -Tail 100 > erreur-500.txt
   ```

2. **Envoyer informations**
   - Fichier erreur-500.txt
   - Screenshot erreur 500
   - Dernières actions effectuées avant erreur

3. **Informations système**
   ```bash
   php -v
   php artisan --version
   git log --oneline -5
   ```

### Restauration Urgente (Dernier Recours)

Si le site doit être remis en ligne IMMÉDIATEMENT :

```bash
# Backup actuel
git branch backup-$(Get-Date -Format "yyyyMMdd-HHmmss")

# Retour version stable connue
git reset --hard <commit-stable>
git push --force origin production-stable

# Rebuild
php artisan config:cache
php artisan route:cache
iisreset
```

---

## ✅ CHECKLIST RÉSOLUTION

- [ ] Logs Laravel consultés
- [ ] Cache vidé (config, route, view)
- [ ] .env vérifié et correct
- [ ] Migrations à jour
- [ ] Permissions storage OK
- [ ] IIS redémarré
- [ ] Homepage charge
- [ ] Admin accessible
- [ ] Médiathèque fonctionne
- [ ] Aucune erreur dans logs

---

**Bon courage !** 💪

Si problème persiste après toutes ces étapes, c'est probablement un problème d'infrastructure (IIS, PHP, PostgreSQL) et non de code Laravel.
