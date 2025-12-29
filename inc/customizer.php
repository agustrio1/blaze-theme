<?php
/**
 * Theme Customizer Settings
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register customizer settings
 */
function blaze_customize_register($wp_customize) {
    
    // ===================================
    // GENERAL SETTINGS PANEL
    // ===================================
    $wp_customize->add_panel('blaze_general', array(
        'title'       => __('Blaze Theme Settings', 'blaze'),
        'description' => __('Customize your theme appearance and behavior', 'blaze'),
        'priority'    => 10,
    ));
    
    // ===================================
    // COLORS SECTION
    // ===================================
    $wp_customize->add_section('blaze_colors', array(
        'title'       => __('Colors', 'blaze'),
        'description' => __('Customize theme colors', 'blaze'),
        'panel'       => 'blaze_general',
        'priority'    => 10,
    ));
    
    // Primary Color
    $wp_customize->add_setting('blaze_primary_color', array(
        'default'           => '#DC2626',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_primary_color', array(
        'label'       => __('Primary Color', 'blaze'),
        'description' => __('Main brand color used throughout the theme', 'blaze'),
        'section'     => 'blaze_colors',
        'type'        => 'color',
        'priority'    => 10,
    ));
    
    // Secondary Color
    $wp_customize->add_setting('blaze_secondary_color', array(
        'default'           => '#1F2937',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_secondary_color', array(
        'label'       => __('Secondary Color', 'blaze'),
        'description' => __('Secondary brand color for accents', 'blaze'),
        'section'     => 'blaze_colors',
        'type'        => 'color',
        'priority'    => 20,
    ));
    
    // Text Color
    $wp_customize->add_setting('blaze_text_color', array(
        'default'           => '#111827',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_text_color', array(
        'label'       => __('Text Color', 'blaze'),
        'description' => __('Main text color', 'blaze'),
        'section'     => 'blaze_colors',
        'type'        => 'color',
        'priority'    => 30,
    ));
    
    // ===================================
    // TYPOGRAPHY SECTION
    // ===================================
    $wp_customize->add_section('blaze_typography', array(
        'title'       => __('Typography', 'blaze'),
        'description' => __('Customize fonts and text appearance', 'blaze'),
        'panel'       => 'blaze_general',
        'priority'    => 20,
    ));
    
    // Heading Font
    $wp_customize->add_setting('blaze_heading_font', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_heading_font', array(
        'label'       => __('Heading Font', 'blaze'),
        'description' => __('Font family for headings', 'blaze'),
        'section'     => 'blaze_typography',
        'type'        => 'select',
        'choices'     => array(
            'Inter'      => 'Inter',
            'Poppins'    => 'Poppins',
            'Roboto'     => 'Roboto',
            'Montserrat' => 'Montserrat',
            'Open Sans'  => 'Open Sans',
        ),
        'priority'    => 10,
    ));
    
    // Body Font
    $wp_customize->add_setting('blaze_body_font', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_body_font', array(
        'label'       => __('Body Font', 'blaze'),
        'description' => __('Font family for body text', 'blaze'),
        'section'     => 'blaze_typography',
        'type'        => 'select',
        'choices'     => array(
            'Inter'      => 'Inter',
            'Poppins'    => 'Poppins',
            'Roboto'     => 'Roboto',
            'Lato'       => 'Lato',
            'Open Sans'  => 'Open Sans',
        ),
        'priority'    => 20,
    ));
    
    // Font Size
    $wp_customize->add_setting('blaze_font_size', array(
        'default'           => 16,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_font_size', array(
        'label'       => __('Base Font Size (px)', 'blaze'),
        'description' => __('Base font size for body text', 'blaze'),
        'section'     => 'blaze_typography',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
        'priority'    => 30,
    ));
    
    // ===================================
    // HEADER SECTION
    // ===================================
    $wp_customize->add_section('blaze_header', array(
        'title'       => __('Header', 'blaze'),
        'description' => __('Customize header appearance', 'blaze'),
        'panel'       => 'blaze_general',
        'priority'    => 30,
    ));
    
    // Header Style
    $wp_customize->add_setting('blaze_header_style', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('blaze_header_style', array(
        'label'       => __('Header Style', 'blaze'),
        'section'     => 'blaze_header',
        'type'        => 'select',
        'choices'     => array(
            'default'     => __('Default', 'blaze'),
            'transparent' => __('Transparent', 'blaze'),
            'sticky'      => __('Sticky', 'blaze'),
            'center'      => __('Centered', 'blaze'),
        ),
        'priority'    => 10,
    ));
    
    // Show Search
    $wp_customize->add_setting('blaze_show_search', array(
        'default'           => true,
        'sanitize_callback' => 'blaze_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_show_search', array(
        'label'       => __('Show Search Button', 'blaze'),
        'description' => __('Display search button in header', 'blaze'),
        'section'     => 'blaze_header',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));
    
    // ===================================
    // FOOTER SECTION
    // ===================================
    $wp_customize->add_section('blaze_footer', array(
        'title'       => __('Footer', 'blaze'),
        'description' => __('Customize footer appearance', 'blaze'),
        'panel'       => 'blaze_general',
        'priority'    => 40,
    ));
    
    // Copyright Text
    $wp_customize->add_setting('blaze_copyright_text', array(
        'default'           => sprintf(__('© %s. All rights reserved.', 'blaze'), date('Y')),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_copyright_text', array(
        'label'       => __('Copyright Text', 'blaze'),
        'description' => __('Enter your copyright text', 'blaze'),
        'section'     => 'blaze_footer',
        'type'        => 'textarea',
        'priority'    => 10,
    ));
    
    // Show Social Links
    $wp_customize->add_setting('blaze_show_social', array(
        'default'           => true,
        'sanitize_callback' => 'blaze_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blaze_show_social', array(
        'label'       => __('Show Social Links', 'blaze'),
        'description' => __('Display social media links in footer', 'blaze'),
        'section'     => 'blaze_footer',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));
    
    // ===================================
    // BLOG SECTION
    // ===================================
    $wp_customize->add_section('blaze_blog', array(
        'title'       => __('Blog', 'blaze'),
        'description' => __('Customize blog layout and appearance', 'blaze'),
        'panel'       => 'blaze_general',
        'priority'    => 50,
    ));
    
    // Blog Layout
    $wp_customize->add_setting('blaze_blog_layout', array(
        'default'           => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('blaze_blog_layout', array(
        'label'       => __('Blog Layout', 'blaze'),
        'section'     => 'blaze_blog',
        'type'        => 'select',
        'choices'     => array(
            'list'     => __('List', 'blaze'),
            'grid'     => __('Grid', 'blaze'),
            'masonry'  => __('Masonry', 'blaze'),
        ),
        'priority'    => 10,
    ));
    
    // Show Excerpt
    $wp_customize->add_setting('blaze_show_excerpt', array(
        'default'           => true,
        'sanitize_callback' => 'blaze_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('blaze_show_excerpt', array(
        'label'       => __('Show Post Excerpt', 'blaze'),
        'section'     => 'blaze_blog',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));
    
    // Excerpt Length
    $wp_customize->add_setting('blaze_excerpt_length', array(
        'default'           => 30,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('blaze_excerpt_length', array(
        'label'       => __('Excerpt Length (words)', 'blaze'),
        'section'     => 'blaze_blog',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 5,
        ),
        'priority'    => 30,
    ));
    
    // ===================================
    // PERFORMANCE SECTION
    // ===================================
    $wp_customize->add_section('blaze_performance', array(
        'title'       => __('Performance', 'blaze'),
        'description' => __('Optimize theme performance', 'blaze'),
        'panel'       => 'blaze_general',
        'priority'    => 60,
    ));
    
    // Lazy Load Images
    $wp_customize->add_setting('blaze_lazy_load', array(
        'default'           => true,
        'sanitize_callback' => 'blaze_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('blaze_lazy_load', array(
        'label'       => __('Enable Lazy Loading', 'blaze'),
        'description' => __('Lazy load images for better performance', 'blaze'),
        'section'     => 'blaze_performance',
        'type'        => 'checkbox',
        'priority'    => 10,
    ));
}
add_action('customize_register', 'blaze_customize_register');

/**
 * Sanitize checkbox
 */
function blaze_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Enqueue customizer scripts
 */
function blaze_customizer_scripts() {
    wp_enqueue_script(
        'blaze-customizer',
        get_template_directory_uri() . '/dist/js/admin.js',
        array('jquery', 'customize-controls'),
        BLAZE_VERSION,
        true
    );
    
    wp_enqueue_style(
        'blaze-customizer-styles',
        get_template_directory_uri() . '/dist/css/main.css',
        array(),
        BLAZE_VERSION
    );
}
add_action('customize_controls_enqueue_scripts', 'blaze_customizer_scripts');

/**
 * Live preview scripts
 */
function blaze_customizer_live_preview() {
    wp_enqueue_script(
        'blaze-customizer-preview',
        get_template_directory_uri() . '/inc/admin/customizer-preview.js',
        array('jquery', 'customize-preview'),
        BLAZE_VERSION,
        true
    );
}
add_action('customize_preview_init', 'blaze_customizer_live_preview');