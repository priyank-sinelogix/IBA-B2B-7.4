// ============================================
// Sewgo Marketing Site — main.js
// ============================================

document.addEventListener('DOMContentLoaded', function () {
    // Mobile nav toggle
    var navToggle = document.getElementById('navToggle');
    var navLinks = document.getElementById('navLinks');

    if (navToggle && navLinks) {
        navToggle.addEventListener('click', function () {
            navLinks.classList.toggle('open');
        });
    }

    // Close mobile nav when a link is clicked
    if (navLinks) {
        navLinks.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                navLinks.classList.remove('open');
            });
        });
    }

    // ============================================
    // GA4 lead tracking
    // Sends events only when gtag.js is actually loaded (GA4_MEASUREMENT_ID
    // set in .env), so nothing errors out on environments without GA4.
    // ============================================
    function gaEvent(name, params) {
        if (typeof gtag === 'function') {
            gtag('event', name, params || {});
        }
    }

    document.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link) return;
        var href = link.getAttribute('href') || '';

        if (href.indexOf('mailto:') === 0) {
            gaEvent('email_click', { link_url: href });
            return;
        }
        if (href.indexOf('tel:') === 0) {
            gaEvent('phone_click', { link_url: href });
            return;
        }
        if (href.indexOf('wa.me') !== -1 || href.indexOf('whatsapp.com') !== -1) {
            gaEvent('whatsapp_click', { link_url: href });
            return;
        }
        // Explicitly tagged CTAs (e.g. data-ga-event="request_quote_click") fire a
        // named conversion event; every other .btn still gets a generic cta_click
        // so no primary call-to-action goes unmeasured.
        if (link.hasAttribute('data-ga-event')) {
            gaEvent(link.getAttribute('data-ga-event'), {
                cta_label: (link.getAttribute('data-ga-label') || link.textContent || '').trim(),
                link_url: href
            });
            return;
        }
        if (link.classList.contains('btn')) {
            gaEvent('cta_click', {
                cta_label: (link.textContent || '').trim(),
                link_url: href
            });
        }
    });

    // Registration / sign-up: the public site's only account-entry form is
    // Partner Login (there is no separate self-serve sign-up form).
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function () {
            gaEvent('login', { method: 'partner_portal' });
        });
    }
});
