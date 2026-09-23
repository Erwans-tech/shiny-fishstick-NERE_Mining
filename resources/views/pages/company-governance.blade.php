{{-- Page : Gouvernance & Direction --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

@push('styles')
<style>
    /* Page governance avec design harmonisé */
    .governance-page { 
        width: 100vw; 
        max-width: none; 
        margin-left: calc(50% - 50vw); 
        padding: clamp(40px, 8vw, 120px) clamp(24px, 5vw, 88px); 
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.4), rgba(255, 244, 220, 0.6));
        min-height: 100vh;
    }

    .leadership-section { 
        padding-top: 0; 
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Introduction agrandie */
    .leadership-intro { 
        max-width: 900px; 
        margin: 0 auto 60px; 
        text-align: center; 
    }
    
    .leadership-intro h2 { 
        margin-bottom: 20px; 
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 700;
        color: var(--green);
        line-height: 1.2;
    }

    .leadership-intro p {
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        line-height: 1.6;
        color: var(--text);
        font-weight: 400;
    }

    /* Niveaux de leadership */
    .leadership-level { 
        margin-top: 60px; 
    }
    
    .leadership-level + .leadership-level { 
        margin-top: 80px; 
    }

    .leadership-level-heading { 
        display: flex; 
        align-items: center; 
        gap: 20px; 
        margin: 0 0 40px; 
        color: var(--green); 
        font-size: clamp(0.9rem, 2vw, 1.1rem);
        font-weight: 700; 
        letter-spacing: 0.15em; 
        text-transform: uppercase; 
    }
    
    .leadership-level-heading::after { 
        content: ""; 
        height: 2px; 
        flex: 1; 
        background: linear-gradient(90deg, var(--gold), transparent); 
    }

    /* Grille leadership agrandie */
    .leadership-grid { 
        display: flex; 
        flex-wrap: wrap; 
        justify-content: center; 
        gap: clamp(24px, 3vw, 40px);
        align-items: stretch;
    }

    /* Cartes leadership agrandies */
    .leadership-card { 
        flex: 0 1 calc(33.333% - 30px);
        min-width: 320px; 
        max-width: 420px; 
        min-height: 500px;
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        padding: clamp(32px, 4vw, 48px) clamp(24px, 3vw, 32px) clamp(28px, 3vw, 40px);
        text-align: center; 
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid rgba(255, 194, 71, 0.2);
        border-top: 6px solid var(--gold);
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(40, 29, 24, 0.08);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .leadership-card:hover { 
        transform: translateY(-8px); 
        border-color: var(--gold);
        box-shadow: 0 20px 50px rgba(40, 29, 24, 0.15);
        background: rgba(255, 255, 255, 1);
    }

    /* Carte PDG spéciale agrandie */
    .leadership-card--lead { 
        flex: 0 1 100%; 
        width: min(900px, 100%); 
        max-width: 900px; 
        margin: 0 auto; 
        flex-direction: row; 
        gap: clamp(32px, 5vw, 48px);
        align-items: center; 
        text-align: left; 
        background: linear-gradient(135deg, #4b1716 0%, #2d0d10 100%);
        color: #fff; 
        border-top-color: var(--gold);
        padding: clamp(40px, 6vw, 60px);
        min-height: 400px;
    }
    
    .leadership-card--lead .leadership-name,
    .leadership-card--lead .leadership-title { 
        color: #fff; 
    }
    
    .leadership-card--lead .leadership-department { 
        color: rgba(255, 255, 255, 0.8); 
    }

    /* Photos agrandies */
    .leadership-photo { 
        width: 280px; 
        height: 280px; 
        flex: 0 0 280px;
        object-fit: cover; 
        object-position: center 28%; 
        border-radius: 50%; 
        border: 6px solid rgba(255, 194, 71, 0.8);
        background: var(--sand); 
        image-rendering: auto; 
        filter: contrast(1.1) brightness(1.05) saturate(1.05);
        transition: all 0.3s ease;
    }
    
    .leadership-card:not(.leadership-card--lead) .leadership-photo { 
        width: 240px; 
        height: 240px; 
        flex-basis: 240px;
        margin-bottom: 24px; 
        object-position: center 32%; 
    }

    .leadership-card:hover .leadership-photo {
        transform: scale(1.05);
        border-color: var(--gold);
    }

    /* Initiales agrandies */
    .leadership-initials { 
        display: grid; 
        place-items: center; 
        font-size: clamp(3rem, 6vw, 4rem);
        font-weight: 700; 
        color: var(--green); 
    }
    
    .leadership-card--lead .leadership-initials { 
        color: #fff; 
        background: rgba(255, 255, 255, 0.15); 
    }

    /* Textes agrandis */
    .leadership-name { 
        margin: 0 0 12px; 
        color: var(--green); 
        font-size: clamp(1.3rem, 2.5vw, 1.6rem);
        font-weight: 700; 
        line-height: 1.25; 
    }

    .leadership-card--lead .leadership-name {
        font-size: clamp(1.8rem, 3vw, 2.2rem);
        margin-bottom: 16px;
    }
    
    .leadership-card > div:last-child { 
        width: 100%; 
        min-width: 0; 
        text-align: center; 
    }
    
    .leadership-name, .leadership-title, .leadership-department { 
        overflow-wrap: break-word; 
        word-break: normal; 
        text-align: center; 
    }
    
    .leadership-title { 
        margin: 0 0 16px; 
        color: var(--gold2); 
        font-size: clamp(0.9rem, 1.8vw, 1.1rem);
        font-weight: 700; 
        line-height: 1.4; 
        text-transform: uppercase; 
        letter-spacing: 0.05em; 
        text-align: center; 
        text-wrap: balance; 
    }

    .leadership-card--lead .leadership-title {
        font-size: clamp(1.1rem, 2.2vw, 1.4rem);
        margin-bottom: 20px;
    }
    
    .leadership-department { 
        margin: 0; 
        color: var(--muted); 
        font-size: clamp(1rem, 2vw, 1.2rem);
        line-height: 1.5; 
        word-break: normal; 
        text-align: center;
        font-weight: 500;
    }

    .leadership-card--lead .leadership-department {
        font-size: clamp(1.1rem, 2.2vw, 1.3rem);
        line-height: 1.6;
    }
    
    /* Centrage personnalisé par leader */
    [data-member="dr-elie-justin-ouedraogo"] .leadership-photo { object-position: center 20%; }
    [data-member="justin-savadogo"] .leadership-photo { object-position: center 35%; }
    [data-member="pascal-y-ouedraogo"] .leadership-photo { object-position: center 32%; }
    [data-member="laurent-michel-dabire"] .leadership-photo { object-position: center 30%; }

    /* Responsive amélioré */
    @media(max-width: 1200px) { 
        .leadership-card { 
            flex: 0 1 calc(50% - 20px);
            min-width: 280px;
        } 
    }
    
    @media(max-width: 768px) { 
        .leadership-grid { 
            gap: 24px;
        }
        
        .leadership-card { 
            flex: 0 1 100%;
            min-width: 100%;
            max-width: 480px;
            margin: 0 auto;
        } 
        
        .leadership-card--lead { 
            flex-direction: column; 
            text-align: center;
            padding: 40px 32px;
        }

        .leadership-card--lead .leadership-name,
        .leadership-card--lead .leadership-title,
        .leadership-card--lead .leadership-department { 
            text-align: center; 
        }
    }

    @media(max-width: 480px) {
        .governance-page {
            padding: clamp(24px, 6vw, 40px) clamp(16px, 4vw, 24px);
        }

        .leadership-card:not(.leadership-card--lead) .leadership-photo { 
            width: 200px; 
            height: 200px; 
        }

        .leadership-card--lead .leadership-photo { 
            width: 220px; 
            height: 220px; 
            flex: 0 0 220px;
        }
    }
</style>
@endpush

    <section class="governance-page">

    @php
        // HARDCODED LEADERSHIP - No database dependency
        $leadershipMembers = collect([
            ['name' => 'Dr. Elie Justin OUEDRAOGO', 'title' => 'NAAABA BAOOGO DE GOURCY', 'department' => 'Président Directeur Général', 'hierarchy_level' => 1, 'photo_path' => 'images/leadership/pdg-traditional.jpg'],
            ['name' => 'Justin SAVADOGO', 'title' => $en ? 'Deputy CEO' : 'Directeur Général Adjoint', 'department' => 'Administration & Finance', 'hierarchy_level' => 2, 'photo_path' => 'images/leadership/justin-savadogo.jpeg'],
            ['name' => 'Pascal Y. OUEDRAOGO', 'title' => $en ? 'Deputy CEO' : 'Directeur Général Adjoint', 'department' => $en ? 'Supply Chain Planning & Optimization' : 'Planification et optimisation des Approvisionnements', 'hierarchy_level' => 2, 'photo_path' => 'images/leadership/pascal-ouedraogo.jpeg'],
            ['name' => 'Laurent Michel Coubarnibet DABIRE', 'title' => $en ? 'Deputy CEO' : 'Directeur Général Adjoint', 'department' => $en ? 'Corporate & Legal Affairs' : 'Affaires Corporatives & Juridiques', 'hierarchy_level' => 2, 'photo_path' => 'images/leadership/laurent-dabire.jpeg'],
        ]);
        $leadershipLevels = $leadershipMembers->groupBy('hierarchy_level');
        $levelLabels = [1 => '', 2 => '', 3 => $en ? 'Management' : 'Directions et responsables'];
    @endphp

    <div class="leadership-section">
        <div class="leadership-intro">
            <h1>{{ $en ? 'Leadership & Governance' : 'Direction & Gouvernance' }}</h1>
            <p>{{ $en ? 'Meet the visionary leaders who guide NERE MINING in its mission to build a sustainable and responsible mining industry in Burkina Faso, committed to territorial development and shared value creation.' : 'Rencontrez les dirigeants visionnaires qui portent NERE MINING dans sa mission de construire une industrie minière durable et responsable au Burkina Faso, engagée pour le développement territorial et la création de valeur partagée.' }}</p>
        </div>
        @foreach($leadershipLevels as $level => $levelMembers)
        <section class="leadership-level" aria-labelledby="leadership-level-{{ $level }}">
            @if(!empty($levelLabels[$level] ?? $levelLabels[3]))
            <h3 class="leadership-level-heading" id="leadership-level-{{ $level }}">{{ $levelLabels[$level] ?? $levelLabels[3] }}</h3>
            @endif
            <div class="leadership-grid">
            @foreach($levelMembers as $member)
            @php
                $name = $member['name'];
                $title = $member['title'];
                $department = $member['department'];
                $photoPath = $member['photo_path'];
                $memberLevel = $member['hierarchy_level'];
                $photoUrl = asset($photoPath);
                $initials = collect(preg_split('/\s+/', trim($name)))->filter()->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode('');
            @endphp
            <article class="leadership-card {{ $memberLevel === 1 ? 'leadership-card--lead' : '' }}" data-member="{{ str_replace(' ', '-', strtolower($name)) }}">
                <img class="leadership-photo" src="{{ $photoUrl }}" alt="{{ $name }}" loading="lazy">
                <div>
                    <h3 class="leadership-name">{{ $name }}</h3>
                    <p class="leadership-title">{{ $title }}</p>
                    @if($department)<p class="leadership-department">{{ $department }}</p>@endif
                </div>
            </article>
            @endforeach
            </div>
        </section>
        @endforeach
    </div>
</section>
@endsection
