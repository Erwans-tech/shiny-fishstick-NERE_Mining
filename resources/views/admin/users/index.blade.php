@extends('admin.partials.layout')

@section('title', 'Gestion des Administrateurs')
@section('page-title', 'Gestion des Administrateurs')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Liste des Administrateurs ({{ $admins->count() }})</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Nouvel Administrateur</a>
    </div>
    
    @if($admins->isEmpty())
        <div style="padding: 40px; text-align: center; color: var(--muted);">
            <p>👤 Aucun administrateur trouvé.</p>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--green); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px;">
                                    {{ substr($admin->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $admin->name }}</strong>
                                    @if($admin->id === auth()->id())
                                        <span class="badge badge-yellow" style="margin-left: 6px;">Vous</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="td-muted">{{ $admin->email }}</td>
                        <td>
                            @if($admin->is_admin)
                                <span class="badge badge-green">✅ Actif</span>
                            @else
                                <span class="badge badge-gray">⏸️ Inactif</span>
                            @endif
                        </td>
                        <td class="td-muted">{{ $admin->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div style="display: flex; gap: 6px; align-items: center;">
                                <a href="{{ route('admin.users.show', $admin) }}" 
                                   class="btn btn-ghost btn-sm"
                                   title="Voir les détails">
                                    👁️ Voir
                                </a>
                                
                                @if($admin->id !== auth()->id())
                                    <a href="{{ route('admin.users.edit', $admin) }}" 
                                       class="btn btn-ghost btn-sm"
                                       title="Modifier">
                                        ✏️ Modifier
                                    </a>
                                    
                                    <form method="POST" 
                                          action="{{ route('admin.users.toggle', $admin) }}" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir changer le statut de cet administrateur ?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-ghost btn-sm"
                                                title="{{ $admin->is_admin ? 'Désactiver' : 'Activer' }}">
                                            {{ $admin->is_admin ? '⏸️' : '▶️' }}
                                        </button>
                                    </form>
                                    
                                    <form method="POST" 
                                          action="{{ route('admin.users.destroy', $admin) }}" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ? Cette action est irréversible.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                            🗑️
                                        </button>
                                    </form>
                                @else
                                    <span style="color: var(--muted); font-size: 12px;" title="Vous ne pouvez pas modifier votre propre compte">🔒 Protégé</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
@endsection