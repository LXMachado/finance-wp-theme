<?php
/**
 * The header for Finance Theme
 *
 * This is the template that displays all of the <head> section and everything up until <main>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-slate-900 antialiased'); ?>>
<?php wp_body_open(); ?>

<!-- Skip Links for Accessibility -->
<a class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded z-50" href="#main">
    <?php esc_html_e('Skip to content', 'finance-theme'); ?>
</a>

<header class="<?php echo esc_attr(finance_theme_header_classes()); ?>">
    <div class="container mx-auto px-4">
        <!-- Top Bar (Optional) -->
        <?php if (is_active_sidebar('top-bar')) : ?>
            <div class="top-bar bg-slate-50 border-b border-slate-200 py-2">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-4">
                        <?php dynamic_sidebar('top-bar'); ?>
                    </div>
                    <?php if (function_exists('wpml_get_active_languages')) : ?>
                        <div class="language-switcher">
                            <?php do_action('wpml_language_switcher'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Main Header -->
        <div class="main-header py-4 lg:py-6">
            <div class="flex items-center justify-between">
                <!-- Site Branding -->
                <div class="site-branding flex items-center">
                    <?php
                    // Custom logo
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo_class = 'site-logo';

                    if ($custom_logo_id) {
                        $logo_class .= ' has-logo';
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link flex items-center" rel="home">
                            <?php
                            echo wp_get_attachment_image(
                                $custom_logo_id,
                                'full',
                                false,
                                array(
                                    'class' => 'logo-image max-h-10 w-auto',
                                    'alt' => get_bloginfo('name') . ' ' . esc_attr__('Logo', 'finance-theme'),
                                )
                            );
                            ?>
                        </a>
                        <?php
                    }

                    // Site title and tagline
                    if (!has_custom_logo() || is_customize_preview()) :
                        ?>
                        <div class="site-title-wrap">
                            <?php if (is_front_page() && is_home()) : ?>
                                <h1 class="site-title text-xl lg:text-2xl font-bold text-slate-800">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="hover:text-blue-600 transition-colors">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title text-xl lg:text-2xl font-bold text-slate-800">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="hover:text-blue-600 transition-colors">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </p>
                            <?php endif; ?>

                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) :
                                ?>
                                <p class="site-description text-sm text-slate-600 mt-1">
                                    <?php echo $description; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Navigation -->
                <nav class="main-navigation <?php echo esc_attr(finance_theme_header_classes()); ?>" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'finance-theme'); ?>">
                    <?php
                    // Primary menu
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'primary-menu flex items-center space-x-8',
                        'container'      => 'ul',
                        'container_class' => 'primary-menu-container',
                        'depth'          => 3,
                        'fallback_cb'    => 'finance_theme_primary_menu_fallback',
                    ));
                    ?>

                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle lg:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors" aria-controls="primary-menu" aria-expanded="false">
                        <span class="sr-only"><?php esc_html_e('Toggle mobile menu', 'finance-theme'); ?></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </nav>

                <!-- Header Actions (Search, Social, etc.) -->
                <div class="header-actions hidden lg:flex items-center space-x-4">
                    <?php
                    // Search toggle
                    if (function_exists('get_search_form')) :
                        ?>
                        <button class="search-toggle p-2 rounded-lg hover:bg-slate-100 transition-colors" aria-label="<?php esc_attr_e('Toggle search', 'finance-theme'); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    <?php endif; ?>

                    <?php
                    // Social links or additional actions
                    if (has_nav_menu('social') || is_active_sidebar('header-actions')) :
                        ?>
                        <div class="header-extras flex items-center space-x-2">
                            <?php
                            // Social menu
                            wp_nav_menu(array(
                                'theme_location' => 'social',
                                'menu_class'     => 'social-menu flex items-center space-x-2',
                                'container'      => 'ul',
                                'depth'          => 1,
                                'link_before'    => '<span class="sr-only">',
                                'link_after'     => '</span>',
                            ));

                            // Header actions widget area
                            dynamic_sidebar('header-actions');
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Search Form (Initially Hidden) -->
        <div class="search-form-container hidden" role="search" aria-label="<?php esc_attr_e('Site Search', 'finance-theme'); ?>">
            <div class="py-4 border-t border-slate-200">
                <?php get_search_form(); ?>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu lg:hidden hidden" aria-hidden="true">
            <div class="py-4 border-t border-slate-200">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'mobile-menu-list space-y-2',
                    'container'      => 'nav',
                    'container_class' => 'mobile-menu-nav',
                    'depth'          => 3,
                    'fallback_cb'    => 'finance_theme_primary_menu_fallback',
                ));
                ?>

                <!-- Mobile Header Actions -->
                <div class="mobile-header-actions mt-6 pt-4 border-t border-slate-200">
                    <?php get_search_form(); ?>

                    <?php if (has_nav_menu('social')) : ?>
                        <div class="mobile-social mt-4">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'social',
                                'menu_class'     => 'mobile-social-menu flex items-center space-x-4',
                                'container'      => 'ul',
                                'depth'          => 1,
                                'link_before'    => '<span class="sr-only">',
                                'link_after'     => '</span>',
                            ));
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<main id="main" class="site-main">