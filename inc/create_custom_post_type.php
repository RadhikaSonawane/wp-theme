<?php
/**
 * custom post type.
 */

function create_custom_post_type() {
  //portfolio post type
    $labels = array(
        'name'               => 'portfolios',
        'singular_name'      => 'portfolio',
        'menu_name'          => 'portfolios',
        'name_admin_bar'     => 'portfolio',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New portfolio',
        'new_item'           => 'New portfolio',
        'edit_item'          => 'Edit portfolio',
        'view_item'          => 'View portfolio',
        'all_items'          => 'All portfolios',
        'search_items'       => 'Search portfolios',
        'parent_item_colon'  => 'Parent portfolios:',
        'not_found'          => 'No portfolios found.',
        'not_found_in_trash' => 'No portfolios found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-images-alt2',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolios' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'         => array( 'category', 'post_type' ),
        'show_in_rest'		   => true,
    );

    register_post_type( 'portfolio', $args );


    // reviews post type

    $labels = array(
        'name'               => 'Reviews',
        'singular_name'      => 'Review',
        'menu_name'          => 'Reviews',
        'name_admin_bar'     => 'Review',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Review',
        'new_item'           => 'New Review',
        'edit_item'          => 'Edit Review',
        'view_item'          => 'View Review',
        'all_items'          => 'All Reviews',
        'search_items'       => 'Search Reviews',
        'parent_item_colon'  => 'Parent Reviews:',
        'not_found'          => 'No reviews found.',
        'not_found_in_trash' => 'No reviews found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'reviews' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-star-half',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'category', 'post_type' ),
		'show_in_rest'		 => true
    );
    register_post_type( 'review', $args );
}
add_action( 'init', 'create_custom_post_type' );

// Flush rewrite rules to add "review" as a permalink slug
function my_rewrite_flush() {
    create_custom_post_type();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );



// Custom Taxonomies
function my_custom_taxonomies() {

    // Type of post/Services taxonomy
    $labels = array(
        'name'              => 'Type of posts/Services',
        'singular_name'     => 'Type of post/Service',
        'search_items'      => 'Search Types of posts/Services',
        'all_items'         => 'All Type of posts/Services',
        'parent_item'       => 'Parent Type of post/Service',
        'parent_item_colon' => 'Parent Type of post/Service:',
        'edit_item'         => 'Edit Type of post/Service',
        'update_item'       => 'Update Type of post/Service',
        'add_new_item'      => 'Add New Type of post/Service',
        'new_item_name'     => 'New Type of post/Service Name',
        'menu_name'         => 'Type of post/Service',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'post-types' ),
        'show_in_rest'	   	=> true
    );

    register_taxonomy( 'post-types', array( 'portfolio' ), $args );


    // Grade taxonomy (non-hierarchical)
    $labels = array(
        'name'                       => 'grads',
        'singular_name'              => 'grade',
        'search_items'               => 'Search grads',
        'popular_items'              => 'Popular grads',
        'all_items'                  => 'All grads',
        'parent_item'                => 'Parent grade',
        'parent_item_colon'          => 'Parent grade:',
        'edit_item'                  => 'Edit grade',
        'update_item'                => 'Update grade',
        'add_new_item'               => 'Add New grade',
        'new_item_name'              => 'New grade Name',
        'separate_items_with_commas' => 'Separate grads with commas',
        'add_or_remove_items'        => 'Add or remove grads',
        'choose_from_most_used'      => 'Choose from the most used grads',
        'not_found'                  => 'No grads found.',
        'menu_name'                  => 'grade',
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'grads' ),
		    'show_in_rest'	  	    => true
    );

    register_taxonomy( 'Grade', array( 'portfolio','review','post' ), $args );
}

add_action( 'init', 'my_custom_taxonomies' );
