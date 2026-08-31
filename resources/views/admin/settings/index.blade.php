@extends('admin.partials.layout')
@section('title', 'Paramètres du site')
@section('page-title', 'Paramètres du site')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>⚙️ Paramètres du site</h2>
        <span class="card-header-sub">Configurer les paramètres généraux du site</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin:0 20px 16px;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="card-body">
        @csrf

        @forelse($grouped as $category => $categorySettings)
            <fieldset style="margin-bottom:32px;">
                <legend style="font:600 16px Inter,sans-serif; color:var(--green); text-transform:capitalize; margin-bottom:16px; border-bottom:2px solid var(--line); padding-bottom:12px;">
                    {{ $category }}
                </legend>

                @foreach($categorySettings as $setting)
                    <div class="form-group" style="margin-bottom:20px;">
                        <label for="settings[{{ $setting->key }}]">
                            {{ implode(' ', array_slice(explode('_', $setting->key), 1)) }}
                        </label>

                        @if($setting->type === 'textarea')
                            <textarea name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                      style="width:100%; min-height:120px; padding:10px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif; resize:vertical;">{{ $setting->value }}</textarea>
                        @elseif($setting->type === 'email')
                            <input type="email" name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                   value="{{ $setting->value }}" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                        @elseif($setting->type === 'url')
                            <input type="url" name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                   value="{{ $setting->value }}" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                        @else
                            <input type="text" name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                   value="{{ $setting->value }}" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                        @endif
                    </div>
                @endforeach
            </fieldset>
        @empty
            <p style="color:var(--muted); text-align:center; padding:40px;">Aucun paramètre à afficher.</p>
        @endforelse

        <div style="display:flex; gap:12px; margin-top:28px;">
            <button type="submit" class="btn btn-primary">Enregistrer les paramètres</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </form>
</div>
@endsection
