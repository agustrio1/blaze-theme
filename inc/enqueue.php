<?php
/**
 * Enqueue Scripts and Styles
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue frontend styles and scripts
 */
function blaze_enqueue_scripts() {
    
    // Main stylesheet (Tailwind CSS compiled)
    wp_enqueue_style(
        'blaze-style',
        get_template_directory_uri() . '/dist/css/main.css',
        array(),
        BLAZE_VERSION
    );
    
    // Theme style.css (required by WordPress)
    wp_enqueue_style(
        'blaze-theme-style',
        get_stylesheet_uri(),
        array('blaze-style'),
        BLAZE_VERSION
    );
    
    // Google Fonts
    $heading_font = get_theme_mod('blaze_heading_font', 'Inter');
    $body_font = get_theme_mod('blaze_body_font', 'Inter');
    
    $fonts_url = blaze_fonts_url($heading_font, $body_font);
    if ($fonts_url) {
        wp_enqueue_style(
            'blaze-fonts',
            $fonts_url,
            array(),
            null
        );
    }
    
    // Main JavaScript bundle (Vite compiled with Svelte)
    wp_enqueue_script(
        'blaze-main',
        get_template_directory_uri() . '/dist/js/bundle.js',
        array(),
        BLAZE_VERSION,
        true
    );
    
    // Localize script for AJAX and theme data
    wp_localize_script('blaze-main', 'blazeData', array(
        'ajaxUrl'       => admin_url('admin-ajax.php'),
        'nonce'         => wp_create_nonce('blaze_nonce'),
        'siteUrl'       => home_url('/'),
        'themePath'     => get_template_directory_uri(),
        'isRTL'         => is_rtl(),
        'primaryColor'  => get_theme_mod('blaze_primary_color', '#DC2626'),
        'searchUrl'     => home_url('/?s='),
        'i18n'          => array(
            'search'        => __('Search', 'blaze'),
            'close'         => __('Close', 'blaze'),
            'loading'       => __('Loading...', 'blaze'),
            'noResults'     => __('No results found', 'blaze'),
            'readMore'      => __('Read More', 'blaze'),
        ),
    ));
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'blaze_enqueue_scripts');

/**
 * Generate Google Fonts URL
 */
function blaze_fonts_url($heading_font, $body_font) {
    $fonts = array();
    
    // Add heading font
    if (!in_array($heading_font, array('inherit', 'system'))) {
        $fonts[] = $heading_font . ':wght@400;600;700;900';
    }
    
    // Add body font if different
    if ($body_font !== $heading_font && !in_array($body_font, array('inherit', 'system'))) {
        $fonts[] = $body_font . ':wght@400;500;600;700';
    }
    
    if (empty($fonts)) {
        return false;
    }
    
    $fonts_url = add_query_arg(array(
        'family' => implode('&family=', $fonts),
        'display' => 'swap',
    ), 'https://fonts.googleapis.com/css2');
    
    return $fonts_url;
}

/**
 * Add inline styles for customizer settings
 */
function blaze_inline_styles() {
    $primary_color = get_theme_mod('blaze_primary_color', '#DC2626');
    $secondary_color = get_theme_mod('blaze_secondary_color', '#1F2937');
    $text_color = get_theme_mod('blaze_text_color', '#111827');
    $heading_font = get_theme_mod('blaze_heading_font', 'Inter');
    $body_font = get_theme_mod('blaze_body_font', 'Inter');
    $font_size = get_theme_mod('blaze_font_size', 16);
    
    $custom_css = "
        :root {
            --color-primary: {$primary_color};
            --color-secondary: {$secondary_color};
            --color-text: {$text_color};
            --font-heading: '{$heading_font}', sans-serif;
            --font-body: '{$body_font}', sans-serif;
            --font-size-base: {$font_size}px;
        }
        
        body {
            font-family: var(--font-body);
            font-size: var(--font-size-base);
            color: var(--color-text);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
        }
        
        .text-primary,
        a:hover {
            color: var(--color-primary);
        }
        
        .bg-primary {
            background-color: var(--color-primary);
        }
        
        .border-primary {
            border-color: var(--color-primary);
        }
        
        .btn-primary {
            background-color: var(--color-primary);
        }
        
        .btn-primary:hover {
            filter: brightness(0.9);
        }
    ";
    
    wp_add_inline_style('blaze-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'blaze_inline_styles');

/**
 * Enqueue admin styles and scripts
 */
function blaze_admin_scripts($hook) {
    
    // Only load on specific admin pages
    $allowed_pages = array('post.php', 'post-new.php', 'page.php', 'page-new.php');
    
    if (!in_array($hook, $allowed_pages)) {
        return;
    }
    
    // Admin styles
    wp_enqueue_style(
        'blaze-admin',
        get_template_directory_uri() . '/dist/css/main.css',
        array(),
        BLAZE_VERSION
    );
    
    // Admin scripts
    wp_enqueue_script(
        'blaze-admin',
        get_template_directory_uri() . '/dist/js/admin.js',
        array('jquery'),
        BLAZE_VERSION,
        true
    );
}
add_action('admin_enqueue_scripts', 'blaze_admin_scripts');

/**
 * Enqueue block editor styles
 */
function blaze_editor_styles() {
    
    // Editor styles
    wp_enqueue_style(
        'blaze-editor-styles',
        get_template_directory_uri() . '/dist/css/main.css',
        array(),
        BLAZE_VERSION
    );
    
    // Google Fonts for editor
    $heading_font = get_theme_mod('blaze_heading_font', 'Inter');
    $body_font = get_theme_mod('blaze_body_font', 'Inter');
    
    $fonts_url = blaze_fonts_url($heading_font, $body_font);
    if ($fonts_url) {
        wp_enqueue_style(
            'blaze-editor-fonts',
            $fonts_url,
            array(),
            null
        );
    }
}
add_action('enqueue_block_editor_assets', 'blaze_editor_styles');

/**
 * Add preload for critical assets
 */
function blaze_preload_assets() {
    ?>
    <!-- Preload critical CSS -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/dist/css/main.css" as="style">
    
    <!-- Preload critical JS -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/dist/js/bundle.js" as="script">
    
    <!-- DNS Prefetch for external resources -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <?php
}
add_action('wp_head', 'blaze_preload_assets', 1);

/**
 * Add defer/async to scripts
 */
function blaze_script_loader_tag($tag, $handle, $src) {
    
    // Scripts to defer
    $defer_scripts = array(
        'blaze-main',
    );
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'blaze_script_loader_tag', 10, 3);

/**
 * Remove jQuery migrate
 */
function blaze_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'blaze_remove_jquery_migrate');

/**
 * Add module type to script
 */
function blaze_add_type_attribute($tag, $handle, $src) {
    
    // Add type="module" for Vite bundles
    if ('blaze-main' === $handle) {
        $tag = str_replace(' src', ' type="module" src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'blaze_add_type_attribute', 10, 3);