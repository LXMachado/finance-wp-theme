<?php
/**
 * Finance Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Finance Theme version
 */
define('FINANCE_THEME_VERSION', '1.0.0');

/**
 * Theme setup
 */
function finance_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Set default thumbnail size
    set_post_thumbnail_size(300, 300, true);

    // Add additional image sizes
    add_image_size('finance-large', 1200, 800, true);
    add_image_size('finance-medium', 800, 600, true);

    // This theme uses wp_nav_menu() in multiple locations
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'finance-theme'),
        'footer' => esc_html__('Footer Menu', 'finance-theme'),
    ));

    // Switch default core markup for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('dist/css/main.css');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Add support for editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name' => esc_html__('Primary Blue', 'finance-theme'),
            'color' => '#1e40af',
            'slug' => 'primary-blue',
        ),
        array(
            'name' => esc_html__('Secondary Teal', 'finance-theme'),
            'color' => '#0d9488',
            'slug' => 'secondary-teal',
        ),
        array(
            'name' => esc_html__('Accent Green', 'finance-theme'),
            'color' => '#16a34a',
            'slug' => 'accent-green',
        ),
        array(
            'name' => esc_html__('Dark Slate', 'finance-theme'),
            'color' => '#1e293b',
            'slug' => 'dark-slate',
        ),
        array(
            'name' => esc_html__('Light Gray', 'finance-theme'),
            'color' => '#f8fafc',
            'slug' => 'light-gray',
        ),
    ));

    // Add support for editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'finance-theme'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Medium', 'finance-theme'),
            'size' => 16,
            'slug' => 'medium'
        ),
        array(
            'name' => esc_html__('Large', 'finance-theme'),
            'size' => 18,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Extra Large', 'finance-theme'),
            'size' => 20,
            'slug' => 'x-large'
        ),
    ));

    // Enqueue editor styles
    add_editor_style('dist/css/main.css');
}
add_action('after_setup_theme', 'finance_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 */
function finance_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters('finance_theme_content_width', 840);
}
add_action('after_setup_theme', 'finance_theme_content_width', 0);

/**
 * Register widget area
 */
function finance_theme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'finance-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'finance-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widgets', 'finance-theme'),
        'id'            => 'footer-widgets',
        'description'   => esc_html__('Add footer widgets here.', 'finance-theme'),
        'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'finance_theme_widgets_init');

/**
 * Enqueue scripts and styles
 */
function finance_theme_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('finance-theme-style', get_stylesheet_uri(), array(), FINANCE_THEME_VERSION);

    // Check if built CSS file exists, otherwise use fallback
    $built_css = get_template_directory() . '/dist/main.css';
    $fallback_css = get_template_directory() . '/assets/fallback.css';

    if (file_exists($built_css)) {
        wp_enqueue_style('finance-theme-tailwind', get_template_directory_uri() . '/dist/main.css', array('finance-theme-style'), FINANCE_THEME_VERSION);
    } elseif (file_exists($fallback_css)) {
        wp_enqueue_style('finance-theme-fallback', get_template_directory_uri() . '/assets/fallback.css', array('finance-theme-style'), FINANCE_THEME_VERSION);
    }

    // Check if built JS file exists, otherwise use fallback
    $built_js = get_template_directory() . '/dist/main.js';
    $fallback_js = get_template_directory() . '/assets/fallback.js';

    if (file_exists($built_js)) {
        wp_enqueue_script('finance-theme-script', get_template_directory_uri() . '/dist/main.js', array('jquery'), FINANCE_THEME_VERSION, true);
    } elseif (file_exists($fallback_js)) {
        wp_enqueue_script('finance-theme-fallback', get_template_directory_uri() . '/assets/fallback.js', array(), FINANCE_THEME_VERSION, true);
    }

    // Enqueue comment reply script on single posts/pages with comments open
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Localize script for AJAX and theme variables (only if main script exists)
    if (file_exists($built_js)) {
        wp_localize_script('finance-theme-script', 'financeTheme', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('finance_theme_nonce'),
            'strings' => array(
                'menuToggle' => esc_html__('Toggle menu', 'finance-theme'),
                'menuClose' => esc_html__('Close menu', 'finance-theme'),
            ),
        ));
    }
}
add_action('wp_enqueue_scripts', 'finance_theme_scripts');

/**
 * Enqueue block editor styles
 */
