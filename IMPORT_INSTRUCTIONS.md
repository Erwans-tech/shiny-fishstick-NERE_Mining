# 🚀 Instructions d'importation des données sur Render/Supabase

## ⚠️ IMPORTANT
Le site est déployé sur Render mais la base de données est VIDE. 
Vous devez importer les données de votre base locale vers Supabase.

## 📋 Méthode 1 : Via l'interface Supabase (RECOMMANDÉ)

### Étapes :

1. **Ouvrez Supabase Dashboard**
   - URL : https://supabase.com/dashboard/project/plibklblcykfhnoboqum
   - Connectez-vous avec vos identifiants

2. **Accédez à l'éditeur SQL**
   - Dans le menu de gauche, cliquez sur **"SQL Editor"**
   - Cliquez sur **"+ New query"**

3. **Exécutez le script**
   - Ouvrez le fichier `import_production_data.sql` dans votre éditeur
   - Copiez TOUT le contenu (159 lignes)
   - Collez dans l'éditeur SQL de Supabase
   - Cliquez sur **"Run"** (ou Ctrl+Enter)

4. **Vérifiez les résultats**
   Vous devriez voir :
   ```
   table_name            | count
   ----------------------+-------
   hero_slides           | 5
   leadership_members    | 5
   partners              | 1
   news                  | 3
   karma_departments     | 9
   site_settings         | 12
   ```

5. **Testez le site**
   - Visitez : https://nere-mining-ex3a.onrender.com
   - Le carousel devrait afficher vos 4 images + 1 vidéo
   - Les actualités, leadership, et partenaires devraient s'afficher

## 📋 Méthode 2 : Via psql (ligne de commande)

Si vous préférez utiliser la ligne de commande :

```powershell
$env:PGPASSWORD="4kuAbwAFxDb1nD03"
psql -h aws-0-eu-central-1.pooler.supabase.com -p 6543 -U postgres.plibklblcykfhnoboqum -d postgres -f import_production_data.sql
```

**Note :** Utilisez le pooler Supabase (port 6543) au lieu du port direct (5432).

## ✅ Ce qui sera importé

- ✅ 5 slides hero (4 images + 1 vidéo)
- ✅ 5 membres du leadership avec leurs photos
- ✅ 1 partenaire (NEMMBA) avec son logo
- ✅ 3 actualités complètes
- ✅ 9 départements Karma
- ✅ 12 paramètres du site

## 🔍 Vérification post-import

Après l'import, vérifiez que :
1. Le carousel sur la page d'accueil affiche vos images
2. Les membres du leadership sont visibles (page "Notre équipe")
3. Les actualités s'affichent correctement
4. Le logo NEMMBA apparaît dans la section partenaires

## ❓ Problèmes ?

Si les images ne s'affichent toujours pas après l'import :
- Les images sont déjà dans Git (dossier `public/uploads/`)
- Vérifiez que les chemins dans la base correspondent aux images
- Videz le cache du navigateur (Ctrl+Shift+R)

## 📞 Identifiants Supabase

- Host: `db.plibklblcykfhnoboqum.supabase.co`
- Port: `5432` (direct) ou `6543` (pooler)
- Database: `postgres`
- Username: `postgres`
- Password: (voir `.env.render`)
