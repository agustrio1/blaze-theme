<?php
/**
 * Template Name: Page Builder
 * Template Post Type: page
 * 
 * Compatible with Elementor, Beaver Builder, etc.
 * 
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main page-builder-template">

    <?php
    while (have_posts()) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links container mx-auto px-4 py-4">' . esc_html__('Pages:', 'blaze'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

        </article>

        <?php
        // If comments are open or we have at least one comment
        if (comments_open() || get_comments_number()) :
            ?>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl py-12">
                <?php comments_template(); ?>
            </div>
            <?php
        endif;

    endwhile;
    ?>

</main>

<style>
    /* Remove default spacing for page builders */
    .page-builder-template .entry-content {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .page-builder-template .entry-content > * {
        max-width: 100%;
    }

    /* Elementor compatibility */
    .elementor-section.elementor-section-boxed > .elementor-container {
        max-width: 1200px;
    }

    /* Beaver Builder compatibility */
    .fl-builder-content {
        margin: 0;
        padding: 0;
    }

    /* Gutenberg full-width support */
    .page-builder-template .alignfull {
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
        max-width: 100vw;
        width: 100vw;
    }

    .page-builder-template .alignwide {
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
        max-width: 100vw;
        width: 100vw;
    }
</style>

<?php
get_footer();
?>