<?php
/**
 * Call-to-Action Section Block
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// CTA settings
$cta_title = get_theme_mod('blaze_cta_title', __('Ready to Get Started?', 'blaze'));
$cta_description = get_theme_mod('blaze_cta_description', __('Join thousands of satisfied customers and transform your business today.', 'blaze'));
$cta_button_text = get_theme_mod('blaze_cta_button_text', __('Start Free Trial', 'blaze'));
$cta_button_url = get_theme_mod('blaze_cta_button_url', '#');
$cta_secondary_text = get_theme_mod('blaze_cta_secondary_text', __('Contact Sales', 'blaze'));
$cta_secondary_url = get_theme_mod('blaze_cta_secondary_url', '/contact');
?>

<section class="cta-section relative overflow-hidden py-20 bg-gradient-to-br from-primary to-primary-dark text-white">
    
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="cta-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                    <circle cx="30" cy="30" r="2" fill="currentColor"/>
                </pattern>
            </defs>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#cta-pattern)"/>
        </svg>
    </div>

    <!-- Floating Shapes -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl relative z-10">
        
        <div class="text-center">
            
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-medium mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span><?php esc_html_e('Limited Time Offer', 'blaze'); ?></span>
            </div>

            <!-- Title -->
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                <?php echo wp_kses_post($cta_title); ?>
            </h2>

            <!-- Description -->
            <p class="text-lg md:text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                <?php echo wp_kses_post($cta_description); ?>
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-10">
                <a href="<?php echo esc_url($cta_button_url); ?>" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-primary font-semibold rounded-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl hover:scale-105">
                    <span><?php echo esc_html($cta_button_text); ?></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>

                <a href="<?php echo esc_url($cta_secondary_url); ?>" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent text-white font-semibold rounded-lg border-2 border-white/30 hover:bg-white/10 transition-all backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span><?php echo esc_html($cta_secondary_text); ?></span>
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="flex flex-wrap items-center justify-center gap-8 pt-10 border-t border-white/20">
                
                <!-- Feature 1 -->
                <div class="flex items-center gap-2 text-white/90">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium"><?php esc_html_e('No credit card required', 'blaze'); ?></span>
                </div>

                <!-- Feature 2 -->
                <div class="flex items-center gap-2 text-white/90">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium"><?php esc_html_e('14-day free trial', 'blaze'); ?></span>
                </div>

                <!-- Feature 3 -->
                <div class="flex items-center gap-2 text-white/90">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium"><?php esc_html_e('Cancel anytime', 'blaze'); ?></span>
                </div>

            </div>

            <!-- Social Proof -->
            <div class="mt-10 flex items-center justify-center gap-2 text-white/80 text-sm">
                <div class="flex -space-x-2">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <div class="w-8 h-8 rounded-full bg-white/20 border-2 border-primary flex items-center justify-center text-xs font-bold">
                            <?php echo $i; ?>
                        </div>
                    <?php endfor; ?>
                </div>
                <span><?php esc_html_e('Join 10,000+ happy customers', 'blaze'); ?></span>
            </div>

        </div>

    </div>

</section>