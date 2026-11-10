@extends('admin.partials.layout')

@section('title', 'Gestion des Utilisateurs')
@section('page-title', 'Gestion des Utilisateurs')

@php
$roleLabels = ['admin' => 'Administrateur', 'hr' => 'RH', 'site_manager' => 'Gérant du site'];
$roleBadges = ['admin' => 'badge-red', 'hr' => 'badge-blue', 'site_manager' => 'badge-green'];
@endphp

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Liste des utilisateurs ({{ $users->count() }})</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Nouvel utilisateur</a>
    </div>

    @if($users->isEmpty())
        <div style="padding: 40px; text-align: center; color: var(--muted);">
            <p>👤 Aucun utilisateur trouvé.</p>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--green); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $user->name }}</strong>
                                    @if($user->id === session('admin_id'))
                                        <span class="badge badge-yellow" style="margin-left: 6px;">Vous</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="td-muted">{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $roleBadges[$user->role] ?? 'badge-gray' }}">
                                {{ $roleLabels[$user->role] ?? $user->role }}
                            </span>
                        </td>
                        <td class="td-muted">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div style="display: flex; gap: 6px; align-items: center;">
                                <a href="{{ route('admin.users.show', $user) }}"
                                   class="btn btn-ghost btn-sm" title="Voir les détails">
                                    👁️ Voir
                                </a>

                                @if($user->id !== session('admin_id'))
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="btn btn-ghost btn-sm" title="Modifier">
                                        ✏️ Modifier
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.users.destroy', $user) }}"
                                          style="display: inline;"
                                          onsubmit="return confirm('Supprimer {{ addslashes($user->name) }} ? Cette action est irréversible.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">🗑️</button>
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
