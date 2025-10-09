<?php
/**
 * The template for displaying archive pages
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
            <?php if (have_posts()) : ?>
                <!-- Archive Header -->
                <header class="archive-header mb-8">
                    <?php
                    $archive_title = '';
                    $archive_description = '';

                    if (is_category()) :
                        $category = get_queried_object();
                        $archive_title = single_cat_title('', false);
                        $archive_description = get_the_archive_description();
                    elseif (is_tag()) :
                        $tag = get_queried_object();
                        $archive_title = single_tag_title('', false);
                        $archive_description = get_the_archive_description();
                    elseif (is_author()) :
                        $author = get_queried_object();
                        $archive_title = get_the_author();
                        $archive_description = get_the_author_meta('description');
                    elseif (is_date()) :
                        if (is_year()) :
                            $archive_title = sprintf(esc_html__('Year: %s', 'finance-theme'), get_the_date('Y'));
                        elseif (is_month()) :
                            $archive_title = sprintf(esc_html__('Month: %s', 'finance-theme'), get_the_date('F Y'));
                        elseif (is_day()) :
                            $archive_title = sprintf(esc_html__('Day: %s', 'finance-theme'), get_the_date('F j, Y'));
                        endif;
                    elseif (is_post_type_archive()) :
                        $archive_title = post_type_archive_title('', false);
                        $archive_description = get_the_post_type_description();
                    elseif (is_tax()) :
                        $term = get_queried_object();
                        $archive_title = single_term_title('', false);
                        $archive_description = get_the_archive_description();
                    else :
                        $archive_title = esc_html__('Archive', 'finance-theme');
                    endif;
                    ?>

                    <h1 class="archive-title text-3xl lg:text-4xl font-bold text-slate-800 mb-4">
                        <?php echo wp_kses_post($archive_title); ?>
                    </h1>

                    <?php if ($archive_description) : ?>
                        <div class="archive-description text-lg text-slate-600 leading-relaxed mb-6 p-4 bg-slate-50 rounded-lg border-l-4 border-blue-500">
                            <?php echo wp_kses_post(wpautop($archive_description)); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Archive Meta -->
                    <div class="archive-meta flex items-center text-sm text-slate-500 mb-6">
                        <?php
                        $post_count = $wp_query->found_posts;
                        printf(
                            esc_html(_n('%s post', '%s posts', $post_count, 'finance-theme')),
                            number_format_i18n($post_count)
                        );
                        ?>
                    </div>

                    <!-- Archive Navigation (for categories/tags) -->
                    <?php if (is_category() || is_tag()) : ?>
                        <div class="archive-navigation mb-6">
                            <?php
                            $term_id = get_queried_object_id();
                            $taxonomy_name = get_queried_object()->taxonomy;

                            $prev_link = get_previous_posts_link(__('← Newer Posts', 'finance-theme'));
                            $next_link = get_next_posts_link(__('Older Posts →', 'finance-theme'));

                            if ($prev_link || $next_link) :
                                ?>
                                <nav class="archive-pagination flex justify-between items-center p-4 bg-white rounded-lg shadow-sm border border-slate-200" role="navigation" aria-label="<?php esc_attr_e('Archive Navigation', 'finance-theme'); ?>">
                                    <?php if ($prev_link) : ?>
                                        <div class="archive-nav-prev">
                                            <?php echo $prev_link; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($next_link) : ?>
                                        <div class="archive-nav-next">
                                            <?php echo $next_link; ?>
                                        </div>
                                    <?php endif; ?>
                                </nav>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Posts Grid -->
                <div class="posts-grid grid gap-6 md:grid-cols-2">
                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article <?php post_class('post-card bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail aspect-video overflow-hidden">
                                    <a href="<?php the_permalink(); ?>" class="block">
                                        <?php the_post_thumbnail('finance-medium', array(
                                            'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300',
                                            'alt' => get_the_title()
                                        )); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content p-6">
                                <header class="post-header mb-4">
                                    <!-- Post Categories/Tags -->
                                    <?php if (is_category() || is_tag() || is_tax()) : ?>
                                        <div class="post-terms mb-2">
                                            <?php
                                            $terms = get_the_terms(get_the_ID(), is_category() ? 'category' : (is_tag() ? 'post_tag' : get_queried_object()->taxonomy));
                                            if ($terms && !is_wp_error($terms)) :
                                                ?>
                                                <div class="flex flex-wrap gap-2">
                                                    <?php foreach ($terms as $term) : ?>
                                                        <a href="<?php echo esc_url(get_term_link($term)); ?>"
                                                           class="post-term inline-flex items-center px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded-full hover:bg-blue-100 hover:text-blue-800 transition-colors">
                                                            <?php echo esc_html($term->name); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Post Title -->
                                    <h2 class="post-title text-xl font-semibold text-slate-800 mb-2">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <!-- Post Meta -->
                                    <div class="post-meta flex items-center text-sm text-slate-500">
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(get_the_date()); ?>
                                        </time>
                                        <span class="mx-2">•</span>
                                        <span><?php echo esc_html(get_the_author()); ?></span>
                                        <?php if (function_exists('the_views')) : ?>
                                            <span class="mx-2">•</span>
                                            <span><?php the_views(); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </header>

                                <div class="post-excerpt text-slate-600 mb-4">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="post-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-link text-blue-600 hover:text-blue-700 font-medium text-sm">
                                        <?php esc_html_e('Read More', 'finance-theme'); ?>
                                        <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </footer>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <!-- Archive Pagination -->
                <?php
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

                echo '<nav class="archive-pagination mt-12" role="navigation" aria-label="' . esc_attr__('Archive Navigation', 'finance-theme') . '">';
                echo paginate_links($pagination_args);
                echo '</nav>';
                ?>

            <?php else : ?>
                <!-- No Posts Found -->
                <section class="no-posts-found text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg class="w-24 h-24 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"></path>
                        </svg>

                        <h2 class="text-2xl font-bold text-slate-800 mb-4">
                            <?php esc_html_e('No Posts Found', 'finance-theme'); ?>
                        </h2>

                        <p class="text-slate-600 mb-8">
                            <?php esc_html_e('No posts were found in this archive. Try searching for something else.', 'finance-theme'); ?>
                        </p>

                        <?php get_search_form(); ?>
                    </div>
                </section>
            <?php endif; ?>
        </main>

        <!-- Archive Sidebar -->
        <aside class="sidebar lg:w-1/3">
            <?php get_sidebar('archive'); ?>
        </aside>
    </div>
</div>

<?php
get_footer();