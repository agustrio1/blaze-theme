<?php
/**
 * The main template file
 *
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-12">
        
        <?php if (have_posts()) : ?>
            
            <header class="page-header mb-12">
                <?php if (is_home() && !is_front_page()) : ?>
                    <h1 class="text-4xl font-bold mb-4">
                        <?php single_post_title(); ?>
                    </h1>
                <?php else : ?>
                    <h1 class="text-4xl font-bold mb-4">
                        <?php esc_html_e('Latest Posts', 'blaze'); ?>
                    </h1>
                <?php endif; ?>
                
                <?php
                $description = get_the_archive_description();
                if ($description) :
                ?>
                    <div class="text-lg text-gray-600 dark:text-gray-400">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div id="post-grid"></div>

            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => sprintf(
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg> %s',
                    __('Previous', 'blaze')
                ),
                'next_text' => sprintf(
                    '%s <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
                    __('Next', 'blaze')
                ),
                'class' => 'mt-12',
            ));
            ?>

        <?php else : ?>
            
            <?php get_template_part('template-parts/content/content', 'none'); ?>
            
        <?php endif; ?>
        
    </div>
</main>

<script>
// Mount Svelte PostGrid component
if (document.getElementById('post-grid')) {
    const posts = <?php 
    $posts_data = array();
    while (have_posts()) {
        the_post();
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
    echo json_encode($posts_data);
    ?>;
    
    new PostGrid({
        target: document.getElementById('post-grid'),
        props: { posts }
    });
}
</script>

<?php
get_sidebar();
get_footer();
?>