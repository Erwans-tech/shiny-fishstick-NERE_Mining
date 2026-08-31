# 🚀 Déploiement Vercel - Frontend Statique

Configuration pour déployer le site en tant que **frontend statique** sur Vercel.

## 🎯 Objectif

Générer et héberger les pages HTML statiques sur Vercel avec:
- Build automatique depuis GitHub
- Déploiement en 1-2 minutes
- URL publique pour présentations
- HTTPS gratuit

## ✅ Setup rapide (5 minutes)

### 1️⃣ Créer un compte Vercel

```
https://vercel.com
→ Sign up
→ Sélectionner "Continue with GitHub"
→ Autoriser Vercel
```

### 2️⃣ Importer le projet

**Option A: Depuis le dashboard Vercel**
- Cliquer "Add New..." → "Project"
- Sélectionner "Import an Existing Project"
- Chercher `shiny-fishstick-NERE_Mining`
- Cliquer "Import"

**Option B: Depuis GitHub**
- Aller sur le repo GitHub
- Installer Vercel app: https://github.com/apps/vercel
- Vercel détecte automatiquement le projet

### 3️⃣ Configuration du build

Vercel devrait détecter automatiquement `vercel.json`:

```
Build Command:    php scripts/export-static.php && npm run build
Output Directory: dist
```

Si pas détecté, le configurer manuellement dans:
**Project Settings** → **Build & Development Settings**

### 4️⃣ Variables d'environnement

Ajouter dans Vercel:
- **APP_KEY**: Générer une clé (ou copier du .env local)
  ```bash
  php artisan key:generate
  # Copier la valeur de APP_KEY du .env
  ```

**Dans Vercel Dashboard:**
1. Settings → Environment Variables
2. Ajouter `APP_KEY` avec la valeur
3. Sélectionner "Production"

### 5️⃣ Déployer

- Cliquer le bouton "Deploy"
- Attendre 2-3 minutes
- Vercel donne une URL: `your-project.vercel.app`

## 📊 Après deployment

### ✅ Le site fonctionne
```
https://your-project.vercel.app
```

### 🔄 Mises à jour automatiques
```bash
git push origin production
# Vercel redéploie auto en ~1 min
```

### 📈 Vérifier les builds
1. Vercel Dashboard → Ton projet
2. "Deployments" tab
3. Voir l'historique et les logs

## 🎨 Domaine personnalisé

### Ajouter ton domaine
1. Settings → Domains
2. "Add Domain"
3. Entrer ton domaine
4. Suivre les étapes DNS

### Domaine Vercel gratuit
- Format: `your-project.vercel.app`
- Automatique et gratuit
- Pas besoin de configuration

## 🆘 Troubleshooting

### ❌ Build échoue

**Vérifier les logs:**
1. Vercel Dashboard → Deployments
2. Cliquer sur le build échoué
3. Voir le message d'erreur

**Solutions courantes:**

```bash
# 1. Tester localement
npm run build
php scripts/export-static.php

# 2. Vérifier PHP version
php -v

# 3. Vérifier les routes dans export-static.php
# Ajouter plus de routes si nécessaire
```

### ❌ Site affiche 404

- Vérifier que `dist/index.html` existe
- Vérifier les rewrites dans `vercel.json`
- Forcer un rebuild: Dashboard → "Redeploy"

### ❌ Styles/images ne chargent pas

- Vérifier les chemins dans les fichiers CSS
- Vérifier que les assets sont dans `public/`
- Npm run build génère les assets avec hash

## 📋 Fichiers de config

### `vercel.json`
- Build commands
- Output directory
- Environment variables
- Rewrites et headers
- Caching rules

### `.env.example`
- Utilisé pour les env vars par défaut
- Ne pas committer les secrets

### `scripts/export-static.php`
- Exporte les pages HTML
- À modifier si nouvelles routes

## 💡 Avantages Vercel

✅ Build très rapide (< 1 min)
✅ Deploy global automatique
✅ HTTPS par défaut
✅ Analytics intégrés
✅ Previews sur PRs
✅ Rollbacks faciles

## 📞 Support

- [Vercel Docs](https://vercel.com/docs)
- [Vercel GitHub Integration](https://vercel.com/docs/git)
- Dashboard → Help & Support

## 🔐 Sécurité

Vérifier les headers HTTP dans `vercel.json`:
- ✅ X-Frame-Options
- ✅ X-Content-Type-Options
- ✅ X-XSS-Protection
- ✅ Cache-Control

Tous configurés et optimisés ! 🔒
