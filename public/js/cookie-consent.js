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
        try {
            window.localStorage.setItem(consentKey, choice);
        } catch (error) {
            // Consent still applies for the current page when storage is unavailable.
        }
        runGtagConsent(choice);
        hideBanner();
    }

    function showBanner() {
        if (banner) {
            banner.style.display = 'block';
        }
    }

    let currentChoice = null;
    try {
        currentChoice = window.localStorage.getItem(consentKey);
    } catch (error) {
        // A blocked storage still means that no consent has been recorded.
    }

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
