{{-- Page : Notre histoire - Illuminated Manuscript Timeline --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<style>
    /* ══════════════════════════════════════════════════════════════
       ILLUMINATED MANUSCRIPT TIMELINE - Premium Design  
       Concept: Histoire racontée dans un manuscrit enluminé interactif
       ══════════════════════════════════════════════════════════════ */
    
    :root {
        --parchment: #f9f6f0;
        --parchment-dark: #e8e3d8;
        --ink: #2d2820;
        --gold-leaf: #d4af37;
        --gold-bright: #ffd700;
        --burgundy: #800020;
        --sepia: #704214;
        --leather: #5c4033;
    }
    
    .history-page {
        position: relative;
        min-height: 100vh;
        background: radial-gradient(ellipse at center, #1a1612 0%, #0d0a08 100%);
        padding: 80px 20px 120px;
        overflow: hidden;
    }
    
    /* Ambient library lighting */
    .history-page::before {
        content: '';
        position: absolute;
        top: -50%;
        left: 50%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(212,175,55,.15), transparent 70%);
        transform: translateX(-50%);
        pointer-events: none;
        animation: ambientGlow 8s ease-in-out infinite;
    }
    
    @keyframes ambientGlow {
        0%, 100% { opacity: 0.3; transform: translateX(-50%) scale(1); }
        50% { opacity: 0.6; transform: translateX(-50%) scale(1.1); }
    }
    
    /* Floating dust particles */
    .dust-particle {
        position: absolute;
        width: 2px;
        height: 2px;
        background: rgba(212,175,55,.4);
        border-radius: 50%;
        pointer-events: none;
        animation: floatDust 15s linear infinite;
    }
    
    @keyframes floatDust {
        0% { transform: translateY(100vh) translateX(0); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100px) translateX(100px); opacity: 0; }
    }
    
    /* ── Introduction ─────────────────────────────────────────── */
    .manuscript-intro {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 80px;
        position: relative;
        z-index: 2;
    }
    
    .manuscript-title {
        font: 300 48px/1.2 'Playfair Display', Georgia, serif;
        color: var(--gold-leaf);
        margin-bottom: 20px;
        letter-spacing: .05em;
        text-shadow: 0 2px 8px rgba(212,175,55,.4);
        animation: fadeInTitle 1.5s ease-out;
    }
    
    @keyframes fadeInTitle {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .manuscript-subtitle {
        font: 400 14px/1.8 Inter, sans-serif;
        color: var(--parchment-dark);
        letter-spacing: .15em;
        text-transform: uppercase;
        margin-bottom: 30px;
        opacity: 0;
        animation: fadeIn 1.5s ease-out 0.5s forwards;
    }
    
    .manuscript-subtitle::before,
    .manuscript-subtitle::after {
        content: '◆';
        margin: 0 16px;
        color: var(--gold-leaf);
        font-size: 10px;
    }
    
    .manuscript-lead {
        font: 400 16px/1.9 Georgia, serif;
        color: var(--parchment);
        opacity: 0;
        animation: fadeIn 1.5s ease-out 1s forwards;
    }
    
    @keyframes fadeIn {
        to { opacity: 1; }
    }
    
    /* ── Chronicle Book Container ────────────────────────────── */
    .chronicle-book {
        max-width: 1100px;
        margin: 0 auto;
        perspective: 2000px;
        position: relative;
    }
    
    /* Book spine/binding effect */
    .book-binding {
        position: relative;
        width: 20px;
        height: 400px;
        background: linear-gradient(90deg, 
            var(--leather) 0%,
            #4a3428 50%,
            var(--leather) 100%
        );
        margin: 0 auto 60px;
        border-radius: 4px;
        box-shadow: 
            inset 0 0 10px rgba(0,0,0,.5),
            0 8px 20px rgba(0,0,0,.6);
        animation: revealBinding 1s ease-out 0.3s backwards;
    }
    
    @keyframes revealBinding {
        from { height: 0; opacity: 0; }
        to { height: 400px; opacity: 1; }
    }
    
    .book-binding::before,
    .book-binding::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 14px;
        height: 2px;
        background: var(--gold-leaf);
        box-shadow: 0 0 6px rgba(212,175,55,.6);
    }
    
    .book-binding::before { top: 40px; }
    .book-binding::after { bottom: 40px; }
    
    /* ── Manuscript Pages ────────────────────────────────────── */
    .manuscript-pages {
        position: relative;
    }
    
    .manuscript-page {
        position: relative;
        margin-bottom: 100px;
        transform-style: preserve-3d;
        animation: revealPage 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) backwards;
    }
    
    .manuscript-page:nth-child(1) { animation-delay: 0.6s; }
    .manuscript-page:nth-child(2) { animation-delay: 0.9s; }
    .manuscript-page:nth-child(3) { animation-delay: 1.2s; }
    .manuscript-page:nth-child(4) { animation-delay: 1.5s; }
    
    @keyframes revealPage {
        0% {
            opacity: 0;
            transform: rotateY(-90deg) translateX(-200px);
        }
        100% {
            opacity: 1;
            transform: rotateY(0deg) translateX(0);
        }
    }
    
    /* Page wrapper with fold effect */
    .page-wrapper {
        position: relative;
        background: var(--parchment);
        border-radius: 8px;
        box-shadow: 
            0 20px 60px rgba(0,0,0,.8),
            inset 0 0 0 1px rgba(212,175,55,.2),
            inset 0 1px 0 rgba(255,255,255,.3);
        transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        overflow: hidden;
        cursor: pointer;
    }
    
    .page-wrapper:hover {
        transform: translateY(-12px) rotateX(2deg);
        box-shadow: 
            0 30px 80px rgba(0,0,0,.9),
            0 0 0 2px var(--gold-leaf),
            inset 0 0 0 1px rgba(212,175,55,.3),
            inset 0 1px 0 rgba(255,255,255,.4);
    }
    
    /* Parchment texture overlay */
    .page-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(45,40,32,.02) 2px,
                rgba(45,40,32,.02) 4px
            );
        pointer-events: none;
        opacity: 0.6;
    }
    
    /* Gold leaf corner decorations */
    .page-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 120px;
        height: 120px;
        background: 
            radial-gradient(circle at 0 0, transparent 50%, var(--gold-leaf) 50%, var(--gold-leaf) 52%, transparent 52%),
            radial-gradient(circle at 100% 0, transparent 50%, var(--gold-leaf) 50%, var(--gold-leaf) 52%, transparent 52%);
        opacity: 0.15;
        pointer-events: none;
    }
    
    /* ── Page Content ────────────────────────────────────────── */
    .page-content {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 40px;
        padding: 50px;
        position: relative;
    }
    
    /* Illuminated Initial (Drop cap with gold decoration) */
    .illuminated-initial {
        position: relative;
        align-self: start;
        text-align: center;
    }
    
    .initial-decoration {
        width: 140px;
        height: 140px;
        background: linear-gradient(135deg, var(--burgundy), #a0002f);
        border: 4px solid var(--gold-leaf);
        border-radius: 12px;
        display: grid;
        place-items: center;
        box-shadow: 
            0 0 0 8px var(--parchment),
            0 0 0 10px var(--gold-leaf),
            0 8px 24px rgba(0,0,0,.4),
            inset 0 2px 8px rgba(255,255,255,.2);
        position: relative;
        overflow: hidden;
    }
    
    /* Ornamental pattern inside */
    .initial-decoration::before {
        content: '';
        position: absolute;
        inset: 8px;
        border: 1px solid rgba(212,175,55,.3);
        border-radius: 8px;
        pointer-events: none;
    }
    
    .initial-number {
        font: 700 56px/1 'Playfair Display', Georgia, serif;
        color: var(--gold-bright);
        text-shadow: 
            0 2px 4px rgba(0,0,0,.5),
            0 0 20px rgba(255,215,0,.4);
        position: relative;
        z-index: 1;
    }
    
    .initial-label {
        display: block;
        margin-top: 16px;
        font: 600 11px/1.4 Inter, sans-serif;
        letter-spacing: .2em;
        text-transform: uppercase;
        color: var(--gold-leaf);
        text-shadow: 0 1px 2px rgba(0,0,0,.3);
    }
    
    /* Decorative flourish */
    .flourish-line {
        width: 60%;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold-leaf), transparent);
        margin: 12px auto 0;
        position: relative;
    }
    
    .flourish-line::before {
        content: '◆';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: var(--gold-leaf);
        font-size: 8px;
        background: var(--parchment);
        padding: 0 6px;
    }
    
    /* Text content */
    .page-text {
        position: relative;
    }
    
    .page-header {
        display: flex;
        align-items: baseline;
        gap: 16px;
        margin-bottom: 24px;
        border-bottom: 2px solid var(--gold-leaf);
        padding-bottom: 16px;
    }
    
    .chapter-title {
        font: 400 32px/1.3 'Playfair Display', Georgia, serif;
        color: var(--ink);
        flex: 1;
        position: relative;
    }
    
    /* Animated underline */
    .chapter-title::after {
        content: '';
        position: absolute;
        bottom: -18px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--gold-leaf), transparent);
        transition: width 0.8s ease-out;
    }
    
    .page-wrapper:hover .chapter-title::after {
        width: 100%;
    }
    
    .page-toggle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold-leaf), var(--gold-bright));
        border: 3px solid var(--burgundy);
        display: grid;
        place-items: center;
        font: 700 24px/1 Inter, sans-serif;
        color: var(--burgundy);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        box-shadow: 
            0 4px 12px rgba(0,0,0,.3),
            inset 0 1px 2px rgba(255,255,255,.5);
    }
    
    .page-toggle:hover {
        transform: rotate(180deg) scale(1.1);
        box-shadow: 
            0 6px 20px rgba(212,175,55,.6),
            inset 0 1px 2px rgba(255,255,255,.7);
    }
    
    .manuscript-page[open] .page-toggle {
        background: linear-gradient(135deg, var(--burgundy), #a0002f);
        color: var(--gold-bright);
        transform: rotate(180deg);
    }
    
    .page-body {
        font: 400 16px/1.9 Georgia, serif;
        color: var(--sepia);
        text-align: justify;
        padding: 0 50px 50px 270px;
        animation: unfoldText 0.6s ease-out;
    }
    
    @keyframes unfoldText {
        from {
            opacity: 0;
            transform: translateY(-20px);
            filter: blur(4px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }
    }
    
    /* First letter styling */
    .page-body::first-letter {
        font-size: 2em;
        font-weight: 700;
        color: var(--burgundy);
        float: left;
        line-height: 0.8;
        margin: 8px 8px 0 0;
    }
    
    /* Marginal annotations (decorative notes) */
    .marginal-note {
        position: absolute;
        right: -60px;
        top: 50%;
        transform: translateY(-50%);
        font: italic 11px/1.4 Georgia, serif;
        color: var(--gold-leaf);
        text-align: right;
        max-width: 50px;
        opacity: 0;
        transition: opacity 0.4s;
    }
    
    .page-wrapper:hover .marginal-note {
        opacity: 0.7;
    }
    
    /* Wax seal decoration */
    .wax-seal {
        position: absolute;
        bottom: 30px;
        right: 40px;
        width: 60px;
        height: 60px;
        background: radial-gradient(circle, var(--burgundy), #5c0015);
        border-radius: 50%;
        border: 3px solid rgba(212,175,55,.4);
        box-shadow: 
            0 4px 12px rgba(0,0,0,.4),
            inset 0 -2px 6px rgba(0,0,0,.5);
        display: grid;
        place-items: center;
        font: 700 10px Inter, sans-serif;
        color: var(--gold-leaf);
        letter-spacing: .15em;
        pointer-events: none;
    }
    
    .wax-seal::before {
        content: attr(data-year);
        position: relative;
        z-index: 1;
    }
    
    .wax-seal::after {
        content: '';
        position: absolute;
        inset: 12px;
        border: 1px solid rgba(212,175,55,.3);
        border-radius: 50%;
    }
    
    /* ── Quill pen animation (floating) ──────────────────────── */
    .quill-pen {
        position: fixed;
        bottom: 40px;
        right: 40px;
        width: 60px;
        height: 60px;
        background: rgba(212,175,55,.1);
        border: 2px solid var(--gold-leaf);
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(0,0,0,.4);
        animation: floatQuill 3s ease-in-out infinite;
        z-index: 100;
        transition: all 0.3s;
    }
    
    .quill-pen:hover {
        transform: scale(1.1) rotate(15deg);
        background: rgba(212,175,55,.2);
        box-shadow: 0 6px 24px rgba(212,175,55,.4);
    }
    
    @keyframes floatQuill {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(5deg); }
    }
    
    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 900px) {
        .history-page {
            padding: 60px 15px 80px;
        }
        
        .manuscript-title {
            font-size: 36px;
        }
        
        .book-binding {
            height: 200px;
            margin-bottom: 40px;
        }
        
        .page-content {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 30px 24px;
        }
        
        .illuminated-initial {
            margin: 0 auto;
        }
        
        .initial-decoration {
            width: 100px;
            height: 100px;
        }
        
        .initial-number {
            font-size: 42px;
        }
        
        .chapter-title {
            font-size: 24px;
        }
        
        .page-body {
            font-size: 15px;
            padding: 20px 0 0;
        }
        
        .manuscript-page {
            margin-bottom: 60px;
        }
        
        .marginal-note,
        .quill-pen {
            display: none;
        }
        
        .wax-seal {
            width: 50px;
            height: 50px;
            bottom: 20px;
            right: 20px;
        }
    }
</style>

<section class="history-page">
    <!-- Dust particles -->
    <div class="dust-particle" style="left: 10%; animation-delay: 0s;"></div>
    <div class="dust-particle" style="left: 30%; animation-delay: 3s;"></div>
    <div class="dust-particle" style="left: 60%; animation-delay: 6s;"></div>
    <div class="dust-particle" style="left: 80%; animation-delay: 9s;"></div>
    
    <div class="manuscript-intro">
        <h1 class="manuscript-title">{{ $en ? 'The Chronicles' : 'Les Chroniques' }}</h1>
        <p class="manuscript-subtitle">{{ $en ? 'Of Néré Mining' : 'de Néré Mining' }}</p>
        <p class="manuscript-lead">{{ __('site.company_history_lead', [], $loc) }}</p>
    </div>

    <div class="chronicle-book">
        <div class="book-binding"></div>
        
        <div class="manuscript-pages">
            @foreach(range(1, 4) as $i)
            <details class="manuscript-page" {{ $i === 1 ? 'open' : '' }}>
                <summary class="page-wrapper">
                    <div class="page-content">
                        <div class="illuminated-initial">
                            <div class="initial-decoration">
                                <span class="initial-number">{{ $i }}</span>
                            </div>
                            <span class="initial-label">{{ $en ? 'Chapter' : 'Chapitre' }}</span>
                            <div class="flourish-line"></div>
                        </div>
                        
                        <div class="page-text">
                            <div class="page-header">
                                <h3 class="chapter-title">{{ __('site.company_hist'.$i.'_title', [], $loc) }}</h3>
                                <div class="page-toggle">+</div>
                            </div>
                            
                            <div class="marginal-note">Anno {{ 2000 + ($i * 5) }}</div>
                        </div>
                    </div>
                    
                    <div class="wax-seal" data-year="{{ 2000 + ($i * 5) }}"></div>
                </summary>
                
                <div class="page-body">
                    <p>{{ __('site.company_hist'.$i.'_p', [], $loc) }}</p>
                </div>
            </details>
            @endforeach
        </div>
    </div>
    
    <div class="quill-pen" title="{{ $en ? 'Scroll to top' : 'Retour en haut' }}" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        🪶
    </div>
</section>

<script>
// Interactive manuscript pages
document.querySelectorAll('.manuscript-page').forEach(page => {
    const toggle = page.querySelector('.page-toggle');
    
    page.addEventListener('toggle', function() {
        if (page.open) {
            toggle.textContent = '−';
        } else {
            toggle.textContent = '+';
        }
    });
});

// Parallax effect on mouse move
document.addEventListener('mousemove', function(e) {
    if (window.innerWidth > 900) {
        const pages = document.querySelectorAll('.page-wrapper');
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        pages.forEach(page => {
            const rect = page.getBoundingClientRect();
            
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                const tiltX = (mouseY - 0.5) * 5;
                const tiltY = (mouseX - 0.5) * -5;
                page.style.transform = `perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg)`;
            }
        });
    }
});

// Reset transform on mouse leave
document.querySelectorAll('.page-wrapper').forEach(page => {
    page.addEventListener('mouseleave', function() {
        page.style.transform = '';
    });
});

// Scroll reveal animation enhancement
const observerOptions = {
    threshold: 0.2,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0) rotateY(0deg)';
        }
    });
}, observerOptions);

document.querySelectorAll('.manuscript-page').forEach(page => {
    observer.observe(page);
});
</script>
@endsection
