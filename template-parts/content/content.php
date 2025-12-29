<?php
/**
 * Default Post Content Template
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden mb-8'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail relative overflow-hidden aspect-video bg-gray-200">
            <a href="<?php the_permalink(); ?>" class="block h-full">
                <?php the_post_thumbnail('blaze-featured', array(
                    'class' => 'w-full h-full object-cover hover:scale-110 transition-transform duration-500',
                    'alt'   => the_title_attribute(array('echo' => false))
                )); ?>
            </a>
            
            <?php if (has_category()) : ?>
                <div class="absolute top-4 right-4">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<span class="px-3 py-1 bg-primary text-white text-xs font-bold rounded-full shadow-lg">';
                        echo esc_html($categories[0]->name);
                        echo '</span>';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="p-6">
        
        <!-- Post Meta -->
        <div class="post-meta mb-4">
            <?php get_template_part('template-parts/post/post-meta'); ?>
        </div>

        <!-- Post Title -->
        <header class="entry-header mb-4">
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title text-3xl md:text-4xl font-bold text-gray-900 mb-4">', '</h1>');
            else :
                the_title(
                    '<h2 class="entry-title text-2xl font-bold text-gray-900 mb-3 hover:text-primary transition-colors"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">',
                    '</a></h2>'
                );
            endif;
            ?>
        </header>

        <!-- Post Content/Excerpt -->
        <div class="entry-content text-gray-600 mb-6">
            <?php
            if (is_singular() || is_search()) :
                the_content(sprintf(
                    wp_kses(
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'blaze'),
                        array('span' => array('class' => array()))
                    ),
                    wp_kses_post(get_the_title())
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links mt-6 flex flex-wrap gap-2">' . esc_html__('Pages:', 'blaze'),
                    'after'  => '</div>',
                    'link_before' => '<span class="px-4 py-2 bg-gray-100 hover:bg-primary hover:text-white rounded-lg transition-colors">',
                    'link_after'  => '</span>',
                ));
            else :
                if (get_theme_mod('blaze_show_excerpt', true)) :
                    the_excerpt();
                endif;
            endif;
            ?>
        </div>

        <!-- Read More Button -->
        <?php if (!is_singular()) : ?>
            <footer class="entry-footer flex items-center justify-between pt-4 border-t border-gray-100">
                
                <?php if (has_tag()) : ?>
                    <div class="post-tags flex flex-wrap gap-2">
                        <?php
                        $tags = get_the_tags();
                        if ($tags) {
                            $count = 0;
                            foreach ($tags as $tag) {
                                if ($count >= 2) break;
                                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md hover:bg-primary hover:text-white transition-colors">';
                                echo '#' . esc_html($tag->name);
                                echo '</a>';
                                $count++;
                            }
                        }
                        ?>
                    </div>
                <?php else : ?>
                    <div></div>
                <?php endif; ?>

                <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-primary font-medium text-sm hover:text-primary-dark transition-colors group">
                    <span><?php esc_html_e('Read More', 'blaze'); ?></span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </footer>
        <?php endif; ?>

    </div>

</article>