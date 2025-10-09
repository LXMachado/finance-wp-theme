<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #main and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

?>

    </main><!-- #main -->

    <footer class="<?php echo esc_attr(finance_theme_footer_classes()); ?>">
        <?php if (is_active_sidebar('footer-widgets') || has_nav_menu('footer')) : ?>
            <!-- Footer Widgets Section -->
            <div class="footer-widgets-section bg-slate-50 border-t border-slate-200">
                <div class="container mx-auto px-4 py-12">
                    <?php if (is_active_sidebar('footer-widgets')) : ?>
                        <div class="footer-widgets grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                            <?php dynamic_sidebar('footer-widgets'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (has_nav_menu('footer')) : ?>
                        <div class="footer-navigation mt-8 pt-8 border-t border-slate-200">
                            <nav class="footer-nav" role="navigation" aria-label="<?php esc_attr_e('Footer Navigation', 'finance-theme'); ?>">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'footer',
                                    'menu_id'        => 'footer-menu',
                                    'menu_class'     => 'footer-menu flex flex-wrap justify-center space-x-6 text-sm',
                                    'container'      => 'ul',
                                    'depth'          => 1,
                                    'fallback_cb'    => false,
                                ));
                                ?>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Site Info Section -->
        <div class="site-info bg-slate-800 text-slate-300">
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <!-- Copyright and Site Info -->
                    <div class="site-copyright text-center lg:text-left mb-4 lg:mb-0">
                        <p class="text-sm">
                            <?php echo finance_theme_get_footer_copyright(); ?>
                            <span class="mx-2">•</span>
                            <span><?php printf(esc_html__('Built with %s', 'finance-theme'), '<a href="' . esc_url(__('https://wordpress.org/', 'finance-theme')) . '" class="hover:text-white transition-colors" rel="nofollow">WordPress</a>'); ?></span>
                        </p>
                    </div>

                    <!-- Footer Social Links -->
                    <?php if (has_nav_menu('social')) : ?>
                        <div class="footer-social text-center lg:text-right">
                            <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Social Links Menu', 'finance-theme'); ?>">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'social',
                                    'menu_id'        => 'social-menu-footer',
                                    'menu_class'     => 'social-links-menu flex items-center justify-center lg:justify-end space-x-4',
                                    'container'      => 'ul',
                                    'depth'          => 1,
                                    'link_before'    => '<span class="sr-only">',
                                    'link_after'     => '</span>',
                                ));
                                ?>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Back to Top Button -->
                <div class="back-to-top text-center mt-6 pt-6 border-t border-slate-700">
                    <button class="back-to-top-button inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors" onclick="scrollToTop()">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        <?php esc_html_e('Back to Top', 'finance-theme'); ?>
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    <!-- JavaScript for Back to Top -->
    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide back to top button based on scroll position
        window.addEventListener('scroll', function() {
            const backToTopButton = document.querySelector('.back-to-top-button');
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0');
                backToTopButton.classList.add('opacity-100');
            } else {
                backToTopButton.classList.remove('opacity-100');
                backToTopButton.classList.add('opacity-0');
            }
        });

        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');
            const searchToggle = document.querySelector('.search-toggle');
            const searchForm = document.querySelector('.search-form-container');

            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    const isHidden = mobileMenu.classList.contains('hidden');
                    const ariaExpanded = this.getAttribute('aria-expanded') === 'true';

                    if (isHidden) {
                        mobileMenu.classList.remove('hidden');
                        mobileMenu.setAttribute('aria-hidden', 'false');
                        this.setAttribute('aria-expanded', 'true');
                    } else {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.setAttribute('aria-hidden', 'true');
                        this.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            if (searchToggle && searchForm) {
                searchToggle.addEventListener('click', function() {
                    const isHidden = searchForm.classList.contains('hidden');

                    if (isHidden) {
                        searchForm.classList.remove('hidden');
                        searchForm.querySelector('input[type="search"]').focus();
                    } else {
                        searchForm.classList.add('hidden');
                    }
                });
            }

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (mobileMenu && !mobileMenu.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.setAttribute('aria-hidden', 'true');
                    if (mobileMenuToggle) {
                        mobileMenuToggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });
    </script>

    <!-- Schema.org markup for website -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?php echo esc_attr(get_bloginfo('name')); ?>",
        "description": "<?php echo esc_attr(get_bloginfo('description')); ?>",
        "url": "<?php echo esc_attr(home_url('/')); ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo esc_attr(home_url('/?s={search_term_string}')); ?>",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
</body>
</html>