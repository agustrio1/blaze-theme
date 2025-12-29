<?php
/**
 * Page Content Template
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
    
    <!-- Page Header -->
    <header class="entry-header mb-8">
        
        <!-- Breadcrumbs -->
        <?php get_template_part('template-parts/page/breadcrumbs'); ?>

        <!-- Page Title -->
        <?php the_title('<h1 class="entry-title text-4xl md:text-5xl font-bold text-gray-900 mb-4">', '</h1>'); ?>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="page-thumbnail mt-6 rounded-xl overflow-hidden">
                <?php the_post_thumbnail('blaze-featured', array(
                    'class' => 'w-full h-auto',
                    'alt'   => the_title_attribute(array('echo' => false))
                )); ?>
            </div>
        <?php endif; ?>

    </header>

    <!-- Page Content -->
    <div class="entry-content prose prose-lg max-w-none">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links mt-8 flex flex-wrap gap-2">' . esc_html__('Pages:', 'blaze'),
            'after'  => '</div>',
            'link_before' => '<span class="px-4 py-2 bg-gray-100 hover:bg-primary hover:text-white rounded-lg transition-colors font-medium">',
            'link_after'  => '</span>',
        ));
        ?>
    </div>

    <!-- Page Footer -->
    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer mt-8 pt-8 border-t border-gray-200">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        __('Edit <span class="screen-reader-text">%s</span>', 'blaze'),
                        array('span' => array('class' => array()))
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors">',
                '</span>'
            );
            ?>
        </footer>
    <?php endif; ?>

</article>

<!-- Comments Section -->
<?php
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
?>