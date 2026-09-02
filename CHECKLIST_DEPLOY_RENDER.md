# ✅ Checklist Déploiement Render + Supabase

## 🎯 Ton projet configuré

- **Projet Supabase** : `plibklblcykfhnoboqum`
- **Host** : `db.plibklblcykfhnoboqum.supabase.co`
- **Lien dashboard** : [https://app.supabase.com/project/plibklblcykfhnoboqum](https://app.supabase.com/project/plibklblcykfhnoboqum)

## 📋 Étapes de déploiement

### 🔐 1. Récupérer ton mot de passe Supabase
- [ ] Va sur [https://app.supabase.com/project/plibklblcykfhnoboqum/settings/database](https://app.supabase.com/project/plibklblcykfhnoboqum/settings/database)
- [ ] Si tu l'as oublié, clique sur "Reset database password"
- [ ] **Garde ce mot de passe** pour l'étape suivante

### 📤 2. Pousser le code sur GitHub/GitLab
```bash
git add .
git commit -m "🚀 Configuration Render + Supabase"
git push origin main
```

### 🎯 3. Créer le service Render
- [ ] Va sur [render.com](https://render.com)
- [ ] Clique "New +" → "Web Service"
- [ ] Connecte ton dépôt GitHub/GitLab `REFONTESITE`

### ⚙️ 4. Configuration du service Render

#### Paramètres généraux :
- **Name** : `nere-mining`
- **Region** : `Frankfurt (EU Central)`
- **Branch** : `main`
- **Runtime** : `PHP`

#### Build Command :
```bash
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

#### Start Command :
```bash
php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT
```

### 🔑 5. Variables d'environnement Render

Copie exactement ces variables dans le dashboard Render :

#### Application
```
APP_NAME=Néré Mining
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:GENERE_AUTOMATIQUEMENT_PAR_RENDER
APP_URL=https://ton-app.onrender.com
FORCE_HTTPS=true
```

#### Base de données (TON SUPABASE)
```
DB_CONNECTION=pgsql
DB_HOST=db.plibklblcykfhnoboqum.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=4kuAbwAFxDb1nD03
```

#### Session & Sécurité
```
SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict
BCRYPT_ROUNDS=12
```

#### Logs & Performance
```
LOG_CHANNEL=daily
LOG_LEVEL=warning
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public
```

### 🚀 6. Lancer le déploiement
- [ ] Clique "Create Web Service"
- [ ] Surveille les logs de build
- [ ] Vérifie que les migrations s'exécutent

### ✅ 7. Tests post-déploiement
- [ ] L'app se charge sans erreur 500
- [ ] Va sur `https://ton-app.onrender.com/admin` → login marche
- [ ] Les images/uploads fonctionnent
- [ ] Le formulaire de contact fonctionne
- [ ] Les pages publiques s'affichent correctement

## 🎯 URLs importantes

- **App Render** : `https://nere-mining.onrender.com` (exemple)
- **Dashboard Render** : [https://dashboard.render.com](https://dashboard.render.com)
- **Supabase Dashboard** : [https://app.supabase.com/project/plibklblcykfhnoboqum](https://app.supabase.com/project/plibklblcykfhnoboqum)
- **Supabase DB Settings** : [https://app.supabase.com/project/plibklblcykfhnoboqum/settings/database](https://app.supabase.com/project/plibklblcykfhnoboqum/settings/database)

## 🆘 En cas de problème

### Erreur de connexion DB
1. Vérifie le mot de passe dans les variables d'environnement
2. Va sur Supabase → Settings → Database → Test la connexion
3. Regarde les logs Render pour l'erreur exacte

### Erreur 500 au démarrage
1. Regarde les logs Render 
2. Vérifie que `APP_KEY` est générée
3. Vérifie que les migrations se sont bien passées

### Problème de storage/uploads
1. Vérifie que `php artisan storage:link` s'est exécuté
2. Vérifie les permissions du dossier `storage/`

## 📞 Support
- **Render Docs** : [https://render.com/docs](https://render.com/docs)
- **Supabase Docs** : [https://supabase.com/docs](https://supabase.com/docs)
- **Laravel Deployment** : [https://laravel.com/docs/deployment](https://laravel.com/docs/deployment)

---

🎉 **Une fois en ligne, n'oublie pas de** :
1. Configurer un domaine personnalisé (optionnel)
2. Mettre en place un monitoring (Sentry, etc.)
3. Configurer les backups Supabase
4. Tester les performances et optimiser si besoin