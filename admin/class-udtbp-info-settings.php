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
  * @version     3.1.0
 */
if ( ! class_exists( 'udtbp_Info_Settings' ) ) :
  class udtbp_Info_Settings extends udtbp_Admin {
    private $udtbp;

    /**
     * CLASS INITIALIZATION class and set its properties.
     * Initiates the class and set its properties.
     *
     * @since    3.1.0
     */
    public function __construct( $udtbp ) {
      $this->id    = 'info';
      $this->label = __( 'Info', $this->udtbp );
      $this->udtbp = $udtbp.'_info';
      $this->plugin_settings_tabs[$this->udtbp] = $this->label;
    }

 public function admin_notice() { ?>
        <div class="notice notice-success is-dismissible">
            <p>Your settings have been updated!</p>
        </div><?php
    }
      public function setup_sections() {
        add_settings_section( 'our_first_section', 'My First Section Title', array( $this, 'section_callback' ), $this->udtbp );
        add_settings_section( 'our_second_section', 'My Second Section Title', array( $this, 'section_callback' ), $this->udtbp );
        add_settings_section( 'our_third_section', 'My Third Section Title', array( $this, 'section_callback' ), $this->udtbp );
    }

    public function section_callback( $arguments ) {
      switch( $arguments['id'] ){
        case 'our_first_section':
          echo 'This is the first description here!';
          break;
        case 'our_second_section':
          echo 'This one is number two';
          break;
        case 'our_third_section':
          echo 'Third time is the charm!';
          break;
      }
    }

    public function setup_fields() {
        $fields = array(
          array(
            'uid' => 'awesome_text_field',
            'label' => 'Sample Text Field',
            'section' => 'our_first_section',
            'type' => 'text',
            'placeholder' => 'Some text',
            'helper' => 'Does this help?',
            'supplimental' => 'I am underneath!',
          ),
          array(
            'uid' => 'awesome_password_field',
            'label' => 'Sample Password Field',
            'section' => 'our_first_section',
            'type' => 'password',
          ),
          array(
            'uid' => 'awesome_number_field',
            'label' => 'Sample Number Field',
            'section' => 'our_first_section',
            'type' => 'number',
          ),
          array(
            'uid' => 'awesome_textarea',
            'label' => 'Sample Text Area',
            'section' => 'our_first_section',
            'type' => 'textarea',
          ),
          array(
            'uid' => 'awesome_select',
            'label' => 'Sample Select Dropdown',
            'section' => 'our_first_section',
            'type' => 'select',
            'options' => array(
              'option1' => 'Option 1',
              'option2' => 'Option 2',
              'option3' => 'Option 3',
              'option4' => 'Option 4',
              'option5' => 'Option 5',
            ),
                'default' => array()
          ),
          array(
            'uid' => 'awesome_multiselect',
            'label' => 'Sample Multi Select',
            'section' => 'our_first_section',
            'type' => 'multiselect',
            'options' => array(
              'option1' => 'Option 1',
              'option2' => 'Option 2',
              'option3' => 'Option 3',
              'option4' => 'Option 4',
              'option5' => 'Option 5',
            ),
                'default' => array()
          ),
          array(
            'uid' => 'awesome_radio',
            'label' => 'Sample Radio Buttons',
            'section' => 'our_first_section',
            'type' => 'radio',
            'options' => array(
              'option1' => 'Option 1',
              'option2' => 'Option 2',
              'option3' => 'Option 3',
              'option4' => 'Option 4',
              'option5' => 'Option 5',
            ),
                'default' => array()
          ),
          array(
            'uid' => 'awesome_checkboxes',
            'label' => 'Sample Checkboxes',
            'section' => 'our_first_section',
            'type' => 'checkbox',
            'options' => array(
              'option1' => 'Option 1',
              'option2' => 'Option 2',
              'option3' => 'Option 3',
              'option4' => 'Option 4',
              'option5' => 'Option 5',
            ),
                'default' => array()
          )
        );
      foreach( $fields as $field ){

          add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'smashing_fields', $field['section'], $field );
            register_setting( 'smashing_fields', $field['uid'] );
      }
    }
     public function field_callback( $arguments ) {

        $value = get_option( $arguments['uid'] );

        if( ! $value ) {
            $value = $arguments['default'];
        }

        switch( $arguments['type'] ){
            case 'text':
            case 'password':
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                break;
            case 'textarea':
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
                break;
            case 'select':
            case 'multiselect':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $attributes = '';
                    $options_markup = '';
                    foreach( $arguments['options'] as $key => $label ){
                        $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                    }
                    if( $arguments['type'] === 'multiselect' ){
                        $attributes = ' multiple="multiple" ';
                    }
                    printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
                }
                break;
            case 'radio':
            case 'checkbox':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
                break;
        }

        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper );
        }

        if( $supplimental = $arguments['supplimental'] ){
            printf( '<p class="description">%s</p>', $supplimental );
        }

    }
    /**
     * SETTINGS INIT
     * Creates CONTACT INFO settings sections with following fields.
     *
     * @see https://codex.wordpress.org/Function_Reference/register_setting
     *
     * register_setting( $option_group, $option_name, $sanitize_callback );
     * $option_name is used with functions like get_option() and update_option()
     *
     * @since     3.1.0
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
       * CONTACT INFO SETTINGS SECTION
       * Creates and Registers FOOTER CONTACT INFO settings section on plugin options page.
       * @see https://codex.wordpress.org/Function_Reference/add_settings_section
       * {@link add_settings_section( $id, $title, $callback, $page )}
       *
       * @since     3.1.0
       * @var       string       $id           ID used to identify this section to register options
       * @var       string       $title        Section title that's displayed on the admin page
       * @var       string       $page         Page to add this section of options
       * @param     callable     $callback     Function used to render the section description
      */
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
      add_settings_section(
        $this->udtbp . '-options',
        apply_filters( $this->udtbp . '-display-section-info', __( 'Contact info', $this->udtbp ) ),
        array( $this, 'display_options_section' ),
        $this->udtbp . '-info'
      );


      /**
       * DISPLAY FOOTER CONTACT INFO FIELDS
       * Creates FOOTER contact info fields.
       *
       * @since    3.1.0
       * @var      string      $id             ID used to identify the field. Used in the 'id' attribute
       * @var      string      $title          Field title that's displayed in the field label
       * @var      callable    $callback       Function that fills the field with the desired form inputs
       * @var      string      $page           Page where this option will be displayed
       * @param    array       $items          Array of parameters passed to $callback
      */
      add_settings_field(
        'info-footer',
        apply_filters( $this->udtbp . '-info', __( 'Info', $this->udtbp ) ),
        array( $this, 'info_footer' ),
        $this->udtbp.'-info',
        $this->udtbp . '-options',
        array(
          'options' => $items
        )
      );
    } // settings_api_init()

      /**
       * FOOTER CONTACT INFO SECTION CALLBACK FUNCTION
       * Display paragraph at the top of the header fields.
       *
       * @since     3.0.0
       * @version   1.5.0    Separated html from php
       */
      public function display_options_section() {
    ?>
        <!-- <h2 class=""><?php //echo esc_html( 'Configure options' ); ?></h2> -->
        <p><?php echo esc_html( 'Complete the fields to display a contact footer above the branded footer.' ); ?></p>
      <?php
      } // display_options_section()



    /**
     * FOOTER TEXT AND IMAGES COLOR
     *
     * @since     1.4.2
     * @version   1.0.0
     * @param     var       $options        Footer color checkbox.
     * @param     array     $items[]        List of options in array.
     * @return    mixed                     The colors blue or white to set text and image colors.
     */
    public function info_footer( $items ) {
      $options    = get_option( $this->udtbp . '_options' );


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

      if ( isset( $options['info-footer'] ) && ! empty( $options['info-footer'] ) ) {
        $option = $options['info-footer'];
      }
      else {
        $option = NULL;
      }

    ?>
    <div class="box-content">
      <label for="<?php echo esc_attr( $this->udtbp.'_options[info-addr]' ) ?>">
        <input id="<?php echo esc_attr( $this->udtbp.'_options[info-addr]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[info-addr]' ) ?>" type="text" value="<?php echo esc_attr( $option ); ?>">
      </label>

      <label for="<?php echo esc_attr( $this->udtbp.'_options[info-city]' ) ?>">
        <input id="<?php echo esc_attr( $this->udtbp.'_options[info-city]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[info-city]' ) ?>" type="text" value="<?php echo esc_attr( $option ); ?>">
      </label>

      <label for="<?php echo esc_attr( $this->udtbp.'_options[info-state]' ) ?>">
        <input id="<?php echo esc_attr( $this->udtbp.'_options[info-state]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[info-state]' ) ?>" type="text" value="<?php echo esc_attr( $option ); ?>">
      </label>

      <label for="<?php echo esc_attr( $this->udtbp.'_options[info-phone]' ) ?>">
        <input id="<?php echo esc_attr( $this->udtbp.'_options[info-phone]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[info-phone]' ) ?>" type="text" value="<?php echo esc_attr( $option ); ?>">
      </label>
      <label for="<?php echo esc_attr( $this->udtbp.'_options[info-email]' ) ?>">
        <input id="<?php echo esc_attr( $this->udtbp.'_options[info-email]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[info-email]' ) ?>" type="text" value="<?php echo esc_attr( $option ); ?>">
      </label>
    </div>
    <?php
    } // end info_footer()
  } // end class udtbp_Info_Settings
endif;

