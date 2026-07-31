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
});
