<?php
/**
 * Single Post Content Template
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    
    <!-- Post Header -->
    <header class="entry-header mb-8">
        
        <!-- Breadcrumbs -->
        <?php get_template_part('template-parts/page/breadcrumbs'); ?>

        <!-- Categories -->
        <?php if (has_category()) : ?>
            <div class="post-categories mb-4">
                <?php
                $categories = get_the_category();
                foreach ($categories as $category) {
                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="inline-block px-3 py-1 bg-primary/10 text-primary text-sm font-semibold rounded-full hover:bg-primary hover:text-white transition-colors mr-2">';
                    echo esc_html($category->name);
                    echo '</a>';
                }
                ?>
            </div>
        <?php endif; ?>

        <!-- Post Title -->
        <?php the_title('<h1 class="entry-title text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">', '</h1>'); ?>

        <!-- Post Meta -->
        <div class="post-meta mb-6">
            <?php get_template_part('template-parts/post/post-meta'); ?>
        </div>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail mb-8 rounded-xl overflow-hidden">
                <?php the_post_thumbnail('blaze-featured', array(
                    'class' => 'w-full h-auto',
                    'alt'   => the_title_attribute(array('echo' => false))
                )); ?>
                
                <?php
                $caption = get_the_post_thumbnail_caption();
                if ($caption) : ?>
                    <p class="text-sm text-gray-600 italic mt-2 text-center">
                        <?php echo esc_html($caption); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </header>

    <!-- Post Content -->
    <div class="entry-content prose prose-lg max-w-none mb-8">
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

    <!-- Post Footer -->
    <footer class="entry-footer">
        
        <!-- Tags -->
        <?php blaze_post_tags(); ?>

        <!-- Share Buttons -->
        <div class="post-share mt-8 pt-8 border-t border-gray-200">
            <?php blaze_social_share(); ?>
        </div>

        <!-- Author Box -->
        <?php if (get_the_author_meta('description')) : ?>
            <div class="author-box mt-8 p-6 bg-gray-50 rounded-xl">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-full')); ?>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            <?php
                            printf(
                                esc_html__('About %s', 'blaze'),
                                '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" class="hover:text-primary transition-colors">' . esc_html(get_the_author()) . '</a>'
                            );
                            ?>
                        </h3>
                        <p class="text-gray-600 mb-3">
                            <?php echo wp_kses_post(get_the_author_meta('description')); ?>
                        </p>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
                           class="inline-flex items-center gap-2 text-primary font-medium text-sm hover:text-primary-dark transition-colors">
                            <span><?php esc_html_e('View all posts', 'blaze'); ?></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Post Navigation -->
        <div class="post-navigation mt-8">
            <?php blaze_post_navigation(); ?>
        </div>

    </footer>

</article>

<!-- Related Posts -->
<?php blaze_related_posts(get_the_ID(), 3); ?>