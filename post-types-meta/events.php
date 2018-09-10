<?php
add_filter('rwmb_meta_boxes', 'tcm_register_meta_boxes_event');

function tcm_register_meta_boxes_event($meta_boxes_event) {
    $prefix = 'event_';

    $meta_boxes_event[] = array(
        'id'         => 'event',
        'title'      => 'Info event',
        'post_types' => array('events'),
        'context'    => 'normal',
        'priority'   => 'high',
        'autosave'   => true,
        'fields'     => array(

            // DATETIME
            array(
                'name'       => 'Date',
                'id'         => "{$prefix}date",
                'type'       => 'datetime',
                // jQuery datetime picker options.
                // For date options, see here http://api.jqueryui.com/datepicker
                // For time options, see here http://trentrichardson.com/examples/timepicker/
                'js_options' => array(
                    'stepMinute'     => 10,
                    'showTimepicker' => true,
                ),
            ),

            array(
                'name'    => 'Address',
                'id'      => "{$prefix}location",
                'type'    => 'wysiwyg',
                'raw'     => false,
                'options' => array(
                    'textarea_rows' => 5,
                    'teeny'         => false,
                    'media_buttons' => false,
                ),
            ),

            array(
                'name'        => 'State',
                'id'          => "{$prefix}state",
                'type'        => 'select',
                // Array of 'value' => 'Label' pairs for select box
                'options'     => array(
                    'AL' => 'Alabama',
                    'AK' => 'Alaska',
                    'AZ' => 'Arizona',
                    'AR' => 'Arkansas',
                    'CA' => 'California',
                    'CO' => 'Colorado',
                    'CT' => 'Connecticut',
                    'DE' => 'Delaware',
                    'FL' => 'Florida',
                    'GA' => 'Georgia',
                    'HI' => 'Hawaii',
                    'ID' => 'Idaho',
                    'IL' => 'Illinois',
                    'IN' => 'Indiana',
                    'IA' => 'Iowa',
                    'KS' => 'Kansas',
                    'KY' => 'Kentucky',
                    'LA' => 'Louisiana',
                    'ME' => 'Maine',
                    'MD' => 'Maryland',
                    'MA' => 'Massachusetts',
                    'MI' => 'Michigan',
                    'MN' => 'Minnesota',
                    'MS' => 'Mississippi',
                    'MO' => 'Missouri',
                    'MT' => 'Montana',
                    'NE' => 'Nebraska',
                    'NV' => 'Nevada',
                    'NH' => 'New Hampshire',
                    'NJ' => 'New Jersey',
                    'NM' => 'New Mexico',
                    'NY' => 'New York',
                    'NC' => 'North Carolina',
                    'ND' => 'North Dakota',
                    'OH' => 'Ohio',
                    'OK' => 'Oklahoma',
                    'OR' => 'Oregon',
                    'PA' => 'Pennsylvania',
                    'RI' => 'Rhode Island',
                    'SC' => 'South Carolina',
                    'SD' => 'South Dakota',
                    'TN' => 'Tennessee',
                    'TX' => 'Texas',
                    'UT' => 'Utah',
                    'VT' => 'Vermont',
                    'VA' => 'Virginia',
                    'WA' => 'Washington',
                    'WV' => 'West Virginia',
                    'WI' => 'Wisconsin',
                    'WY' => 'Wyoming',
                    'DC' => 'District of Columbia',
                    'AS' => 'American Samoa',
                    'GU' => 'Guam',
                    'MP' => 'Northern Mariana Islands',
                    'PR' => 'Puerto Rico',
                    'UM' => 'United States Minor Outlying Islands',
                    'VI' => 'Virgin Islands, U.S.'
                ),
                // Select multiple values, optional. Default is false.
                'multiple'    => false,
                'std'         => '0',
                'placeholder' => 'Select State',
            ),

            array(
                'name' => 'City',
                'id' => "{$prefix}city",
                'desc' => '',
                'type' => 'text',
                'std' => '',
                'clone' => false,
            ),

            array(
                'name' => 'Zip Code',
                'id' => "{$prefix}zip",
                'desc' => '',
                'type' => 'text',
                'std' => '',
                'clone' => false,
            ),

            array(
                'name' => 'Organizer',
                'id' => "{$prefix}author",
                'desc' => '',
                'type' => 'text',
                'std' => '',
                'clone' => false,
            ),

            // EMAIL
            array(
                'name' => 'Email',
                'id'   => "{$prefix}email",
                'desc' => '',
                'type' => 'email',
                'std'  => '',
            ),

            array(
                'name' => 'Types',
                'id' => "{$prefix}type",
                'type' => 'taxonomy',
                'options' => array(
                    // Taxonomy name
                    'taxonomy' => 'types',
                    // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
                    'type' => 'select',
                    'args' => array()
                ),
            ),

        )
    );

    return $meta_boxes_event;
}