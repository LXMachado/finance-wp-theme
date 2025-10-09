/**
 * Finance Theme - Main JavaScript File
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

(function($) {
    'use strict';

    /**
     * Theme initialization when DOM is ready
     */
    $(document).ready(function() {
        financeTheme.init();
    });

    /**
     * Main theme object
     */
    const financeTheme = {

        /**
         * Initialize all theme functionality
         */
        init: function() {
            this.mobileMenu();
            this.searchToggle();
            this.backToTop();
            this.smoothScrolling();
            this.accessibility();
            this.lazyLoading();
        },

        /**
         * Mobile menu functionality
         */
        mobileMenu: function() {
            const $toggle = $('.mobile-menu-toggle');
            const $menu = $('.mobile-menu');
            const $body = $('body');

            if ($toggle.length && $menu.length) {
                $toggle.on('click', function(e) {
                    e.preventDefault();

                    const $this = $(this);
                    const isExpanded = $this.attr('aria-expanded') === 'true';

                    // Toggle menu visibility
                    $menu.toggleClass('hidden');

                    // Update ARIA attributes
                    $this.attr('aria-expanded', !isExpanded);
                    $menu.attr('aria-hidden', isExpanded);

                    // Prevent body scroll when menu is open
                    $body.toggleClass('mobile-menu-open', !isExpanded);
                });

                // Close menu when clicking outside
                $(document).on('click', function(e) {
                    if (!$toggle.is(e.target) && !$menu.is(e.target) && $menu.has(e.target).length === 0) {
                        $menu.addClass('hidden');
                        $toggle.attr('aria-expanded', 'false');
                        $menu.attr('aria-hidden', 'true');
                        $body.removeClass('mobile-menu-open');
                    }
                });
            }
        },

        /**
         * Search toggle functionality
         */
        searchToggle: function() {
            const $toggle = $('.search-toggle');
            const $form = $('.search-form-container');
            const $input = $form.find('input[type="search"]');

            if ($toggle.length && $form.length) {
                $toggle.on('click', function(e) {
                    e.preventDefault();

                    const $this = $(this);
                    const isHidden = $form.hasClass('hidden');

                    if (isHidden) {
                        $form.removeClass('hidden');
                        $this.attr('aria-expanded', 'true');
                        // Focus the search input after animation
                        setTimeout(function() {
                            $input.focus();
                        }, 100);
                    } else {
                        $form.addClass('hidden');
                        $this.attr('aria-expanded', 'false');
                    }
                });
            }
        },

        /**
         * Back to top functionality
         */
        backToTop: function() {
            const $button = $('.back-to-top-button');

            if ($button.length) {
                // Show/hide button based on scroll position
                $(window).on('scroll', function() {
                    if ($(this).scrollTop() > 300) {
                        $button.addClass('opacity-100').removeClass('opacity-0');
                    } else {
                        $button.addClass('opacity-0').removeClass('opacity-100');
                    }
                });

                // Smooth scroll to top
                $button.on('click', function(e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800, 'swing');
                });
            }
        },

        /**
         * Smooth scrolling for anchor links
         */
        smoothScrolling: function() {
            $('a[href*="#"]:not([href="#"])').on('click', function(e) {
                const target = $(this.hash);

                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 800, 'swing');
                }
            });
        },

        /**
         * Accessibility enhancements
         */
        accessibility: function() {
            // Add focus indicators for keyboard navigation
            this.keyboardNavigation();

            // Improve form accessibility
            this.formAccessibility();

            // Add skip links functionality
            this.skipLinks();
        },

        /**
         * Keyboard navigation improvements
         */
        keyboardNavigation: function() {
            // Escape key to close modals/menus
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    // Close mobile menu
                    $('.mobile-menu').addClass('hidden');
                    $('.mobile-menu-toggle').attr('aria-expanded', 'false');
                    $('body').removeClass('mobile-menu-open');

                    // Close search form
                    $('.search-form-container').addClass('hidden');
                    $('.search-toggle').attr('aria-expanded', 'false');
                }
            });
        },

        /**
         * Form accessibility improvements
         */
        formAccessibility: function() {
            $('form').each(function() {
                const $form = $(this);
                const $inputs = $form.find('input, textarea, select');

                $inputs.each(function() {
                    const $input = $(this);
                    const $label = $form.find(`label[for="${$input.attr('id')}"]`);

                    // Add required indicators
                    if ($input.prop('required') && !$input.hasClass('required-indicated')) {
                        $input.addClass('required-indicated');
                        if ($label.length) {
                            $label.append(' <span class="required" aria-label="required">*</span>');
                        }
                    }
                });
            });
        },

        /**
         * Skip links functionality
         */
        skipLinks: function() {
            $('.skip-link').on('click', function(e) {
                const target = $($(this).attr('href'));
                if (target.length) {
                    e.preventDefault();
                    target.attr('tabindex', '-1').focus();
                }
            });
        },

        /**
         * Lazy loading for images (if not natively supported)
         */
        lazyLoading: function() {
            if ('loading' in HTMLImageElement.prototype) {
                // Native lazy loading is supported
                $('img[data-src]').each(function() {
                    $(this).attr('src', $(this).attr('data-src')).removeAttr('data-src');
                });
            } else {
                // Fallback for older browsers
                this.loadLazyImages();
            }
        },

        /**
         * Fallback lazy loading implementation
         */
        loadLazyImages: function() {
            const images = $('img[data-src]');
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.each(function() {
                imageObserver.observe(this);
            });
        },

        /**
         * Utility function to debounce function calls
         */
        debounce: function(func, wait, immediate) {
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
        },

        /**
         * Utility function to throttle function calls
         */
        throttle: function(func, limit) {
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
    };

    // Expose to global scope for debugging (only in development)
    if (typeof window !== 'undefined' && window.console) {
        window.financeTheme = financeTheme;
    }

})(jQuery);