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
                    @if($category === 'carousel')
                        🎬 Carrousel héro
                    @else
                        {{ $category }}
                    @endif
                </legend>

                @foreach($categorySettings as $setting)
                    @php
                        $labelText = implode(' ', array_slice(explode('_', $setting->key), 1));
                        $descriptions = [
                            'carousel_autoplay' => 'Active la rotation automatique des slides',
                            'carousel_interval' => 'Durée d\'affichage de chaque slide (en millisecondes)',
                            'carousel_transition_speed' => 'Vitesse de transition entre les slides (en millisecondes)',
                            'carousel_pause_on_hover' => 'Mettre en pause le carrousel au survol de la souris',
                            'carousel_show_indicators' => 'Afficher les points indicateurs en bas',
                            'carousel_show_arrows' => 'Afficher les flèches de navigation',
                        ];
                    @endphp

                    <div class="form-group" style="margin-bottom:20px;">
                        @if($setting->type === 'boolean')
                            {{-- Toggle switch pour boolean --}}
                            <div class="toggle-wrap">
                                <input type="hidden" name="settings[{{ $setting->key }}]" value="false">
                                <input type="checkbox" id="settings_{{ $setting->key }}" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="true"
                                       {{ $setting->value === 'true' ? 'checked' : '' }}>
                                <label for="settings_{{ $setting->key }}" style="text-transform:none; letter-spacing:0; font-size:14px; font-weight:500; color:var(--ink);">
                                    {{ ucfirst($labelText) }}
                                </label>
                            </div>
                            @if(isset($descriptions[$setting->key]))
                            <span class="form-hint" style="margin-top:4px;">
                                {{ $descriptions[$setting->key] }}
                            </span>
                            @endif

                        @elseif($setting->type === 'number')
                            <label for="settings[{{ $setting->key }}]">
                                {{ ucfirst($labelText) }}
                            </label>
                            <input type="number" name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                   value="{{ $setting->value }}" 
                                   min="0"
                                   step="{{ in_array($setting->key, ['carousel_interval', 'carousel_transition_speed']) ? '100' : '1' }}"
                                   style="width:200px; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            @if(isset($descriptions[$setting->key]))
                            <span class="form-hint">
                                {{ $descriptions[$setting->key] }}
                                @if($setting->key === 'carousel_interval')
                                    — Valeur actuelle : {{ number_format($setting->value / 1000, 1) }} secondes
                                @elseif($setting->key === 'carousel_transition_speed')
                                    — Valeur actuelle : {{ number_format($setting->value / 1000, 2) }} secondes
                                @endif
                            </span>
                            @endif

                        @elseif($setting->type === 'textarea')
                            <label for="settings[{{ $setting->key }}]">
                                {{ ucfirst($labelText) }}
                            </label>
                            <textarea name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                      style="width:100%; min-height:120px; padding:10px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif; resize:vertical;">{{ $setting->value }}</textarea>
                            @if(isset($descriptions[$setting->key]))
                            <span class="form-hint">{{ $descriptions[$setting->key] }}</span>
                            @endif

                        @elseif($setting->type === 'email')
                            <label for="settings[{{ $setting->key }}]">
                                {{ ucfirst($labelText) }}
                            </label>
                            <input type="email" name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                   value="{{ $setting->value }}" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            @if(isset($descriptions[$setting->key]))
                            <span class="form-hint">{{ $descriptions[$setting->key] }}</span>
                            @endif

                        @elseif($setting->type === 'url')
                            <label for="settings[{{ $setting->key }}]">
                                {{ ucfirst($labelText) }}
                            </label>
                            <input type="url" name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                   value="{{ $setting->value }}" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            @if(isset($descriptions[$setting->key]))
                            <span class="form-hint">{{ $descriptions[$setting->key] }}</span>
                            @endif

                        @else
                            <label for="settings[{{ $setting->key }}]">
                                {{ ucfirst($labelText) }}
                            </label>
                            <input type="text" name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                   value="{{ $setting->value }}" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            @if(isset($descriptions[$setting->key]))
                            <span class="form-hint">{{ $descriptions[$setting->key] }}</span>
                            @endif
                        @endif
                    </div>
                @endforeach
            </fieldset>
        @empty
            <p style="color:var(--muted); text-align:center; padding:40px;">Aucun paramètre à afficher.</p>
        @endforelse

        <div style="display:flex; gap:12px; margin-top:28px; padding-top:20px; border-top:2px solid var(--line);">
            <button type="submit" class="btn btn-primary">💾 Enregistrer les paramètres</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </form>
</div>

{{-- Preview live du carrousel --}}
@if($grouped->has('carousel'))
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2>👁️ Aperçu en direct</h2>
        <span class="card-header-sub">Les paramètres seront appliqués au carrousel du site</span>
    </div>
    <div class="card-body">
        <div style="background:#faf8f4; padding:20px; border-radius:8px; border:1px solid var(--line);">
            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:16px; font:13px Inter,sans-serif;">
                <div>
                    <strong style="color:var(--green); display:block; margin-bottom:6px;">Durée par slide</strong>
                    <span id="preview-interval">5 secondes</span>
                </div>
                <div>
                    <strong style="color:var(--green); display:block; margin-bottom:6px;">Vitesse transition</strong>
                    <span id="preview-speed">0.8 secondes</span>
                </div>
                <div>
                    <strong style="color:var(--green); display:block; margin-bottom:6px;">Lecture automatique</strong>
                    <span id="preview-autoplay">Activée</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update preview live
document.addEventListener('DOMContentLoaded', function() {
    var intervalInput = document.getElementById('settings[carousel_interval]');
    var speedInput = document.getElementById('settings[carousel_transition_speed]');
    var autoplayInput = document.getElementById('settings_carousel_autoplay');
    
    if (intervalInput) {
        intervalInput.addEventListener('input', function() {
            document.getElementById('preview-interval').textContent = (this.value / 1000).toFixed(1) + ' secondes';
        });
    }
    
    if (speedInput) {
        speedInput.addEventListener('input', function() {
            document.getElementById('preview-speed').textContent = (this.value / 1000).toFixed(2) + ' secondes';
        });
    }
    
    if (autoplayInput) {
        autoplayInput.addEventListener('change', function() {
            document.getElementById('preview-autoplay').textContent = this.checked ? 'Activée' : 'Désactivée';
        });
    }
});
</script>
@endif
@endsection
