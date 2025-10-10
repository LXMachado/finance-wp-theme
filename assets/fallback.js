/**
 * Finance Theme - Fallback JavaScript
 * Basic functionality for when build process fails or isn't run
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

(function() {
    'use strict';

    /**
     * Theme initialization when DOM is ready
     */
    function init() {
        mobileMenu();
        searchToggle();
        accessibility();
    }

    /**
     * Mobile menu functionality
     */
    function mobileMenu() {
        const toggle = document.querySelector('.mobile-menu-toggle');
        const menu = document.querySelector('.mobile-menu');
        const body = document.body;

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function(e) {
            e.preventDefault();

            const isExpanded = 'true' === toggle.getAttribute('aria-expanded');

            // Toggle menu visibility
            if (isExpanded) {
                menu.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
                menu.setAttribute('aria-hidden', 'true');
                body.classList.remove('mobile-menu-open');
            } else {
                menu.classList.remove('hidden');
                toggle.setAttribute('aria-expanded', 'true');
                menu.setAttribute('aria-hidden', 'false');
                body.classList.add('mobile-menu-open');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
                menu.setAttribute('aria-hidden', 'true');
                body.classList.remove('mobile-menu-open');
            }
        });
    }

    /**
     * Search toggle functionality
     */
    function searchToggle() {
        const toggle = document.querySelector('.search-toggle');
        const form = document.querySelector('.search-form-container');
        const input = form ? form.querySelector('input[type="search"]') : null;

        if (!toggle || !form) return;

        toggle.addEventListener('click', function(e) {
            e.preventDefault();

            const isHidden = form.classList.contains('hidden');

            if (isHidden) {
                form.classList.remove('hidden');
                toggle.setAttribute('aria-expanded', 'true');
                // Focus the search input after animation
                setTimeout(function() {
                    if (input) input.focus();
                }, 100);
            } else {
                form.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /**
     * Accessibility enhancements
     */
    function accessibility() {
        // Escape key to close modals/menus
        document.addEventListener('keydown', function(e) {
            if ('Escape' === e.key || 27 === e.keyCode) {
                closeAllMenus();
            }
        });

        // Skip links functionality
        const skipLinks = document.querySelectorAll('.skip-link');
        skipLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            });
        });
    }

    /**
     * Close all open menus
     */
    function closeAllMenus() {
        // Close mobile menu
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const body = document.body;

        if (mobileMenu && mobileToggle) {
            mobileMenu.classList.add('hidden');
            mobileToggle.setAttribute('aria-expanded', 'false');
            mobileMenu.setAttribute('aria-hidden', 'true');
            body.classList.remove('mobile-menu-open');
        }

        // Close search form
        const searchForm = document.querySelector('.search-form-container');
        const searchToggle = document.querySelector('.search-toggle');

        if (searchForm && searchToggle) {
            searchForm.classList.add('hidden');
            searchToggle.setAttribute('aria-expanded', 'false');
        }
    }

    /**
     * Smooth scrolling for anchor links
     */
    function smoothScrolling() {
        const links = document.querySelectorAll('a[href*="#"]:not([href="#"])');
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    const offsetTop = target.offsetTop - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Back to top functionality
     */
    function backToTop() {
        const button = document.querySelector('.back-to-top-button');
        if (!button) return;

        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (300 < window.pageYOffset) {
                button.style.opacity = '1';
                button.style.visibility = 'visible';
            } else {
                button.style.opacity = '0';
                button.style.visibility = 'hidden';
            }
        });

        // Smooth scroll to top
        button.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Utility function to debounce function calls
     */
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    /**
     * Utility function to throttle function calls
     */
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    // Initialize when DOM is ready
    if ('loading' === document.readyState) {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Initialize additional features
    init();

    // Expose utilities globally for debugging (only in development)
    if ('undefined' !== typeof window && window.console) {
        window.financeThemeFallback = {
            init: init,
            mobileMenu: mobileMenu,
            searchToggle: searchToggle,
            accessibility: accessibility,
            smoothScrolling: smoothScrolling,
            backToTop: backToTop,
            debounce: debounce,
            throttle: throttle
        };
    }

})();