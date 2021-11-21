<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class Wpbs_Admin {

  /**
   * Option key, and option page slug
   * @var string
   */
  private $key = 'tones_options';

  /**
   * Options page metabox id
   * @var string
   */
  private $metabox_id = 'tones_option_metabox';

  /**
   * Options Page title
   * @var string
   */
  protected $title = '';

  /**
   * Options Page hook
   * @var string
   */
  protected $options_page = '';

  /**
   * Holds an instance of the object
   *
   * @var tones_Admin
   **/
  private static $instance = null;

  /**
   * Constructor
   * @since 0.1.0
   */
  private function __construct() {
    // Set our title
    $this->title = __( 'Theme Options', 'tonestheme' );
  }

  /**
   * Returns the running object
   *
   * @return tones_Admin
   **/
  public static function get_instance() {
    if( is_null( self::$instance ) ) {
      self::$instance = new self();
      self::$instance->hooks();
    }
    return self::$instance;
  }

  /**
   * Initiate our hooks
   * @since 0.1.0
   */
  public function hooks() {
    add_action( 'admin_init', array( $this, 'init' ) );
    add_action( 'admin_menu', array( $this, 'add_options_page' ) );
    add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
  }


  /**
   * Register our setting to WP
   * @since  0.1.0
   */
  public function init() {
    register_setting( $this->key, $this->key );
  }

  /**
   * Add menu options page
   * @since 0.1.0
   */
  public function add_options_page() {
    $this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

    // Include CMB CSS in the head to avoid FOUC
    add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
  }

  /**
   * Admin page markup. Mostly handled by CMB2
   * @since  0.1.0
   */
  public function admin_page_display() {
    ?>
    <div class="wrap cmb2-options-page <?php echo $this->key; ?>">
      <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
      <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
    </div>
    <?php
  }

  /**
   * Add the options metabox to the array of metaboxes
   * @since  0.1.0
   */
  function add_options_page_metabox() {

    // hook in our save notices
    add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

    $prefix = 'tones_';

    $tones_options = new_cmb2_box( array(
      'id'         => $this->metabox_id,
      'hookup'     => false,
      'cmb_styles' => false,
      'show_on'    => array(
        // These are important, don't remove
        'key'   => 'options-page',
        'value' => array( $this->key, )
      ),
    ) );

    // Set our CMB2 fields
    $tones_options->add_field( array(
      'name'    => 'Header Settings',
      'desc'    => 'These are the global settings for the header, some can be overridden separately.',
      'type' => 'title',
      'id'   => 'wiki_test_title'
    ) );

    $tones_options->add_field( array(
        'name'    => 'Menu Style',
        'id'      => $prefix . 'menu_style',
        'type'    => 'radio_inline',
        'options' => array(
            'dark' => __( 'Dark', 'cmb2' ),
            'light'   => __( 'Light', 'cmb2' )
        ),
        'default' => 'dark',
    ) );

    $tones_options->add_field( array(
        'name'    => 'Menu State',
        'id'      => $prefix . 'menu_state',
        'type'    => 'radio_inline',
        'options' => array(
            'fixed' => __( 'Fixed', 'cmb2' ),
            'notfixed'   => __( 'Not Fixed', 'cmb2' )
        ),
        'default' => 'notfixed',
    ) );

    $tones_options->add_field( array(
        'name'    => 'Search Bar in Menu?',
        'id'      => $prefix . 'menu_search',
        'type'    => 'radio_inline',
        'options' => array(
            'true' => __( 'Yes', 'cmb2' ),
            'false'   => __( 'No', 'cmb2' )
        ),
        'default' => 'false',
    ) );

    $tones_options->add_field( array(
      'name'    => 'Social Settings',
      // 'desc'    => 'These are the global settings for the header, some can be overridden separately.',
      'type' => 'title',
      'id'   => 'tones_social_heading'
    ) );

    $tones_options->add_field( array(
      'name' => __( 'Twitter', 'tonestheme' ),
      'desc' => __( 'Twitter Url', 'tonestheme' ),
      'id'   => $prefix . 'twitter',
      'type' => 'text',
      'default' => '',
    ) );

    $tones_options->add_field( array(
      'name' => __( 'Facebook', 'tonestheme' ),
      'desc' => __( 'Facebook Url', 'tonestheme' ),
      'id'   => $prefix . 'facebook',
      'type' => 'text',
      'default' => '',
    ) );

    $tones_options->add_field( array(
      'name' => __( 'Instagram', 'tonestheme' ),
      'desc' => __( 'Instagram Url', 'tonestheme' ),
      'id'   => $prefix . 'instagram',
      'type' => 'text',
      'default' => '',
    ) );

    $tones_options->add_field( array(
      'name' => __( 'Youtube', 'tonestheme' ),
      'desc' => __( 'Youtube Url', 'tonestheme' ),
      'id'   => $prefix . 'youtube',
      'type' => 'text',
      'default' => '',
    ) ); 

    $tones_options->add_field( array(
      'name' => __( 'Github', 'tonestheme' ),
      'desc' => __( 'Github Url', 'tonestheme' ),
      'id'   => $prefix . 'github',
      'type' => 'text',
      'default' => '',
    ) ); 

    $tones_options->add_field( array(
      'name' => __( 'LinkedIn', 'tonestheme' ),
      'desc' => __( 'LindedIn Url', 'tonestheme' ),
      'id'   => $prefix . 'linkedin',
      'type' => 'text',
      'default' => '',
    ) );

    $tones_options->add_field( array(
      'name' => __( 'Google+', 'tonestheme' ),
      'desc' => __( 'Google+ Url', 'tonestheme' ),
      'id'   => $prefix . 'googleplus',
      'type' => 'text',
      'default' => '',
    ) );  

    // $tones_options->add_field( array(
    //  'name' => __( 'Tracking Code', 'tonestheme' ),
    //  'desc' => __( 'Add tracking code(s) that need to go below the opening <body> tag', 'tonestheme' ),
    //  'id'   => $prefix . 'tracking-scripts',
    //  'type' => 'textarea',
    //  'default' => '',
    // ) );       
        

    // $tones_options->add_field( array(
    //  'name'    => __( 'Test Color Picker', 'tonestheme' ),
    //  'desc'    => __( 'field description (optional)', 'tonestheme' ),
    //  'id'      => 'test_colorpicker',
    //  'type'    => 'colorpicker',
    //  'default' => '#bada55',
    // ) );

  }

  /**
   * Register settings notices for display
   *
   * @since  0.1.0
   * @param  int   $object_id Option key
   * @param  array $updated   Array of updated fields
   * @return void
   */
  public function settings_notices( $object_id, $updated ) {
    if ( $object_id !== $this->key || empty( $updated ) ) {
      return;
    }

    add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'tonestheme' ), 'updated' );
    settings_errors( $this->key . '-notices' );
  }

  /**
   * Public getter method for retrieving protected/private variables
   * @since  0.1.0
   * @param  string  $field Field to retrieve
   * @return mixed          Field value or exception is thrown
   */
  public function __get( $field ) {
    // Allowed fields to retrieve
    if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
      return $this->{$field};
    }

    throw new Exception( 'Invalid property: ' . $field );
  }

}

/**
 * Helper function to get/return the tones_Admin object
 * @since  0.1.0
 * @return tones_Admin object
 */
function tones_admin() {
  return tones_Admin::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function tones_get_option( $key = '' ) {
  return cmb2_get_option( tones_admin()->key, $key );
}

// Get it started
tones_admin();