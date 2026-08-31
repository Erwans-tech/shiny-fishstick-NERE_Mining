# 🚀 Redéploiement sur Render

Guide pour redéployer l'application complète (backend + frontend) sur Render.

## ✅ Configuration existante

Tout est déjà configuré dans `render.yaml`:
- ✅ Web service Docker (PHP 8.4 + Laravel)
- ✅ PostgreSQL database
- ✅ Cloudflare R2 pour les uploads
- ✅ Nginx + PHP-FPM
- ✅ Supervisord pour les services

## 🚀 Redéployer en 3 étapes

### 1️⃣ Aller sur Render

```
https://render.com/dashboard
→ Sélectionner le service "nere-mining"
```

### 2️⃣ Forcer un rebuild

**Option A: Via le Dashboard**
- Cliquer **"Manual Deploy"** → **"Deploy latest commit"**
- Ou redéployer depuis un commit spécifique

**Option B: Via Git (auto)**
```bash
git push origin main  # ou production
# Render détecte automatiquement et redéploie
```

### 3️⃣ Attendre le build (~5-10 minutes)

**Logs de déploiement:**
1. Dashboard → "nere-mining" service
2. Voir l'onglet "Logs"
3. Suivre les étapes:
   - Build Docker
   - Migrations DB
   - Seed initial
   - Démarrage services

**Status:**
- 🟢 Green = En ligne
- 🟡 Yellow = Build/redémarrage
- 🔴 Red = Erreur

## 📊 Vérifier le déploiement

### URL publique
```
https://nere-mining.onrender.com
```

### Admin
```
https://nere-mining.onrender.com/gestion-nm
```

### Logs temps réel
- Dashboard → Logs tab
- Voir les erreurs en direct

## 🔧 Configuration Render

### Variables d'environnement

Toutes configurées dans `render.yaml`. Si besoin de les modifier:

1. Dashboard → "nere-mining"
2. Settings → Environment
3. Modifier et sauvegarder
4. Redéployer

### Base de données

**PostgreSQL (gratuit):**
- Host: Render interne
- Credentials: Automatique
- Backups: Gratuit 7j

**Vérifier la DB:**
```
Dashboard → Database "nere-mining-db"
```

### Cloudflare R2

Pour les uploads (optionnel, local suffisant):
1. Créer bucket R2 sur Cloudflare
2. Générer token d'accès
3. Dans Render: Ajouter env vars:
   - `R2_ACCESS_KEY_ID`
   - `R2_SECRET_ACCESS_KEY`
   - `R2_BUCKET`
   - `R2_ACCOUNT_ID`
   - `R2_PUBLIC_URL`

## 📈 Performance

### Optimisations actives
- ✅ OPcache activé (mise en cache bytecode PHP)
- ✅ Route caching (route:cache)
- ✅ Config caching (config:cache)
- ✅ View caching (view:cache)
- ✅ Nginx gzip compression
- ✅ Connection pooling

### Monitoring
- Dashboard → Metrics
- CPU, Memory, Disk usage
- Nombre de requêtes

## 🆘 Troubleshooting

### ❌ Build échoue

**Vérifier les logs:**
1. Dashboard → Logs
2. Chercher l'erreur exacte

**Problèmes courants:**

**Migrations échouent**
```
[ERREUR] Migrations echouees
→ Vérifier la DB
→ Vérifier les migrations dans database/migrations/
```

**Assets non compilés**
```
npm run build échoue
→ Vérifier package.json
→ Vérifier node_modules
```

**PHP Timeout**
```
→ Augmenter max_execution_time (actuellement 120s)
→ Vérifier Dockerfile
```

### ❌ Service Down (🔴 Red)

**Raisons courantes:**
1. Crash PHP-FPM
2. Connexion DB perdue
3. Disk plein
4. Memory plein

**Solutions:**
```
Dashboard → Manual Deploy
→ Redéployer
```

### ❌ 502 Bad Gateway

**Nginx ne peut pas joindre PHP-FPM**

Vérifier:
1. PHP-FPM écoute sur 127.0.0.1:9000
2. Nginx configuré pour se connecter là-bas
3. Logs PHP pour les erreurs

## 📝 Fichiers importants

| Fichier | Rôle |
|---------|------|
| `render.yaml` | Configuration Render |
| `Dockerfile` | Image Docker |
| `docker/start.sh` | Script de démarrage |
| `docker/nginx.conf` | Config Nginx |
| `docker/supervisord.conf` | Gestion services |

## 🔄 Cycle de déploiement

```
1. git push origin main
   ↓
2. Render détecte le commit
   ↓
3. Build l'image Docker (~3 min)
   ↓
4. Migrations + Seed (~2 min)
   ↓
5. Démarrage services (~1 min)
   ↓
6. ✅ En ligne
```

**Temps total: ~6-8 minutes**

## 💡 Tips production

✅ **Avant chaque push:**
- Tester localement
- Vérifier les migrations
- Vérifier les env vars

✅ **Monitoring:**
- Vérifier les logs quotidiens
- Monitorer l'usage disque
- Backups DB automatiques

✅ **Rollback:**
- Si besoin: redéployer un ancien commit
- Dashboard → Deployments → History
- Sélectionner le commit et "Redeploy"

## 📞 Support

- [Render Docs](https://render.com/docs)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- Dashboard → Help & Support

## 🎉 Tout est prêt!

L'application est complètement configurée et prête à être redéployée sur Render à tout moment.
