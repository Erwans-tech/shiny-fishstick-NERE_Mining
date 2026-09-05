# 🚀 Déploiement sur Railway  - Néré Mining

Guide complet pour déployer votre application Laravel sur **Railway** avec MySQL.

## 📋 Prérequis

- Compte GitHub avec le repo connecté
- Compte Railway.app (gratuit, puis pay-as-you-go)
- Domaine personnalisé optionnel

## 🚦 Étapes de déploiement

### 1. Créer un projet Railway

1. Allez sur [railway.app](https://railway.app)
2. Cliquez **"New Project"**
3. Sélectionnez **"Deploy from GitHub"**
4. Connectez votre repo `shiny-fishstick-NERE_Mining`
5. Sélectionnez la branche `production`

### 2. Configurer les services

Railway détecte automatiquement le `railway.toml` et crée :
- **Web Service** (Laravel + Nginx)
- **MySQL Database** (optionnel, vous pouvez le faire manuellement)

#### Ajouter MySQL manuellement

1. Dans Railway : **"+ Add Service"**
2. Sélectionnez **"MySQL"**
3. Configurez :
   - **Version** : 8.0+ (recommandé)
   - **Username** : `root` ou autre
   - **Password** : Généré automatiquement (très sécurisé)

### 3. Variables d'environnement

Dans Railway, cliquez sur le **Web Service** → **"Variables"**

Ajoutez ces variables :

```
APP_NAME=Néré Mining
APP_ENV=production
APP_KEY=base64:VOTRE_CLE_ICI
APP_DEBUG=false
APP_URL=https://votre-domaine.com

# MySQL (Railway génère automatiquement ces variables)
# Mais assurez-vous que DB_HOST pointe vers le service MySQL
DB_CONNECTION=mysql
DB_HOST=${{ services.mysql.host }}
DB_PORT=${{ services.mysql.port }}
DB_DATABASE=${{ services.mysql.MYSQL_DATABASE }}
DB_USERNAME=${{ services.mysql.MYSQL_USERNAME }}
DB_PASSWORD=${{ services.mysql.MYSQL_PASSWORD }}

FORCE_HTTPS=true
SESSION_SECURE_COOKIE=true
```

**Générer APP_KEY :**
```bash
php artisan key:generate --show
```

Copier la clé générée et la coller dans `APP_KEY`.

### 4. Déploiement

1. Validez les variables ✅
2. Cliquez **"Deploy"**
3. Railway lance le build automatiquement
4. Les logs s'affichent en direct

### 5. Vérifier le déploiement

Une fois le build terminé :

1. Allez dans le **Web Service** → **"Domains"**
2. Vous verrez une URL type : `nere-mining-production-xxx.railway.app`
3. Visitez cette URL
4. Accédez à l'admin : `/gestion-nm`

### 6. Domaine personnalisé (optionnel)

1. Dans **"Domains"** → **"+ Add Domain"**
2. Entrez votre domaine (ex: `nere-mining.bf`)
3. Pointez votre DNS vers Railway (instructions fournies)
4. Certificate SSL est gratuit et automatique

## 🔧 Configuration Railway expliquée

### `railway.toml`
Fichier de configuration TOML qui définit :
- **Builder** : Nixpacks (gère PHP + dépendances)
- **Build command** : Installe Composer, compile assets
- **Start command** : Lance les migrations et Nginx

### `nixpacks.toml`
Définit les packages système nécessaires (PHP 8.5, Nginx, MySQL client)

### `nginx.conf`
Configuration Nginx pour écouter sur le port **8080** (port requis par Railway)

### `railway-start.sh`
Script de démarrage qui :
1. Attend que MySQL soit prêt
2. Lance les migrations
3. Crée le lien symbolique `storage`
4. Lance PHP-FPM + Nginx

## 📊 Monitoring

Dans Railway :
- **"Logs"** : Voir les logs en direct
- **"Metrics"** : CPU, RAM, I/O
- **"Deploys"** : Historique des déploiements

## 🔄 CI/CD automatique

À chaque push sur `production` :
1. GitHub notifie Railway
2. Railway clône le repo
3. Exécute le build (10-15 min)
4. Lance les migrations
5. Redéploie l'app

## 🆘 Dépannage

### Migration échoue
```
ERROR : Unknown MySQL server version
```
**Solution** : Vérifier `DB_HOST`, `DB_PORT`, identifiants

### Erreur "502 Bad Gateway"
Attendre 1-2 min que PHP-FPM démarre, puis rafraîchir

### App très lente
Vérifier les metrics Railway (CPU, RAM saturé)

### Base de données pleine
Nettoyer les anciennes migrations/logs :
```bash
php artisan model:prune --force
```

## 📈 Coûts Railway

- **Gratuit** : Les 5$ crédits initiaux
- Après : Pay-as-you-go (environ $5-15/mois pour une petite app)

Exemple :
- Web Service : ~$7/mois (0.5GB RAM)
- MySQL : ~$3/mois (1GB)
- **Total** : ~$10/mois

## 🔐 Sécurité

✅ **TOUJOURS activé sur Railway :**
- SSL/HTTPS gratuit
- Variables d'env chiffrées
- Backups MySQL automatiques (configurable)
- Logs persistants

✅ **À faire après déploiement :**
1. Changer le mot de passe admin
2. Vérifier les logs pour erreurs
3. Configurer les backups MySQL
4. Activer les alertes Railway

## 📚 Ressources

- [Railway Docs](https://docs.railway.app)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Nixpacks PHP Guide](https://nixpacks.com/docs/languages/php)

---

**Besoin d'aide ?** Consultez les logs Railway ou cette documentation.
