# 🐘 Guide : Récupérer les infos de connexion PostgreSQL Supabase

## 🚀 Étape 1 : Créer un compte Supabase

1. **Va sur** : [https://supabase.com](https://supabase.com)
2. **Clique** sur "Start your project" (bouton vert)
3. **Connecte-toi** avec GitHub/Google ou crée un compte email

## 📁 Étape 2 : Créer un nouveau projet

1. **Clique** sur "New project" 
2. **Remplis** les informations :
   - **Name** : `nere-mining` (ou le nom que tu veux)
   - **Database Password** : Génère un mot de passe FORT (garde-le précieusement !)
   - **Region** : `Europe West (Frankfurt)` ou `Europe Central` (plus proche de la France)
   - **Pricing Plan** : Gratuit pour commencer

3. **Clique** "Create new project"
4. ⏳ **Attends** 2-3 minutes que le projet se crée

## 🔍 Étape 3 : Récupérer les infos de connexion

### 🎯 Méthode 1 : Via le bouton "Connect" (PLUS FACILE)

1. **Dans ton dashboard Supabase**, clique sur le bouton **"Connect"** (en haut à droite)
2. **Sélectionne** "Direct connection" ou "Pooler" selon tes besoins :
   - **Direct connection** : Pour Render (persistant)
   - **Transaction mode** : Pour serverless/edge functions

3. **Tu verras** une fenêtre avec toutes les infos :
   ```
   Host: db.abcdefghijklmnop.supabase.co
   Database: postgres  
   Port: 5432 (direct) ou 6543 (pooler)
   User: postgres
   Password: [ton mot de passe]
   ```

4. **Copie** directement la connection string complète :
   ```
   postgresql://postgres.[ref]:[password]@aws-0-eu-central-1.pooler.supabase.com:5432/postgres
   ```

### 🔧 Méthode 2 : Via Settings → Database (détaillée)

1. **Clique** sur l'icône ⚙️ "Settings" dans la sidebar gauche
2. **Clique** sur "Database" 
3. **Scroll** jusqu'à la section "Connection info"

Tu y trouveras :
- **Host** : `db.xxx.supabase.co` 
- **Database name** : `postgres`
- **Port** : `5432`
- **User** : `postgres` 
- **Password** : Reset si oublié

### 🌍 Choisir le bon mode de connexion

Pour **Render + Laravel**, utilise :
- **Direct connection** (port 5432) : Recommandé pour Render
- **IPv4** : Render utilise IPv4, donc ça marche parfaitement

## 📋 Étape 4 : Copier dans ton .env

### Option A : Variables séparées (recommandé)
```env
DB_CONNECTION=pgsql
DB_HOST=db.abcdefghijklmnop.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=ton_mot_de_passe_supabase
```

### Option B : URL complète (alternative)
```env
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://postgres:ton_mot_de_passe@db.abcdefghijklmnop.supabase.co:5432/postgres
```

## 🔐 Étape 5 : Infos supplémentaires (pour plus tard)

Dans **Settings → API**, tu trouveras aussi :
- **Project URL** : `https://abcdefghijklmnop.supabase.co`
- **anon public key** : `eyJ0...` (pour l'auth frontend)
- **service_role secret** : `eyJ0...` (pour l'admin backend)

## ⚠️ Sécurité importante

1. **JAMAIS** committer le mot de passe dans Git
2. **Utilise** des variables d'environnement
3. **Active** Row Level Security pour la production :
   ```sql
   ALTER TABLE ma_table ENABLE ROW LEVEL SECURITY;
   ```

## 🧪 Tester la connexion

### Test rapide avec psql (si installé)
```bash
psql "postgresql://postgres:MOT_DE_PASSE@db.xxx.supabase.co:5432/postgres"
```

### Test avec Laravel
```bash
php artisan tinker
>>> DB::connection()->getPdo();
# Si ça retourne un objet PDO, c'est bon !
```

## 📱 Interface Supabase

L'interface web te permet de :
- **Voir tes tables** (onglet "Table Editor")
- **Exécuter du SQL** (onglet "SQL Editor") 
- **Voir les logs** (onglet "Logs")
- **Gérer l'auth** (onglet "Authentication")

## 🔄 Migration des données

Si tu as des données à migrer depuis Railway MySQL :

### Étape 1 : Export MySQL
```bash
mysqldump -h old-host -u user -p database > backup.sql
```

### Étape 2 : Convertir avec un outil en ligne
- [MySQL to PostgreSQL Converter](https://www.rebasedata.com/convert-mysql-to-postgresql-online)
- Ou utilise `pgloader`

### Étape 3 : Import dans Supabase
Via l'interface SQL Editor ou :
```bash
psql "postgresql://postgres:pass@db.xxx.supabase.co:5432/postgres" < converted.sql
```

## 🎯 Exemple concret pour Laravel

Voici exactement ce que tu dois mettre dans **Render dashboard** :

```
DB_CONNECTION=pgsql
DB_HOST=db.abcdefghijklmnop.supabase.co
DB_PORT=5432  
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=le_mot_de_passe_que_tu_as_choisi
```

## 🆘 Problèmes courants

### "Connection refused"
- Vérifie que l'IP de Render est autorisée (normalement auto)
- Vérifie le mot de passe (pas d'espaces, caractères spéciaux)

### "Database does not exist"  
- Utilise toujours `postgres` comme nom de DB
- Pas `laravel` ou autre

### "SSL required"
- Ajoute `sslmode=require` si nécessaire :
  ```env
  DB_SSLMODE=require
  ```

## 📞 Support

- **Documentation** : [https://supabase.com/docs](https://supabase.com/docs)
- **Discord** : Community très active
- **GitHub Issues** : Pour les bugs techniques

---

💡 **Conseil** : Une fois connecté, utilise l'interface Supabase pour créer tes premières tables et explorer. C'est très intuitif !