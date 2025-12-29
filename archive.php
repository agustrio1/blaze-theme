<?php
/**
 * The template for displaying archive pages
 *
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php if (have_posts()) : ?>
        
        <header class="archive-header bg-primary text-white py-20">
            <div class="container">
                <div class="max-w-4xl mx-auto text-center">
                    
                    <?php if (is_category()) : ?>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <?php esc_html_e('Category', 'blaze'); ?>
                        </div>
                    <?php elseif (is_tag()) : ?>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <?php esc_html_e('Tag', 'blaze'); ?>
                        </div>
                    <?php elseif (is_author()) : ?>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <?php esc_html_e('Author', 'blaze'); ?>
                        </div>
                    <?php elseif (is_date()) : ?>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <?php esc_html_e('Date Archive', 'blaze'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">
                        <?php the_archive_title(); ?>
                    </h1>
                    
                    <?php
                    $description = get_the_archive_description();
                    if ($description) :
                    ?>
                        <div class="text-xl text-white/90 max-w-2xl mx-auto">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_author()) : ?>
                        <div class="flex items-center justify-center gap-4 mt-6">
                            <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('class' => 'rounded-full')); ?>
                            <div class="text-left">
                                <p class="text-sm text-white/70"><?php esc_html_e('Written by', 'blaze'); ?></p>
                                <p class="font-semibold"><?php the_author(); ?></p>
                            </div>
                        </div>
                        <?php if (get_the_author_meta('description')) : ?>
                            <p class="mt-4 text-white/80 max-w-2xl mx-auto">
                                <?php the_author_meta('description'); ?>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="mt-6 text-white/80">
                        <?php
                        global $wp_query;
                        printf(
                            esc_html__('%s Posts Found', 'blaze'),
                            '<span class="font-bold text-white">' . number_format_i18n($wp_query->found_posts) . '</span>'
                        );
                        ?>
                    </div>
                </div>
            </div>
        </header>

        <div class="container py-12">
            
            <div id="archive-posts-grid"></div>

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

        </div>

    <?php else : ?>
        
        <div class="container py-12">
            <?php get_template_part('template-parts/content/content', 'none'); ?>
        </div>
        
    <?php endif; ?>

</main>

<script>
// Mount Svelte PostGrid component
if (document.getElementById('archive-posts-grid')) {
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
        target: document.getElementById('archive-posts-grid'),
        props: { posts }
    });
}
</script>

<?php
get_sidebar();
get_footer();
?>