<?php
/**
 * Blaze Theme Functions
 *
 * @package Blaze
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('BLAZE_VERSION', '1.0.0');
define('BLAZE_DIR', get_template_directory());
define('BLAZE_URI', get_template_directory_uri());

// Load theme setup
require_once BLAZE_DIR . '/inc/theme-setup.php';

// Load customizer
require_once BLAZE_DIR . '/inc/customizer.php';

// Load enqueue scripts
require_once BLAZE_DIR . '/inc/enqueue.php';

// Load widgets
require_once BLAZE_DIR . '/inc/widgets.php';

/**
 * Add REST API endpoint for theme customizer live preview
 */
add_action('rest_api_init', function() {
    register_rest_route('blaze/v1', '/theme-settings', array(
        'methods' => 'GET',
        'callback' => 'blaze_get_theme_settings',
        'permission_callback' => '__return_true'
    ));
});

function blaze_get_theme_settings() {
    return array(
        'primary_color' => get_theme_mod('blaze_primary_color', '#DC2626'),
        'site_title' => get_bloginfo('name'),
        'site_description' => get_bloginfo('description'),
        'logo_url' => wp_get_attachment_url(get_theme_mod('custom_logo')),
    );
}