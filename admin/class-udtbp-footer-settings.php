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
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.5.0
 */
if ( ! class_exists( 'udtbp_Footer_Settings' ) ) :
  class udtbp_Footer_Settings extends udtbp_Admin {
    private $udtbp;

    /**
     * CLASS INITIALIZATION class and set its properties.
     * Initiates the class and set its properties.
     *
     * @since    3.0.0
     */
    public function __construct( $udtbp ) {
      $this->id    = 'footer';
      $this->label = __( 'Footer', $this->udtbp );
      $this->udtbp = $udtbp.'_footer';
      $this->plugin_settings_tabs[$this->udtbp] = $this->label;
    }

    /**
     * SETTINGS INIT
     * Creates FOOTER settings sections with following fields.
     *
     * @see https://codex.wordpress.org/Function_Reference/register_setting
     *
     * register_setting( $option_group, $option_name, $sanitize_callback );
     * $option_name is used with functions like get_option() and update_option()
     *
     * @since     3.0.0
     * @var       string       $option_group        Footer Settings group name
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
       * Creates and Registers FOOTER settings section on plugin options page.
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
        //apply_filters( $this->udtbp . '-display-section-title', __( 'Configure options', $this->udtbp ) ),
         apply_filters( $this->udtbp . '-display-section-title', __( '', $this->udtbp ) ),
        array( $this, 'display_options_section' ),
        $this->udtbp . '-footer'
      );
      /**
       * DISPLAY FOOTER SETTINGS FIELD
       * Creates FOOTER View Footer field.
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
        'view-footer',
        apply_filters( $this->udtbp . '-view-footer', __( 'Visibility', $this->udtbp ) ),
        array( $this, 'view_footer' ),
        $this->udtbp . '-footer',
        $this->udtbp . '-options'
      );
      /**
       * DISPLAY FOOTER COLOR SETTINGS FIELD
       * Creates FOOTER Color field.
       *
       * @since    3.0.0
       * @var      string      $id             ID used to identify the field. Used in the 'id' attribute
       * @var      string      $title          Field title that's displayed in the field label
       * @var      callable    $callback       Function that fills the field with the desired form inputs
       * @var      string      $page           Page where this option will be displayed
       * @param    array       $items          Array of parameters passed to $callback
      */
      add_settings_field(
        'color-footer',
        apply_filters( $this->udtbp . '-color-footer', __( 'Color', $this->udtbp ) ),
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
     * Display paragraph at the top of the header fields.
     *
     * @since     3.0.0
     * @version   1.5.0    Separated html from php
     */
    public function display_options_section() {
  ?>
      <h2 class="subheadline"><?php echo esc_html( 'Configure options' ); ?></h2>
      <p><?php echo esc_html( 'Blue works best with light backgrounds, white works best with dark backgrounds.' ); ?></p>
    <?php
    } // display_options_section()

    /**
     * TOGGLE FOOTER VISIBILITY
     *
     * @since     1.4.2
     * @version   3.5.0
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
      <!-- <div role="checkbox" aria-checked="false" tabindex="0" onkeydown="toggleCheckbox(event)" onclick="toggleCheckbox(event)" onfocus="focusCheckbox(event)" onblur="blurCheckbox(event)">
    <img src="https://www.w3.org/TR/2016/WD-wai-aria-practices-1.1-20160317/examples/checkbox/images/checkbox-unchecked-black.png" alt="">
     Label 1
  </div> -->
      <div id="ud-id-vf" class="switch switch--horizontal" tabindex="0">
        <label for="<?php echo esc_attr( $this->udtbp ) ?>_options[view-footer]" class="check-switch ">
          <input type="checkbox" aria-checked="" tabindex="-1" aria-labeledby="title" id="<?php echo esc_attr( $this->udtbp )?>_options[view-footer]" name="<?php echo esc_attr( $this->udtbp ) ?>_options[view-footer]" value="1" <?php checked( $option, 1 , TRUE ); ?>>
          <span aria-hidden="true"></span>
        </label>
      </div>
 <!--  <div id="ud-id-vf">
    <label for="<?php echo esc_attr( $this->udtbp.'_options[view-footer]' )?>" class="ud-label--switch">
       <button role="switch" type="button" aria-checked="true" id="<?php echo esc_attr( $this->udtbp.'_options[view-footer]' )?>" class="switch" value="1" <?php checked( $option, 1 , TRUE ); ?> >
         <div class="ud-norm--toggle">
           <span class="on">on</span>
           <span class="knob"></span>
           <span class="off">off</span>
         </div>
       </button>
      </label>
</div> -->
      <!-- <div id="ud-id-vf" class="box-content">

        <label for="<?php echo esc_attr( $this->udtbp.'_options[view-footer]' )?>">
          <input class="checkbox yes_no_button" type="checkbox" id="<?php echo esc_attr( $this->udtbp )?>_options[view-footer]" name="<?php echo esc_attr( $this->udtbp ) ?>_options[view-footer]" value="1" <?php checked( $option, 1 , TRUE ); ?> aria-checked="true" tabindex="0">
          <div class="udt_yes_no_button <?php echo (  ! empty( $options['view-footer'] ) ) ? 'udt_on_state' : 'udt_off_state' ?>">

            <span class="udt_value_text udt_on_value"><?php _e( 'Enabled', $this->udtbp ) ?></span>
            <span class="udt_button_slider"></span>
            <span class="udt_value_text udt_off_value"><?php _e( 'Disabled', $this->udtbp ) ?></span>
          </div>
        </label>
      </div> -->
    <?php
    } // view_footer()

    /**
     * FOOTER TEXT AND IMAGES COLOR
     *
     * @since     1.4.2
     * @version   1.0.0
     * @param     var       $options        Footer color checkbox.
     * @param     array     $items[]        List of options in array.
     * @return    mixed                     The colors blue or white to set text and image colors.
     */
    public function color_footer( $items ) {
      $options = get_option( $this->udtbp . '_options', $items );
      $items =
        array(
          'blue'    => '009EE1',
          'white'   => 'FFFFFF',
        );
        // $items =
        // array(
        //   '009EE1'    => TRUE,
        //   'FFF'   => TRUE,
        // );
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
      <input type="radio" aria-checked="false" tabindex="" class="" name="<?php echo esc_attr( $this->udtbp ) ?>_options[color-footer]" id="rad_<?php echo esc_attr( $key ) ?>_footer" value="<?php echo $key; ?>" <?php checked( $option, $key ) ?>>
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

