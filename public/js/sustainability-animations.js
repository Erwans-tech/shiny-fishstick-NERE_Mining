/**
 * 🌿 SUSTAINABILITY ANIMATIONS JS — Néré Mining
 * Moteur d'animations interactives pour section Développement Durable
 */

'use strict';

class SustainabilityAnimator {
  constructor() {
    this.observers = new Map();
    this.reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    this.particles = [];
    this.mouseX = 0;
    this.mouseY = 0;

    if (!this.reducedMotion) {
      this.init();
    } else {
      this.initBasic();
    }
  }

  /* ═══════════════════════════════════════════════════
     INIT
  ═══════════════════════════════════════════════════ */

  init() {
    document.addEventListener('DOMContentLoaded', () => {
      this.setupScrollReveal();
      this.setupCounters();
      this.setupProgressBars();
      this.setupRippleEffect();
      this.setupMagneticHover();
      this.setupMouseTrackingBg();
      this.setup3DTiltCards();
      this.setupParticles();
      this.setupSectionHeadings();
      this.setupAnimatedLists();
      this.setupStatItems();
      this.setupTypewriter();
    });
  }

  initBasic() {
    document.addEventListener('DOMContentLoaded', () => {
      // En mode reduced-motion : juste révéler tout immédiatement
      document.querySelectorAll('.sa-reveal, .sa-reveal-left, .sa-reveal-right, .sa-reveal-scale, .sa-reveal-flip').forEach(el => {
        el.classList.add('visible');
      });
      document.querySelectorAll('.sa-section-heading').forEach(el => el.classList.add('visible'));
      document.querySelectorAll('.sa-timeline-item').forEach(el => el.classList.add('visible'));
      document.querySelectorAll('.sa-animated-list li').forEach(el => el.classList.add('visible'));

      // Barres de progression statiques
      document.querySelectorAll('.sa-progress-fill[data-width]').forEach(el => {
        el.style.width = el.dataset.width;
      });
    });
  }

  /* ═══════════════════════════════════════════════════
     1. SCROLL REVEAL — Intersection Observer
  ═══════════════════════════════════════════════════ */

