<?php
/**
  * Class: UDTheme Branding Admin Notices
  *
  * The purpose of this class is to:
  * Define admin paths
  * Enqueue admin specific styles and scripts
  * Register plugin settings in admin dashboard
  * Validate and sanitize plugin options
  * Render plugin settings tabs
  * Display admin specific notices
  * Add settings link to plugin.php
  * Display admin html
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/admin
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2019 University of Delaware
  * @version     3.5.2
*/
if ( ! class_exists( 'udtbp_Admin_Notices' ) ) :
  class udtbp_Admin_Notices extends udtbp_Admin {
    private $udtbp;
    private $current_theme;
    protected $plugin_screen_hook_suffix = null;
    public $plugin_settings_tabs = array();

    /**
    * Initialize the class and set its properties.
    *
    * @since    3.0.0
    * @version  1.0.1    Create json_theme_list instance
    */
    public function __construct( $udtbp, $current_theme ) {
      $this->udtbp = $udtbp;
      $this->current_theme = wp_get_theme();
      $this->plugin_settings_tabs['header']  = 'Header';
      $this->plugin_settings_tabs['footer']  = 'Footer';
      $this->plugin_settings_tabs['about']   = 'About';
      $this->json_theme_list = JSON_THEME_LIST;
      $option   = 0;
    }
    /**
    * ADMIN NOTICES
    *
    * Display notices in admin area. {@link https://gist.github.com/JeffreyWay/3194444} {@linkhttps://github.com/collizo4sky/persist-admin-notices-dismissal}
    *
    * This function is used to:
    * Verify current theme.
    * Checks if current theme (additional check for Divi)
    * has fixed navigation or has issues with the plugin.
    *
    * @since     3.0.0
    * @version   1.0.1                            Replaced static plugin text with CONSTANT.
    * @return    boolean                          If TRUE, apply CSS overrides.
    * @param     string      $screen              Used to get the name of the screen that the current user is on.
    * @var       string      $div_id              ID for theme override div.
    * @var       string      $div_class           Classes to make div dismissible and hidden.
    * @var       string      $p_class             Adds warning icon and class to $div_id div.
    * @var       string      $theme_name          The active theme.
    * @var       string      $button              Dismiss div button text.
    * @var       string      $current_tab         The current tab (Header, Footer, About, Support)
    */

    public function udtbp_theme_override_notices( $screen ) {
      $div_id = $this->udtbp.'_theme_override';
      $div_class = 'notice notice-warning is-dismissible hide';
      $p_class = 'dashicons-before dashicons-warning';
      $button = __( 'Dismiss this notice.' );

      $screen = get_current_screen();
      $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'header';
      if ( $screen->id != 'settings_page_'.$this->udtbp ) {
        return;
      }

      if ( 'header' === $current_tab ) {
         $options = ( get_option( 'udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE );
        $option = $options['view-header'];
      }
      else {
        $options['view-header'] = NULL;
        $option = 0;
      }

      $notice_div = '<div id="%1$s" class="%2$s"><p class="%3$s">The <span class="theme_name">%4$s Theme</span> %5$s</p><button type="button" class="aria_pressed notice-dismiss" aria-pressed="false"><span class="screen-reader-text">%6$s</span></button></div>';

        if ( in_array( $this->current_theme, json_decode( $this->json_theme_list ) ) && $option == 1 ) :

          if ( function_exists( 'et_get_option' ) && 'on' === et_get_option( 'divi_fixed_nav', 'on' ) ) {
            $message = __( " has fixed navigation enabled. To ensure full plugin compatibility, this setting MUST be disabled in your Theme Options.", UDTBP_NAME );
            echo sprintf( $notice_div, $div_id, $div_class, $p_class, $this->current_theme, $message, $button );
          }
          elseif ( function_exists( 'et_get_option' ) && 'false' === et_get_option( 'divi_fixed_nav', 'false' ) ) {
            $message = '';
            $notice_div = '';
            return false;
          }
          else {
            $message = __( ' is not fully compatible with the branding plugin.', UDTBP_NAME );
            echo sprintf( $notice_div, $div_id, $div_class, $p_class, $this->current_theme, $message, $button );
          }
        endif; //end in_array check
    } // end udtbp_theme_override_notices()
  } // end class udtbp_Admin_Notices
endif;
