@extends('admin.partials.layout')

@section('title', 'Utilisateur — ' . $user->name)
@section('page-title', 'Détail utilisateur')

@php
$roleLabels = ['admin' => 'Administrateur', 'hr' => 'RH', 'site_manager' => 'Gérant du site'];
$roleBadges = ['admin' => 'badge-red', 'hr' => 'badge-blue', 'site_manager' => 'badge-green'];
@endphp

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display:flex;align-items:center;gap:14px;">
            <div style="width:48px;height:48px;border-radius:50%;background:var(--green);color:#fff;display:flex;align-items:center;justify-content:center;font:700 20px Inter,sans-serif;flex-shrink:0;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="font:600 16px Inter,sans-serif;color:var(--ink);">{{ $user->name }}</div>
                <div style="font:14px Inter,sans-serif;color:var(--muted);">{{ $user->email }}</div>
            </div>
        </div>
        <div style="display:flex;gap:8px;">
            @if($user->id !== session('admin_id'))
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">✏️ Modifier</a>
            @endif
            <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div>
                <div style="font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:4px;">Rôle</div>
                <span class="badge {{ $roleBadges[$user->role] ?? 'badge-gray' }}">
                    {{ $roleLabels[$user->role] ?? $user->role }}
                </span>
            </div>
            <div>
                <div style="font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:4px;">Email vérifié</div>
                @if($user->email_verified_at)
                    <span class="badge badge-green">✅ Vérifié le {{ $user->email_verified_at->format('d/m/Y') }}</span>
                @else
                    <span class="badge badge-yellow">⏳ Non vérifié</span>
                @endif
            </div>
            <div>
                <div style="font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:4px;">Compte créé le</div>
                <div style="font:14px Inter,sans-serif;">{{ $user->created_at->format('d/m/Y à H:i') }}</div>
            </div>
            <div>
                <div style="font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:4px;">Dernière modification</div>
                <div style="font:14px Inter,sans-serif;">{{ $user->updated_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>

        @if($user->id !== session('admin_id'))
            <div style="margin-top:28px;padding-top:20px;border-top:1px solid var(--line);display:flex;gap:12px;">
                <form method="POST"
                      action="{{ route('admin.users.destroy', $user) }}"
                      onsubmit="return confirm('Supprimer définitivement {{ addslashes($user->name) }} ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
