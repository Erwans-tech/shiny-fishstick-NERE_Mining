(() => {
    const imageSelector = 'img, [style*="background-image"], .protected-image';

    const isImageTarget = (target) => target instanceof Element && target.closest(imageSelector);

    document.addEventListener('contextmenu', (event) => {
        if (isImageTarget(event.target)) {
            event.preventDefault();
        }
    }, true);

    document.addEventListener('dragstart', (event) => {
        if (isImageTarget(event.target)) {
            event.preventDefault();
        }
    }, true);

    document.addEventListener('copy', (event) => {
        if (isImageTarget(document.activeElement) || window.getSelection()?.anchorNode?.parentElement?.closest(imageSelector)) {
            event.preventDefault();
        }
    }, true);

    document.querySelectorAll('img').forEach((image) => {
        image.setAttribute('draggable', 'false');
    });

    document.querySelectorAll('.protected-media').forEach((container) => {
        container.setAttribute('aria-label', container.getAttribute('aria-label') || 'Image protegee');
    });
})();
