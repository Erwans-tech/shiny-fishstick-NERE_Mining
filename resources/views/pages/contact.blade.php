{{-- Page : Contact --}}
@extends('layouts.app')
@section('content')
<section>
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-bottom:64px;">
        {{-- 1. Siège social — Ouagadougou --}}
        <div class="contact-card sr">
            <div class="contact-card-header">
                <span class="contact-card-icon">🏢</span>
                <div>
                    <div class="contact-card-num">01</div>
                    <h3>{{ __('site.contact_hq_h3', [], $loc) }}</h3>
                </div>
            </div>
            <ul class="contact-info">
                <li>
                    <span class="ci-label">{{ __('site.contact_hq_address', [], $loc) }}</span>
                    <span class="ci-value">{{ __('site.contact_hq_address_v', [], $loc) }}</span>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_hq_phone', [], $loc) }}</span>
                    <a href="tel:+22625333569" class="ci-value ci-link">
                        {{ __('site.contact_hq_phone_v', [], $loc) }}
                    </a>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_hq_email', [], $loc) }}</span>
                    <a href="mailto:{{ __('site.contact_hq_email_v', [], $loc) }}" class="ci-value ci-link">
                        {{ __('site.contact_hq_email_v', [], $loc) }}
                    </a>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_hq_hours', [], $loc) }}</span>
                    <span class="ci-value">{{ __('site.contact_hq_hours_v', [], $loc) }}</span>
                </li>
            </ul>
        </div>

        {{-- 2. Site de la mine de Karma --}}
        <div class="contact-card contact-card--mine sr">
            <div class="contact-card-header">
                <span class="contact-card-icon">⛏️</span>
                <div>
                    <div class="contact-card-num">02</div>
                    <h3>{{ __('site.contact_mine_h3', [], $loc) }}</h3>
                </div>
            </div>
            <ul class="contact-info">
                <li>
                    <span class="ci-label">{{ __('site.contact_mine_location', [], $loc) }}</span>
                    <span class="ci-value">{{ __('site.contact_mine_location_v', [], $loc) }}</span>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_mine_access', [], $loc) }}</span>
                    <span class="ci-value">{{ __('site.contact_mine_access_v', [], $loc) }}</span>
                </li>
                <li class="ci-separator">
                    <span class="ci-label ci-section">{{ __('site.contact_mine_field', [], $loc) }}</span>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_mine_phone', [], $loc) }}</span>
                    <a href="tel:+22625333569" class="ci-value ci-link">
                        {{ __('site.contact_mine_phone_v', [], $loc) }}
                    </a>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_mine_hse', [], $loc) }}</span>
                    <a href="tel:+22625333569" class="ci-value ci-link ci-urgent">
                        {{ __('site.contact_mine_hse_v', [], $loc) }}
                    </a>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_mine_community', [], $loc) }}</span>
                    <a href="mailto:{{ __('site.contact_mine_community_v', [], $loc) }}" class="ci-value ci-link">
                        {{ __('site.contact_mine_community_v', [], $loc) }}
                    </a>
                </li>
            </ul>
        </div>

        {{-- 3. Bureau de liaison — Ouahigouya --}}
        <div class="contact-card sr">
            <div class="contact-card-header">
                <span class="contact-card-icon">📍</span>
                <div>
                    <div class="contact-card-num">03</div>
                    <h3>{{ __('site.contact_office_h3', [], $loc) }}</h3>
                </div>
            </div>
            <ul class="contact-info">
                <li>
                    <span class="ci-label">{{ __('site.contact_office_role', [], $loc) }}</span>
                    <span class="ci-value ci-muted">{{ __('site.contact_office_role_v', [], $loc) }}</span>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_office_address', [], $loc) }}</span>
                    <span class="ci-value">{{ __('site.contact_office_address_v', [], $loc) }}</span>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_office_phone', [], $loc) }}</span>
                    <a href="tel:+22625333569" class="ci-value ci-link">
                        {{ __('site.contact_office_phone_v', [], $loc) }}
                    </a>
                </li>
                <li>
                    <span class="ci-label">{{ __('site.contact_office_email', [], $loc) }}</span>
                    <a href="mailto:{{ __('site.contact_office_email_v', [], $loc) }}" class="ci-value ci-link">
                        {{ __('site.contact_office_email_v', [], $loc) }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Carte Google Maps --}}
    <div class="map-wrap sr">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d935649.2!2d-1.5!3d13.2!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe2e9eb9d1aba949%3A0x7f46e8f12f1c0a55!2sOuagadougou!5e0!3m2!1s{{ $loc }}!2sbf!4v1"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="{{ $en ? 'Néré Mining locations' : 'Localisation des bureaux Néré Mining' }}">
        </iframe>
    </div>
</section>

