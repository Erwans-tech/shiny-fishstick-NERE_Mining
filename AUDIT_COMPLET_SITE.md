# Audit complet du site Néré Mining

Date de l’audit : 4 septembre 2026
Branche auditée : `production-stable`

## Résumé

Le site est riche sur le plan fonctionnel et visuel. Les routes publiques, les versions française et anglaise, l’administration, les formulaires, les animations et le déploiement Docker sont déjà largement structurés.

Cependant, le site ne doit pas être publié en production avant la correction des points suivants :

- une erreur de syntaxe PHP bloque actuellement le chargement des routes Laravel ;
- des vulnérabilités connues concernent la version de Laravel ;
- le workflow CI/CD ne correspond pas complètement à la branche réellement déployée ;
- la protection de certaines actions administrateur utilise un mécanisme d’authentification différent de celui réellement utilisé ;
- les emails SMTP et le monitoring externe doivent encore être configurés et testés.

## 1. Bloqueur critique : erreur PHP

Fichier concerné : `app/Http/Controllers/Admin/AdminUserController.php`

La classe `AdminUserController` est fermée trop tôt, avant les méthodes `index()`, `create()`, `store()`, `show()`, `edit()`, `update()`, `destroy()` et `toggleStatus()`.

Conséquence observée :

```text
ParseError: syntax error, unexpected token "public", expecting end of file
```

La commande suivante échoue :

```bash
php artisan route:list
```

### Action obligatoire

Déplacer ou supprimer l’accolade fermante située avant la première méthode publique afin que toutes les méthodes restent dans la classe.

Après correction, exécuter :

```bash
php -l app/Http/Controllers/Admin/AdminUserController.php
php artisan route:list
```

## 2. Tests automatisés

Résultat observé :

- 6 tests réussis ;
- 1 test en échec.

L’échec concerne `tests/Feature/JobOfferLegacyCompatibilityTest.php` et le nettoyage de la base de données PostgreSQL :

```text
Dependent objects still exist
job_applications_job_offer_id_foreign depends on job_offers
```

La configuration `phpunit.xml` prévoit SQLite en mémoire, tandis que l’exécution locale a utilisé PostgreSQL.

### Actions recommandées

- Vérifier que les tests utilisent toujours `DB_CONNECTION=sqlite` et `DB_DATABASE=:memory:`.
- Vérifier qu’aucun fichier `.env` local ne surcharge la configuration PHPUnit.
- Utiliser une base de test dédiée si PostgreSQL est nécessaire.
- Corriger l’ordre ou la stratégie de nettoyage des tables si les tests doivent fonctionner avec PostgreSQL.
- Relancer toute la suite avec `php artisan test`.

## 3. Dépendances vulnérables

`composer audit` signale trois avis de sécurité concernant `laravel/framework`, dont une vulnérabilité élevée liée à l’injection CRLF dans la validation email.

### Action obligatoire

Mettre Laravel à jour vers une version corrigée compatible avec PHP 8.2 et le projet :

```bash
composer update laravel/framework --with-all-dependencies
composer audit
php artisan test
```

La commande `npm audit --omit=dev --audit-level=high` n’a signalé aucune vulnérabilité de production côté JavaScript.

## 4. Authentification administrateur

L’administration utilise une session personnalisée :

- `admin_logged_in` ;
- `admin_id` ;
- middleware `admin.auth`.

Mais `AdminUserController` vérifie parfois `auth()->id()` pour empêcher un administrateur de modifier ou supprimer son propre compte.

### Risque

`auth()->id()` peut être vide ou différent de `session('admin_id')`. La protection contre l’auto-modification et l’auto-suppression peut donc ne pas fonctionner comme prévu.

### Action recommandée

Utiliser la même source d’identité partout :

```php
$currentAdminId = (int) session('admin_id');
```

Puis comparer cet identifiant avec celui de l’utilisateur ciblé.

Prévoir également :

- MFA pour les comptes administrateurs ;
- journalisation des actions sensibles ;
- expiration de session ;
- vérification régulière des comptes actifs.

