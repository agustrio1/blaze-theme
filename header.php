<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- HARDCODE CSS & JS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/css/main.css?v=<?php echo time(); ?>">
    <script type="module" defer src="<?php echo get_template_directory_uri(); ?>/dist/js/main.js?v=<?php echo time(); ?>"></script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e('Skip to content', 'blaze'); ?>
    </a>

    <!-- Header Mount Point -->
    <div id="header-mount" 
         data-site-title="<?php echo esc_attr(get_bloginfo('name')); ?>"
         data-site-url="<?php echo esc_url(home_url('/')); ?>"
         data-has-logo="<?php echo has_custom_logo() ? '1' : '0'; ?>"
         data-logo-url="<?php echo has_custom_logo() ? esc_url(wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full')) : ''; ?>"
         data-menu-items='<?php
            $menu_items = wp_get_nav_menu_items('primary');
            $menu_data = array();
            if ($menu_items) {
                foreach ($menu_items as $item) {
                    $menu_data[] = array(
                        'id' => $item->ID,
                        'title' => $item->title,
                        'url' => $item->url,
                        'target' => $item->target ?: '_self',
                    );
                }
            }
            echo esc_attr(json_encode($menu_data));
         ?>'></div>

    <!-- Mobile Menu Mount Point -->
    <div id="mobile-menu-mount"
         data-menu-items='<?php
            $menu_items = wp_get_nav_menu_items('primary');
            $menu_data = array();
            if ($menu_items) {
                foreach ($menu_items as $item) {
                    $menu_data[] = array(
                        'id' => $item->ID,
                        'title' => $item->title,
                        'url' => $item->url,
                    );
                }
            }
            echo esc_attr(json_encode($menu_data));
         ?>'></div>

    <!-- Search Modal Mount Point -->
    <div id="search-modal-mount"
         data-search-url="<?php echo esc_url(home_url('/?s=')); ?>"></div>

    <div id="content" class="site-content">