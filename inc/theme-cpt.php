<?php
function tatsu_custom_post_type() {

    $args = array(
        'label'               => __( 'restaurants', 'tatsu_theme' ),
        'description'         => __( '', 'tatsu_theme' ),
        'labels'              => array(
            'name'                => _x( 'Restaurants', 'Post Type General Name', 'tatsu_theme' ),
            'singular_name'       => _x( 'Restaurant', 'Post Type Singular Name', 'tatsu_theme' ),
            'menu_name'           => __( 'Restaurants', 'tatsu_theme' ),
            'parent_item_colon'   => __( 'Parent Restaurant', 'tatsu_theme' ),
            'all_items'           => __( 'All Restaurants', 'tatsu_theme' ),
            'view_item'           => __( 'View Restaurant', 'tatsu_theme' ),
            'add_new_item'        => __( 'Add New Restaurant', 'tatsu_theme' ),
            'add_new'             => __( 'Add New', 'tatsu_theme' ),
            'edit_item'           => __( 'Edit Restaurant', 'tatsu_theme' ),
            'update_item'         => __( 'Update Restaurant', 'tatsu_theme' ),
            'search_items'        => __( 'Search Restaurants', 'tatsu_theme' ),
            'not_found'           => __( 'Not Found', 'tatsu_theme' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tatsu_theme' ),
        ),
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array(),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );

    register_post_type( 'restaurants', $args );

    $args = array(
        'label'               => __( 'job', 'tatsu_theme' ),
        'description'         => __( '', 'tatsu_theme' ),
        'labels'              => array(
            'name'                => _x( 'Jobs', 'Post Type General Name', 'tatsu_theme' ),
            'singular_name'       => _x( 'Job', 'Post Type Singular Name', 'tatsu_theme' ),
            'menu_name'           => __( 'Jobs', 'tatsu_theme' ),
            'parent_item_colon'   => __( 'Parent Job', 'tatsu_theme' ),
            'all_items'           => __( 'All Jobs', 'tatsu_theme' ),
            'view_item'           => __( 'View Job', 'tatsu_theme' ),
            'add_new_item'        => __( 'Add New Job', 'tatsu_theme' ),
            'add_new'             => __( 'Add New', 'tatsu_theme' ),
            'edit_item'           => __( 'Edit Job', 'tatsu_theme' ),
            'update_item'         => __( 'Update Job', 'tatsu_theme' ),
            'search_items'        => __( 'Search Jobs', 'tatsu_theme' ),
            'not_found'           => __( 'Not Found', 'tatsu_theme' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'tatsu_theme' ),
        ),
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array(),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );

    register_post_type( 'job', $args );
}

add_action( 'init', 'tatsu_custom_post_type', 0 );