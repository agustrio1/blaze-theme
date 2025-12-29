<?php
/**
 * Page Title Section
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="page-header py-12 md:py-16 mb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        
        <div class="max-w-4xl mx-auto text-center">
            
            <!-- Page Title -->
            <?php if (is_archive()) : ?>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } elseif (is_author()) {
                        printf(esc_html__('Author: %s', 'blaze'), '<span class="vcard">' . get_the_author() . '</span>');
                    } elseif (is_year()) {
                        printf(esc_html__('Year: %s', 'blaze'), get_the_date('Y'));
                    } elseif (is_month()) {
                        printf(esc_html__('Month: %s', 'blaze'), get_the_date('F Y'));
                    } elseif (is_day()) {
                        printf(esc_html__('Day: %s', 'blaze'), get_the_date('F j, Y'));
                    } elseif (is_tax('post_format')) {
                        if (is_tax('post_format', 'post-format-aside')) {
                            esc_html_e('Asides', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-gallery')) {
                            esc_html_e('Galleries', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-image')) {
                            esc_html_e('Images', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-video')) {
                            esc_html_e('Videos', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-quote')) {
                            esc_html_e('Quotes', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-link')) {
                            esc_html_e('Links', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-status')) {
                            esc_html_e('Statuses', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-audio')) {
                            esc_html_e('Audio', 'blaze');
                        } elseif (is_tax('post_format', 'post-format-chat')) {
                            esc_html_e('Chats', 'blaze');
                        }
                    } else {
                        esc_html_e('Archives', 'blaze');
                    }
                    ?>
                </h1>

                <!-- Archive Description -->
                <?php
                $description = get_the_archive_description();
                if ($description) : ?>
                    <div class="archive-description text-lg text-gray-600 mb-6 max-w-2xl mx-auto">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>

                <!-- Archive Meta -->
                <div class="archive-meta flex flex-wrap items-center justify-center gap-4 text-sm text-gray-500">
                    <?php
                    $post_count = $wp_query->found_posts;
                    if ($post_count) : ?>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <?php printf(_n('%s Post', '%s Posts', $post_count, 'blaze'), number_format_i18n($post_count)); ?>
                        </span>
                    <?php endif; ?>
                </div>

            <?php elseif (is_search()) : ?>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    <?php printf(esc_html__('Search Results for: %s', 'blaze'), '<span class="text-primary">' . get_search_query() . '</span>'); ?>
                </h1>

                <?php
                $result_count = $wp_query->found_posts;
                if ($result_count) : ?>
                    <p class="text-lg text-gray-600">
                        <?php printf(_n('Found %s result', 'Found %s results', $result_count, 'blaze'), '<strong>' . number_format_i18n($result_count) . '</strong>'); ?>
                    </p>
                <?php endif; ?>

            <?php elseif (is_404()) : ?>
                
                <div class="text-center py-12">
                    <div class="text-8xl md:text-9xl font-bold text-primary mb-4">404</div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        <?php esc_html_e('Page Not Found', 'blaze'); ?>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'blaze'); ?>
                    </p>
                </div>

            <?php else : ?>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    <?php single_post_title(); ?>
                </h1>

            <?php endif; ?>

        </div>

    </div>
</div>