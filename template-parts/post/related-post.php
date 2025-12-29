<?php
/**
 * Related Posts Section
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get current post ID
$post_id = get_the_ID();

// Get post categories
$categories = get_the_category($post_id);

if (!$categories) {
    return;
}

$category_ids = array();
foreach ($categories as $category) {
    $category_ids[] = $category->term_id;
}

// Query related posts
$related_args = array(
    'category__in'   => $category_ids,
    'post__not_in'   => array($post_id),
    'posts_per_page' => 3,
    'orderby'        => 'rand',
    'post_status'    => 'publish',
);

$related_query = new WP_Query($related_args);

// Return if no related posts
if (!$related_query->have_posts()) {
    return;
}
?>

<section class="related-posts mt-16 pt-16 border-t border-gray-200">
    
    <header class="section-header mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">
            <?php esc_html_e('Related Posts', 'blaze'); ?>
        </h2>
        <p class="text-gray-600">
            <?php esc_html_e('You might also be interested in these articles', 'blaze'); ?>
        </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
            
            <article class="related-post-item group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                
                <!-- Thumbnail -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail relative overflow-hidden aspect-video bg-gray-200">
                        <a href="<?php the_permalink(); ?>" class="block h-full">
                            <?php the_post_thumbnail('blaze-thumbnail', array(
                                'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500',
                                'alt'   => the_title_attribute(array('echo' => false))
                            )); ?>
                        </a>
                        
                        <!-- Category Badge -->
                        <?php
                        $post_categories = get_the_category();
                        if (!empty($post_categories)) : ?>
                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-1 bg-primary text-white text-xs font-bold rounded-full">
                                    <?php echo esc_html($post_categories[0]->name); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="p-5">
                    
                    <!-- Meta -->
                    <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                            <?php echo esc_html(get_the_date()); ?>
                        </time>
                        <span>•</span>
                        <span><?php echo blaze_reading_time(); ?></span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary transition-colors">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                    </p>

                    <!-- Read More -->
                    <a href="<?php the_permalink(); ?>" 
                       class="inline-flex items-center gap-2 text-primary font-medium text-sm hover:text-primary-dark transition-colors group/link">
                        <span><?php esc_html_e('Read More', 'blaze'); ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>

                </div>

            </article>

        <?php endwhile; ?>

    </div>

    <!-- View All Posts Link -->
    <?php if (!empty($categories)) : ?>
        <div class="text-center mt-8">
            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-primary hover:text-white transition-all">
                <span><?php printf(esc_html__('View All %s Posts', 'blaze'), esc_html($categories[0]->name)); ?></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    <?php endif; ?>

</section>

<?php
wp_reset_postdata();
?>