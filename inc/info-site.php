<?php
class InfoSite
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_menu_page( 'Info Site', 'Info Site', 'manage_options', 'info-site-admin', array( $this, 'create_admin_page' ), 'dashicons-pressthis', 56 );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'info_site_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Settings Info Site</h2>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'info_site_group' );
                do_settings_sections( 'info-site-admin' );
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'info_site_group', // Option group
            'info_site_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'info-site-admin' // Page
        );

        add_settings_field(
            'youtube_key',
            'YouTube API Key',
            array( $this, 'youtube_key_callback' ),
            'info-site-admin',
            'setting_section_id'
        );

        add_settings_field(
            'facebook',
            'Facebook',
            array( $this, 'facebook_callback' ),
            'info-site-admin',
            'setting_section_id'
        );

//        add_settings_field(
//            'copyright',
//            'Copyright',
//            array( $this, 'copyright_callback' ),
//            'info-site-admin',
//            'setting_section_id'
//        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

//        if( isset( $input['copyright'] ) )
//            $new_input['copyright'] = sanitize_text_field( $input['copyright'] );
        if( isset( $input['facebook'] ) )
            $new_input['facebook'] = $input['facebook'];
        if( isset( $input['youtube_key'] ) )
            $new_input['youtube_key'] = sanitize_text_field( $input['youtube_key'] );

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        // print 'Enter your settings below:';
    }

    //copyright
//    public function copyright_callback()
//    {
//        wp_editor( isset( $this->options['copyright'] ) ? $this->options['copyright'] : '', 'copyright',
//            array('wpautop' => true, 'textarea_name' => "info_site_name[copyright]", 'textarea_rows' => '3', 'media_buttons' => false) );
//    }

    //facebook
    public function facebook_callback()
    {
        printf(
            '<textarea id="facebook" name="info_site_name[facebook]" rows="10" cols="100" />%s</textarea>',
            isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
        );
    }

//    //youtube_key
    public function youtube_key_callback()
    {
        printf(
            '<input type="text" id="youtube_key" name="info_site_name[youtube_key]" value="%s" style="width: 300px" />',
            isset( $this->options['youtube_key'] ) ? esc_attr( $this->options['youtube_key']) : ''
        );
    }

}

if( is_admin() )
    $my_settings_page = new InfoSite();