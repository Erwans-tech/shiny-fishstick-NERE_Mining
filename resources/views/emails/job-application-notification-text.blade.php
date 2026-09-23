NOUVELLE CANDIDATURE - NÉRÉ MINING
==================================

Candidature reçue sur le site web le {{ $application->created_at->format('d/m/Y à H:i') }}

@if($jobOffer)
POSTE VISÉ : {{ $jobOffer->title }}
@if($jobOffer->department)
Département : {{ $jobOffer->department }}
@endif
@endif

INFORMATIONS DU CANDIDAT :
--------------------------
Nom : {{ $application->full_name }}
E-mail : {{ $application->email }}
@if($application->phone)
Téléphone : {{ $application->phone }}
@endif
@if($application->nationality)
Nationalité : {{ $application->nationality }}
@endif
@if($application->current_position)
Poste actuel : {{ $application->current_position }}
@endif
@if($application->experience_years)
Années d'expérience : {{ $application->experience_years }}
@endif

LETTRE DE MOTIVATION :
----------------------
{{ $application->motivation }}

@if($application->cv_path || $application->cover_letter_path)
PIÈCES JOINTES :
----------------
@if($application->cv_path)
• CV - {{ $application->full_name }}
@endif
@if($application->cover_letter_path)
• Lettre de motivation - {{ $application->full_name }}
@endif
(Les fichiers sont joints à cet e-mail)
@endif

ACTIONS :
---------
• Répondre : Répondez directement à cet e-mail
• Consulter dans l'admin : {{ config('app.url') }}/admin/candidatures/{{ $application->id }}
@if($application->cv_path)
• Télécharger CV : {{ config('app.url') }}/admin/candidatures/{{ $application->id }}/cv
@endif

---
Néré Mining - Notification automatique
Généré le {{ now()->format('d/m/Y à H:i') }}