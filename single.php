<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Finance_Theme
 * @since 1.0.0
 */

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <main class="main-content lg:w-2/3">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden'); ?>>
                    <!-- Post Header -->
                    <header class="post-header p-6 lg:p-8 border-b border-slate-200">
                        <!-- Post Categories -->
                        <?php if (get_the_category_list(', ')) : ?>
                            <div class="post-categories mb-4">
                                <?php echo get_the_category_list(', '); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Post Title -->
                        <h1 class="post-title text-3xl lg:text-4xl font-bold text-slate-800 mb-4 leading-tight">
                            <?php the_title(); ?>
                        </h1>

                        <!-- Post Meta -->
                        <div class="post-meta flex flex-wrap items-center text-sm text-slate-600 mb-6">
                            <div class="flex items-center mb-2 lg:mb-0">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date()); ?>
                                </time>
                            </div>

                            <span class="mx-2 text-slate-400">•</span>

                            <div class="flex items-center mb-2 lg:mb-0">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span><?php echo esc_html(get_the_author()); ?></span>
                            </div>

                            <?php if (function_exists('the_views')) : ?>
                                <span class="mx-2 text-slate-400">•</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <?php the_views(); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (get_the_time('U') !== get_the_modified_time('U')) : ?>
                                <span class="mx-2 text-slate-400">•</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    <time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>">
                                        <?php printf(esc_html__('Updated %s', 'finance-theme'), get_the_modified_date()); ?>
                                    </time>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail mb-6">
                                <?php the_post_thumbnail('finance-large', array(
                                    'class' => 'w-full h-auto rounded-lg',
                                    'alt' => get_the_title()
                                )); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <!-- Post Content -->
                    <div class="post-content prose prose-lg max-w-none p-6 lg:p-8">
                        <?php
                        the_content(sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Continue reading<span class="sr-only"> "%s"</span>', 'finance-theme'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ));

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'finance-theme'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <!-- Post Footer -->
                    <footer class="post-footer p-6 lg:p-8 border-t border-slate-200">
                        <!-- Tags -->
                        <?php if (get_the_tag_list()) : ?>
                            <div class="post-tags mb-6">
                                <h3 class="text-sm font-medium text-slate-700 mb-2"><?php esc_html_e('Tags:', 'finance-theme'); ?></h3>
                                <?php echo get_the_tag_list('', ', '); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Share Links -->
                        <div class="post-share">
                            <h3 class="text-sm font-medium text-slate-700 mb-3"><?php esc_html_e('Share this post:', 'finance-theme'); ?></h3>
                            <div class="share-links flex space-x-4">
                                <a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . get_the_title() . '&url=' . get_permalink()); ?>"
                                   class="share-link share-twitter inline-flex items-center px-3 py-2 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition-colors"
                                   target="_blank" rel="noopener noreferrer">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                    Twitter
                                </a>

                                <a href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u=' . get_permalink()); ?>"
                                   class="share-link share-facebook inline-flex items-center px-3 py-2 bg-blue-700 text-white text-sm rounded-lg hover:bg-blue-800 transition-colors"
                                   target="_blank" rel="noopener noreferrer">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    Facebook
                                </a>

                                <a href="<?php echo esc_url('https://www.linkedin.com/sharing/share-offsite/?url=' . get_permalink()); ?>"
                                   class="share-link share-linkedin inline-flex items-center px-3 py-2 bg-blue-800 text-white text-sm rounded-lg hover:bg-blue-900 transition-colors"
                                   target="_blank" rel="noopener noreferrer">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    </footer>
                </article>

                <!-- Post Navigation -->
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();

                if ($prev_post || $next_post) :
                    ?>
                    <nav class="post-navigation mt-8 p-6 bg-white rounded-lg shadow-sm border border-slate-200" role="navigation" aria-label="<?php esc_attr_e('Post Navigation', 'finance-theme'); ?>">
                        <div class="flex justify-between items-center">
                            <?php if ($prev_post) : ?>
                                <div class="post-nav-prev">
                                    <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="inline-flex items-center text-slate-600 hover:text-blue-600 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        <div>
                                            <span class="block text-xs text-slate-500 uppercase tracking-wide"><?php esc_html_e('Previous Post', 'finance-theme'); ?></span>
                                            <span class="block font-medium"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($next_post) : ?>
                                <div class="post-nav-next">
                                    <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="inline-flex items-center text-slate-600 hover:text-blue-600 transition-colors">
                                        <div class="text-right">
                                            <span class="block text-xs text-slate-500 uppercase tracking-wide"><?php esc_html_e('Next Post', 'finance-theme'); ?></span>
                                            <span class="block font-medium"><?php echo esc_html(get_the_title($next_post)); ?></span>
                                        </div>
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </nav>
                <?php endif; ?>

                <!-- Author Bio -->
                <?php if (get_the_author_meta('description')) : ?>
                    <div class="author-bio mt-8 p-6 bg-slate-50 rounded-lg border border-slate-200">
                        <div class="flex items-start space-x-4">
                            <div class="author-avatar flex-shrink-0">
                                <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-full')); ?>
                            </div>
                            <div class="author-info">
                                <h3 class="text-lg font-semibold text-slate-800 mb-2">
                                    <?php echo esc_html(get_the_author()); ?>
                                </h3>
                                <p class="text-slate-600 text-sm leading-relaxed">
                                    <?php echo wp_kses_post(get_the_author_meta('description')); ?>
                                </p>
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="inline-flex items-center mt-3 text-blue-600 hover:text-blue-700 font-medium text-sm">
                                    <?php printf(esc_html__('View all posts by %s', 'finance-theme'), get_the_author()); ?>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Comments -->
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            <?php endwhile; ?>
        </main>

        <!-- Sidebar -->
        <aside class="sidebar lg:w-1/3">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php
get_footer();