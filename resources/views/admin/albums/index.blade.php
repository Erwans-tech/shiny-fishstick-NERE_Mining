@extends('admin.partials.layout')
@section('title','Albums Photo')
@section('page-title','Albums Photo')

@section('content')
<form method="GET" action="{{ route('admin.albums.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un album..." aria-label="Rechercher un album"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.albums.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>

<div class="card">
    <div class="card-header">
        <h2>Albums Photo ({{ $albums->total() }})</h2>
        <a href="{{ route('admin.albums.create') }}" class="btn btn-primary">+ Créer un album</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Couverture</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Photos</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($albums as $album)
            <tr>
                <td>
                    @if($album->cover_url)
                        <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" 
                             style="height:48px;width:72px;object-fit:cover;border-radius:4px;">
                    @else
                        <div style="height:48px;width:72px;background:var(--sand);border-radius:4px;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:20px;">📷</div>
                    @endif
                </td>
                <td><strong>{{ $album->title }}</strong></td>
                <td class="td-muted" style="max-width:300px;">{{ Str::limit($album->description, 80) }}</td>
                <td>
                    <span class="badge badge-blue">{{ $album->media_count }} {{ $album->media_count > 1 ? 'photos' : 'photo' }}</span>
                </td>
                <td class="td-muted">{{ $album->sort_order }}</td>
                <td>
                    <span class="badge {{ $album->is_published ? 'badge-green' : 'badge-gray' }}">
                        {{ $album->is_published ? 'Publié' : 'Brouillon' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        <a href="{{ route('admin.albums.show', $album) }}" class="btn btn-ghost btn-sm" title="Voir les photos">👁️ Voir</a>
                        <a href="{{ route('admin.albums.edit', $album) }}" class="btn btn-ghost btn-sm">Modifier</a>
                        <form method="POST" action="{{ route('admin.albums.destroy', $album) }}" style="display:inline;" 
                              onsubmit="return confirm('Supprimer cet album ? Les photos ne seront pas supprimées.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">
                    <div style="font-size:48px;margin-bottom:16px;">📸</div>
                    <p>Aucun album créé.</p>
                    <a href="{{ route('admin.albums.create') }}" class="btn btn-primary" style="margin-top:12px;">Créer le premier album</a>
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($albums->hasPages())
        <div class="card-body">{{ $albums->links() }}</div>
    @endif
</div>

<div class="card" style="margin-top:24px;background:var(--sand);">
    <div class="card-body">
        <h3 style="margin-bottom:12px;font-size:16px;">💡 Comment ça marche ?</h3>
        <ol style="padding-left:20px;line-height:1.8;">
            <li>Créez un album avec un titre et une description</li>
            <li>Ajoutez une image de couverture (optionnelle)</li>
            <li>Allez dans <strong>Médiathèque</strong> pour ajouter des photos à cet album</li>
            <li>Les albums s'affichent sur la page Médiathèque avec un carousel des photos</li>
        </ol>
    </div>
</div>
@endsection