  setupScrollReveal() {
    const revealClasses = [
      '.sa-reveal',
      '.sa-reveal-left',
      '.sa-reveal-right',
      '.sa-reveal-scale',
      '.sa-reveal-flip',
      '.sa-section-heading',
      '.sa-timeline-item',
    ];

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          // Déclenche les barres si présentes dans l'élément
          this.triggerProgressBarsIn(entry.target);
        }
      });
    }, {
      threshold: 0.12,
      rootMargin: '0px 0px -40px 0px'
    });

    revealClasses.forEach(sel => {
      document.querySelectorAll(sel).forEach(el => observer.observe(el));
    });

    this.observers.set('reveal', observer);
  }

  /* ═══════════════════════════════════════════════════
     2. SECTION HEADINGS — Underline + divider
  ═══════════════════════════════════════════════════ */

  setupSectionHeadings() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.2 });

    document.querySelectorAll('.sa-section-heading').forEach(el => observer.observe(el));
  }

  /* ═══════════════════════════════════════════════════
     3. COMPTEURS ANIMÉS
  ═══════════════════════════════════════════════════ */

  setupCounters() {
    const counter = (element) => {
      const original = element.dataset.original || element.textContent;
      const numericStr = element.dataset.count;
      const prefix = element.dataset.prefix || '';
      const suffix = element.dataset.suffix || '';

      if (!numericStr && !element.dataset.count) return;

      const end = parseFloat(numericStr || element.textContent);
      if (isNaN(end)) return;

      const duration = 1800;
      const startTime = performance.now();
      const isFloat = end % 1 !== 0;

      const step = (now) => {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const value = isFloat
          ? (end * eased).toFixed(1)
          : Math.floor(end * eased).toLocaleString('fr');

        element.textContent = prefix + value + suffix;

        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          element.textContent = original || (prefix + (isFloat ? end.toFixed(1) : end.toLocaleString('fr')) + suffix);
          element.classList.add('sa-count-done');
        }
      };

      requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          if (!el.dataset.counted) {
            el.dataset.counted = '1';
            setTimeout(() => counter(el), 200);
          }
          observer.unobserve(el);
        }
      });
    }, { threshold: 0.3 });

    // Sélecteurs pour tous les compteurs du site
    const counterSelectors = [
      '.sa-metric-value[data-count]',
      '.sustain-metric__value[data-count]',
      '.esg-value[data-count]',
      '.community-stat[data-count]',
      '.stat-value[data-count]',
    ];

    counterSelectors.forEach(sel => {
      document.querySelectorAll(sel).forEach(el => observer.observe(el));
    });
  }

  /* ═══════════════════════════════════════════════════
     4. BARRES DE PROGRESSION
  ═══════════════════════════════════════════════════ */

  setupProgressBars() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          this.triggerProgressBarsIn(entry.target.closest('section') || entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    document.querySelectorAll('.sa-progress-fill').forEach(bar => {
      observer.observe(bar);
    });

    // Barres sustain-progress existantes
    document.querySelectorAll('.sustain-progress span').forEach(bar => {
      const width = bar.style.getPropertyValue('--bar');
      if (width) {
        bar.style.transition = 'width 1.8s cubic-bezier(0.22,1,0.36,1)';
        bar.style.setProperty('--bar', '0%');
        observer.observe(bar);
        bar.dataset.targetWidth = width;
      }
    });
  }

  triggerProgressBarsIn(container) {
    if (!container) return;

    // sa-progress-fill
    container.querySelectorAll('.sa-progress-fill[data-width]:not([data-triggered])').forEach(bar => {
      bar.dataset.triggered = '1';
      requestAnimationFrame(() => {
        bar.style.width = bar.dataset.width;
      });
    });

    // sustain-progress spans
    container.querySelectorAll('.sustain-progress span[data-target-width]:not([data-triggered])').forEach(bar => {
      bar.dataset.triggered = '1';
      requestAnimationFrame(() => {
        bar.style.setProperty('--bar', bar.dataset.targetWidth);
      });
    });
  }

  /* ═══════════════════════════════════════════════════
     5. LISTE ANIMÉE — Items en cascade
  ═══════════════════════════════════════════════════ */

  setupAnimatedLists() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const items = entry.target.querySelectorAll('.sa-animated-list li');
          items.forEach((item, i) => {
            setTimeout(() => item.classList.add('visible'), i * 100);
          });
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.sa-animated-list').forEach(list => observer.observe(list));
  }

  /* ═══════════════════════════════════════════════════
     6. STAT ITEMS — Enhanced
  ═══════════════════════════════════════════════════ */

  setupStatItems() {
    document.querySelectorAll('.stat-item, .sa-hero-metric').forEach(item => {
      item.classList.add('sa-stat-item-enhanced');
    });
  }

  /* ═══════════════════════════════════════════════════
     7. RIPPLE EFFECT — Au clic
  ═══════════════════════════════════════════════════ */

  setupRippleEffect() {
    const rippleTargets = document.querySelectorAll(
      '.sa-pillar-card, .sa-achievement-card, .sa-program-card, .sa-step-card, .sa-partner-card, .sa-btn-animated'
    );

    rippleTargets.forEach(el => {
      el.classList.add('sa-ripple');
      el.addEventListener('click', (e) => {
        const rect = el.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const size = Math.max(rect.width, rect.height) * 2;

        const wave = document.createElement('span');
        wave.className = 'sa-ripple-wave';
        wave.style.cssText = `
          width: ${size}px;
          height: ${size}px;
          left: ${x - size/2}px;
          top: ${y - size/2}px;
        `;

        el.appendChild(wave);
        setTimeout(() => wave.remove(), 700);
      });
    });
  }

  /* ═══════════════════════════════════════════════════
     8. MAGNETIC HOVER — Léger déplacement vers curseur
  ═══════════════════════════════════════════════════ */

  setupMagneticHover() {
    const strength = 0.25;

    document.querySelectorAll('.sa-btn-animated, .sa-pillar-card .btn').forEach(el => {
      el.addEventListener('mousemove', (e) => {
        const rect = el.getBoundingClientRect();
        const cx = rect.left + rect.width / 2;
        const cy = rect.top + rect.height / 2;
        const dx = (e.clientX - cx) * strength;
        const dy = (e.clientY - cy) * strength;
        el.style.transform = `translate(${dx}px, ${dy}px)`;
      });

      el.addEventListener('mouseleave', () => {
        el.style.transform = '';
      });
    });
  }

  /* ═══════════════════════════════════════════════════
     9. MOUSE TRACKING BG — Arrière-plan suit le curseur
  ═══════════════════════════════════════════════════ */

  setupMouseTrackingBg() {
    document.querySelectorAll('.sa-animated-section').forEach(section => {
      section.addEventListener('mousemove', (e) => {
        const rect = section.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        section.style.setProperty('--mouse-x', x + '%');
        section.style.setProperty('--mouse-y', y + '%');
      });
    });

    // Gradient qui suit la souris globalement
    document.addEventListener('mousemove', (e) => {
      this.mouseX = e.clientX;
      this.mouseY = e.clientY;
    });
  }

  /* ═══════════════════════════════════════════════════
     10. 3D TILT CARDS
  ═══════════════════════════════════════════════════ */

  setup3DTiltCards() {
    const intensity = 8; // degrés max

    document.querySelectorAll('.sa-program-card, .sa-achievement-card').forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;

        card.style.transform = `
          perspective(800px)
          rotateX(${-y * intensity}deg)
          rotateY(${x * intensity}deg)
          translateY(-6px)
          scale(1.02)
        `;
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = '';
      });
    });
  }

  /* ═══════════════════════════════════════════════════
     11. PARTICLES — Orbes flottantes
  ═══════════════════════════════════════════════════ */

  setupParticles() {
    document.querySelectorAll('.sa-particles-container').forEach(container => {
      const count = parseInt(container.dataset.count || '8');
      for (let i = 0; i < count; i++) {
        this.createParticle(container);
      }
    });
  }

  createParticle(container) {
    const particle = document.createElement('div');
    particle.className = 'sa-particle';

    const size = Math.random() * 80 + 20;
    const x = Math.random() * 100;
    const delay = Math.random() * 8;
    const duration = Math.random() * 12 + 8;
    const drift = (Math.random() - 0.5) * 80;

    particle.style.cssText = `
      width: ${size}px;
      height: ${size}px;
      left: ${x}%;
      bottom: 0;
      --drift: ${drift}px;
      animation-duration: ${duration}s;
      animation-delay: ${delay}s;
    `;

    container.appendChild(particle);
  }

  /* ═══════════════════════════════════════════════════
     12. TYPEWRITER — Effet machine à écrire
  ═══════════════════════════════════════════════════ */

  setupTypewriter() {
    document.querySelectorAll('[data-typewriter]').forEach(el => {
      const text = el.dataset.typewriter || el.textContent;
      el.textContent = '';
      el.classList.add('sa-typewriter');

      const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
          this.typeText(el, text);
          observer.disconnect();
        }
      }, { threshold: 0.5 });

      observer.observe(el);
    });
  }

  typeText(el, text, index = 0) {
    if (index < text.length) {
      el.textContent += text[index];
      setTimeout(() => this.typeText(el, text, index + 1), 30);
    } else {
      el.classList.remove('sa-typewriter');
    }
  }

  /* ═══════════════════════════════════════════════════
     13. PARALLAX SCROLL — Sur les sections bg
  ═══════════════════════════════════════════════════ */

  setupParallax() {
    const sections = document.querySelectorAll('.sa-parallax-section');
    if (!sections.length) return;

    let ticking = false;

    const update = () => {
      sections.forEach(section => {
        const bg = section.querySelector('.sa-parallax-bg');
        if (!bg) return;
        const rect = section.getBoundingClientRect();
        const progress = (window.innerHeight - rect.top) / (window.innerHeight + rect.height);
        const shift = (progress - 0.5) * 40;
        bg.style.transform = `translateY(${shift}px)`;
      });
      ticking = false;
    };

    window.addEventListener('scroll', () => {
      if (!ticking) {
        requestAnimationFrame(update);
        ticking = true;
      }
    }, { passive: true });
  }
}

