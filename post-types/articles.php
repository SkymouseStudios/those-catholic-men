<?php
function Articles() {
    $labels = array(
        'name'               => 'Articles',
        'singular_name'      => 'Articles',
        'add_new'            => 'Add Article',
        'add_new_item'       => 'Add New Article',
        'edit_item'          => 'Edit Article',
        'new_item'           => 'New Article',
        'all_items'          => 'All Articles',
        'view_item'          => 'View Article',
        'search_items'       => 'Search Article',
        'not_found'          => 'No Article found',
        'not_found_in_trash' => 'No Article found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Articles'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'articles' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'taxonomies'         => array('post_tag'),
        'menu_icon'          => 'dashicons-admin-post',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author' )
    );

    register_post_type( 'articles', $args );
}
add_action( 'init', 'Articles' );