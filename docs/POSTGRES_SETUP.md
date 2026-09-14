# 🐘 Configuration PostgreSQL - Local + Render

## 🎯 Objectif

- ✅ PostgreSQL en local (développement)
- ✅ PostgreSQL sur Render (production)
- ✅ Same database, same config

---

## 📋 Prérequis

- [ ] PostgreSQL 16 installé localement
- [ ] pgAdmin ou DBeaver (optionnel, pour UI)
- [ ] Laravel configuré

---

## 1️⃣ Installation Locale PostgreSQL

### Option A : Installer PostgreSQL Standalone

**Windows :**
1. Téléchargez : https://www.postgresql.org/download/windows/
2. Lancez l'installateur PostgreSQL 16
3. Configuration :
   - Port : **5432**
   - User : **postgres**
   - Password : **postgres** (ou votre choix)
4. Finalisez l'installation

**Vérifier :**
```powershell
# Devrait afficher la version
psql --version
```

### Option B : PostgreSQL dans XAMPP (si disponible)
```
XAMPP Control Panel → Services → PostgreSQL → Start
```

---

## 2️⃣ Configuration Laravel Local

### Fichier `.env`

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nere_mining_dev
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

**Changez le password si vous en avez mis un autre à l'installation.**

### Créer la Base de Données

**Option 1 : Via psql (terminal)**
```powershell
# Connectez-vous à PostgreSQL
$env:PGPASSWORD = "postgres"
psql -U postgres -h 127.0.0.1

# Dans psql, tapez :
CREATE DATABASE nere_mining_dev ENCODING 'UTF8';

# Quitter avec : \q
```

**Option 2 : Via pgAdmin (UI)**
1. Ouvrez pgAdmin
2. Right-click "Databases" → Create → Database
3. Name: `nere_mining_dev`
4. Save

### Vérifier la Connexion

```bash
# Dans le repo Laravel
cd c:\Users\erwan\OneDrive\Bureau\REFONTESITE

# Tester la connexion
php artisan tinker
DB::connection()->getPdo() ? dd('✓ Connecté à PostgreSQL') : dd('✗ Erreur')

# Ou via une commande simple
php artisan db:table users
```

### Lancer les Migrations

```bash
php artisan migrate --fresh
```

---

## 3️⃣ Configuration Production (Render)

### Créer une Base PostgreSQL sur Render

1. **Dashboard Render :** https://dashboard.render.com
2. **New :** PostgreSQL
3. **Configurer :**
   - Name: `nere-mining-db`
   - Database: `nere_mining`
   - User: `nere_user`
   - Region: Frankfurt ou Paris
   - Plan: Free ou Standard

4. **Copier les credentials** affichés

### Variables d'Environnement Render

Sur le dashboard de votre **Web Service**, allez dans **Settings → Environment**

Ajoutez :
```
DB_CONNECTION=pgsql
DB_HOST=<hostname from Render PostgreSQL>
DB_PORT=5432
DB_DATABASE=nere_mining
DB_USERNAME=<username>
DB_PASSWORD=<password>
```

**Exemple (à remplacer) :**
```
DB_CONNECTION=pgsql
DB_HOST=dpg-xxxxx.render.com
DB_PORT=5432
DB_DATABASE=nere_mining
DB_USERNAME=nere_user
DB_PASSWORD=your_secure_password_here
```

---

## ✅ Vérification

### Local
```bash
# Tester la connexion
php artisan tinker
>>> DB::connection()->getPdo()
# Devrait afficher: PDOConnection object

# Voir les tables
>>> DB::table('information_schema.tables')->where('table_schema', 'public')->get()
```

### Production (Render)
```
Allez à Render Dashboard → PostgreSQL → Logs
Devrait afficher: "Ready to accept connections"
```

---

## 🔧 Troubleshooting

### "connection refused"
- PostgreSQL n'est pas lancé
- Solution : Démarrez PostgreSQL (Windows Services ou XAMPP)

### "role does not exist"
- L'utilisateur `postgres` n'existe pas
- Solution : Vérifiez le username lors de l'install

### "database does not exist"
- La base n'a pas été créée
- Solution : Créez-la avec pgAdmin ou psql

### "SSL connection error" (sur Render)
- Render requiert SSL pour PostgreSQL
- Laravel le fait automatiquement - pas d'action requise

---

## 📊 Fichiers Modifiés

```
.env                  → DB_CONNECTION=pgsql (local)
.env.production       → DB_CONNECTION=pgsql (production)
Procfile              → Pas de changement
render.yaml           → À mettre à jour
```

---

## 🚀 Workflow Complet

```bash
# 1. Local : modifier code
vim app/Models/User.php

# 2. Local : tester avec PostgreSQL
php artisan migrate
php artisan serve

# 3. Commit et push
git add .
git commit -m "feat: new feature"
git push origin main:production

# 4. Render déploie
# - Récupère le code
# - Exécute migrations (PostgreSQL Render)
# - App en ligne

# 5. Production utilise PostgreSQL Render
```

---

## 💡 Tips

### Backup Local PostgreSQL
```bash
pg_dump -U postgres nere_mining_dev > backup.sql
```

### Restore
```bash
psql -U postgres nere_mining_dev < backup.sql
```

### Voir les tables
```bash
# Via psql
\dt

# Via Laravel
php artisan db:show
```

---

## 📚 Ressources

- PostgreSQL Docs : https://www.postgresql.org/docs/
- Laravel PostgreSQL : https://laravel.com/docs/database#postgresql
- Render PostgreSQL : https://render.com/docs/databases
- pgAdmin : https://www.pgadmin.org/

---

## ✨ Résumé

| Aspect | Local | Render |
|--------|-------|--------|
| **DB** | PostgreSQL local | PostgreSQL managé |
| **Host** | 127.0.0.1 | render.com domain |
| **Port** | 5432 | 5432 |
| **User** | postgres | votre user |
| **Database** | nere_mining_dev | nere_mining |

**Configuration identique, juste les credentials qui changent.**

---

**Status :** ⏳ À configurer localement
**Prochaines étapes :**
1. Installer PostgreSQL localement
2. Créer la base `nere_mining_dev`
3. Lancer migrations
4. Tester localement
5. Configurer Render PostgreSQL
6. Déployer
