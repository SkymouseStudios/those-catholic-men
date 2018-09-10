<?php
class SocialSettingsPage
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
        add_menu_page( 'Social links', 'Social links', 'manage_options', 'social-links-admin', array( $this, 'create_admin_page' ), 'dashicons-share', 55 );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'social_option_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Settings social links</h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'social_option_group' );
                do_settings_sections( 'social-links-admin' );
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
            'social_option_group', // Option group
            'social_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'social-links-admin' // Page
        );

        add_settings_field(
            'facebook',
            'Facebook',
            array( $this, 'facebook_callback' ),
            'social-links-admin',
            'setting_section_id'
        );

        add_settings_field(
            'twitter',
            'Twitter',
            array( $this, 'twitter_callback' ),
            'social-links-admin',
            'setting_section_id'
        );

        add_settings_field(
            'youtube',
            'Youtube',
            array( $this, 'youtube_callback' ),
            'social-links-admin',
            'setting_section_id'
        );

        add_settings_field(
            'rss',
            'RSS',
            array( $this, 'rss_callback' ),
            'social-links-admin',
            'setting_section_id'
        );

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['facebook'] ) )
            $new_input['facebook'] = sanitize_text_field( $input['facebook'] );
        if( isset( $input['twitter'] ) )
            $new_input['twitter'] = sanitize_text_field( $input['twitter'] );
        if( isset( $input['youtube'] ) )
            $new_input['youtube'] = sanitize_text_field( $input['youtube'] );
        if( isset( $input['rss'] ) )
            $new_input['rss'] = sanitize_text_field( $input['rss'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        // print 'Enter your settings below:';
    }


    //facebook
    public function facebook_callback()
    {
        printf(
            '<input type="text" id="facebook" name="social_option_name[facebook]" value="%s" style="width: 500px" />',
            isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
        );
    }

    //twitter
    public function twitter_callback()
    {
        printf(
            '<input type="text" id="twitter" name="social_option_name[twitter]" value="%s" style="width: 500px" />',
            isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
        );
    }

    //youtube
    public function youtube_callback()
    {
        printf(
            '<input type="text" id="youtube" name="social_option_name[youtube]" value="%s" style="width: 500px" />',
            isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
        );
    }

    //rss
    public function rss_callback()
    {
        printf(
            '<input type="text" id="rss" name="social_option_name[rss]" value="%s" style="width: 500px" />',
            isset( $this->options['rss'] ) ? esc_attr( $this->options['rss']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new SocialSettingsPage();