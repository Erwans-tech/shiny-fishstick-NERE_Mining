{{-- Page : Contact Presse --}}
@extends('layouts.app')

@section('content')
@php
    $pressName = \App\Models\SiteSetting::get('press_contact_name', __('site.press_contact_name', [], $loc));
    $pressJob = \App\Models\SiteSetting::get('press_contact_job', __('site.press_contact_job', [], $loc));
    $pressPhoto = \App\Models\SiteSetting::get('press_contact_photo', '');
    $pressPhone = \App\Models\SiteSetting::get('press_contact_phone', '+226 25 33 35 69');
    $pressEmail = \App\Models\SiteSetting::get('press_contact_email', 'presse@nere-mining.bf');
    $pressHours = \App\Models\SiteSetting::get('press_contact_hours', __('site.press_contact_hours', [], $loc));
@endphp

<section>
    {{-- Sub-nav Actualités & Médias --}}

    <p class="lead">{{ __('site.press_contact_lead', [], $loc) }}</p>

    {{-- Fiche interlocuteur --}}
    <div class="pdg-block" style="margin-bottom:48px;">
        <div>
            <div class="pdg-photo"
                 style="height:280px; border-radius:6px; display:flex; align-items:center; justify-content:center; background:#5a2020;">
                @if($pressPhoto)
                    <img src="{{ $pressPhoto }}" alt="{{ $pressName }}" style="width:100%; height:100%; object-fit:cover; border-radius:6px;">
                @else
                    <span style="color:rgba(255,255,255,.35); font-size:13px; text-align:center;">
                        {{ $en ? 'Photo coming soon' : 'Photo à venir' }}
                    </span>
                @endif
            </div>
        </div>
        <div>
            <div class="card-tag"
                 style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.2em; text-transform:uppercase; margin-bottom:16px;">
                {{ __('site.press_contact_role_label', [], $loc) }}
            </div>
            <h2 style="color:#fff; font-size:clamp(26px,3vw,40px); margin-bottom:8px;">
                {{ $pressName }}
            </h2>
            <div style="color:rgba(255,255,255,.7); font:13px Inter,sans-serif; margin-bottom:28px;">
                {{ $pressJob }}
            </div>
            <ul style="list-style:none; display:flex; flex-direction:column; gap:14px;">
                <li style="display:flex; gap:14px; align-items:center;">
                    <span style="font-size:20px;">📞</span>
                    <div>
                        <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">
                            {{ __('site.press_contact_phone_label', [], $loc) }}
                        </div>
                        <span style="color:#fff; font:15px Inter,sans-serif;">{{ $pressPhone }}</span>
                    </div>
                </li>
                <li style="display:flex; gap:14px; align-items:center;">
                    <span style="font-size:20px;">✉️</span>
                    <div>
                        <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">
                            {{ __('site.press_contact_email_label', [], $loc) }}
                        </div>
                        <a href="mailto:{{ $pressEmail }}"
                           style="color:#fff; font:15px Inter,sans-serif; text-decoration:underline;">
                            {{ $pressEmail }}
                        </a>
                    </div>
                </li>
                <li style="display:flex; gap:14px; align-items:center;">
                    <span style="font-size:20px;">🕐</span>
                    <div>
                        <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">
                            {{ __('site.press_contact_hours_label', [], $loc) }}
                        </div>
                        <span style="color:#fff; font:15px Inter,sans-serif;">{{ $pressHours }}</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

