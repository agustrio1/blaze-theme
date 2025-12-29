<?php
/**
 * The template for displaying pages
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
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <?php get_template_part('template-parts/page/page-header'); ?>

            <div class="container py-12">
                <div class="max-w-4xl mx-auto">
                    
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