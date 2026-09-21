/**
 * ALBUM CAROUSEL FUNCTIONALITY
 * Auto-sliding carousel for album preview images
 */

(function() {
    'use strict';

    // ========================================
    // CONFIGURATION
    // ========================================
    
    const SLIDE_INTERVAL = 3000; // 3 secondes entre chaque slide
    const TRANSITION_DURATION = 800; // Durée de la transition (doit correspondre au CSS)

    // ========================================
    // ALBUM CAROUSEL CLASS
    // ========================================
    
    class AlbumCarousel {
        constructor(element) {
            this.container = element;
            this.slides = Array.from(element.querySelectorAll('.album-carousel-slide'));
            this.dots = Array.from(element.querySelectorAll('.album-carousel-dots .dot'));
            this.currentIndex = 0;
            this.isPlaying = true;
            this.intervalId = null;
            this.isHovered = false;

            if (this.slides.length <= 1) {
                // Pas besoin de carousel s'il y a une seule image ou moins
                return;
            }

            this.init();
        }

        init() {
            // Initialiser le premier slide
            this.showSlide(0);

            // Démarrer le carousel automatique
            this.startAutoPlay();

            // Event listeners
            this.attachEventListeners();

            // Observer pour pause quand hors de vue
            this.setupIntersectionObserver();
        }

        attachEventListeners() {
            // Pause on hover
            this.container.addEventListener('mouseenter', () => {
                this.isHovered = true;
                this.stopAutoPlay();
            });

            this.container.addEventListener('mouseleave', () => {
                this.isHovered = false;
                if (!this.isPaused()) {
                    this.startAutoPlay();
                }
            });

            // Dots navigation
            this.dots.forEach((dot, index) => {
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation(); // Empêcher le clic de se propager à la carte
                    this.showSlide(index);
                    this.resetAutoPlay();
                });

                // Accessibilité clavier
                dot.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.showSlide(index);
                        this.resetAutoPlay();
                    }
                });
            });

            // Touch swipe support
            this.setupTouchEvents();
        }

        setupTouchEvents() {
            let touchStartX = 0;
            let touchEndX = 0;

            this.container.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            this.container.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe(touchStartX, touchEndX);
            }, { passive: true });
        }

        handleSwipe(startX, endX) {
            const threshold = 50; // Minimum swipe distance
            const diff = startX - endX;

            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    // Swipe left - next slide
                    this.next();
                } else {
                    // Swipe right - previous slide
                    this.prev();
                }
                this.resetAutoPlay();
            }
        }

        setupIntersectionObserver() {
            // Pause le carousel quand il n'est pas visible à l'écran
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (!this.isHovered && !this.isPaused()) {
                            this.startAutoPlay();
                        }
                    } else {
                        this.stopAutoPlay();
                    }
                });
            }, {
                threshold: 0.5 // 50% visible
            });

            observer.observe(this.container);
        }

        showSlide(index) {
            // Validation de l'index
            if (index < 0 || index >= this.slides.length) {
                return;
            }

            // Retirer la classe active de tous les slides
            this.slides.forEach(slide => slide.classList.remove('active'));
            this.dots.forEach(dot => dot.classList.remove('active'));

            // Activer le slide et le dot correspondants
            this.slides[index].classList.add('active');
            if (this.dots[index]) {
                this.dots[index].classList.add('active');
            }

            this.currentIndex = index;

            // Lazy load de l'image si nécessaire
            this.lazyLoadImage(this.slides[index]);
        }

        lazyLoadImage(slide) {
            const img = slide.querySelector('img');
            if (img && img.dataset.src && !img.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        }

        next() {
            const nextIndex = (this.currentIndex + 1) % this.slides.length;
            this.showSlide(nextIndex);
        }

        prev() {
            const prevIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
            this.showSlide(prevIndex);
        }

        startAutoPlay() {
            if (this.intervalId) {
                return; // Déjà en cours
            }

            this.intervalId = setInterval(() => {
                this.next();
            }, SLIDE_INTERVAL);

            this.isPlaying = true;
        }

        stopAutoPlay() {
            if (this.intervalId) {
                clearInterval(this.intervalId);
                this.intervalId = null;
            }
            this.isPlaying = false;
        }

        resetAutoPlay() {
            this.stopAutoPlay();
            if (!this.isHovered && !this.isPaused()) {
                this.startAutoPlay();
            }
        }

        isPaused() {
            // Vérifie si le document n'est pas visible (onglet en arrière-plan)
            return document.hidden;
        }

        destroy() {
            this.stopAutoPlay();
            // Nettoyer les event listeners si nécessaire
        }
    }

    // ========================================
    // INITIALIZATION
    // ========================================
    
    function initAlbumCarousels() {
        const carousels = document.querySelectorAll('.album-carousel');
        const instances = [];

        carousels.forEach(carousel => {
            try {
                const instance = new AlbumCarousel(carousel);
                instances.push(instance);
            } catch (error) {
                console.error('Error initializing album carousel:', error);
            }
        });

        console.log(`✓ Initialized ${instances.length} album carousel(s)`);

        return instances;
    }

    // ========================================
    // PAGE VISIBILITY API
    // ========================================
    
    function handleVisibilityChange() {
        const carousels = document.querySelectorAll('.album-carousel');
        
        carousels.forEach(carousel => {
            if (document.hidden) {
                // Pause tous les carousels quand l'onglet est en arrière-plan
                carousel.carouselInstance?.stopAutoPlay();
            } else {
                // Reprendre quand l'onglet redevient visible
                carousel.carouselInstance?.startAutoPlay();
            }
        });
    }

    document.addEventListener('visibilitychange', handleVisibilityChange);

    // ========================================
    // AUTO-INIT ON DOM READY
    // ========================================
    
    function init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }

        // Initialiser les carousels
        const instances = initAlbumCarousels();

        // Stocker les instances sur les éléments pour référence
        document.querySelectorAll('.album-carousel').forEach((carousel, index) => {
            if (instances[index]) {
                carousel.carouselInstance = instances[index];
            }
        });
    }

    // Lancer l'initialisation
    init();

    // ========================================
    // EXPORT POUR USAGE EXTERNE (optionnel)
    // ========================================
    
    window.AlbumCarousel = AlbumCarousel;
    window.initAlbumCarousels = initAlbumCarousels;

})();

