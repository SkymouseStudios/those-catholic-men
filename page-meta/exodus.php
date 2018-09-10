<?php
/* Exodus Page */
$prefix = 'exodus_';
$meta_boxes_exodus[] = array(
    'id' => 'exodus',
    'title' => 'Info page',
    'post_types' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name' => 'Video',
            'id' => "{$prefix}video",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'name'             => 'Image',
            'id'               => "{$prefix}img",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
        ),

        array(
            'name'    => 'Quotations',
            'id'      => "{$prefix}quotations",
            'type'    => 'wysiwyg',
            'raw'     => false,
            'options' => array(
                'textarea_rows' => 5,
                'teeny'         => false,
                'media_buttons' => false,
            ),
        ),

        array(
            'name'    => 'Text',
            'id'      => "{$prefix}text",
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

function tcm_register_meta_boxes_exodus() {
    global $meta_boxes_exodus;    /* Settings info for exodus page */

    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( ! class_exists( 'RW_Meta_Box' ) )
        return;

    // Register meta boxes only for some posts/pages
    if ( ! rw_maybe_include_exodus() )
        return;
    foreach ( $meta_boxes_exodus as $meta_box ) { new RW_Meta_Box( $meta_box ); }
}
add_action( 'admin_init', 'tcm_register_meta_boxes_exodus' );

function rw_maybe_include_exodus() {
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
    $checked_templates = array( 'page-templates/exodus.php' );
    $template = get_post_meta( $post_id, '_wp_page_template', true );
    if ( in_array( $template, $checked_templates ) )
        return true;
    // If no condition matched
    return false;
}