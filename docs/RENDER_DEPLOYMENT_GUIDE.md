# 🚀 GUIDE DE DÉPLOIEMENT RENDER - NERE MINING

**Date:** 2 septembre 2026  
**Branche:** `production-stable`  
**Status:** ✅ Ready to Deploy  
**URL:** https://nere-mining-ex3a.onrender.com

---

## 📋 PRÉ-DÉPLOIEMENT - CHECKLIST

### ✅ Git & Branche
- [x] Branche `production-stable` existe
- [x] Tous les commits poussés
- [x] `render.yaml` configuré
- [x] `Dockerfile` optimisé

### ✅ Configuration
- [x] `.env.render` template en place
- [x] Variables d'environnement prêtes
- [x] Database settings OK

### ✅ Code
- [x] Toutes les migrations prêtes
- [x] Routes configurées
- [x] Formulaires validés
- [x] SEO complet (sitemap, robots, meta, OG, canonical)

---

## 🔧 ÉTAPES DE DÉPLOIEMENT

### **ÉTAPE 1: Vérifier Render Dashboard**

1. Aller à https://dashboard.render.com
2. Sélectionner le service `nere-mining`
3. Vérifier que:
   - [ ] Repo: `https://github.com/Erwans-tech/shiny-fishstick-NERE_Mining`
   - [ ] Branch: `production-stable`
   - [ ] Dockerfile path: `./Dockerfile`
   - [ ] Health check: `/up`

### **ÉTAPE 2: Vérifier Environment Variables**

Dans Render Dashboard → `nere-mining` → Environment:

**À vérifier/remplir:**
```
APP_KEY = base64:7UZXohTuPEpD8/s9/ILFmz8kYqFX28WXzaeAFwnQ0jQ=
APP_DEBUG = false
FORCE_HTTPS = true
LOG_CHANNEL = stderr
LOG_LEVEL = error

# Database (auto-rempli par Render si attached)
DB_CONNECTION = pgsql
DB_HOST = (from database)
DB_PORT = 5432
DB_DATABASE = (from database)
DB_USERNAME = (from database)
DB_PASSWORD = (from database)

# Filesystem (si utilisant R2 - OPTIONNEL)
FILESYSTEM_DISK = public  (ou r2 si configuré)
```

### **ÉTAPE 3: Vérifier la Base de Données**

Dans Render Dashboard → Databases:

Vérifier que `nere-mining-db` exists:
- [ ] Name: `nere-mining-db`
- [ ] Database: `nere_mining`
- [ ] User: `nere_user`
- [ ] Plan: Free (ou payant)

### **ÉTAPE 4: Déployer**

**Option A: Deployment Automatique**
1. Aller à `nere-mining` service
2. Aller à "Deployments"
3. Cliquer "Manual Deploy" → "Deploy latest commit"
4. **OU** simplement pusher vers `production-stable`:
   ```bash
   git push origin production-stable
   ```

**Option B: Redéployer depuis une branche**
1. Settings → Source
2. Changer branch si nécessaire
3. Save

### **ÉTAPE 5: Monitoring du Déploiement**

1. Aller à Logs (Render Dashboard)
2. Attendre que le build complète (5-10 minutes)
3. Vérifier les messages:
   ```
   ✓ Building image...
   ✓ Pushing image to registry...
   ✓ Starting service...
   ✓ Service started successfully
   ```

---

## ✅ POST-DÉPLOIEMENT - VÉRIFICATIONS

### **1. Service Status** (5 min)
```bash
# Vérifier que le service est UP
curl -I https://nere-mining-ex3a.onrender.com

# Attendu: HTTP 200
```

### **2. Accueil** (2 min)
```bash
# Charger la page d'accueil
curl https://nere-mining-ex3a.onrender.com/ -o /dev/null -w "%{http_code}\n"

# Attendu: 200
```

### **3. Sitemap** (1 min)
```bash
# Vérifier sitemap accessible
curl -I https://nere-mining-ex3a.onrender.com/sitemap.xml

# Attendu: 200
```

### **4. Robots.txt** (1 min)
```bash
# Vérifier robots.txt accessible
curl -I https://nere-mining-ex3a.onrender.com/robots.txt

# Attendu: 200
```

### **5. Admin** (2 min)
```bash
# Vérifier que l'admin est accessible
curl -I https://nere-mining-ex3a.onrender.com/gestion-nm/connexion

# Attendu: 200
```