/**
 * LIGHTBOX ENHANCEMENTS
 * Améliorations pour le lightbox (déjà dans album.blade.php mais on peut ajouter des extras)
 */

(function() {
    'use strict';

    // ========================================
    // LIGHTBOX PRELOADER
    // ========================================
    
    function preloadNextImages(currentIndex, photos) {
        // Précharger l'image suivante et précédente pour une transition fluide
        const preloadIndices = [
            (currentIndex + 1) % photos.length,
            (currentIndex - 1 + photos.length) % photos.length
        ];

        preloadIndices.forEach(index => {
            const photo = photos[index];
            if (photo) {
                const img = new Image();
                img.src = photo.dataset.imgSrc;
            }
        });
    }

    // ========================================
    // LIGHTBOX ZOOM
    // ========================================
    
    function addZoomFunctionality() {
        const lightboxImg = document.getElementById('lightbox-img');
        if (!lightboxImg) return;

        let isZoomed = false;
        let scale = 1;

        lightboxImg.addEventListener('click', (e) => {
            e.stopPropagation();
            
            if (!isZoomed) {
                // Zoom in
                scale = 2;
                lightboxImg.style.transform = `scale(${scale})`;
                lightboxImg.style.cursor = 'zoom-out';
                isZoomed = true;
            } else {
                // Zoom out
                scale = 1;
                lightboxImg.style.transform = 'scale(1)';
                lightboxImg.style.cursor = 'zoom-in';
                isZoomed = false;
            }
        });

        // Reset zoom on lightbox close
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.attributeName === 'class') {
                        if (!lightbox.classList.contains('active')) {
                            scale = 1;
                            isZoomed = false;
                            lightboxImg.style.transform = 'scale(1)';
                            lightboxImg.style.cursor = 'zoom-in';
                        }
                    }
                });
            });

            observer.observe(lightbox, { attributes: true });
        }
    }

    // ========================================
    // INIT LIGHTBOX ENHANCEMENTS
    // ========================================
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', addZoomFunctionality);
    } else {
        addZoomFunctionality();
    }

})();

/**
 * ACCESSIBILITY ENHANCEMENTS
 */

(function() {
    'use strict';

    function enhanceAccessibility() {
        // Ajouter des attributs ARIA aux dots
        document.querySelectorAll('.album-carousel-dots .dot').forEach((dot, index) => {
            dot.setAttribute('role', 'button');
            dot.setAttribute('aria-label', `Slide ${index + 1}`);
            dot.setAttribute('tabindex', '0');
        });

        // Ajouter des labels aux boutons lightbox si manquants
        const lightboxPrev = document.getElementById('lightbox-prev');
        const lightboxNext = document.getElementById('lightbox-next');
        const lightboxClose = document.getElementById('lightbox-close');

        if (lightboxPrev && !lightboxPrev.getAttribute('aria-label')) {
            lightboxPrev.setAttribute('aria-label', 'Photo précédente');
        }
        if (lightboxNext && !lightboxNext.getAttribute('aria-label')) {
            lightboxNext.setAttribute('aria-label', 'Photo suivante');
        }
        if (lightboxClose && !lightboxClose.getAttribute('aria-label')) {
            lightboxClose.setAttribute('aria-label', 'Fermer');
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', enhanceAccessibility);
    } else {
        enhanceAccessibility();
    }

})();


// ══════════════════════════════════════════════════════════════
// MINI CAROUSEL POUR ALBUM DANS GRILLE NEWS
// ══════════════════════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', function() {
    // Initialiser tous les mini carousels dans la grille news
    const miniCarousels = document.querySelectorAll('.album-carousel-mini');
    
    miniCarousels.forEach(carousel => {
        const slides = carousel.querySelectorAll('.album-carousel-slide');
        const dots = carousel.querySelectorAll('.dot');
        
        if (slides.length <= 1) return; // Pas de carousel si une seule image
        
        let currentSlide = 0;
        let autoplayInterval;
        let isHovered = false;
        
        function showSlide(index) {
            // Retirer active de tous
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            // Ajouter active au slide courant
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        
        function startAutoplay() {
            if (autoplayInterval) clearInterval(autoplayInterval);
            autoplayInterval = setInterval(() => {
                if (!isHovered) {
                    nextSlide();
                }
            }, 3000);
        }
        
        function stopAutoplay() {
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
                autoplayInterval = null;
            }
        }
        
        // Navigation par dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                currentSlide = index;
                showSlide(currentSlide);
                stopAutoplay();
                setTimeout(startAutoplay, 5000); // Redémarre après 5s
            });
        });
        
        // Pause au survol
        carousel.addEventListener('mouseenter', () => {
            isHovered = true;
        });
        
        carousel.addEventListener('mouseleave', () => {
            isHovered = false;
        });
        
        // Observer pour démarrer seulement quand visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startAutoplay();
                } else {
                    stopAutoplay();
                }
            });
        }, { threshold: 0.3 });
        
        observer.observe(carousel);
    });
});
