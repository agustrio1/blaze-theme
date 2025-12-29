<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e('Skip to content', 'blaze'); ?>
    </a>

    <header id="masthead" class="site-header sticky top-0 z-50 bg-white dark:bg-gray-900 shadow-md transition-all">
        <div id="header-component"></div>
    </header>

    <div id="mobile-menu-component"></div>
    <div id="search-modal-component"></div>

    <div id="content" class="site-content">

<script>
// Mount Svelte Header Component
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('header-component')) {
        new Header({
            target: document.getElementById('header-component'),
            props: {
                siteTitle: '<?php echo esc_js(get_bloginfo('name')); ?>',
                siteUrl: '<?php echo esc_url(home_url('/')); ?>',
                hasLogo: <?php echo has_custom_logo() ? 'true' : 'false'; ?>,
                logoUrl: '<?php echo esc_url(wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full')); ?>',
                menuItems: <?php
                    $menu_items = wp_get_nav_menu_items('primary');
                    $menu_data = array();
                    if ($menu_items) {
                        foreach ($menu_items as $item) {
                            $menu_data[] = array(
                                'id' => $item->ID,
                                'title' => $item->title,
                                'url' => $item->url,
                                'target' => $item->target,
                            );
                        }
                    }
                    echo json_encode($menu_data);
                ?>
            }
        });
    }

    // Mount Mobile Menu
    if (document.getElementById('mobile-menu-component')) {
        new MobileMenu({
            target: document.getElementById('mobile-menu-component'),
            props: {
                menuItems: <?php
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
                    echo json_encode($menu_data);
                ?>
            }
        });
    }

    // Mount Search Modal
    if (document.getElementById('search-modal-component')) {
        new SearchModal({
            target: document.getElementById('search-modal-component'),
            props: {
                searchUrl: '<?php echo esc_url(home_url('/')); ?>'
            }
        });
    }
});
</script>