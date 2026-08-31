# 🚀 Déploiement Netlify - Site Statique

Cette branche contient la configuration pour déployer le site en tant que contenu **100% statique** sur Netlify.

## 🎯 Objectif

Générer des fichiers HTML statiques à partir de l'app Laravel et les héberger gratuitement sur Netlify pour les présentations.

## ✅ Comment ça marche

1. **Export statique** : Le script PHP génère des fichiers HTML pré-rendus
2. **Build assets** : Vite compile CSS/JS
3. **Deploy** : Netlify héberge les fichiers statiques
4. **Cache** : CDN global pour performances optimales

## 🚀 Déployer en 5 minutes

### 1. Créer un compte Netlify
```
https://netlify.com → Sign up with GitHub
```

### 2. Connecter ce repo à Netlify
- **Dashboard Netlify** → "New site from Git"
- Sélectionner **GitHub**
- Chercher et sélectionner ce repo
- Branche: `deploy-netlify`
- Netlify détecte automatiquement `netlify.toml`
- Cliquer **"Deploy site"**

### 3. Attendre le build (~2-3 minutes)
- Les logs montreront:
  ```
  ✅ Generated: index.html
  ✅ Generated: en/index.html
  ✅ Generated: actualites/index.html
  ... etc
  ```

### 4. Récupérer l'URL publique
```
https://your-site-name.netlify.app
```

## 📝 Mettre à jour après modification

```bash
# Après modifier le contenu localement:
git add .
git commit -m "Update content"
git push origin deploy-netlify

# Netlify redéploie automatiquement en ~30 sec
```

## 🛠️ Tester localement

```bash
# Build les assets
npm run build

# Exporter les pages HTML
npm run export

# Les fichiers sont dans /dist
# Ouvrir dist/index.html dans le navigateur
```

## 📋 Routes exportées

- `/` → `index.html`
- `/en` → `en/index.html`
- `/actualites` → `actualites/index.html`
- `/emploi` → `emploi/index.html`
- ... et plus (voir scripts/export-static.php)

## ⚠️ Limitations

**Ce qui fonctionne:**
- ✅ Affichage des pages
- ✅ Navigation
- ✅ Styling CSS
- ✅ Images

**Ce qui ne fonctionne PAS:**
- ❌ Formulaires de contact (pas de backend)
- ❌ Upload d'images (pas de backend)
- ❌ Pages dynamiques (actualités temps réel)
- ❌ API

## 💡 Ajouter plus de routes

Modifier `scripts/export-static.php` pour ajouter des routes:

```php
$routes = [
    '/ma-nouvelle-page' => 'ma-nouvelle-page/index.html',
    // ...
];
```

Puis commit et push.

## 🎨 Domaine personnalisé

**Ajouter ton domaine:**
1. Netlify Dashboard → Site Settings → Domain management
2. Add custom domain
3. Suivre les étapes DNS

## 🆘 Troubleshooting

### 404 sur Netlify mais fonctionne localement
- Vérifier que la route est dans `scripts/export-static.php`
- Redéployer

### Build échoue
- Vérifier les logs Netlify
- Vérifier que `npm run build` fonctionne localement
- Vérifier la connexion DB (si nécessaire)

### Pages ne se mettent pas à jour
- Netlify cache les pages
- Forcer un rebuild: Dashboard → Deploys → Trigger deploy

## 📞 Support

- [Netlify Docs](https://docs.netlify.com)
- [GitHub Pages vs Netlify](https://www.netlify.com/blog/2019/09/09/why-netlify-instead-of-github-pages/)

