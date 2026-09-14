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
Build Command:    npm run build
Output Directory: public
```

Si pas détecté, le configurer manuellement dans:
**Project Settings** → **Build & Development Settings**

### 4️⃣ Pas besoin de variables d'environnement

Cette configuration statique ne nécessite pas de variables spéciales.
Le site fonctionne avec les fichiers compilés dans `public/`.

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

### ❌ Build échoue - "No Output Directory named public"

**Solution:**
```
Vercel Dashboard → Project Settings
→ Build & Development Settings
→ Output Directory: public
→ Build Command: npm run build
→ Redeploy
```

### ❌ Build échoue - Autre erreur

**Vérifier les logs:**
1. Vercel Dashboard → Deployments
2. Cliquer sur le build échoué
3. Voir le message d'erreur complet

**Solutions courantes:**

```bash
# 1. Tester localement
npm run build

# 2. Vérifier que public/ existe
ls -la public/

# 3. Vérifier package.json scripts
cat package.json
```

### ❌ Site affiche 404

- Vérifier que `public/index.html` existe
- Vérifier les rewrites dans `vercel.json`
- Forcer un rebuild: Dashboard → "Redeploy"

### ❌ Styles/images ne chargent pas

- Vérifier les chemins dans les fichiers CSS
- Vérifier que npm run build crée les assets
- Vérifier que public/build/ existe

## 📊 Structure de déploiement

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
