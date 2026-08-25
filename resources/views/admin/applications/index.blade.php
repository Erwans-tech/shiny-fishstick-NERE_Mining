@extends('admin.partials.layout')
@section('title', 'Candidatures')
@section('page-title', 'Candidatures reçues')

@section('content')
{{-- Filtres --}}
<form method="GET" action="{{ route('admin.applications.index') }}"
      style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <select name="job" class="filter-select" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:200px;" onchange="this.form.submit()">
        <option value="">Toutes les offres</option>
        @foreach($jobs as $j)
        <option value="{{ $j->id }}" {{ request('job') == $j->id ? 'selected' : '' }}>{{ $j->title }}</option>
        @endforeach
    </select>
    <select name="status" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        @foreach($statuses as $key => $s)
        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $s['label'] }}</option>
        @endforeach
    </select>
    @if(request()->hasAny(['job','status']))
    <a href="{{ route('admin.applications.index') }}" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>
    @endif
    <span style="margin-left:auto;font:600 13px Inter,sans-serif;color:var(--muted);">
        {{ $applications->total() }} candidature(s)
    </span>
</form>

<div class="card">
    <div class="card-header">
        <h2>Candidatures ({{ $applications->total() }})</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Candidat</th>
                    <th>Poste</th>
                    <th>Expérience</th>
                    <th>Statut</th>
                    <th>Reçue le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($applications as $app)
            <tr style="{{ !$app->read_at ? 'font-weight:600;' : '' }}">
                <td>
                    <div style="font-weight:600;">{{ $app->full_name }}</div>
                    <div style="font:12px Inter,sans-serif;color:var(--muted);">{{ $app->email }}</div>
                </td>
                <td class="td-muted">{{ $app->jobOffer?->title ?? '—' }}</td>
                <td class="td-muted">{{ $app->experience_years ?? '—' }}</td>
                <td>
                    @php $s = $statuses[$app->status] ?? ['label'=>$app->status,'badge'=>'badge-gray']; @endphp
                    <span class="badge {{ $s['badge'] }}">{{ $s['label'] }}</span>
                    @if(!$app->read_at)<span class="badge badge-yellow" style="margin-left:4px;font-size:9px;">Nouveau</span>@endif
                </td>
                <td class="td-muted">{{ $app->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-ghost btn-sm">Voir</a>
                    <form method="POST" action="{{ route('admin.applications.destroy', $app) }}"
                          style="display:inline;" onsubmit="return confirm('Supprimer cette candidature ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">✕</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">Aucune candidature.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($applications->hasPages())
    <div class="card-body">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
