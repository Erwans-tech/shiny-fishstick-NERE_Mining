# Plan d'implémentation : Modifications Néré Mining (resu.md)

Ce document décrit les actions qui seront entreprises pour appliquer les changements demandés sur le site web.

## Questions Ouvertes / Précisions Requises

> [!IMPORTANT]
> **Images de conformité** : Vous avez demandé d'ajouter les "images de conformité présentes sur le site actuel (à récupérer sur l'ancien site)" sur la page "Notre identité". Pouvez-vous me fournir ces images (ou m'indiquer où elles se trouvent exactement dans l'arborescence si elles y sont déjà) et me préciser à quel endroit de la page vous souhaitez les insérer ?
> 
> **Espace Admin** : Pour l'ajout de la section "Karma → Organigramme" dans l'espace Admin, pouvez-vous m'indiquer quel système d'administration Laravel est utilisé (Filament, Nova, Voyager, ou contrôleurs sur mesure) et dans quel répertoire se trouvent les vues/contrôleurs d'administration ?
>
> **Répétitions de titres** : Pour le point "retirer les répétitions de titres" (toutes les autres pages), s'agit-il de supprimer le fil d'Ariane, ou bien les titres en `h2` qui répètent parfois le titre `h1` du *masthead* ?

---

## Modifications Proposées

### 1. Page "Nos projets"
#### [MODIFY] `resources/views/pages/projects.blade.php`
- Modification de l'image du projet CIL (`cil-01.png`) pour l'agrandir (suppression des classes de marge négative et ajout de styles pour qu'elle prenne toute la largeur disponible).
- Suppression complète de la section `<!-- Carte des permis -->`.
- Suppression complète de la section `<!-- Rejoignez-nous -->` (incluant "Partenariats et investissements").

### 2. Page "Développement durable" → Contenu local
#### [MODIFY] `resources/views/pages/local-content.blade.php`
- Suppression du bloc *call-to-action* (fond vert) incitant à "Devenir fournisseur partenaire".

### 3. Page "Notre identité"
#### [MODIFY] `resources/views/pages/company-identity.blade.php`
- *En attente de précision sur les images de conformité.*

### 4. Vision et valeurs
#### [MODIFY] `resources/views/pages/company-values.blade.php`
- La section a actuellement une structure `.grid-4` affichant 4 valeurs. Les valeurs "Sécurité" et "Respect de la communauté" sont déjà absentes de la boucle actuelle (index 1 à 4). Nous allons modifier l'agencement (`.grid-4` en `.grid-2`) pour avoir des *cards* plus grandes et mieux équilibrées visuellement pour les 4 valeurs restantes (Intégrité, Professionnalisme, Respect, Esprit d'équipe).

### 5. Page "Karma"
#### [MODIFY] `resources/views/pages/karma.blade.php`
- **Réorganisation** : Inversion de l'ordre des sections "Historique" et "Localisation" dans le bloc présentation.
- **Design** : Les cartes de la section présentation seront uniformisées (suppression du fond sable `var(--sand)` ou ajustement de la couleur pour s'harmoniser avec la section).
- **Texte** : Ajout d'une balise `<style>` locale pour centrer les titres `h2`/`h4` de la page et justifier l'ensemble des paragraphes `p`.
- **Admin** : *En attente de précision pour la gestion de l'organigramme.*

### 6. Ressources et réserves
#### [MODIFY] `resources/views/pages/resources.blade.php`
- Augmentation de la hauteur de l'image de la section *hero* (passage de `320px` à `400px` ou `450px`).
- Augmentation de la taille des images de la galerie en bas de page (passage de `240px` à `320px` de haut).

### 7. Page "CIL"
#### [MODIFY] `resources/views/pages/cil-project.blade.php`
- Ajout d'une balise `<style>` pour augmenter la taille de la police (`font-size: 1.15rem`) des paragraphes `p`.
- Centrage des titres `h2` et `h3`, et justification du texte des paragraphes.

---

### 8. Retouches générales (Toutes pages / Accueil)

#### [MODIFY] `resources/views/layouts/app.blade.php`
- **Header** : Augmentation du `padding` du `<header>` pour l'agrandir visuellement.
- **Textes généraux** : Légère augmentation du `font-size` global dans le CSS du `body` pour accroître la lisibilité.
- **Titres H1** : Ajout de styles globaux (`.masthead h1 { text-align: center; }`) pour forcer le centrage partout, et suppression du petit texte au-dessus (`.eyebrow`).
- **Footer** : Ajout d'un bouton rouge ou doré "Nous contacter" bien visible, et intégration du logo/mention "IPRE" si nécessaire. (Le pied de page mentionne déjà "I P R E" mais le design sera revu selon la demande).

#### [MODIFY] `resources/views/partials/_nav.blade.php`
- **Liens rapides** : *Note: les liens rapides sont présents sur la page d'accueil, pas dans le `<nav>` principal.* S'il s'agit du menu, aucune modification n'est requise. Si c'est sur la page d'accueil, la section correspondante sera masquée (cf. `home.blade.php`).

#### [MODIFY] `resources/views/home.blade.php`
- **Actualités** : Remplacement du titre "Dernières actualités" par "Actualités" et centrage.
- **Partenaires** : Réduction du `padding` et des tailles maximales d'images dans `.partner-logo-item` et `.partner-card` pour diminuer la hauteur globale du bloc.
- **Bloc Contact** : Suppression de la section "Une question ou un projet ?" (`.cta-sec`).
- **Liens rapides** : S'il s'agit des "Liens rapides vers les rubriques principales" (section `.ql-sec`), cette section sera supprimée.

## Plan de vérification
- **Vérification visuelle** : Je vérifierai que les blocs ont bien disparu.
- **Responsive** : Je vérifierai que les modifications de grille (`.grid-2`) et d'images s'affichent correctement sur écran large et s'adaptent aux mobiles.
- **Navigation** : Je validerai que le reste de la navigation reste fonctionnel malgré le changement de taille du header.
