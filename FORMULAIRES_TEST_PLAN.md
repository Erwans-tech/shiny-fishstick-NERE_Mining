# Plan de test des formulaires - NERE Mining

## 📋 Formulaires à tester

### 1. **Newsletter** (Accueil + toutes les pages)
- **Route:** `POST /newsletter` ou `POST /en/newsletter`
- **Fields:**
  - `email` (required, email, max:180)
- **Throttle:** `throttle:newsletter` (60 req/min)
- **Actions:**
  - ✅ Email valide → Succès + redirection + message success
  - ❌ Email invalide → Erreur validation
  - ❌ Email dupliqué → Succès silencieux (firstOrCreate)
  - ❌ Spam (>60 requêtes/min) → Erreur 429

**Test rapide:**
```bash
# Valide
POST /newsletter
email=test@nere-mining.bf

# Invalide
POST /newsletter
email=invalid-email

# Spam (>60 fois rapidement)
for i in {1..70}; do
  curl -X POST http://localhost:8000/newsletter -d "email=test$i@example.com"
done
```

---

### 2. **Contact Général** (Page /contact)
- **Routes:** `POST /contact` ou `POST /en/contact`
- **Fields:**
  - `name` (required, string, max:120)
  - `email` (required, email, max:180)
  - `subject` (nullable, string, max:180)
  - `message` (required, string, max:5000)
  - `type` (required, in:general,partenariat,investissement,emploi,fournisseur,presse,communaute,candidature-spontanee)
- **Throttle:** `throttle:contact-form`
- **Stockage:** Table `contact_messages`
- **Réponse:** Email de confirmation (si configuré)

**Types de demande acceptés:**
- general
- partenariat
- investissement
- emploi
- fournisseur
- presse
- communaute
- candidature-spontanee

**Test rapide:**
```bash
# Valide
POST /contact
name=John Doe
email=john@example.com
subject=Partnership proposal
message=I would like to discuss a partnership opportunity...
type=partenariat

# Invalide - name manquant
POST /contact
email=test@example.com
message=Test

# Invalide - type invalide
POST /contact
name=Test
email=test@example.com
type=invalid_type
```

---

### 3. **Candidature à une offre d'emploi**
- **Route:** `POST /offres-emploi/{job:slug}/postuler` ou `POST /en/jobs/{job:slug}/apply`
- **Fields:**
  - `first_name` (required, string, max:80)
  - `last_name` (required, string, max:80)
  - `email` (required, email, DNS check, max:180)
  - `phone` (nullable, regex validation)
  - `nationality` (nullable, max:80)
  - `current_position` (nullable, max:160)
  - `experience_years` (nullable, max:40)
  - `motivation` (required, min:50, max:5000)
  - `cv` (file, PDF/DOC/DOCX, max 5MB, MIME validation)
  - `cover_letter_file` (file, PDF/DOC/DOCX, max 5MB, MIME validation)
- **Throttle:** `throttle:job-apply`
- **Stockage:** Table `job_applications` + fichiers dans `public/uploads/applications/`
- **Validations additionnelles:**
  - ✅ Email existe (DNS check)
  - ✅ Fichiers non malveillants (MIME type check)
  - ✅ Offre publiée + non spontanée

**Test rapide:**
```bash
# Obtenir slug d'une offre
GET /offres-emploi (liste et voir slug)

# Candidature valide
POST /offres-emploi/mining-engineer/postuler
first_name=Jean
last_name=Dupont
email=jean@example.com
phone=+226 76 123 456
motivation=Je suis intéressé par ce poste...
cv=@cv.pdf

# Invalide - email sans DNS
POST /offres-emploi/mining-engineer/postuler
email=test@fakeemail.local (domaine inexistant)

# Invalide - fichier trop gros (>5MB)
POST /offres-emploi/mining-engineer/postuler
cv=@huge_file.pdf (>5MB)
```

---

### 4. **Candidature Spontanée**
- **Routes:** `POST /candidature-spontanee` ou `POST /en/spontaneous-application`
- **Fields:** Idem candidature offre + création auto de JobOffer si n'existe pas
- **JobOffer creée:** 
  - title: "Candidature spontanée"
  - slug: "candidature-spontanee"
  - is_spontaneous: true
  - is_published: false

**Test rapide:**
```bash
POST /candidature-spontanee
first_name=Marie
last_name=Martin
email=marie@example.com
motivation=Je suis intéressée par rejoindre votre équipe...
cv=@cv.pdf
```

---

## 🧪 Checklist de test PRODUCTION

### Avant déploiement
- [ ] Tous les formulaires fonctionnent localement
- [ ] Les validations rejectent les données invalides
- [ ] Les fichiers sont uploadés au bon endroit
- [ ] Les throttles activent après N requêtes

### Après déploiement
- [ ] Newsletter: Tester avec email valide
  - [ ] Email stocké en DB
  - [ ] Pas de doublon si réabonnement
  - [ ] Message success affiché
  
- [ ] Contact: Tester avec message complet
  - [ ] Message stocké en DB
  - [ ] Tous les champs présents
  - [ ] Email de notification reçu (si configuré)
  
- [ ] Candidature offre: Tester avec CV valide
  - [ ] Application stockée en DB
  - [ ] CV accessible dans admin
  - [ ] Fichier dans `public/uploads/applications/`
  - [ ] Email de confirmation reçu
  
- [ ] Candidature spontanée: Tester avec CV
  - [ ] JobOffer créée automatiquement
  - [ ] Application liée correctement
  - [ ] Fichier uploadé
  
- [ ] Throttle: Tester dépassement de limite
  - [ ] Après 60 req/min → Erreur 429
  - [ ] Message d'erreur clair
  
- [ ] Sécurité:
  - [ ] CSRF token présent sur tous les formulaires
  - [ ] Fichiers non-PHP ne peuvent pas être uploadés
  - [ ] Paths traversal impossible (`../../etc/passwd`)
  - [ ] SQL injection impossible
  
- [ ] Emails:
  - [ ] Notifications envoyées (si configuré)
  - [ ] Pas d'envoi avant validation complète
  - [ ] Format HTML/texte correct

---

## 🔍 Commandes de vérification DB

```sql
-- Abonnés newsletter
SELECT * FROM newsletter_subscribers ORDER BY subscribed_at DESC LIMIT 5;

-- Messages de contact
SELECT id, name, email, type, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5;

-- Candidatures
SELECT ja.id, ja.first_name, ja.last_name, ja.email, jo.title, ja.created_at
FROM job_applications ja
LEFT JOIN job_offers jo ON ja.job_offer_id = jo.id
ORDER BY ja.created_at DESC LIMIT 5;
```

---

## 📝 Notes

- Tous les formulaires normalissent l'email: `strtolower(trim($email))`
- Les fichiers reçoivent un nom unique: `$name-$uniqid.$ext`
- Les CVs sont temporairement en `public/uploads/applications/` (pas crypté)
- Validation MIME + extension double (sécurité)
- Rate limiting via middleware `throttle`

---

## Résumé des points critiques

1. ✅ **Validation stricte** - tous les champs validés
2. ✅ **Rate limiting** - protégé contre spam
3. ✅ **File handling** - upload sécurisé avec MIME check
4. ✅ **DB storage** - toutes les données persistées
5. ✅ **Email notifications** - à tester en prod
6. ⚠️ **À tester en production:**
   - SMTP configuré et fonctionnel
   - Répertoires uploads writable
   - Throttles appliqués correctement
