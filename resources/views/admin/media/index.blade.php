@extends('admin.partials.layout')
@section('title','Médiathèque')
@section('page-title','Médiathèque')

@section('content')
<form method="GET" action="{{ route('admin.media.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un média..." aria-label="Rechercher un média"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.media.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>Médias ({{ $assets->total() }})</h2>
        <a href="{{ route('admin.media.create') }}" class="btn btn-primary">+ Ajouter un média</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Aperçu</th><th>Titre</th><th>Type</th><th>Emplacement</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($assets as $a)
            <tr>
                <td>
                    @if($a->type === 'image' && $a->url)
                        <img src="{{ $a->url }}" style="height:48px;width:72px;object-fit:cover;border-radius:4px;">
                    @elseif($a->external_url)
                        <a href="{{ $a->external_url }}" target="_blank" rel="noopener" class="badge badge-green">Lien ↗</a>
                    @else
                        <span class="badge badge-gray">{{ strtoupper($a->type) }}</span>
                    @endif
                </td>
                <td>{{ $a->title }}</td>
                <td class="td-muted">{{ $a->type }}</td>
                <td><span class="badge {{ $a->placement === 'homepage_slideshow' ? 'badge-green' : 'badge-gray' }}">{{ $a->placement === 'homepage_slideshow' ? 'Accueil' : 'Médiathèque' }}</span></td>
                <td class="td-muted">{{ $a->sort_order }}</td>
                <td><span class="badge {{ $a->is_published ? 'badge-green' : 'badge-gray' }}">{{ $a->is_published ? 'Visible' : 'Masqué' }}</span></td>
                <td>
                    <a href="{{ route('admin.media.edit', $a) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.media.destroy', $a) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">Aucun média.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($assets->hasPages())<div class="card-body">{{ $assets->links() }}</div>@endif
</div>
@endsection
