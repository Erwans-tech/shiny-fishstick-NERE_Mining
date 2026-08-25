@extends('admin.partials.layout')
@section('title','Communiqués')
@section('page-title','Communiqués de presse')

@section('content')
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
                        <a href="{{ asset('uploads/'.$d->file_path) }}" target="_blank" class="badge badge-green">Fichier ↗</a>
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