{{-- Formulaire de contact général --}}
<section class="sand">
    <h2>{{ __('site.contact_form_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.contact_form_lead', [], $loc) }}</p>

    @if(session('success'))
    <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert-success" style="background:#fee2e2; color:#991b1b; border-color:#fecaca;">
        @foreach($errors->all() as $e)<div>✕ {{ $e }}</div>@endforeach
    </div>
    @endif

    <form class="sr" method="POST" action="{{ $en ? route('english.contact.store') : route('contact.store') }}">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

            <div>
                <label for="name">{{ __('site.contact_name_label', [], $loc) }} *</label>
                <input id="name" name="name" required value="{{ old('name') }}"
                       placeholder="{{ $en ? 'Your full name' : 'Votre nom complet' }}">
            </div>

            <div>
                <label for="email">{{ __('site.contact_email_label', [], $loc) }} *</label>
                <input id="email" type="email" name="email" required value="{{ old('email') }}"
                       placeholder="{{ $en ? 'your@email.com' : 'votre@email.com' }}">
            </div>

            <div style="grid-column:span 2;">
                <label for="type">{{ __('site.contact_type_label', [], $loc) }}</label>
                <select id="type" name="type">
                    @php
                        $types = [
                            'general'               => 'contact_type_general',
                            'partenariat'           => 'contact_type_partner',
                            'investissement'        => 'contact_type_invest',
                            'emploi'                => 'contact_type_job',
                            'fournisseur'           => 'contact_type_supplier',
                            'presse'                => 'contact_type_press',
                            'communaute'            => 'contact_type_community',
                            'candidature-spontanee' => 'contact_type_spontaneous',
                        ];
                    @endphp
                    @foreach($types as $value => $key)
                    <option value="{{ $value }}" {{ request('type', 'general') === $value ? 'selected' : '' }}>
                        {{ __('site.'.$key, [], $loc) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div style="grid-column:span 2;">
                <label for="subject">{{ __('site.contact_subject_label', [], $loc) }}</label>
                <input id="subject" name="subject" value="{{ old('subject', request('subject')) }}"
                       placeholder="{{ $en ? 'Brief subject of your message' : 'Objet de votre message en quelques mots' }}">
            </div>

            <div style="grid-column:span 2;">
                <label for="message">{{ __('site.contact_message_label', [], $loc) }} *</label>
                <textarea id="message" name="message" required
                          placeholder="{{ $en ? 'Write your message here…' : 'Rédigez votre message ici…' }}"
                          style="min-height:180px;">{{ old('message') }}</textarea>
            </div>

            <div style="grid-column:span 2; margin-top:8px;">
                <button type="submit" style="padding:15px 32px;">
                    {{ __('site.send_message', [], $loc) }}
                </button>
            </div>
        </div>
    </form>
</section>

{{-- Styles spécifiques à cette page --}}
@push('styles')
<style>
    /* Fiches de contact enrichies */
    .contact-card {
        padding:0;
        border:1px solid var(--line);
        background:#fff;
        border-radius:10px;
        overflow:hidden;
        transition:box-shadow .2s, transform .2s;
    }
    .contact-card:hover {
        box-shadow:0 8px 28px rgba(0,0,0,.08);
        transform:translateY(-3px);
    }
    .contact-card--mine { border-top:3px solid var(--gold); }
    .contact-card-header {
        display:flex;
        align-items:center;
        gap:16px;
        padding:24px 24px 16px;
        border-bottom:1px solid var(--line);
        background:var(--light);
    }
    .contact-card-icon { font-size:28px; flex-shrink:0; }
    .contact-card-num {
        font:700 10px Inter,sans-serif;
        letter-spacing:.15em;
        text-transform:uppercase;
        color:var(--gold2, #e5a72f);
        margin-bottom:3px;
    }
    .contact-card-header h3 { margin:0; font-size:16px; }
    .contact-info { list-style:none; padding:18px 24px 22px; display:flex; flex-direction:column; gap:12px; }
    .contact-info li { display:flex; flex-direction:column; gap:2px; }
    .ci-label { font:600 10px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; color:var(--muted); }
    .ci-section { color:var(--green); font-size:11px; }
    .ci-separator { border-top:1px dashed var(--line); padding-top:12px; margin-top:4px; }
    .ci-value { font:14px Inter,sans-serif; color:var(--ink); }
    .ci-muted { color:var(--muted); font-style:italic; }
    .ci-link { color:var(--green); transition:color .15s; }
    .ci-link:hover { color:var(--red); text-decoration:underline; }
    .ci-urgent { color:var(--red) !important; font-weight:600; }
    .map-wrap { margin-top:36px; border-radius:10px; overflow:hidden; border:1px solid var(--line); height:380px; }
    .map-wrap iframe { width:100%; height:100%; border:0; display:block; }

    /* Responsive grille contact */
    @media(max-width:900px) {
        section > div[style*="grid-template-columns:repeat(3"] {
            grid-template-columns:1fr !important;
        }
        form > div[style*="grid-template-columns"] {
            grid-template-columns:1fr !important;
        }
        form > div > div[style*="grid-column:span 2"] {
            grid-column:span 1 !important;
        }
    }
</style>
@endpush

@endsection
