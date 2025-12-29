<?php
/**
 * Features Grid Block
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Features data
$features = array(
    array(
        'icon'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>',
        'title'       => __('Lightning Fast', 'blaze'),
        'description' => __('Optimized for speed and performance with modern technologies.', 'blaze'),
    ),
    array(
        'icon'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>',
        'title'       => __('Fully Responsive', 'blaze'),
        'description' => __('Looks perfect on all devices from mobile to desktop.', 'blaze'),
    ),
    array(
        'icon'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>',
        'title'       => __('Easy Customization', 'blaze'),
        'description' => __('Customize colors, fonts, and layouts with live preview.', 'blaze'),
    ),
    array(
        'icon'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
        'title'       => __('Secure & Reliable', 'blaze'),
        'description' => __('Built with security best practices and regular updates.', 'blaze'),
    ),
    array(
        'icon'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>',
        'title'       => __('SEO Optimized', 'blaze'),
        'description' => __('Structured data and semantic HTML for better rankings.', 'blaze'),
    ),
    array(
        'icon'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>',
        'title'       => __('24/7 Support', 'blaze'),
        'description' => __('Get help whenever you need it with our dedicated support.', 'blaze'),
    ),
);
?>

<section class="features-section py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        
        <!-- Section Header -->
        <header class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                <?php esc_html_e('Powerful Features', 'blaze'); ?>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                <?php esc_html_e('Everything you need to build a modern, professional website', 'blaze'); ?>
            </p>
        </header>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php foreach ($features as $index => $feature) : ?>
                <div class="feature-card group bg-white p-8 rounded-xl border-2 border-gray-100 hover:border-primary hover:shadow-xl transition-all duration-300">
                    
                    <!-- Icon -->
                    <div class="feature-icon w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                        <svg class="w-8 h-8 text-primary group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <?php echo $feature['icon']; ?>
                        </svg>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">
                        <?php echo esc_html($feature['title']); ?>
                    </h3>

                    <!-- Description -->
                    <p class="text-gray-600 leading-relaxed">
                        <?php echo esc_html($feature['description']); ?>
                    </p>

                    <!-- Learn More Link -->
                    <a href="#" class="inline-flex items-center gap-2 mt-4 text-primary font-medium text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                        <span><?php esc_html_e('Learn more', 'blaze'); ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- CTA Section -->
        <div class="text-center mt-16">
            <p class="text-gray-600 mb-6">
                <?php esc_html_e('Ready to get started?', 'blaze'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all shadow-lg hover:shadow-xl">
                <span><?php esc_html_e('Contact Us Today', 'blaze'); ?></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

    </div>
</section>