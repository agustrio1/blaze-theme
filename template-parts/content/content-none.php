<?php
/**
 * No Content Found Template
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="no-results not-found text-center py-20">
    
    <div class="max-w-2xl mx-auto">
        
        <!-- Icon -->
        <div class="mb-8">
            <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <header class="page-header mb-6">
            <h1 class="page-title text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                <?php
                if (is_search()) :
                    printf(esc_html__('No results found for: %s', 'blaze'), '<span class="text-primary">' . get_search_query() . '</span>');
                else :
                    esc_html_e('Nothing Found', 'blaze');
                endif;
                ?>
            </h1>
        </header>

        <div class="page-content mb-8">
            <?php if (is_home() && current_user_can('publish_posts')) : ?>

                <p class="text-gray-600 mb-6">
                    <?php
                    printf(
                        wp_kses(
                            __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'blaze'),
                            array('a' => array('href' => array()))
                        ),
                        esc_url(admin_url('post-new.php'))
                    );
                    ?>
                </p>

            <?php elseif (is_search()) : ?>

                <p class="text-gray-600 mb-8">
                    <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'blaze'); ?>
                </p>

                <!-- Search Form -->
                <div class="max-w-lg mx-auto">
                    <?php get_search_form(); ?>
                </div>

                <!-- Search Suggestions -->
                <div class="mt-12 text-left">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <?php esc_html_e('Search Suggestions:', 'blaze'); ?>
                    </h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <?php esc_html_e('Check your spelling', 'blaze'); ?>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <?php esc_html_e('Try more general keywords', 'blaze'); ?>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <?php esc_html_e('Try different keywords', 'blaze'); ?>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <?php esc_html_e('Try fewer keywords', 'blaze'); ?>
                        </li>
                    </ul>
                </div>

            <?php else : ?>

                <p class="text-gray-600 mb-6">
                    <?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'blaze'); ?>
                </p>

                <!-- Search Form -->
                <div class="max-w-lg mx-auto">
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>
        </div>

        <!-- Browse Categories -->
        <?php
        $categories = get_categories(array(
            'orderby' => 'count',
            'order'   => 'DESC',
            'number'  => 6,
        ));

        if ($categories) : ?>
            <div class="browse-categories mt-12 pt-12 border-t border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    <?php esc_html_e('Browse by Category', 'blaze'); ?>
                </h3>
                <div class="flex flex-wrap justify-center gap-3">
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors">
                            <?php echo esc_html($category->name); ?>
                            <span class="text-xs opacity-75">(<?php echo esc_html($category->count); ?>)</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Back to Home -->
        <div class="mt-8">
            <a href="<?php echo esc_url(home_url('/')); ?>" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <?php esc_html_e('Back to Home', 'blaze'); ?>
            </a>
        </div>

    </div>

</section>