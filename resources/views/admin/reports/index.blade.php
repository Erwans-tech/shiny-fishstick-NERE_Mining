@extends('admin.partials.layout')
@section('title','Publications')
@section('page-title','Publications & Documents')

@section('content')
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
                        <a href="{{ asset('uploads/'.$r->file_path) }}" target="_blank" class="badge badge-green">PDF ↗</a>
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
