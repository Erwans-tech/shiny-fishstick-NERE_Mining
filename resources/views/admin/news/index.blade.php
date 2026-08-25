@extends('admin.partials.layout')
@section('title','Actualités')
@section('page-title','Actualités')

@section('content')
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
                <td class="td-muted">{{ $item->published_at?->format('d/m/Y') ?? '—' }}</td>
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
