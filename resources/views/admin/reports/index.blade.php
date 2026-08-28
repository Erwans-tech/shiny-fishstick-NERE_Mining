@extends('admin.partials.layout')
@section('title','Publications')
@section('page-title','Publications & Documents')

@section('content')
<form method="GET" action="{{ route('admin.reports.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher une publication..." aria-label="Rechercher une publication"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.reports.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>Publications ({{ $reports->total() }})</h2>
        <a href="{{ route('admin.reports.create') }}" class="btn btn-primary">+ Nouvelle publication</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Titre</th><th>Catégorie</th><th>Fichier</th><th>Publication</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($reports as $r)
            <tr>
                <td>{{ $r->title }}</td>
                <td class="td-muted">{{ $r->category }}</td>
                <td>
                    @if($r->file_path)
                        <a href="{{ \App\Helpers\StorageHelper::uploadUrl($r->file_path) }}" target="_blank" class="badge badge-green">PDF ↗</a>
                    @else
                        <span class="badge badge-gray">—</span>
                    @endif
                </td>
                <td class="td-muted">{{ $r->published_at?->format('d/m/Y') ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.reports.edit', $r) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.reports.destroy', $r) }}" style="display:inline;"
                          onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucune publication.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($reports->hasPages())<div class="card-body">{{ $reports->links() }}</div>@endif
</div>
@endsection
