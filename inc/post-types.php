<?php
/**
 * Custom Post Types
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Portfolio Post Type
 */
function blaze_register_portfolio_post_type() {
    
    $labels = array(
        'name'                  => _x('Portfolio', 'Post Type General Name', 'blaze'),
        'singular_name'         => _x('Portfolio Item', 'Post Type Singular Name', 'blaze'),
        'menu_name'             => __('Portfolio', 'blaze'),
        'name_admin_bar'        => __('Portfolio Item', 'blaze'),
        'archives'              => __('Portfolio Archives', 'blaze'),
        'attributes'            => __('Portfolio Attributes', 'blaze'),
        'parent_item_colon'     => __('Parent Item:', 'blaze'),
        'all_items'             => __('All Items', 'blaze'),
        'add_new_item'          => __('Add New Item', 'blaze'),
        'add_new'               => __('Add New', 'blaze'),
        'new_item'              => __('New Item', 'blaze'),
        'edit_item'             => __('Edit Item', 'blaze'),
        'update_item'           => __('Update Item', 'blaze'),
        'view_item'             => __('View Item', 'blaze'),
        'view_items'            => __('View Items', 'blaze'),
        'search_items'          => __('Search Item', 'blaze'),
        'not_found'             => __('Not found', 'blaze'),
        'not_found_in_trash'    => __('Not found in Trash', 'blaze'),
        'featured_image'        => __('Featured Image', 'blaze'),
        'set_featured_image'    => __('Set featured image', 'blaze'),
        'remove_featured_image' => __('Remove featured image', 'blaze'),
        'use_featured_image'    => __('Use as featured image', 'blaze'),
        'insert_into_item'      => __('Insert into item', 'blaze'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'blaze'),
        'items_list'            => __('Items list', 'blaze'),
        'items_list_navigation' => __('Items list navigation', 'blaze'),
        'filter_items_list'     => __('Filter items list', 'blaze'),
    );
    
    $args = array(
        'label'                 => __('Portfolio Item', 'blaze'),
        'description'           => __('Portfolio items showcase', 'blaze'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies'            => array('portfolio_category', 'portfolio_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'portfolio'),
    );
    
    register_post_type('portfolio', $args);
}
add_action('init', 'blaze_register_portfolio_post_type', 0);

/**
 * Register Portfolio Taxonomy
 */
function blaze_register_portfolio_taxonomy() {
    
    // Portfolio Category
    $category_labels = array(
        'name'                       => _x('Portfolio Categories', 'Taxonomy General Name', 'blaze'),
        'singular_name'              => _x('Portfolio Category', 'Taxonomy Singular Name', 'blaze'),
        'menu_name'                  => __('Categories', 'blaze'),
        'all_items'                  => __('All Categories', 'blaze'),
        'parent_item'                => __('Parent Category', 'blaze'),
        'parent_item_colon'          => __('Parent Category:', 'blaze'),
        'new_item_name'              => __('New Category Name', 'blaze'),
        'add_new_item'               => __('Add New Category', 'blaze'),
        'edit_item'                  => __('Edit Category', 'blaze'),
        'update_item'                => __('Update Category', 'blaze'),
        'view_item'                  => __('View Category', 'blaze'),
        'separate_items_with_commas' => __('Separate categories with commas', 'blaze'),
        'add_or_remove_items'        => __('Add or remove categories', 'blaze'),
        'choose_from_most_used'      => __('Choose from the most used', 'blaze'),
        'popular_items'              => __('Popular Categories', 'blaze'),
        'search_items'               => __('Search Categories', 'blaze'),
        'not_found'                  => __('Not Found', 'blaze'),
        'no_terms'                   => __('No categories', 'blaze'),
        'items_list'                 => __('Categories list', 'blaze'),
        'items_list_navigation'      => __('Categories list navigation', 'blaze'),
    );
    
    $category_args = array(
        'labels'                     => $category_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'portfolio-category'),
    );
    
    register_taxonomy('portfolio_category', array('portfolio'), $category_args);
    
    // Portfolio Tag
    $tag_labels = array(
        'name'                       => _x('Portfolio Tags', 'Taxonomy General Name', 'blaze'),
        'singular_name'              => _x('Portfolio Tag', 'Taxonomy Singular Name', 'blaze'),
        'menu_name'                  => __('Tags', 'blaze'),
        'all_items'                  => __('All Tags', 'blaze'),
        'parent_item'                => __('Parent Tag', 'blaze'),
        'parent_item_colon'          => __('Parent Tag:', 'blaze'),
        'new_item_name'              => __('New Tag Name', 'blaze'),
        'add_new_item'               => __('Add New Tag', 'blaze'),
        'edit_item'                  => __('Edit Tag', 'blaze'),
        'update_item'                => __('Update Tag', 'blaze'),
        'view_item'                  => __('View Tag', 'blaze'),
        'separate_items_with_commas' => __('Separate tags with commas', 'blaze'),
        'add_or_remove_items'        => __('Add or remove tags', 'blaze'),
        'choose_from_most_used'      => __('Choose from the most used', 'blaze'),
        'popular_items'              => __('Popular Tags', 'blaze'),
        'search_items'               => __('Search Tags', 'blaze'),
        'not_found'                  => __('Not Found', 'blaze'),
        'no_terms'                   => __('No tags', 'blaze'),
        'items_list'                 => __('Tags list', 'blaze'),
        'items_list_navigation'      => __('Tags list navigation', 'blaze'),
    );
    
    $tag_args = array(
        'labels'                     => $tag_labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'portfolio-tag'),
    );
    
    register_taxonomy('portfolio_tag', array('portfolio'), $tag_args);
}
add_action('init', 'blaze_register_portfolio_taxonomy', 0);

