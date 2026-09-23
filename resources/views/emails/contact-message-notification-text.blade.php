NOUVEAU MESSAGE DE CONTACT - NÉRÉ MINING
========================================

Message reçu sur le site web le {{ $message->created_at->format('d/m/Y à H:i') }}

INFORMATIONS DU CONTACT :
-------------------------
Nom : {{ $message->name }}
E-mail : {{ $message->email }}
@if($message->subject)
Sujet : {{ $message->subject }}
@endif
Type de demande : {{ $message->type }}

MESSAGE :
---------
{{ $message->message }}

ACTIONS :
---------
• Répondre : Répondez directement à cet e-mail
• Consulter dans l'admin : {{ config('app.url') }}/admin/messages/{{ $message->id }}

---
Néré Mining - Notification automatique
Généré le {{ now()->format('d/m/Y à H:i') }}