# Audit GA4 / Cookies / Consentement – Néré Mining

Date : 4 septembre 2026  
Projet : Néré Mining  
Branche : `prod-finale`

---

## 1. Résumé exécutif

Le site dispose d’un système de tracking interne côté serveur, mais il ne présente aucune preuve d’implémentation de Google Analytics 4 (GA4), aucun bandeau de consentement cookies, et aucune politique de confidentialité / cookies clairement exposée à l’utilisateur.

En l’état, le site est fonctionnelement avancé, mais il n’est pas conforme à une configuration de publication moderne pour un site qui veut utiliser des outils de mesure, du marketing digital ou un analytics tiers.

### Constat actuel

- Tracking interne serveur : oui
- GA4 / gtag : non configuré
- Bandeau de consentement : non présent
- Politique de confidentialité / cookies : non confirmée
- Sécurité des cookies de session Laravel : oui, partiellement conforme
- Conformité RGPD / CNIL pour outils tiers : non validée

---

## 2. Google Analytics / GA4 : pas de preuve d’implémentation

J’ai recherché dans le code et les vues les éléments suivants :

- `GA4`
- `gtag`
- `GoogleAnalytics`
- `analytics_storage`
- `consent`
- `cookie consent`
- `banner de consentement`
- `politique cookies`
- `cookie policy`

### Résultat

Aucun élément concret n’indique une mise en place de GA4 ou d’un tag de mesure tiers dans le site.

### Ce qui existe réellement

Le projet contient un suivi interne de visites via un middleware et un modèle Laravel :

- `app/Http/Middleware/TrackVisitor.php`
- `app/Models/SiteAnalytics.php`

Cette logique enregistre :

- URL de la page visitée
- référent
- user-agent
- type d’appareil
- IP hashée
- heure de visite

C’est un tracking utile pour des statistiques internes, mais ce n’est pas du GA4. Et si cette mesure interne utilise des cookies non essentiels, il faut aussi la documenter et la gérer avec consentement.

### Conclusion

Pour l’instant :

- tracking interne = oui
- GA4 = non configuré
- consentement cookies = non présent
- politique cookies = non confirmée

---

## 3. Cookies : sécurisation partielle, mais pas de consentement

La configuration Laravel des cookies est bien positionnée sur la sécurité de base, notamment dans :

- `config/session.php`

### Ce qui est bien configuré

On observe :

- session sécurisée
- `http_only` activé
- `SameSite` en `lax`
- `secure` activé par défaut
- nom de session neutre (`nm_session`)

Cela est bon pour la sécurité du cookie de session et limite les risques de vol ou d’accès JavaScript aux cookies.

### Ce qui manque encore

Cela ne remplace pas :

- un bandeau de consentement cookies
- une politique de confidentialité claire
- une politique cookies précise
- le traitement explicite des analytics tiers
- l’information sur les cookies techniques, analytiques et marketing
- la conformité RGPD / CNIL si on utilise des outils tiers

### Ce que cela signifie en pratique

La sécurisation de session Laravel est nécessaire, mais elle n’est pas suffisante pour un site public qui décide d’installer :

- Google Analytics
- Meta Pixel
- Hotjar
- Clarity
- A/B testing
- cookies marketing

Pour ces outils, le consentement de l’utilisateur doit être géré explicitement avant le déclenchement des scripts non essentiels.

---

## 4. Pourquoi c’est important avant publication

Avant de mettre un site public en ligne, le département informatique ou la direction doit savoir exactement :

- quels outils de mesure sont utilisés ;
- quels cookies sont déposés ;
- quelles permissions sont nécessaires ;
- quelles données sont collectées ;
- qui les exploite ;
- comment le consentement est obtenu ;
- comment les demandes d’exercice de droits RGPD sont gérées.

### Risques si rien n’est mis en place

- non-conformité RGPD
- signalement de cookies non consentis
- blocage des scripts par navigateurs modernes
- mauvaise perception de la marque
- absence de preuve de conformité en cas de contrôle

---

## 5. Ce qu’il faut faire avant publication

### Option A – Solution simple et solide

Utiliser uniquement le tracking interne ou un outil de mesure robuste avec consentement explicite.

#### À faire :

