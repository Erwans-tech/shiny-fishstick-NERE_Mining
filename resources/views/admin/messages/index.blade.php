@extends('admin.partials.layout')
@section('title','Messages')
@section('page-title','Messages de contact')

@section('content')
<form method="GET" action="{{ route('admin.messages.index') }}"
      style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un message..." aria-label="Rechercher un message"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:240px;">
    <select name="read" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="">Tous les messages</option>
        <option value="unread" {{ request('read') === 'unread' ? 'selected' : '' }}>Non lus</option>
        <option value="read" {{ request('read') === 'read' ? 'selected' : '' }}>Lus</option>
    </select>
    <select name="status" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>Nouveau</option>
        <option value="reviewing" {{ request('status') === 'reviewing' ? 'selected' : '' }}>En examen</option>
        <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Répondu</option>
        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archivé</option>
    </select>
    <select name="sort" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="recent" {{ request('sort', 'recent') === 'recent' ? 'selected' : '' }}>Plus récents</option>
        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Plus anciens</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request()->hasAny(['q', 'read', 'sort', 'status']))
    <a href="{{ route('admin.messages.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>
    @endif
    <span style="margin-left:auto;font:600 13px Inter,sans-serif;color:var(--muted);">{{ $messages->total() }} message(s)</span>
</form>
<div class="card">
    <div class="card-header">
        <h2>Messages ({{ $messages->total() }})</h2>
        @php $unread = $messages->getCollection()->whereNull('read_at')->count(); @endphp
        @if($unread > 0)<span class="badge badge-red">{{ $unread }} non lu(s)</span>@endif
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Nom</th><th>E-mail</th><th>Type</th><th>Objet</th><th>Date</th><th>Statut</th><th>Action</th></tr></thead>
            <tbody>
            @forelse($messages as $m)
            <tr style="{{ $m->read_at ? '' : 'font-weight:600;' }}">
                <td>{{ $m->name }}</td>
                <td class="td-muted">{{ $m->email }}</td>
                <td><span class="badge badge-gray">{{ $m->type }}</span></td>
                <td class="td-muted">{{ Str::limit($m->subject, 35) }}</td>
                <td class="td-muted">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @php
                        $statusLabels = ['new' => 'Nouveau', 'reviewing' => 'Examen', 'replied' => 'Répondu', 'archived' => 'Archivé'];
                        $statusColors = ['new' => 'badge-orange', 'reviewing' => 'badge-blue', 'replied' => 'badge-green', 'archived' => 'badge-gray'];
                    @endphp
                    <span class="badge {{ $statusColors[$m->status] ?? 'badge-gray' }}">{{ $statusLabels[$m->status] ?? $m->status }}</span>
                </td>
                <td>
                    <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-ghost btn-sm">Voir</a>
                    <form method="POST" action="{{ route('admin.messages.destroy', $m) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">✕</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">Aucun message.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())<div class="card-body">{{ $messages->links() }}</div>@endif
</div>
@endsection
