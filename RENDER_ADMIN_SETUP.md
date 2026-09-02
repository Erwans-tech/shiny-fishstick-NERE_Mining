# Configuration Admin pour Render

## Variables d'environnement à configurer dans Render

Dans le dashboard Render, allez dans **Environment Variables** et ajoutez :

```
ADMIN_EMAIL=admin@nere-mining.com
ADMIN_PASSWORD=NereAdmin2024!
```

## Après le déploiement

1. **Aller à l'URL admin** : `https://votre-app.onrender.com/gestion-nm`

2. **Se connecter avec** :
   - Email : `admin@nere-mining.com`
   - Mot de passe : `NereAdmin2024!`

3. **Changer le mot de passe** immédiatement dans les paramètres admin

## Commandes utiles pour troubleshooting

Si problème de connexion, connectez-vous via SSH Render et exécutez :

```bash
# Vérifier que l'admin existe
php artisan tinker --execute="dd(App\Models\User::where('email','admin@nere-mining.com')->first())"

# Recréer l'admin si nécessaire
php artisan db:seed --class=AdminSeeder

# Réinitialiser le mot de passe
php artisan tinker --execute="App\Models\User::where('email','admin@nere-mining.com')->first()->update(['password'=>bcrypt('NereAdmin2024!')])"
```

## Sécurité

⚠️ **Important** : Changez le mot de passe par défaut immédiatement après le premier login !