## 5. Routes et surface d’administration

La surface admin est protégée par le middleware `admin.auth`, ce qui est positif.

Elle comprend notamment :

- actualités ;
- publications ;
- offres d’emploi ;
- partenaires ;
- équipe de direction ;
- communiqués ;
- médias ;
- certifications ;
- paramètres ;
- messages ;
- newsletter ;
- candidatures ;
- départements Karma ;
- slideshow ;
- utilisateurs.

### Vérifications à réaliser après correction PHP

```bash
php artisan route:list
php artisan route:list --path=gestion-nm
```

Tester également qu’une requête non authentifiée vers chaque section admin redirige vers la page de connexion.

## 6. Uploads et données personnelles

Les CV et lettres de motivation sont validés avec :

- extensions PDF, DOC et DOCX ;
- contrôle MIME ;
- taille maximale de 5 Mo.

Les fichiers sont stockés sur le disque Laravel `local`, ce qui évite un accès public direct.

### Points à confirmer en production

- Le dossier `storage/app/private` ne doit pas être exposé par Nginx.
- Les routes de téléchargement doivent rester derrière `admin.auth`.
- Les noms de fichiers de téléchargement doivent être neutralisés contre les caractères spéciaux.
- Les fichiers doivent être supprimés lorsqu’une candidature est supprimée.
- Les sauvegardes de CV doivent être chiffrées et soumises à une durée de conservation.
- Les accès aux CV doivent être journalisés.

## 7. Configuration de production

Les éléments positifs :

- `APP_DEBUG=false` prévu en production ;
- endpoint de santé Laravel `/up` ;
- HTTPS forcé ;
- sessions chiffrées prévues ;
- cookies sécurisés prévus ;
- PostgreSQL Render configuré ;
- build Docker configuré ;
- build Vite réussi.

### Points manquants ou à confirmer

- `APP_KEY` doit être réellement générée et secrète.
- `MAIL_HOST`, `MAIL_USERNAME` et `MAIL_PASSWORD` doivent être renseignés.
- Le domaine définitif doit remplacer les URLs Render temporaires.
- Les uploads doivent être persistants hors du conteneur si le site est déployé sur une infrastructure éphémère.
- `LOG_CHANNEL` doit être compatible avec la collecte de logs de l’hébergeur.
- Les caches de configuration, routes et vues doivent être reconstruits après chaque déploiement.

Ne jamais versionner :

- `.env` ;
- `.env.production` ;
- `.env.render` ;
- mots de passe ;
- clés API ;
- clés SSH.

Ces fichiers sont actuellement ignorés par Git, mais doivent aussi être exclus des archives et images Docker non nécessaires.

## 8. CI/CD et branches

Le workflow `.github/workflows/deploy.yml` écoute principalement :

- `main` ;
- `production`.

Le fichier `render.yaml` utilise la branche :

- `production-stable`.

### Risque

Les tests, la construction Docker et le déploiement peuvent ne pas s’exécuter sur la même branche que celle utilisée par Render.

### Action recommandée

Choisir une stratégie claire :

1. développement ;
2. pull request ;
3. préproduction ;
4. production ;
5. déploiement depuis une seule branche validée.

Le workflow doit :

- lancer les tests ;
- lancer l’analyse de dépendances ;
- construire l’image Docker ;
- vérifier le health check ;
- publier uniquement après validation ;
- permettre un rollback documenté.

## 9. Monitoring à mettre en place

Le projet possède déjà :

- logs Laravel ;
- logs Render ;
- suivi basique des visiteurs ;
- journalisation de certaines actions admin ;
- détection des requêtes SQL lentes ;
- endpoint `/up`.

Il manque encore un dispositif complet avec :

- monitoring externe de disponibilité ;
- alertes email, SMS ou Teams ;
- suivi des erreurs PHP avec contexte ;
- suivi des erreurs JavaScript ;
- suivi du temps de réponse ;
- surveillance de la base de données ;
- surveillance CPU, mémoire et disque ;
- alerte d’expiration SSL ;
- contrôle automatique des sauvegardes ;
- test périodique de restauration.

