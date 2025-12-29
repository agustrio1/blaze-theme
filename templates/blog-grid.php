<?php
/**
 * Template Name: Blog Grid
 * Template Post Type: page
 * 
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <?php get_template_part('template-parts/page/page-header'); ?>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl py-12">

        <?php
        // Custom query for blog posts
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $blog_query = new WP_Query(array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 9,
            'paged'          => $paged,
        ));

        if ($blog_query->have_posts()) :
            ?>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <?php
                while ($blog_query->have_posts()) :
                    $blog_query->the_post();
                    
                    get_template_part('template-parts/content/content');

                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <nav class="pagination" aria-label="<?php esc_attr_e('Posts navigation', 'blaze'); ?>">
                <?php
                $pagination = paginate_links(array(
                    'total'     => $blog_query->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>',
                    'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
                    'type'      => 'list',
                ));

                if ($pagination) {
                    echo '<div class="flex justify-center">';
                    echo '<div class="flex items-center gap-2">' . $pagination . '</div>';
                    echo '</div>';
                }
                ?>
            </nav>

            <?php
            wp_reset_postdata();
        else :
            get_template_part('template-parts/content/content', 'none');
        endif;
        ?>

    </div>

</main>

<style>
    .pagination ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 0.5rem;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination a,
    .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        font-weight: 500;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }

    .pagination a {
        background: white;
        color: #374151;
        border: 1px solid #e5e7eb;
    }

    .pagination a:hover {
        background: #DC2626;
        color: white;
        border-color: #DC2626;
    }

    .pagination .current {
        background: #DC2626;
        color: white;
        border: 1px solid #DC2626;
    }

    .pagination .dots {
        color: #9ca3af;
    }
</style>

<?php
get_footer();
?>