<?php
/**
 * Post Metadata (date, author, etc)
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="post-meta flex flex-wrap items-center gap-4 text-sm text-gray-600">
    
    <!-- Author -->
    <div class="meta-author flex items-center gap-2">
        <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-full')); ?>
        <span class="by-author">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
               class="font-medium hover:text-primary transition-colors">
                <?php the_author(); ?>
            </a>
        </span>
    </div>

    <!-- Date -->
    <div class="meta-date flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
            <?php echo esc_html(get_the_date()); ?>
        </time>
    </div>

    <!-- Reading Time -->
    <div class="meta-reading-time flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span><?php echo blaze_reading_time(); ?></span>
    </div>

    <!-- Comments -->
    <?php if (comments_open()) : ?>
        <div class="meta-comments flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <a href="<?php comments_link(); ?>" class="hover:text-primary transition-colors">
                <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
            </a>
        </div>
    <?php endif; ?>

    <!-- Views (if you have a views counter plugin) -->
    <?php if (function_exists('blaze_get_post_views')) : ?>
        <div class="meta-views flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            <span><?php echo esc_html(blaze_get_post_views(get_the_ID())); ?> <?php esc_html_e('Views', 'blaze'); ?></span>
        </div>
    <?php endif; ?>

</div>