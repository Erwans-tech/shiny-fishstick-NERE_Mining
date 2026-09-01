# 🚀 Migration vers Render + Supabase

Guide complet pour migrer de Railway vers Render avec Supabase comme base de données.

## 📋 Prérequis

- [ ] Compte Render (gratuit pour commencer)
- [ ] Compte Supabase (gratuit avec 500MB de stockage)
- [ ] Code source sur GitHub/GitLab

## 🗃️ Étape 1 : Configuration Supabase

### 1.1 Créer un projet Supabase
1. Va sur [supabase.com](https://supabase.com)
2. Clique sur "Start your project"
3. Crée une nouvelle organisation si nécessaire
4. Clique sur "New project"
5. Choisis :
   - **Nom** : `nere-mining` 
   - **Password** : Génère un mot de passe fort
   - **Région** : Europe West (Frankfurt) ou la plus proche

### 1.2 Récupérer les informations de connexion
1. Va dans **Settings → Database**
2. Note ces informations :
   ```
   Host: db.xxx.supabase.co
   Port: 5432  
   Database: postgres
   User: postgres
   Password: [ton mot de passe]
   ```

### 1.3 Configurer les politiques (optionnel)
Si tu veux utiliser Row Level Security :
```sql
-- Exemple de politique basique
ALTER TABLE users ENABLE ROW LEVEL SECURITY;
CREATE POLICY "Users can view own data" ON users FOR SELECT USING (auth.uid() = id);
```

## 🎯 Étape 2 : Configuration Render

### 2.1 Connecter le dépôt
1. Va sur [render.com](https://render.com)
2. Clique sur "New +" → "Web Service"
3. Connecte ton dépôt GitHub/GitLab
4. Sélectionne le dépôt `REFONTESITE`

### 2.2 Configuration du service
- **Name** : `nere-mining`
- **Region** : Frankfurt (EU Central)
- **Branch** : `main`
- **Runtime** : `PHP`
- **Build Command** :
  ```bash
  composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
  ```
- **Start Command** :
  ```bash
  php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT
  ```

### 2.3 Variables d'environnement Render
Ajoute ces variables dans le dashboard Render :

#### Application
```
APP_NAME=Néré Mining
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:[généré automatiquement]
APP_URL=https://ton-app.onrender.com
FORCE_HTTPS=true
```

#### Base de données Supabase
```
DB_CONNECTION=pgsql
DB_HOST=db.xxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=[ton mot de passe Supabase]
```

#### Session & Sécurité
```
SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict
BCRYPT_ROUNDS=12
```

#### Logs & Cache  
```
LOG_CHANNEL=daily
LOG_LEVEL=warning
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

## 🔄 Étape 3 : Migration des données

### 3.1 Exporter depuis l'ancienne base (Railway)
```bash
# Si tu as accès à l'ancienne DB
mysqldump -h old-host -u user -p database_name > backup.sql
```

### 3.2 Convertir MySQL vers PostgreSQL
Utilise un outil comme `pgloader` ou convertis manuellement :
```bash
# Installation pgloader (sur Ubuntu/Debian)
apt-get install pgloader

# Conversion
pgloader mysql://user:pass@old-host/db postgresql://postgres:pass@supabase-host/postgres
```

### 3.3 Ou recommencer à zéro (plus simple)
Si tu peux recréer les données :
1. Les migrations Laravel s'exécuteront automatiquement
2. Recrée les données admin/test manuellement
3. Réimporte les fichiers média si nécessaire

## 🚀 Étape 4 : Déploiement

### 4.1 Premier déploiement
1. Dans Render, clique "Create Web Service"
2. Le build va commencer automatiquement
3. Surveille les logs pour voir les erreurs

### 4.2 Vérifications post-déploiement
- [ ] L'app se lance sans erreur
- [ ] Les migrations se sont bien passées
- [ ] L'admin panel fonctionne
- [ ] Les uploads marchent
- [ ] Les formulaires de contact fonctionnent

## 🔧 Étape 5 : Optimisations

### 5.1 Performances
- Activer le cache OPcache PHP
- Configurer les headers de cache
- Optimiser les images

### 5.2 Monitoring
- Utiliser les logs Render
- Configurer les alertes Supabase
- Mettre en place un monitoring uptime

## 📊 Comparaison des coûts

| Service | Railway | Render + Supabase |
|---------|---------|-------------------|
| **Gratuit** | 500h/mois | 750h/mois + 500MB DB |
| **Payant** | $5-20/mois | $7/mois + $25/mois (Pro DB) |
| **Avantages** | Simple setup | Plus de ressources, meilleure DB |

## 🆘 Résolution de problèmes

### Erreur de migration
```bash
# Réinitialiser les migrations
php artisan migrate:fresh --force
```

### Problème de stockage
```bash
# Recréer le lien symbolique
php artisan storage:link
```

### Erreur de permissions
Vérifier que le dossier `storage` est writable.

## 📝 Checklist finale

- [ ] ✅ Supabase configuré et accessible  
- [ ] ✅ Variables d'environnement définies dans Render
- [ ] ✅ Premier déploiement réussi
- [ ] ✅ Base de données migrée
- [ ] ✅ Tests fonctionnels OK
- [ ] ✅ Domaine personnalisé configuré (optionnel)
- [ ] ✅ SSL activé
- [ ] ✅ Monitoring en place
- [ ] ✅ Anciens services Railway supprimés

## 🎯 Étapes suivantes

1. **Domaine personnalisé** : Configure ton propre domaine dans Render
2. **CDN** : Considère Cloudflare pour les performances
3. **Backup** : Configure les backups automatiques Supabase  
4. **Analytics** : Intègre Google Analytics ou alternative
5. **Monitoring** : Utilise des services comme Sentry pour les erreurs

---

💡 **Astuce** : Commence par un déploiement en mode "test" pour vérifier que tout fonctionne avant de switcher le DNS !