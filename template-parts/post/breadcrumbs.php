<?php
/**
 * Breadcrumb Navigation
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Don't display on front page
if (is_front_page()) {
    return;
}
?>

<nav class="breadcrumbs text-sm mb-6" aria-label="<?php esc_attr_e('Breadcrumb', 'blaze'); ?>">
    <ol class="flex flex-wrap items-center gap-2 text-gray-600">
        
        <!-- Home -->
        <li class="flex items-center gap-2">
            <a href="<?php echo esc_url(home_url('/')); ?>" 
               class="hover:text-primary transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span><?php esc_html_e('Home', 'blaze'); ?></span>
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <?php if (is_category() || is_single()) : ?>
            
            <?php
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0];
                ?>
                <li class="flex items-center gap-2">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                       class="hover:text-primary transition-colors">
                        <?php echo esc_html($category->name); ?>
                    </a>
                    <?php if (is_single()) : ?>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    <?php endif; ?>
                </li>
                <?php
            }
            ?>

        <?php endif; ?>

        <?php if (is_tag()) : ?>
            <li class="flex items-center gap-2">
                <span class="text-gray-900 font-medium"><?php single_tag_title(); ?></span>
            </li>
        <?php endif; ?>

        <?php if (is_author()) : ?>
            <li class="flex items-center gap-2">
                <span class="text-gray-900 font-medium"><?php the_author(); ?></span>
            </li>
        <?php endif; ?>

        <?php if (is_single()) : ?>
            <li class="flex items-center gap-2">
                <span class="text-gray-900 font-medium line-clamp-1"><?php the_title(); ?></span>
            </li>
        <?php endif; ?>

        <?php if (is_page()) : ?>
            
            <?php
            // Get parent pages
            $post = get_post();
            if ($post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                
                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = array(
                        'id'    => $page->ID,
                        'title' => get_the_title($page->ID),
                        'url'   => get_permalink($page->ID)
                    );
                    $parent_id = $page->post_parent;
                }
                
                $breadcrumbs = array_reverse($breadcrumbs);
                
                foreach ($breadcrumbs as $crumb) {
                    ?>
                    <li class="flex items-center gap-2">
                        <a href="<?php echo esc_url($crumb['url']); ?>" 
                           class="hover:text-primary transition-colors">
                            <?php echo esc_html($crumb['title']); ?>
                        </a>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <?php
                }
            }
            ?>
            
            <li class="flex items-center gap-2">
                <span class="text-gray-900 font-medium"><?php the_title(); ?></span>
            </li>
        <?php endif; ?>

        <?php if (is_search()) : ?>
            <li class="flex items-center gap-2">
                <span class="text-gray-900 font-medium">
                    <?php printf(esc_html__('Search: %s', 'blaze'), get_search_query()); ?>
                </span>
            </li>
        <?php endif; ?>

        <?php if (is_404()) : ?>
            <li class="flex items-center gap-2">
                <span class="text-gray-900 font-medium"><?php esc_html_e('404 Error', 'blaze'); ?></span>
            </li>
        <?php endif; ?>

        <?php if (is_archive() && !is_category() && !is_tag() && !is_author()) : ?>
            <li class="flex items-center gap-2">
                <span class="text-gray-900 font-medium"><?php post_type_archive_title(); ?></span>
            </li>
        <?php endif; ?>

    </ol>
</nav>

<style>
    .breadcrumbs ol {
        flex-wrap: wrap;
    }
    
    .breadcrumbs a {
        transition: color 0.2s ease;
    }
    
    @media (max-width: 640px) {
        .breadcrumbs {
            font-size: 0.75rem;
        }
    }
</style>