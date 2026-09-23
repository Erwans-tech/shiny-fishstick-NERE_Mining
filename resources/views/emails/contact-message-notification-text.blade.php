NOUVEAU MESSAGE DE CONTACT - NÉRÉ MINING
========================================

Message reçu sur le site web le {{ $contactMessage->created_at->format('d/m/Y à H:i') }}

INFORMATIONS DU CONTACT :
-------------------------
Nom : {{ $contactMessage->name }}
E-mail : {{ $contactMessage->email }}
@if($contactMessage->subject)
Sujet : {{ $contactMessage->subject }}
@endif
Type de demande : {{ $contactMessage->type }}

MESSAGE :
---------
{{ $contactMessage->message }}

ACTIONS :
---------
• Répondre : Répondez directement à cet e-mail
• Consulter dans l'admin : {{ config('app.url') }}/admin/messages/{{ $contactMessage->id }}

---
Néré Mining - Notification automatique
Généré le {{ now()->format('d/m/Y à H:i') }}