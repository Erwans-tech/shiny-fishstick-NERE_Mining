# Checklist avant publication d’un site internet

## Objectif

Cette checklist regroupe les éléments nécessaires avant la mise en ligne d’un site afin de permettre son exploitation, sa sécurité et son monitoring par le département informatique.

## 1. Domaine et accès sécurisé

- Nom de domaine enregistré et DNS correctement configuré.
- Certificat SSL/TLS valide.
- Redirection automatique de HTTP vers HTTPS.
- Vérification de la date d’expiration du certificat.
- Enregistrements DNS documentés.
- Environnements de test et de production séparés.

## 2. Monitoring technique

Le département informatique doit pouvoir surveiller :

- La disponibilité du site.
- Le temps de réponse et la latence.
- Les erreurs HTTP `4xx` et `5xx`.
- L’utilisation du CPU, de la mémoire et du disque.
- La consommation réseau.
- L’état de la base de données.
- L’espace disque disponible.
- La validité du certificat SSL.
- Les tâches planifiées et files d’attente.

Des alertes doivent être configurées pour les incidents critiques :

- Site indisponible.
- Temps de réponse anormalement élevé.
- Erreurs répétées.
- Disque presque plein.
- Base de données indisponible.
- Certificat bientôt expiré.
- Échec d’une sauvegarde.

## 3. Centralisation des journaux

Les logs doivent être accessibles et centralisés :

- Logs du serveur web.
- Logs de l’application.
- Logs PHP ou du runtime utilisé.
- Logs de la base de données.
- Logs d’authentification.
- Logs des tâches planifiées.
- Logs des déploiements.
- Logs des erreurs JavaScript si nécessaire.

Les logs doivent inclure :

- Date et heure.
- Niveau de gravité.
- Service concerné.
- Identifiant de requête ou de transaction.
- Message d’erreur exploitable.

Ne jamais enregistrer dans les logs :

- Mots de passe.
- Clés API.
- Tokens de session.
- Données bancaires.
- Données personnelles non nécessaires.

## 4. Supervision applicative

Le monitoring applicatif doit permettre de contrôler :

- Les erreurs PHP et JavaScript.
- Les formulaires de contact et de candidature.
- L’envoi des emails.
- Les connexions à la base de données.
- Les appels API externes.
- Les téléchargements de fichiers.
- Les tâches planifiées.
- Les temps de réponse des pages importantes.
- Les parcours critiques des utilisateurs.

Pour un site important, prévoir un outil APM afin de suivre les erreurs, les transactions lentes et les dépendances externes.

## 5. Sécurité

- Pare-feu configuré.
- WAF activé si nécessaire.
- Protection anti-DDoS prévue.
- Comptes administrateurs protégés par MFA.
- Mots de passe forts et uniques.
- Permissions minimales pour les utilisateurs et services.
- Variables d’environnement utilisées pour les secrets.
- Aucun secret stocké dans le dépôt Git.
- En-têtes de sécurité HTTP configurés.
- Protection CSRF active sur les formulaires.
- Validation et échappement des entrées utilisateur.
- Analyse des dépendances et vulnérabilités.
- Mises à jour de sécurité planifiées.
- Accès administrateur limité et journalisé.

## 6. Sauvegardes et restauration

Les éléments suivants doivent être sauvegardés :

- Base de données.
- Fichiers utilisateurs.
- Fichiers de configuration nécessaires.
- Ressources médias importantes.

La politique de sauvegarde doit préciser :

- Fréquence des sauvegardes.
- Durée de conservation.
- Chiffrement des sauvegardes.
- Emplacement indépendant du serveur principal.
- Responsable de la supervision.
- Procédure de restauration.

La restauration doit être testée régulièrement.

Les objectifs suivants doivent être documentés :

- **RPO** : perte maximale de données acceptable.
- **RTO** : délai maximal acceptable pour remettre le service en ligne.

## 7. Traçabilité et audit

- Journal des connexions administrateur.
- Historique des modifications importantes.
- Historique des déploiements.
- Identification de l’auteur de chaque changement.
- Journal des actions sensibles.
- Synchronisation horaire NTP.
- Conservation des événements selon la politique interne.

## 8. Déploiement et exploitation

- Environnements développement, préproduction et production séparés.
- Déploiement reproductible.
- Pipeline CI/CD configuré si possible.
- Tests exécutés avant chaque mise en production.
- Validation manuelle avant publication.
- Procédure de rollback documentée.
- Version de l’application identifiable.
- Variables d’environnement de production documentées.
- Accès SSH ou console limité aux personnes autorisées.
- Aucun outil de debug activé en production.

## 9. Tests avant mise en ligne

### Tests fonctionnels

- Navigation principale.
- Liens internes et externes.
- Formulaires.
- Emails.
- Connexion administrateur.
- Téléchargements.
- Recherche et filtres.
- Pages en français et en anglais si disponibles.

### Tests techniques

- Tests unitaires.
- Tests d’intégration.
- Tests de charge.
- Tests de restauration.
- Tests des alertes.
- Tests de compatibilité navigateurs.
- Tests responsive mobile, tablette et desktop.

### Tests de sécurité

- Scan des vulnérabilités.
- Vérification des permissions.
- Vérification des headers HTTP.
- Vérification des protections CSRF et XSS.
- Vérification de l’absence de secrets exposés.
- Vérification des comptes et accès inutiles.

## 10. Documentation à remettre au département informatique

- Schéma de l’architecture.
- Hébergeur et localisation des services.
- Nom de domaine et DNS.
- Liste des services utilisés.
- Ports et flux réseau nécessaires.
- Technologies et versions utilisées.
- Procédure de déploiement.
- Procédure de rollback.
- Procédure de restauration.
- Procédure de gestion d’incident.
- Contacts techniques et responsables métier.
- Liste des alertes et seuils configurés.
- Politique de conservation des logs.
- Politique de sauvegarde.

## Minimum indispensable avant publication

Le site ne devrait pas être publié sans :

- HTTPS fonctionnel.
- Monitoring de disponibilité.
- Alertes sur les erreurs et l’indisponibilité.
- Logs centralisés.
- Sauvegardes testées.
- Procédure de restauration.
- Gestion sécurisée des accès.
- Protection des secrets.
- Procédure de rollback.
- Documentation technique minimale.
- Responsable clairement identifié en cas d’incident.

## Validation finale

- [ ] Le site est accessible en HTTPS.
- [ ] Les alertes sont testées.
- [ ] Les logs sont consultables.
- [ ] Les sauvegardes sont exécutées et vérifiées.
- [ ] Une restauration a été testée.
- [ ] Les accès administrateurs sont validés.
- [ ] Les vulnérabilités critiques sont corrigées.
- [ ] Le rollback est documenté et réalisable.
- [ ] La documentation a été remise au département informatique.
- [ ] Les responsables d’astreinte sont connus.
