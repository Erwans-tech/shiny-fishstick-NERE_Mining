# 🗄️ Configuration Base de Données

## 📋 **ARCHITECTURE**

| Environnement | Base de Données | Configuration |
|---------------|----------------|---------------|
| **Local (dev)** | MySQL | `.env` (DB_CONNECTION=mysql) |
| **Render (prod)** | SQLite | `render.yaml` + Docker |

---

## 🏠 **DÉVELOPPEMENT LOCAL (MySQL)**

### **1️⃣ Prérequis**

- **XAMPP** / **MAMP** / **Laragon** / **MySQL standalone**
- PHP 8.2+
- Composer

### **2️⃣ Configuration**

Le fichier `.env` est déjà configuré pour MySQL local :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nere_mining
DB_USERNAME=root
DB_PASSWORD=
```

### **3️⃣ Créer la base de données**

**Option A : Via phpMyAdmin**
1. Ouvrez http://localhost/phpmyadmin
2. Créez une base `nere_mining`
3. Encodage : `utf8mb4_unicode_ci`

**Option B : Via CLI MySQL**
```bash
mysql -u root -p
CREATE DATABASE nere_mining CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### **4️⃣ Exécuter les migrations**

```bash
php artisan migrate
```

### **5️⃣ Démarrer le serveur local**

```bash
php artisan serve
```

Accédez à : http://localhost:8000

---

## 🚀 **PRODUCTION RENDER (SQLite)**

### **Configuration automatique**

Le fichier `render.yaml` configure automatiquement SQLite :

```yaml
envVars:
  - key: DB_CONNECTION
    value: sqlite
  - key: DB_DATABASE
    value: /var/www/html/database/database.sqlite
```

### **Migrations automatiques**

Le script `docker-start.sh` exécute automatiquement :

```bash
php artisan migrate --force
```

Au démarrage du conteneur Docker sur Render.

---

## 🔄 **SYNCHRONISATION DES DONNÉES**

### **Exporter depuis MySQL local**

```bash
php artisan db:seed --class=DatabaseSeeder
```

### **Peupler avec des données de test**

```bash
# Créer un seeder
php artisan make:seeder TestDataSeeder

# Exécuter
php artisan db:seed --class=TestDataSeeder
```

---

## 🛠️ **COMMANDES UTILES**

### **Local (MySQL)**

```bash
# Voir le statut de la connexion
php artisan tinker
>>> DB::connection()->getPdo();

# Réinitialiser la base
php artisan migrate:fresh

# Réinitialiser avec seeders
php artisan migrate:fresh --seed

# Vérifier les migrations
php artisan migrate:status
```

### **Render (SQLite)**

Les commandes s'exécutent via le **Render Shell** :

1. Dashboard → Service → **Shell**
2. Exécutez :
   ```bash
   php artisan migrate:status
   php artisan db:show
   ```

---

## 📊 **DIFFÉRENCES MySQL vs SQLite**

| Fonctionnalité | MySQL | SQLite |
|----------------|-------|--------|
| **Type** | Serveur | Fichier local |
| **Performance** | ⭐⭐⭐⭐⭐ | ⭐⭐⭐⭐ |
| **Concurrence** | Excellente | Limitée |
| **Setup** | Nécessite serveur | Aucun |
| **Migrations** | Identiques | Identiques |
| **Seeders** | Identiques | Identiques |

### **Compatibilité**

Les migrations Laravel sont compatibles entre MySQL et SQLite tant que vous évitez :
- ❌ Fonctions MySQL spécifiques (`HOUR()`, `DATE_FORMAT()`)
- ✅ Utilisez Query Builder Laravel (compatible partout)

---

## ⚠️ **PROBLÈMES CONNUS**

### **Erreur : "Base 'nere_mining' does not exist"**

**Solution :**
```bash
mysql -u root -p -e "CREATE DATABASE nere_mining;"
```

### **Erreur : "Access denied for user 'root'@'localhost'"**

**Solution :**
1. Vérifiez que MySQL est démarré (XAMPP/MAMP)
2. Ajustez `DB_PASSWORD` dans `.env` si nécessaire

### **Render : "table does not exist"**

**Solution :**
1. Render Shell → `php artisan migrate --force`
2. Ou visitez : https://votre-app.onrender.com/run-migrations-now

---

## 🎯 **BONNES PRATIQUES**

### **Développement**
- ✅ Utilisez MySQL localement (plus proche de la prod réelle)
- ✅ Testez les migrations sur MySQL avant commit
- ✅ Seeders pour données de test

### **Production**
- ✅ SQLite pour Render (simple, gratuit, suffisant)
- ✅ Migrations automatiques au déploiement
- ✅ Backups réguliers si données importantes

---

## 🔐 **SÉCURITÉ**

### **Local**
- ❌ Ne commitez **JAMAIS** le fichier `.env`
- ✅ `.env` est dans `.gitignore`
- ✅ Utilisez `.env.example` comme template

### **Production**
- ✅ `APP_DEBUG=false` en production
- ✅ `APP_ENV=production`
- ✅ Variables sensibles via Render Dashboard (pas en dur)

---

## 📞 **SUPPORT**

- Laravel Database : https://laravel.com/docs/11.x/database
- Render Docs : https://render.com/docs
- SQLite : https://www.sqlite.org/docs.html

---

✅ **Configuration validée et testée !**