function finance_theme_block_editor_styles() {
    // Check if built CSS file exists, otherwise use fallback
    $built_css = get_template_directory() . '/dist/css/main.css';
    $fallback_css = get_template_directory() . '/assets/fallback.css';

    if (file_exists($built_css)) {
        wp_enqueue_style('finance-theme-block-editor-styles', get_template_directory_uri() . '/dist/css/main.css', array(), FINANCE_THEME_VERSION);
    } elseif (file_exists($fallback_css)) {
        wp_enqueue_style('finance-theme-block-editor-fallback', get_template_directory_uri() . '/assets/fallback.css', array(), FINANCE_THEME_VERSION);
    }
}
add_action('enqueue_block_editor_assets', 'finance_theme_block_editor_styles');

/**
 * Custom excerpt length
 */
function finance_theme_excerpt_length($length) {
    if (is_admin()) {
        return $length;
    }
    return 25;
}
add_filter('excerpt_length', 'finance_theme_excerpt_length', 999);

/**
 * Custom excerpt more text
 */
function finance_theme_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    return '...';
}
add_filter('excerpt_more', 'finance_theme_excerpt_more');

/**
 * Custom read more link
 */
function finance_theme_read_more_link() {
    return '<a href="' . get_permalink() . '" class="read-more-link">Read More</a>';
}
add_filter('the_content_more_link', 'finance_theme_read_more_link');

/**
 * Add custom classes to body
 */
function finance_theme_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }

    // Add class for multi-author blogs
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter('body_class', 'finance_theme_body_classes');

/**
 * Add custom header classes
 */
function finance_theme_header_classes() {
    $classes = array('site-header');

    if (has_custom_logo()) {
        $classes[] = 'has-logo';
    }

    return implode(' ', $classes);
}

/**
 * Add custom footer classes
 */
function finance_theme_footer_classes() {
    $classes = array('site-footer');

    if (is_active_sidebar('footer-widgets')) {
        $classes[] = 'has-footer-widgets';
    }

    return implode(' ', $classes);
}

/**
 * Navigation menu fallback
 */
function finance_theme_primary_menu_fallback() {
    echo '<ul class="primary-menu-fallback">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'finance-theme') . '</a></li>';
    wp_list_pages(array(
        'title_li' => '',
        'depth' => 1,
        'number' => 5,
    ));
    echo '</ul>';
}

/**
 * Get post meta with default fallback
 */
function finance_theme_get_post_meta($post_id, $key, $default = '') {
    $value = get_post_meta($post_id, $key, true);
    return !empty($value) ? $value : $default;
}

/**
 * Sanitize HTML content
 */
function finance_theme_sanitize_html($input) {
    return wp_kses_post($input);
}

/**
 * Sanitize text content
 */
function finance_theme_sanitize_text($input) {
    return sanitize_text_field($input);
}

/**
 * Customizer additions
 */
