{{-- Page : Carrières (vue simplifiée depuis page.blade.php) --}}
{{-- Note : la vue principale carrières est resources/views/careers/index.blade.php --}}
@extends('layouts.app')

@section('content')

<style>
    .career-hero { display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center; margin-bottom:60px; }
    .career-stat { display:flex; flex-direction:column; align-items:center; text-align:center; gap:8px; }
    .career-stat-num { font-size:36px; font-weight:700; color:var(--green); }
    .career-stat-label { font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; }
    .job-badge { display:inline-block; background:var(--gold); color:var(--ink); padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; margin-right:6px; }
</style>

<section>
    {{-- Hero Section --}}
    <div class="career-hero">
        <div>
            <h1 style="font-size:42px; font-weight:600; color:var(--green); line-height:1.2; margin-bottom:16px;">{{ $en ? 'Join Our Team' : 'Rejoignez Notre Équipe' }}</h1>
            <p class="lead">{{ __('site.careers_why_lead', [], $loc) }}</p>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="career-stat">
                <div class="career-stat-num">1,200+</div>
                <div class="career-stat-label">{{ $en ? 'Employees' : 'Employés' }}</div>
            </div>
            <div class="career-stat">
                <div class="career-stat-num">99%</div>
                <div class="career-stat-label">{{ $en ? 'Burkinabè Staff' : 'Personnel Burkinabè' }}</div>
            </div>
            <div class="career-stat">
                <div class="career-stat-num">50+</div>
                <div class="career-stat-label">{{ $en ? 'Job Categories' : 'Catégories Emplois' }}</div>
            </div>
            <div class="career-stat">
                <div class="career-stat-num">∞</div>
                <div class="career-stat-label">{{ $en ? 'Growth Potential' : 'Potentiel Croissance' }}</div>
            </div>
        </div>
    </div>

    {{-- Why Join Nere --}}
    <div class="grid-3" style="margin-bottom:60px;">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.careers_why'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.careers_why'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.careers_why'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>

    {{-- Open Positions --}}
    <section style="margin-bottom:60px;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:32px; font-weight:600;">{{ __('site.careers_jobs_lead', [], $loc) }}</h2>
        <p style="text-align:center; color:var(--muted); font-size:14px; margin-bottom:32px; line-height:1.7;">{{ $en ? 'We are continuously looking for talented professionals to join our growing team at Karma mine.' : 'Nous recherchons continuellement des professionnels talentueux pour rejoindre notre équipe croissante.' }}</p>

        <div class="grid-3">
            @forelse($jobs as $job)
            <article class="card">
                <div class="card-tag">{{ $job->department }}</div>
                <h3>{{ $job->title }}</h3>
                <p>{{ $job->location }} · {{ $job->contract_type }}</p>
                <p>{{ $job->description }}</p>
                @if($job->deadline)
                <p style="font:500 12px Inter,sans-serif; color:var(--muted);">
                    {{ __('site.careers_deadline', [], $loc) }} {{ $job->deadline->format('d/m/Y') }}
                </p>
                @endif
                <a class="btn btn-dark"
                   style="margin-top:16px; display:inline-block;"
                   href="{{ ($en ? route('english.contact') : route('contact')) }}?type=emploi&subject={{ urlencode($job->title) }}">
                    {{ __('site.careers_apply', [], $loc) }}
                </a>
            </article>
            @empty
            {{-- Sample Jobs (when no jobs in DB) --}}
            @php
            $sampleJobs = [
                ['title' => $en ? 'Mining Operations Manager' : 'Manager Opérations Minières', 'dept' => $en ? 'Operations' : 'Opérations', 'loc' => 'Karma', 'desc' => $en ? 'Lead mining operations team, oversee production targets and safety protocols.' : 'Diriger équipe opérations minières, superviser objectifs production et protocoles sécurité.'],
                ['title' => $en ? 'Environmental Officer' : 'Officier Environnemental', 'dept' => $en ? 'Environment' : 'Environnement', 'loc' => 'Karma', 'desc' => $en ? 'Monitor environmental compliance, conduct assessments, manage mitigation programs.' : 'Surveiller conformité environnementale, effectuer évaluations, gérer programmes mitigation.'],
                ['title' => $en ? 'Safety Supervisor' : 'Superviseur Sécurité', 'dept' => $en ? 'HSE' : 'HSE', 'loc' => 'Karma', 'desc' => $en ? 'Ensure workplace safety, conduct trainings, investigate incidents.' : 'Assurer sécurité travail, conduire formations, enquêter incidents.'],
                ['title' => $en ? 'Process Engineer' : 'Ingénieur Procédé', 'dept' => $en ? 'Processing' : 'Traitement', 'loc' => 'Karma', 'desc' => $en ? 'Optimize processing plant efficiency, maintain equipment, troubleshoot issues.' : 'Optimiser efficacité usine traitement, maintenir équipements, résoudre problèmes.'],
                ['title' => $en ? 'Geologist' : 'Géologue', 'dept' => $en ? 'Exploration' : 'Exploration', 'loc' => 'Karma', 'desc' => $en ? 'Conduct geological surveys, analyze drilling data, assess ore grades.' : 'Effectuer levés géologiques, analyser données forage, évaluer teneurs.'],
                ['title' => $en ? 'Community Relations Officer' : 'Officier Relations Communautaires', 'dept' => $en ? 'Communities' : 'Communautés', 'loc' => 'Ouagadougou', 'desc' => $en ? 'Manage stakeholder relations, coordinate community programs, handle grievances.' : 'Gérer relations parties prenantes, coordonner programmes communautaires, traiter griefs.'],
                ['title' => $en ? 'Equipment Technician' : 'Technicien Équipements', 'dept' => $en ? 'Maintenance' : 'Maintenance', 'loc' => 'Karma', 'desc' => $en ? 'Maintain mining and processing equipment, perform repairs, conduct diagnostics.' : 'Maintenir équipements miniers et traitement, effectuer réparations, diagnostiquer.'],
                ['title' => $en ? 'HR Specialist' : 'Spécialiste RH', 'dept' => $en ? 'Human Resources' : 'Ressources Humaines', 'loc' => 'Ouagadougou', 'desc' => $en ? 'Recruitment, employee development, payroll administration, training programs.' : 'Recrutement, développement employés, paie, programmes formation.'],
            ];
            @endphp
            @foreach($sampleJobs as $job)
            <article class="card">
                <div class="card-tag">{{ $job['dept'] }}</div>
                <h3>{{ $job['title'] }}</h3>
                <p><span class="job-badge">{{ $job['loc'] }}</span></p>
                <p style="color:var(--muted); font-size:14px; line-height:1.7;">{{ $job['desc'] }}</p>
                <a class="btn btn-dark"
                   style="margin-top:16px; display:inline-block;"
                   href="{{ ($en ? route('english.contact') : route('contact')) }}?type=emploi&subject={{ urlencode($job['title']) }}">
                    {{ __('site.careers_apply', [], $loc) }}
                </a>
            </article>
            @endforeach
            @endforelse
        </div>
    </section>

    {{-- Culture & Benefits --}}
    <section class="sand" style="margin-bottom:60px; border-radius:12px; padding:40px;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:32px; font-size:32px; font-weight:600;">{{ $en ? 'Life at Néré Mining' : 'La Vie chez Néré Mining' }}</h2>
        <div class="grid-2">
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:18px; font-weight:600;">{{ $en ? 'Our Culture' : 'Notre Culture' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Teamwork and collaboration in all we do' : 'Travail d\'équipe et collaboration dans tout ce que nous faisons' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Results-oriented mindset with shared goals' : 'Mentalité orientée résultats avec objectifs partagés' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Clear behavioral standards and ethics' : 'Standards de comportement clairs et éthique' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Safety as our top priority' : 'Sécurité notre priorité absolue' }}</li>
                    <li>✓ {{ $en ? 'Respect for all community members' : 'Respect pour tous les membres communautaires' }}</li>
                </ul>
            </div>
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:18px; font-weight:600;">{{ $en ? 'Benefits & Development' : 'Avantages & Développement' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Competitive salary and benefits package' : 'Salaire compétitif et package avantages' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Training and professional development' : 'Formation et développement professionnel' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Career advancement opportunities' : 'Opportunités d\'avancement carrière' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Health & safety insurance coverage' : 'Couverture assurance santé & sécurité' }}</li>
                    <li>✓ {{ $en ? 'Work-life balance and flexibility' : 'Équilibre vie-travail et flexibilité' }}</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section style="text-align:center;">
        <h2 style="color:var(--green); margin-bottom:16px; font-size:28px; font-weight:600;">{{ $en ? 'Ready to Join Néré Mining?' : 'Prêt à Rejoindre Néré Mining ?' }}</h2>
        <p style="color:var(--muted); font-size:14px; margin-bottom:24px; line-height:1.7;">{{ $en ? 'Explore our open positions, apply directly, or send us your CV for future opportunities.' : 'Explorez nos postes ouverts, postulez directement, ou envoyez-nous votre CV pour opportunités futures.' }}</p>
        <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
            <a class="btn btn-dark"
               href="{{ $en ? route('english.contact') : route('contact') }}">
                {{ __('site.careers_apply', [], $loc) }}
            </a>
            <a class="btn btn-outline"
               href="{{ $en ? route('english.spontaneous') : route('spontaneous') }}">
                {{ __('site.spontaneous', [], $loc) }}
            </a>
        </div>
    </section>
</section>

@endsection
