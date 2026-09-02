/**
 * 🎬 ANIMATIONS INTERACTIVES NÉRÉ MINING
 * Gestion avancée des animations UI/UX
 */

class AnimationManager {
  constructor() {
    this.observers = new Map();
    this.counters = new Map();
    this.init();
  }

  init() {
    // Attendre que le DOM soit prêt
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => this.initAnimations());
    } else {
      this.initAnimations();
    }
  }

  initAnimations() {
    this.setupScrollReveal();
    this.setupCounterAnimations();
    this.setupProgressBars();
    this.setupMagneticButtons();
    this.setupParticles();
    this.setupRippleEffects();
    this.setupCardFlipEffects();
    this.setupHoverAnimations();
  }

  /**
   * 📜 SCROLL REVEAL AMÉLIORÉ
   */
  setupScrollReveal() {
    // Configuration de l'observateur intersection
    const observerOptions = {
      root: null,
      rootMargin: '0px 0px -50px 0px',
      threshold: 0.1
    };

    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          // Déclencher l'animation des compteurs si c'est une stat
          if (entry.target.classList.contains('stat-value')) {
            this.animateCounter(entry.target);
          }
          // Déclencher l'animation des barres de progression
          if (entry.target.classList.contains('progress-bar')) {
            entry.target.classList.add('animate');
          }
          // Animation en cascade pour les grilles
          if (entry.target.classList.contains('cascade-animation')) {
            entry.target.classList.add('in-view');
          }
        }
      });
    }, observerOptions);

    // Observer tous les éléments avec classes d'animation
    const elementsToReveal = document.querySelectorAll(`
      .sr, .sr-fade-up, .sr-fade-left, .sr-fade-right, 
      .sr-scale, .sr-rotate, .stat-value, .progress-bar,
      .cascade-animation
    `);
    
    elementsToReveal.forEach(el => revealObserver.observe(el));
    this.observers.set('reveal', revealObserver);
  }

  /**
   * 🔢 ANIMATION DES COMPTEURS
   */
  animateCounter(element) {
    if (this.counters.has(element)) return; // Déjà animé

    const target = parseInt(element.getAttribute('data-count') || element.textContent.replace(/[^\d]/g, ''));
    const duration = parseInt(element.getAttribute('data-duration') || '2000');
    const suffix = element.getAttribute('data-suffix') || '';
    const prefix = element.getAttribute('data-prefix') || '';

    let start = 0;
    const increment = target / (duration / 16); // 60fps
    
    const counter = () => {
      start += increment;
      if (start < target) {
        element.textContent = prefix + Math.floor(start).toLocaleString() + suffix;
        requestAnimationFrame(counter);
      } else {
        element.textContent = prefix + target.toLocaleString() + suffix;
      }
    };

    this.counters.set(element, true);
    counter();
  }

  /**
   * 📊 BARRES DE PROGRESSION
   */
  setupProgressBars() {
    document.querySelectorAll('.progress-bar').forEach(bar => {
      const fill = bar.querySelector('.progress-fill');
      if (fill) {
        const percentage = bar.getAttribute('data-percentage') || '100';
        fill.style.setProperty('--progress', `${percentage}%`);
      }
    });
  }

  /**
   * 🧲 BOUTONS MAGNÉTIQUES
   */
  setupMagneticButtons() {
    // Effet magnétique désactivé pour une meilleure UX
    return; // DÉSACTIVÉ: effets magnétiques retirés
    
    document.querySelectorAll('.magnetic').forEach(button => {
      button.addEventListener('mousemove', (e) => {
        const rect = button.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width - 0.5) * 20;
        const y = ((e.clientY - rect.top) / rect.height - 0.5) * 20;
        
        button.style.transform = `translate(${x}px, ${y}px) scale(1.05)`;
      });

      button.addEventListener('mouseleave', () => {
        button.style.transform = 'translate(0px, 0px) scale(1)';
      });
    });
  }

  /**
   * ✨ SYSTÈME DE PARTICULES
   */
  setupParticles() {
    document.querySelectorAll('.particles').forEach(container => {
      this.createParticles(container, 4);
    });
  }

  createParticles(container, count) {
    for (let i = 0; i < count; i++) {
      const particle = document.createElement('div');
      particle.className = 'particle';
      particle.style.left = Math.random() * 100 + '%';
      particle.style.animationDelay = Math.random() * 20 + 's';
      particle.style.animationDuration = (18 + Math.random() * 10) + 's';
      container.appendChild(particle);
    }
  }

  /**
   * 🌊 EFFET RIPPLE
   */
  setupRippleEffects() {
    document.querySelectorAll('.ripple').forEach(element => {
      element.addEventListener('click', (e) => {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
          position: absolute;
          width: ${size}px;
          height: ${size}px;
          left: ${x}px;
          top: ${y}px;
          background: rgba(255,194,71,0.3);
          border-radius: 50%;
          transform: scale(0);
          animation: rippleEffect 0.6s ease-out;
          pointer-events: none;
          z-index: 1;
        `;
        
        element.style.position = 'relative';
        element.appendChild(ripple);
        
        setTimeout(() => {
          ripple.remove();
        }, 600);
      });
    });

    // Ajouter les keyframes CSS pour l'effet ripple
    const style = document.createElement('style');
    style.textContent = `
      @keyframes rippleEffect {
        to {
          transform: scale(2);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
  }

  /**
   * 🃏 ANIMATION FLIP DES CARTES
   */
  setupCardFlipEffects() {
    document.querySelectorAll('.card-flip').forEach(card => {
      let flipped = false;
      
      card.addEventListener('click', () => {
        flipped = !flipped;
        card.style.transform = flipped ? 'rotateY(180deg)' : 'rotateY(0deg)';
      });
    });
  }

  /**
   * 🎯 ANIMATIONS HOVER AVANCÉES
   */
  setupHoverAnimations() {
    // Animation des bordures brillantes
    document.querySelectorAll('.border-glow').forEach(element => {
      element.addEventListener('mouseenter', () => {
        element.style.setProperty('--glow-opacity', '1');
      });
      
      element.addEventListener('mouseleave', () => {
        element.style.setProperty('--glow-opacity', '0');
      });
    });

    // Animation des cartes 3D
    document.querySelectorAll('.card-3d').forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width - 0.5) * 10;
        const y = ((e.clientY - rect.top) / rect.height - 0.5) * -10;
        
        card.style.transform = `
          translateY(-8px) 
          rotateX(${y}deg) 
          rotateY(${x}deg)
        `;
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
      });
    });
  }

  /**
   * 🔄 ANIMATION DE CHARGEMENT POUR LES BOUTONS
   */
  setupLoadingButtons() {
    document.querySelectorAll('.btn-loading').forEach(button => {
      button.addEventListener('click', (e) => {
        if (button.classList.contains('loading')) return;
        
        button.classList.add('loading');
        
        // Simuler une action async
        setTimeout(() => {
          button.classList.remove('loading');
        }, 2000);
      });
    });
  }

  /**
   * 🎨 ANIMATION DU BACKGROUND DE LA MASTHEAD
   */
  animateMastheadBackground() {
    const masthead = document.querySelector('.masthead');
    if (!masthead) return;

    let mouseX = 0;
    let mouseY = 0;
    let currentX = 0;
    let currentY = 0;

    masthead.addEventListener('mousemove', (e) => {
      const rect = masthead.getBoundingClientRect();
      mouseX = ((e.clientX - rect.left) / rect.width - 0.5) * 30;
      mouseY = ((e.clientY - rect.top) / rect.height - 0.5) * 30;
    });

    const animate = () => {
      currentX += (mouseX - currentX) * 0.1;
      currentY += (mouseY - currentY) * 0.1;
      
      masthead.style.backgroundPosition = `
        ${50 + currentX * 0.5}% ${50 + currentY * 0.5}%
      `;
      
      requestAnimationFrame(animate);
    };
    
    animate();
  }

  /**
   * 📱 DÉTECTION DE LA PERFORMANCE POUR MOBILE
   */
  detectPerformance() {
    // Désactiver certaines animations sur les appareils lents
    const isLowPerformance = (
      /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
      navigator.hardwareConcurrency < 4 ||
      navigator.deviceMemory < 4
    );

    if (isLowPerformance) {
      document.documentElement.classList.add('low-performance');
      
      // Désactiver les particules sur mobile
      document.querySelectorAll('.particles').forEach(el => {
        el.style.display = 'none';
      });
    }
  }

  /**
   * 🧹 NETTOYAGE DES OBSERVERS
   */
  destroy() {
    this.observers.forEach(observer => observer.disconnect());
    this.observers.clear();
    this.counters.clear();
  }
}

// Initialisation automatique
const animationManager = new AnimationManager();

// Fonctions utilitaires globales
window.AnimationUtils = {
  // Animer manuellement un élément
  reveal: (selector) => {
    document.querySelectorAll(selector).forEach(el => {
      el.classList.add('is-visible');
    });
  },

  // Déclencher l'animation d'un compteur
  animateCounter: (element) => {
    animationManager.animateCounter(element);
  },

  // Ajouter un effet de pulsation temporaire
  pulse: (element) => {
    element.classList.add('card-pulse');
    setTimeout(() => {
      element.classList.remove('card-pulse');
    }, 3000);
  },

  // Smooth scroll vers un élément
  scrollTo: (selector, offset = 0) => {
    const element = document.querySelector(selector);
    if (element) {
      const top = element.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({
        top: top,
        behavior: 'smooth'
      });
    }
  }
};

// Nettoyage à la fermeture de la page
window.addEventListener('beforeunload', () => {
  animationManager.destroy();
});