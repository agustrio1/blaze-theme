<?php
/**
 * Footer Widget Areas
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Check if any footer widget areas are active
$has_footer_widgets = false;
for ($i = 1; $i <= 4; $i++) {
    if (is_active_sidebar("footer-$i")) {
        $has_footer_widgets = true;
        break;
    }
}

if (!$has_footer_widgets) {
    return;
}
?>

<div class="footer-widgets py-12 border-t border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Footer Widget Area 1 -->
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>

            <!-- Footer Widget Area 2 -->
            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>

            <!-- Footer Widget Area 3 -->
            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>

            <!-- Footer Widget Area 4 -->
            <?php if (is_active_sidebar('footer-4')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>

<style>
    .footer-widget-area .widget {
        margin-bottom: 2rem;
    }
    
    .footer-widget-area .widget:last-child {
        margin-bottom: 0;
    }
    
    .footer-widget-area .widget-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
    }
    
    .footer-widget-area ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-widget-area ul li {
        margin-bottom: 0.5rem;
    }
    
    .footer-widget-area ul li:last-child {
        margin-bottom: 0;
    }
    
    .footer-widget-area a {
        color: #6B7280;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .footer-widget-area a:hover {
        color: #DC2626;
    }
</style>