@if(false)
{{-- Press Kit & Media Resources --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Press Kit & Resources' : 'Kit Presse & Ressources' }}</h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px;">{{ $en ? 'Download company information, logos, and media assets.' : 'Télécharger informations entreprise, logos et ressources média.' }}</p>
        
        <div class="grid-3">
            <a href="#" class="card" style="display:block; cursor:pointer; transition:all .3s;">
                <div style="font-size:36px; margin-bottom:12px;">📋</div>
                <h3>{{ $en ? 'Company Fact Sheet' : 'Fiche d\'Entreprise' }}</h3>
                <p style="font-size:13px;">{{ $en ? 'Key company information, history, operations' : 'Infos clés, histoire, opérations' }}</p>
                <div style="margin-top:12px; font-size:12px; color:var(--gold2); font-weight:600;">{{ $en ? 'PDF • 2.1 MB' : 'PDF • 2.1 MB' }}</div>
            </a>
            <a href="#" class="card" style="display:block; cursor:pointer; transition:all .3s;">
                <div style="font-size:36px; margin-bottom:12px;">🎨</div>
                <h3>{{ $en ? 'Logo & Branding' : 'Logo & Marque' }}</h3>
                <p style="font-size:13px;">{{ $en ? 'High-res logos, color palettes, guidelines' : 'Logos haute résolution, palettes, guides' }}</p>
                <div style="margin-top:12px; font-size:12px; color:var(--gold2); font-weight:600;">{{ $en ? 'ZIP • 8.7 MB' : 'ZIP • 8.7 MB' }}</div>
            </a>
            <a href="#" class="card" style="display:block; cursor:pointer; transition:all .3s;">
                <div style="font-size:36px; margin-bottom:12px;">📸</div>
                <h3>{{ $en ? 'Photo Gallery' : 'Galerie Photos' }}</h3>
                <p style="font-size:13px;">{{ $en ? 'High-quality site, team, and operations photos' : 'Photos site, équipe, opérations haute qualité' }}</p>
                <div style="margin-top:12px; font-size:12px; color:var(--gold2); font-weight:600;">{{ $en ? 'ZIP • 145 MB' : 'ZIP • 145 MB' }}</div>
            </a>
            <a href="{{ $en ? route('english.reports') : route('reports') }}" class="card" style="display:block; cursor:pointer; transition:all .3s;">
                <div style="font-size:36px; margin-bottom:12px;">📊</div>
                <h3>{{ $en ? 'Sustainability Reports' : 'Rapports Durabilité' }}</h3>
                <p style="font-size:13px;">{{ $en ? 'Annual ESG and sustainability performance' : 'Performance ESG et durabilité annuelle' }}</p>
                <div style="margin-top:12px; font-size:12px; color:var(--gold2); font-weight:600;">→ {{ $en ? 'View Reports' : 'Voir Rapports' }}</div>
            </a>
            <a href="#" class="card" style="display:block; cursor:pointer; transition:all .3s;">
                <div style="font-size:36px; margin-bottom:12px;">📹</div>
                <h3>{{ $en ? 'Video Library' : 'Vidéothèque' }}</h3>
                <p style="font-size:13px;">{{ $en ? 'Site tours, operations, interviews, documentaries' : 'Visites site, opérations, interviews, docs' }}</p>
                <div style="margin-top:12px; font-size:12px; color:var(--gold2); font-weight:600;">{{ $en ? 'Vimeo Playlist' : 'Playlist Vimeo' }}</div>
            </a>
            <a href="#" class="card" style="display:block; cursor:pointer; transition:all .3s;">
                <div style="font-size:36px; margin-bottom:12px;">📰</div>
                <h3>{{ $en ? 'Latest Press Releases' : 'Derniers Communiqués' }}</h3>
                <p style="font-size:13px;">{{ $en ? 'Official news, announcements, statements' : 'Actualités, annonces, déclarations officielles' }}</p>
                <div style="margin-top:12px; font-size:12px; color:var(--gold2); font-weight:600;">{{ $en ? 'Archive & RSS' : 'Archive & RSS' }}</div>
            </a>
        </div>
    </div>
</section>

@endif
{{-- Formulaire presse --}}
<section class="sand press-form-section">
    <div class="press-form-inner">
        <div class="press-form-heading">
            <span class="press-form-kicker">{{ $en ? 'Media relations' : 'Relations médias' }}</span>
            <h2>{{ __('site.press_contact_form_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.press_contact_form_lead', [], $loc) }}</p>
        </div>

    <form class="press-form" method="POST" action="{{ $en ? route('english.contact.store') : route('contact.store') }}">
        @csrf
        <input type="hidden" name="type" value="presse">

        <div class="press-form-grid">
            <div class="press-field">
                <label for="press-name">{{ __('site.contact_name_label', [], $loc) }}</label>
                <input id="press-name" name="name" required value="{{ old('name') }}">
            </div>

            <div class="press-field">
                <label for="press-email">{{ __('site.pc_email_professional', [], $loc) }}</label>
                <input id="press-email" type="email" name="email" required value="{{ old('email') }}">
            </div>
        </div>

        <div class="press-field">
            <label for="press-subject">{{ __('site.press_contact_field_media', [], $loc) }}</label>
            <input id="press-subject" name="subject"
                   placeholder="{{ __('site.press_contact_media_placeholder', [], $loc) }}"
                   value="{{ old('subject') }}">
        </div>

        <div class="press-field">
            <label for="press-message">{{ __('site.contact_message_label', [], $loc) }}</label>
            <textarea id="press-message" name="message"
                      placeholder="{{ __('site.press_contact_request_placeholder', [], $loc) }}"
                      required>{{ old('message') }}</textarea>
        </div>

        <button class="press-form-submit" type="submit">{{ __('site.send_request', [], $loc) }}</button>
    </form>
    </div>
</section>

@push('styles')
<style>
    .press-form-section { position:relative; overflow:hidden; background:linear-gradient(135deg,#fff8e8 0%,#fff4dc 58%,#f5e4c5 100%); }
    .press-form-section::after { content:''; position:absolute; left:5vw; right:5vw; top:0; height:4px; background:linear-gradient(90deg,var(--green),var(--gold),transparent); }
    .press-form-inner { max-width:1000px; margin:0 auto; }
    .press-form-heading { max-width:760px; margin:0 auto 30px; text-align:center; }
    .press-form-kicker { display:inline-block; margin-bottom:10px; color:var(--gold2); font:700 11px Inter,sans-serif; letter-spacing:.18em; text-transform:uppercase; }
    .press-form-heading h2 { color:var(--green); font-size:clamp(28px,4vw,44px); line-height:1.1; font-weight:500; }
    .press-form-heading .lead { max-width:700px; margin:14px auto 0; color:var(--muted); font-size:15px; line-height:1.65; }
    .press-form { display:grid; gap:18px; padding:30px; background:rgba(255,255,255,.88); border:1px solid rgba(75,23,22,.1); border-radius:12px; box-shadow:0 16px 36px rgba(75,23,22,.09); }
    .press-form-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
    .press-field { display:grid; gap:7px; }
    .press-field label { color:var(--green); font:700 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; }
    .press-field input, .press-field textarea { width:100%; border:1px solid var(--line); border-radius:6px; background:#fff; color:var(--ink); font:14px/1.5 Inter,sans-serif; outline:none; transition:border-color .2s,box-shadow .2s; }
    .press-field input { min-height:48px; padding:12px 14px; }
    .press-field textarea { min-height:150px; padding:13px 14px; resize:vertical; }
    .press-field input:focus, .press-field textarea:focus { border-color:var(--gold2); box-shadow:0 0 0 3px rgba(229,167,47,.16); }
    .press-form-submit { justify-self:end; border:0; border-radius:5px; padding:14px 24px; background:var(--red); color:#fff; font:700 12px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; cursor:pointer; transition:background .2s,transform .2s,box-shadow .2s; }
    .press-form-submit:hover { background:var(--green); transform:translateY(-2px); box-shadow:0 8px 18px rgba(75,23,22,.18); }
    @media(max-width:650px) {
        .press-form { padding:20px; }
        .press-form-grid { grid-template-columns:1fr; }
        .press-form-submit { width:100%; }
    }
</style>
@endpush

@endsection
