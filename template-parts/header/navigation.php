<?php
/**
 * Main Navigation Menu
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<nav id="site-navigation" class="main-navigation hidden md:block" aria-label="<?php esc_attr_e('Primary Menu', 'blaze'); ?>">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'menu_class'     => 'nav-menu flex items-center gap-8',
        'container'      => false,
        'fallback_cb'    => 'blaze_default_menu',
        'depth'          => 3,
        'walker'         => new Blaze_Walker_Nav_Menu(),
    ));
    ?>
</nav>

<?php
/**
 * Custom Walker for Navigation Menu - Tailwind CSS
 */
class Blaze_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Start Level
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        
        $classes = 'sub-menu absolute left-0 top-full mt-2 min-w-[200px] bg-white rounded-lg shadow-xl border border-gray-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50';
        
        if ($depth > 0) {
            $classes = 'sub-menu absolute left-full top-0 ml-2 min-w-[200px] bg-white rounded-lg shadow-xl border border-gray-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50';
        }
        
        $output .= "\n$indent<ul class=\"$classes\">\n";
    }
    
    /**
     * Start Element
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        // Classes
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Check if item has children
        $has_children = in_array('menu-item-has-children', $classes);
        
        // Li classes
        $li_classes = 'relative group';
        if ($has_children) {
            $li_classes .= ' has-children';
        }
        if (in_array('current-menu-item', $classes)) {
            $li_classes .= ' current-menu-item';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($li_classes) . '"' : '';
        
        $output .= $indent . '<li' . $class_names . '>';
        
        // Link attributes
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        // Link classes
        if ($depth === 0) {
            $atts['class'] = 'nav-link relative px-4 py-2 text-gray-700 font-medium hover:text-primary transition-colors after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-primary after:transition-all hover:after:w-full';
            
            if (in_array('current-menu-item', $classes)) {
                $atts['class'] .= ' text-primary after:w-full';
            }
        } else {
            $atts['class'] = 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors';
            
            if (in_array('current-menu-item', $classes)) {
                $atts['class'] .= ' text-primary bg-gray-50';
            }
        }
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        
        // Add dropdown icon for parent items
        if ($has_children && $depth === 0) {
            $item_output .= '<svg class="inline-block w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
        } elseif ($has_children && $depth > 0) {
            $item_output .= '<svg class="inline-block w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Fallback menu if no menu is set
 */
function blaze_default_menu() {
    ?>
    <ul class="nav-menu flex items-center gap-8">
        <li class="relative group">
            <a href="<?php echo esc_url(home_url('/')); ?>" 
               class="nav-link relative px-4 py-2 text-gray-700 font-medium hover:text-primary transition-colors">
                <?php esc_html_e('Home', 'blaze'); ?>
            </a>
        </li>
        <li class="relative group">
            <a href="<?php echo esc_url(home_url('/blog')); ?>" 
               class="nav-link relative px-4 py-2 text-gray-700 font-medium hover:text-primary transition-colors">
                <?php esc_html_e('Blog', 'blaze'); ?>
            </a>
        </li>
    </ul>
    <?php
}
?>