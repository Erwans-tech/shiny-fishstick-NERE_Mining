/**
 * Upload progress - Néré Mining
 *
 * Every multipart form that has at least one file selected is sent with
 * XMLHttpRequest so the real upload progress can be shown. The server
 * response (redirect target, validation errors…) then replaces the page,
 * exactly as a normal submission would. Without JavaScript, forms submit
 * normally. Add data-no-upload-progress on a form to opt out.
 */
(function () {
    'use strict';

    var en = (document.documentElement.lang || '').toLowerCase().indexOf('en') === 0;
    var t = en ? {
        sending: 'Uploading files',
        processing: 'Processing on the server…',
        failed: 'Upload failed',
        tooLarge: 'The files are too large for the server.',
        network: 'Network error. Check your connection and try again.',
        close: 'Close',
        remaining: 'left'
    } : {
        sending: 'Envoi des fichiers',
        processing: 'Traitement sur le serveur…',
        failed: 'Échec de l\'envoi',
        tooLarge: 'Les fichiers sont trop volumineux pour le serveur.',
        network: 'Erreur réseau. Vérifiez la connexion puis réessayez.',
        close: 'Fermer',
        remaining: 'restant'
    };

    function formatBytes(bytes) {
        if (bytes < 1024 * 1024) {
            return Math.max(1, Math.round(bytes / 1024)) + ' Ko';
        }
        return (bytes / 1024 / 1024).toFixed(1).replace('.', ',') + ' Mo';
    }

    function formatTime(seconds) {
        if (!isFinite(seconds) || seconds < 1) return '';
        if (seconds < 60) return Math.ceil(seconds) + ' s';
        return Math.floor(seconds / 60) + ' min ' + String(Math.ceil(seconds % 60)).padStart(2, '0');
    }

    function selectedFiles(form) {
        return Array.from(form.querySelectorAll('input[type="file"]'))
            .flatMap(function (input) { return Array.from(input.files || []); });
    }

    function buildPanel() {
        var panel = document.createElement('div');
        panel.className = 'upload-progress';
        panel.setAttribute('role', 'status');
        panel.setAttribute('aria-live', 'polite');
        panel.innerHTML =
            '<div class="upload-progress__head">' +
                '<span class="upload-progress__title"></span>' +
                '<span class="upload-progress__percent">0 %</span>' +
            '</div>' +
            '<div class="upload-progress__file"></div>' +
            '<div class="upload-progress__track" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">' +
                '<div class="upload-progress__bar"></div>' +
            '</div>' +
            '<div class="upload-progress__meta"><span class="upload-progress__size"></span><span class="upload-progress__eta"></span></div>' +
            '<button type="button" class="upload-progress__close"></button>';
        panel.querySelector('.upload-progress__close').textContent = t.close;
        document.body.appendChild(panel);
        requestAnimationFrame(function () { panel.classList.add('is-visible'); });
        return panel;
    }

    function setDisabled(form, disabled) {
        form.querySelectorAll('button[type="submit"], input[type="submit"], button:not([type])').forEach(function (button) {
            button.disabled = disabled;
        });
    }

    function replacePage(xhr) {
        document.open();
        document.write(xhr.responseText);
        document.close();
        if (xhr.responseURL) {
            history.replaceState(null, '', xhr.responseURL);
        }
    }

    function send(form, submitter) {
        var files = selectedFiles(form);
        var panel = buildPanel();
        var title = panel.querySelector('.upload-progress__title');
        var percent = panel.querySelector('.upload-progress__percent');
        var fileLabel = panel.querySelector('.upload-progress__file');
        var bar = panel.querySelector('.upload-progress__bar');
        var track = panel.querySelector('.upload-progress__track');
        var size = panel.querySelector('.upload-progress__size');
        var eta = panel.querySelector('.upload-progress__eta');
        var startedAt = Date.now();

        title.textContent = t.sending;
        fileLabel.textContent = files.length === 1 ? files[0].name : files.length + (en ? ' files' : ' fichiers');

        function fail(message) {
            panel.classList.remove('is-processing');
            panel.classList.add('is-error');
            title.textContent = t.failed;
            fileLabel.textContent = message;
            percent.textContent = '';
            eta.textContent = '';
            setDisabled(form, false);
        }

        panel.querySelector('.upload-progress__close').addEventListener('click', function () {
            panel.remove();
        });

        var data;
        try {
            data = submitter ? new FormData(form, submitter) : new FormData(form);
        } catch (e) {
            data = new FormData(form);
        }

        var xhr = new XMLHttpRequest();
        xhr.open((form.getAttribute('method') || 'POST').toUpperCase(), form.action || window.location.href);
        xhr.setRequestHeader('Accept', 'text/html,application/xhtml+xml');

        xhr.upload.addEventListener('progress', function (event) {
            if (!event.lengthComputable) return;
            var ratio = event.loaded / event.total;
            var value = Math.min(100, Math.floor(ratio * 100));
            bar.style.width = value + '%';
            percent.textContent = value + ' %';
            track.setAttribute('aria-valuenow', String(value));
            size.textContent = formatBytes(event.loaded) + ' / ' + formatBytes(event.total);

            var elapsed = (Date.now() - startedAt) / 1000;
            var remaining = formatTime(elapsed > 1 && ratio > 0 ? elapsed * (1 - ratio) / ratio : NaN);
            eta.textContent = remaining ? remaining + ' ' + t.remaining : '';
        });

        xhr.upload.addEventListener('load', function () {
            panel.classList.add('is-processing');
            title.textContent = t.processing;
            percent.textContent = '100 %';
            eta.textContent = '';
        });

        xhr.addEventListener('load', function () {
            if (xhr.status === 413) {
                fail(t.tooLarge);
                return;
            }
            replacePage(xhr);
        });

        xhr.addEventListener('error', function () { fail(t.network); });
        xhr.addEventListener('abort', function () { fail(t.network); });

        setDisabled(form, true);
        xhr.send(data);
    }

    // Bubble phase on document: forms' own validation handlers run first and
    // can still cancel the submission with preventDefault().
    document.addEventListener('submit', function (event) {
        var form = event.target;
        if (event.defaultPrevented || !(form instanceof HTMLFormElement)) return;
        if (form.hasAttribute('data-no-upload-progress')) return;
        if ((form.enctype || '').toLowerCase() !== 'multipart/form-data') return;
        if (!window.FormData || !selectedFiles(form).length) return;

        event.preventDefault();
        send(form, event.submitter || null);
    });
})();
