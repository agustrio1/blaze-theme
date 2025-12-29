<?php
/**
 * Post Featured Image
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Check if post has thumbnail
if (!has_post_thumbnail()) {
    return;
}
?>

<div class="post-thumbnail mb-8">
    
    <?php if (is_singular()) : ?>
        
        <!-- Single Post - Full Image -->
        <figure class="featured-image rounded-xl overflow-hidden">
            <?php the_post_thumbnail('blaze-featured', array(
                'class' => 'w-full h-auto',
                'alt'   => the_title_attribute(array('echo' => false))
            )); ?>
            
            <?php
            $caption = get_the_post_thumbnail_caption();
            if ($caption) : ?>
                <figcaption class="text-sm text-gray-600 italic mt-3 text-center">
                    <?php echo wp_kses_post($caption); ?>
                </figcaption>
            <?php endif; ?>
        </figure>

    <?php else : ?>
        
        <!-- Archive/List - Linked Image -->
        <a href="<?php the_permalink(); ?>" 
           class="block relative overflow-hidden rounded-xl group"
           aria-hidden="true" 
           tabindex="-1">
            
            <?php the_post_thumbnail('blaze-featured', array(
                'class' => 'w-full h-auto group-hover:scale-110 transition-transform duration-500',
                'alt'   => the_title_attribute(array('echo' => false))
            )); ?>
            
            <!-- Overlay on Hover -->
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
            
            <!-- Category Badge -->
            <?php if (has_category()) : ?>
                <div class="absolute top-4 right-4 z-10">
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
            
            <!-- Post Format Icon -->
            <?php
            $format = get_post_format();
            if ($format && in_array($format, array('video', 'audio', 'gallery', 'quote', 'link'))) :
                $icons = array(
                    'video'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                    'audio'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>',
                    'gallery' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>',
                    'quote'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>',
                    'link'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>',
                );
                ?>
                <div class="absolute bottom-4 left-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg z-10">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <?php echo $icons[$format]; ?>
                    </svg>
                </div>
            <?php endif; ?>
            
        </a>

    <?php endif; ?>

</div>