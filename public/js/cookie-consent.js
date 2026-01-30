/**
 * Cookie Consent Manager
 * Eindexamenniveau JavaScript - AVG/GDPR compliant
 */

class CookieConsentManager {
    constructor() {
        this.cookieName = 'tcr_cookie_consent';
        this.cookieExpiry = 365; // days
        this.init();
    }

    /**
     * Initialize the cookie consent manager
     */
    init() {
        if (!this.hasConsent()) {
            this.showBanner();
        }
    }

    /**
     * Check if user has given consent
     * @returns {boolean}
     */
    hasConsent() {
        return this.getCookie(this.cookieName) === 'accepted';
    }

    /**
     * Get cookie value by name
     * @param {string} name - Cookie name
     * @returns {string|null}
     */
    getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) {
            return parts.pop().split(';').shift();
        }
        return null;
    }

    /**
     * Set cookie with expiry
     * @param {string} name - Cookie name
     * @param {string} value - Cookie value
     * @param {number} days - Expiry in days
     */
    setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Strict`;
    }

    /**
     * Show cookie consent banner
     */
    showBanner() {
        const banner = this.createBanner();
        document.body.appendChild(banner);
        
        // Add event listeners
        const acceptBtn = banner.querySelector('#acceptCookies');
        const declineBtn = banner.querySelector('#declineCookies');
        
        acceptBtn.addEventListener('click', () => this.acceptCookies(banner));
        declineBtn.addEventListener('click', () => this.declineCookies(banner));
        
        // Keyboard accessibility
        acceptBtn.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.acceptCookies(banner);
            }
        });
    }

    /**
     * Create banner HTML element
     * @returns {HTMLElement}
     */
    createBanner() {
        const banner = document.createElement('div');
        banner.id = 'cookieConsent';
        banner.setAttribute('role', 'dialog');
        banner.setAttribute('aria-label', 'Cookie toestemming');
        banner.setAttribute('aria-describedby', 'cookieConsentText');
        
        banner.innerHTML = `
            <div style="position: fixed; bottom: 0; left: 0; right: 0; background: #2d4a3e; color: white; padding: 1.5rem; box-shadow: 0 -4px 20px rgba(0,0,0,0.2); z-index: 9999; animation: slideUp 0.3s ease;">
                <div style="max-width: 1200px; margin: 0 auto; display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 300px;">
                        <p id="cookieConsentText" style="margin: 0; font-size: 0.95rem; line-height: 1.6;">
                            🍪 Deze website gebruikt alleen functionele cookies die noodzakelijk zijn voor het functioneren van de website. 
                            <a href="/privacy" style="color: #f4d03f; text-decoration: underline;" aria-label="Lees ons privacybeleid">Lees meer in ons privacybeleid</a>
                        </p>
                    </div>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <button id="acceptCookies" 
                                style="background: #d4a024; color: white; border: none; padding: 0.75rem 2rem; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                                onmouseover="this.style.background='#b8891f'"
                                onmouseout="this.style.background='#d4a024'"
                                aria-label="Accepteer cookies">
                            Accepteren
                        </button>
                        <button id="declineCookies" 
                                style="background: transparent; color: white; border: 2px solid white; padding: 0.75rem 2rem; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                                onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                                onmouseout="this.style.background='transparent'"
                                aria-label="Weiger cookies">
                            Weigeren
                        </button>
                    </div>
                </div>
            </div>
            <style>
                @keyframes slideUp {
                    from {
                        transform: translateY(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateY(0);
                        opacity: 1;
                    }
                }
            </style>
        `;
        
        return banner;
    }

    /**
     * Accept cookies
     * @param {HTMLElement} banner
     */
    acceptCookies(banner) {
        this.setCookie(this.cookieName, 'accepted', this.cookieExpiry);
        this.removeBanner(banner);
        
        // Analytics or tracking code would go here
        console.log('Cookies accepted');
    }

    /**
     * Decline cookies
     * @param {HTMLElement} banner
     */
    declineCookies(banner) {
        this.setCookie(this.cookieName, 'declined', this.cookieExpiry);
        this.removeBanner(banner);
        console.log('Cookies declined');
    }

    /**
     * Remove banner with animation
     * @param {HTMLElement} banner
     */
    removeBanner(banner) {
        banner.style.animation = 'slideDown 0.3s ease';
        setTimeout(() => {
            banner.remove();
        }, 300);
    }
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new CookieConsentManager();
    });
} else {
    new CookieConsentManager();
}

// Add slideDown animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideDown {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
