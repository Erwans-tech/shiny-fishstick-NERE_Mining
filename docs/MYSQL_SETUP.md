# 🗄️ Configuration MySQL - Local + Render

## ✅ Configuration Actuelle

```
Local (.env):
✓ DB_CONNECTION=mysql
✓ DB_HOST=127.0.0.1
✓ DB_PORT=3306
✓ DB_DATABASE=nere_mining
✓ DB_USERNAME=root
✓ DB_PASSWORD=

Production (.env.production):
✓ DB_CONNECTION=mysql
✓ À remplir avec credentials Render
```

---

## 📋 Prérequis

- [ ] Laragon installé (ou MySQL installé localement)
- [ ] MySQL lancé et fonctionnant
- [ ] Laravel app en local

---

## 1️⃣ Installation Locale MySQL

### Option A : Via Laragon (Recommandé)

```
1. Téléchargez: https://laragon.org/download/
2. Installez Laragon (version standard)
3. Laragon Control Panel → Services → MySQL → Start
✅ MySQL prêt !
```

### Option B : MySQL Standalone

```
1. Téléchargez: https://dev.mysql.com/downloads/mysql/
2. Installez MySQL Community Server
3. Port: 3306
4. User: root
5. Password: (vide ou votre choix)
```

---

## 2️⃣ Créer la Base Locale

### Via Laragon/phpMyAdmin

```
1. Laragon Control Panel → phpMyAdmin
2. Créer une base: nere_mining
3. UTF-8 encoding
✅ Base créée !
```

### Via Terminal

```powershell
# Connecter à MySQL
mysql -u root -h 127.0.0.1

# Dans le terminal MySQL:
CREATE DATABASE nere_mining CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Vérifier
SHOW DATABASES;

# Quitter
exit;
```

---

## 3️⃣ Tester la Connexion Laravel

```bash
cd c:\Users\erwan\OneDrive\Bureau\REFONTESITE

# Tester la connexion
php artisan tinker
>>> DB::connection()->getPdo()
# Devrait afficher: PDOConnection object
```

Si erreur, vérifiez :
- [ ] MySQL est lancé
- [ ] Base `nere_mining` existe
- [ ] `.env` correctement configuré

---

## 4️⃣ Lancer les Migrations

```bash
php artisan migrate
```

**Résultat attendu:**
```
Migrating: 2024_...
Migrated: 2024_...
...
```

---

## 5️⃣ Tester Localement

```bash
php artisan serve
```

Visitez: http://localhost:8000

✅ **Développement local MySQL prêt !**

---

## 🚀 Production : MySQL sur Render

### 1. Créer MySQL sur Render

```
Render Dashboard → New → MySQL
Name: nere-mining-db
Database: nere_mining
User: nere_user (ou root)
Password: (généré par Render)
Region: Frankfurt / Paris
Plan: Starter ($14/mois) ou Starter+ ($29/mois)
```

### 2. Credentials

Render affichera :
```
Host: xxxxx.render.com
Port: 3306
Database: nere_mining
User: nere_user
Password: xxxxxxxxxxxx
```

### 3. Configurer Web Service

**Web Service Settings → Environment**

Mettez à jour :
```
DB_CONNECTION=mysql
DB_HOST=xxxxx.render.com
DB_PORT=3306
DB_DATABASE=nere_mining
DB_USERNAME=nere_user
DB_PASSWORD=xxxxxxxxxxxx
```

### 4. Déployer

```bash
git push origin main:production
```

Render exécutera :
```
Procfile: release: php artisan migrate --force
```

✅ **Migrations automatiques !**

---

## ✅ Vérification

### Local

```bash
# Voir les tables
mysql -u root nere_mining -e "SHOW TABLES;"

# Via Laravel
php artisan db:show
```

### Production

```
Render Dashboard → MySQL → Logs
Devrait afficher: "MySQL server has started and is accepting connections"
```

---

## 🔧 Troubleshooting

### "Access denied for user 'root'@'127.0.0.1'"
- Le password est incorrect
- Solution: Vérifiez DB_PASSWORD dans .env

### "Can't connect to MySQL server on '127.0.0.1'"
- MySQL n'est pas lancé
- Solution: Démarrez MySQL (Laragon ou Windows Services)

### "Unknown database 'nere_mining'"
- La base n'existe pas
- Solution: Créez-la avec phpMyAdmin ou terminal

### "Migrations table not found"
- Les tables n'existent pas
- Solution: `php artisan migrate` pour les créer

---

## 📊 Fichiers Modifiés

```
.env                  → MySQL local
.env.production       → MySQL Render
Procfile              → Déjà configuré
render.yaml           → Optionnel
```

---

## 🎉 Workflow Complet

```bash
# 1. Local: développer
php artisan serve

# 2. Local: tester migrations
php artisan migrate

# 3. Commit et push
git add .
git commit -m "feat: new feature"
git push origin main:production

# 4. Render:
#    - Build (composer + npm)
#    - Release (php artisan migrate --force)
#    - Start (Apache)
#    - Live ✓

# 5. Production MySQL Render:
#    - App + MySQL accessibles
#    - Prêt pour utilisateurs
```

---

## 💡 Tips

### Backup Local MySQL
```bash
mysqldump -u root nere_mining > backup.sql
```

### Restore
```bash
mysql -u root nere_mining < backup.sql
```

### Voir les bases
```bash
mysql -u root -e "SHOW DATABASES;"
```

---

## 📚 Ressources

- MySQL Docs: https://dev.mysql.com/doc/
- Laravel MySQL: https://laravel.com/docs/database#mysql
- Render MySQL: https://render.com/docs/databases
- Laragon: https://laragon.org/

---

## ✨ Résumé

| Aspect | Local | Render |
|--------|-------|--------|
| **DB** | MySQL local | MySQL managé |
| **Host** | 127.0.0.1 | render.com |
| **Port** | 3306 | 3306 |
| **User** | root | nere_user |
| **Database** | nere_mining | nere_mining |

**Configuration identique, juste les credentials qui changent.**

---

## 🎯 Prochaines Étapes

1. ✅ Installer Laragon
2. ✅ Créer base `nere_mining`
3. ✅ Lancer migrations
4. ✅ Tester localement
5. ✅ Créer MySQL Render
6. ✅ Configurer Web Service
7. ✅ Déployer

**Status:** ⏳ À configurer
