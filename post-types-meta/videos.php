<?php
add_filter('rwmb_meta_boxes', 'tcm_register_meta_boxes_video');

function tcm_register_meta_boxes_video($meta_boxes_video) {
    $prefix = 'video_';

    $meta_boxes_video[] = array(
        'id'         => 'video',
        'title'      => 'Info video',
        'post_types' => array('videos'),
        'context'    => 'normal',
        'priority'   => 'high',
        'autosave'   => true,
        'fields'     => array(

            array(
                'name' => 'URL',
                'id' => "{$prefix}url",
                'desc' => '',
                'type' => 'text',
                'std' => '',
                'clone' => false,
            ),

        )
    );

    return $meta_boxes_video;
}