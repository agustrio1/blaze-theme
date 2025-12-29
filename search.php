<?php
/**
 * The template for displaying search results
 *
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <header class="search-header bg-primary text-white py-20">
        <div class="container">
            <div class="max-w-4xl mx-auto text-center">
                
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <?php esc_html_e('Search Results', 'blaze'); ?>
                </div>
                
                <?php if (have_posts()) : ?>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        <?php
                        printf(
                            esc_html__('Results for: %s', 'blaze'),
                            '<span class="text-yellow-300">"' . get_search_query() . '"</span>'
                        );
                        ?>
                    </h1>
                    <p class="text-xl text-white/90">
                        <?php
                        global $wp_query;
                        printf(
                            esc_html(_n('We found %s result', 'We found %s results', $wp_query->found_posts, 'blaze')),
                            '<span class="font-bold">' . number_format_i18n($wp_query->found_posts) . '</span>'
                        );
                        ?>
                    </p>
                <?php else : ?>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        <?php esc_html_e('No Results Found', 'blaze'); ?>
                    </h1>
                    <p class="text-xl text-white/90">
                        <?php
                        printf(
                            esc_html__('Sorry, no results found for: %s', 'blaze'),
                            '<span class="text-yellow-300">"' . get_search_query() . '"</span>'
                        );
                        ?>
                    </p>
                <?php endif; ?>
                
                <div class="mt-8 max-w-2xl mx-auto">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-12">
        
        <?php if (have_posts()) : ?>
            
            <div id="search-results-grid"></div>

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
            
            <div class="max-w-4xl mx-auto">
                
                <?php get_template_part('template-parts/content/content', 'none'); ?>
                
                <div class="mt-12 grid md:grid-cols-2 gap-8">
                    
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title flex items-center gap-2">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                <?php esc_html_e('Popular Posts', 'blaze'); ?>
                            </h3>
                            <ul class="space-y-4 mt-4">
                                <?php
                                $popular_posts = new WP_Query(array(
                                    'posts_per_page' => 5,
                                    'orderby'        => 'comment_count',
                                    'order'          => 'DESC',
                                ));
                                
                                if ($popular_posts->have_posts()) :
                                    while ($popular_posts->have_posts()) : $popular_posts->the_post();
                                ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" class="group flex items-start gap-3 hover:text-primary transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            <span><?php the_title(); ?></span>
                                        </a>
                                    </li>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title flex items-center gap-2">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <?php esc_html_e('Browse Categories', 'blaze'); ?>
                            </h3>
                            <ul class="space-y-4 mt-4">
                                <?php
                                $categories = get_categories(array(
                                    'number'  => 5,
                                    'orderby' => 'count',
                                    'order'   => 'DESC',
                                ));
                                
                                foreach ($categories as $category) :
                                ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                           class="group flex items-center justify-between hover:text-primary transition-colors">
                                            <span><?php echo esc_html($category->name); ?></span>
                                            <span class="badge badge-primary">
                                                <?php echo esc_html($category->count); ?>
                                            </span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>

</main>

<script>
// Mount Svelte PostGrid for search results
if (document.getElementById('search-results-grid')) {
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
        target: document.getElementById('search-results-grid'),
        props: { posts }
    });
}
</script>

<?php
get_sidebar();
get_footer();
?>