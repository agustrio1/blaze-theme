<?php
/**
 * The front page template
 *
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <!-- Hero Section -->
    <?php get_template_part('template-parts/blocks/hero'); ?>

    <!-- Features Section -->
    <?php get_template_part('template-parts/blocks/features'); ?>

    <!-- Latest Posts Section -->
    <section id="latest-posts" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <?php esc_html_e('Latest Articles', 'blaze'); ?>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    <?php esc_html_e('Check out our most recent posts and insights', 'blaze'); ?>
                </p>
            </div>

            <div id="latest-posts-grid"></div>

            <div class="text-center mt-12">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" 
                   class="btn btn-primary btn-lg">
                    <?php esc_html_e('View All Posts', 'blaze'); ?>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <?php get_template_part('template-parts/blocks/newsletter'); ?>

</main>

<script>
// Mount Svelte PostGrid for latest posts
if (document.getElementById('latest-posts-grid')) {
    const posts = <?php 
    $recent_posts = new WP_Query(array(
        'posts_per_page' => 6,
        'post_status'    => 'publish',
    ));
    
    $posts_data = array();
    if ($recent_posts->have_posts()) {
        while ($recent_posts->have_posts()) {
            $recent_posts->the_post();
            $posts_data[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'permalink' => get_permalink(),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'author' => get_the_author(),
                'date' => get_the_date(),
            );
        }
        wp_reset_postdata();
    }
    echo json_encode($posts_data);
    ?>;
    
    new PostGrid({
        target: document.getElementById('latest-posts-grid'),
        props: { posts }
    });
}
</script>

<?php
get_footer();
?>