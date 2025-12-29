<?php
/**
 * The template for displaying single posts
 *
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php
    while (have_posts()) :
        the_post();
    ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <?php get_template_part('template-parts/page/page-header'); ?>

            <div class="container py-12">
                <div class="max-w-4xl mx-auto">
                    
                    <?php if (has_post_thumbnail() && !get_theme_mod('blaze_show_thumbnail_in_header', true)) : ?>
                        <div class="mb-12 rounded-2xl overflow-hidden shadow-xl">
                            <?php the_post_thumbnail('full', array('class' => 'w-full')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    wp_link_pages(array(
                        'before'      => '<div class="page-links mt-8 flex flex-wrap gap-2">' . esc_html__('Pages:', 'blaze'),
                        'after'       => '</div>',
                        'link_before' => '<span class="px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-primary hover:text-white transition-colors">',
                        'link_after'  => '</span>',
                    ));
                    ?>

                    <?php if (has_tag()) : ?>
                        <div class="mt-12 pt-12 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <svg class="w-5 h-5 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <?php
                                $tags = get_the_tags();
                                foreach ($tags as $tag) :
                                ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                                       class="badge badge-primary hover:bg-primary hover:text-white transition-colors">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-12 p-8 card">
                        <div class="flex items-start gap-6">
                            <?php echo get_avatar(get_the_author_meta('ID'), 96, '', '', array('class' => 'rounded-full')); ?>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold mb-2">
                                    <?php the_author(); ?>
                                </h3>
                                <?php if (get_the_author_meta('description')) : ?>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                                        <?php the_author_meta('description'); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
                                   class="inline-flex items-center gap-2 text-primary hover:text-primary-dark font-semibold">
                                    <?php esc_html_e('View all posts', 'blaze'); ?>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php get_template_part('template-parts/post/post-navigation'); ?>

                    <?php get_template_part('template-parts/post/related-posts'); ?>

                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                </div>
            </div>

        </article>

    <?php
    endwhile;
    ?>

</main>

<?php
get_footer();
?>