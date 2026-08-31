@extends('admin.partials.layout')

@section('title', 'Abonnés newsletter')
@section('page-title', 'Abonnés newsletter')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>📧 Liste des abonnés</h2>
        <div style="display:flex; align-items:center; gap:12px;">
            <span class="badge badge-blue">{{ $count }} inscrit(s)</span>
            <a href="{{ route('admin.newsletter.export') }}" class="btn btn-ghost btn-sm" style="margin-left:auto;">📥 Exporter CSV</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin:0 20px 16px;">{{ session('success') }}</div>
    @endif

    {{-- Barre de recherche --}}
    <div style="padding:16px 20px; border-bottom:1px solid var(--line); background:#faf8f4;">
        <form method="GET" style="display:flex; gap:12px; align-items:center;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher par email..." 
                   style="flex:1; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
            <button type="submit" class="btn btn-primary btn-sm">Chercher</button>
            @if(request('q'))
                <a href="{{ route('admin.newsletter.index') }}" class="btn btn-ghost btn-sm">Réinitialiser</a>
            @endif
        </form>
    </div>

    @if($subscribers->isEmpty())
        <div style="padding: 28px 20px; text-align:center; color:var(--muted); font-size:13px;">
            Aucun abonné pour le moment{{ request('q') ? ' (aucun résultat pour votre recherche)' : '' }}.
        </div>
    @else
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Abonné le
                            @if(request('sort') !== 'oldest')
                                <a href="{{ route('admin.newsletter.index', [...request()->query(), 'sort' => 'oldest']) }}" style="margin-left:6px; color:var(--muted); font-size:11px;">↑</a>
                            @else
                                <a href="{{ route('admin.newsletter.index', array_merge(request()->query(), ['sort' => 'newest'])) }}" style="margin-left:6px; color:var(--muted); font-size:11px;">↓</a>
                            @endif
                        </th>
                        <th style="width:120px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('d/m/Y H:i') : '—' }}</td>
                            <td style="text-align:right;">
                                <form action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST" onsubmit="return confirm('Supprimer cet abonné ?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $subscribers->links() }}
        </div>
    @endif
</div>
@endsection
