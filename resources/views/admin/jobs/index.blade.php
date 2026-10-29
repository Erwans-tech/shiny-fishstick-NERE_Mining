@extends('admin.partials.layout')
@section('title',"Offres d'emploi")
@section('page-title',"Offres d'emploi")

@section('content')
<div style="display:flex;gap:8px;margin-bottom:16px;">
    <a href="{{ route('admin.jobs.index') }}"
       class="btn btn-sm {{ $status === 'current' ? 'btn-primary' : 'btn-ghost' }}">En cours ({{ $counts['current'] }})</a>
    <a href="{{ route('admin.jobs.index', ['status' => 'archived']) }}"
       class="btn btn-sm {{ $status === 'archived' ? 'btn-primary' : 'btn-ghost' }}">Archivées ({{ $counts['archived'] }})</a>
</div>
<form method="GET" action="{{ route('admin.jobs.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    @if($status === 'archived')<input type="hidden" name="status" value="archived">@endif
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Intitulé du poste..." aria-label="Rechercher une offre"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.jobs.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>{{ $status === 'archived' ? 'Offres archivées' : 'Offres en cours' }} ({{ $jobs->total() }})</h2>
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">+ Nouvelle offre</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Poste</th><th>Document</th><th>Date limite</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($jobs as $j)
            <tr>
                <td>{{ $j->title }}</td>
                <td class="td-muted">
                    @if($j->offer_file_path)
                        <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($j->offer_file_path) }}"
                           target="_blank" rel="noopener">Consulter le fichier</a>
                    @else
                        Aucun fichier
                    @endif
                </td>
                <td class="td-muted">{{ $j->deadline?->format('d/m/Y') ?? ' -' }}</td>
                <td>
                    @if($j->isExpired())
                        <span class="badge badge-gray">Archivée</span>
                    @else
                        <span class="badge {{ $j->is_published ? 'badge-green' : 'badge-gray' }}">{{ $j->is_published ? 'Publié' : 'Masqué' }}</span>
                    @endif
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
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">{{ $status === 'archived' ? 'Aucune offre archivée.' : 'Aucune offre en cours.' }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($jobs->hasPages())<div class="card-body">{{ $jobs->links() }}</div>@endif
</div>
@endsection
