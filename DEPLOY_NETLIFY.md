# 🚀 Déploiement sur Netlify

Ce guide explique comment déployer le site web Néré Mining sur Netlify pour les présentations.

## ✅ Prérequis

- Compte GitHub avec ce repository
- Compte Netlify (gratuit): https://netlify.com
- Node.js et npm installés localement

## 📋 Étapes de configuration

### 1. Créer un compte Netlify
- Aller sur https://netlify.com
- Sign up avec GitHub
- Autoriser Netlify à accéder à tes repos

### 2. Connecter ce repository
- Dans Netlify: "New site from Git"
- Sélectionner GitHub et ce repository
- Netlify détecte automatiquement la config (netlify.toml)
- Cliquer "Deploy"

### 3. Configuration du build (automatique)
- **Build command**: `npm run build`
- **Publish directory**: `public`

### 4. Variables d'environnement (optionnel)
Si tu as besoin de variables d'environnement:
- Dans Netlify: "Settings" → "Build & Deploy" → "Environment"
- Ajouter les variables nécessaires

## 🔄 Déploiement automatique

Chaque push sur la branche `main` déclenche automatiquement un déploiement sur Netlify.

```bash
git add .
git commit -m "Update content"
git push origin main
```

Le site sera en ligne en ~30 secondes.

## 📊 Vérifier le déploiement

1. Aller dans Netlify Dashboard
2. Vérifier le "Deploys" tab
3. Voir le status du build
4. Accéder au lien public généré

## 🎨 Personnaliser le domaine

### Netlify subdomain (par défaut)
- Format: `your-site-name.netlify.app`
- Automatique et gratuit

### Domaine personnalisé
- Dans Netlify: "Settings" → "Domain management"
- Ajouter ton domaine
- Suivre les étapes pour configurer les DNS

## ⚠️ Limitations

- **Pas de backend** : Les formulaires de contact et uploads nécessitent un backend
- **Données statiques** : Seules les pages publiques sont générées
- **Performance** : Optimal pour ~100MB de contenu statique

## 💡 Optimisations pour présentations

- Images optimisées et compressées
- CSS/JS minifiés automatiquement
- Caching des assets
- CDN global de Netlify

## 🆘 Troubleshooting

### Build échoue
- Vérifier les logs dans Netlify
- Vérifier que `npm run build` fonctionne localement
- Vérifier les variables d'environnement

### Site blanc/404
- Vérifier que `publish = "public"` est correct
- Vérifier les redirects dans netlify.toml

### Domaine ne résout pas
- Attendre 24-48h pour la propagation DNS
- Vérifier les records DNS

## 📞 Support

- Netlify Docs: https://docs.netlify.com
- GitHub Actions Docs: https://docs.github.com/en/actions
