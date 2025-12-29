<?php
/**
 * Template Name: Blank Canvas
 * Template Post Type: page
 * 
 * Completely blank template without header, footer, sidebar
 * Perfect for custom landing pages or page builders
 * 
 * @package Blaze_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('blank-template'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <?php
    while (have_posts()) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'blaze'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

        </article>

        <?php
    endwhile;
    ?>

</div>

<?php wp_footer(); ?>

</body>
</html>