@extends('admin.partials.layout')
@section('title', 'Certifications')
@section('page-title', 'Certifications')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>🏆 Certifications (ISO, EITI, ESG)</h2>
        <a href="{{ route('admin.certifications.create') }}" class="btn btn-primary btn-sm">+ Ajouter</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin:0 20px 16px;">{{ session('success') }}</div>
    @endif

    @if($certifications->isEmpty())
        <div style="padding:40px 20px; text-align:center; color:var(--muted); font-size:13px;">
            Aucune certification pour le moment.
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Émise le</th>
                        <th>Expire le</th>
                        <th>Statut</th>
                        <th style="width:140px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certifications as $cert)
                        <tr>
                            <td style="font-weight:600;">{{ $cert->name }}</td>
                            <td class="td-muted">{{ Str::limit($cert->description, 40) }}</td>
                            <td class="td-muted">{{ $cert->issued_at?->format('d/m/Y') ?? '—' }}</td>
                            <td class="td-muted">
                                @if($cert->expires_at)
                                    {{ $cert->expires_at->format('d/m/Y') }}
                                    @if($cert->isExpired())
                                        <span class="badge badge-red" style="font-size:10px;">Expiré</span>
                                    @endif
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if($cert->is_active)
                                    <span class="badge badge-green">Actif</span>
                                @else
                                    <span class="badge badge-gray">Inactif</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <a href="{{ route('admin.certifications.edit', $cert) }}" class="btn btn-ghost btn-sm">Modifier</a>
                                <form method="POST" action="{{ route('admin.certifications.destroy', $cert) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">✕</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($certifications->hasPages())
            <div class="pagination-wrap">
                {{ $certifications->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
