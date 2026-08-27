@extends('admin.partials.layout')
@section('title',"Offres d'emploi")
@section('page-title',"Offres d'emploi")

@section('content')
<form method="GET" action="{{ route('admin.jobs.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Poste, service, lieu..." aria-label="Rechercher une offre"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.jobs.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>Offres ({{ $jobs->total() }})</h2>
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">+ Nouvelle offre</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Poste</th><th>Département</th><th>Lieu</th><th>Date limite</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($jobs as $j)
            <tr>
                <td>{{ $j->title }}</td>
                <td class="td-muted">{{ $j->department }}</td>
                <td class="td-muted">{{ $j->location }}</td>
                <td class="td-muted">{{ $j->deadline?->format('d/m/Y') ?? '—' }}</td>
                <td><span class="badge {{ $j->is_published ? 'badge-green' : 'badge-gray' }}">{{ $j->is_published ? 'Publié' : 'Masqué' }}</span>
                    @if($j->is_spontaneous) <span class="badge badge-yellow" style="margin-left:4px;">Spontanée</span> @endif
                </td>
                <td>
                    <a href="{{ route('admin.jobs.edit', $j) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.jobs.destroy', $j) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">Aucune offre.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($jobs->hasPages())<div class="card-body">{{ $jobs->links() }}</div>@endif
</div>
@endsection
