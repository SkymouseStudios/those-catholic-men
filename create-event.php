<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
$url = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/client';

if ($_FILES['upload']['name'] == '') {
    exit('not-load');
}

//Approx. <= 1MB files can be uploaded.
if($_FILES['upload']['size'] == 0 OR $_FILES['upload']['size'] > 1048576)
{
    exit('not-size');
}

//check the file extension
if ($_FILES["upload"]["type"] == "image/png" || $_FILES["upload"]["type"] == "image/jpg" || $_FILES["upload"]["type"] == "image/jpeg" ||
    $_FILES["upload"]["type"] == "image/bmp" || $_FILES["upload"]["type"] == "image/gif")
{

    //-----------------Insert new post----------------------
    if ($_POST['time'] != 0) {
        $date = $_POST['date-output'] . ' ' . $_POST['time'];
    } else {
        $date = $_POST['date-output'] . ' 00:00';
    }
    $my_post = array(
        'post_title' => $_POST['title'],
        'post_type' => 'events',
        'post_content' => $_POST['description'],
        'post_status' => 'draft'
    );

    // Insert the post into the database
    $postId = wp_insert_post($my_post, $error);

    if (!is_wp_error($error)) {

        if ($date != '0') {
            update_post_meta($postId, 'event_date', $date);
        }
        if (!add_post_meta($postId, 'event_location', $_POST['address'], true)) {
            update_post_meta($postId, 'event_location', $_POST['address']);
        }
        if (!add_post_meta($postId, 'event_city', $_POST['city'], true)) {
            update_post_meta($postId, 'event_city', $_POST['city']);
        }
        if (!add_post_meta($postId, 'event_state', $_POST['state'], true)) {
            update_post_meta($postId, 'event_state', $_POST['state']);
        }
        if (!add_post_meta($postId, 'event_zip', $_POST['zip'], true)) {
            update_post_meta($postId, 'event_zip', $_POST['zip']);
        }
        if (!has_term($_POST['type'], 'types', $postId)) {
            if ($_POST['type'] != '0') {
                wp_set_object_terms( $postId, $_POST['type'], 'types', true );
            }
        }
        if (!add_post_meta($postId, 'event_author', $_POST['organizer'], true)) {
            update_post_meta($postId, 'event_author', $_POST['organizer']);
        }
        if (!add_post_meta($postId, 'event_email', $_POST['email'], true)) {
            update_post_meta($postId, 'event_email', $_POST['email']);
        }

    }
    //------------------------------------------------------

    if(is_uploaded_file($_FILES['upload']['tmp_name']))
    {
        $filename = $url . '/' . sanitize_file_name(basename($_FILES['upload']['name']));

        if (move_uploaded_file($_FILES['upload']['tmp_name'], $filename))
        {
            $wp_filetype = wp_check_filetype(basename($filename), null );

            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $filename, $postId );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
            wp_update_attachment_metadata( $attach_id, $attach_data );
            add_post_meta($postId, '_thumbnail_id', $attach_id, true);

            echo 'ok';
        }
    }
} else {
    echo 'not-type';
}