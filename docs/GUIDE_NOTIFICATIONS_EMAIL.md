# Guide — Notifications par e-mail (contact & candidatures)

Les messages envoyés depuis le site public et les candidatures reçues par le
formulaire « Careers » sont enregistrés en base **et** transférés vers une boîte
e-mail que tu définis toi-même dans l'admin.

---

## 1. Choisir l'adresse de destination (admin)

**Admin → Paramètres du site → section « Hr »**

| Champ | Rôle |
|---|---|
| **Hr email address** | La boîte qui reçoit tout. Exemple : `rh@neremining.com` |
| **Transférer automatiquement tous les messages de contact…** | Active la redirection des messages du formulaire de contact |
| **Transférer automatiquement toutes les candidatures…** | Active la redirection des candidatures, **avec le CV et la lettre de motivation en pièces jointes** |

> Même si la redirection est désactivée ou l'adresse vide, le message/la candidature
> **reste enregistré en base** et reste visible dans l'admin. La redirection par
> e-mail est un bonus, jamais un point de rupture.

---

## 2. Configurer le serveur SMTP

L'adresse de destination ne suffit pas : il faut aussi un **transport SMTP**.
Sans lui, rien n'est envoyé.

> ⚠️ Ces valeurs vont dans le fichier **`.env` du serveur** (ou dans le dashboard
> Render). **Jamais dans Git** — c'est exactement pour ça que `.env.render` et les
> fichiers de secrets ont été retirés du dépôt.

### Serveur OVH

