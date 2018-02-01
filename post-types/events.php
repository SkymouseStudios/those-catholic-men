<?php
function Events() {
    $labels = array(
        'name'               => 'Events',
        'singular_name'      => 'Events',
        'add_new'            => 'Add Event',
        'add_new_item'       => 'Add New Event',
        'edit_item'          => 'Edit Event',
        'new_item'           => 'New Event',
        'all_items'          => 'All Events',
        'view_item'          => 'View Event',
        'search_items'       => 'Search Event',
        'not_found'          => 'No Event found',
        'not_found_in_trash' => 'No Event found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Events'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
//        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'taxonomies'         => array('post_tag'),
        'menu_icon'          => 'dashicons-admin-post',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' )
    );

    register_post_type( 'events', $args );
}
add_action( 'init', 'Events' );

register_taxonomy( 'types', 'events', array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => 'Types',
            'singular_name'     => 'Type',
            'search_items'      => 'Search Types',
            'all_items'         => 'All Types',
            'parent_item'       => 'Parent Type',
            'parent_item_colon' => 'Parent Type:',
            'edit_item'         => 'Edit Type',
            'update_item'       => 'Update Type',
            'add_new_item'      => 'Add New Type',
            'new_item_name'     => 'New Type Name',
            'menu_name'         => 'Types',
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => false,
        'rewrite'           => false
    )
);