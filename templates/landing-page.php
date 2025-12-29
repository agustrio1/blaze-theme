<?php
/**
 * Template Name: Landing Page
 * Template Post Type: page
 * 
 * Full-width landing page without header/footer navigation
 * 
 * @package Blaze_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('landing-page'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <!-- Simple Header -->
    <header class="landing-header py-6 bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex items-center justify-between">
                
                <!-- Logo -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-gray-900 hover:text-primary transition-colors">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- CTA Button -->
                <div class="landing-cta">
                    <a href="#contact" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all shadow-md hover:shadow-lg">
                        <span><?php esc_html_e('Get Started', 'blaze'); ?></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="primary" class="site-main">

        <?php
        while (have_posts()) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'blaze'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

            </article>

            <?php
        endwhile;
        ?>

    </main>

    <!-- Simple Footer -->
    <footer class="landing-footer py-8 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-600">
                
                <!-- Copyright -->
                <div class="text-center md:text-left">
                    <?php
                    printf(
                        esc_html__('© %1$s %2$s. All rights reserved.', 'blaze'),
                        date('Y'),
                        get_bloginfo('name')
                    );
                    ?>
                </div>

                <!-- Links -->
                <div class="flex items-center gap-6">
                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="hover:text-primary transition-colors">
                        <?php esc_html_e('Privacy', 'blaze'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/terms')); ?>" class="hover:text-primary transition-colors">
                        <?php esc_html_e('Terms', 'blaze'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="hover:text-primary transition-colors">
                        <?php esc_html_e('Contact', 'blaze'); ?>
                    </a>
                </div>

            </div>

        </div>
    </footer>

</div>

<?php wp_footer(); ?>

</body>
</html>