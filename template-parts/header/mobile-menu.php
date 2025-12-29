<?php
/**
 * Mobile Menu Toggle
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get menu items for Svelte component
$menu_items = array();
$locations = get_nav_menu_locations();

if (isset($locations['primary'])) {
    $menu = wp_get_nav_menu_object($locations['primary']);
    if ($menu) {
        $menu_items_raw = wp_get_nav_menu_items($menu->term_id);
        
        if ($menu_items_raw) {
            // Build hierarchical menu structure
            $menu_items = blaze_build_menu_tree($menu_items_raw);
        }
    }
}
?>

<!-- Mobile Menu Mount Point -->
<div 
    id="mobile-menu-mount" 
    class="md:hidden"
    data-menu-items='<?php echo esc_attr(wp_json_encode($menu_items)); ?>'
></div>

<?php
/**
 * Build hierarchical menu tree
 */
function blaze_build_menu_tree($items, $parent_id = 0) {
    $tree = array();
    
    foreach ($items as $item) {
        if ($item->menu_item_parent == $parent_id) {
            $tree_item = array(
                'id'       => $item->ID,
                'title'    => $item->title,
                'url'      => $item->url,
                'target'   => $item->target,
                'children' => blaze_build_menu_tree($items, $item->ID)
            );
            
            $tree[] = $tree_item;
        }
    }
    
    return $tree;
}
?>