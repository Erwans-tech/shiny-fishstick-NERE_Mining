# ⚡ QUICK START : 5 minutes pour finaliser Render

## 🎯 **3 ÉTAPES SIMPLES**

### ✅ **ÉTAPE 1 : Récupérer les infos Supabase** (2 min)

1. Allez sur : **https://supabase.com**
2. Cliquez sur votre projet
3. Cliquez **"Connect"** (bouton en haut à droite)
4. Sélectionnez **"Direct connection"**
5. **COPIEZ** ces infos :

```
Host: db.xxxxxxxxxxxx.supabase.co
Password: [votre_mot_de_passe]
```

---

### ✅ **ÉTAPE 2 : Configurer Render** (2 min)

1. Allez sur : **https://dashboard.render.com**
2. Cliquez sur votre service : **nere-mining-ex3a**
3. Cliquez **"Environment"**
4. Ajoutez ces **6 variables** :

| Key | Value |
|-----|-------|
| `DB_CONNECTION` | `pgsql` |
| `DB_HOST` | `db.xxxxxxxxxxxx.supabase.co` ⚠️ VOTRE HOST |
| `DB_PORT` | `5432` |
| `DB_DATABASE` | `postgres` |
| `DB_USERNAME` | `postgres` |
| `DB_PASSWORD` | ⚠️ VOTRE MOT DE PASSE |

5. Cliquez **"Save Changes"**

---

### ✅ **ÉTAPE 3 : Attendre et vérifier** (1 min)

1. Render **redémarre automatiquement**
2. Allez dans **"Logs"**
3. Attendez de voir :
   ```
   🚀 Démarrage des services Laravel...
   📊 Exécution des migrations...
   ✅ migrations DONE
   🐘 Démarrage PHP-FPM...
   🌐 Démarrage Nginx sur port 10000...
   ```

4. **TESTEZ** : `https://nere-mining-ex3a.onrender.com`

---

## 🎊 **C'EST FINI !**

Votre app est en ligne ! 🚀

Si problème → Voir `RENDER_FINAL_SETUP.md` pour le dépannage détaillé.
