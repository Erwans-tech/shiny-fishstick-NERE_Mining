@extends('admin.partials.layout')
@section('title','Actualités')
@section('page-title','Actualités')

@section('content')
<form method="GET" action="{{ route('admin.news.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher une actualité..." aria-label="Rechercher une actualité"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.news.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>Toutes les actualités ({{ $news->total() }})</h2>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Nouvelle actualité</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Publication</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td class="td-muted">{{ $item->category }}</td>
                <td>
                    @if($item->published_at && $item->published_at->isPast())
                        <span class="badge badge-green">Publié</span>
                    @elseif($item->published_at)
                        <span class="badge badge-yellow">Planifié</span>
                    @else
                        <span class="badge badge-gray">Brouillon</span>
                    @endif
                </td>
                <td class="td-muted">{{ $item->published_at?->format('d/m/Y') ?? ' -' }}</td>
                <td>
                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.news.destroy', $item) }}"
                          style="display:inline;"
                          onsubmit="return confirm('Supprimer cet article ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucune actualité.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($news->hasPages())
    <div class="card-body">{{ $news->links() }}</div>
    @endif
</div>
@endsection
