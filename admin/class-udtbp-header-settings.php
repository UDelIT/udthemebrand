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
  * @version     3.1.0
*/

if ( ! class_exists( 'udtbp_Header_Settings' ) ) :
  class udtbp_Header_Settings extends udtbp_Admin {
    private $udtbp;

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
     * @deprecated deprecated since version    3.1.0      No longer used.
    */

    /**
     * CUSTOM SITE TITLE / DEPARTMENT UNIT TITLE SETTINGS FIELD
     * Creates HEADER TITLE text field.
     *
     * @since         3.1.0
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
  <h2 class=""><?php echo esc_html( 'Configure options' ); ?></h2>
  <p><?php echo esc_html( 'Display header with web site title or department text.' ); ?></p>
  <?php
  } // display_options_section()

  /**
   * TOGGLE HEADER VISIBILITY
   *
   * @since     1.4.2
   * @version   3.1.0
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

    <div class="box-content">
      <input type="hidden" name="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>" value="0">

       <label for="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>">
        <input class="checkbox yes_no_button" type="checkbox" id="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>" name="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>" value="1" <?php checked( $option, 1 , TRUE ) ?> >
          <div class="udt_yes_no_button <?php echo esc_attr( (  ! empty( $options['view-header'] ) ) ? 'udt_on_state' : 'udt_off_state' )?>">
            <span class="udt_value_text udt_on_value"><?php _e( 'Enabled', $this->udtbp ) ?></span>
            <span class="udt_button_slider"></span>
            <span class="udt_value_text udt_off_value"><?php _e( 'Disabled', $this->udtbp ) ?></span>
          </div>
      </label>
    </div>
<?php
  } // view_header()

  /**
   * HEADER TITLE BAR
   *
   * @since       3.1.0
  */
  public function header_title( $items ) {

    $options    = get_option( $this->udtbp . '_options' );
    $option   = 0;
    $wp_site_title = get_bloginfo( 'name' );
    if ( !isset( $options['header-title'] ) &&  $options['header-title'] == $wp_site_title  ) {
      $option = $options['header-title'];
      $custom_header_text = $option;
    }
    else {
      $option = get_bloginfo( 'name' );
      $custom_header_text = NULL;
    }

    ?>
    <div class="box-content">
      <ul id="previous"></ul>
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
      * @since     3.1.0
      * @version   2.0.0   Replaced $option with $custom_header_text for granularity
      * @var       string  $custom_header_text    Input field that contains option value
      */


      update_option( '$this->udtbp' . '_options', $custom_header_text );
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
