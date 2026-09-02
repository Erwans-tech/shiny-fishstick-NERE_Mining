/**
 * 🎛️ ANIMATIONS ADMIN NÉRÉ MINING
 * Animations spécialisées pour l'interface d'administration
 */

class AdminAnimationController {
  constructor() {
    this.init();
  }

  init() {
    this.setupDashboardAnimations();
    this.setupFormAnimations();
    this.setupTableAnimations();
    this.setupNotificationAnimations();
    this.setupMediaAnimations();
    this.setupSidebarAnimations();
    this.setupStatCounters();
  }

  /**
   * 📊 ANIMATIONS DASHBOARD
   */
  setupDashboardAnimations() {
    // Animation des tuiles de statistiques
    this.animateStatTiles();
    
    // Animation des graphiques (si présents)
    this.animateCharts();
    
    // Animation de la barre de progression de bienvenue
    this.setupWelcomeProgress();
  }

  animateStatTiles() {
    const statTiles = document.querySelectorAll('.admin-stat-tile, .stat-tile, .metric-card');
    
    statTiles.forEach((tile, index) => {
      // Ajouter les classes d'animation si pas déjà présentes
      if (!tile.classList.contains('admin-stat-tile')) {
        tile.classList.add('admin-stat-tile');
      }
      
      // Animation du compteur
      const valueElement = tile.querySelector('.stat-value, .metric-value, .tile-number');
      if (valueElement) {
        this.animateCounter(valueElement, index * 200);
      }

      // Effet de particules au hover
      tile.addEventListener('mouseenter', () => {
        this.createTileParticles(tile);
      });

      // Animation de pulsation au clic
      tile.addEventListener('click', () => {
        this.pulseElement(tile);
      });
    });
  }

  animateCounter(element, delay = 0) {
    const finalValue = parseInt(element.dataset.count || element.textContent.replace(/[^\d]/g, ''));
    const duration = parseInt(element.dataset.duration || '2000');
    const suffix = element.dataset.suffix || '';
    const prefix = element.dataset.prefix || '';

    setTimeout(() => {
      let startValue = 0;
      const increment = finalValue / (duration / 16);
      
      const counter = () => {
        startValue += increment;
        
        if (startValue < finalValue) {
          element.textContent = prefix + Math.floor(startValue).toLocaleString() + suffix;
          requestAnimationFrame(counter);
        } else {
          element.textContent = prefix + finalValue.toLocaleString() + suffix;
          // Ajouter un effet de brillance à la fin
          this.addGlowEffect(element);
        }
      };
      
      counter();
    }, delay);
  }

  /**
   * 📝 ANIMATIONS FORMULAIRES
   */
  setupFormAnimations() {
    // Animation des groupes de formulaire
    this.animateFormGroups();
    
    // Validation en temps réel avec animations
    this.setupFormValidation();
    
    // Animation des boutons de soumission
    this.setupSubmitButtons();
    
    // Upload de fichiers avec animations
    this.setupFileUploads();
  }

  animateFormGroups() {
    const formGroups = document.querySelectorAll('.form-group, .admin-form-group, .field-group');
    
    formGroups.forEach((group, index) => {
      group.classList.add('admin-form-group');
      group.style.animationDelay = `${index * 0.1}s`;
    });
  }

  setupFormValidation() {
    const inputs = document.querySelectorAll('input, textarea, select');
    
    inputs.forEach(input => {
      input.addEventListener('blur', (e) => {
        const isValid = e.target.checkValidity();
        this.animateFieldValidation(e.target, isValid);
      });

      input.addEventListener('input', (e) => {
        // Retirer les classes d'erreur pendant la saisie
        e.target.classList.remove('error', 'success');
      });
    });
  }

  animateFieldValidation(field, isValid) {
    field.classList.remove('error', 'success');
    
    setTimeout(() => {
      field.classList.add(isValid ? 'success' : 'error');
      
      if (!isValid) {
        // Animation de secousse pour les erreurs
        field.style.animation = 'fieldShake 0.5s ease-in-out';
        setTimeout(() => {
          field.style.animation = '';
        }, 500);
      }
    }, 50);

    // Injecter les styles nécessaires
    this.injectCSS(`
      input.success, textarea.success, select.success {
        border-color: var(--success-fg) !important;
        box-shadow: 0 0 0 3px rgba(22,101,52,0.1) !important;
      }
      input.error, textarea.error, select.error {
        border-color: var(--danger) !important;
        box-shadow: 0 0 0 3px rgba(220,38,38,0.1) !important;
      }
      @keyframes fieldShake {
        0%, 20%, 40%, 60%, 80%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      }
    `);
  }

