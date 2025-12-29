<?php
/**
 * Custom Template Tags
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display site logo or title
 */
function blaze_site_branding() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title text-2xl font-bold text-gray-900 hover:text-primary transition-colors">
            <?php bloginfo('name'); ?>
        </a>
        <?php
        $description = get_bloginfo('description', 'display');
        if ($description) {
            ?>
            <p class="site-description text-sm text-gray-600 mt-1">
                <?php echo esc_html($description); ?>
            </p>
            <?php
        }
    }
}

/**
 * Display post meta information
 */
function blaze_post_meta() {
    ?>
    <div class="post-meta flex flex-wrap items-center gap-4 text-sm text-gray-600">
        
        <!-- Author -->
        <span class="post-author flex items-center gap-2">
            <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-full')); ?>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="hover:text-primary">
                <?php the_author(); ?>
            </a>
        </span>
        
        <!-- Date -->
        <span class="post-date flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(get_the_date()); ?>
            </time>
        </span>
        
        <!-- Categories -->
        <?php if (has_category()) : ?>
        <span class="post-categories flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <?php the_category(', '); ?>
        </span>
        <?php endif; ?>
        
        <!-- Comments -->
        <?php if (comments_open()) : ?>
        <span class="post-comments flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <a href="<?php comments_link(); ?>" class="hover:text-primary">
                <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
            </a>
        </span>
        <?php endif; ?>
        
        <!-- Reading Time -->
        <span class="reading-time flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <?php echo blaze_reading_time(); ?>
        </span>
    </div>
    <?php
}

/**
 * Calculate reading time
 */
function blaze_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 words per minute
    
    return sprintf(_n('%s min read', '%s min read', $reading_time, 'blaze'), $reading_time);
}

/**
 * Display post tags
 */
function blaze_post_tags() {
    $tags = get_the_tags();
    
    if (!$tags) {
        return;
    }
    ?>
    <div class="post-tags flex flex-wrap gap-2 mt-6">
        <?php foreach ($tags as $tag) : ?>
        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
           class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-primary hover:text-white transition-colors">
            #<?php echo esc_html($tag->name); ?>
        </a>
        <?php endforeach; ?>
    </div>
    <?php
}

/**
 * Display post navigation
 */
function blaze_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    
    if (!$prev_post && !$next_post) {
        return;
    }
    ?>
    <nav class="post-navigation grid grid-cols-1 md:grid-cols-2 gap-6 mt-12 pt-12 border-t">
        
        <?php if ($prev_post) : ?>
        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" 
           class="group flex flex-col p-6 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-all">
            <span class="text-sm uppercase tracking-wide mb-2 opacity-75">
                ← <?php esc_html_e('Previous Post', 'blaze'); ?>
            </span>
            <span class="text-lg font-semibold group-hover:translate-x-1 transition-transform">
                <?php echo esc_html(get_the_title($prev_post)); ?>
            </span>
        </a>
        <?php else : ?>
        <div></div>
        <?php endif; ?>
        
        <?php if ($next_post) : ?>
        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" 
           class="group flex flex-col p-6 bg-gray-50 rounded-lg hover:bg-primary hover:text-white transition-all text-right">
            <span class="text-sm uppercase tracking-wide mb-2 opacity-75">
                <?php esc_html_e('Next Post', 'blaze'); ?> →
            </span>
            <span class="text-lg font-semibold group-hover:translate-x-1 transition-transform">
                <?php echo esc_html(get_the_title($next_post)); ?>
            </span>
        </a>
        <?php endif; ?>
        
    </nav>
    <?php
}

/**
 * Display breadcrumbs
 */
function blaze_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    ?>
    <nav class="breadcrumbs text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center gap-2">
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-primary">
                    <?php esc_html_e('Home', 'blaze'); ?>
                </a>
            </li>
            
            <?php if (is_category() || is_single()) : ?>
                <li class="flex items-center gap-2">
                    <span>/</span>
                    <?php
                    $category = get_the_category();
                    if ($category) {
                        echo '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '" class="hover:text-primary">' . esc_html($category[0]->name) . '</a>';
                    }
                    ?>
                </li>
            <?php endif; ?>
            
            <?php if (is_single()) : ?>
                <li class="flex items-center gap-2">
                    <span>/</span>
                    <span class="text-gray-900 font-medium"><?php the_title(); ?></span>
                </li>
            <?php endif; ?>
            
            <?php if (is_page()) : ?>
                <li class="flex items-center gap-2">
                    <span>/</span>
                    <span class="text-gray-900 font-medium"><?php the_title(); ?></span>
                </li>
            <?php endif; ?>
            
            <?php if (is_search()) : ?>
                <li class="flex items-center gap-2">
                    <span>/</span>
                    <span class="text-gray-900 font-medium">
                        <?php printf(__('Search Results for: %s', 'blaze'), get_search_query()); ?>
                    </span>
                </li>
            <?php endif; ?>
        </ol>
    </nav>
    <?php
}

/**
 * Display related posts
 */
function blaze_related_posts($post_id = null, $limit = 3) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = get_the_category($post_id);
    if (!$categories) {
        return;
    }
    
    $category_ids = array();
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }
    
    $args = array(
        'category__in'   => $category_ids,
        'post__not_in'   => array($post_id),
        'posts_per_page' => $limit,
        'orderby'        => 'rand',
    );
    
    $related = new WP_Query($args);
    
    if (!$related->have_posts()) {
        return;
    }
    ?>
    <section class="related-posts mt-12 pt-12 border-t">
        <h3 class="text-2xl font-bold mb-6"><?php esc_html_e('Related Posts', 'blaze'); ?></h3>
        
        <div class="grid grid-cols-1 md:grid-cols-<?php echo esc_attr($limit); ?> gap-6">
            <?php while ($related->have_posts()) : $related->the_post(); ?>
            <article class="card group">
                <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" class="block overflow-hidden rounded-t-lg">
                    <?php the_post_thumbnail('blaze-thumbnail', array('class' => 'w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300')); ?>
                </a>
                <?php endif; ?>
                
                <div class="p-4">
                    <h4 class="text-lg font-semibold mb-2">
                        <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h4>
                    <p class="text-sm text-gray-600">
                        <?php echo esc_html(get_the_date()); ?>
                    </p>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}

/**
 * Display social share buttons
 */
function blaze_social_share() {
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    ?>
    <div class="social-share flex items-center gap-3 mt-6">
        <span class="text-sm font-semibold text-gray-700"><?php esc_html_e('Share:', 'blaze'); ?></span>
        
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" 
           target="_blank" rel="noopener" 
           class="share-button bg-blue-600 hover:bg-blue-700"
           aria-label="Share on Facebook">
            Facebook
        </a>
        
        <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" 
           target="_blank" rel="noopener"
           class="share-button bg-sky-500 hover:bg-sky-600"
           aria-label="Share on Twitter">
            Twitter
        </a>
        
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>" 
           target="_blank" rel="noopener"
           class="share-button bg-blue-700 hover:bg-blue-800"
           aria-label="Share on LinkedIn">
            LinkedIn
        </a>
        
        <a href="https://wa.me/?text=<?php echo $title; ?>%20<?php echo $url; ?>" 
           target="_blank" rel="noopener"
           class="share-button bg-green-600 hover:bg-green-700"
           aria-label="Share on WhatsApp">
            WhatsApp
        </a>
    </div>
    
    <style>
        .share-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }
    </style>
    <?php
}