1. Décider si le site doit utiliser Google Analytics ou non.
2. Si OUI : installer le script GA4 avec consentement préalable.
3. Si NON : documenter le tracking interne et vérifier qu’aucun cookie non essentiel n’est déposé sans consentement.
4. Ajouter un bandeau de consentement.
5. Publier une page “Politique de confidentialité” et une page “Politique cookies”.
6. Vérifier les cookies et les scripts en mode navigateur réel.

### Option B – GA4 + consentement complet

C’est la solution la plus standard pour un site institutionnel ou corporate.

#### Il faut mettre en place :

- `GA_MEASUREMENT_ID` dans les variables d’environnement
- script GA4 chargé uniquement après consentement analytique
- panneau de consentement visible dès l’arrivée sur le site
- possibilité de refuser / accepter / personnaliser
- stockage du choix utilisateur dans un cookie local
- script de mesure activé uniquement si consentement = accepté

---

## 6. Ce qu’il faut ajouter techniquement dans Laravel

### 6.1. Variables d’environnement

Ajouter dans `.env` :

```env
APP_ENV=production
APP_DEBUG=false

GA_MEASUREMENT_ID=G-XXXXXXXXXX
GA_ENABLED=true
```

### 6.2. Ajouter le script GA4 uniquement après consentement

Dans le layout principal, ajouter un script de base qui ne charge GA4 qu’après acceptation.

Exemple conceptuel :

```html
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('consent', 'default', {
    'ad_storage': 'denied',
    'analytics_storage': 'denied',
    'wait_for_update': 500
  });
</script>
```

Puis, après consentement :

```html
<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_MEASUREMENT_ID') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ env('GA_MEASUREMENT_ID') }}');
  gtag('consent', 'update', {
    'analytics_storage': 'granted'
  });
</script>
```

### 6.3. Créer un bandeau de consentement

Créer un composant Blade comme :

- `resources/views/partials/cookie-banner.blade.php`

Exemple de structure :

```blade
<div id="cookie-banner" class="cookie-banner" style="display:none;">
    <div class="cookie-banner__content">
        <p>
            Nous utilisons des cookies pour améliorer votre navigation et mesurer l’audience du site.
            Vous pouvez accepter ou refuser les cookies non essentiels.
        </p>
        <div class="cookie-banner__actions">
            <button type="button" id="cookie-reject">Refuser</button>
            <button type="button" id="cookie-accept">Accepter</button>
            <a href="{{ route('privacy') }}">En savoir plus</a>
        </div>
    </div>
</div>
```

### 6.4. Ajouter le JS de consentement

Créer un fichier JavaScript du type :

- `public/js/cookie-consent.js`

Exemple :

```javascript
document.addEventListener('DOMContentLoaded', function () {
    const banner = document.getElementById('cookie-banner');
    const acceptBtn = document.getElementById('cookie-accept');
    const rejectBtn = document.getElementById('cookie-reject');

    const consentKey = 'nm_cookie_consent';

    const saveConsent = (choice) => {
        localStorage.setItem(consentKey, choice);
        if (choice === 'accepted') {
            window.gtag?.('consent', 'update', { analytics_storage: 'granted' });
        } else {
            window.gtag?.('consent', 'update', { analytics_storage: 'denied' });
        }
        banner.style.display = 'none';
    };

    const consent = localStorage.getItem(consentKey);

    if (!consent) {
        banner.style.display = 'block';
    } else {
        banner.style.display = 'none';
    }

    acceptBtn?.addEventListener('click', () => saveConsent('accepted'));
    rejectBtn?.addEventListener('click', () => saveConsent('rejected'));
});
```

### 6.5. Charger le script dans le layout

Dans le layout principal :

```blade
@include('partials.cookie-banner')
<script src="{{ asset('js/cookie-consent.js') }}"></script>
```

### 6.6. Ajouter les pages légales

Créer au minimum :

- page “Politique de confidentialité”
- page “Politique cookies”
- éventuellement page “Mentions légales”

Ces pages doivent détailler :

- quels cookies sont utilisés ;
- s’ils sont nécessaires ou non ;
- quelle durée de conservation ;
- qui reçoit les données ;
- les outils tiers ;
- les droits des utilisateurs.

---

## 7. Recommandation de conformité pour ce projet

Pour ce site, je recommande formellement :

### Recommandation 1 — décider du modèle analytique

