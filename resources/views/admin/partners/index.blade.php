@extends('admin.partials.layout')
@section('title','Partenaires')
@section('page-title','Partenaires institutionnels')

@section('content')
<form method="GET" action="{{ route('admin.partners.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un partenaire..." aria-label="Rechercher un partenaire"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    @if(request('q'))<a href="{{ route('admin.partners.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>@endif
</form>
<div class="card">
    <div class="card-header">
        <h2>Partenaires ({{ $partners->total() }})</h2>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">+ Ajouter</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Logo</th><th>Nom</th><th>Catégorie</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($partners as $p)
            <tr>
                <td>
                    @if($p->logo_path)
                        @php $logoUrl = str_starts_with($p->logo_path,'images/') ? asset($p->logo_path) : asset('uploads/'.$p->logo_path); @endphp
                        <img src="{{ $logoUrl }}" style="height:40px;max-width:80px;object-fit:contain;">
                    @else
                        <span class="badge badge-gray">—</span>
                    @endif
                </td>
                <td>{{ $p->name }}</td>
                <td class="td-muted">{{ $p->category }}</td>
                <td class="td-muted">{{ $p->sort_order }}</td>
                <td><span class="badge {{ $p->is_published ? 'badge-green' : 'badge-gray' }}">{{ $p->is_published ? 'Visible' : 'Masqué' }}</span></td>
                <td>
                    <a href="{{ route('admin.partners.edit', $p) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.partners.destroy', $p) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">Aucun partenaire.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($partners->hasPages())<div class="card-body">{{ $partners->links() }}</div>@endif
</div>
@endsection
