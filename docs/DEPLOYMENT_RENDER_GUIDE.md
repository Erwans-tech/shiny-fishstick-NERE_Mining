# 🚀 Guide de Déploiement Render - Néré Mining

## ✅ Prérequis VALIDÉS

- ✅ **Code poussé** : Commit `baab86c` sur branche `production`
- ✅ **Configuration Render** : `render.yaml` prêt
- ✅ **Base de données Supabase** : `plibklblcykfhnoboqum` configurée  
- ✅ **Statistiques** : Toutes les métriques mises à jour
- ✅ **Variables d'environnement** : `RENDER_ENV_VARIABLES.txt` prêtes

---

## 📋 ÉTAPE 1 : Créer le service Render

### 1.1 Connexion Render
1. **Va sur** [render.com](https://render.com)
2. **Connecte-toi** avec GitHub ou crée un compte
3. **Clique** "New +" → **"Web Service"**

### 1.2 Connecter le repository
1. **Autorise Render** à accéder à tes repos GitHub
2. **Sélectionne** le repository `shiny-fishstick-NERE_Mining`
3. **Choisir la branche** : `production` ⚠️ 

---

## ⚙️ ÉTAPE 2 : Configuration du service

### 2.1 Paramètres généraux
```
Name: nere-mining
Region: Frankfurt (EU Central) 
Branch: production
Runtime: PHP
```

### 2.2 Build Command
```bash
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

### 2.3 Start Command  
```bash
php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT
```

---

## 🔑 ÉTAPE 3 : Variables d'environnement

**Copie EXACTEMENT ces variables dans Render :**

### Application
```
APP_NAME=Néré Mining
APP_ENV=production
APP_DEBUG=false
APP_URL=https://nere-mining.onrender.com
FORCE_HTTPS=true
```

### Base de données Supabase
```
DB_CONNECTION=pgsql
DB_HOST=db.plibklblcykfhnoboqum.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=4kuAbwAFxDb1nD03
```

### Session & Sécurité
```
SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict
BCRYPT_ROUNDS=12
```

### Logs & Performance
```
LOG_CHANNEL=daily
LOG_LEVEL=warning
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public
```

### Mail (optionnel)
```
MAIL_MAILER=log
MAIL_FROM_ADDRESS=contact@nere-mining.com
MAIL_FROM_NAME=Néré Mining
```

⚠️ **IMPORTANT** : Render générera automatiquement `APP_KEY`

---

## 🚀 ÉTAPE 4 : Lancer le déploiement

1. **Clique** "Create Web Service"
2. **Surveille les logs** de build en temps réel
3. **Attend** que le statut passe à "Live" (5-10 min)

### 4.1 Logs à surveiller
```
✅ Installing dependencies via Composer...
✅ composer install --no-dev --optimize-autoloader
✅ php artisan config:cache
✅ php artisan route:cache  
✅ php artisan view:cache
✅ php artisan migrate --force
✅ php artisan storage:link
✅ Starting server on 0.0.0.0:$PORT
```

---

## 🔍 ÉTAPE 5 : Tests post-déploiement

### 5.1 Tests fonctionnels
- [ ] ✅ **Page d'accueil** : https://nere-mining.onrender.com
- [ ] ✅ **Statistiques** : 1909+ emplois, 99% burkinabè affichés
- [ ] ✅ **Interface admin** : /admin login fonctionnel
- [ ] ✅ **Pages carrières** : nouvelles métriques visibles
- [ ] ✅ **Formulaire contact** : envoi OK
- [ ] ✅ **Navigation** : toutes les pages se chargent

### 5.2 Tests techniques
- [ ] ✅ **Base de données** : connexion PostgreSQL OK
- [ ] ✅ **Migrations** : toutes les tables créées
- [ ] ✅ **Storage** : uploads d'images fonctionnels
- [ ] ✅ **SSL** : HTTPS activé automatiquement
- [ ] ✅ **Performance** : temps de chargement <3s

---

## 🎯 URLs importantes

- **Application** : https://nere-mining.onrender.com
- **Dashboard Render** : https://dashboard.render.com
- **Logs Render** : Dans le dashboard → ton service → "Logs"
- **Supabase DB** : https://app.supabase.com/project/plibklblcykfhnoboqum
- **Repository** : https://github.com/Erwans-tech/shiny-fishstick-NERE_Mining

---

## 🆘 Résolution de problèmes

### Build échoue
```bash
# Vérifier composer.json
# Vérifier les dépendances PHP dans render.yaml
```

### Erreur de migration
```bash
# Vérifier variables DB dans Render
# Tester connexion Supabase depuis Render logs
```

### Page blanche / erreur 500
```bash
# Vérifier APP_KEY généré
# Vérifier logs Render pour erreur PHP
```

### Assets manquants
```bash
# Vérifier que storage:link s'est exécuté
# Vérifier paths dans .env
```

---

## 📊 Monitoring continu

### 1. **Surveiller les métriques Render**
- Temps de réponse
- Utilisation mémoire  
- Requêtes/minute
- Erreurs 5xx

### 2. **Surveiller Supabase**
- Connexions DB actives
- Requêtes/seconde
- Stockage utilisé
- Performances

### 3. **Tests réguliers**
- Nouvelles statistiques affichées correctement
- Formulaires fonctionnels
- Admin panel accessible
- Backup des données

---

## 🎉 Déploiement réussi !

Une fois en ligne, ton site Néré Mining aura :

✅ **Infrastructure moderne** : Render + Supabase  
✅ **Statistiques actualisées** : 1909+ emplois, 99% burkinabè, 77.8Mrd achats  
✅ **Performance optimisée** : Europe (Frankfurt)  
✅ **Évolutivité** : Facile à faire grandir  
✅ **Monitoring** : Dashboards Render + Supabase  

**🚀 Ton site sera accessible mondialement avec les dernières données !**