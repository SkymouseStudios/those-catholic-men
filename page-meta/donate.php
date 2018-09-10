<?php
/* Donate Page */
$prefix = 'donate_';
$meta_boxes_donate[] = array(
    'id' => 'donate',
    'title' => 'Info page',
    'post_types' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name'    => 'Title section',
            'id'      => "{$prefix}title",
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
            'name' => 'Links section',
            'id'   => 'fake_id', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name' => 'Title link',
            'id' => "{$prefix}title_link1",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'name' => 'URL link',
            'id'   => "{$prefix}url_link1",
            'desc' => '',
            'type' => 'url',
            'std'  => '',
        ),

        array(
            'type' => 'divider',
            'id'   => 'fake_divider_id', // Not used, but needed
        ),

        array(
            'name' => 'Title link',
            'id' => "{$prefix}title_link2",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'name' => 'URL link',
            'id'   => "{$prefix}url_link2",
            'desc' => '',
            'type' => 'url',
            'std'  => '',
        ),

        array(
            'type' => 'heading',
            'name' => 'Address section',
            'id'   => 'fake_id', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name' => 'Line 1',
            'id' => "{$prefix}address_line1",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'name' => 'Line 2',
            'id' => "{$prefix}address_line2",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'name' => 'Line 3',
            'id' => "{$prefix}address_line3",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'name'    => 'Info section',
            'id'      => "{$prefix}address_info",
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

function tcm_register_meta_boxes_donate() {
    global $meta_boxes_donate;    /* Settings info for donate page */

    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( ! class_exists( 'RW_Meta_Box' ) )
        return;

    // Register meta boxes only for some posts/pages
    if ( ! rw_maybe_include_donate() )
        return;
    foreach ( $meta_boxes_donate as $meta_box ) { new RW_Meta_Box( $meta_box ); }
}
add_action( 'admin_init', 'tcm_register_meta_boxes_donate' );

function rw_maybe_include_donate() {
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
    $checked_templates = array( 'page-templates/donate.php' );
    $template = get_post_meta( $post_id, '_wp_page_template', true );
    if ( in_array( $template, $checked_templates ) )
        return true;
    // If no condition matched
    return false;
}