<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 * 
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl py-12">

        <?php
        while (have_posts()) :
            the_post();
            
            get_template_part('template-parts/content/content', 'page');

            // If comments are open or we have at least one comment
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>

    </div>

</main>

<?php
get_footer();
?>