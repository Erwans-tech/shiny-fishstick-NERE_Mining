@extends('admin.partials.layout')
@section('title','Communiqués')
@section('page-title','Communiqués de presse')

@section('content')
<form method="GET" action="{{ route('admin.press.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un communiqué..." aria-label="Rechercher un communiqué"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.press.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>Communiqués ({{ $documents->total() }})</h2>
        <a href="{{ route('admin.press.create') }}" class="btn btn-primary">+ Nouveau communiqué</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Titre</th><th>Type</th><th>Fichier</th><th>Publication</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($documents as $d)
            <tr>
                <td>{{ $d->title }}</td>
                <td class="td-muted">{{ $d->document_type }}</td>
                <td>
                    @if($d->file_path)
                        <a href="{{ \App\Helpers\StorageHelper::uploadUrl($d->file_path) }}" target="_blank" class="badge badge-green">Fichier ↗</a>
                    @else
                        <span class="badge badge-gray">—</span>
                    @endif
                </td>
                <td class="td-muted">{{ $d->published_at?->format('d/m/Y') ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.press.edit', $d) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.press.destroy', $d) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucun communiqué.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($documents->hasPages())<div class="card-body">{{ $documents->links() }}</div>@endif
</div>
@endsection