  setupSubmitButtons() {
    const submitButtons = document.querySelectorAll('button[type="submit"], .btn-submit');
    
    submitButtons.forEach(button => {
      button.classList.add('admin-btn');
      
      button.addEventListener('click', (e) => {
        // Animation de chargement
        this.showButtonLoading(button);
        
        // Simuler le chargement (à adapter selon vos besoins)
        const form = button.closest('form');
        if (form) {
          form.addEventListener('submit', () => {
            this.showButtonLoading(button);
          });
        }
      });
    });
  }

  showButtonLoading(button) {
    const originalText = button.textContent;
    button.disabled = true;
    button.classList.add('admin-loading');
    button.textContent = 'Chargement...';
    
    // Retirer le loading après 3 secondes (à adapter)
    setTimeout(() => {
      button.disabled = false;
      button.classList.remove('admin-loading');
      button.textContent = originalText;
    }, 3000);
  }

  /**
   * 📊 ANIMATIONS TABLEAUX
   */
  setupTableAnimations() {
    const tables = document.querySelectorAll('table');
    
    tables.forEach(table => {
      table.classList.add('admin-table');
      
      // Animation des lignes au hover
      const rows = table.querySelectorAll('tbody tr');
      rows.forEach(row => {
        row.addEventListener('mouseenter', () => {
          this.highlightTableRow(row);
        });
      });

      // Animation de tri des colonnes
      const headers = table.querySelectorAll('th[data-sort]');
      headers.forEach(header => {
        header.addEventListener('click', () => {
          this.animateTableSort(table, header);
        });
      });
    });
  }

  highlightTableRow(row) {
    // Ajouter un effet de surbrillance temporaire
    row.style.background = 'linear-gradient(90deg, rgba(255,194,71,0.1), transparent)';
    row.style.backgroundSize = '0% 100%';
    row.style.backgroundRepeat = 'no-repeat';
    row.style.transition = 'background-size 0.3s ease';
    
    setTimeout(() => {
      row.style.backgroundSize = '100% 100%';
    }, 10);
  }

  /**
   * 🔔 ANIMATIONS NOTIFICATIONS
   */
  setupNotificationAnimations() {
    // Animer les alertes existantes
    const alerts = document.querySelectorAll('.alert, .notification, .admin-alert');
    alerts.forEach(alert => {
      alert.classList.add('admin-alert');
    });

    // Système de notifications toast
    this.createNotificationSystem();
  }

  createNotificationSystem() {
    // Créer le conteneur de notifications
    const container = document.createElement('div');
    container.id = 'admin-notifications';
    container.style.cssText = `
      position: fixed;
      top: 80px;
      right: 20px;
      z-index: 9999;
      max-width: 350px;
      pointer-events: none;
    `;
    document.body.appendChild(container);

    // Fonction globale pour afficher des notifications
    window.showAdminNotification = (message, type = 'info', duration = 5000) => {
      this.showNotification(message, type, duration);
    };
  }

