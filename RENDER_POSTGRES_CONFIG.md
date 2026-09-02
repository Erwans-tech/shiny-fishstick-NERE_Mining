# 🐘 Configuration Render PostgreSQL

## ✅ Objectif

Utiliser PostgreSQL managé par Render pour la production, avec les migrations automatiques.

---

## 1️⃣ Créer PostgreSQL sur Render

### Dashboard Render
1. Allez à: https://dashboard.render.com
2. Cliquez: **"New +"** → **"PostgreSQL"**

### Configuration
```
Name:                  nere-mining-db
Database Name:         nere_mining
User:                  nere_user (ou votre choix)
Region:                Frankfurt / Paris
Plan:                  Starter ($7/month) ou Free (temporaire)
```

### Après Création
Render vous affichera les credentials :
```
Host:       dpg-xxxxx.render.com
Port:       5432
Database:   nere_mining
User:       nere_user
Password:   xxxxxxxxxxxx
```

**Copiez ces valeurs - vous les mettrez dans votre Web Service.**

---

## 2️⃣ Configurer le Web Service Render

Votre Web Service (nere-mining) a besoin de connaître la BD PostgreSQL.

### Settings → Environment

Allez dans votre **Web Service Render** (pas la BD)
- **Settings** → **Environment**

Mettez à jour les variables (ou ajoutez-les) :

```
DB_CONNECTION=pgsql
DB_HOST=dpg-xxxxx.render.com
DB_PORT=5432
DB_DATABASE=nere_mining
DB_USERNAME=nere_user
DB_PASSWORD=your_password_here
```

**Changez les valeurs avec celles que Render vous a données.**

---

## 3️⃣ Vérifier la Connectivité

### Depuis le Dashboard Render

1. Allez à votre **Web Service**
2. **Logs** → Regardez l'historique
3. Cherchez: "Starting crash recovery from checkpoint" ou "ready for connections"

Si vous voyez une erreur de connexion, vérifiez :
- [ ] Host correct (sans https://)
- [ ] Port 5432
- [ ] Password exact (attention aux caractères spéciaux)
- [ ] Base de données existe

---

## 4️⃣ Migrations Automatiques

Render exécute automatiquement les migrations via le **Procfile**.

### Procfile existant
```
web: vendor/bin/heroku-php-apache2 public/
release: php artisan migrate --force
```

✅ C'est déjà configuré !

Le hook `release:` exécutera `php artisan migrate` **avant** de lancer l'app.

---

## 5️⃣ Tester la Connection

### Via Render Dashboard

**Web Service → Logs** (lors d'un déploiement)

Vous devriez voir :
```
Migrating...
Migrated: ...
Migrated: ...
Service is live ✓
```

### Via votre App

Une fois en production :
```bash
# Sur Render, vous pouvez tester via SSH
# Render Dashboard → Service → Console

php artisan db:show
# Devrait afficher les infos PostgreSQL
```

---

## 6️⃣ Sauvegarde et Backup

### Render PostgreSQL

Render propose des **backups automatiques** (selon votre plan).

Pour un backup manuel :

```bash
# Localement
pg_dump -h dpg-xxxxx.render.com -U nere_user -d nere_mining > backup.sql

# Vous serez demandé le password
```

### Restaurer

```bash
psql -h dpg-xxxxx.render.com -U nere_user -d nere_mining < backup.sql
```

---

## 7️⃣ Exemple Complet

### .env.production (mis à jour)

```env
APP_NAME="Nere Mining"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xxxxx

DB_CONNECTION=pgsql
DB_HOST=dpg-xxxxx.render.com
DB_PORT=5432
DB_DATABASE=nere_mining
DB_USERNAME=nere_user
DB_PASSWORD=your_secure_password

LOG_CHANNEL=stack
LOG_LEVEL=info

MAIL_MAILER=smtp
MAIL_HOST=your_smtp
...
```

### Deployment Flow

```
1. git push origin main:production
2. GitHub Actions déclenché
3. Render récupère le code
4. Procfile: release: php artisan migrate --force
5. Migrations exécutées sur PostgreSQL Render
6. Service démarré
7. App en ligne ✓
```

---

## 🆚 Comparaison MySQL vs PostgreSQL

| Aspect | MySQL | PostgreSQL |
|--------|-------|-----------|
| **Stabilité** | Bon | Excellent |
| **Performance** | Bon | Très bon |
| **JSON Support** | Limité | Excellent |
| **Transactions** | InnoDB | Native |
| **Scalabilité** | Moyenne | Excellente |
| **Render** | Possible | Natif |

Vous avez fait le bon choix ! PostgreSQL est plus stable et performant.

---

## 🔧 Troubleshooting

### "Connection refused"
- La BD PostgreSQL n'existe pas
- Solution: Créez-la sur Render Dashboard

### "Role does not exist"
- L'utilisateur n'existe pas
- Solution: Utilisez le username correct (par défaut: `nere_user`)

### "Database does not exist"
- Solution: Vérifiez le nom exact de la BD

### "SSL connection error"
- Render force SSL pour PostgreSQL
- Laravel le gère automatiquement
- Pas d'action requise

### Migrations ne s'exécutent pas
- Vérifiez le Procfile: `release: php artisan migrate --force`
- Consultez les logs Render

---

## 📊 Monitoring

### Logs Render
```
Service → Logs
Cherchez: "Migrating..." ou erreurs
```

### Metrics Render
```
Service → Metrics
Consultez: CPU, Memory, Disk
```

### PostgreSQL Stats
```bash
# Via psql
SELECT * FROM pg_stat_database WHERE datname = 'nere_mining';

# Via Laravel
php artisan db:show
```

---

## ✨ Résumé

| Étape | Action | Status |
|-------|--------|--------|
| 1 | Créer PostgreSQL Render | ✅ À faire |
| 2 | Configurer Web Service Env | ✅ À faire |
| 3 | Vérifier Procfile | ✅ Fait |
| 4 | Tester localement | ✅ À faire |
| 5 | Déployer | ✅ À faire |
| 6 | Vérifier migrations | ✅ À faire |

---

## 🚀 Workflow Complet

```bash
# Local: développement
php artisan migrate
php artisan serve

# Commit et push
git push origin main:production

# Render:
# 1. Build (composer + npm)
# 2. Release (migrations)
# 3. Start (Apache + PHP)
# 4. Live ✓

# Production: app + PostgreSQL
# Accessible sur votre URL Render
```

---

## 📞 Support

- [Render Docs - PostgreSQL](https://render.com/docs/databases)
- [Laravel PostgreSQL](https://laravel.com/docs/database#postgresql)
- [PostgreSQL Documentation](https://www.postgresql.org/docs/)

---

**Configuration PostgreSQL + Render : Prête ! 🐘**
