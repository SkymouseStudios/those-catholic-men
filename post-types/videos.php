<?php
function Videos() {
    $labels = array(
        'name'               => 'Videos',
        'singular_name'      => 'Videos',
        'add_new'            => 'Add Video',
        'add_new_item'       => 'Add New Video',
        'edit_item'          => 'Edit Video',
        'new_item'           => 'New Video',
        'all_items'          => 'All Videos',
        'view_item'          => 'View Video',
        'search_items'       => 'Search Video',
        'not_found'          => 'No Video found',
        'not_found_in_trash' => 'No Video found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Videos'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'videos' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'taxonomies'         => array('post_tag'),
        'menu_icon'          => 'dashicons-media-video',
        'supports'           => array( 'title', 'editor', 'comments', 'author' )
    );

    register_post_type( 'videos', $args );
}
add_action( 'init', 'Videos' );