Selon ton offre, l'hôte est l'un des trois ci-dessous. Garde `ssl0.ovh.net` si tu
as un hébergement **OVHcloud** (avec filtre antispam), sinon celui indiqué par ton
espace client.

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=ssl0.ovh.net          # ou mail.tonweb.ovh.net / mail.ovh.net
MAIL_PORT=465                   # 465 = SSL direct, 587 = STARTTLS
MAIL_USERNAME=rh@tonsiteweb.com  # l'adresse complète de la boîte expéditrice
MAIL_PASSWORD=le-mot-de-passe-de-cette-boite
MAIL_ENCRYPTION=ssl             # 'ssl' sur 465, 'tls' sur 587
MAIL_FROM_ADDRESS=rh@tonsiteweb.com
MAIL_FROM_NAME="Néré Mining"
MAIL_SMTP_TIMEOUT=10
```

Puis :

```bash
php artisan config:clear
```

**Règles à respecter, sinon tes mails partent en spam ou sont rejetés :**

1. `MAIL_FROM_ADDRESS` doit être une adresse **du domaine** (ex. `@tonsiteweb.com`).
   Un `MAIL_FROM_ADDRESS` qui ne correspond pas à `MAIL_USERNAME` sera refusé.
2. Utilise la **vraie boîte** de ton hébergement, pas un Gmail. OVH rejette les
   envois usurpant un expéditeur qui n'est pas le sien.
3. Si tu es en port 587, mets `MAIL_ENCRYPTION=tls`. Si le test échoue avec
   « connection timed out », essaie le 465 en `ssl`.

### Alternative selon l'hébergeur

| Hébergeur | Hôte | Port | Chiffrement |
|---|---|---|---|
| OVHcloud | `ssl0.ovh.net` | 465 / 587 | `ssl` / `tls` |
| OVH mutualisé / TonSiteWeb | `mail.tonweb.ovh.net` | 465 / 587 | `ssl` / `tls` |
| OVH mutualisé (ancien) | `mail.ovh.net` | 465 / 587 | `ssl` / `tls` |
| Gmail / Workspace | `smtp.gmail.com` | 587 | `tls` |
| Microsoft 365 | `smtp.office365.com` | 587 | `tls` |

---

## 3. Vérifier avec le bouton de test

**Admin → Paramètres du site → juste sous le champ « Hr email address »**
→ bouton **« Envoyer un e-mail de test »**.

Le résultat s'affiche en haut de la page :

| Message | Signification |
|---|---|
| ✅ *E-mail de test envoyé à…* | Le SMTP fonctionne. |
| ❌ *MAIL_MAILER vaut « log »* | Le transport n'est pas configuré — passe à `MAIL_MAILER=smtp`. |
| ❌ *Échec de l'envoi : <message>* | Regarde le message : `authentication failed` = mauvais identifiants, `connection refused` = mauvais hôte/port, `certificate` = mauvais `MAIL_ENCRYPTION`. |

Le bouton envoie **immédiatement**, sans passer par la file d'attente : tu vois
donc l'erreur réelle tout de suite. Pense à regarder le dossier « indésirables ».

---

## 4. La file d'attente — pourquoi et comment

Les envois de vrais messages et de candidatures passent par une **file d'attente**
(au lieu d'être envoyés pendant la requête HTTP). Raison : un serveur SMTP lent ou
momentanément indisponible faisait expirer la requête et renvoyait une **erreur
502** au visiteur. Son message, lui, était bien enregistré — mais le visiteur, lui,
voyait une page d'erreur.

Avec la file d'attente, le formulaire répond toujours immédiatement.

### Ce que ça implique

Il faut un processus qui vide la file. Deux options :

**a) Un worker permanent (recommandé, plan payant Render)**

```bash
php artisan queue:work --tries=3 --timeout=30
```

**b) Un cron qui vide la file chaque minute (offre gratuite Render)**

C'est ce qui est déjà déclaré dans `render.yaml` :

```bash
php artisan queue:work --stop-when-empty --tries=1 --timeout=30
```

Conséquence : un e-mail peut mettre **jusqu'à ~1 minute** à partir. C'est un
compromis acceptable, et largement préférable à un 502.

### Sur le serveur Windows / IIS

Le worker doit tourner en permanence. Via le **Planificateur de tâches Windows** :

- Programme : `C:\...\php.exe`
- Arguments : `artisan queue:work --stop-when-empty --tries=1 --timeout=30`
- Démarrer dans : `C:\...\nere-mining` (le dossier du projet)
- Déclencheur : au démarrage du système, puis « Répéter toutes les minutes »
- « Exécuter que si l'utilisateur est connecté » : **décoché**

### Surveiller la file

```bash
php artisan queue:failed        # e-mails définitivement en échec
php artisan queue:retry         # relancer les échecs
php artisan queue:failed-table  # detailed, avec le message d'erreur
```

Si `queue:failed` se remplit, l'erreur est Almost always dans la config SMTP.

---

## 5. Vérifier que tout est en place

```bash
php artisan tinker
```

```php
config('mail.default');     // doit valoir "smtp", pas "log"
config('queue.default');    // doit valoir "database" (pas "sync")
App\Models\SiteSetting::get('hr_email_address');   // ton adresse
```

Si `config('mail.default')` renvoie encore `log` après avoir modifié `.env` :
`php artisan config:clear` — la configuration est en cache.

---

## 6. En cas de problème

| Symptôme | Cause probable | Solution |
|---|---|---|
| Rien ne part, aucun message d'erreur | `MAIL_MAILER=log` | Passe à `smtp` + `config:clear` |
| `authentication failed` | Mauvais user/mot de passe | Reprends l'identifiant exact de la boîte OVH |
| `connection refused` / `timed out` | Mauvais hôte ou port | Essaie `ssl0.ovh.net` puis `mail.tonweb.ovh.net`, ports 465 puis 587 |
| `certificate verify failed` | Mauvais chiffrement | Aligne `MAIL_ENCRYPTION` avec le port (465→`ssl`, 587→`tls`) |
| Le mail arrive en « indésirables » | SPF/DKIM non alignés | `MAIL_FROM_ADDRESS` doit être sur le domaine de la boîte |
| Les messages arrivent mais pas les candidatures | Toggle applications désactivé | Admin → Paramètres → cocher « Transférer toutes les candidatures » |
| `queue:failed` non vide | SMTP KO au moment de l'envoi | `php artisan queue:failed-table` pour lire l'erreur, puis `queue:retry` |

---

## 7. Ce qui a changé dans le code

| Fichier | Modification |
|---|---|
| `app/Mail/ContactMessageNotification.php` | `ShouldQueue` + `afterCommit` + 3 tentatives avec 60 s d'attente |
| `app/Mail/JobApplicationNotification.php` | Idem |
| `app/Mail/TestEmailNotification.php` | **Nouveau** — e-mail de test, volontairement synchrone |
| `resources/views/emails/test-notification*.blade.php` | **Nouveau** — contenu de l'e-mail de test |
| `app/Http/Controllers/Admin/AdminSiteSettingController.php` | **Nouvelle** méthode `sendTestEmail()` |
| `routes/web.php` | Route `POST gestion-nm/parametres/test-email` |
| `resources/views/admin/settings/index.blade.php` | Bouton de test + affichage des messages d'erreur |
| `config/mail.php` | `timeout` SMTP configurable (10 s par défaut) |
| `render.yaml` | `QUEUE_CONNECTION=database`, variables SMTP, cron de vidage de la file |

Les 3 points d'envoi existants (`routes/web.php:517`, `routes/web.php:547`,
`JobOfferController.php:147`) n'ont **pas** été modifiés : comme les mailables
implémentent désormais `ShouldQueue`, Laravel les met automatiquement en file.
