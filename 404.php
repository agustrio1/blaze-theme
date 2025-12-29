<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Blaze_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <section class="error-404 not-found">
        
        <div class="min-h-screen flex items-center justify-center bg-primary text-white relative overflow-hidden">
            
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="container text-center relative z-10">
                
                <div class="mb-8">
                    <h1 class="text-9xl md:text-[200px] font-bold leading-none mb-4 animate-bounce">
                        404
                    </h1>
                    <div class="flex items-center justify-center gap-4 mb-8">
                        <div class="w-20 h-1 bg-white/50"></div>
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="w-20 h-1 bg-white/50"></div>
                    </div>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <?php esc_html_e('Oops! Page Not Found', 'blaze'); ?>
                </h2>
                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-2xl mx-auto">
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'blaze'); ?>
                </p>
                
                <div class="flex flex-wrap gap-4 justify-center mb-12">
                    <a href="<?php echo esc_url(home_url('/')); ?>" 
                       class="btn btn-lg bg-white text-primary hover:bg-gray-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <?php esc_html_e('Go Home', 'blaze'); ?>
                    </a>
                    <button onclick="history.back()" 
                            class="btn btn-lg btn-outline border-2 border-white text-white hover:bg-white hover:text-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <?php esc_html_e('Go Back', 'blaze'); ?>
                    </button>
                </div>
                
                <div class="max-w-2xl mx-auto">
                    <p class="text-lg mb-4 text-white/80">
                        <?php esc_html_e('Or try searching for what you need:', 'blaze'); ?>
                    </p>
                    <?php get_search_form(); ?>
                </div>
                
            </div>
        </div>
        
        <div class="py-20 bg-white dark:bg-gray-900">
            <div class="container">
                
                <h3 class="text-3xl font-bold text-center mb-12">
                    <?php esc_html_e('You Might Be Interested In', 'blaze'); ?>
                </h3>
                
                <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <h4 class="text-2xl font-bold">
                                    <?php esc_html_e('Popular Posts', 'blaze'); ?>
                                </h4>
                            </div>
                            <ul class="space-y-4">
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
                                        <a href="<?php the_permalink(); ?>" 
                                           class="group flex items-start gap-3 hover:text-primary transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            <div>
                                                <span class="font-medium"><?php the_title(); ?></span>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    <?php echo esc_html(get_the_date()); ?>
                                                </p>
                                            </div>
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
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-2xl font-bold">
                                    <?php esc_html_e('Categories', 'blaze'); ?>
                                </h4>
                            </div>
                            <ul class="space-y-4">
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
                                            <div class="flex items-center gap-3">
                                                <svg class="w-5 h-5 text-gray-400 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                                <span class="font-medium"><?php echo esc_html($category->name); ?></span>
                                            </div>
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
        </div>
        
    </section>

</main>

<?php
get_footer();
?>