{{-- Page : Santé et Sécurité --}}
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
@endpush

@section('content')

{{-- ── 1. Politique HSE ─────────────────────────────────── --}}
<section class="sa-animated-section" style="padding-top:40px;">
    <div class="sa-particles-container" data-count="5"></div>

    <p class="lead sa-reveal">{{ __('site.hse_policy_lead', [], $loc) }}</p>

    <div class="grid-3" style="margin-top:24px;">
        @foreach(range(1, 3) as $i)
        <div class="sa-program-card sa-reveal sa-delay-{{ $i }}">
            <div class="card-tag">{{ __('site.hse_policy'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_policy'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_policy'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 2. Politique Santé-Sécurité au Travail ───────── --}}
<section class="sa-sand-animated hse-commitment" style="padding:70px 5vw; position:relative;">
    <div style="max-width:980px; margin:0 auto; position:relative; z-index:1;">
        <div class="sa-section-heading sa-reveal">
            
            <div class="sa-divider"></div>
        </div>

        <div class="hse-commitment__body sa-reveal sa-delay-1">
            <p>Chez Riverstone Karma, la santé et la sécurité des personnes constituent une priorité fondamentale. Notre ambition est de mener nos activités « sans préjudice », en mettant en place et en maintenant un système efficace de gestion de la santé et de la sécurité au travail. Nous nous engageons à respecter les lois, réglementations, normes applicables et bonnes pratiques en matière de santé et de sécurité, et à offrir à nos employés, sous-traitants et autres parties prenantes un environnement de travail sûr et sain.</p>

            <p>La prévention des risques repose sur la responsabilité de tous, à tous les niveaux de l'organisation. Riverstone Karma veille à mettre à disposition les ressources, équipements de protection et formations nécessaires, tout en favorisant la participation et la consultation des travailleurs. Chaque collaborateur est encouragé à contribuer à sa propre sécurité et à celle de ses collègues, à signaler les situations dangereuses et bénéficie du droit de refuser un travail présentant un danger. La prévention, l'évaluation et la réduction continue des risques professionnels constituent ainsi des principes essentiels de nos opérations.</p>

            <p>Nous nous inscrivons également dans une démarche d'amélioration continue, fondée sur des systèmes de gestion conformes à des normes reconnues internationalement, des audits périodiques, le suivi de nos performances et une communication ouverte avec nos employés et parties prenantes. Nous ne tolérons aucune violation délibérée des règles de santé et de sécurité. Toute situation ou condition de travail susceptible de présenter un risque peut être signalée en toute confidentialité par téléphone, par courriel ou au moyen des boîtes à idées disponibles sur le site.</p>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 3. Chiffres clés sécurité ──────────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">

        {{-- Échelle de Progression HSE Premium --}}
        <div class="hse-ladder-scale sa-reveal" style="margin-top:0; margin-bottom:40px; background:linear-gradient(135deg,#4b1716 0%,#2d0d10 100%); border-radius:24px; padding:64px 40px; position:relative; overflow:hidden; box-shadow:0 24px 72px rgba(40,29,24,0.4);">
            
            <!-- Texture de fond subtile -->
            <div style="position:absolute; inset:0; opacity:0.03; background-image:repeating-linear-gradient(45deg,transparent,transparent 10px,rgba(255,255,255,0.05) 10px,rgba(255,255,255,0.05) 20px); pointer-events:none;"></div>
            
            <!-- Gradient radial pour profondeur -->
            <div style="position:absolute; inset:0; background:radial-gradient(ellipse at 30% 40%, rgba(255,194,71,0.06), transparent 60%); pointer-events:none;"></div>
            
            <!-- Ligne de connexion animée en forme d'escalier -->
            <svg style="position:absolute; inset:0; width:100%; height:100%; pointer-events:none;" preserveAspectRatio="none" viewBox="0 0 100 100">
                <defs>
                    <linearGradient id="ladderGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:rgba(255,194,71,0.1);stop-opacity:0.4" />
                        <stop offset="25%" style="stop-color:rgba(255,194,71,0.6);stop-opacity:1" />
                        <stop offset="50%" style="stop-color:rgba(255,194,71,0.8);stop-opacity:1" />
                        <stop offset="75%" style="stop-color:rgba(255,194,71,0.9);stop-opacity:1" />
                        <stop offset="100%" style="stop-color:rgba(255,194,71,1);stop-opacity:1" />
                    </linearGradient>
                    <filter id="glow">
                        <feGaussianBlur stdDeviation="4" result="coloredBlur"/>
                        <feMerge>
                            <feMergeNode in="coloredBlur"/>
                            <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </defs>
                <!-- Escalier ascendant avec plateformes -->
                <path d="M 8,85 L 20,85 L 20,65 L 32,65 L 32,45 L 55,45 L 55,25 L 78,25 L 78,15 L 92,15" 
                      fill="none" 
                      stroke="url(#ladderGrad)" 
                      stroke-width="0.8" 
                      stroke-linecap="round" 
                      stroke-linejoin="round"
                      filter="url(#glow)"
                      style="animation:drawLadder 2.5s cubic-bezier(0.65, 0, 0.35, 1) forwards; stroke-dasharray: 200; stroke-dashoffset: 200;"/>
            </svg>
            
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:28px; position:relative; z-index:1;">
                @foreach(range(1, 4) as $i)
                @php
                    $offsetY = (4 - $i) * 60; // Décalage vertical pour effet escalier
                    $scale = 0.92 + ($i * 0.02); // Augmentation progressive de la taille
                    $opacity = 0.08 + ($i * 0.04); // Augmentation de l'opacité
                    $goldIntensity = 0.25 + ($i * 0.15); // Intensité de la couleur dorée
                @endphp
                <div class="hse-ladder-step sa-reveal sa-delay-{{ $i }}" 
                     style="text-align:center; 
                            padding:32px 20px; 
                            background:linear-gradient(145deg,rgba(255,255,255,{{ $opacity }}),rgba(255,194,71,{{ $opacity * 0.6 }})); 
                            border:2px solid rgba(255,194,71,{{ $goldIntensity }}); 
                            border-radius:20px; 
                            transition:all .5s cubic-bezier(0.34,1.56,0.64,1); 
                            position:relative; 
                            transform:translateY({{ $offsetY }}px) scale({{ $scale }}); 
                            cursor:pointer; 
                            overflow:hidden;
                            box-shadow:0 {{ 4 + $i * 2 }}px {{ 16 + $i * 4 }}px rgba(0,0,0,{{ 0.2 + $i * 0.05 }});"
                     data-step="{{ $i }}"
                     onmouseover="this.style.background='linear-gradient(145deg,rgba(255,194,71,0.2),rgba(255,194,71,0.12))'; this.style.transform='translateY({{ $offsetY - 12 }}px) scale({{ $scale + 0.05 }})'; this.style.boxShadow='0 20px 60px rgba(255,194,71,0.35)'; this.style.borderColor='rgba(255,194,71,1)';"
                     onmouseout="this.style.background='linear-gradient(145deg,rgba(255,255,255,{{ $opacity }}),rgba(255,194,71,{{ $opacity * 0.6 }}))'; this.style.transform='translateY({{ $offsetY }}px) scale({{ $scale }})'; this.style.boxShadow='0 {{ 4 + $i * 2 }}px {{ 16 + $i * 4 }}px rgba(0,0,0,{{ 0.2 + $i * 0.05 }})'; this.style.borderColor='rgba(255,194,71,{{ $goldIntensity }})';">
                    
                    <!-- Badge de niveau -->
                    <div style="position:absolute; top:-12px; right:16px; background:linear-gradient(135deg,rgba(255,194,71,0.9),rgba(255,194,71,0.7)); color:#2d0d10; font-size:10px; font-weight:700; padding:4px 12px; border-radius:12px; letter-spacing:.08em; text-transform:uppercase; box-shadow:0 4px 12px rgba(255,194,71,0.4);">
                        {{ $en ? 'Level' : 'Niveau' }} {{ $i }}
                    </div>
                    
                    <!-- Effet de brillance animé -->
                    <div style="position:absolute; inset:-50%; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.15),transparent); animation:ladderShine {{ 4 + $i }}s ease-in-out infinite; pointer-events:none; transform:rotate(45deg);"></div>
                    
                    <!-- Icône décorative selon le niveau -->
                    <div style="font-size:{{ 32 + $i * 4 }}px; margin-bottom:16px; filter:drop-shadow(0 4px 8px rgba(0,0,0,0.2)); animation:float 3s ease-in-out infinite; animation-delay:{{ $i * 0.2 }}s;">
                        @if($i == 1) 🛡️
                        @elseif($i == 2) ✋
                        @elseif($i == 3) 📊
                        @else 🔔
                        @endif
                    </div>
                    
                    <!-- Valeur de la stat -->
                    <div class="hse-ladder-value" style="color:rgba(255,194,71,{{ 0.85 + ($i * 0.05) }}); font-size:{{ 32 + ($i * 6) }}px; font-weight:800; margin-bottom:14px; letter-spacing:-.01em; position:relative; z-index:1; text-shadow:0 2px 8px rgba(0,0,0,0.3); animation:fadeInUp 0.8s ease-out {{ $i * 0.2 }}s both;">
                        {{ __('site.hse_stat'.$i.'_val', [], $loc) }}
                    </div>
                    
                    <!-- Ligne de séparation élégante -->
                    <div style="width:{{ 40 + $i * 8 }}px; height:3px; background:linear-gradient(90deg,transparent,rgba(255,194,71,{{ 0.6 + $i * 0.1 }}),transparent); margin:0 auto 12px; border-radius:2px;"></div>
                    
                    <!-- Description -->
                    <div style="color:rgba(255,255,255,{{ 0.8 + ($i * 0.05) }}); font-size:{{ 13 + $i }}px; line-height:1.5; text-align:center; font-weight:500; position:relative; z-index:1; animation:fadeInUp 0.8s ease-out {{ $i * 0.2 + 0.15 }}s both;">
                        {{ __('site.hse_stat'.$i.'_label', [], $loc) }}
                    </div>
                    
                    <!-- Plateforme décorative sous la carte -->
                    <div style="position:absolute; bottom:-4px; left:10%; right:10%; height:4px; background:rgba(255,194,71,{{ 0.3 + $i * 0.1 }}); border-radius:2px 2px 0 0; box-shadow:0 -2px 8px rgba(255,194,71,0.2);"></div>
                </div>
                @endforeach
            </div>
            
            <!-- Indicateur de progression en bas -->
            <div style="margin-top:48px; text-align:center; position:relative; z-index:1;">
                <div style="display:inline-flex; gap:8px; align-items:center; background:rgba(255,255,255,0.06); padding:12px 24px; border-radius:24px; border:1px solid rgba(255,194,71,0.2);">
                    <div style="color:rgba(255,194,71,0.9); font-size:20px;">📈</div>
                    <div style="color:rgba(255,255,255,0.75); font-size:13px; font-weight:600; letter-spacing:.06em;">
                        {{ $en ? 'Continuous Safety Improvement' : 'Amélioration Continue de la Sécurité' }}
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            @keyframes ladderShine {
                0%, 100% { transform: translateX(-200%) rotate(45deg); }
                50% { transform: translateX(200%) rotate(45deg); }
            }
            @keyframes drawLadder {
                to { stroke-dashoffset: 0; }
            }
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-6px); }
            }
            .hse-ladder-step:hover .hse-ladder-value {
                animation: pulse 0.6s ease-in-out;
            }
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
            @media(max-width:900px) {
                .hse-ladder-scale > div:first-of-type {
                    grid-template-columns: repeat(2, 1fr) !important;
                    gap: 20px !important;
                }
                .hse-ladder-step {
                    transform: translateY(0) !important;
                }
            }
            @media(max-width:520px) {
                .hse-ladder-scale > div:first-of-type {
                    grid-template-columns: 1fr !important;
                }
            }
        </style>

        <div class="grid-3">
            @foreach(range(1, 3) as $i)
            <div class="sa-step-card sa-reveal sa-delay-{{ $i }}" data-step="{{ $i }}">
                <div class="card-tag">{{ __('site.hse_card'.$i.'_tag', [], $loc) }}</div>
                <h3>{{ __('site.hse_card'.$i.'_h3', [], $loc) }}</h3>
                <p>{{ __('site.hse_card'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── 4. Conformité & Amélioration Continue ──────────── --}}
<section class="sa-dark-section" style="padding:70px 5vw; color:#fff;">
    <div style="max-width:960px; margin:0 auto; text-align:center; position:relative; z-index:1;">

        <div class="sa-reveal">
            <div style="font-size:48px; margin-bottom:20px;">⚖️</div>
            
            <div style="width:60px; height:3px; background:linear-gradient(90deg,var(--gold),var(--gold2)); border-radius:2px; margin:0 auto 24px;"></div>
            <p style="color:rgba(255,255,255,0.8); font-size:16px; line-height:1.8; max-width:700px; margin:0 auto 32px; text-align:center;">
                {{ $en
                    ? 'Néré Mining relies on internal controls, inspections and independent reviews to strengthen operational discipline and accountability.'
                    : 'Néré Mining s\'appuie sur des contrôles internes, des inspections et des revues indépendantes pour renforcer la discipline opérationnelle et la responsabilité.'
                }}
            </p>
        </div>

        {{-- Piliers de conformité --}}
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-top:16px;">
            @foreach([
                ['icon'=>'📋','label'=>$en?'Internal Controls':'Contrôles Internes'],
                ['icon'=>'🔍','label'=>$en?'Independent Audits':'Audits Indépendants'],
                ['icon'=>'📈','label'=>$en?'Continuous Improvement':'Amélioration Continue'],
            ] as $k => $pilier)
            <div class="sa-reveal sa-delay-{{ $k+1 }}" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); border-radius:14px; padding:24px 16px; text-align:center; transition:background .3s, transform .3s; cursor:default;"
                 onmouseover="this.style.background='rgba(255,194,71,0.12)'; this.style.transform='translateY(-4px)'"
                 onmouseout="this.style.background='rgba(255,255,255,0.07)'; this.style.transform=''">
                <div style="font-size:32px; margin-bottom:10px;">{{ $pilier['icon'] }}</div>
                <div style="font-size:13px; color:rgba(255,255,255,0.8); font-weight:500; letter-spacing:.04em; text-transform:uppercase;">{{ $pilier['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/sustainability-animations.js') }}"></script>
@endpush

@endsection
