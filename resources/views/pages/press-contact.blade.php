{{-- Page : Contact Presse --}}
@extends('layouts.app')

@section('content')

<section>
    {{-- Sub-nav Actualités & Médias --}}
    <div class="sub-nav">
        <a href="{{ $en ? route('english.news')          : route('news.index') }}">{{ __('site.subnav_news', [], $loc) }}</a>
        <a href="{{ $en ? route('english.press')         : route('press') }}">{{ __('site.subnav_press', [], $loc) }}</a>
        <a href="{{ $en ? route('english.gallery')       : route('gallery') }}">{{ __('site.subnav_gallery', [], $loc) }}</a>
        <a href="{{ $en ? route('english.reports')       : route('reports') }}">{{ __('site.subnav_reports', [], $loc) }}</a>
        <a href="{{ $en ? route('english.press.contact') : route('press.contact') }}" class="active">{{ __('site.subnav_press_contact', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.press_contact_lead', [], $loc) }}</p>

    {{-- Fiche interlocuteur --}}
    <div class="pdg-block" style="margin-bottom:48px;">
        <div>
            <div class="pdg-photo"
                 style="height:280px; border-radius:6px; display:flex; align-items:center; justify-content:center; background:#5a2020;">
                <span style="color:rgba(255,255,255,.35); font-size:13px; text-align:center;">
                    {{ $en ? 'Photo coming soon' : 'Photo à venir' }}
                </span>
            </div>
        </div>
        <div>
            <div class="card-tag"
                 style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.2em; text-transform:uppercase; margin-bottom:16px;">
                {{ __('site.press_contact_role_label', [], $loc) }}
            </div>
            <h2 style="color:#fff; font-size:clamp(26px,3vw,40px); margin-bottom:8px;">
                {{ __('site.press_contact_name', [], $loc) }}
            </h2>
            <div style="color:rgba(255,255,255,.7); font:13px Inter,sans-serif; margin-bottom:28px;">
                {{ __('site.press_contact_job', [], $loc) }}
            </div>
            <ul style="list-style:none; display:flex; flex-direction:column; gap:14px;">
                <li style="display:flex; gap:14px; align-items:center;">
                    <span style="font-size:20px;">📞</span>
                    <div>
                        <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">
                            {{ __('site.press_contact_phone_label', [], $loc) }}
                        </div>
                        <span style="color:#fff; font:15px Inter,sans-serif;">+226 25 33 35 69</span>
                    </div>
                </li>
                <li style="display:flex; gap:14px; align-items:center;">
                    <span style="font-size:20px;">✉️</span>
                    <div>
                        <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">
                            {{ __('site.press_contact_email_label', [], $loc) }}
                        </div>
                        <a href="mailto:presse@nere-mining.bf"
                           style="color:#fff; font:15px Inter,sans-serif; text-decoration:underline;">
                            presse@nere-mining.bf
                        </a>
                    </div>
                </li>
                <li style="display:flex; gap:14px; align-items:center;">
                    <span style="font-size:20px;">🕐</span>
                    <div>
                        <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">
                            {{ __('site.press_contact_hours_label', [], $loc) }}
                        </div>
                        <span style="color:#fff; font:15px Inter,sans-serif;">{{ __('site.press_contact_hours', [], $loc) }}</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

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

{{-- Services presse --}}
<section>
    <h2>{{ __('site.press_contact_services_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.press_contact_services_lead', [], $loc) }}</p>
    <div class="grid-3">
        @foreach(range(1, 6) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.pc_svc'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.pc_svc'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.pc_svc'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Formulaire presse --}}
<section class="sand">
    <h2>{{ __('site.press_contact_form_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.press_contact_form_lead', [], $loc) }}</p>

    <form method="POST" action="{{ $en ? route('english.contact.store') : route('contact.store') }}">
        @csrf
        <input type="hidden" name="type" value="presse">

        <label for="press-name">{{ __('site.contact_name_label', [], $loc) }}</label>
        <input id="press-name" name="name" required value="{{ old('name') }}">

        <label for="press-email">{{ __('site.pc_email_professional', [], $loc) }}</label>
        <input id="press-email" type="email" name="email" required value="{{ old('email') }}">

        <label for="press-subject">{{ __('site.press_contact_field_media', [], $loc) }}</label>
        <input id="press-subject" name="subject"
               placeholder="{{ __('site.press_contact_media_placeholder', [], $loc) }}"
               value="{{ old('subject') }}">

        <label for="press-message">{{ __('site.contact_message_label', [], $loc) }}</label>
        <textarea id="press-message" name="message"
                  placeholder="{{ __('site.press_contact_request_placeholder', [], $loc) }}"
                  required>{{ old('message') }}</textarea>

        <button type="submit">{{ __('site.send_request', [], $loc) }}</button>
    </form>
</section>

@endsection