- soit le site ne collecte aucun analytics tiers ;
- soit il utilise GA4 avec consentement explicite.

### Recommandation 2 — ne pas lancer GA4 avant consentement

Le script ne doit pas s’exécuter tant que l’utilisateur n’a pas accepté les cookies analytiques.

### Recommandation 3 — documenter le tracking interne

Le tracking interne du serveur doit être clairement déclaré dans la politique, surtout s’il comporte :

- adresse IP
- user-agent
- referrer
- pages visitées

### Recommandation 4 — ajouter un mécanisme de refus simple

Le bouton “Refuser” doit être aussi visible que le bouton “Accepter”.

### Recommandation 5 — garder la sécurité des cookies de session

Les cookies techniques essentiels restent autorisés sans consentement, mais les cookies analytiques doivent être soumis à consentement.

---

## 8. Verdict final

### Verdict

Le site est bien avancé techniquement, mais il manque encore une couche de conformité et de signalétique pour la publication.

### En l’état

- Le site peut être utilisé localement et tester techniquement.
- Il n’a pas encore de mise en place GA4 visible et validée.
- Il n’a pas de consentement cookies ni de politique cookies claire.
- Il n’est pas totalement prêt pour une publication publique sans cette couche.

### Conclusion

Avant de publier sur Internet, il faut impérativement :

1. choisir la stratégie analytics ;
2. mettre en place GA4 ou supprimer l’idée de mesure tiers ;
3. ajouter un bandeau cookies conforme ;
4. rédiger les pages de confidentialité et cookies ;
5. sécuriser et documenter le tracking interne ;
6. vérifier le comportement en navigation réelle.

---

## 9. Checklist rapide à mettre en place

- [ ] Choix GA4 oui/non
- [ ] Script GA4 chargé après consentement
- [ ] Bandeau cookies fonctionnel
- [ ] Refuser / Accepter / En savoir plus
- [ ] Vérification du stockage du consentement
- [ ] Page Politique de confidentialité
- [ ] Page Politique cookies
- [ ] Documentation du tracking interne
- [ ] Vérification des cookies dans le navigateur
- [ ] Validation avant publication

---

## 10. Recommandation finale

Si le but est de publier un site pro et professionnel, la meilleure solution est :

- garder les cookies techniques nécessaires pour la session Laravel ;
- ajouter GA4 seulement après consentement explicite ;
- publier une politique cookies claire ;
- documenter le tracking interne ;
- tester en production réelle avant mise en ligne.

Cela permet une base solide pour le monitoring, la conformité, et la qualité de l’expérience utilisateur.

---

## 11. Comment faire concrètement

### Étape 1 – Choisir le mode marketing

- Si vous voulez mesurer le trafic : activez GA4.
- Si vous n’avez pas besoin de GA4 : gardez le tracking interne et documentez-le soigneusement.

### Étape 2 – Activer GA4 avec consentement

- Créer un compte Google Analytics
- Ajouter la propriété GA4
- Récupérer le `Measurement ID` : `G-XXXXXXXXXX`
- Le stocker dans `.env`
- Charger le script seulement après consentement
- Gérer la persistance du choix dans `localStorage`

### Étape 3 – Ajouter le bandeau

- Créer un composant Blade pour le message
- Ajouter un bouton “Accepter” et un bouton “Refuser”
- L’afficher au chargement si l’utilisateur n’a pas encore choisi
- Stocker son choix pour la session suivante

### Étape 4 – Ajouter les pages légales

- Page politique de confidentialité
- Page politique cookies
- Page mentions légales si nécessaire

### Étape 5 – Vérifier en navigateur

- Ouvrir le site en mode privé
- Vérifier que le bandeau s’affiche
- Refuser puis recharger : aucune donnée analytique doit être envoyée
- Accepter puis vérifier que les événements GA4 partent bien

### Étape 6 – Publier seulement après validation

Ne pas rendre le site public tant que :

- le consentement est fonctionnel ;
- le script GA4 ne s’exécute qu’après acceptation ;
- les pages légales sont présentes ;
- les cookies sont contrôlés et documentés.

---

## 12. En une phrase

Le site n’a pas encore de GA4 ni de consentement cookies visibles, et cela doit être réglé avant publication pour sécuriser à la fois la conformité, la transparence, et le monitoring de trafic.
