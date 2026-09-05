<div id="cookie-banner" class="cookie-banner" aria-live="polite" style="display:none;">
    <div class="cookie-banner__inner">
        <div class="cookie-banner__content">
            <div class="cookie-banner__title">Gestion des cookies</div>
            <p>
                Nous utilisons des cookies essentiels au fonctionnement du site et des cookies analytiques
                pour améliorer votre expérience et mesurer l’audience. Vous pouvez accepter ou refuser
                les cookies non essentiels à tout moment.
            </p>
        </div>
        <div class="cookie-banner__actions">
            <a href="{{ route('cookies.policy') }}" class="cookie-banner__link">En savoir plus</a>
            <button type="button" class="cookie-banner__btn cookie-banner__btn--secondary" data-cookie-action="reject">
                Refuser
            </button>
            <button type="button" class="cookie-banner__btn cookie-banner__btn--primary" data-cookie-action="accept">
                Accepter
            </button>
        </div>
    </div>
</div>

<style>
    .cookie-banner {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1600;
        padding: 18px 20px 22px;
        background: linear-gradient(135deg, rgba(31, 22, 19, 0.98), rgba(75, 23, 22, 0.96));
        border-top: 1px solid rgba(255, 194, 71, 0.45);
        box-shadow: 0 -18px 38px rgba(0, 0, 0, 0.26);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .cookie-banner__inner {
        max-width: 1220px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .cookie-banner__content {
        flex: 1;
        color: #f7f0e7;
        min-width: 0;
    }

    .cookie-banner__title {
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        font-weight: 700;
        color: #ffc247;
        margin-bottom: 8px;
    }

    .cookie-banner__content p {
        margin: 0;
        color: rgba(255,255,255,0.82);
        font-size: 0.96rem;
        line-height: 1.65;
        text-align: left;
        max-width: 720px;
    }

    .cookie-banner__actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .cookie-banner__link,
    .cookie-banner__btn {
        appearance: none;
        border: 0;
        border-radius: 999px;
        padding: 11px 18px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 700;
        line-height: 1;
        transition: transform 0.2s ease, opacity 0.2s ease, box-shadow 0.2s ease;
    }

    .cookie-banner__link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.04);
        color: #f7dca0;
        text-decoration: none;
        border: 1px solid rgba(255, 194, 71, 0.24);
    }

    .cookie-banner__btn:hover,
    .cookie-banner__link:hover {
        transform: translateY(-1px);
    }

    .cookie-banner__btn--secondary {
        background: rgba(255,255,255,0.08);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.14);
    }

    .cookie-banner__btn--primary {
        background: linear-gradient(135deg, #ffc247 0%, #e0a92d 100%);
        color: #2d1b1a;
        box-shadow: 0 8px 22px rgba(255, 194, 71, 0.28);
    }

    @media (max-width: 760px) {
        .cookie-banner {
            padding-bottom: 18px;
        }

        .cookie-banner__inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .cookie-banner__actions {
            width: 100%;
            justify-content: flex-start;
        }

        .cookie-banner__btn,
        .cookie-banner__link {
            flex: 1 1 auto;
        }
    }
</style>
