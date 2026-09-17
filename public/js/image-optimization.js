/**
 * IMAGE OPTIMIZATION & LAZY LOADING
 * Optimise le chargement des images pour de meilleures performances
 */

(function() {
    'use strict';

    // ========================================
    // INTERSECTION OBSERVER LAZY LOADING
    // ========================================
    
    function initLazyLoading() {
        // Vérifier le support de IntersectionObserver
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        
                        // Charger l'image
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                        }
                        
                        if (img.dataset.srcset) {
                            img.srcset = img.dataset.srcset;
                        }
                        
                        // Marquer comme chargée quand l'image est prête
                        img.addEventListener('load', () => {
                            img.classList.add('loaded');
                        });
                        
                        // En cas d'erreur, marquer quand même comme chargée
                        img.addEventListener('error', () => {
                            img.classList.add('loaded');
                            console.warn('Image load error:', img.src);
                        });
                        
                        // Arrêter d'observer cette image
                        observer.unobserve(img);
                    }
                });
            }, {
                // Commencer à charger 200px avant que l'image soit visible
                rootMargin: '200px 0px',
                threshold: 0.01
            });
            
            lazyImages.forEach(img => {
                // Si l'image a déjà une src (pas data-src), marquer comme loaded
                if (!img.dataset.src && img.complete) {
                    img.classList.add('loaded');
                } else {
                    imageObserver.observe(img);
                }
            });
        } else {
            // Fallback pour navigateurs anciens - charger toutes les images
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            lazyImages.forEach(img => {
                if (img.dataset.src) img.src = img.dataset.src;
                if (img.dataset.srcset) img.srcset = img.dataset.srcset;
                img.classList.add('loaded');
            });
        }
    }

    // ========================================
    // PRELOAD IMAGES ABOVE THE FOLD
    // ========================================
    
    function preloadCriticalImages() {
        // Précharger les images au-dessus du pli (visible immédiatement)
        const criticalImages = document.querySelectorAll('img.preload, .hero img, .community-intro img');
        
        criticalImages.forEach(img => {
            if (img.dataset.src) {
                const preloadLink = document.createElement('link');
                preloadLink.rel = 'preload';
                preloadLink.as = 'image';
                preloadLink.href = img.dataset.src;
                
                // Ajouter srcset si présent
                if (img.dataset.srcset) {
                    preloadLink.setAttribute('imagesrcset', img.dataset.srcset);
                }
                
                document.head.appendChild(preloadLink);
            }
        });
    }

    // ========================================
    // WEBP SUPPORT DETECTION
    // ========================================
    
    function checkWebPSupport() {
        const img = new Image();
        img.onload = img.onerror = function() {
            const isSupported = (img.height === 2);
            document.documentElement.classList.add(
                isSupported ? 'webp-supported' : 'no-webp'
            );
        };
        img.src = 'data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA';
    }

    // ========================================
    // BLUR-UP LOADING
    // ========================================
    
    function initBlurUpLoading() {
        const blurContainers = document.querySelectorAll('.blur-load');
        
        blurContainers.forEach(container => {
            const img = container.querySelector('img');
            
            if (img) {
                function loaded() {
                    container.classList.add('loaded');
                }
                
                if (img.complete) {
                    loaded();
                } else {
                    img.addEventListener('load', loaded);
                }
            }
        });
    }

    // ========================================
    // PROGRESSIVE IMAGE ENHANCEMENT
    // ========================================
    
    function enhanceImages() {
        const images = document.querySelectorAll('.community-image-card img, .community-image-card--panel img');
        
        images.forEach(img => {
            // Ajouter decode asynchrone pour meilleures performances
            if ('decode' in img) {
                img.decode().then(() => {
                    img.classList.add('decoded');
                }).catch(() => {
                    img.classList.add('decoded');
                });
            }
        });
    }

    // ========================================
    // CONNECTION SPEED DETECTION
    // ========================================
    
    function adaptToConnectionSpeed() {
        if ('connection' in navigator) {
            const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
            
            if (connection) {
                const effectiveType = connection.effectiveType;
                
                // Adapter la qualité selon la connexion
                if (effectiveType === 'slow-2g' || effectiveType === '2g') {
                    document.documentElement.classList.add('slow-connection');
                    console.log('Slow connection detected - optimizing images');
                } else if (effectiveType === '3g') {
                    document.documentElement.classList.add('medium-connection');
                } else {
                    document.documentElement.classList.add('fast-connection');
                }
            }
        }
    }

    // ========================================
    // ERROR HANDLING & RETRY
    // ========================================
    
    function handleImageErrors() {
        const images = document.querySelectorAll('img');
        
        images.forEach(img => {
            img.addEventListener('error', function() {
                // Retry une fois
                if (!this.dataset.retried) {
                    console.log('Retrying image load:', this.src);
                    this.dataset.retried = 'true';
                    const src = this.src;
                    this.src = '';
                    setTimeout(() => {
                        this.src = src;
                    }, 1000);
                } else {
                    // Afficher un placeholder
                    this.classList.add('image-error');
                    console.error('Image failed to load:', this.src);
                }
            });
        });
    }

    // ========================================
    // INITIALIZATION
    // ========================================
    
    function init() {
        // Vérifier si le DOM est prêt
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }
        
        // Détecter le support WebP
        checkWebPSupport();
        
        // Adapter selon la connexion
        adaptToConnectionSpeed();
        
        // Précharger les images critiques
        preloadCriticalImages();
        
        // Initialiser le lazy loading
        initLazyLoading();
        
        // Initialiser le blur-up loading
        initBlurUpLoading();
        
        // Améliorer les images
        enhanceImages();
        
        // Gérer les erreurs
        handleImageErrors();
        
        console.log('✓ Image optimization initialized');
    }
    
    // Lancer l'initialisation
    init();

})();
