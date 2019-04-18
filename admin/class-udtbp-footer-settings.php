<?php
/**
  * Class: UDTheme Branding Footer Settings
  *
  * Footer tab in admin dashboard.
  * Extends the udtbp_Admin class and used in public and admin areas.
  * Creates and registers settings and fields within the tabs.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/admin
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2019 University of Delaware
  * @version     3.5.2
 */
if ( ! class_exists( 'udtbp_Footer_Settings' ) ) :
  class udtbp_Footer_Settings extends udtbp_Admin {
    private $udtbp;

    /**
     * CLASS INITIALIZATION class and set its properties.
     *
     * Initiates the class and set its properties.
     *
     * @since    3.0.0
     */
    public function __construct( $udtbp ) {
      $this->id    = 'footer';
      $this->label = __( 'Footer' );
      $this->udtbp = $udtbp.'_footer';
      $this->plugin_settings_tabs[$this->udtbp] = $this->label;
    }

    /**
     * SETTINGS INIT
     *
     * Creates FOOTER settings sections with following fields.
     *
     * @see https://codex.wordpress.org/Function_Reference/register_setting
     *
     * register_setting( $option_group, $option_name, $sanitize_callback );
     * $option_name is used with functions like get_option() and update_option()
     *
     * @since      3.0.0
     * @var        string    $option_group        Footer Settings group name
     * @var        string    $option_name         The name of an option to sanitize and save
     * @param      callable  $sanitize_callback   Callback function for sanitization
     */
    public function settings_api_init( $items ){
      register_setting(
        $this->udtbp . '_options',
        $this->udtbp . '_options',
        array( $this, 'settings_sanitize' )
      );

      /**
       * SETTINGS SECTION
       *
       * Creates and Registers FOOTER settings section on plugin options page.
       *
       * @see https://codex.wordpress.org/Function_Reference/add_settings_section
       * {@link add_settings_section( $id, $title, $callback, $page )}
       *
       * @since    3.0.0
       * @var      string    $id           Section ID used to register options
       * @var      string    $title        Section title displayed on the admin page
       * @var      string    $page         Page to add these section options
       * @param    callable  $callback     Function used to render section description
      */
      add_settings_section(
        $this->udtbp . '-options',
         apply_filters( $this->udtbp . '-display-section-title', __( '' ) ),
        array( $this, 'display_options_section' ),
        $this->udtbp . '-footer'
      );

      /**
       * DISPLAY FOOTER SETTINGS FIELD
       *
       * Creates FOOTER View Footer field.
       *
       * @see http://codex.wordpress.org/Function_Reference/add_settings_field
       * {@link add_settings_field( $id, $title, $callback, $page, $section, $args )}
       *
       * @since    3.0.0
       * @var      string    $id           Field ID ('id' attribute)
       * @var      string    $title        Field title that's displayed in the field label
       * @var      callable  $callback     Function that populates fields with user choices
       * @var      string    $page         Page where this option will be displayed
      */
      add_settings_field(
        'view-footer',
        apply_filters( $this->udtbp . '-view-footer', __( 'Visibility' ) ),
        array( $this, 'view_footer' ),
        $this->udtbp . '-footer',
        $this->udtbp . '-options'
      );
      /**
       * DISPLAY FOOTER COLOR SETTINGS FIELD
       *
       * Creates FOOTER Color field.
       *
       * @since    3.0.0
       * @var      string    $id           ID used to identify the field ('id' attribute)
       * @var      string    $title        Field title that's displayed in the field label
       * @var      callable  $callback     Function that populates fields with user choices
       * @var      string    $page         Page where this option will be displayed
       * @param    array     $items[]      Array of parameters passed to $callback
      */
      add_settings_field(
        'color-footer',
        apply_filters( $this->udtbp . '-color-footer', __( 'Color' ) ),
        array( $this, 'color_footer' ),
        $this->udtbp.'-footer',
        $this->udtbp . '-options',
        array(
          'options' => $items
        )
      );
    } // settings_api_init()

    /**
     * FOOTER SECTION CALLBACK FUNCTION
     *
     * Display paragraph at the top of the footer fields.
     *
     * @since      3.0.0
     * @version    1.5.0     Separated html from php
    */
    public function display_options_section() {
    ?>
      <h2 class="subheadline"><?php echo __( 'Configure options' ); ?></h2>
      <p><?php echo __( 'Blue works best with light backgrounds, white works best with dark backgrounds.' ); ?></p>
    <?php
    } // display_options_section()

    /**
     * TOGGLE FOOTER VISIBILITY
     *
     * @since      1.4.2
     * @version    3.5.1     Fixed SiteImprove compliance issues
    */
    public function view_footer() {
      $options  = get_option( $this->udtbp . '_options' );
      $option   = 0;

      if ( isset( $options['view-footer'] ) && ! empty( $options['view-footer'] ) ) {
        $option = $options['view-footer'];
      }
      else {
        $options['view-footer'] = NULL;
      }
      ?>
      <div id="ud-id-vf" class="switch switch--horizontal">
        <label for="<?php echo esc_attr( $this->udtbp ) ?>_options[view-footer]" class="check-switch">
          <input class="ud-class--view" type="checkbox" aria-checked="" id="<?php echo esc_attr( $this->udtbp )?>_options[view-footer]" name="<?php echo esc_attr( $this->udtbp ) ?>_options[view-footer]" value="1" <?php checked( $option, 1 , TRUE ); ?>>
          <div class="ud-img--container">
            <span class="udt_value_text udt_on_value">
              <svg id="svg_on" class="icon-svg ud-class--on" role="presentation" aria-labeledby="id-label-icon-on" xmlns="http://www.w3.org/2000/svg" focusable="false" width="48" height="48" viewBox="0 0 128 128">
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
              <span id="id-label-icon-off" class="screen-reader-text">This icon is displayed when the selected option is turned on.</span>
            </span>
            <span class="udt_value_text udt_off_value">
              <svg id="svg_off" class="icon-svg ud-class--off" role="presentation" aria-labeledby="id-label-icon-off" xmlns="http://www.w3.org/2000/svg" focusable="false" width="48" height="48" viewBox="0 0 128 128">
                <path class="ud-color" d="M59.3 14C22 14 0 51 0 51s22 37 59.3 37 58.4-37 58.4-37-22.1-37-58.4-37z"></path>
                <circle class="fill--white" cx="59.3" cy="50" r="23.8"></circle>
                <path class="ud-color fill--dark" d="M59.2 39.4a9.3 9.3 0 0 1 .5-2.9 13.502 13.502 0 1 0-.5 27 13.4 13.4 0 0 0 13.3-15.6 9.4 9.4 0 0 1-13.3-8.5z"></path>
                <path class="ud-color fill--dark" d="M7.6 96.44L103.98.063l6.894 6.894-96.379 96.379z"></path>
              </svg>
              <span id="id-label-icon-off" class="screen-reader-text">This icon is displayed when the selected option is turned off.</span>
            </span>
          </div>
        </label>
      </div>
    <?php
    } // view_footer()

    /**
     * FOOTER TEXT AND IMAGES COLOR
     *
     * @since      1.4.2
     * @version    1.0.0
     * @param      var       $options        Footer color checkbox.
     * @param      array     $items[]        List of options in array.
     * @return     mixed                     Colors to set text and image colors.
     */
    public function color_footer( $items ) {
      $options = get_option( $this->udtbp . '_options', $items );
      $items =
        array(
          'blue'    => '009EE1',
          'white'   => 'FFFFFF',
        );
      $option   = '';

      if ( isset( $options['color-footer'] ) && ! empty( $options['color-footer'] ) ) {
        $option = $options['color-footer'];
      }
      else {
        $option = NULL;
      }
    ?>

      <div id="ud-id-cf" class="switch switch--horizontal">
      <?php
        foreach ( $items as $key=>$value ) :
      ?>
        <input type="radio" aria-checked="false" class="ud-class--radio" tabindex="" name="<?php echo esc_attr( $this->udtbp ) ?>_options[color-footer]" id="rad_<?php echo esc_attr( $key ) ?>_footer" value="<?php echo $key; ?>" <?php checked( $option, $key ) ?>>
        <label for="rad_<?php echo esc_attr( $key ) ?>_footer">
          <?php echo esc_attr( $key ) ?>
        </label>
      <?php
        endforeach;
      ?>
        <span class="toggle-outside">
          <span class="toggle-inside"></span>
        </span>
      </div>
    <?php
    } // end color_footer()
  } // end class udtbp_Footer_Settings
endif;

