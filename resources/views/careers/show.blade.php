@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
    $daysLeft = $job->deadline ? now()->diffInDays($job->deadline, false) : null;
    $isUrgent = $daysLeft !== null && $daysLeft <= 3;
    $applyRoute = $en ? route('english.jobs.apply', $job) : route('jobs.apply', $job);
    $listRoute  = $en ? route('english.careers') : route('careers');
@endphp
<!DOCTYPE html>
<html lang="{{ $loc }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} | {{ __('site.nav_careers', [], $loc) }} | Néré Mining</title>
    <meta name="description" content="{{ Str::limit($job->description, 160) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chrome.css') }}?v={{ filemtime(public_path('css/chrome.css')) }}">
    <style>
        :root{--ink:#281d18;--green:#4b1716;--red:#d72f2f;--gold:#ffc247;--gold2:#e5a72f;--sand:#fff4dc;--muted:#70645c;--line:#eadcc5;--light:#fbfaf7;}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{color:var(--ink);background:var(--light);font-family:'Inter',Arial,sans-serif;line-height:1.6;}
        a{color:inherit;text-decoration:none;}

        /* Masthead */
        .masthead{padding:80px 5vw 60px;color:#fff;background:linear-gradient(100deg,rgba(75,23,22,.97) 40%,rgba(75,23,22,.6)),url('{{ asset('images/mining/karma-04.jpg') }}') center/cover;}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:rgba(255,255,255,.65);font:500 12px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;margin-bottom:24px;transition:color .15s;}
        .back-link:hover{color:var(--gold);}
        .eyebrow{color:var(--gold);font:700 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:12px;}
        .masthead h1{font:300 clamp(32px,5vw,60px)/1.05 Inter,sans-serif;color:#fff;max-width:800px;margin-bottom:24px;}
        .meta-badges{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px;}
        .badge{padding:6px 14px;border-radius:20px;font:600 11px Inter,sans-serif;letter-spacing:.05em;}
        .b-white{background:rgba(255,255,255,.15);color:#fff;}
        .b-gold{background:var(--gold);color:var(--ink);}
        .b-urgent{background:#dc2626;color:#fff;}
        .breadcrumb{font:12px Inter,sans-serif;color:rgba(255,255,255,.55);}
        .breadcrumb a{color:var(--gold);}

        /* Layout */
        .page-body{max-width:1240px;margin:0 auto;padding:60px 5vw;display:grid;grid-template-columns:1fr 380px;gap:48px;align-items:start;}

        /* Left  - job detail */
        .job-detail{}
        .section-block{margin-bottom:40px;}
        .section-block h2{font:600 20px Inter,sans-serif;color:var(--green);margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--line);}
        .job-description{font:16px/1.8 Inter,sans-serif;color:var(--ink);white-space:pre-line;}
        .job-description p{margin-bottom:12px;}
        .requirements-list{list-style:none;display:flex;flex-direction:column;gap:10px;}
        .requirements-list li{display:flex;gap:10px;align-items:flex-start;font:14px/1.6 Inter,sans-serif;color:var(--muted);}
        .requirements-list li::before{content:'✓';color:var(--gold2);font-weight:700;flex-shrink:0;margin-top:1px;}

        /* Right  - sticky sidebar */
        .sidebar{position:sticky;top:92px;}
        .sidebar-card{background:#fff;border:1px solid var(--line);border-radius:10px;overflow:hidden;}
        .sidebar-head{padding:20px 22px;background:var(--green);color:#fff;}
        .sidebar-head h3{font:600 16px Inter,sans-serif;margin-bottom:4px;}
        .sidebar-head p{font:13px Inter,sans-serif;color:rgba(255,255,255,.65);}
        .sidebar-meta{padding:20px 22px;border-bottom:1px solid var(--line);}
        .meta-row{display:flex;align-items:flex-start;gap:12px;padding:8px 0;border-bottom:1px solid #f5f0e8;}
        .meta-row:last-child{border-bottom:0;}
        .meta-icon{display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;color:var(--gold2);flex-shrink:0;margin-top:1px;}
        .meta-icon svg,.inline-icon svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.8;}
        .meta-label{font:600 10px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:2px;}
        .meta-value{font:500 13px Inter,sans-serif;color:var(--ink);}
        .sidebar-share{padding:16px 22px;border-top:1px solid var(--line);display:flex;align-items:center;gap:8px;}
        .share-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border:1px solid var(--line);border-radius:6px;font:500 12px Inter,sans-serif;color:var(--muted);cursor:pointer;background:#fff;transition:all .15s;}
        .share-btn:hover{border-color:var(--green);color:var(--green);}

        /* Application form */
        .apply-section{margin-top:48px;}
        .apply-section h2{font:400 clamp(24px,3vw,36px)/1.1 Inter,sans-serif;color:var(--green);margin-bottom:10px;}
        .apply-lead{font:16px/1.7 Inter,sans-serif;color:var(--muted);margin-bottom:32px;max-width:640px;}
        .form-card{background:#fff;border:1px solid var(--line);border-radius:10px;padding:36px 32px;}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
        .form-group{display:flex;flex-direction:column;gap:6px;}
        .form-group.full{grid-column:span 2;}
        label.fl{font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);}
        label.fl span.req{color:var(--red);}
        input[type=text],input[type=email],input[type=tel],select,textarea{width:100%;border:1px solid var(--line);border-radius:6px;padding:11px 13px;font:14px Inter,sans-serif;color:var(--ink);background:#fff;transition:border-color .15s;}
        input:focus,select:focus,textarea:focus{outline:none;border-color:var(--gold);}
        textarea{min-height:130px;resize:vertical;}
        .file-group{border:2px dashed var(--line);border-radius:6px;padding:16px;text-align:center;transition:border-color .2s;cursor:pointer;}
        .file-group:hover{border-color:var(--gold);}
        .file-group input[type=file]{display:none;}
        .file-group .file-label{font:500 13px Inter,sans-serif;color:var(--muted);cursor:pointer;}
        .file-group .file-hint{font:11px Inter,sans-serif;color:var(--muted);margin-top:4px;}
        .file-group .file-name{font:600 13px Inter,sans-serif;color:var(--green);margin-top:6px;display:none;}
        .form-error{font:12px Inter,sans-serif;color:#dc2626;}
        .form-submit{width:100%;padding:15px;background:var(--green);color:#fff;border:none;border-radius:6px;font:600 13px Inter,sans-serif;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;transition:background .15s;}
        .form-submit:hover{background:#3a100f;}
        .alert-success{padding:14px 18px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:6px;font:500 14px Inter,sans-serif;margin-bottom:24px;}
        .alert-error{padding:14px 18px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:6px;font:500 14px Inter,sans-serif;margin-bottom:24px;}

        /* Responsive */
        @media(max-width:1024px){
            .page-body{grid-template-columns:1fr;gap:32px;}
            .sidebar{position:static;}
        }
        @media(max-width:900px){
            .form-grid{grid-template-columns:1fr;}
            .form-group.full{grid-column:span 1;}
        }
    </style>
</head>
<body>
@include('partials._nav', ['locale' => $loc, 'section' => 'careers'])

{{-- Masthead --}}
<div class="masthead">
    <a href="{{ $listRoute }}" class="back-link">← {{ __('site.careers_back', [], $loc) }}</a>
    <h1>{{ $job->title }}</h1>
    <div class="meta-badges">
        <span class="badge b-white">{{ $job->contract_type }}</span>
                <span class="badge b-white"><span class="inline-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 21s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12Z"/><circle cx="12" cy="9" r="2.2"/></svg></span> {{ $job->location }}</span>
        @if($job->experience_level)
            <span class="badge b-white">{{ $en ? $job->experienceLabelEn() : $job->experienceLabelFr() }}</span>
        @endif
        @if($job->salary_range)
            <span class="badge b-gold">{{ $job->salary_range }}</span>
        @endif
        @if($isUrgent)
            <span class="badge b-urgent">
                {{ $daysLeft === 0
                    ? __('site.careers_alert_urgent', [], $loc)
                    : str_replace(':n', $daysLeft, __('site.careers_alert_deadline', [], $loc)) }}
            </span>
        @endif
    </div>
    <div class="breadcrumb">
        <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link', [], $loc) }}</a> ›
        <a href="{{ $listRoute }}">{{ __('site.nav_careers', [], $loc) }}</a> ›
        {{ Str::limit($job->title, 50) }}
    </div>
</div>

{{-- Body --}}
<div class="page-body">

    {{-- LEFT  - Détail --}}
    <div>

        @if(session('apply_success'))
            <div class="alert-success">✓ {{ session('apply_success') }}</div>
        @endif

        {{-- Description --}}
        <div class="section-block">
            <h2>{{ $en ? 'Job description' : 'Description du poste' }}</h2>
            <div class="job-description">{{ $job->description }}</div>
        </div>

        {{-- Profil recherché --}}
        @if($job->requirements)
        <div class="section-block">
            <h2>{{ __('site.careers_requirements_h3', [], $loc) }}</h2>
            <ul class="requirements-list">
                @foreach(preg_split('/\r?\n/', trim($job->requirements)) as $line)
                    @if(trim($line))<li>{{ $line }}</li>@endif
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Formulaire de candidature --}}
        <div class="apply-section" id="apply">
            <h2>{{ __('site.careers_apply_title', [], $loc) }}</h2>
            <p class="apply-lead">{{ __('site.careers_apply_lead', [], $loc) }}</p>

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $e)<div>✕ {{ $e }}</div>@endforeach
                </div>
            @endif

            <div class="form-card">
                <form method="POST" action="{{ $applyRoute }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="locale" value="{{ $loc }}">
                    <div class="form-grid">
                        {{-- Prénom --}}
                        <div class="form-group">
                            <label class="fl" for="first_name">{{ __('site.careers_field_firstname', [], $loc) }} <span class="req">*</span></label>
                            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        {{-- Nom --}}
                        <div class="form-group">
                            <label class="fl" for="last_name">{{ __('site.careers_field_lastname', [], $loc) }} <span class="req">*</span></label>
                            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        {{-- E-mail --}}
                        <div class="form-group">
                            <label class="fl" for="email">{{ __('site.careers_field_email', [], $loc) }} <span class="req">*</span></label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        {{-- Téléphone --}}
                        <div class="form-group">
                            <label class="fl" for="phone">{{ __('site.careers_field_phone', [], $loc) }}</label>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}">
                        </div>
                        {{-- Nationalité --}}
                        <div class="form-group">
                            <label class="fl" for="nationality">{{ __('site.careers_field_nationality', [], $loc) }}</label>
                            <input id="nationality" type="text" name="nationality" value="{{ old('nationality') }}">
                        </div>
                        {{-- Années d'expérience --}}
                        <div class="form-group">
                            <label class="fl" for="experience_years">{{ __('site.careers_field_exp_years', [], $loc) }}</label>
                            <select id="experience_years" name="experience_years">
                                <option value=""> -</option>
                                <option value="0-1" {{ old('experience_years') === '0-1' ? 'selected' : '' }}>0 – 1 {{ $en ? 'yr' : 'an' }}</option>
                                <option value="2-4" {{ old('experience_years') === '2-4' ? 'selected' : '' }}>2 – 4 {{ $en ? 'yrs' : 'ans' }}</option>
                                <option value="5-9" {{ old('experience_years') === '5-9' ? 'selected' : '' }}>5 – 9 {{ $en ? 'yrs' : 'ans' }}</option>
                                <option value="10+" {{ old('experience_years') === '10+' ? 'selected' : '' }}>10+ {{ $en ? 'yrs' : 'ans' }}</option>
                            </select>
                        </div>
                        {{-- Poste actuel --}}
                        <div class="form-group full">
                            <label class="fl" for="current_position">{{ __('site.careers_field_current_pos', [], $loc) }}</label>
                            <input id="current_position" type="text" name="current_position" value="{{ old('current_position') }}" placeholder="{{ $en ? 'E.g. Mining Engineer' : 'Ex : Ingénieur minier' }}">
                        </div>
                        {{-- Lettre de motivation texte --}}
                        <div class="form-group full">
                            <label class="fl" for="motivation">{{ __('site.careers_field_motivation', [], $loc) }} <span class="req">*</span></label>
                            <textarea id="motivation" name="motivation" required placeholder="{{ $en ? 'Tell us why you want to join Néré Mining and what makes you a strong candidate...' : 'Expliquez-nous pourquoi vous souhaitez rejoindre Néré Mining et ce qui fait de vous un candidat idéal...' }}" style="min-height:160px;">{{ old('motivation') }}</textarea>
                            @error('motivation')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        {{-- CV --}}
                        <div class="form-group">
                            <label class="fl">{{ __('site.careers_field_cv', [], $loc) }}</label>
                            <div class="file-group" onclick="document.getElementById('cv-input').click()">
                                <input type="file" id="cv-input" name="cv" accept=".pdf,.doc,.docx"
                                       onchange="showFileName(this,'cv-name')">
                                <div class="file-label"><span class="inline-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m20.5 11.5-8.8 8.8a5 5 0 0 1-7.1-7.1l9-9a3.5 3.5 0 0 1 5 5l-8.9 8.9a2 2 0 1 1-2.8-2.8l8.3-8.3"/></svg></span> {{ $en ? 'Click to attach your CV' : 'Cliquez pour joindre votre CV' }}</div>
                                <div class="file-hint">{{ __('site.careers_file_hint', [], $loc) }}</div>
                                <div class="file-name" id="cv-name"></div>
                            </div>
                            @error('cv')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        {{-- Lettre de motivation fichier --}}
                        <div class="form-group">
                            <label class="fl">{{ __('site.careers_field_cover', [], $loc) }}</label>
                            <div class="file-group" onclick="document.getElementById('cover-input').click()">
                                <input type="file" id="cover-input" name="cover_letter_file" accept=".pdf,.doc,.docx"
                                       onchange="showFileName(this,'cover-name')">
                                <div class="file-label"><span class="inline-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m20.5 11.5-8.8 8.8a5 5 0 0 1-7.1-7.1l9-9a3.5 3.5 0 0 1 5 5l-8.9 8.9a2 2 0 1 1-2.8-2.8l8.3-8.3"/></svg></span> {{ $en ? 'Attach cover letter (optional)' : 'Joindre la lettre (optionnel)' }}</div>
                                <div class="file-hint">{{ __('site.careers_file_hint', [], $loc) }}</div>
                                <div class="file-name" id="cover-name"></div>
                            </div>
                        </div>
                        {{-- Submit --}}
                        <div class="form-group full" style="margin-top:8px;">
                            <button type="submit" class="form-submit">
                                {{ __('site.careers_submit_application', [], $loc) }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- RIGHT  - Sidebar sticky --}}
    <aside class="sidebar">
        <div class="sidebar-card">
            <div class="sidebar-head">
                <h3>{{ $job->title }}</h3>
                <p>{{ $job->department }} · Néré Mining S.A.</p>
            </div>
            <div class="sidebar-meta">
                <div class="meta-row">
                    <span class="meta-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 4h12v17H6zM9 2h6v4H9M9 10h6M9 14h6M9 18h4"/></svg></span>
                    <div><div class="meta-label">{{ $en ? 'Contract' : 'Contrat' }}</div><div class="meta-value">{{ $job->contract_type }}</div></div>
                </div>
                <div class="meta-row">
                    <span class="meta-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 21s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12Z"/><circle cx="12" cy="9" r="2.2"/></svg></span>
                    <div><div class="meta-label">{{ $en ? 'Location' : 'Lieu' }}</div><div class="meta-value">{{ $job->location }}</div></div>
                </div>
                @if($job->experience_level)
                <div class="meta-row">
                    <span class="meta-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m3 9 9-5 9 5-9 5-9-5Z"/><path d="M7 11v5c3 2 7 2 10 0v-5M21 10v6"/></svg></span>
                    <div><div class="meta-label">{{ __('site.careers_experience_label', [], $loc) }}</div><div class="meta-value">{{ $en ? $job->experienceLabelEn() : $job->experienceLabelFr() }}</div></div>
                </div>
                @endif
                @if($job->salary_range)
                <div class="meta-row">
                    <span class="meta-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="13" rx="2"/><path d="M7 6V4h10v2M12 10v5M14 12h-4"/></svg></span>
                    <div><div class="meta-label">{{ __('site.careers_salary_label', [], $loc) }}</div><div class="meta-value">{{ $job->salary_range }}</div></div>
                </div>
                @endif
                <div class="meta-row">
                    <span class="meta-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M7 3v4M17 3v4M3 10h18"/></svg></span>
                    <div><div class="meta-label">{{ __('site.careers_posted_label', [], $loc) }}</div><div class="meta-value">{{ $job->created_at->translatedFormat('d M Y') }}</div></div>
                </div>
                @if($job->deadline)
                <div class="meta-row">
                    <span class="meta-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="13" r="8"/><path d="M12 9v4l3 2M8 3 6 5M16 3l2 2"/></svg></span>
                    <div>
                        <div class="meta-label">{{ __('site.careers_expires_label', [], $loc) }}</div>
                        <div class="meta-value" style="{{ $isUrgent ? 'color:#dc2626;font-weight:600;' : '' }}">{{ $job->deadline->translatedFormat('d M Y') }}</div>
                    </div>
                </div>
                @endif
            </div>
            <div class="sidebar-share">
                <button class="share-btn" onclick="copyJobUrl(this)">
                    <span class="inline-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.1.1l2-2a5 5 0 0 0-7.1-7.1l-1.2 1.2"/><path d="M14 11a5 5 0 0 0-7.1-.1l-2 2a5 5 0 0 0 7.1 7.1l1.2-1.2"/></svg></span> {{ __('site.careers_share', [], $loc) }}
                </button>
            </div>
        </div>

        {{-- Autres offres --}}
        @php
            $others = \App\Models\JobOffer::open()
                ->where('id', '!=', $job->id)
                ->latest()
                ->take(3)
                ->get();
        @endphp
        @if($others->isNotEmpty())
        <div style="margin-top:20px;background:#fff;border:1px solid var(--line);border-radius:10px;overflow:hidden;">
            <div style="padding:16px 20px;border-bottom:1px solid var(--line);">
                <span style="font:600 12px Inter,sans-serif;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);">
                    {{ $en ? 'Other open positions' : 'Autres postes ouverts' }}
                </span>
            </div>
            @foreach($others as $other)
            @php
                if (empty($other->slug)) {
                    $other->slug = \App\Models\JobOffer::makeUniqueSlug($other->title, $other->id);
                    $other->timestamps = false;
                    $other->save();
                }
                $oRoute = $en ? route('english.jobs.show', $other) : route('jobs.show', $other);
            @endphp
            <a href="{{ $oRoute }}" style="display:block;padding:14px 20px;border-bottom:1px solid var(--line);transition:background .15s;">
                <div style="font:600 13px Inter,sans-serif;color:var(--green);margin-bottom:3px;">{{ $other->title }}</div>
                <div style="font:12px Inter,sans-serif;color:var(--muted);">{{ $other->department }} · {{ $other->contract_type }}</div>
            </a>
            @endforeach
        </div>
        @endif
    </aside>
</div>

@include('partials._footer', ['loc' => $loc, 'en' => $en])

<script>
function showFileName(input, nameId) {
    var el = document.getElementById(nameId);
    if (input.files && input.files[0]) {
        el.textContent = '✓ ' + input.files[0].name;
        el.style.display = 'block';
    }
}
function copyJobUrl(btn) {
    navigator.clipboard.writeText(window.location.href).then(function(){
        var orig = btn.innerHTML;
        btn.innerHTML = '✓ {{ __('site.careers_share_copied', [], $loc) }}';
        setTimeout(function(){ btn.innerHTML = orig; }, 2000);
    });
}
(function(){
    var b = document.querySelector('.menu-btn');
    if(b) b.addEventListener('click', function(){
        b.closest('header').querySelector('nav').classList.toggle('open');
    });
})();
</script>
</body>
</html>
