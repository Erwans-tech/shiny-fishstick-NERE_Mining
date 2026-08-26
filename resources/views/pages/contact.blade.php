{{-- Page : Contact --}}
@extends('layouts.app')

@section('content')

<section>
    {{-- 3 fiches de contact --}}
    <div class="contact-grid">
        <div class="contact-card">
            <div class="icon">🏢</div>
            <h3>{{ __('site.contact_hq_h3', [], $loc) }}</h3>
            <ul class="contact-info">
                <li><strong>{{ __('site.contact_hq_address', [], $loc) }} :</strong> Ouagadougou, Burkina Faso</li>
                <li><strong>{{ __('site.contact_hq_phone', [], $loc) }} :</strong> +226 25 33 35 69</li>
                <li><strong>{{ __('site.contact_hq_email', [], $loc) }} :</strong> contact@nere-mining.bf</li>
                <li><strong>{{ __('site.contact_hq_hours', [], $loc) }} :</strong> {{ __('site.contact_hq_hours_v', [], $loc) }}</li>
            </ul>
        </div>
        <div class="contact-card">
            <div class="icon">⛏️</div>
            <h3>{{ __('site.contact_mine_h3', [], $loc) }}</h3>
            <ul class="contact-info">
                <li><strong>{{ __('site.contact_mine_location', [], $loc) }} :</strong>
                    {{ $en
                        ? 'Zondoma & Yatenga Provinces, Northern Region — 195 km from Ouagadougou'
                        : 'Provinces du Zondoma & Yatenga, Région du Nord — 195 km de Ouagadougou' }}
                </li>
                <li><strong>{{ __('site.contact_mine_phone', [], $loc) }} :</strong> +226 25 33 35 69</li>
                <li><strong>{{ __('site.contact_mine_community', [], $loc) }} :</strong> contact@nere-mining.bf</li>
            </ul>
        </div>
        <div class="contact-card">
            <div class="icon">📍</div>
            <h3>{{ __('site.contact_office_h3', [], $loc) }}</h3>
            <ul class="contact-info">
                <li><strong>{{ __('site.contact_office_address', [], $loc) }} :</strong>
                    {{ $en ? 'Ouahigouya, Northern Region' : 'Ouahigouya, Région du Nord' }}
                </li>
                <li><strong>{{ __('site.contact_office_phone', [], $loc) }} :</strong> +226 25 33 35 69</li>
                <li><strong>{{ __('site.contact_office_press', [], $loc) }} :</strong> contact@nere-mining.bf</li>
            </ul>
        </div>
    </div>

    {{-- Formulaire de contact --}}
    <h2>{{ __('site.contact_form_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.contact_form_lead', [], $loc) }}</p>

    <form method="POST" action="{{ $en ? route('english.contact.store') : route('contact.store') }}">
        @csrf

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
            <option value="{{ $value }}"
                {{ request('type', 'general') === $value ? 'selected' : '' }}>
                {{ __('site.'.$key, [], $loc) }}
            </option>
            @endforeach
        </select>

        <label for="name">{{ __('site.contact_name_label', [], $loc) }}</label>
        <input id="name" name="name" required value="{{ old('name') }}">

        <label for="email">{{ __('site.contact_email_label', [], $loc) }}</label>
        <input id="email" type="email" name="email" required value="{{ old('email') }}">

        <label for="subject">{{ __('site.contact_subject_label', [], $loc) }}</label>
        <input id="subject" name="subject" value="{{ old('subject', request('subject')) }}">

        <label for="message">{{ __('site.contact_message_label', [], $loc) }}</label>
        <textarea id="message" name="message" required>{{ old('message') }}</textarea>

        <button type="submit">{{ __('site.send_message', [], $loc) }}</button>
    </form>
</section>

@endsection
