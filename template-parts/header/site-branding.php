<?php
/**
 * Site Branding - Logo & Site Title
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="site-branding flex items-center gap-4">
    
    <?php if (has_custom_logo()) : ?>
        <div class="custom-logo">
            <?php the_custom_logo(); ?>
        </div>
    <?php endif; ?>

    <div class="site-identity flex flex-col">
        <?php if (is_front_page() && is_home()) : ?>
            <h1 class="site-title text-2xl md:text-3xl font-bold text-gray-900 mb-0">
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="hover:text-primary transition-colors" 
                   rel="home">
                    <?php bloginfo('name'); ?>
                </a>
            </h1>
        <?php else : ?>
            <p class="site-title text-2xl md:text-3xl font-bold text-gray-900 mb-0">
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="hover:text-primary transition-colors" 
                   rel="home">
                    <?php bloginfo('name'); ?>
                </a>
            </p>
        <?php endif; ?>

        <?php
        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) : ?>
            <p class="site-description text-sm text-gray-600 mt-1">
                <?php echo esc_html($description); ?>
            </p>
        <?php endif; ?>
    </div>

</div>

<style>
    .custom-logo-link {
        display: inline-block;
        transition: opacity 0.2s ease;
    }
    
    .custom-logo-link:hover {
        opacity: 0.8;
    }
    
    .custom-logo-link img {
        max-height: 60px;
        width: auto;
        height: auto;
    }
    
    @media (max-width: 768px) {
        .custom-logo-link img {
            max-height: 50px;
        }
        
        .site-description {
            display: none;
        }
    }
</style>