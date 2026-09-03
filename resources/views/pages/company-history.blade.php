{{-- Page : Notre histoire - Mining Excavation Timeline --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<style>
    /* ══════════════════════════════════════════════════════════════
       MINING EXCAVATION TIMELINE - Design Unique
       Concept: Timeline comme une excavation minière avec strates
       ══════════════════════════════════════════════════════════════ */
    /* ══════════════════════════════════════════════════════════════
       MINING EXCAVATION TIMELINE - Design Unique
       Concept: Timeline comme une excavation minière avec strates
       ══════════════════════════════════════════════════════════════ */
    
    :root {
        --depth-surface: #f4e8d8;
        --depth-1: #e8d5c4;
        --depth-2: #dcc4b0;
        --depth-3: #c9a687;
        --depth-4: #b08968;
        --rock-dark: #5a4a3a;
        --gold-ore: #ffd700;
        --copper: #b87333;
    }
    
    .history-page {
        position: relative;
        min-height: 100vh;
        background: linear-gradient(180deg, #e8f2f7 0%, var(--depth-surface) 100%);
        overflow: hidden;
        padding: 80px 0 0;
    }
    
    /* Clouds floating above the excavation */
    .history-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 200px;
        background: 
            radial-gradient(ellipse 200px 60px at 20% 40%, rgba(255,255,255,.7), transparent),
            radial-gradient(ellipse 180px 50px at 60% 60%, rgba(255,255,255,.5), transparent),
            radial-gradient(ellipse 220px 70px at 85% 30%, rgba(255,255,255,.6), transparent);
        pointer-events: none;
        animation: floatClouds 40s ease-in-out infinite;
    }
    
    @keyframes floatClouds {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(30px); }
    }
    
    /* Sun in the sky */
    .history-sun {
        position: absolute;
        top: 50px;
        right: 100px;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: radial-gradient(circle, #ffd700, #ffed4e);
        box-shadow: 0 0 40px rgba(255,215,0,.6),
                    0 0 80px rgba(255,215,0,.3);
        animation: pulseSun 4s ease-in-out infinite;
        z-index: 1;
    }
    
    @keyframes pulseSun {
        0%, 100% { transform: scale(1); opacity: 0.9; }
        50% { transform: scale(1.05); opacity: 1; }
    }
    
    /* ── Introduction ─────────────────────────────────────────── */
    .history-intro {
        position: relative;
        max-width: 900px;
        margin: 0 auto 60px;
        text-align: center;
        z-index: 2;
        padding: 0 20px;
    }
    
    .history-intro-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 24px;
        background: rgba(255,255,255,.9);
        border: 2px solid var(--gold);
        border-radius: 30px;
        color: var(--rock-dark);
        font: 700 11px Inter, sans-serif;
        letter-spacing: .2em;
        text-transform: uppercase;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,.1);
    }
    
    .history-intro-badge::before {
        content: '⛏️';
        font-size: 16px;
        animation: pickaxeSwing 2s ease-in-out infinite;
    }
    
    @keyframes pickaxeSwing {
        0%, 100% { transform: rotate(-20deg); }
        50% { transform: rotate(20deg); }
    }
    
    .history-intro .lead {
        font-size: 18px;
        line-height: 1.8;
        color: var(--rock-dark);
    }
    
    /* ── Excavation Site Container ───────────────────────────── */
    .excavation-site {
        position: relative;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px 100px;
        perspective: 1500px;
    }
    
    /* Ground surface edge */
    .ground-surface {
        position: relative;
        height: 60px;
        background: linear-gradient(180deg, #8b7355 0%, #6b5844 100%);
        border-top: 4px solid #5a4a3a;
        margin-bottom: -20px;
        z-index: 5;
        box-shadow: inset 0 4px 8px rgba(0,0,0,.3);
    }
    
    .ground-surface::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 0;
        right: 0;
        height: 20px;
        background: repeating-linear-gradient(
            90deg,
            #90a955 0px,
            #90a955 3px,
            #7d9342 3px,
            #7d9342 6px
        );
    }
    
    /* Excavation pit */
    .excavation-pit {
        position: relative;
        background: linear-gradient(180deg, 
            var(--depth-1) 0%,
            var(--depth-2) 30%,
            var(--depth-3) 60%,
            var(--depth-4) 100%
        );
        border-left: 8px solid var(--rock-dark);
        border-right: 8px solid var(--rock-dark);
        padding: 60px 40px 80px;
        transform-style: preserve-3d;
        box-shadow: inset 0 10px 30px rgba(0,0,0,.4);
    }
    
    /* Rock texture overlay */
    .excavation-pit::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(90,74,58,.3) 2px, transparent 2px),
            radial-gradient(circle at 80% 60%, rgba(90,74,58,.2) 3px, transparent 3px),
            radial-gradient(circle at 40% 80%, rgba(90,74,58,.25) 2px, transparent 2px);
        background-size: 100px 100px;
        opacity: 0.5;
        pointer-events: none;
    }
    
    /* ── Geological Layers (Events) ──────────────────────────── */
    .geological-layer {
        position: relative;
        margin: 0 auto 80px;
        max-width: 1000px;
        transform-style: preserve-3d;
        animation: revealLayer 1s ease-out backwards;
    }
    
    .geological-layer:nth-child(1) { animation-delay: 0.2s; }
    .geological-layer:nth-child(2) { animation-delay: 0.4s; }
    .geological-layer:nth-child(3) { animation-delay: 0.6s; }
    .geological-layer:nth-child(4) { animation-delay: 0.8s; }
    
    @keyframes revealLayer {
        from {
            opacity: 0;
            transform: translateY(40px) translateZ(-100px);
        }
        to {
            opacity: 1;
            transform: translateY(0) translateZ(0);
        }
    }
    
    /* Layer structure */
    .layer-wrapper {
        display: grid;
        grid-template-columns: 80px 1fr;
        gap: 30px;
        align-items: start;
    }
    
    /* Depth marker (left side) */
    .depth-marker {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    
    .depth-marker-line {
        width: 3px;
        height: 100%;
        min-height: 120px;
        background: linear-gradient(180deg, 
            var(--gold-ore),
            var(--copper),
            var(--rock-dark)
        );
        box-shadow: 0 0 10px rgba(255,215,0,.3);
        position: relative;
    }
    
    .depth-marker-line::before,
    .depth-marker-line::after {
        content: '';
        position: absolute;
        left: 50%;
        width: 20px;
        height: 2px;
        background: var(--rock-dark);
        transform: translateX(-50%);
    }
    
    .depth-marker-line::before { top: 0; }
    .depth-marker-line::after { bottom: 0; }
    
    .depth-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold-ore), #ffed4e);
        border: 4px solid var(--rock-dark);
        display: grid;
        place-items: center;
        font: 700 20px Inter, sans-serif;
        color: var(--rock-dark);
        box-shadow: 
            0 0 0 8px rgba(255,215,0,.2),
            0 8px 20px rgba(0,0,0,.3),
            inset 0 2px 4px rgba(255,255,255,.4);
        position: relative;
        animation: rotateMinerals 15s linear infinite;
    }
    
    @keyframes rotateMinerals {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Sparkle effect on gold */
    .depth-icon::after {
        content: '✦';
        position: absolute;
        top: -8px;
        right: -8px;
        color: white;
        font-size: 14px;
        animation: sparkle 2s ease-in-out infinite;
        text-shadow: 0 0 8px rgba(255,255,255,.8);
    }
    
    @keyframes sparkle {
        0%, 100% { opacity: 0; transform: scale(0.5) rotate(0deg); }
        50% { opacity: 1; transform: scale(1) rotate(180deg); }
    }
    
    /* Stratum card (the actual content) */
    .stratum-card {
        position: relative;
        background: linear-gradient(135deg, 
            rgba(255,255,255,.95) 0%,
            rgba(255,248,240,.95) 100%
        );
        border: 3px solid var(--rock-dark);
        border-left-width: 8px;
        border-radius: 12px;
        padding: 30px 35px;
        box-shadow: 
            -4px 0 0 0 var(--gold-ore),
            8px 8px 0 0 rgba(90,74,58,.3),
            0 12px 30px rgba(0,0,0,.2);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
        overflow: hidden;
    }
    
    /* Rock chips decoration */
    .stratum-card::before {
        content: '';
        position: absolute;
        top: 10px;
        right: 10px;
        width: 40px;
        height: 40px;
        background: radial-gradient(circle at 30% 30%, 
            rgba(184,115,51,.2), 
            transparent
        );
        border-radius: 50% 40% 50% 40%;
        pointer-events: none;
    }
    
    .stratum-card:hover {
        transform: translateX(8px) translateY(-4px);
        box-shadow: 
            -4px 0 0 0 var(--gold-ore),
            12px 12px 0 0 rgba(90,74,58,.4),
            0 16px 40px rgba(0,0,0,.3);
    }
    
    /* Fossil/artifact badge */
    .stratum-badge {
        position: absolute;
        top: -12px;
        right: 30px;
        padding: 4px 14px;
        background: var(--rock-dark);
        color: var(--gold-ore);
        font: 700 10px Inter, sans-serif;
        letter-spacing: .15em;
        text-transform: uppercase;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0,0,0,.3);
    }
    
    .stratum-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 16px;
    }
    
    .stratum-title {
        font: 600 24px Inter, sans-serif;
        color: var(--green);
        line-height: 1.3;
        flex: 1;
    }
    
    .stratum-toggle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--gold);
        color: var(--rock-dark);
        border: 3px solid var(--rock-dark);
        display: grid;
        place-items: center;
        font: 700 20px/1 Inter, sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .stratum-toggle:hover {
        transform: rotate(90deg) scale(1.1);
        background: var(--gold-ore);
        box-shadow: 0 0 12px rgba(255,215,0,.6);
    }
    
    .stratum-card[open] .stratum-toggle {
        background: var(--rock-dark);
        color: var(--gold-ore);
        transform: rotate(180deg);
    }
    
    .stratum-content {
        color: var(--muted);
        font-size: 15px;
        line-height: 1.8;
        padding-top: 16px;
        border-top: 2px dashed rgba(90,74,58,.2);
        animation: unfoldContent 0.5s ease-out;
    }
    
    @keyframes unfoldContent {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Mineral deposits floating around */
    .mineral-deposit {
        position: absolute;
        width: 8px;
        height: 8px;
        background: var(--gold-ore);
        border-radius: 50%;
        box-shadow: 0 0 8px rgba(255,215,0,.6);
        animation: floatMineral 6s ease-in-out infinite;
        pointer-events: none;
    }
    
    .mineral-deposit:nth-child(1) { top: 15%; left: 10%; animation-delay: 0s; }
    .mineral-deposit:nth-child(2) { top: 40%; right: 15%; animation-delay: 1s; }
    .mineral-deposit:nth-child(3) { top: 65%; left: 20%; animation-delay: 2s; }
    .mineral-deposit:nth-child(4) { top: 85%; right: 25%; animation-delay: 3s; }
    
    @keyframes floatMineral {
        0%, 100% { 
            transform: translateY(0) scale(1);
            opacity: 0.6;
        }
        50% { 
            transform: translateY(-20px) scale(1.2);
            opacity: 1;
        }
    }
    
    /* Drill equipment at bottom */
    .drill-equipment {
        text-align: center;
        padding: 40px 20px;
        color: var(--rock-dark);
        font: 600 13px Inter, sans-serif;
        letter-spacing: .1em;
        text-transform: uppercase;
    }
    
    .drill-equipment::before {
        content: '⚙️';
        display: block;
        font-size: 40px;
        margin-bottom: 12px;
        animation: rotateDrill 3s linear infinite;
    }
    
    @keyframes rotateDrill {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 900px) {
        .history-page {
            padding: 60px 0 0;
        }
        
        .history-sun {
            width: 60px;
            height: 60px;
            top: 30px;
            right: 30px;
        }
        
        .history-intro {
            margin-bottom: 40px;
        }
        
        .excavation-pit {
            padding: 40px 20px 60px;
            border-left-width: 4px;
            border-right-width: 4px;
        }
        
        .layer-wrapper {
            grid-template-columns: 50px 1fr;
            gap: 15px;
        }
        
        .depth-icon {
            width: 50px;
            height: 50px;
            font-size: 16px;
        }
        
        .depth-marker-line {
            min-height: 100px;
        }
        
        .stratum-card {
            padding: 20px 24px;
        }
        
        .stratum-title {
            font-size: 20px;
        }
        
        .stratum-toggle {
            width: 32px;
            height: 32px;
            font-size: 18px;
        }
        
        .geological-layer {
            margin-bottom: 50px;
        }
        
        .mineral-deposit {
            display: none;
        }
    }
</style>

<section class="history-page">
    <div class="history-sun"></div>
    
    <div class="history-intro">
        <div class="history-intro-badge">
            <span>{{ $en ? 'Excavating Our Past' : 'Excavation de Notre Histoire' }}</span>
        </div>
        <p class="lead">{{ __('site.company_history_lead', [], $loc) }}</p>
    </div>

    <div class="excavation-site">
        <div class="ground-surface"></div>
        
        <div class="excavation-pit">
            <div class="mineral-deposit"></div>
            <div class="mineral-deposit"></div>
            <div class="mineral-deposit"></div>
            <div class="mineral-deposit"></div>
            
            @foreach(range(1, 4) as $i)
            <article class="geological-layer">
                <div class="layer-wrapper">
                    <div class="depth-marker">
                        <div class="depth-icon">{{ $i }}</div>
                        <div class="depth-marker-line"></div>
                    </div>
                    
                    <details class="stratum-card" {{ $i === 1 ? 'open' : '' }}>
                        <summary class="stratum-header">
                            <span class="stratum-badge">{{ $en ? 'Era' : 'Ère' }} 0{{ $i }}</span>
                            <h3 class="stratum-title">{{ __('site.company_hist'.$i.'_title', [], $loc) }}</h3>
                            <div class="stratum-toggle">+</div>
                        </summary>
                        <div class="stratum-content">
                            <p>{{ __('site.company_hist'.$i.'_p', [], $loc) }}</p>
                        </div>
                    </details>
                </div>
            </article>
            @endforeach
            
            <div class="drill-equipment">
                {{ $en ? 'Digging Deeper Into Tomorrow' : 'Creusons Plus Profond Vers Demain' }}
            </div>
        </div>
    </div>
</section>

<script>
// Interactive stratum cards
document.querySelectorAll('.stratum-card').forEach(card => {
    const toggle = card.querySelector('.stratum-toggle');
    const summary = card.querySelector('.stratum-header');
    
    // Prevent default details behavior for custom animation
    summary.addEventListener('click', function(e) {
        if (e.target === toggle || toggle.contains(e.target)) {
            return; // Let it work naturally
        }
    });
    
    // Update toggle icon
    card.addEventListener('toggle', function() {
        if (card.open) {
            toggle.textContent = '−';
        } else {
            toggle.textContent = '+';
        }
    });
    
    // 3D tilt effect on hover
    card.addEventListener('mousemove', function(e) {
        if (window.innerWidth > 900) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateX(8px) translateY(-4px)`;
        }
    });
    
    card.addEventListener('mouseleave', function() {
        card.style.transform = '';
    });
});

// Parallax depth effect on scroll
window.addEventListener('scroll', function() {
    const layers = document.querySelectorAll('.geological-layer');
    const scrolled = window.pageYOffset;
    
    layers.forEach((layer, index) => {
        const speed = (index + 1) * 0.1;
        const yPos = -(scrolled * speed);
        if (window.innerWidth > 900) {
            layer.style.transform = `translateY(${yPos}px)`;
        }
    });
}, { passive: true });
</script>
@endsection