/**
 * Register Testimonial Post Type
 */
function blaze_register_testimonial_post_type() {
    
    $labels = array(
        'name'                  => _x('Testimonials', 'Post Type General Name', 'blaze'),
        'singular_name'         => _x('Testimonial', 'Post Type Singular Name', 'blaze'),
        'menu_name'             => __('Testimonials', 'blaze'),
        'name_admin_bar'        => __('Testimonial', 'blaze'),
        'archives'              => __('Testimonial Archives', 'blaze'),
        'attributes'            => __('Testimonial Attributes', 'blaze'),
        'parent_item_colon'     => __('Parent Testimonial:', 'blaze'),
        'all_items'             => __('All Testimonials', 'blaze'),
        'add_new_item'          => __('Add New Testimonial', 'blaze'),
        'add_new'               => __('Add New', 'blaze'),
        'new_item'              => __('New Testimonial', 'blaze'),
        'edit_item'             => __('Edit Testimonial', 'blaze'),
        'update_item'           => __('Update Testimonial', 'blaze'),
        'view_item'             => __('View Testimonial', 'blaze'),
        'view_items'            => __('View Testimonials', 'blaze'),
        'search_items'          => __('Search Testimonial', 'blaze'),
        'not_found'             => __('Not found', 'blaze'),
        'not_found_in_trash'    => __('Not found in Trash', 'blaze'),
        'featured_image'        => __('Client Photo', 'blaze'),
        'set_featured_image'    => __('Set client photo', 'blaze'),
        'remove_featured_image' => __('Remove client photo', 'blaze'),
        'use_featured_image'    => __('Use as client photo', 'blaze'),
        'insert_into_item'      => __('Insert into testimonial', 'blaze'),
        'uploaded_to_this_item' => __('Uploaded to this testimonial', 'blaze'),
        'items_list'            => __('Testimonials list', 'blaze'),
        'items_list_navigation' => __('Testimonials list navigation', 'blaze'),
        'filter_items_list'     => __('Filter testimonials list', 'blaze'),
    );
    
    $args = array(
        'label'                 => __('Testimonial', 'blaze'),
        'description'           => __('Client testimonials', 'blaze'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-format-quote',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('testimonial', $args);
}
add_action('init', 'blaze_register_testimonial_post_type', 0);

/**
 * Register Team Member Post Type
 */
function blaze_register_team_post_type() {
    
    $labels = array(
        'name'                  => _x('Team Members', 'Post Type General Name', 'blaze'),
        'singular_name'         => _x('Team Member', 'Post Type Singular Name', 'blaze'),
        'menu_name'             => __('Team', 'blaze'),
        'name_admin_bar'        => __('Team Member', 'blaze'),
        'archives'              => __('Team Archives', 'blaze'),
        'attributes'            => __('Team Member Attributes', 'blaze'),
        'all_items'             => __('All Team Members', 'blaze'),
        'add_new_item'          => __('Add New Member', 'blaze'),
        'add_new'               => __('Add New', 'blaze'),
        'new_item'              => __('New Member', 'blaze'),
        'edit_item'             => __('Edit Member', 'blaze'),
        'update_item'           => __('Update Member', 'blaze'),
        'view_item'             => __('View Member', 'blaze'),
        'search_items'          => __('Search Member', 'blaze'),
    );
    
    $args = array(
        'label'                 => __('Team Member', 'blaze'),
        'description'           => __('Team members', 'blaze'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'team'),
    );
    
    register_post_type('team', $args);
}
add_action('init', 'blaze_register_team_post_type', 0);

/**
 * Flush rewrite rules on theme activation
 */
function blaze_rewrite_flush() {
    blaze_register_portfolio_post_type();
    blaze_register_portfolio_taxonomy();
    blaze_register_testimonial_post_type();
    blaze_register_team_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'blaze_rewrite_flush');