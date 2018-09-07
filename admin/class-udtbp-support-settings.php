<?php
/**
  * Class: UDTheme Branding Support Settings
  *
  * Support tab in admin dashboard.
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
if ( ! class_exists( 'udtbp_Support_Settings' ) ) :
  class udtbp_Support_Settings extends udtbp_Admin {
    private $udtbp;

  /**
   * CLASS INITIALIZATION class and set its properties.
   * Initiates the class and set its properties.
   *
   * @since      3.0.0
   */

   public function __construct( $udtbp ) {
    $this->id    = 'support';
    $this->label = __( 'Support', $this->udtbp );
    $this->udtbp = $udtbp.'support';
    $this->plugin_settings_tabs[$this->udtbp] = $this->label;
  }

   /**
    * SETTINGS INIT
    * Creates SUPPORT settings sections with following fields.
  *
  * @see https://codex.wordpress.org/Function_Reference/register_setting
  *
  * register_setting( $option_group, $option_name, $sanitize_callback );
  * $option_name is used with functions like get_option() and update_option()
  *
  * @since     3.0.0
  * @var       string       $option_group        Support Settings group name
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
     * @since     3.0.0
     * @var       string            $id                          ID used to identify this section to register options
     * @var       string            $title                       Title that's displayed on the admin page
     * @var       string            $page                        Page to add this section of options
     * @param     callable          $callback                    Callback function used to render the section description
    */
    add_settings_section(
      $this->udtbp . '-options',
      apply_filters( $this->udtbp . '-display-section-title', __( '', $this->udtbp ) ),
      array( $this, 'display_options_section' ),
      $this->udtbp . '-support'
    );
    /**
     * DISPLAY SUPPORT SETTINGS FIELD
     * Creates SUPPORT section.
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
      'view-support',
      apply_filters( $this->udtbp . '-view-support', __( 'Visibility', $this->udtbp ) ),
      array( $this, 'view_support' ),
      $this->udtbp . '-support',
      $this->udtbp . '-options'
    );
  } // settings_api_init()
  public function display_options_section() {
    /**
     * HEADER SECTION CALLBACK FUNCTION
     * Display paragraph at the top of the header fields.
     *
     * @since     3.0.0
     * @version   1.5.0    Separated html from php
     */
  ?>
  <h3 class=""><?php echo esc_html( 'Configure header branding options' ); ?></h3>
  <p><?php echo esc_html( 'Display header with UD or college labeled logo.' ); ?></p>
  <?php
  } // display_options_section()

/**
   * TOGGLE HEADER VISIBILITY
   *
   * @since     1.4.2
   * @version   3.1.0
   */
  public function view_support() {
?>
 <div class="inside">
                <div class="gridwrapper">
                  <div class="grid">1</div>
                  <div class="grid">2</div>
                  <div class="grid">3</div>
                </div>
    <div class="box-content">
     <h3>Support and help information.</h3>
                <p>If you are experiencing problems with this plugin, contact the Support Center at (302) 831-6000 or <a href="mailto:consult@udel.edu">consult@udel.edu</a>.</p>
                <h3>Known Incompatible Themes</h3>
                <p><?php echo esc_html( UDTBP_NAME ); ?> is designed to display a University branded header and footer at the top of each page. Some themes contain features that may cause the UD header to 'hide' beneath the menu or cause the branding to display incorrectly. ( <a href="<?php echo esc_url( UDTBP_ADMIN_IMG_URL );?>/incompatible_example.jpg" class="dialogify" type="button" data-width="500" data-height="300">See example</a> ).

                <input value="press to open dialog" id="login" type="button"></p>
                <ul class="support_list">
<?php
                $json_theme_list = json_decode( JSON_THEME_LIST );

                   //$this->path = new udtbp_Public();
                   //$this->social_data = udtbp_Public::udtbp_enqueue_inline_theme_styles();

                   foreach ( $json_theme_list as $json ){
                     echo '<li>'.$json.'</li>';
                   }
                   ?>
                </ul>
    </div>
<?php
  } // view_support()

  public function custom_logo( $items ) {
 ?>
    <div class="box-content">

    </div>
<?php
    } // custom_logo()
  } // end class udtbp_Support_Settings
endif;
