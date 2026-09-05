document.addEventListener('DOMContentLoaded', function () {
    const banner = document.getElementById('cookie-banner');
    const actionButtons = document.querySelectorAll('[data-cookie-action]');
    const consentKey = 'nere_mining_cookie_consent';

    function runGtagConsent(status) {
        if (typeof window.gtag !== 'function') {
            return;
        }

        window.gtag('consent', 'update', {
            analytics_storage: status === 'accepted' ? 'granted' : 'denied',
            ad_storage: 'denied',
            ad_user_data: 'denied',
            ad_personalization: 'denied'
        });
    }

    function hideBanner() {
        if (banner) {
            banner.style.display = 'none';
        }
    }

    function saveConsent(choice) {
        localStorage.setItem(consentKey, choice);
        runGtagConsent(choice);
        hideBanner();
    }

    function showBanner() {
        if (banner) {
            banner.style.display = 'block';
        }
    }

    const currentChoice = localStorage.getItem(consentKey);

    if (!currentChoice) {
        showBanner();
    } else {
        hideBanner();
        runGtagConsent(currentChoice);
    }

    actionButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const choice = this.getAttribute('data-cookie-action') === 'accept' ? 'accepted' : 'rejected';
            saveConsent(choice);
        });
    });
});
