# 📸 Guide Visuel : Récupérer les infos PostgreSQL Supabase

## 🚀 Étapes visuelles détaillées

### 👋 1. Page d'accueil Supabase
```
┌─────────────────────────────────────────────────────┐
│ 🟢 Supabase                                         │
│                                                     │
│     🏠 Accueil                                      │
│                                                     │
│  [🔗 Start your project] ← CLIQUE ICI             │
│                                                     │
│  Sign in with GitHub   Sign in with Google         │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 🏗️ 2. Création de projet
```
┌─────────────────────────────────────────────────────┐
│ Create a new project                                │
│                                                     │
│ Name: [nere-mining                    ] ✏️          │
│                                                     │
│ Database Password: [●●●●●●●●●●●●●●●●●●●] 🔐          │
│ ⚠️  GARDE CE MOT DE PASSE !                        │
│                                                     │
│ Region: [🇪🇺 Europe West (Frankfurt)  ▼]           │
│                                                     │
│ Plan: ⚪ Free    ⚪ Pro    ⚪ Team                  │
│                                                     │
│        [Create new project] ← CLIQUE ICI           │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### ⏳ 3. Attente création (2-3 min)
```
┌─────────────────────────────────────────────────────┐
│ Setting up your project...                          │
│                                                     │
│     🔄 Creating database...                         │
│     🔄 Setting up authentication...                 │
│     🔄 Configuring API...                           │
│                                                     │
│ This usually takes 1-2 minutes                      │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 🎯 4. Dashboard - Bouton Connect (MÉTHODE FACILE)
```
┌─────────────────────────────────────────────────────┐
│ 🟢 Supabase  │ nere-mining                          │
│                                    [📊 Connect] ←── CLIQUE ICI │
│ ─────────────────────────────────────────────────── │
│                                                     │
│ 🏠 Home    📊 Table Editor   🔍 SQL Editor         │
│                                                     │
│ Quick start                                         │
│ • Create your first table                           │
│ • Insert some sample data                           │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 🔗 5. Fenêtre Connect - Choix du mode
```
┌─────────────────────────────────────────────────────┐
│ Connect to your project                             │
│                                                     │
│ Connection mode:                                    │
│ ⚪ Direct connection      ← CHOISIS CELUI-CI        │
│ ⚪ Pooler - Session mode                            │  
│ ⚪ Pooler - Transaction mode                        │
│                                                     │
│ Framework:                                          │
│ 📋 [Laravel/PHP          ▼]                        │
│                                                     │
│                            [Continue] ← CLIQUE     │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 📋 6. Informations de connexion révélées
```
┌─────────────────────────────────────────────────────┐
│ Database connection                                 │
│                                                     │
│ 📋 Copy connection details:                         │
│                                                     │
│ Host: db.abcdefghijklmnop.supabase.co              │
│ Port: 5432                                          │
│ Database: postgres                                  │
│ Username: postgres                                  │
│ Password: ●●●●●●●●●●●●●●●●●●● [👁️ Show]             │
│                                                     │
│ 🔗 Full connection string:                          │
│ postgresql://postgres.[ref]:[password]@db.xxx...    │
│                                    [📄 Copy] ←───── COPIE ÇA │
│                                                     │
│ Laravel .env example:                               │
│ DB_CONNECTION=pgsql                                 │
│ DB_HOST=db.abcdefghijklmnop.supabase.co            │
│ DB_PORT=5432                                        │
│ DB_DATABASE=postgres                                │
│ DB_USERNAME=postgres                                │
│ DB_PASSWORD=ton_mot_de_passe                        │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### ⚙️ 7. Alternative : Via Settings → Database
```
┌─────────────────────────────────────────────────────┐
│ 🟢 Supabase                                         │
│                                                     │
│ 📂 Table Editor                                     │
│ 🔍 SQL Editor                                       │
│ 🔐 Authentication                                   │
│ 🛟 Edge Functions                                   │
│ ⚙️  Settings          ← CLIQUE ICI                  │
│   └ General                                         │
│   └ Database          ← PUIS ICI                    │
│   └ API                                             │
│   └ Auth                                            │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 🗃️ 8. Page Database Settings
```
┌─────────────────────────────────────────────────────┐
│ Database Settings                                   │
│                                                     │
│ ═══ Connection info ═══                             │
│                                                     │
│ Host         │ db.abcdefghijklmnop.supabase.co     │
│ Port         │ 5432                                │
│ Database     │ postgres                            │
│ Username     │ postgres                            │
│ Password     │ [Reset password]                    │
│                                                     │
│ ═══ Connection pooling ═══                          │
│ Pool size: [20] connections                         │
│                                                     │
│ ═══ SSL configuration ═══                           │
│ SSL Enforcement: [Enabled]                          │
│                                                     │
└─────────────────────────────────────────────────────┘
```

## 🏃‍♂️ Résumé ultra-rapide :

1. **Va sur [supabase.com](https://supabase.com)**
2. **Clique "Start your project"**
3. **Crée un nouveau projet** (garde le mot de passe !)
4. **Attends 2-3 min** que ça se crée
5. **Clique le bouton "Connect"** (en haut à droite)
6. **Choisis "Direct connection"**  
7. **Copie les infos** ou la connection string complète

## 🔥 Exemple concret pour Render :

```env
# Ces valeurs exactes dans ton dashboard Render :
DB_CONNECTION=pgsql
DB_HOST=db.abcdefghijklmnop.supabase.co  
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres  
DB_PASSWORD=le_mot_de_passe_que_tu_as_choisi
```

## 🆘 Si tu es perdu :

1. **Regarde l'URL** de ton projet : `https://app.supabase.com/project/abcdefghijklmnop`
2. **Le "abcdefghijklmnop" c'est ton ref** → l'host sera `db.abcdefghijklmnop.supabase.co`
3. **Username et Database sont TOUJOURS** `postgres`
4. **Port TOUJOURS** `5432` (direct connection)
5. **Seul le password change** (celui que tu as choisi à la création)

---

💡 **Astuce** : Une fois que tu as les infos, teste la connexion avec un client comme DBeaver ou directement dans l'interface Supabase avant de configurer Render !