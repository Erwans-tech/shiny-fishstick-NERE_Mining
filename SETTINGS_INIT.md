# Initialisation des paramètres du site

## 🔴 Problème

La page `/gestion-nm/settings` n'affiche rien car la table `site_settings` est vide en production.

## ✅ Solution rapide

Sur le serveur, après `git pull`, exécuter :

```bash
php artisan settings:init
```

Cette commande va créer tous les paramètres par défaut :
- ✅ Carrousel Hero (autoplay, interval, etc.)
- ✅ Album mis en avant sur la page d'accueil
- ✅ Informations de l'entreprise
- ✅ Contact presse
- ✅ Footer
- ✅ Réseaux sociaux
- ✅ SEO/Meta

## 📋 Paramètres créés

### **Carrousel Hero**
- `carousel_autoplay` = true
- `carousel_interval` = 5000ms (5 secondes)
- `carousel_transition_speed` = 800ms
- `carousel_pause_on_hover` = true
- `carousel_show_indicators` = true
- `carousel_show_arrows` = true

### **Album mis en avant**
- `home_featured_album_id` = (vide, à configurer dans l'admin)

### **Informations entreprise**
- `company_address` = Ouagadougou, Burkina Faso
- `company_phone` = +226 25 33 35 69
- `company_email` = info@nere-mining.bf
- `company_website` = https://www.nere-mining.bf

### **Contact presse**
- `press_contact_name` = Service Communication
- `press_contact_job` = Responsable Communication & Relations Presse
- `press_contact_phone` = +226 25 33 35 69
- `press_contact_email` = presse@nere-mining.bf
- `press_contact_hours` = Lundi – Vendredi, 8h – 17h (GMT+0)

### **Footer**
- `footer_copyright` = © 2026 Néré Mining. Tous droits réservés.
- `footer_description` = Description de l'entreprise

### **Réseaux sociaux**
- `social_linkedin` = (vide)
- `social_facebook` = (vide)
- `social_twitter` = (vide)

### **SEO/Meta**
- `seo_title` = Néré Mining - L'or d'une valeur durable
- `seo_description` = Description SEO

---

## 🔧 Options avancées

### **Forcer la mise à jour des settings existants**
```bash
php artisan settings:init --force
```

Cela écrasera les valeurs existantes avec les valeurs par défaut.

### **Utiliser le seeder (alternative)**
```bash
php artisan db:seed --class=SiteSettingsSeeder
```

---

## 🎯 Après l'initialisation

1. Aller sur `/gestion-nm/settings`
2. La page devrait maintenant afficher tous les paramètres
3. Modifier les valeurs selon vos besoins
4. Enregistrer

Pour configurer l'album mis en avant sur la page d'accueil :
1. Chercher **"Album mis en avant sur la page d'accueil"**
2. Sélectionner un album dans le dropdown
3. Enregistrer
4. L'album apparaîtra sur la page d'accueil avec un carrousel animé

---

## 🐛 Dépannage

### La page settings est toujours vide
```bash
# Vérifier si les settings ont été créés
php artisan tinker
>>> App\Models\SiteSetting::count()
```

Si le résultat est 0, relancer :
```bash
php artisan settings:init --force
```

### Réinitialiser tous les settings
```bash
php artisan tinker
>>> App\Models\SiteSetting::truncate()
>>> exit

php artisan settings:init
```

---

## 📝 Note importante

Ces paramètres peuvent être modifiés à tout moment depuis l'interface admin `/gestion-nm/settings`. Les valeurs par défaut sont juste un point de départ.
