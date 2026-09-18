# Configuration HTTPS et Sécurité

## ✅ Déjà implémenté dans le code

### 1. **Middleware ForceHttps**
- Redirige automatiquement HTTP → HTTPS (301)
- Actif en production ou si `FORCE_HTTPS=true` dans `.env`
- Fichier : `app/Http/Middleware/ForceHttps.php`

### 2. **Headers de sécurité** (SecurityHeaders middleware)
- `Strict-Transport-Security` : Force HTTPS pendant 1 an
- `upgrade-insecure-requests` dans CSP : Upgrade automatique HTTP → HTTPS
- `X-Frame-Options`, `X-Content-Type-Options`, etc.
- Fichier : `app/Http/Middleware/SecurityHeaders.php`

### 3. **AppServiceProvider**
- `URL::forceScheme('https')` en production
- Tous les `route()`, `url()`, `asset()` génèrent du HTTPS
- Fichier : `app/Providers/AppServiceProvider.php`

### 4. **web.config IIS**
- Redirection HTTP → HTTPS au niveau serveur
- Header HSTS ajouté
- Fichier : `public/web.config`

---

## 🔧 Configuration serveur requise

### **Sur le serveur Windows IIS :**

#### 1. Vérifier le fichier `.env`
```bash
APP_URL=https://www.nere-mining.bf  # ✅ HTTPS
FORCE_HTTPS=true                     # ✅ Activé
SESSION_SECURE_COOKIE=true           # ✅ Cookies HTTPS uniquement
```

#### 2. Vérifier le certificat SSL dans IIS
1. Ouvrir **IIS Manager**
2. Sélectionner le site **www.nere-mining.bf**
3. Cliquer sur **Bindings** (dans le panneau Actions à droite)
4. Vérifier qu'il y a bien :
   - **Type: https**, Port: 443, avec un certificat SSL valide
   - **Type: http**, Port: 80 (pour la redirection vers HTTPS)

#### 3. Tester la redirection HTTP → HTTPS
```bash
# Depuis un navigateur ou PowerShell:
curl -I http://www.nere-mining.bf

# Devrait retourner:
HTTP/1.1 301 Moved Permanently
Location: https://www.nere-mining.bf/
```

#### 4. Redémarrer IIS après git pull
```cmd
iisreset
```

---

## 🔍 Diagnostic des problèmes de contenu mixte

### **Vérifier dans le navigateur (F12 Console)**

Si Edge/Chrome affiche toujours un avertissement :

1. Ouvrir **Outils de développement** (F12)
2. Aller dans l'onglet **Console**
3. Chercher les erreurs de type :
   ```
   Mixed Content: The page at 'https://...' was loaded over HTTPS, 
   but requested an insecure resource 'http://...'. 
   This request has been blocked...
   ```

4. Noter les URLs en HTTP affichées dans l'erreur

### **Causes fréquentes :**

✅ **Déjà corrigé dans ce projet :**
- Tous les `asset()`, `url()`, `route()` génèrent du HTTPS
- CSP avec `upgrade-insecure-requests`
- Pas de liens HTTP en dur dans le code

❌ **Peut venir de :**
- **Images/fichiers dans la base de données** avec URLs HTTP
- **Contenu éditorial** (descriptions, articles) contenant des liens HTTP
- **Iframes externes** (YouTube, Google Maps) en HTTP
- **Polices ou CDN externes** en HTTP

---

## 🛠️ Correction des contenus mixtes dans la base de données

### **Rechercher les URLs HTTP dans PostgreSQL :**

```sql
-- Chercher dans les actualités
SELECT id, title, content 
FROM news 
WHERE content LIKE '%http://%' 
AND content NOT LIKE '%https://%';

-- Chercher dans les médias
SELECT id, title, external_url, file_path 
FROM media_assets 
WHERE external_url LIKE 'http://%' 
OR file_path LIKE 'http://%';

-- Chercher dans les messages de contact
SELECT id, message 
FROM contact_messages 
WHERE message LIKE '%http://%';
```

### **Remplacer HTTP par HTTPS :**

```sql
-- Mettre à jour les URLs dans les actualités
UPDATE news 
SET content = REPLACE(content, 'http://', 'https://') 
WHERE content LIKE '%http://%';

-- Mettre à jour les URLs dans les médias
UPDATE media_assets 
SET external_url = REPLACE(external_url, 'http://', 'https://') 
WHERE external_url LIKE 'http://%';
```

---

## 📋 Checklist de vérification

Après `git pull` et `iisreset` :

- [ ] Accéder à http://www.nere-mining.bf → Redirige vers HTTPS ?
- [ ] Ouvrir F12 Console → Aucune erreur "Mixed Content" ?
- [ ] Tester `/test-upload.php` → Configuration PHP visible ?
- [ ] Tester `/gestion-nm/media/upload-multiple` → Page charge sans erreur ?
- [ ] Navigateur affiche le cadenas vert 🔒 sans avertissement ?

---

## 🚀 Résumé

Ce projet est **100% configuré pour HTTPS** côté code :
- ✅ Redirection HTTP → HTTPS automatique
- ✅ Headers de sécurité (HSTS, CSP)
- ✅ Tous les helpers Laravel génèrent du HTTPS
- ✅ CSP upgrade insecure requests

**Si problème persiste :**
1. Vérifier le certificat SSL dans IIS
2. Chercher contenu mixte avec F12 Console
3. Nettoyer la base de données (requêtes SQL ci-dessus)
4. Vider le cache navigateur (Ctrl+Shift+Delete)
