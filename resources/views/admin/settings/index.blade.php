@extends('admin.partials.layout')
@section('title', 'Paramètres du site')
@section('page-title', 'Paramètres du site')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-settings.css') }}?v={{ filemtime(public_path('css/admin-settings.css')) }}">
@endpush

@section('content')
<div class="card settings-page">
    <div class="card-header">
        <h2>⚙️ Paramètres du site</h2>
        <span class="card-header-sub">Configurer les paramètres généraux du site</span>
    </div>

    <div class="settings-overview">
        <div class="settings-overview-item">
            <span class="settings-overview-icon">⚙</span>
            <span><strong>{{ $settings->count() }}</strong><small>paramètres</small></span>
        </div>
        <div class="settings-overview-item">
            <span class="settings-overview-icon">◈</span>
            <span><strong>{{ $grouped->count() }}</strong><small>catégories</small></span>
        </div>
        <div class="settings-overview-item">
            <span class="settings-overview-icon">✓</span>
            <span><strong>{{ $settings->where('value', '!=', '')->count() }}</strong><small>valeurs configurées</small></span>
        </div>
    </div>

    <div class="settings-toolbar">
        <label class="settings-search">
            <span aria-hidden="true">⌕</span>
            <input type="search" id="settings-search" placeholder="Rechercher un paramètre…" autocomplete="off">
        </label>
        <div class="settings-tabs" role="tablist" aria-label="Catégories de paramètres">
            <button type="button" class="settings-tab is-active" data-settings-filter="all">Tous</button>
            @foreach($grouped as $category => $categorySettings)
                <button type="button" class="settings-tab" data-settings-filter="{{ $category }}">{{ ucfirst($category) }}</button>
            @endforeach
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin:0 20px 16px;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="card-body">
        @csrf

        @forelse($grouped as $category => $categorySettings)
            <fieldset class="settings-section" data-settings-category="{{ $category }}" style="margin-bottom:32px;">
                <legend style="font:600 16px Inter,sans-serif; color:var(--green); text-transform:capitalize; margin-bottom:16px; border-bottom:2px solid var(--line); padding-bottom:12px;">
                    @if($category === 'carousel')
                        🎬 Carrousel héro
                    @elseif($category === 'press')
                        Contact presse
                    @else
                        {{ $category }}
                    @endif
                </legend>

                @foreach($categorySettings as $setting)
                    @php
                        $labelText = implode(' ', array_slice(explode('_', $setting->key), 1));
                        $descriptions = [
                            'press_contact_name' => 'Nom affiché sur la fiche de contact presse publique',
                            'press_contact_job' => 'Fonction affichée sous le nom du contact presse',
                            'press_contact_photo' => 'URL de la photo affichée sur la fiche de contact presse (laisser vide pour le placeholder)',
                            'press_contact_phone' => 'Numéro affiché pour le contact presse',
                            'press_contact_email' => 'Adresse e-mail affichée et utilisée pour le contact presse',
                            'press_contact_hours' => 'Plage horaire affichée pour la disponibilité presse',
                            'carousel_autoplay' => 'Active la rotation automatique des slides',
                            'carousel_interval' => 'Durée d\'affichage de chaque slide (en millisecondes)',
                            'carousel_transition_speed' => 'Vitesse de transition entre les slides (en millisecondes)',
                            'carousel_pause_on_hover' => 'Mettre en pause le carrousel au survol de la souris',
                            'carousel_show_indicators' => 'Afficher les points indicateurs en bas',
                            'carousel_show_arrows' => 'Afficher les flèches de navigation',
                        ];
                    @endphp

                    <div class="form-group settings-field" data-setting-search="{{ strtolower($setting->key . ' ' . $labelText) }}" style="margin-bottom:20px;">
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
                                     - Valeur actuelle : {{ number_format($setting->value / 1000, 1) }} secondes
                                @elseif($setting->key === 'carousel_transition_speed')
                                     - Valeur actuelle : {{ number_format($setting->value / 1000, 2) }} secondes
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

                        @elseif($setting->type === 'album_select')
                            {{-- Dropdown pour sélectionner un album --}}
                            <label for="settings[{{ $setting->key }}]">
                                📸 Album mis en avant sur la page d'accueil
                            </label>
                            <select name="settings[{{ $setting->key }}]" id="settings[{{ $setting->key }}]" 
                                    style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                                <option value="">-- Aucun album mis en avant --</option>
                                @foreach($albums as $album)
                                    <option value="{{ $album->id }}" {{ $setting->value == $album->id ? 'selected' : '' }}>
                                        {{ $album->title }} ({{ $album->media()->where('is_published', true)->count() }} photos)
                                    </option>
                                @endforeach
                            </select>
                            <span class="form-hint">
                                Si un album est sélectionné, il s'affichera <strong>avant la section actualités</strong> sur la page d'accueil avec un carrousel d'images animé. Les actualités resteront visibles en dessous.
                            </span>

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

        <div class="settings-actions">
            <button type="submit" class="btn btn-primary" id="settings-save">💾 Enregistrer les paramètres</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Annuler</a>
            <span class="settings-save-state" id="settings-save-state" role="status" aria-live="polite"></span>
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
        <div class="settings-preview">
            <div class="settings-preview-grid">
                <div class="settings-preview-item">
                    <strong>Durée par slide</strong>
                    <span id="preview-interval">5 secondes</span>
                </div>
                <div class="settings-preview-item">
                    <strong>Vitesse transition</strong>
                    <span id="preview-speed">0.8 secondes</span>
                </div>
                <div class="settings-preview-item">
                    <strong>Lecture automatique</strong>
                    <span id="preview-autoplay">Activée</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update preview live
document.addEventListener('DOMContentLoaded', function() {
    var search = document.getElementById('settings-search');
    var tabs = document.querySelectorAll('[data-settings-filter]');
    var sections = document.querySelectorAll('[data-settings-category]');
    var fields = document.querySelectorAll('[data-setting-search]');
    var activeCategory = 'all';

    function filterSettings() {
        var term = (search ? search.value : '').toLowerCase().trim();
        sections.forEach(function(section) {
            var categoryMatch = activeCategory === 'all' || section.dataset.settingsCategory === activeCategory;
            var visibleFields = 0;
            section.querySelectorAll('[data-setting-search]').forEach(function(field) {
                var matches = categoryMatch && (!term || field.dataset.settingSearch.indexOf(term) !== -1);
                field.classList.toggle('is-hidden', !matches);
                if (matches) visibleFields++;
            });
            section.classList.toggle('is-hidden', visibleFields === 0);
        });
    }

    if (search) search.addEventListener('input', filterSettings);
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            activeCategory = tab.dataset.settingsFilter;
            tabs.forEach(function(item) { item.classList.toggle('is-active', item === tab); });
            filterSettings();
        });
    });

    var settingsForm = document.querySelector('form[action="{{ route('admin.settings.update') }}"]');
    var saveState = document.getElementById('settings-save-state');
    if (settingsForm && saveState) {
        settingsForm.addEventListener('input', function() { saveState.textContent = 'Modifications non enregistrées'; saveState.style.color = 'var(--red)'; });
        settingsForm.addEventListener('submit', function() { saveState.textContent = 'Enregistrement…'; saveState.style.color = '#16803c'; });
    }

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