function finance_theme_customize_register($wp_customize) {
    // Add theme options panel
    $wp_customize->add_panel('finance_theme_options', array(
        'title' => esc_html__('Theme Options', 'finance-theme'),
        'priority' => 30,
    ));

    // Add footer text section
    $wp_customize->add_section('finance_theme_footer', array(
        'title' => esc_html__('Footer', 'finance-theme'),
        'panel' => 'finance_theme_options',
    ));

    // Footer copyright text
    $wp_customize->add_setting('footer_copyright', array(
        'default' => '',
        'sanitize_callback' => 'finance_theme_sanitize_html',
    ));

    $wp_customize->add_control('footer_copyright', array(
        'label' => esc_html__('Copyright Text', 'finance-theme'),
        'section' => 'finance_theme_footer',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'finance_theme_customize_register');

/**
 * Get footer copyright text
 */
function finance_theme_get_footer_copyright() {
    $copyright = get_theme_mod('footer_copyright', '');
    if (empty($copyright)) {
        $copyright = sprintf(
            esc_html__('© %s Finance Theme. All rights reserved.', 'finance-theme'),
            date('Y')
        );
    }
    return $copyright;
}

/**
 * Add schema markup for articles
 */
function finance_theme_article_schema() {
    if (is_single() && is_main_query()) {
        global $post;
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
            ),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
        );

        if (has_post_thumbnail()) {
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            $schema['image'] = $image_url;
        }

        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'finance_theme_article_schema');

/**
 * Security enhancements
 */
// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Remove RSD link
remove_action('wp_head', 'rsd_link');

// Remove Windows Live Writer
remove_action('wp_head', 'wlwmanifest_link');

// Remove shortlink
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/**
 * Performance optimizations
 */
// Remove query strings from static resources
function finance_theme_remove_query_strings($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'finance_theme_remove_query_strings', 10, 2);
add_filter('script_loader_src', 'finance_theme_remove_query_strings', 10, 2);

// Defer JavaScript loading
function finance_theme_defer_scripts($tag, $handle, $src) {
    // Skip if we're in the admin or if the script should not be deferred
    if (is_admin() || in_array($handle, array('jquery', 'jquery-core', 'jquery-migrate'))) {
        return $tag;
    }

    return str_replace('<script ', '<script defer ', $tag);
}
add_filter('script_loader_tag', 'finance_theme_defer_scripts', 10, 3);

/**
 * Block patterns and template parts
 */
function finance_theme_register_patterns() {
    // Register block patterns category
    register_block_pattern_category('finance-theme', array(
        'label' => esc_html__('Finance Theme', 'finance-theme'),
    ));
}
add_action('init', 'finance_theme_register_patterns');

/**
 * TailwindCSS build process integration
 * This function checks if the built files exist and provides feedback
 */
function finance_theme_check_build_files() {
    $css_file = get_template_directory() . '/dist/main.css';
    $js_file = get_template_directory() . '/dist/main.js';
    $fallback_css = get_template_directory() . '/assets/fallback.css';
    $fallback_js = get_template_directory() . '/assets/fallback.js';

    // Only show notice if neither built files nor fallbacks exist
    if ((!file_exists($css_file) && !file_exists($fallback_css)) ||
        (!file_exists($js_file) && !file_exists($fallback_js))) {
        add_action('admin_notices', 'finance_theme_build_notice');
    }
}

/**
 * Admin notice for missing build files
 */
function finance_theme_build_notice() {
    $css_file = get_template_directory() . '/dist/main.css';
    $js_file = get_template_directory() . '/dist/main.js';
    $fallback_css = get_template_directory() . '/assets/fallback.css';
    $fallback_js = get_template_directory() . '/assets/fallback.js';

    $missing_css = !file_exists($css_file) && !file_exists($fallback_css);
    $missing_js = !file_exists($js_file) && !file_exists($fallback_js);

    if ($missing_css || $missing_js) {
        $message = esc_html__('Finance Theme: Some assets are missing. ', 'finance-theme');

        if ($missing_css && $missing_js) {
            $message .= esc_html__('Please run "npm run build" to generate optimized CSS and JS files, or ensure fallback files exist in assets/ directory.', 'finance-theme');
        } elseif ($missing_css) {
            $message .= esc_html__('Please run "npm run build" to generate optimized CSS, or ensure fallback.css exists in assets/ directory.', 'finance-theme');
        } elseif ($missing_js) {
            $message .= esc_html__('Please run "npm run build" to generate optimized JavaScript, or ensure fallback.js exists in assets/ directory.', 'finance-theme');
        }

        ?>
        <div class="notice notice-info is-dismissible">
            <p><?php echo $message; ?></p>
        </div>
        <?php
    }
}

// Check build files on admin init
add_action('admin_init', 'finance_theme_check_build_files');

/**
 * Theme information page
 */
function finance_theme_add_theme_info_page() {
    add_theme_page(
        esc_html__('Theme Info', 'finance-theme'),
        esc_html__('Theme Info', 'finance-theme'),
        'manage_options',
        'finance-theme-info',
        'finance_theme_info_page'
    );
}
add_action('admin_menu', 'finance_theme_add_theme_info_page');

/**
 * Theme info page callback
 */
function finance_theme_info_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Finance Theme Information', 'finance-theme'); ?></h1>
        <p><?php esc_html_e('Version:', 'finance-theme'); ?> <?php echo esc_html(FINANCE_THEME_VERSION); ?></p>
        <p><?php esc_html_e('A modern WordPress block theme with TailwindCSS integration.', 'finance-theme'); ?></p>

        <h2><?php esc_html_e('Build Process', 'finance-theme'); ?></h2>
        <p><?php esc_html_e('This theme uses TailwindCSS with Webpack for asset processing.', 'finance-theme'); ?></p>
        <p><code>npm install</code> - <?php esc_html_e('Install dependencies', 'finance-theme'); ?></p>
        <p><code>npm run dev</code> - <?php esc_html_e('Development build with watch mode', 'finance-theme'); ?></p>
        <p><code>npm run build</code> - <?php esc_html_e('Production build', 'finance-theme'); ?></p>

        <h2><?php esc_html_e('Features', 'finance-theme'); ?></h2>
        <ul>
            <li><?php esc_html_e('Block editor support', 'finance-theme'); ?></li>
            <li><?php esc_html_e('TailwindCSS integration', 'finance-theme'); ?></li>
            <li><?php esc_html_e('Responsive design', 'finance-theme'); ?></li>
            <li><?php esc_html_e('Custom color palette', 'finance-theme'); ?></li>
            <li><?php esc_html_e('Navigation menus', 'finance-theme'); ?></li>
            <li><?php esc_html_e('Widget areas', 'finance-theme'); ?></li>
        </ul>
    </div>
    <?php
}