<?php
/* Events Page */
$prefix = 'events_';
$meta_boxes_events[] = array(
    'id' => 'events_page',
    'title' => 'Info page',
    'post_types' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'type' => 'heading',
            'name' => 'Connector section',
            'id'   => 'fake_id', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name'    => 'Description',
            'id'      => "{$prefix}connector",
            'type'    => 'wysiwyg',
            'raw'     => false,
            'options' => array(
                'textarea_rows' => 5,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),

        array(
            'type' => 'heading',
            'name' => 'Create Event section',
            'id'   => 'fake_id', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name'    => 'Description',
            'id'      => "{$prefix}create_event",
            'type'    => 'wysiwyg',
            'raw'     => false,
            'options' => array(
                'textarea_rows' => 5,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),

    )
);

function tcm_register_meta_boxes_events() {
    global $meta_boxes_events;    /* Settings info for events page */

    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( ! class_exists( 'RW_Meta_Box' ) )
        return;

    // Register meta boxes only for some posts/pages
    if ( ! rw_maybe_include_events() )
        return;
    foreach ( $meta_boxes_events as $meta_box ) { new RW_Meta_Box( $meta_box ); }
}
add_action( 'admin_init', 'tcm_register_meta_boxes_events' );

function rw_maybe_include_events() {
    // Include in back-end only
    if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN )
        return false;
    // Always include for ajax
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
        return true;

    // Check for post IDs
    $checked_post_IDs = array( );
    if ( isset( $_GET['post'] ) )
        $post_id = intval( $_GET['post'] );
    elseif ( isset( $_POST['post_ID'] ) )
        $post_id = intval( $_POST['post_ID'] );
    else
        $post_id = false;
    $post_id = (int) $post_id;
    if ( in_array( $post_id, $checked_post_IDs ) )
        return true;

    // Check for page template
    $checked_templates = array( 'page-templates/eventspage.php' );
    $template = get_post_meta( $post_id, '_wp_page_template', true );
    if ( in_array( $template, $checked_templates ) )
        return true;
    // If no condition matched
    return false;
}