/* ═══════════════════════════════════════════════════════════
   BACKGROUND GRADIENTS DYNAMIQUES (changement au défilement)
   — Style TikTok / immersif
═══════════════════════════════════════════════════════════ */

class BackgroundGradientShifter {
  constructor() {
    this.gradients = [
      'linear-gradient(135deg, #f8f3ee 0%, #ece5dc 100%)',
      'linear-gradient(135deg, #fff8e8 0%, #fff4dc 40%, #fef0d2 100%)',
      'linear-gradient(180deg, #f5f0eb 0%, #ede6db 100%)',
      'linear-gradient(135deg, #faf6f0 0%, #f0e8dc 100%)',
    ];
    this.currentGradient = 0;
    this.setupSectionObserver();
  }

  setupSectionObserver() {
    const sections = document.querySelectorAll('main section');
    if (!sections.length) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && entry.intersectionRatio > 0.4) {
          this.shiftBackground(entry.target);
        }
      });
    }, {
      threshold: [0.4],
    });

    sections.forEach(s => observer.observe(s));
  }

  shiftBackground(section) {
    if (section.classList.contains('sand') || section.classList.contains('sa-dark-section')) return;

    this.currentGradient = (this.currentGradient + 1) % this.gradients.length;
    // Légère variation de fond
  }
}