Le document de référence est : `MONITORING_AVANT_PUBLICATION.md`.

## 10. Email et formulaires

La configuration locale utilise le mailer `log`, ce qui ne permet pas de confirmer une livraison réelle.

La production prévoit SMTP, mais les paramètres doivent être renseignés et testés.

Tester :

- formulaire de contact ;
- newsletter ;
- candidature à une offre ;
- candidature spontanée ;
- envoi des notifications administratives ;
- réception et délivrabilité ;
- SPF ;
- DKIM ;
- DMARC ;
- limitation anti-spam ;
- taille maximale des pièces jointes.

## 11. SEO et accessibilité

À vérifier avant publication :

- titre unique pour chaque page ;
- description meta unique ;
- URL canonique ;
- sitemap.xml accessible ;
- robots.txt adapté ;
- liens hreflang français/anglais ;
- données structurées si pertinentes ;
- textes alternatifs des images ;
- navigation complète au clavier ;
- contraste suffisant ;
- focus visible ;
- formulaires avec labels ;
- messages d’erreur accessibles ;
- responsive mobile et tablette.

## 12. Frontend et expérience utilisateur

Le build Vite passe avec succès.

Points à contrôler visuellement sur toutes les pages :

- aucun texte coupé ;
- aucune carte qui déborde ;
- aucun chevauchement d’icônes ;
- menus mobiles fonctionnels ;
- animations cohérentes au défilement ;
- animations qui ne bloquent pas les interactions ;
- images correctement chargées ;
- contenu français et anglais cohérent.

Une attention particulière est nécessaire sur les pages qui utilisent beaucoup d’animations et de transformations CSS.

## 13. Docker et déploiement

Le Dockerfile contient :

- PHP-FPM ;
- Nginx ;
- Supervisor ;
- PostgreSQL ;
- extensions GD et intl ;
- Composer ;
- Node et Vite ;
- OPcache ;
- health check Laravel.

À tester dans une image construite :

```bash
docker build -t nere-mining .
docker run --env-file .env.production -p 8080:80 nere-mining
```

Puis vérifier :

```bash
curl -I http://localhost:8080/up
curl -I http://localhost:8080/
```

## Plan de correction prioritaire

### Priorité 1 : avant toute publication

- [ ] Corriger la fermeture prématurée de `AdminUserController`.
- [ ] Faire passer `php artisan route:list`.
- [ ] Mettre Laravel à jour.
- [ ] Relancer tous les tests.
- [ ] Vérifier `APP_KEY`, `APP_DEBUG` et les secrets de production.
- [ ] Tester les routes admin et les formulaires.

### Priorité 2 : avant ouverture publique

- [ ] Aligner la branche CI/CD avec Render.
- [ ] Configurer SMTP.
- [ ] Configurer SPF, DKIM et DMARC.
- [ ] Vérifier le stockage persistant des uploads.
- [ ] Tester les sauvegardes et la restauration.
- [ ] Mettre en place uptime monitoring et alertes.
- [ ] Vérifier les téléchargements privés de CV.

### Priorité 3 : qualité et exploitation

- [ ] Ajouter le suivi des erreurs JavaScript.
- [ ] Finaliser l’audit mobile et accessibilité.
- [ ] Vérifier SEO, sitemap et hreflang.
- [ ] Documenter les procédures d’incident et de rollback.
- [ ] Réaliser un test de charge.
- [ ] Organiser une recette métier complète.

## Conclusion

Le site est avancé et possède déjà une base solide : architecture Laravel, pages bilingues, administration, protections HTTP, limitation de débit, Docker, health check et build frontend.

Il reste toutefois un bloqueur technique immédiat dans `AdminUserController.php`, ainsi qu’une mise à niveau Laravel et une validation de l’exploitation en production. Ces points doivent être traités avant publication.
