<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

get_header();
?>

<div class="error-404-container">
    <!-- Hero Section -->
    <section class="error-hero bg-gradient-to-br from-blue-50 to-indigo-100 py-16 lg:py-24">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-3xl mx-auto">
                <!-- 404 Icon -->
                <div class="error-icon mb-8">
                    <svg class="w-24 h-24 text-blue-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"></path>
                    </svg>
                </div>

                <!-- Error Message -->
                <h1 class="error-title text-4xl lg:text-6xl font-bold text-slate-800 mb-4">
                    404
                </h1>

                <h2 class="error-subtitle text-2xl lg:text-3xl font-semibold text-slate-700 mb-6">
                    <?php esc_html_e('Page Not Found', 'finance-theme'); ?>
                </h2>

                <p class="error-description text-lg text-slate-600 mb-8 leading-relaxed">
                    <?php esc_html_e('Sorry, we couldn\'t find the page you\'re looking for. The page may have been moved, deleted, or you entered the wrong URL.', 'finance-theme'); ?>
                </p>

                <!-- Search Form -->
                <div class="error-search max-w-md mx-auto mb-8">
                    <?php get_search_form(); ?>
                </div>

                <!-- Action Buttons -->
                <div class="error-actions flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <?php esc_html_e('Back to Home', 'finance-theme'); ?>
                    </a>

                    <button onclick="history.back()" class="inline-flex items-center px-6 py-3 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <?php esc_html_e('Go Back', 'finance-theme'); ?>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Section -->
    <section class="error-help py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h3 class="text-2xl font-bold text-slate-800 text-center mb-12">
                    <?php esc_html_e('How can we help you find what you\'re looking for?', 'finance-theme'); ?>
                </h3>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Popular Pages -->
                    <div class="help-item">
                        <div class="text-center">
                            <div class="icon mb-4">
                                <svg class="w-12 h-12 text-blue-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-slate-800 mb-2">
                                <?php esc_html_e('Popular Pages', 'finance-theme'); ?>
                            </h4>
                            <p class="text-slate-600 text-sm mb-4">
                                <?php esc_html_e('Check out our most visited pages for helpful information.', 'finance-theme'); ?>
                            </p>
                            <ul class="space-y-2 text-sm">
                                <?php
                                $popular_pages = get_pages(array(
                                    'sort_column' => 'post_date',
                                    'sort_order' => 'DESC',
                                    'number' => 5,
                                ));

                                foreach ($popular_pages as $page) :
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_permalink($page->ID)); ?>" class="text-blue-600 hover:text-blue-700">
                                            <?php echo esc_html($page->post_title); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="help-item">
                        <div class="text-center">
                            <div class="icon mb-4">
                                <svg class="w-12 h-12 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-slate-800 mb-2">
                                <?php esc_html_e('Recent Posts', 'finance-theme'); ?>
                            </h4>
                            <p class="text-slate-600 text-sm mb-4">
                                <?php esc_html_e('Browse our latest articles and updates.', 'finance-theme'); ?>
                            </p>
                            <ul class="space-y-2 text-sm">
                                <?php
                                $recent_posts = get_posts(array(
                                    'numberposts' => 5,
                                    'post_status' => 'publish',
                                ));

                                foreach ($recent_posts as $post) :
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="text-blue-600 hover:text-blue-700">
                                            <?php echo esc_html($post->post_title); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="help-item">
                        <div class="text-center">
                            <div class="icon mb-4">
                                <svg class="w-12 h-12 text-purple-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-slate-800 mb-2">
                                <?php esc_html_e('Categories', 'finance-theme'); ?>
                            </h4>
                            <p class="text-slate-600 text-sm mb-4">
                                <?php esc_html_e('Explore content by topic or category.', 'finance-theme'); ?>
                            </p>
                            <ul class="space-y-2 text-sm">
                                <?php
                                $categories = get_categories(array(
                                    'number' => 6,
                                    'orderby' => 'count',
                                    'order' => 'DESC',
                                ));

                                foreach ($categories as $category) :
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="text-blue-600 hover:text-blue-700">
                                            <?php echo esc_html($category->name); ?>
                                            <span class="text-slate-500">(<?php echo $category->count; ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="error-contact bg-slate-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold text-slate-800 mb-4">
                    <?php esc_html_e('Still can\'t find what you\'re looking for?', 'finance-theme'); ?>
                </h3>

                <p class="text-slate-600 mb-8">
                    <?php esc_html_e('If you believe this is an error or need further assistance, please don\'t hesitate to contact us.', 'finance-theme'); ?>
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <?php if (get_theme_mod('contact_email')) : ?>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email')); ?>" class="inline-flex items-center px-6 py-3 bg-slate-600 text-white font-medium rounded-lg hover:bg-slate-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <?php esc_html_e('Email Us', 'finance-theme'); ?>
                        </a>
                    <?php endif; ?>

                    <?php if (get_theme_mod('contact_phone')) : ?>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone')); ?>" class="inline-flex items-center px-6 py-3 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <?php esc_html_e('Call Us', 'finance-theme'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Additional styles for 404 page */
.error-404-container {
    min-height: 100vh;
}

.error-hero {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0e7ff 100%);
}

.error-search form {
    max-width: 400px;
    margin: 0 auto;
}

.error-search input[type="search"] {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.error-search input[type="search"]:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.help-item {
    padding: 24px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.help-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .error-actions {
        flex-direction: column;
        align-items: center;
    }

    .error-actions a {
        width: 100%;
        max-width: 200px;
        justify-content: center;
    }
}
</style>

<?php
get_footer();