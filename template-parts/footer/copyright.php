<?php
/**
 * Copyright Text
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$copyright_text = get_theme_mod('blaze_copyright_text', sprintf(__('© %s. All rights reserved.', 'blaze'), date('Y')));
?>

<div class="copyright-section py-6 border-t border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-600">
            
            <!-- Copyright Text -->
            <div class="copyright-text text-center md:text-left">
                <?php echo wp_kses_post($copyright_text); ?>
                <?php if (!strpos($copyright_text, get_bloginfo('name'))) : ?>
                    <span class="mx-2">|</span>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-primary transition-colors">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Footer Menu -->
            <?php if (has_nav_menu('footer')) : ?>
                <nav class="footer-menu" aria-label="<?php esc_attr_e('Footer Menu', 'blaze'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'flex flex-wrap items-center justify-center gap-4 md:gap-6',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </nav>
            <?php endif; ?>

            <!-- Theme Credit (optional) -->
            <div class="theme-credit text-center md:text-right">
                <?php
                printf(
                    esc_html__('Powered by %1$s & %2$s', 'blaze'),
                    '<a href="https://wordpress.org" class="hover:text-primary transition-colors" target="_blank" rel="noopener">WordPress</a>',
                    '<a href="#" class="hover:text-primary transition-colors">Blaze Theme</a>'
                );
                ?>
            </div>

        </div>

    </div>
</div>

<style>
    .footer-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-menu a {
        color: #6B7280;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .footer-menu a:hover {
        color: #DC2626;
    }
</style>