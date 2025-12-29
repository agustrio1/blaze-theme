<?php
/**
 * Template Name: Blog Masonry
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
            'posts_per_page' => 12,
            'paged'          => $paged,
        ));

        if ($blog_query->have_posts()) :
            ?>

            <!-- Masonry Grid -->
            <div class="masonry-grid" id="masonry-container">
                <?php
                while ($blog_query->have_posts()) :
                    $blog_query->the_post();
                    ?>
                    <div class="masonry-item">
                        <?php get_template_part('template-parts/content/content'); ?>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>

            <!-- Load More Button -->
            <?php if ($blog_query->max_num_pages > 1) : ?>
                <div class="text-center mt-12">
                    <button id="load-more" 
                            class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all shadow-md hover:shadow-lg"
                            data-page="1" 
                            data-max="<?php echo esc_attr($blog_query->max_num_pages); ?>">
                        <span><?php esc_html_e('Load More Posts', 'blaze'); ?></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>

            <?php
            wp_reset_postdata();
        else :
            get_template_part('template-parts/content/content', 'none');
        endif;
        ?>

    </div>

</main>

<style>
    .masonry-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2rem;
    }

    @media (min-width: 768px) {
        .masonry-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .masonry-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .masonry-item {
        break-inside: avoid;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const button = this;
            const currentPage = parseInt(button.getAttribute('data-page'));
            const maxPages = parseInt(button.getAttribute('data-max'));
            const nextPage = currentPage + 1;

            if (nextPage > maxPages) {
                button.style.display = 'none';
                return;
            }

            // Show loading state
            button.disabled = true;
            button.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span><?php esc_html_e('Loading...', 'blaze'); ?></span>';

            // AJAX request
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'load_more_posts',
                    page: nextPage,
                    nonce: '<?php echo wp_create_nonce('load_more_posts'); ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data.html) {
                    // Append new posts
                    const container = document.getElementById('masonry-container');
                    container.insertAdjacentHTML('beforeend', data.data.html);

                    // Update page number
                    button.setAttribute('data-page', nextPage);

                    // Reset button state
                    button.disabled = false;
                    button.innerHTML = '<span><?php esc_html_e('Load More Posts', 'blaze'); ?></span><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';

                    // Hide button if last page
                    if (nextPage >= maxPages) {
                        button.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.disabled = false;
                button.innerHTML = '<span><?php esc_html_e('Load More Posts', 'blaze'); ?></span>';
            });
        });
    }
});
</script>

<?php
get_footer();
?>