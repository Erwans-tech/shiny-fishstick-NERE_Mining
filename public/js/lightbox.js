/*
 * Visionneuse d'images (lightbox) accessible, sans dépendance.
 *
 * Usage : ajouter data-lightbox="nom-du-groupe" sur chaque <img> cliquable.
 * Les images d'un même groupe forment la suite parcourue avec précédent/suivant.
 * data-lightbox-src (optionnel) : URL de l'image pleine taille (sinon src).
 */
(function () {
    'use strict';

    var en = (document.documentElement.lang || '').toLowerCase().indexOf('en') === 0;
    var t = en
        ? { dialog: 'Image viewer', close: 'Close', prev: 'Previous image', next: 'Next image', open: 'Enlarge image' }
        : { dialog: 'Visionneuse d\'images', close: 'Fermer', prev: 'Image précédente', next: 'Image suivante', open: 'Agrandir l\'image' };

    var overlay, img, btnClose, btnPrev, btnNext, counter;
    var items = [];
    var index = 0;
    var opener = null;
    var previousOverflow = '';

    function build() {
        overlay = document.createElement('div');
        overlay.className = 'lb-overlay';
        overlay.setAttribute('role', 'dialog');
        overlay.setAttribute('aria-modal', 'true');
        overlay.setAttribute('aria-label', t.dialog);
        overlay.hidden = true;

        img = document.createElement('img');
        img.className = 'lb-img';
        img.alt = '';

        btnClose = makeButton('lb-close', t.close, '\u00D7');
        btnPrev = makeButton('lb-prev', t.prev, '\u2039');
        btnNext = makeButton('lb-next', t.next, '\u203A');

        counter = document.createElement('div');
        counter.className = 'lb-counter';
        counter.setAttribute('aria-live', 'polite');

        overlay.appendChild(img);
        overlay.appendChild(btnClose);
        overlay.appendChild(btnPrev);
        overlay.appendChild(btnNext);
        overlay.appendChild(counter);
        document.body.appendChild(overlay);

        btnClose.addEventListener('click', close);
        btnPrev.addEventListener('click', function () { show(index - 1); });
        btnNext.addEventListener('click', function () { show(index + 1); });
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) close();
        });
        // Écoute au niveau du document : le clavier marche même si le focus
        // a quitté les boutons (par ex. après un clic sur l'image).
        document.addEventListener('keydown', function (e) {
            if (overlay.classList.contains('is-open')) onKeydown(e);
        });
    }

    function makeButton(cls, label, text) {
        var b = document.createElement('button');
        b.type = 'button';
        b.className = 'lb-btn ' + cls;
        b.setAttribute('aria-label', label);
        b.textContent = text;
        return b;
    }

    function isVisible(el) {
        return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
    }

    function groupOf(trigger) {
        var name = trigger.getAttribute('data-lightbox');
        return Array.prototype.filter.call(
            document.querySelectorAll('[data-lightbox]'),
            function (el) { return el.getAttribute('data-lightbox') === name && isVisible(el); }
        );
    }

    function show(i) {
        var n = items.length;
        index = ((i % n) + n) % n;
        var el = items[index];
        img.src = el.getAttribute('data-lightbox-src') || el.currentSrc || el.src;
        img.alt = el.alt || '';
        counter.textContent = (index + 1) + ' / ' + n;
    }

    function open(trigger) {
        if (!overlay) build();
        items = groupOf(trigger);
        if (!items.length) return;
        opener = trigger;
        overlay.classList.toggle('is-single', items.length < 2);
        show(items.indexOf(trigger));
        overlay.hidden = false;
        overlay.classList.add('is-open');
        previousOverflow = document.body.style.overflow;
        document.body.style.overflow = 'hidden';
        btnClose.focus();
    }

    function close() {
        overlay.classList.remove('is-open');
        overlay.hidden = true;
        img.removeAttribute('src');
        document.body.style.overflow = previousOverflow;
        if (opener && typeof opener.focus === 'function') opener.focus();
        opener = null;
    }

    function onKeydown(e) {
        var multi = items.length > 1;
        if (e.key === 'Escape' || e.key === 'Esc') {
            e.preventDefault();
            close();
        } else if (e.key === 'ArrowRight' && multi) {
            e.preventDefault();
            show(index + 1);
        } else if (e.key === 'ArrowLeft' && multi) {
            e.preventDefault();
            show(index - 1);
        } else if (e.key === 'Tab') {
            // Garder le focus à l'intérieur de la boîte de dialogue.
            var focusables = multi ? [btnClose, btnPrev, btnNext] : [btnClose];
            var pos = focusables.indexOf(document.activeElement);
            var next = e.shiftKey ? pos - 1 : pos + 1;
            if (next < 0) next = focusables.length - 1;
            if (next >= focusables.length) next = 0;
            e.preventDefault();
            focusables[next].focus();
        }
    }

    function init() {
        var triggers = document.querySelectorAll('[data-lightbox]');
        Array.prototype.forEach.call(triggers, function (el) {
            el.setAttribute('tabindex', '0');
            el.setAttribute('role', 'button');
            if (!el.hasAttribute('aria-label')) {
                el.setAttribute('aria-label', t.open + (el.alt ? ' : ' + el.alt : ''));
            }
            el.addEventListener('click', function () { open(el); });
            el.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    open(el);
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
