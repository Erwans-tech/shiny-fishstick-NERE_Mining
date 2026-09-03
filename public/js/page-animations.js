/**
 * 🎭 ANIMATIONS SPÉCIFIQUES PAR PAGE
 * Animations contextuelles et interactives avancées
 */

class PageAnimationController {
  constructor() {
    this.currentPage = this.detectCurrentPage();
    this.animationsEnabled = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    this.init();
  }

  init() {
    if (!this.animationsEnabled) return;

    this.setupPageSpecificAnimations();
    this.setupAdvancedInteractions();
    this.setupScrollAnimations();
    this.setupPerformanceOptimizations();
  }

  detectCurrentPage() {
    const path = window.location.pathname;
    if (path === '/' || path === '/en') return 'home';
    if (path.includes('company')) return 'company';
    if (path.includes('sustainability')) return 'sustainability';
    if (path.includes('news')) return 'news';
    if (path.includes('careers')) return 'careers';
    if (path.includes('reports')) return 'reports';
    return 'generic';
  }

  /**
   * 🏠 ANIMATIONS PAGE D'ACCUEIL
   */
  setupHomeAnimations() {
    // Animation parallaxe du hero
    this.setupHeroParallax();
    
    // Animation des statistiques avec compteur
    this.setupStatCounters();
    
    // Animation du carrousel hero
    this.setupHeroCarousel();
    
    // Animation des tuiles de stats au hover
    this.setupStatTiles();
  }

  setupHeroParallax() {
    const hero = document.querySelector('.hero');
    if (!hero) return;

    let ticking = false;
    
    const updateParallax = () => {
      const scrollY = window.pageYOffset;
      const rate = scrollY * -0.5;
      
      hero.style.transform = `translateY(${rate}px)`;
      ticking = false;
    };

    const requestParallax = () => {
      if (!ticking) {
        requestAnimationFrame(updateParallax);
        ticking = true;
      }
    };

    window.addEventListener('scroll', requestParallax, { passive: true });
  }

