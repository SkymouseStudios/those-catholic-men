<?php
/* Home Page */
$prefix = 'home_';
$meta_boxes_home[] = array(
    'id' => 'home',
    'title' => 'Info page',
    'post_types' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'type' => 'heading',
            'name' => 'Section Last Articles',
            'id'   => 'fake_id1', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name'             => 'Background section',
            'id'               => "{$prefix}bg_last_articles",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
        ),

        array(
            'type' => 'heading',
            'name' => 'Section Events',
            'id'   => 'fake_id2', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name'             => 'Background section',
            'id'               => "{$prefix}bg_events",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
        ),

        array(
            'type' => 'heading',
            'name' => 'Section video',
            'id'   => 'fake_id3', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name' => 'URL video',
            'id' => "{$prefix}video",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'type' => 'heading',
            'name' => 'Section donate',
            'id'   => 'fake_id4', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name'             => 'Background section',
            'id'               => "{$prefix}bg_donate",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
        ),

        array(
            'name' => 'Title',
            'id' => "{$prefix}title_donate",
            'desc' => '',
            'type' => 'text',
            'std' => '',
            'clone' => false,
        ),

        array(
            'name'    => 'Description',
            'id'      => "{$prefix}desc_donate",
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
            'name' => 'Section "Follow Us"',
            'id'   => 'fake_id5', // Not used but needed for plugin
            'desc' => '',
        ),

        array(
            'name'             => 'Background section',
            'id'               => "{$prefix}bg_updates",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
        ),

        array(
            'name'             => 'Check our latest Heroic Minute issue',
            'id'               => "{$prefix}bg_subscribe",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
        ),

        array(
            'name'             => 'Check our latest ManBuilder challenge',
            'id'               => "{$prefix}bg_schedule",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
        ),

    )
);

function tcm_register_meta_boxes_home() {
    global $meta_boxes_home;    /* Settings info for home page */

    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( ! class_exists( 'RW_Meta_Box' ) )
        return;

    // Register meta boxes only for some posts/pages
    if ( ! rw_maybe_include_home() )
        return;
    foreach ( $meta_boxes_home as $meta_box ) { new RW_Meta_Box( $meta_box ); }
}
add_action( 'admin_init', 'tcm_register_meta_boxes_home' );

function rw_maybe_include_home() {
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
    $checked_templates = array( 'page-templates/home.php' );
    $template = get_post_meta( $post_id, '_wp_page_template', true );
    if ( in_array( $template, $checked_templates ) )
        return true;
    // If no condition matched
    return false;
}