<?php
/**
 * Testimonials Slider Block
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Query testimonials
$testimonials_query = new WP_Query(array(
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
));

// Return if no testimonials
if (!$testimonials_query->have_posts()) {
    return;
}
?>

<section class="testimonials-section py-20 bg-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        
        <!-- Section Header -->
        <header class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                <?php esc_html_e('What Our Clients Say', 'blaze'); ?>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                <?php esc_html_e('Don\'t just take our word for it - hear from our satisfied clients', 'blaze'); ?>
            </p>
        </header>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php while ($testimonials_query->have_posts()) : $testimonials_query->the_post(); ?>
                
                <article class="testimonial-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300">
                    
                    <!-- Quote Icon -->
                    <div class="mb-6">
                        <svg class="w-12 h-12 text-primary/20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    <!-- Testimonial Content -->
                    <div class="testimonial-content mb-6">
                        <div class="text-gray-700 leading-relaxed line-clamp-6">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 mb-6">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>

                    <!-- Author Info -->
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="flex-shrink-0">
                                <?php the_post_thumbnail('thumbnail', array(
                                    'class' => 'w-12 h-12 rounded-full object-cover ring-2 ring-gray-100'
                                )); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900">
                                <?php the_title(); ?>
                            </h4>
                            <?php
                            $company = get_post_meta(get_the_ID(), 'company', true);
                            $position = get_post_meta(get_the_ID(), 'position', true);
                            if ($position || $company) : ?>
                                <p class="text-sm text-gray-600">
                                    <?php 
                                    if ($position) echo esc_html($position);
                                    if ($position && $company) echo ' at ';
                                    if ($company) echo esc_html($company);
                                    ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                </article>

            <?php endwhile; ?>

        </div>

        <!-- View All Testimonials -->
        <div class="text-center mt-12">
            <a href="<?php echo esc_url(get_post_type_archive_link('testimonial')); ?>" 
               class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-dark transition-colors">
                <span><?php esc_html_e('View All Testimonials', 'blaze'); ?></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

    </div>
</section>

<?php
wp_reset_postdata();
?>