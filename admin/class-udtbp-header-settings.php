<?php
/**
  * Class: UDTheme Branding Header Settings
  *
  * Header tab in admin dashboard.
  * Extends the udtbp_Admin class and used in public and admin areas.
  * Creates and registers settings and fields within the tabs.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/admin
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.5.0
*/

if ( ! class_exists( 'udtbp_Header_Settings' ) ) :
  class udtbp_Header_Settings extends udtbp_Admin {
    private $udtbp;
    private $blog_name;

  /**
   * CLASS INITIALIZATION class and set its properties.
   * Initiates the class and set its properties.
   *
   * @since      3.0.0
   * @param      string           $custom_header_text     The site title field value.
   */

   public function __construct( $udtbp, $custom_header_text ) {
    $this->id    = 'header';
    $this->label = __( 'Header', $this->udtbp );
    $this->udtbp = $udtbp.'_header';
    $this->plugin_settings_tabs[$this->udtbp] = $this->label;
    $this->custom_header_text = get_option( $custom_header_text );
    // $this->$blog_name = get_bloginfo( 'name' );
  }

  /**
   * SETTINGS INIT
   * Creates HEADER settings sections with following fields.
   *
   * @see https://codex.wordpress.org/Function_Reference/register_setting
   *
   * register_setting( $option_group, $option_name, $sanitize_callback );
   * $option_name is used with functions like get_option() and update_option()
   *
   * @since     3.0.0
   * @var       string       $option_group        Header Settings group name
   * @var       string       $option_name         The name of an option to sanitize and save
   * @param     callable     $sanitize_callback   Callback function for sanitization
   */
  public function settings_api_init( $items ){
    register_setting(
      $this->udtbp . '_options',
      $this->udtbp . '_options',
      array( $this, 'settings_sanitize' )
    );

    /**
     * SETTINGS SECTION
     * Creates and Registers HEADER settings section on plugin options page.
     *
     * @see https://codex.wordpress.org/Function_Reference/add_settings_section
     * {@link add_settings_section( $id, $title, $callback, $page )}
     *
     * @since     3.0.0
     * @var       string       $id           ID used to identify this section to register options
     * @var       string       $title        Section title that's displayed on the admin page
     * @var       string       $page         Page to add this section of options
     * @param     callable     $callback     Function used to render the section description
    */
    add_settings_section(
      $this->udtbp . '-options',
      apply_filters( $this->udtbp . '-display-section-title', __( '', $this->udtbp ) ),
      array( $this, 'display_options_section' ),
      $this->udtbp . '-header'
    );

    /**
     * DISPLAY HEADER SETTINGS FIELD
     * Creates HEADER View Header field.
     *
     * @see http://codex.wordpress.org/Function_Reference/add_settings_field
     * {@link add_settings_field( $id, $title, $callback, $page, $section, $args )}
     *
     * @since     3.0.0
     * @var       string       $id           ID used to identify the field. Used in the 'id' attribute
     * @var       string       $title        Field title that's displayed in the field label
     * @var       callable     $callback     Function that fills the field with the desired form inputs
     * @var       string       $page         Page where this option will be displayed
    */
    add_settings_field(
      'view-header',
      apply_filters( $this->udtbp . '-view-header', __( 'Visibility', $this->udtbp ) ),
      array( $this, 'view_header' ),
      $this->udtbp . '-header',
      $this->udtbp . '-options'
    );

    /**
     * CUSTOM LOGO SETTINGS FIELD
     * Creates HEADER Custom Logo selection field.
     *
     * {@link public function custom_logo()} {@link bkup/deprecated_functions}
     *
     * @since         3.0.0
     * @deprecated deprecated since version    3.5.0      No longer used.
    */

    /**
     * CUSTOM SITE TITLE / DEPARTMENT UNIT TITLE SETTINGS FIELD
     * Creates HEADER TITLE text field.
     *
     * @since         3.5.0
    */
    add_settings_field(
      'header-title',
      apply_filters( $this->udtbp . '-header-title', __( 'Site Title', $this->udtbp ) ),
      array( $this, 'header_title' ),
      $this->udtbp.'-header',
      $this->udtbp .  '-options'
    );
  } // settings_api_init()

  /**
   * HEADER SECTION CALLBACK FUNCTION
   * Display paragraph at the top of the header fields.
   *
   * @since     3.0.0
   * @version   1.5.1    Removed logo related text. Added custom related text.
   * @todo               Create single helper function and update text based on active tab
   * @see                https://www.smashingmagazine.com/2016/04/three-approaches-to-adding-configurable-fields-to-your-plugin/
   */
  public function display_options_section() {

  ?>
  <h2 class="subheadline"><?php echo _e( 'Configure options' ); ?></h2>
  <p><?php echo _e( 'Display header with web site title or department text.' ); ?></p>
  <?php
  } // display_options_section()

  /**
   * TOGGLE HEADER VISIBILITY
   *
   * @since     1.4.2
   * @version   3.5.0
   */
  public function view_header() {
    $options  = get_option( $this->udtbp . '_options' );
    $option   = 0;

    if ( isset( $options['view-header'] ) && ! empty( $options['view-header'] ) ) {
      $option = $options['view-header'];
    }
    else {
      $options['view-header'] = NULL;
    }
?>

<div id="ud-id-vh" class="switch switch--horizontal">
  <label for="<?php echo esc_attr( $this->udtbp ) ?>_options[view-header]" class="check-switch">
    <input class="ud-class--view" type="checkbox" aria-checked="" id="<?php echo esc_attr( $this->udtbp )?>_options[view-header]" name="<?php echo esc_attr( $this->udtbp ) ?>_options[view-header]" value="1" <?php checked( $option, 1 , TRUE ); ?>>
    <div class="ud-img--container">
      <span class="udt_value_text udt_on_value">
        <svg id="svg_on" class="icon-svg ud-class--on" role="img" aria-labeledby="id-on" xmlns="http://www.w3.org/2000/svg" focusable="false" width="48" height="48" viewBox="0 0 128 128">
          <title id="id-on" class="screen-reader-text">Visible icon</title>
          <defs>
            <style>
              .fill--current{fill:currentColor}
              .fill--white{fill:white}
              .fill--dark{fill:#010101}
            </style>
          </defs>
          <path d="M64.1,25C26.8,25,4.8,62,4.8,62s22,37,59.3,37,58.4-37,58.4-37S100.4,25,64.1,25Z" transform="translate(-4.8 -25)"></path>
          <circle class="fill--white" cx="59.3" cy="36" r="23.8"></circle>
          <path class="fill-dark" d="M64,50.4a9.3,9.3,0,0,1,.5-2.9,13.5,13.5,0,1,0-.5,27A13.4,13.4,0,0,0,77.3,58.9,9.4,9.4,0,0,1,64,50.4Z" transform="translate(-4.8 -25)"></path>
        </svg>
      </span>
      <span class="udt_value_text udt_off_value">
        <svg id="svg_off" class="icon-svg ud-class--off" role="img" aria-labeledby="id-off" xmlns="http://www.w3.org/2000/svg" focusable="false" width="48" height="48" viewBox="0 0 128 128">
          <title id="id-off" class="screen-reader-text">Invisible icon</title>
          <path class="ud-color" d="M59.3 14C22 14 0 51 0 51s22 37 59.3 37 58.4-37 58.4-37-22.1-37-58.4-37z"></path>
          <circle class="fill--white" cx="59.3" cy="50" r="23.8"></circle>
          <path class="ud-color fill--dark" d="M59.2 39.4a9.3 9.3 0 0 1 .5-2.9 13.502 13.502 0 1 0-.5 27 13.4 13.4 0 0 0 13.3-15.6 9.4 9.4 0 0 1-13.3-8.5z"></path>
          <path class="ud-color fill--dark" d="M7.6 96.44L103.98.063l6.894 6.894-96.379 96.379z"></path>
        </svg>
      </span>
    </div>
  </label>
</div>



  <!--  <div id="ud-id-vh" class="box-content switch" tabindex="0">
      <input type="hidden" name="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>" value="0">

      <label for="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>">
        <input class="ud-class--view checkbox yes_no_button" type="checkbox" aria-checked="" tabindex="-1"  id="<?php echo esc_attr( $this->udtbp.'_options[view-header]', UDTBP_NAME )?>" name="<?php echo esc_attr( $this->udtbp.'_options[view-header]', UDTBP_NAME )?>" value="1" <?php checked( $option, 1 , TRUE ) ?> >
        <div class="udt_yes_no_button <?php echo esc_attr( (  ! empty( $options['view-header'] ) ) ? 'udt_on_state' : 'udt_off_state' ) ?>">

          <span class="udt_value_text udt_on_value">
            <svg id="svg_on" class="icon-svg ud-class--on" role="img" aria-labeledby="id-on" xmlns="http://www.w3.org/2000/svg" focusable="false" width="48" height="48" viewBox="0 0 128 128">
              <title id="id-on" class="screen-reader-text">Visible icon</title>
              <path d="M64.1,25C26.8,25,4.8,62,4.8,62s22,37,59.3,37,58.4-37,58.4-37S100.4,25,64.1,25Z" transform="translate(-4.8 -25)"></path>
              <circle cx="59.3" cy="36" r="23.8" style="fill:#fff"></circle>
              <path d="M64,50.4a9.3,9.3,0,0,1,.5-2.9,13.5,13.5,0,1,0-.5,27A13.4,13.4,0,0,0,77.3,58.9,9.4,9.4,0,0,1,64,50.4Z" transform="translate(-4.8 -25)" style="fill: #010101"></path>
            </svg>
          </span>
          <span id="tem" aria-hidden="true">
            <span class="udt_button_slider"></span>
          </span>
          <span class="udt_value_text udt_off_value">
            <svg id="svg_off" class="icon-svg ud-class--off" role="img" aria-labeledby="id-off" xmlns="http://www.w3.org/2000/svg" focusable="false" width="48" height="48" viewBox="0 0 128 128">
              <title id="id-off" class="screen-reader-text">Invisible icon</title>
              <path class="ud-color" d="M59.3 14C22 14 0 51 0 51s22 37 59.3 37 58.4-37 58.4-37-22.1-37-58.4-37z"></path>
              <circle cx="59.3" cy="50" r="23.8" fill="#fff"></circle>
              <path d="M59.2 39.4a9.3 9.3 0 0 1 .5-2.9 13.502 13.502 0 1 0-.5 27 13.4 13.4 0 0 0 13.3-15.6 9.4 9.4 0 0 1-13.3-8.5z" class="ud-color" fill="#010101"></path>
              <path class="ud-color" fill="#010101" d="M7.6 96.44L103.98.063l6.894 6.894-96.379 96.379z"></path>
            </svg>
          </span>
        </div>
      </label>
    </div> -->
<?php
  } // view_header()

  /**
   * HEADER TITLE BAR
   *
   * @since       3.5.0
  */
  public function header_title( $items ) {

    $options    = get_option( $this->udtbp . '_options' );
    $option   = 0;

    $wp_site_title = get_bloginfo( 'name' );

    if ( isset( $options['header-title'] ) && ! empty( $options['header-title'] ) ){
      $option = $options['header-title'];
      $custom_header_text = $option;
    }
    else {
      $option = get_bloginfo( 'name' );
      $custom_header_text = NULL;
    }



    ?>
    <div id="ud-id-ht" class="box-content">
      <label for="<?php echo esc_attr( $this->udtbp.'_options[header-title]' ) ?>">
        <input id="<?php echo esc_attr( $this->udtbp.'_options[header-title]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[header-title]' ) ?>" type="text" value="<?php echo esc_attr( $option ); ?>"><span></span>
      </label>
      <input type="hidden" id="udt_custom_header_text" name="udt_custom_header_text" value="<?php echo esc_attr( $option ); ?>"><span></span>
      <div class="field_prompt"><?php _e( 'Displays web site Title if no departmental text is provided.', $this->udtbp ); ?></div>
    </div>

      <?php
      /**
      * UPDATE HEADER TITLE BAR TEXT
      * Added to pass header title text value to public view.
      * TODO: Is this sufficient
      * @since     3.5.0
      * @version   2.0.0   Replaced $option with $custom_header_text for granularity
      * @var       string  $custom_header_text    Input field that contains option value
      */


      //update_option( '$this->udtbp' . '_options', $custom_header_text );
    } // header_title()
  } // end class udtbp_Header_Settings
endif;


// https://wordpress.stackexchange.com/questions/141102/how-can-i-detect-that-option-value-has-changed
// function myplugin_update_field_foo( $new_value, $old_value ) {
//   $new_value = intval( $new_value );
//   $new_value ++;
//   return $new_value;
// }

// function myplugin_init() {
//   add_filter( 'pre_update_option_foo', 'myplugin_update_field_foo', 10, 2 );
// }

// add_action( 'init', 'myplugin_init' );
//
// https://wordpress.stackexchange.com/questions/71420/add-option-if-not-exists
// if(!get_option('speccc_nameee')){
 // update_option('speccc_nameee', 'first_default_value');
//}
