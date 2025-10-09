<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

get_header();
?>

<main class="site-main">
    <?php if (is_home() && is_front_page()) : ?>
        <section class="hero-section">
            <div class="container mx-auto px-4 py-16">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-slate-800 mb-6">
                        <?php bloginfo('name'); ?>
                    </h1>
                    <p class="text-xl text-slate-600 mb-8 leading-relaxed">
                        <?php bloginfo('description'); ?>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#posts" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Explore Posts
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="inline-flex items-center px-6 py-3 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                            All Posts
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <div id="posts" class="container mx-auto px-4 py-8">
        <?php if (is_home() && is_front_page()) : ?>
            <div class="max-w-2xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-800 mb-4">Latest Posts</h2>
                <p class="text-slate-600">Stay updated with our latest articles and insights</p>
            </div>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article <?php post_class('bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-video overflow-hidden">
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <?php the_post_thumbnail('finance-medium', array('class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300')); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <header class="mb-4">
                                <div class="flex items-center text-sm text-slate-500 mb-2">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>
                                    <span class="mx-2">•</span>
                                    <span><?php echo esc_html(get_the_author()); ?></span>
                                </div>

                                <h2 class="text-xl font-semibold text-slate-800 mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                            </header>

                            <div class="text-slate-600 mb-4 line-clamp-3">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="flex items-center justify-between">
                                <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                    Read More →
                                </a>

                                <?php if (function_exists('the_views')) : ?>
                                    <span class="text-xs text-slate-500">
                                        <?php the_views(); ?>
                                    </span>
                                <?php endif; ?>
                            </footer>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <?php
            // Custom pagination
            $pagination_args = array(
                'mid_size' => 2,
                'prev_text' => sprintf(
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg> %s',
                    esc_html__('Previous', 'finance-theme')
                ),
                'next_text' => sprintf(
                    '%s <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
                    esc_html__('Next', 'finance-theme')
                ),
            );

            echo '<nav class="pagination mt-12" role="navigation" aria-label="' . esc_attr__('Posts Navigation', 'finance-theme') . '">';
            echo paginate_links($pagination_args);
            echo '</nav>';
            ?>

        <?php else : ?>
            <section class="no-results not-found text-center py-16">
                <div class="max-w-md mx-auto">
                    <svg class="w-24 h-24 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"></path>
                    </svg>

                    <h2 class="text-2xl font-bold text-slate-800 mb-4">
                        <?php esc_html_e('Nothing Found', 'finance-theme'); ?>
                    </h2>

                    <p class="text-slate-600 mb-8">
                        <?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'finance-theme'); ?>
                    </p>

                    <?php get_search_form(); ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();