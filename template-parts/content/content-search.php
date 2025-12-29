<?php
/**
 * Search Results Content Template
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden mb-6'); ?>>
    
    <div class="flex flex-col md:flex-row gap-0 md:gap-6">
        
        <!-- Thumbnail -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="md:w-48 flex-shrink-0">
                <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-video md:aspect-square">
                    <?php the_post_thumbnail('blaze-thumbnail', array(
                        'class' => 'w-full h-full object-cover hover:scale-110 transition-transform duration-500',
                        'alt'   => the_title_attribute(array('echo' => false))
                    )); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="flex-1 p-6">
            
            <!-- Post Type Badge -->
            <div class="flex items-center gap-3 mb-3">
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                    <?php
                    $post_type = get_post_type();
                    $post_type_obj = get_post_type_object($post_type);
                    
                    if ($post_type === 'post') {
                        echo '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';
                    } elseif ($post_type === 'page') {
                        echo '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>';
                    }
                    
                    echo esc_html($post_type_obj->labels->singular_name);
                    ?>
                </span>

                <?php if (has_category() && $post_type === 'post') : ?>
                    <span class="text-gray-400">|</span>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="text-sm text-primary hover:text-primary-dark font-medium">';
                        echo esc_html($categories[0]->name);
                        echo '</a>';
                    }
                    ?>
                <?php endif; ?>
            </div>

            <!-- Title -->
            <header class="entry-header mb-3">
                <?php the_title(
                    '<h2 class="entry-title text-xl font-bold text-gray-900 hover:text-primary transition-colors line-clamp-2"><a href="' . esc_url(get_permalink()) . '">',
                    '</a></h2>'
                ); ?>
            </header>

            <!-- Excerpt -->
            <div class="entry-summary text-gray-600 text-sm mb-4 line-clamp-3">
                <?php
                if (has_excerpt()) {
                    the_excerpt();
                } else {
                    echo wp_trim_words(get_the_content(), 25, '...');
                }
                ?>
            </div>

            <!-- Meta -->
            <div class="entry-meta flex flex-wrap items-center gap-4 text-xs text-gray-500">
                
                <!-- Date -->
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <?php echo esc_html(get_the_date()); ?>
                </time>

                <!-- Author -->
                <?php if ($post_type === 'post') : ?>
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="hover:text-primary">
                            <?php the_author(); ?>
                        </a>
                    </span>
                <?php endif; ?>

                <!-- Comments -->
                <?php if (comments_open() && $post_type === 'post') : ?>
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <?php comments_number('0', '1', '%'); ?>
                    </span>
                <?php endif; ?>

            </div>

        </div>

    </div>

</article>