/* ═══════════════════════════════════════════════════════════
   ENHANCED CARD HOVER — Effet de lumière qui suit la souris
═══════════════════════════════════════════════════════════ */

class CardLightEffect {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => this.init());
  }

  init() {
    const cards = document.querySelectorAll('.card, .sa-pillar-card, .sa-achievement-card, .sa-program-card, .sa-step-card, .community-achievement, .sa-partner-card');

    cards.forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        card.style.background = `
          radial-gradient(circle at ${x}% ${y}%, rgba(255,194,71,0.06) 0%, transparent 60%),
          rgba(255,255,255,0.88)
        `;
      });

      card.addEventListener('mouseleave', () => {
        card.style.background = '';
      });
    });
  }
}

/* ═══════════════════════════════════════════════════════════
   SMOOTH SECTION TRANSITIONS — Fade between sections
═══════════════════════════════════════════════════════════ */

class SectionTransitions {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => this.init());
  }

  init() {
    const sections = document.querySelectorAll('main section');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.05 });

    sections.forEach((section, i) => {
      if (!section.style.opacity) {
        section.style.transition = `opacity 0.7s ease ${i * 0.05}s, transform 0.7s ease ${i * 0.05}s`;
      }
      observer.observe(section);
    });
  }
}

/* ═══════════════════════════════════════════════════════════
   CLIC ANIMATION — Total banner
═══════════════════════════════════════════════════════════ */

class BannerClickEffect {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => {
      const banner = document.querySelector('.sa-total-banner');
      if (!banner) return;

      banner.addEventListener('click', () => {
        banner.style.animation = 'none';
        banner.offsetHeight; // reflow
        banner.style.animation = '';

        // Flash doré
        const flash = document.createElement('div');
        flash.style.cssText = `
          position: absolute;
          inset: 0;
          background: rgba(255,194,71,0.2);
          border-radius: 20px;
          animation: sa-ripple-anim 0.8s ease forwards;
          pointer-events: none;
        `;
        banner.style.position = 'relative';
        banner.appendChild(flash);
        setTimeout(() => flash.remove(), 800);
      });
    });
  }
}

/* ═══════════════════════════════════════════════════════════
   INITIALISATION GLOBALE
═══════════════════════════════════════════════════════════ */

// Démarrer sur tout le site
(function() {
  const animator = new SustainabilityAnimator();
  const bgShifter = new BackgroundGradientShifter();
  const bannerFx = new BannerClickEffect();

  // CardLightEffect et SectionTransitions sur tout le site
  const cardLight = new CardLightEffect();
  const sectionTransitions = new SectionTransitions();

  document.addEventListener('DOMContentLoaded', () => {
    // Ajouter sa-reveal à tous les éléments sr existants sur tout le site
    document.querySelectorAll('.sr:not(.sa-reveal)').forEach(el => {
      el.classList.add('sa-reveal');
    });

    // Améliorer les achievement cards existantes
    document.querySelectorAll('.community-achievement').forEach(card => {
      card.classList.add('sa-glow-hover', 'sa-ripple');
    });

    // Améliorer les pillar cards existantes
    document.querySelectorAll('.pillar-card').forEach(card => {
      card.classList.add('sa-pillar-card');
    });

    // Améliorer les stat-items
    document.querySelectorAll('.stat-item').forEach(item => {
      item.classList.add('sa-stat-item-enhanced');
    });

    // Ajouter des classes reveal en cascade aux grilles
    document.querySelectorAll('.grid-2 > *, .grid-3 > *, .projects-grid > *').forEach((el, i) => {
      if (!el.classList.contains('sa-reveal')) {
        el.classList.add('sa-reveal', `sa-delay-${Math.min(i + 1, 7)}`);
      }
    });

    // Observer pour les sr existants
    const srObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible', 'is-visible');
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

    document.querySelectorAll('.sa-reveal, .sa-reveal-left, .sa-reveal-right, .sa-reveal-scale').forEach(el => {
      srObserver.observe(el);
    });
  });
})();