  setupStatCounters() {
    const statValues = document.querySelectorAll('.hero-stat .stat-value, .stat-band .stat-value');

    const resolveNumericValue = (element) => {
      const rawValue = element.dataset.count || element.textContent || '';
      const digits = element.dataset.count
        ? Number.parseFloat(rawValue)
        : Number.parseFloat(rawValue.toString().replace(/[^\d.]/g, ''));

      if (Number.isNaN(digits)) {
        return null;
      }

      const parsed = digits;
      return Number.isNaN(parsed) ? null : parsed;
    };
    
    const animateValue = (element, start, end, duration) => {
      const startTime = performance.now();
      const suffix = element.dataset.suffix || '';
      const prefix = element.dataset.prefix || '';
      
      const animate = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function (ease-out)
        const easedProgress = 1 - Math.pow(1 - progress, 3);
        
        const currentValue = start + (end - start) * easedProgress;
        element.textContent = prefix + currentValue.toLocaleString(undefined, { maximumFractionDigits: 1 }) + suffix;
        
        if (progress < 1) {
          requestAnimationFrame(animate);
        }
      };
      
      requestAnimationFrame(animate);
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const element = entry.target;
          const endValue = resolveNumericValue(element);

          if (endValue === null) {
            observer.unobserve(element);
            return;
          }

          const duration = parseInt(element.dataset.duration || '2000', 10);
          
          setTimeout(() => {
            animateValue(element, 0, endValue, duration);
          }, 200);
          
          observer.unobserve(element);
        }
      });
    }, { threshold: 0.5 });

    statValues.forEach(stat => observer.observe(stat));
  }

  setupStatTiles() {
    document.querySelectorAll('.hero-stat').forEach((tile, index) => {
      // Animation d'entrée échelonnée
      tile.style.animationDelay = `${1.4 + (index * 0.1)}s`;
      
      // Effet de particules au hover
      tile.addEventListener('mouseenter', () => {
        this.createFloatingParticles(tile, 3);
      });

      // Animation de pulsation sur clic
      tile.addEventListener('click', () => {
        tile.style.animation = 'none';
        tile.offsetHeight; // Force reflow
        tile.style.animation = 'statPulse 0.6s ease-out';
      });
    });

    // Ajouter les keyframes pour l'animation de pulsation
    this.injectCSS(`
      @keyframes statPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
      }
    `);
  }

  /**
   * 🏢 ANIMATIONS PAGE ENTREPRISE
   */
  setupCompanyAnimations() {
    // Animation de l'organigramme
    this.setupOrgChart();
    
    // Animation des valeurs avec effet de révélation
    this.setupValuesAnimation();
    
    // Animation du PDG avec effet typing
    this.setupPDGQuote();
  }

  setupOrgChart() {
    const orgBoxes = document.querySelectorAll('.org-box');
    const connectors = document.querySelectorAll('.org-connector-v, .org-connector-branch, .org-hbar');
    
    // Animation séquentielle des boîtes
    orgBoxes.forEach((box, index) => {
      box.style.opacity = '0';
      box.style.transform = 'translateY(30px) scale(0.9)';
      
      setTimeout(() => {
        box.style.transition = 'all 0.8s cubic-bezier(0.22, 1, 0.36, 1)';
        box.style.opacity = '1';
        box.style.transform = 'translateY(0) scale(1)';
      }, index * 200);
    });

    // Animation des connecteurs après les boîtes
    setTimeout(() => {
      connectors.forEach((connector, index) => {
        connector.style.opacity = '0';
        connector.style.transform = 'scaleY(0)';
        
        setTimeout(() => {
          connector.style.transition = 'all 0.6s ease-out';
          connector.style.opacity = '1';
          connector.style.transform = 'scaleY(1)';
        }, index * 100);
      });
    }, orgBoxes.length * 200);
  }

  setupValuesAnimation() {
    const valueCards = document.querySelectorAll('.values-card');
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('animate-in');
            
            // Ajouter un effet de brillance
            this.addShimmerEffect(entry.target);
          }, index * 150);
        }
      });
    }, { threshold: 0.3 });

    valueCards.forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(50px) rotateX(10deg)';
      observer.observe(card);
    });

    this.injectCSS(`
      .values-card.animate-in {
        opacity: 1 !important;
        transform: translateY(0) rotateX(0deg) !important;
        transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
      }
    `);
  }

  /**
   * 🌱 ANIMATIONS PAGE DURABILITÉ
   */
  setupSustainabilityAnimations() {
    // Animation des étapes du processus
    this.setupProcessSteps();
    
    // Animation des barres de progression environnementales
    this.setupEnvironmentalProgress();
  }

  setupProcessSteps() {
    const steps = document.querySelectorAll('.step');
    
    steps.forEach((step, index) => {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              entry.target.classList.add('step-animate');
              
              // Animation de la flèche
              const arrow = entry.target.querySelector('::after');
              if (index < steps.length - 1) {
                this.animateStepArrow(entry.target);
              }
            }, index * 200);
          }
        });
      }, { threshold: 0.5 });

      observer.observe(step);
    });

    this.injectCSS(`
      .step {
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
      }
      .step.step-animate {
        opacity: 1;
        transform: translateX(0);
      }
    `);
  }

  /**
   * 📰 ANIMATIONS PAGE ACTUALITÉS
   */
  setupNewsAnimations() {
    // Animation en mosaïque des cartes d'actualités
    this.setupNewsGrid();
    
    // Animation des filtres
    this.setupNewsFilters();
  }

  setupNewsGrid() {
    const newsCards = document.querySelectorAll('.news-card, .card');
    
    // Animation en vague
    newsCards.forEach((card, index) => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(40px) scale(0.95)';
      
      const delay = Math.floor(index / 3) * 100 + (index % 3) * 50;
      
      setTimeout(() => {
        card.style.transition = 'all 0.8s cubic-bezier(0.22, 1, 0.36, 1)';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0) scale(1)';
      }, delay);
    });
  }

  /**
   * 🎯 ANIMATIONS GÉNÉRIQUES
   */
  setupPageSpecificAnimations() {
    switch (this.currentPage) {
      case 'home':
        this.setupHomeAnimations();
        break;
      case 'company':
        this.setupCompanyAnimations();
        break;
      case 'sustainability':
        this.setupSustainabilityAnimations();
        break;
      case 'news':
        this.setupNewsAnimations();
        break;
    }
  }

  /**
   * 🎭 INTERACTIONS AVANCÉES
   */
  setupAdvancedInteractions() {
    // Effet de suivi du curseur
    this.setupCursorFollower();
    
    // Animation des liens avec effet elastic
    this.setupElasticLinks();
    
    // Animation des images au scroll
    this.setupImageReveal();
  }

  setupElasticLinks() {
    // Effet elastic désactivé volontairement pour rester lisible et stable.
    return;
  }

  setupImageReveal() {
    // Révélation des images désactivée pour éviter l'effet visuel perturbant.
    return;
  }

  setupCursorFollower() {
    // Curseur personnalisé désactivé pour améliorer l'UX
    if (window.innerWidth < 1024) return; // Désactiver sur mobile
    return; // DÉSACTIVÉ: effet de curseur personnalisé retiré pour une meilleure UX
    
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.style.cssText = `
      position: fixed;
      width: 20px;
      height: 20px;
      background: radial-gradient(circle, rgba(255,194,71,0.6) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
      z-index: 9999;
      transition: transform 0.1s ease;
      mix-blend-mode: screen;
    `;
    document.body.appendChild(cursor);

    let mouseX = 0, mouseY = 0;
    let cursorX = 0, cursorY = 0;

    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    const animateCursor = () => {
      cursorX += (mouseX - cursorX) * 0.1;
      cursorY += (mouseY - cursorY) * 0.1;
      
      cursor.style.left = cursorX - 10 + 'px';
      cursor.style.top = cursorY - 10 + 'px';
      
      requestAnimationFrame(animateCursor);
    };
    
    animateCursor();

    // Agrandir sur les éléments interactifs
    document.querySelectorAll('a, button, .card').forEach(el => {
      el.addEventListener('mouseenter', () => {
        cursor.style.transform = 'scale(2)';
        cursor.style.background = 'radial-gradient(circle, rgba(255,194,71,0.8) 0%, transparent 70%)';
      });
      
      el.addEventListener('mouseleave', () => {
        cursor.style.transform = 'scale(1)';
        cursor.style.background = 'radial-gradient(circle, rgba(255,194,71,0.6) 0%, transparent 70%)';
      });
    });
  }

  setupScrollAnimations() {
    // Animation de la barre de progression du scroll
    this.setupScrollProgress();
    
    // Animation des sections au scroll
    this.setupSectionReveal();
  }

  setupScrollProgress() {
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      width: 0%;
      height: 3px;
      background: linear-gradient(90deg, var(--gold), var(--red));
      z-index: 9999;
      transition: width 0.1s ease;
    `;
    document.body.prepend(progressBar);

    window.addEventListener('scroll', () => {
      const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
      progressBar.style.width = scrollPercent + '%';
    }, { passive: true });
  }

  /**
   * 🛠️ UTILITAIRES
   */
  createFloatingParticles(container, count) {
    for (let i = 0; i < count; i++) {
      const particle = document.createElement('div');
      particle.style.cssText = `
        position: absolute;
        width: 4px;
        height: 4px;
        background: var(--gold);
        border-radius: 50%;
        pointer-events: none;
        top: 50%;
        left: 50%;
        opacity: 0.8;
        animation: floatUp 1.5s ease-out forwards;
      `;
      
      const randomX = (Math.random() - 0.5) * 100;
      const randomDelay = Math.random() * 0.5;
      
      particle.style.animationDelay = randomDelay + 's';
      particle.style.setProperty('--random-x', randomX + 'px');
      
      container.style.position = 'relative';
      container.appendChild(particle);

      setTimeout(() => {
        particle.remove();
      }, 2000);
    }

    this.injectCSS(`
      @keyframes floatUp {
        0% {
          transform: translate(-50%, -50%);
          opacity: 0.8;
        }
        100% {
          transform: translate(calc(-50% + var(--random-x)), -100px);
          opacity: 0;
        }
      }
    `);
  }

  addShimmerEffect(element) {
    element.style.position = 'relative';
    element.style.overflow = 'hidden';
    
    const shimmer = document.createElement('div');
    shimmer.style.cssText = `
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%);
      animation: shimmerMove 1.5s ease-in-out;
    `;
    
    element.appendChild(shimmer);
    
    setTimeout(() => {
      shimmer.remove();
    }, 1500);

    this.injectCSS(`
      @keyframes shimmerMove {
        0% { left: -100%; }
        100% { left: 100%; }
      }
    `);
  }

  injectCSS(css) {
    if (!this.styleSheet) {
      this.styleSheet = document.createElement('style');
      document.head.appendChild(this.styleSheet);
    }
    this.styleSheet.sheet.insertRule(css, this.styleSheet.sheet.cssRules.length);
  }

  setupPerformanceOptimizations() {
    // Intersection Observer pour les animations coûteuses
    const expensiveElements = document.querySelectorAll('.card-3d, .particle, .shimmer');
    
    const performanceObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-active');
        } else {
          entry.target.classList.remove('animate-active');
        }
      });
    }, { rootMargin: '100px' });

    expensiveElements.forEach(el => performanceObserver.observe(el));
  }
}

// Initialisation automatique
document.addEventListener('DOMContentLoaded', () => {
  new PageAnimationController();
});

// Export pour utilisation manuelle
window.PageAnimations = PageAnimationController;