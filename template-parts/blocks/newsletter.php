<?php
/**
 * Newsletter Signup Block
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="newsletter-section py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                
                <!-- Newsletter Content -->
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    
                    <!-- Icon -->
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-xl mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>

                    <!-- Title -->
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        <?php esc_html_e('Stay Updated', 'blaze'); ?>
                    </h2>

                    <!-- Description -->
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        <?php esc_html_e('Subscribe to our newsletter and get the latest updates, tips, and exclusive content delivered straight to your inbox.', 'blaze'); ?>
                    </p>

                    <!-- Benefits List -->
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700"><?php esc_html_e('Weekly industry insights and trends', 'blaze'); ?></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700"><?php esc_html_e('Exclusive tips and resources', 'blaze'); ?></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700"><?php esc_html_e('Early access to new features', 'blaze'); ?></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700"><?php esc_html_e('No spam, unsubscribe anytime', 'blaze'); ?></span>
                        </li>
                    </ul>

                    <!-- Stats -->
                    <div class="flex items-center gap-6 pt-6 border-t border-gray-100">
                        <div>
                            <div class="text-2xl font-bold text-gray-900">10K+</div>
                            <div class="text-sm text-gray-600"><?php esc_html_e('Subscribers', 'blaze'); ?></div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">4.9★</div>
                            <div class="text-sm text-gray-600"><?php esc_html_e('Rating', 'blaze'); ?></div>
                        </div>
                    </div>

                </div>

                <!-- Newsletter Form -->
                <div class="bg-gradient-to-br from-primary/5 to-primary/10 p-8 md:p-12 flex items-center">
                    
                    <div class="w-full">
                        
                        <!-- Svelte Newsletter Component Mount Point -->
                        <div class="newsletter-mount" 
                             data-api-url="<?php echo esc_attr(rest_url('blaze/v1/newsletter')); ?>">
                        </div>

                        <!-- Alternative: Simple HTML Form -->
                        <form action="#" method="post" class="newsletter-form space-y-4">
                            
                            <!-- Name Input -->
                            <div>
                                <label for="newsletter-name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php esc_html_e('Your Name', 'blaze'); ?>
                                </label>
                                <input type="text" 
                                       id="newsletter-name" 
                                       name="name"
                                       placeholder="<?php esc_attr_e('John Doe', 'blaze'); ?>"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="newsletter-email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <?php esc_html_e('Email Address', 'blaze'); ?>
                                </label>
                                <input type="email" 
                                       id="newsletter-email" 
                                       name="email"
                                       placeholder="<?php esc_attr_e('your@email.com', 'blaze'); ?>"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all shadow-md hover:shadow-lg">
                                <span><?php esc_html_e('Subscribe Now', 'blaze'); ?></span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>

                            <!-- Privacy Notice -->
                            <p class="text-xs text-gray-600 text-center">
                                <?php 
                                printf(
                                    esc_html__('By subscribing, you agree to our %s and %s', 'blaze'),
                                    '<a href="' . esc_url(home_url('/privacy-policy')) . '" class="text-primary hover:underline">' . esc_html__('Privacy Policy', 'blaze') . '</a>',
                                    '<a href="' . esc_url(home_url('/terms')) . '" class="text-primary hover:underline">' . esc_html__('Terms', 'blaze') . '</a>'
                                );
                                ?>
                            </p>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>