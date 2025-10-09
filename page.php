<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
                    <!-- Page Header -->
                    <header class="page-header p-6 lg:p-8 border-b border-slate-200">
                        <!-- Page Title -->
                        <h1 class="page-title text-3xl lg:text-4xl font-bold text-slate-800 mb-4 leading-tight">
                            <?php the_title(); ?>
                        </h1>

                        <!-- Page Meta -->
                        <div class="page-meta flex items-center text-sm text-slate-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php printf(esc_html__('Published %s', 'finance-theme'), get_the_date()); ?>
                                </time>
                            </div>

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
                        </div>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail() && !get_post_meta(get_the_ID(), '_hide_featured_image', true)) : ?>
                            <div class="page-thumbnail mt-6">
                                <?php the_post_thumbnail('finance-large', array(
                                    'class' => 'w-full h-auto rounded-lg',
                                    'alt' => get_the_title()
                                )); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <!-- Page Content -->
                    <div class="page-content prose prose-lg max-w-none p-6 lg:p-8">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'finance-theme'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <!-- Page Footer -->
                    <?php if (get_edit_post_link()) : ?>
                        <footer class="page-footer p-6 lg:p-8 border-t border-slate-200 bg-slate-50">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="page-edit mb-4 sm:mb-0">
                                    <?php
                                    edit_post_link(
                                        sprintf(
                                            wp_kses(
                                                /* translators: %s: Name of current post. Only visible to screen readers */
                                                __('Edit <span class="sr-only">%s</span>', 'finance-theme'),
                                                array(
                                                    'span' => array(
                                                        'class' => array(),
                                                    ),
                                                )
                                            ),
                                            get_the_title()
                                        ),
                                        '<span class="edit-link inline-flex items-center px-3 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition-colors">',
                                        '</span>',
                                        '',
                                        'edit-link'
                                    );
                                    ?>
                                </div>

                                <!-- Page Hierarchy -->
                                <div class="page-hierarchy text-sm text-slate-600">
                                    <?php
                                    $parent_id = wp_get_post_parent_id(get_the_ID());
                                    if ($parent_id) :
                                        $parent = get_post($parent_id);
                                        ?>
                                        <span><?php esc_html_e('Parent:', 'finance-theme'); ?></span>
                                        <a href="<?php echo esc_url(get_permalink($parent)); ?>" class="text-blue-600 hover:text-blue-700">
                                            <?php echo esc_html(get_the_title($parent)); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php
                                    $child_pages = wp_list_pages(array(
                                        'title_li' => '',
                                        'child_of' => get_the_ID(),
                                        'echo' => false,
                                        'depth' => 1,
                                    ));

                                    if ($child_pages) :
                                        ?>
                                        <?php if ($parent_id) echo ' • '; ?>
                                        <span><?php esc_html_e('Child pages:', 'finance-theme'); ?></span>
                                        <div class="child-pages inline">
                                            <?php echo $child_pages; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </footer>
                    <?php endif; ?>
                </article>

                <!-- Comments (if enabled for this page) -->
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    ?>
                    <div class="page-comments mt-8">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
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