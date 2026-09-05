@extends('admin.partials.layout')
@section('title', 'Equipe de direction')
@section('page-title', 'Equipe de direction')

@section('content')
<form method="GET" action="{{ route('admin.leadership.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un membre..." aria-label="Rechercher un membre" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
</form>
<div class="card">
    <div class="card-header">
        <h2>Membres ({{ $members->total() }})</h2>
        <a href="{{ route('admin.leadership.create') }}" class="btn btn-primary">+ Ajouter</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Photo</th><th>Nom</th><th>Fonction</th><th>Niveau</th><th>Département</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($members as $member)
            <tr>
                <td>
                    @if($member->photo_path)
                        <img src="{{ \App\Helpers\StorageHelper::uploadUrl($member->photo_path) }}" style="width:48px;height:48px;border-radius:50%;object-fit:cover;">
                    @else <span class="badge badge-gray"> -</span> @endif
                </td>
                <td>{{ $member->name }}</td>
                <td class="td-muted">{{ $member->title }}</td>
                <td class="td-muted">{{ [1 => 'DG', 2 => 'DGA', 3 => 'Direction'][$member->hierarchy_level] ?? 'Direction' }}</td>
                <td class="td-muted">{{ $member->department }}</td>
                <td class="td-muted">{{ $member->sort_order }}</td>
                <td><span class="badge {{ $member->is_published ? 'badge-green' : 'badge-gray' }}">{{ $member->is_published ? 'Visible' : 'Masqué' }}</span></td>
                <td>
                    <a href="{{ route('admin.leadership.edit', $member) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.leadership.destroy', $member) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--muted);">Aucun membre configuré.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($members->hasPages())<div class="card-body">{{ $members->links() }}</div>@endif
</div>
@endsection
