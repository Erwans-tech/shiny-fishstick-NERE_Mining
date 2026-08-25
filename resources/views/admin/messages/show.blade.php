@extends('admin.partials.layout')
@section('title','Message de '.$message->name)
@section('page-title','Détail du message')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Message de {{ $message->name }}</h2>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
    </div>
    <div class="card-body">
        <div class="form-grid">
            <div class="form-group">
                <label>Expéditeur</label>
                <div style="padding:10px 0;font-size:15px;">{{ $message->name }}</div>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <div style="padding:10px 0;font-size:15px;">
                    <a href="mailto:{{ $message->email }}" style="color:var(--green);">{{ $message->email }}</a>
                </div>
            </div>
            <div class="form-group">
                <label>Type de demande</label>
                <div style="padding:10px 0;"><span class="badge badge-gray">{{ $message->type }}</span></div>
            </div>
            <div class="form-group">
                <label>Date de réception</label>
                <div style="padding:10px 0;color:var(--muted);font-size:14px;">{{ $message->created_at->format('d/m/Y à H:i') }}</div>
            </div>
            @if($message->subject)
            <div class="form-group full">
                <label>Objet</label>
                <div style="padding:10px 0;font-size:15px;font-weight:600;">{{ $message->subject }}</div>
            </div>
            @endif
            <div class="form-group full">
                <label>Message</label>
                <div style="background:#f9f7f4;border:1px solid var(--line);border-radius:6px;padding:16px 18px;font-size:15px;line-height:1.7;white-space:pre-wrap;">{{ $message->message }}</div>
            </div>
        </div>
        <div class="form-actions" style="margin-top:20px;">
            <a href="mailto:{{ $message->email }}?subject=RE: {{ $message->subject }}" class="btn btn-primary">
                Répondre par e-mail
            </a>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" style="display:inline;" onsubmit="return confirm('Supprimer ce message ?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost">← Retour</a>
        </div>
    </div>
</div>
@endsection