### **6. Pages d'erreur** (2 min)
```bash
# Test 404
curl -I https://nere-mining-ex3a.onrender.com/nonexistent

# Attendu: 404
```

### **7. Formulaires Test** (5 min)
- [ ] Newsletter: Soumettre email valide
- [ ] Contact: Soumettre message complet
- [ ] Vérifier que les données sont en DB

### **8. Logs** (2 min)
Dans Render Dashboard → Logs:
- [ ] Pas d'erreurs PHP
- [ ] Pas d'erreurs DB
- [ ] Pas de 500 errors

---

## 🗄️ BASE DE DONNÉES - PREMIÈRE FOIS

**Si c'est la première déploiement**, Render exécutera automatiquement:
1. `composer install` (dépendances)
2. **MIGRATION:** Les migrations Laravel s'exécutent à chaque déploiement (voir Dockerfile)

**Si les migrations ne s'exécutent pas automatiquement**, connecter via Render Console:

```bash
# Dans Render Dashboard → nere-mining → Shell
php artisan migrate --force

# Vérifier tables
php artisan tinker
>>> Schema::getTables();
>>> DB::table('users')->count();
```

---

## 🔐 SÉCURITÉ - POINTS CRITIQUES

### **1. APP_KEY**
```bash
# Vérifier qu'une clé unique est utilisée
# Ne JAMAIS utiliser la clé locale
# Render génère automatiquement si non défini
```

### **2. HTTPS / SSL**
- ✅ Render gère le SSL automatiquement
- ✅ Certificat Let's Encrypt gratuit
- ✅ FORCE_HTTPS = true

### **3. Database Credentials**
- ✅ Stockés dans Render Environment (pas en code)
- ✅ Pas accessibles publiquement

### **4. Admin Access**
- ✅ `/gestion-nm/connexion` → login required
- ✅ Session sécurisée

---

## 📊 MONITORING 24/7

### **Logs Render**
```
Dashboard → nere-mining → Logs
```

### **Erreurs à surveiller**
```
❌ "Connection refused" → DB issue
❌ "Permission denied" → Storage issue
❌ "500 Internal Server Error" → Laravel error
❌ "Migrations pending" → Run migrate
```

### **Google Search Console**
1. Aller à https://search.google.com/search-console
2. Ajouter property: `https://nere-mining-ex3a.onrender.com`
3. Vérifier ownership (DNS record)
4. Attendre que sitemap soit indexé

---

## 🆘 TROUBLESHOOTING

### **Build échoue**
```
Erreur: "npm: not found"
→ Vérifier Dockerfile: nodejs/npm install OK

Erreur: "composer install failed"
→ Vérifier composer.json syntax
→ Vérifier pas de dépendances conflictuelles

Erreur: "PHP extension not found"
→ Ajouter extension dans Dockerfile
→ Rebuilder
```

### **Service ne démarre pas**
```
→ Vérifier logs: Dashboard → Logs
→ Vérifier APP_KEY défini
→ Vérifier DB credentials
→ Vérifier storage permissions
```

### **Database connection refused**
```
Erreur: "SQLSTATE[08006]"
→ Vérifier DB_HOST correct
→ Vérifier DB_PORT = 5432
→ Vérifier credentials
→ Vérifier database existe
→ Redéployer
```

### **Assets/CSS/JS ne charger pas**
```
→ Vérifier asset() paths
→ Vérifier public/build/ existe (production)
→ Vérifier npm run build exécuté
→ Vérifier .gitignore ne bloque pas
```

---

## 📞 CONTACTS SUPPORT

**Render Support:**
- Dashboard → Help → Contact Support
- Ou: https://render.com/support

**Erreurs Laravel:**
- Vérifier storage/logs/laravel.log
- Vérifier Render logs

**Erreurs DB Supabase:**
- Dashboard Supabase → Logs
- Vérifier credentials

---

## 🎯 APRÈS DÉPLOIEMENT (24-48h)

- [ ] Tester toutes les pages
- [ ] Tester tous les formulaires
- [ ] Vérifier email reçus
- [ ] Vérifier uploads fonctionnent
- [ ] Vérifier Google indexation
- [ ] Monitorer logs erreurs

---

## ✅ DÉPLOIEMENT COMPLET

**Une fois que tout fonctionne:**
1. Documenter URL finales
2. Notifier équipe
3. Mettre en place monitoring
4. Configurer backups

---

**Status:** ✅ Ready for Render Deployment  
**Next Step:** Click "Manual Deploy" in Render Dashboard
