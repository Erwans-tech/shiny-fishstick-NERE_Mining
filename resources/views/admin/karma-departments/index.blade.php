@extends('admin.partials.layout')
@section('title','Organigramme Karma')
@section('page-title','Karma → Organigramme')

@section('content')
<form method="GET" action="{{ route('admin.karma-departments.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un département..." aria-label="Rechercher un département"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.karma-departments.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>Départements ({{ $departments->total() }})</h2>
        <a href="{{ route('admin.karma-departments.create') }}" class="btn btn-primary">+ Ajouter</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Ordre</th><th>Libellé FR</th><th>Tag</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($departments as $dept)
            <tr>
                <td class="td-muted">{{ $dept->sort_order }}</td>
                <td>{{ $dept->title_fr }}</td>
                <td class="td-muted">{{ $dept->tag_fr }}</td>
                <td><span class="badge {{ $dept->is_published ? 'badge-green' : 'badge-gray' }}">{{ $dept->is_published ? 'Visible' : 'Masqué' }}</span></td>
                <td>
                    <a href="{{ route('admin.karma-departments.edit', $dept) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.karma-departments.destroy', $dept) }}" style="display:inline;" onsubmit="return confirm('Supprimer ce département ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucun département.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($departments->hasPages())<div class="card-body">{{ $departments->links() }}</div>@endif
</div>
@endsection
