Voici le plan de développement par priorité.

## Priorité 0 — Socle technique

**État : terminé**

- Laravel installé.
- Base SQLite fonctionnelle.
- Vite configuré.
- Logo officiel intégré.
- Photos minières locales ajoutées.
- Page d’accueil responsive.
- Animation du hero.
- Modèle `News` créé.
- Actualités chargées depuis la base de données.

## Priorité 1 — Structure institutionnelle

**Objectif : rendre le site crédible et facile à parcourir**

Créer les pages :

1. **Notre entreprise**
   - Histoire de Néré Mining.
   - Vision et valeurs.
   - Actionnariat.
   - Équipe dirigeante.

2. **La mine de Karma**
   - Localisation.
   - Activités minières.
   - Processus d’exploitation.
   - Photos et vidéos.
   - Chiffres clés.

3. **Développement durable**
   - Environnement.
   - Santé et sécurité.
   - Communautés locales.
   - Emploi local.
   - Gouvernance et éthique.

## Priorité 2 — Rapports et transparence

**Objectif : reprendre l’un des points forts d’Essakane**

Créer :

- une rubrique `Rapports` ;
- des rapports RSE téléchargeables en PDF ;
- des documents environnementaux ;
- des rapports d’activités ;
- des indicateurs visibles :
  - emplois locaux ;
  - formations ;
  - investissements communautaires ;
  - consommation d’eau ;
  - réhabilitation des zones exploitées.

Côté Laravel :

```text
Report
- title
- category
- description
- file_path
- cover_image
- published_at
```

## Priorité 3 — Administration du contenu

**Objectif : permettre à l’équipe de gérer le site sans modifier le code**

Installer Filament et créer un espace administrateur pour gérer :

- actualités ;
- rapports ;
- offres d’emploi ;
- images ;
- pages institutionnelles ;
- messages de contact.

Créer des rôles :

- administrateur ;
- responsable communication ;
- responsable RH ;
- responsable RSE.

## Priorité 4 — Carrières et emploi local

Créer une rubrique **Carrières** avec :

- offres d’emploi ;
- stages ;
- profils recherchés ;
- formulaire de candidature ;
- dépôt de CV ;
- date limite de candidature ;
- statut ouvert ou fermé.

Modèle prévu :

```text
JobOffer
- title
- department
- location
- contract_type
- description
- requirements
- deadline
- is_published
```

## Priorité 5 — Contact et relations communautaires

Créer plusieurs formulaires :

- contact général ;
- candidature ;
- demande presse ;
- fournisseur ;
- communautés locales ;
- signalement ou réclamation.

Prévoir :

- validation Laravel ;
- protection anti-spam ;
- envoi par e-mail ;
- stockage des demandes ;
- tableau de suivi dans l’administration.

## Priorité 6 — Actualités avancées

Améliorer le module déjà créé :

- page détail d’une actualité ;
- catégories ;
- recherche ;
- partage réseaux sociaux ;
- pagination ;
- images optimisées ;
- actualités similaires.

## Priorité 7 — SEO, performance et sécurité

Avant la mise en ligne :

- titres et descriptions SEO ;
- sitemap XML ;
- URLs propres ;
- données Open Graph ;
- compression des images ;
- cache Laravel ;
- sauvegardes de la base ;
- HTTPS ;
- protection des formulaires ;
- gestion des erreurs ;
- tests automatisés.

## Ordre recommandé

```text
1. Pages institutionnelles
2. Développement durable
3. Rapports téléchargeables
4. Administration Filament
5. Carrières
6. Contact et communautés
7. Actualités avancées
8. SEO, sécurité et mise en ligne
```










Je vais dresser une comparaison fonctionnelle, pas seulement visuelle : contenus, navigation, confiance, recrutement, RSE et outils administrables. Je vérifie les éléments actuellement visibles sur les deux sites pour distinguer ce que Néré Mining possède déjà de ce qu’il lui manque réellement.





Read 

Fetched https://iamgoldessakane.com/

Fetched https://www.nere-mining.bf/

Le site d’IAMGOLD Essakane apporte surtout une **organisation institutionnelle complète**. Néré Mining devrait reprendre les fonctionnalités suivantes.

| Fonctionnalité Essakane | Intérêt pour Néré Mining | Priorité |
|---|---|---|
| Présentation détaillée de l’entreprise | Renforcer la crédibilité auprès des investisseurs, autorités et communautés | Haute |
| Page dédiée à Karma | Présenter la mine, sa localisation, ses activités et son impact | Haute |
| Actualités régulièrement mises à jour | Montrer que l’entreprise est active et transparente | Haute |
| Rapports RSE téléchargeables | Prouver les engagements environnementaux et sociaux | Haute |
| Page Développement durable | Détailler environnement, sécurité, communautés et gouvernance | Haute |
| Offres d’emploi | Attirer les talents burkinabè et faciliter les candidatures | Haute |
| Formulaire de contact complet | Permettre les demandes générales, presse, emploi et communautés | Haute |
| Newsletter | Garder le contact avec les partenaires et visiteurs | Moyenne |
| Partenaires institutionnels | Ajouter de la confiance et montrer l’ancrage national | Moyenne |
| Galerie photos et vidéos | Montrer concrètement les équipes, installations et opérations | Moyenne |
| Version bilingue français/anglais | Faciliter la communication avec les partenaires internationaux | Moyenne |
| Page presse et documents officiels | Centraliser communiqués, rapports et informations fiables | Moyenne |

**Ce que Néré Mining possède déjà**

La base actuelle contient déjà :

- une identité visuelle cohérente avec le logo ;
- un hero animé avec des photos officielles de Karma ;
- une présentation de l’entreprise ;
- trois engagements : territoire, environnement, intégrité ;
- une section actualités ;
- une section contact ;
- une structure responsive Laravel/Blade.

Mais les actualités et statistiques sont encore écrites directement dans `web.php`. Elles ne sont pas encore administrables.

**La priorité pour une base solide**

Je recommande cette structure Laravel :

```text
Entreprise
Karma
Développement durable
    Environnement
    Santé et sécurité
    Communautés
    Gouvernance
Actualités
Rapports et documents
Carrières
Partenaires
Contact
```

Puis créer trois modèles administrables :

```text
News
Report
JobOffer
```

Avec Laravel, chaque modèle aurait :

- une migration de base de données ;
- un modèle Eloquent ;
- un contrôleur ;
- une vue publique ;
- une interface d’administration ;
- une gestion des images et fichiers PDF.

Pour l’administration, **Filament** serait adapté : il permettrait à Néré Mining de publier une actualité, ajouter un rapport RSE ou créer une offre d’emploi sans modifier le code.

Le principal avantage à reprendre chez Essakane n’est donc pas seulement le design. C’est surtout la capacité du site à devenir un **centre officiel d’information**, régulièrement mis à jour et utile aux employés, communautés, autorités, candidats et partenaires.