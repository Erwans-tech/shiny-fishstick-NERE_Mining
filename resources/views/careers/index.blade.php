@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
    $total = $jobs->count();
    $countLabel = $total === 1
        ? str_replace(':n', $total, __('site.careers_count_singular', [], $loc))
        : str_replace(':n', $total, __('site.careers_count_plural',   [], $loc));
@endphp
<!DOCTYPE html>
<html lang="{{ $loc }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.careers_h1', [], $loc) }} | Néré Mining</title>
    <meta name="description" content="{{ __('site.careers_why_lead', [], $loc) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chrome.css') }}?v={{ filemtime(public_path('css/chrome.css')) }}">
    <style>
        :root{--ink:#281d18;--green:#4b1716;--red:#d72f2f;--gold:#ffc247;--gold2:#e5a72f;--sand:#fff4dc;--muted:#70645c;--line:#eadcc5;--light:#fbfaf7;}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{color:var(--ink);background:var(--light);font-family:'Inter',Arial,sans-serif;line-height:1.6;}
        a{color:inherit;text-decoration:none;}
        img{display:block;max-width:100%;}

        /* ── Masthead ── */
        .masthead{padding:100px 5vw 80px;color:#fff;background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('{{ asset('images/mining/karma-04.jpg') }}') center/cover;}
        .eyebrow{color:var(--gold);font:700 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:14px;display:flex;align-items:center;gap:10px;}
        .eyebrow::before{content:'';display:block;width:24px;height:2px;background:var(--gold);}
        h1{max-width:800px;font-size:clamp(40px,6vw,76px);line-height:.97;font-weight:300;color:#fff;}
        .breadcrumb{margin-top:20px;font:12px Inter,sans-serif;color:rgba(255,255,255,.6);}
        .breadcrumb a{color:var(--gold);}

        /* ── Layout ── */
        main{max-width:1240px;margin:auto;}
        section{padding:80px 5vw;}
        section+section{padding-top:0;}

        /* ── Why section ── */
        .why-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:40px;}
        .why-card{padding:30px 26px;border:1px solid var(--line);background:#fff;border-radius:10px;transition:box-shadow .2s,transform .2s;position:relative;overflow:hidden;}
        .why-card::before{content:'';position:absolute;inset:0 0 auto 0;height:3px;background:linear-gradient(to right,var(--gold),var(--gold2));transform:scaleX(0);transform-origin:left;transition:transform .3s;}
        .why-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.07);transform:translateY(-3px);}
        .why-card:hover::before{transform:scaleX(1);}
        .why-num{font:700 11px Inter,sans-serif;letter-spacing:.18em;color:var(--gold2);margin-bottom:14px;}
        .why-card h3{font:600 17px Inter,sans-serif;color:var(--green);margin-bottom:10px;}
        .why-card p{font:14px/1.65 Inter,sans-serif;color:var(--muted);}

        /* ── Filter bar ── */
        .filter-bar{display:flex;align-items:center;gap:12px;flex-wrap:wrap;padding:20px 5vw;background:#fff;border-bottom:1px solid var(--line);border-top:1px solid var(--line);position:sticky;top:76px;z-index:50;}
        .filter-bar form{display:contents;}
        .filter-select{padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;color:var(--ink);background:#fff;cursor:pointer;transition:border-color .15s;}
        .filter-select:focus{outline:none;border-color:var(--gold);}
        .filter-count{margin-left:auto;font:600 13px Inter,sans-serif;color:var(--muted);}
        .filter-count span{color:var(--green);}
        .filter-reset{padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 12px Inter,sans-serif;color:var(--muted);background:#fff;cursor:pointer;transition:all .15s;}
        .filter-reset:hover{border-color:var(--red);color:var(--red);}
        .filter-bar button[type=submit]{padding:9px 18px;background:var(--green);color:#fff;border:none;border-radius:6px;font:600 12px Inter,sans-serif;cursor:pointer;transition:background .15s;}
        .filter-bar button[type=submit]:hover{background:#3a100f;}

        /* ── Jobs list ── */
        .jobs-section{padding:60px 5vw 80px;}
        .jobs-list{display:flex;flex-direction:column;gap:16px;}
        .job-card{display:grid;grid-template-columns:1fr auto;gap:28px;padding:28px 32px;border:1px solid var(--line);background:#fff;border-radius:10px;align-items:center;transition:box-shadow .2s,border-color .2s,transform .18s;}
        .job-card:hover{box-shadow:0 6px 24px rgba(0,0,0,.07);border-color:var(--gold);transform:translateX(4px);}
        .job-left{}
        .job-dept-row{display:flex;align-items:center;gap:8px;margin-bottom:8px;}
        .job-dept-tag{font:700 10px Inter,sans-serif;letter-spacing:.14em;text-transform:uppercase;color:var(--gold2);}
        .job-urgent{padding:2px 8px;border-radius:20px;background:#fee2e2;color:#991b1b;font:600 10px Inter,sans-serif;letter-spacing:.08em;text-transform:uppercase;}
        .job-card h3{font:600 20px/1.25 Inter,sans-serif;color:var(--green);margin-bottom:8px;}
        .job-excerpt{font:14px/1.6 Inter,sans-serif;color:var(--muted);margin-bottom:14px;max-width:680px;}
        .job-badges{display:flex;gap:8px;flex-wrap:wrap;}
        .badge{padding:5px 12px;border-radius:20px;font:600 11px Inter,sans-serif;letter-spacing:.05em;}
        .b-dept{background:var(--sand);color:var(--green);}
        .b-type{background:#e6f0e6;color:#1d5c1d;}
        .b-loc{background:#f0eae8;color:var(--green);}
        .b-level{background:#e8edf8;color:#1a3a6e;}
        .b-salary{background:#fef3c7;color:#854d0e;}
        .job-deadline{font:12px Inter,sans-serif;color:var(--muted);margin-top:10px;display:flex;align-items:center;gap:6px;}
        .job-deadline .soon{color:#dc2626;font-weight:600;}
        .job-right{flex-shrink:0;display:flex;flex-direction:column;align-items:flex-end;gap:10px;}
        .btn-apply{display:inline-flex;align-items:center;gap:6px;padding:12px 22px;background:var(--green);color:#fff;border-radius:6px;font:600 12px Inter,sans-serif;letter-spacing:.08em;text-transform:uppercase;transition:background .15s,transform .15s;white-space:nowrap;}
        .btn-apply:hover{background:#3a100f;transform:translateY(-2px);}
        .btn-see{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border:1px solid var(--line);color:var(--muted);border-radius:6px;font:500 12px Inter,sans-serif;transition:border-color .15s,color .15s;}
        .btn-see:hover{border-color:var(--green);color:var(--green);}

        /* ── Empty state ── */
        .empty-state{padding:64px 40px;background:#fff;border:1px dashed var(--line);border-radius:10px;text-align:center;}
        .empty-state .icon{font-size:40px;margin-bottom:16px;}
        .empty-state h3{font:500 20px Inter,sans-serif;color:var(--green);margin-bottom:8px;}
        .empty-state p{font:14px Inter,sans-serif;color:var(--muted);}

        /* ── Spontaneous CTA ── */
        .spontaneous-band{background:var(--green);border-radius:10px;padding:40px 48px;display:flex;justify-content:space-between;align-items:center;gap:32px;margin-top:40px;}
        .spontaneous-band h3{font:400 24px Inter,sans-serif;color:#fff;margin-bottom:8px;}
        .spontaneous-band p{font:14px Inter,sans-serif;color:rgba(255,255,255,.65);}
        .btn-gold{display:inline-block;padding:14px 26px;background:var(--gold);color:var(--ink);border-radius:6px;font:600 12px Inter,sans-serif;letter-spacing:.1em;text-transform:uppercase;transition:background .15s,transform .15s;white-space:nowrap;}
        .btn-gold:hover{background:var(--gold2);transform:translateY(-2px);}

        /* ── Alert ── */
        .alert-success{padding:14px 18px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:6px;font:500 14px Inter,sans-serif;margin-bottom:24px;}

        /* ── Responsive ── */
        @media(max-width:900px){
            .why-grid{grid-template-columns:1fr;}
            .job-card{grid-template-columns:1fr;gap:16px;}
            .job-right{align-items:flex-start;flex-direction:row;}
            .spontaneous-band{flex-direction:column;padding:28px 24px;gap:20px;}
            .filter-bar{position:static;flex-direction:column;align-items:flex-start;}
            .filter-count{margin-left:0;}
        }
    </style>
</head>
<body>
@include('partials._nav', ['locale' => $loc, 'section' => 'careers'])

<div class="masthead">
    <h1>{{ __('site.careers_h1', [], $loc) }}</h1>
    <div class="breadcrumb">
        <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link', [], $loc) }}</a>
        › {{ __('site.careers_breadcrumb', [], $loc) }}
    </div>
</div>

<main>
    @if(session('apply_success'))
        <section style="padding-bottom:0;">
            <div class="alert-success">✓ {{ session('apply_success') }}</div>
        </section>
    @endif

    {{-- ── Pourquoi Néré Mining ── --}}
    <section>
        <p style="color:var(--gold2);font:700 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:10px;display:flex;align-items:center;gap:10px;">
            <span style="display:block;width:22px;height:2px;background:var(--gold2);"></span>
            {{ __('site.careers_why_h2', [], $loc) }}
        </p>
        <h2 style="color:var(--green);font:400 clamp(28px,3.5vw,44px) Inter,sans-serif;line-height:1.05;margin-bottom:14px;">
            {{ __('site.careers_why_lead', [], $loc) }}
        </h2>
        <div class="why-grid">
            @foreach(range(1,3) as $i)
            <div class="why-card">
                <div class="why-num">0{{ $i }}</div>
                <h3>{{ __('site.careers_why'.$i.'_h3', [], $loc) }}</h3>
                <p>{{ __('site.careers_why'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ── Statistiques emploi ── --}}
    <section style="padding-top:0;padding-bottom:40px;">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--line);border:1px solid var(--line);border-radius:8px;overflow:hidden;">
            @foreach([['409','Emplois directs','Direct employees'],['1 500','Travailleurs sous-traitants','Subcontracted workers'],['60%','Emploi local et régional','Local & regional employment'],['99%',"Travailleurs burkinabè",'Burkinabe workers']] as [$v,$fr,$en_label])
            <div style="background:#fff;padding:24px 20px;text-align:center;">
                <div style="font:300 36px Inter,sans-serif;color:var(--green);margin-bottom:6px;">{{ $v }}</div>
                <div style="font:500 12px Inter,sans-serif;color:var(--muted);line-height:1.4;">{{ $en ? $en_label : $fr }}</div>
            </div>
            @endforeach
        </div>
    </section>
</main>

{{-- ── Barre de filtres (sticky) ── --}}
<div class="filter-bar">
    <form method="GET" action="{{ $en ? route('english.careers') : route('careers') }}" style="display:contents;">
        <select name="dept" class="filter-select" onchange="this.form.submit()">
            <option value="">{{ __('site.careers_filter_dept', [], $loc) }}</option>
            @foreach($departments as $d)
            <option value="{{ $d }}" {{ request('dept') === $d ? 'selected' : '' }}>{{ $d }}</option>
            @endforeach
        </select>

        <select name="type" class="filter-select" onchange="this.form.submit()">
            <option value="">{{ __('site.careers_filter_type', [], $loc) }}</option>
            @foreach($contractTypes as $ct)
            <option value="{{ $ct }}" {{ request('type') === $ct ? 'selected' : '' }}>{{ $ct }}</option>
            @endforeach
        </select>

        <select name="level" class="filter-select" onchange="this.form.submit()">
            <option value="">{{ __('site.careers_filter_level', [], $loc) }}</option>
            @foreach(\App\Models\JobOffer::experienceLevels() as $key => $labels)
            <option value="{{ $key }}" {{ request('level') === $key ? 'selected' : '' }}>
                {{ $en ? $labels['en'] : $labels['fr'] }}
            </option>
            @endforeach
        </select>

        @if(request()->hasAny(['dept','type','level']))
        <a href="{{ $en ? route('english.careers') : route('careers') }}" class="filter-reset">
            ✕ {{ __('site.careers_filter_reset', [], $loc) }}
        </a>
        @endif
    </form>
    <div class="filter-count">
        <span>{{ $countLabel }}</span>
    </div>
</div>

{{-- ── Liste des offres ── --}}
<main>
    <div class="jobs-section">
        <h2 style="color:var(--green);font:400 clamp(28px,3.5vw,44px) Inter,sans-serif;margin-bottom:32px;">
            {{ __('site.careers_jobs_h2', [], $loc) }}
        </h2>

        @if($jobs->isEmpty())
        <div class="empty-state">
            <div class="icon">💼</div>
            <h3>{{ __('site.careers_empty_h3', [], $loc) }}</h3>
            <p>{{ __('site.careers_empty_p', [], $loc) }}</p>
        </div>
        @else
        <div class="jobs-list">
            @foreach($jobs as $job)
            @php
                $daysLeft    = $job->deadline ? now()->diffInDays($job->deadline, false) : null;
                $isUrgent    = $daysLeft !== null && $daysLeft <= 3;
                // Sécurité : si slug manquant, on le génère à la volée sans écrire en base
                if (empty($job->slug)) {
                    $job->slug = \App\Models\JobOffer::makeUniqueSlug($job->title, $job->id);
                    $job->timestamps = false;
                    $job->save();
                }
                $detailRoute = $en ? route('english.jobs.show', $job) : route('jobs.show', $job);
                $applyRoute  = $en ? route('english.jobs.apply', $job) : route('jobs.apply',  $job);
            @endphp
            <article class="job-card">
                <div class="job-left">
                    <div class="job-dept-row">
                        <span class="job-dept-tag">{{ $job->department }}</span>
                        @if($isUrgent)
                            <span class="job-urgent">{{ $daysLeft === 0 ? __('site.careers_alert_urgent', [], $loc) : str_replace(':n', $daysLeft, __('site.careers_alert_deadline', [], $loc)) }}</span>
                        @endif
                    </div>
                    <h3><a href="{{ $detailRoute }}" style="color:inherit;">{{ $job->title }}</a></h3>
                    @if($job->description)
                        <p class="job-excerpt">{{ Str::limit($job->description, 160) }}</p>
                    @endif
                    <div class="job-badges">
                        <span class="badge b-type">{{ $job->contract_type }}</span>
                        <span class="badge b-loc">📍 {{ $job->location }}</span>
                        @if($job->experience_level)
                            <span class="badge b-level">{{ $en ? $job->experienceLabelEn() : $job->experienceLabelFr() }}</span>
                        @endif
                        @if($job->salary_range)
                            <span class="badge b-salary">{{ $job->salary_range }}</span>
                        @endif
                    </div>
                    @if($job->deadline)
                        <div class="job-deadline">
                            <span>🗓</span>
                            <span class="{{ $isUrgent ? 'soon' : '' }}">
                                {{ __('site.careers_deadline', [], $loc) }}
                                {{ $job->deadline->translatedFormat('d M Y') }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="job-right">
                    <a class="btn-apply" href="{{ $detailRoute }}">
                        {{ __('site.careers_apply', [], $loc) }} →
                    </a>
                    <a class="btn-see" href="{{ $detailRoute }}">
                        {{ __('site.careers_see_offer', [], $loc) }}
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @endif

        {{-- ── Spontaneous CTA ── --}}
        <div class="spontaneous-band">
            <div>
                <h3>{{ __('site.careers_spontaneous_title', [], $loc) }}</h3>
                <p>{{ __('site.careers_spontaneous_lead', [], $loc) }}</p>
            </div>
            <a class="btn-gold"
               href="{{ $en ? route('english.spontaneous') : route('spontaneous') }}">
                {{ __('site.careers_spontaneous_btn', [], $loc) }}
            </a>
        </div>
    </div>
</main>

@include('partials._footer', ['loc' => $loc, 'en' => $en])
<script>
(function(){
    var btn = document.querySelector('.menu-btn');
    if(btn) btn.addEventListener('click', function(){
        var nav = btn.closest('header').querySelector('nav');
        nav.classList.toggle('open');
    });
})();
</script>
</body>
</html>
