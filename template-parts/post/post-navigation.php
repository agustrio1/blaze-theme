<?php
/**
 * Post Navigation (Previous/Next)
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$prev_post = get_previous_post();
$next_post = get_next_post();

// Return if no navigation
if (!$prev_post && !$next_post) {
    return;
}
?>

<nav class="post-navigation" aria-label="<?php esc_attr_e('Post Navigation', 'blaze'); ?>">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Previous Post -->
        <?php if ($prev_post) : ?>
            <article class="nav-previous group bg-gray-50 rounded-xl p-6 hover:bg-primary hover:text-white transition-all">
                <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" 
                   class="flex flex-col h-full"
                   rel="prev">
                    
                    <div class="flex items-center gap-2 text-sm uppercase tracking-wide mb-3 opacity-75">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span><?php esc_html_e('Previous Post', 'blaze'); ?></span>
                    </div>
                    
                    <?php if (has_post_thumbnail($prev_post)) : ?>
                        <div class="mb-4 rounded-lg overflow-hidden">
                            <?php echo get_the_post_thumbnail($prev_post, 'blaze-thumbnail', array(
                                'class' => 'w-full h-32 object-cover group-hover:scale-110 transition-transform duration-300'
                            )); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="text-lg font-semibold mb-2 group-hover:translate-x-1 transition-transform line-clamp-2">
                        <?php echo esc_html(get_the_title($prev_post)); ?>
                    </h3>
                    
                    <?php if (has_excerpt($prev_post)) : ?>
                        <p class="text-sm opacity-75 line-clamp-2">
                            <?php echo wp_trim_words(get_the_excerpt($prev_post), 15); ?>
                        </p>
                    <?php endif; ?>
                </a>
            </article>
        <?php else : ?>
            <div></div>
        <?php endif; ?>

        <!-- Next Post -->
        <?php if ($next_post) : ?>
            <article class="nav-next group bg-gray-50 rounded-xl p-6 hover:bg-primary hover:text-white transition-all md:text-right">
                <a href="<?php echo esc_url(get_permalink($next_post)); ?>" 
                   class="flex flex-col h-full"
                   rel="next">
                    
                    <div class="flex items-center gap-2 justify-start md:justify-end text-sm uppercase tracking-wide mb-3 opacity-75">
                        <span><?php esc_html_e('Next Post', 'blaze'); ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    
                    <?php if (has_post_thumbnail($next_post)) : ?>
                        <div class="mb-4 rounded-lg overflow-hidden">
                            <?php echo get_the_post_thumbnail($next_post, 'blaze-thumbnail', array(
                                'class' => 'w-full h-32 object-cover group-hover:scale-110 transition-transform duration-300'
                            )); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="text-lg font-semibold mb-2 group-hover:translate-x-1 transition-transform line-clamp-2">
                        <?php echo esc_html(get_the_title($next_post)); ?>
                    </h3>
                    
                    <?php if (has_excerpt($next_post)) : ?>
                        <p class="text-sm opacity-75 line-clamp-2">
                            <?php echo wp_trim_words(get_the_excerpt($next_post), 15); ?>
                        </p>
                    <?php endif; ?>
                </a>
            </article>
        <?php endif; ?>

    </div>

</nav>