  showNotification(message, type, duration) {
    const notification = document.createElement('div');
    notification.className = `admin-notification admin-notification-${type}`;
    notification.style.cssText = `
      padding: 16px 20px;
      margin-bottom: 12px;
      border-radius: 8px;
      color: white;
      font-size: 14px;
      line-height: 1.4;
      pointer-events: auto;
      cursor: pointer;
      transform: translateX(100%);
      transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;

    // Couleurs selon le type
    const colors = {
      success: 'linear-gradient(135deg, #10b981, #059669)',
      error: 'linear-gradient(135deg, #ef4444, #dc2626)',
      warning: 'linear-gradient(135deg, #f59e0b, #d97706)',
      info: 'linear-gradient(135deg, #3b82f6, #2563eb)'
    };
    
    notification.style.background = colors[type] || colors.info;
    notification.textContent = message;

    const container = document.getElementById('admin-notifications');
    container.appendChild(notification);

    // Animation d'entrée
    setTimeout(() => {
      notification.style.transform = 'translateX(0)';
    }, 10);

    // Fermeture au clic
    notification.addEventListener('click', () => {
      this.hideNotification(notification);
    });

    // Auto-fermeture
    setTimeout(() => {
      this.hideNotification(notification);
    }, duration);
  }

  hideNotification(notification) {
    notification.style.transform = 'translateX(100%)';
    setTimeout(() => {
      notification.remove();
    }, 300);
  }

  /**
   * 🎨 ANIMATIONS MÉDIAS
   */
  setupMediaAnimations() {
    // Animation des aperçus d'images
    const imagePreviews = document.querySelectorAll('.image-preview, .media-preview');
    imagePreviews.forEach(preview => {
      preview.classList.add('admin-image-preview');
    });

    // Animation des zones d'upload
    this.setupUploadZones();
  }

  setupFileUploads() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
      const wrapper = input.closest('.upload-zone, .file-upload');
      if (wrapper) {
        wrapper.classList.add('admin-upload-zone');
        
        // Animation de drag & drop
        wrapper.addEventListener('dragover', (e) => {
          e.preventDefault();
          wrapper.classList.add('dragover');
        });
        
        wrapper.addEventListener('dragleave', () => {
          wrapper.classList.remove('dragover');
        });
        
        wrapper.addEventListener('drop', (e) => {
          e.preventDefault();
          wrapper.classList.remove('dragover');
          // Ajouter animation de succès
          this.animateUploadSuccess(wrapper);
        });
      }
    });
  }

  animateUploadSuccess(element) {
    element.style.background = 'rgba(16, 185, 129, 0.1)';
    element.style.borderColor = '#10b981';
    element.style.transform = 'scale(1.02)';
    
    setTimeout(() => {
      element.style.background = '';
      element.style.borderColor = '';
      element.style.transform = '';
    }, 1000);
  }

  /**
   * 🗂️ ANIMATIONS SIDEBAR
   */
  setupSidebarAnimations() {
    const sidebar = document.querySelector('.sidebar');
    const menuItems = document.querySelectorAll('.sidebar-nav a');
    
    // Animation des badges de notification
    const badges = document.querySelectorAll('.sidebar-badge, .notification-badge');
    badges.forEach(badge => {
      badge.classList.add('sidebar-badge');
    });

    // Effet accordion pour les sous-menus
    this.setupAccordionMenus();
  }

  setupAccordionMenus() {
    const menuItems = document.querySelectorAll('.sidebar-nav li');
    
    menuItems.forEach(item => {
      const submenu = item.querySelector('ul');
      if (submenu) {
        const toggle = item.querySelector('a');
        toggle.addEventListener('click', (e) => {
          e.preventDefault();
          this.toggleSubmenu(submenu);
        });
      }
    });
  }

  toggleSubmenu(submenu) {
    const isOpen = submenu.style.maxHeight && submenu.style.maxHeight !== '0px';
    
    if (isOpen) {
      submenu.style.maxHeight = '0px';
      submenu.style.opacity = '0';
    } else {
      submenu.style.maxHeight = submenu.scrollHeight + 'px';
      submenu.style.opacity = '1';
    }
    
    submenu.style.transition = 'all 0.3s cubic-bezier(0.22, 1, 0.36, 1)';
  }

  /**
   * 🧮 COMPTEURS DE STATISTIQUES
   */
  setupStatCounters() {
    // Observer pour déclencher les animations au scroll
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const statValue = entry.target.querySelector('.stat-value, .metric-value');
          if (statValue && !statValue.classList.contains('animated')) {
            statValue.classList.add('animated');
            this.animateCounter(statValue);
          }
        }
      });
    }, { threshold: 0.5 });

    document.querySelectorAll('.admin-stat-tile').forEach(tile => {
      observer.observe(tile);
    });
  }

  /**
   * 🛠️ UTILITAIRES
   */
  createTileParticles(tile) {
    for (let i = 0; i < 5; i++) {
      const particle = document.createElement('div');
      particle.style.cssText = `
        position: absolute;
        width: 3px;
        height: 3px;
        background: var(--gold);
        border-radius: 50%;
        pointer-events: none;
        top: 50%;
        left: 50%;
        opacity: 0.7;
      `;
      
      const angle = (Math.PI * 2 * i) / 5;
      const distance = 30 + Math.random() * 20;
      const x = Math.cos(angle) * distance;
      const y = Math.sin(angle) * distance;
      
      tile.style.position = 'relative';
      tile.appendChild(particle);
      
      particle.animate([
        { 
          transform: 'translate(-50%, -50%) scale(0)', 
          opacity: 0.7 
        },
        { 
          transform: `translate(calc(-50% + ${x}px), calc(-50% + ${y}px)) scale(1)`, 
          opacity: 0 
        }
      ], {
        duration: 800,
        easing: 'cubic-bezier(0.22, 1, 0.36, 1)'
      }).addEventListener('finish', () => {
        particle.remove();
      });
    }
  }

  pulseElement(element) {
    element.style.animation = 'none';
    element.offsetHeight; // Force reflow
    element.style.animation = 'adminPulse 0.6s cubic-bezier(0.22, 1, 0.36, 1)';
    
    this.injectCSS(`
      @keyframes adminPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
      }
    `);
  }

  addGlowEffect(element) {
    element.style.textShadow = '0 0 10px rgba(255,194,71,0.6)';
    setTimeout(() => {
      element.style.textShadow = '';
    }, 1000);
  }

  injectCSS(css) {
    if (!this.styleSheet) {
      this.styleSheet = document.createElement('style');
      document.head.appendChild(this.styleSheet);
    }
    
    try {
      this.styleSheet.sheet.insertRule(css, this.styleSheet.sheet.cssRules.length);
    } catch (e) {
      // Ignorer les erreurs de syntaxe CSS
    }
  }
}

// Initialisation automatique
document.addEventListener('DOMContentLoaded', () => {
  new AdminAnimationController();
});

// Export global
window.AdminAnimations = AdminAnimationController;