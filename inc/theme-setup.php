<?php
/**
 * Theme Setup and Configuration
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function blaze_theme_setup() {
    
    // Make theme available for translation
    load_theme_textdomain('blaze', get_template_directory() . '/languages');
    
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);
    
    // Add custom image sizes
    add_image_size('blaze-featured', 1920, 1080, true);
    add_image_size('blaze-thumbnail', 600, 400, true);
    add_image_size('blaze-square', 800, 800, true);
    add_image_size('blaze-portrait', 800, 1200, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', 'blaze'),
        'footer'    => esc_html__('Footer Menu', 'blaze'),
        'social'    => esc_html__('Social Links', 'blaze'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));
    
    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image'      => '',
        'width'              => 1920,
        'height'             => 600,
        'flex-height'        => true,
        'flex-width'         => true,
        'header-text'        => true,
        'default-text-color' => '000000',
    ));
    
    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color'      => 'ffffff',
        'default-image'      => '',
        'default-repeat'     => 'no-repeat',
        'default-position-x' => 'center',
        'default-attachment' => 'fixed',
    ));
    
    // Add support for full and wide align images
    add_theme_support('align-wide');
    
    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('dist/css/main.css');
    
    // Add support for block styles
    add_theme_support('wp-block-styles');
    
    // Add support for editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primary', 'blaze'),
            'slug'  => 'primary',
            'color' => '#DC2626',
        ),
        array(
            'name'  => esc_html__('Secondary', 'blaze'),
            'slug'  => 'secondary',
            'color' => '#1F2937',
        ),
        array(
            'name'  => esc_html__('Gray', 'blaze'),
            'slug'  => 'gray',
            'color' => '#6B7280',
        ),
        array(
            'name'  => esc_html__('Light Gray', 'blaze'),
            'slug'  => 'light-gray',
            'color' => '#F3F4F6',
        ),
        array(
            'name'  => esc_html__('White', 'blaze'),
            'slug'  => 'white',
            'color' => '#FFFFFF',
        ),
        array(
            'name'  => esc_html__('Black', 'blaze'),
            'slug'  => 'black',
            'color' => '#000000',
        ),
    ));
    
    // Add support for editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'blaze'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Normal', 'blaze'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => esc_html__('Medium', 'blaze'),
            'size' => 20,
            'slug' => 'medium'
        ),
        array(
            'name' => esc_html__('Large', 'blaze'),
            'size' => 24,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Huge', 'blaze'),
            'size' => 32,
            'slug' => 'huge'
        )
    ));
    
    // Disable custom colors in block editor
    add_theme_support('disable-custom-colors');
    
    // Disable custom font sizes in block editor
    add_theme_support('disable-custom-font-sizes');
    
    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'blaze_theme_setup');

/**
 * Set content width
 */
function blaze_content_width() {
    $GLOBALS['content_width'] = apply_filters('blaze_content_width', 1200);
}
add_action('after_setup_theme', 'blaze_content_width', 0);

/**
 * Register widget areas
 */
function blaze_widgets_init() {
    
    // Primary Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Primary Sidebar', 'blaze'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Main sidebar that appears on the right.', 'blaze'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title text-xl font-bold mb-4">',
        'after_title'   => '</h3>',
    ));
    
    // Footer Widget Area 1
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 1', 'blaze'),
        'id'            => 'footer-1',
        'description'   => esc_html__('First footer widget area.', 'blaze'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-lg font-bold mb-4">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Widget Area 2
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 2', 'blaze'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Second footer widget area.', 'blaze'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-lg font-bold mb-4">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Widget Area 3
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 3', 'blaze'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Third footer widget area.', 'blaze'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-lg font-bold mb-4">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Widget Area 4
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 4', 'blaze'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Fourth footer widget area.', 'blaze'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-lg font-bold mb-4">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'blaze_widgets_init');

/**
 * Custom excerpt length
 */
function blaze_excerpt_length($length) {
    $excerpt_length = get_theme_mod('blaze_excerpt_length', 30);
    return absint($excerpt_length);
}
add_filter('excerpt_length', 'blaze_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function blaze_excerpt_more($more) {
    return '... <a href="' . get_permalink() . '" class="read-more">' . esc_html__('Read More', 'blaze') . '</a>';
}
add_filter('excerpt_more', 'blaze_excerpt_more');

/**
 * Add body classes
 */
function blaze_body_classes($classes) {
    
    // Add class if no sidebar
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    
    // Add class for singular pages
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    // Add class for header style
    $header_style = get_theme_mod('blaze_header_style', 'default');
    $classes[] = 'header-' . $header_style;
    
    // Add class for blog layout
    if (is_home() || is_archive()) {
        $blog_layout = get_theme_mod('blaze_blog_layout', 'grid');
        $classes[] = 'blog-' . $blog_layout;
    }
    
    return $classes;
}
add_filter('body_class', 'blaze_body_classes');

/**
 * Add pingback header
 */
function blaze_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'blaze_pingback_header');