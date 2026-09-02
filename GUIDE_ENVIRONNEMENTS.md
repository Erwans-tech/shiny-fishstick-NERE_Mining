# 🔄 Guide des Environnements : MySQL Local vs PostgreSQL Production

## 📋 Récapitulatif des configurations

### 🏠 **Local (Développement)**
```env
# MySQL local pour développement
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nere_mining
DB_USERNAME=root
DB_PASSWORD=[ton_mot_de_passe_mysql_local]
```

### 🚀 **Production (Render + Supabase)**
```env
# PostgreSQL Supabase pour production
DB_CONNECTION=pgsql
DB_HOST=db.plibklblcykfhnoboqum.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=4kuAbwAFxDb1nD03
```

## 🔧 Avantages de cette approche

### ✅ **Pourquoi MySQL en local ?**
- Plus simple à installer (XAMPP, WAMP, Laragon)
- Outils graphiques familiers (phpMyAdmin)
- Pas besoin de connexion internet
- Performance optimale en local

### ✅ **Pourquoi PostgreSQL en production ?**
- Base de données plus robuste et moderne
- Meilleure conformité SQL
- Performances supérieures à grande échelle
- Intégration native avec Supabase
- Fonctionnalités avancées (JSON, arrays, etc.)

## 🗃️ Migration de données

### Option 1 : Migrations Laravel (Recommandé)
Les migrations Laravel sont **compatibles** entre MySQL et PostgreSQL :
```bash
# En local (MySQL)
php artisan migrate

# En production (PostgreSQL) - automatique via Render
php artisan migrate --force
```

### Option 2 : Export/Import si données existantes

Si tu as déjà des données en MySQL local :

#### Export MySQL local :
```bash
mysqldump -u root -p nere_mining > backup_mysql.sql
```

#### Conversion MySQL → PostgreSQL :
1. **Outil en ligne** : [RebaseData Converter](https://www.rebasedata.com/convert-mysql-to-postgresql-online)
2. **Outil local** : `pgloader`
3. **Manuel** : Adapter les requêtes SQL

#### Import dans Supabase :
```bash
psql "postgresql://postgres:4kuAbwAFxDb1nD03@db.plibklblcykfhnoboqum.supabase.co:5432/postgres" < backup_postgresql.sql
```

## 🔄 Fichiers de configuration

### `.env` (Local MySQL)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nere_mining
DB_USERNAME=root
DB_PASSWORD=ton_mot_de_passe_local
```

### `.env.render` (Production PostgreSQL)
```env
DB_CONNECTION=pgsql
DB_HOST=db.plibklblcykfhnoboqum.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=4kuAbwAFxDb1nD03
```

### `.env.supabase` (Test local avec Supabase)
```env
# Pour tester Supabase en local si besoin
DB_CONNECTION=pgsql
DB_HOST=db.plibklblcykfhnoboqum.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=4kuAbwAFxDb1nD03
```

## 🚀 Workflow de développement

### 1. **Développement local**
```bash
# Utilise MySQL local
cp .env.example .env
# Édite .env avec tes infos MySQL
php artisan migrate
php artisan serve
```

### 2. **Test avec Supabase** (optionnel)
```bash
# Teste avec la vraie DB de production
cp .env.supabase .env
php artisan migrate:status
# Remet .env local après test
cp .env.local .env  # ou reconfigure
```

### 3. **Déploiement production**
```bash
git push origin main
# Render utilise automatiquement les variables d'environnement PostgreSQL
```

## 🛠️ Commandes utiles

### Vérifier la connexion active :
```bash
php artisan tinker
>>> DB::connection()->getDriverName()
# Retourne "mysql" ou "pgsql"
```

### Reset migrations :
```bash
# Local MySQL
php artisan migrate:fresh

# Production (via Render logs)
php artisan migrate:fresh --force
```

### Backup rapide :
```bash
# MySQL local
php artisan db:backup  # si package installé

# PostgreSQL Supabase (via interface web)
# Ou commande directe :
pg_dump "postgresql://postgres:4kuAbwAFxDb1nD03@db.plibklblcykfhnoboqum.supabase.co:5432/postgres" > backup.sql
```

## 💡 Conseils

### ✅ **Bonnes pratiques**
- Garde MySQL en local pour le développement quotidien
- Teste occasionnellement avec PostgreSQL avant un gros déploiement
- Utilise des migrations Laravel plutôt que du SQL brut
- Évite les fonctions spécifiques à MySQL (`LIMIT` vs `OFFSET`)

### ⚠️ **Points d'attention**
- **Types de données** : `TINYINT` (MySQL) → `SMALLINT` (PostgreSQL)
- **Boolean** : `TINYINT(1)` (MySQL) → `BOOLEAN` (PostgreSQL)  
- **JSON** : Support natif meilleur en PostgreSQL
- **Syntaxe** : `LIMIT 10` vs `LIMIT 10 OFFSET 0`

### 🔍 **Différences courantes à surveiller**

| Fonctionnalité | MySQL | PostgreSQL |
|---|---|---|
| **Auto-increment** | `AUTO_INCREMENT` | `SERIAL` ou `IDENTITY` |
| **Guillemets** | Backticks `table` | Quotes "table" |
| **Case sensitivity** | Insensible | Sensible |
| **Date format** | Plus flexible | Plus strict |
| **LIMIT** | `LIMIT 10` | `LIMIT 10` (identique) |
| **Boolean** | `TINYINT(1)` | `BOOLEAN` |

---

💡 **Résumé** : Tu continues à développer avec MySQL local, et la production utilise PostgreSQL Supabase. Laravel gère automatiquement les différences ! 🎯