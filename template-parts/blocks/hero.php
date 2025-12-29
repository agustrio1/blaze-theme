<?php
/**
 * Hero Section Block
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Hero settings
$hero_title = get_theme_mod('blaze_hero_title', __('Welcome to Blaze Theme', 'blaze'));
$hero_subtitle = get_theme_mod('blaze_hero_subtitle', __('Build amazing websites with modern technology', 'blaze'));
$hero_button_text = get_theme_mod('blaze_hero_button_text', __('Get Started', 'blaze'));
$hero_button_url = get_theme_mod('blaze_hero_button_url', '#');
$hero_image = get_theme_mod('blaze_hero_image', '');
?>

<section class="hero-section relative overflow-hidden bg-white py-20 md:py-32">
    
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="currentColor" class="text-primary"/>
                </pattern>
            </defs>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#hero-pattern)"/>
        </svg>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Hero Content -->
            <div class="text-center lg:text-left animate-fade-in">
                
                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    <?php echo wp_kses_post($hero_title); ?>
                </h1>

                <!-- Subtitle -->
                <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto lg:mx-0">
                    <?php echo wp_kses_post($hero_subtitle); ?>
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="<?php echo esc_url($hero_button_url); ?>" 
                       class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all shadow-lg hover:shadow-xl">
                        <span><?php echo esc_html($hero_button_text); ?></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    
                    <a href="<?php echo esc_url(home_url('/about')); ?>" 
                       class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all border-2 border-gray-200">
                        <span><?php esc_html_e('Learn More', 'blaze'); ?></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>
                </div>

                <!-- Stats/Features -->
                <div class="grid grid-cols-3 gap-6 mt-12 pt-12 border-t border-gray-200">
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-primary mb-1">100+</div>
                        <div class="text-sm text-gray-600"><?php esc_html_e('Projects', 'blaze'); ?></div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-primary mb-1">50+</div>
                        <div class="text-sm text-gray-600"><?php esc_html_e('Clients', 'blaze'); ?></div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-primary mb-1">5+</div>
                        <div class="text-sm text-gray-600"><?php esc_html_e('Years', 'blaze'); ?></div>
                    </div>
                </div>

            </div>

            <!-- Hero Image -->
            <div class="relative animate-slide-up">
                <?php if ($hero_image) : ?>
                    <img src="<?php echo esc_url($hero_image); ?>" 
                         alt="<?php echo esc_attr($hero_title); ?>"
                         class="w-full h-auto rounded-2xl shadow-2xl">
                <?php else : ?>
                    <!-- Placeholder SVG -->
                    <div class="w-full aspect-square bg-gradient-to-br from-primary/20 to-primary/5 rounded-2xl flex items-center justify-center">
                        <svg class="w-32 h-32 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                <?php endif; ?>

                <!-- Floating Elements -->
                <div class="absolute -top-6 -right-6 w-24 h-24 bg-primary/10 rounded-full blur-2xl animate-pulse"></div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary/10 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
            </div>

        </div>

    </div>

    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 w-full">
        <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>

</section>