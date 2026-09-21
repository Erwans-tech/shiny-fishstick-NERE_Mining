# Mise à jour de l'image d'extraction de l'or

## 📸 Changements effectués

**Date :** 18 septembre 2026
**Fichier source :** `C:\Users\erwan\Downloads\ne abbum\photoextraxtiodelor.jpeg`

### Nouveau fichier créé
- **Nom :** `gold-extraction-plant.jpg`
- **Emplacement :** `public/images/mining/gold-extraction-plant.jpg`
- **Taille :** 162,473 bytes
- **Raison du nouveau nom :** Forcer la mise à jour du cache navigateur/serveur

### Fichiers modifiés

1. **resources/views/pages/karma-exploitation.blade.php**
   - Section : Carte "Traitement de l'or"
   - Changement : `karma-04.jpg` → `gold-extraction-plant.jpg`

2. **resources/views/pages/karma.blade.php**
   - Section : Programmes d'exploitation
   - Changement : `karma-04.jpg` → `gold-extraction-plant.jpg`

### Pages affectées

- ✅ `/karma/exploitation` (FR)
- ✅ `/en/karma/exploitation` (EN)
- ✅ `/karma` (FR)
- ✅ `/en/karma` (EN)

## 🚀 Déploiement sur le serveur de production

```bash
cd C:\inetpub\wwwroot\nere-mining
git pull origin production-stable
```

**Note :** Après le `git pull`, l'image sera automatiquement disponible. Si l'ancienne image est toujours visible, videz le cache du navigateur (Ctrl+F5) ou du serveur IIS.

## 🔄 Nettoyage du cache (si nécessaire)

Si l'image ne s'affiche toujours pas après le déploiement :

1. **Cache navigateur :**
   - Chrome/Edge : `Ctrl + Shift + Delete` → Cocher "Images et fichiers en cache" → Effacer
   - Ou directement : `Ctrl + F5` sur la page

2. **Cache serveur IIS :**
   ```powershell
   iisreset
   ```

3. **Vérifier l'image directement :**
   - https://www.nere-mining.bf/images/mining/gold-extraction-plant.jpg

## ✅ Vérification

Après le déploiement, vérifiez que l'image s'affiche sur :
- https://www.nere-mining.bf/karma/exploitation
- https://www.nere-mining.bf/en/karma/exploitation
- https://www.nere-mining.bf/karma
