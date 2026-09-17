# Accès au Dashboard Admin - Production

## 🌐 Serveur de Production

**URL principale :** http://192.168.10.202

## 🔐 Connexion Admin

### URL de connexion
```
http://192.168.10.202/gestion-nm
```
ou
```
http://192.168.10.202/gestion-nm/connexion
```

### Identifiants par défaut
```
Email    : admin@nere-mining.bf
Password : AdminNereMining2026!
```

---

## 🔧 Résolution des problèmes

### 1. Vérifier que le compte admin existe

Connectez-vous au serveur en SSH et exécutez :

```bash
php artisan tinker
```

Puis dans tinker :
```php
User::where('is_admin', true)->get()
```

Si aucun utilisateur n'est retourné, le compte n'existe pas.

---

### 2. Créer/Réinitialiser le compte admin avec le seeder

```bash
php artisan db:seed --class=AdminSeeder
```

⚠️ **Attention** : Cette commande nécessite que les variables `ADMIN_EMAIL` et `ADMIN_PASSWORD` soient définies dans le fichier `.env` du serveur.

---

### 3. Créer le compte admin manuellement

Si le seeder ne fonctionne pas, créez le compte manuellement :

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::updateOrCreate(
    ['email' => 'admin@nere-mining.bf'],
    [
        'name' => 'Administrateur Néré Mining',
        'password' => Hash::make('AdminNereMining2026!'),
        'is_admin' => true,
    ]
);

echo "Compte admin créé : " . $user->email;
```

---

### 4. Changer le mot de passe admin

Pour changer le mot de passe d'un compte admin existant :

```bash
php artisan tinker
```

```php
$user = User::where('email', 'admin@nere-mining.bf')->first();
$user->password = Hash::make('NOUVEAU_MOT_DE_PASSE');
$user->save();
echo "Mot de passe changé avec succès";
```

---

### 5. Vérifier les logs d'erreur

```bash
# Logs Laravel
tail -f storage/logs/laravel.log

# Logs Nginx (si applicable)
tail -f /var/log/nginx/error.log

# Logs Apache (si applicable)
tail -f /var/log/apache2/error.log
```

---

## 🛡️ Sécurité

- **URL masquée** : `/gestion-nm` au lieu de `/admin` pour plus de sécurité
- **Rate limiting** : 5 tentatives max par IP/minute
- **Mot de passe fort** : Minimum 8 caractères requis
- **Session sécurisée** : Les sessions sont stockées dans la base de données

---

## 📋 Checklist de diagnostic

- [ ] Le serveur web (Nginx/Apache) est démarré
- [ ] Le site principal http://192.168.10.202 est accessible
- [ ] L'URL /gestion-nm retourne une page de login (pas d'erreur 404)
- [ ] La base de données PostgreSQL est accessible
- [ ] Le compte admin existe dans la table `users` avec `is_admin = true`
- [ ] Le mot de passe est bien hashé avec bcrypt
- [ ] Les sessions fonctionnent (vérifier `sessions` table si SESSION_DRIVER=database)
- [ ] Le fichier `.env` contient APP_KEY
- [ ] Les permissions du dossier `storage/` sont correctes (775)

---

## 🚨 Erreurs courantes

### "Accès restreint. Veuillez vous connecter."
→ La session admin n'est pas active. Vérifiez que vous utilisez la bonne URL de login.

### "Trop de tentatives"
→ Rate limiting activé. Attendez 1 minute avant de réessayer.

### "Identifiants incorrects"
→ Vérifiez l'email et le mot de passe. Le compte admin doit avoir `is_admin = true`.

### Page 404 sur /gestion-nm
→ Vérifiez que le serveur web pointe bien vers le dossier `public/` et que le `.htaccess` ou la config Nginx redirige correctement vers `index.php`.

### Erreur 500
→ Consultez les logs Laravel : `storage/logs/laravel.log`

---

## 📞 Contact Technique

Pour toute assistance, contacter l'équipe IT de Néré Mining avec :
- L'URL qui pose problème
- Le message d'erreur exact
- Les logs Laravel si disponibles
