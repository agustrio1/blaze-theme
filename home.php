<?php
/**
 * The template for displaying the blog posts index
 *
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container py-12">
        
        <?php if (have_posts()) : ?>
            
            <header class="page-header mb-12 text-center">
                <h1 class="text-5xl font-bold mb-4">
                    <?php esc_html_e('Our Blog', 'blaze'); ?>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    <?php esc_html_e('Discover stories, thinking, and expertise from writers on any topic.', 'blaze'); ?>
                </p>
            </header>

            <?php
            // Featured Post
            $featured_query = new WP_Query(array(
                'posts_per_page' => 1,
                'post_type'      => 'post',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($featured_query->have_posts()) :
                while ($featured_query->have_posts()) : $featured_query->the_post();
            ?>
                <article class="featured-post mb-16 card">
                    <div class="grid md:grid-cols-2 gap-0">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="relative h-64 md:h-auto">
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                                <div class="absolute top-4 left-4">
                                    <span class="badge bg-primary text-white px-4 py-2">
                                        <?php esc_html_e('Featured', 'blaze'); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-8 md:p-12 flex flex-col justify-center">
                            <?php get_template_part('template-parts/post/post-meta'); ?>
                            
                            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                                <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <div class="text-gray-600 dark:text-gray-400 mb-6 line-clamp-3">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <?php echo get_avatar(get_the_author_meta('ID'), 48, '', '', array('class' => 'rounded-full')); ?>
                                <div>
                                    <p class="font-semibold"><?php the_author(); ?></p>
                                    <p class="text-sm text-gray-500">
                                        <?php printf(esc_html__('%s min read', 'blaze'), blaze_get_reading_time()); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>

            <div id="blog-posts-grid"></div>

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
if (document.getElementById('blog-posts-grid')) {
    const posts = <?php 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    if ($paged == 1) {
        the_post(); // Skip featured post
    }
    
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
        target: document.getElementById('blog-posts-grid'),
        props: { posts }
    });
}
</script>

<?php
get_footer();
?>