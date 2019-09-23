<?php
/**
  * Class: UDTheme Branding Admin
  *
  * The purpose of this class is to:
  * Enqueue admin specific styles and scripts
  * Define admin and public facing hooks
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
  * @version     3.5.3
*/

if ( ! class_exists( 'udtbp_Admin' ) ) :
  class udtbp_Admin {
    private $udtbp;
    private $current_theme;
    private $color_footer;

    /**
     * The current custom Site Title.
     *
     * @since      3.0.1
     * @version    2.0.0                           Select replaced with text field.
     * @access     private
     * @var        string    $custom_header_text   The site title field value.
     */
    private $custom_header_text;

    /**
     * Slug of the plugin screen.
     *
     * @since      3.0.0
     * @access     protected
     * @var        string    $plugin_screen_hook_suffix  The plugin options screen
    */
    protected $plugin_screen_hook_suffix = null;

    /**
     * Plugin tabs array.
     *
     * @since      3.0.0
     * @access     public
     * @var        array     $plugin_settings_tabs[]    Each dashboard settings tab
    */
    public $plugin_settings_tabs = array();
    public $current_tab;

    /**
     * CLASS INITIALIZATION
     *
     * Initiates the class and set its properties.
     *
     * @since      3.0.0
     * @param      string    $udtbp                 The ID of this plugin.
     * @param      string    $current_theme         The current active theme.
     * @param      string    $custom_header_text    The site title field value.
    */
    public function __construct( $udtbp, $current_theme, $custom_header_text ) {
      $this->udtbp = $udtbp;
      $this->current_theme = wp_get_theme();
      $this->custom_header_text = get_option( $custom_header_text );
      $this->plugin_settings_tabs['header']  = 'Header';
      $this->plugin_settings_tabs['footer']  = 'Footer';
      $this->plugin_settings_tabs['about']   = 'About';
    }

    /**
     * ENQUEUE ADMIN CSS
     *
     * This function is used to:
     * Register and enqueue admin-specific stylesheets {@link http://wordpress.stackexchange.com/questions/195864/most-elegant-way-to-enqueue-scripts-in-function-php-with-foreach-loop}
     * {@link http://wordpress.stackexchange.com/questions/145782/check-and-dequeue-if-multiple-stylesheets-exists-using-wp-style-is}
     * Register and enqueue admin-specific stylesheets for Internet Explorer.
     * Check if required plugin styles for jQuery UI are enqueued.
     *
     * @since      3.0.0
     * @version    1.0.3     Moved deprecated {@link bkup/deprecated_functions} function here.
     * @return     bool      Script registered?  yes = True, no = false.
    */
    public function enqueue_styles( ) {
      if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
        return;
      }

      $screen = get_current_screen();
      if ( $this->plugin_screen_hook_suffix == $screen->id ) {
        wp_deregister_style( $this->udtbp .'-admin-styles' );
        wp_register_style( $this->udtbp .'-admin-styles', UDTBP_ADMIN_CSS_URL.'/udtbp-admin.css', array(), UDTBP_VERSION, 'all' );
        wp_enqueue_style( $this->udtbp .'-admin-styles' );
        wp_enqueue_style( 'wp-jquery-ui-dialog' );

        global $is_IE;
        global $is_edge;
        if( ( $is_IE ) || ( $is_edge ) ) {
          add_filter( 'body_class', function( $classes ) {
            return array_merge( $classes, array( 'is_ie' ) );
          } );
        }
      }
    } // end enqueue_styles()

    /**
     * ADD ADMIN INLINE CSS
     *
     * Check if WP Admin Bar is showing and adds inline styles
     * to override WP admin-bar.min.css so that bar doesn't
     * cover UDBrand header.
     *
     * @since      3.0.0
     * @todo                 Remove inline styles and concatenate to admin stylesheet.
    */
    public function udtbp_enqueue_inline_admin_styles() {
      if ( is_user_logged_in() && is_admin_bar_showing() ) :
        $custom_css =
          '@media screen and (max-width:600px) {#wpadminbar {position: fixed !important;}div#post-body.metabox-holder.columns-1 {overflow-x: visible !important;}}'."\n";
          '@media only screen and (max-width:48em) {#wpadminbar {position:fixed !important;}}'."\n";
        wp_add_inline_style( $this->udtbp .'-admin-styles', $custom_css );
      endif;
    } // end udtbp_enqueue_inline_admin_styles()

    /**
     * ENQUEUE WORDPRESS CORE JAVASCRIPT
     *
     * JQUERY SCRIPTS LOADED CHECK
     *
     * Checks to see if jquery, jquery-form, jquery-ui-core, jquery-ui-dialog,
     * jquery-ui-tabs, jquery-ui-widget are loaded
     *
     * Build an array of scripts to enqueue
     * key = script handle
     *
     * @since      3.0.0
     * @param      array     $jquery_addons_js_check[]  Dependent scripts array
     * @param      string    $min                       Loads minified versions for prod
     * @return     null                                 Return early if no settings page is registered.
     * @uses       jQuery Form, jQuery UI Dialog, jQuery UI Tabs, jQuery UI Widget scripts
     * @link  http://wordpress.stackexchange.com/questions/195864/most-elegant-way-to-enqueue-scripts-in-function-php-with-foreach-loop
     * @link  https://wordpress.org/support/topic/broken-dependencies-1/
    */
    public function enqueue_core_scripts( ) {
      if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
        return;
      }
      $screen = get_current_screen();
      if ( $this->plugin_screen_hook_suffix == $screen->id ) {

        $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
         // $jquery_addons_js_check = [
         //   'jquery-form'       => includes_url( 'js/jquery/form{$min}.js' ),
         //   'jquery-ui-core'    => includes_url( 'js/jquery/ui/core{$min}.js' ),
         //   'jquery-ui-dialog'  => includes_url( 'js/jquery/ui/dialog{$min}.js' ),
         //   'jquery-ui-tabs'    => includes_url( 'js/jquery/ui/tabs{$min}.js' ),
         //   'jquery-ui-widget'  => includes_url( 'js/jquery/ui/widget{$min}.js' ),
         // ];
         //   array( implode( ",", $jquery_js_check ) );
        $jquery_addons_js_check = [
          'jquery-form',
          'jquery-ui-core',
          'jquery-ui-dialog',
          'jquery-ui-tabs',
          'jquery-ui-widget',
        ];

        foreach ( $jquery_addons_js_check as $key ) {
           // Check if the script is enqueued.
          if ( wp_script_is( $key, 'enqueued' ) ) {
            return;
          }
          else {
            wp_enqueue_script( 'jquery-ui-tabs' );
          }
        } //end foreach
      }
    } //end enqueue_core_scripts()

    /**
     * ENQUEUE ADMIN JAVASCRIPT
     *
     * This function is used to:
     * Register and enqueue admin-specific javascript
     * Adds admin specific javascript files.
     *
     * @since      3.0.0
     * @param      string    $screen    Screen name current user is on
     * @return     null                 Return early if no settings page is registered
    */
    public function enqueue_scripts() {
      global $pagenow;
      if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
        return;
      }
      $screen = get_current_screen();
      if ( $this->plugin_screen_hook_suffix == $screen->id ) {
        wp_enqueue_script( 'jquery-ui-tabs' );
        wp_deregister_script( $this->udtbp . '-admin-script' );
        wp_register_script( $this->udtbp .'-admin-script', UDTBP_ADMIN_JS_URL.'/udtbp-admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-dialog', 'jquery-form' ), UDTBP_VERSION, TRUE );
        wp_enqueue_script( $this->udtbp . '-admin-script' );

      $args_localize_script = [
        'plugin_name' => UDTBP_NAME,
        'udtbp_nonce' => wp_create_nonce( $this->udtbp.'_nonce' ),
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'view_header' => $this->udtbp.'_options[view-header]',
        'header_site_title' => $this->custom_header_text,
        'view_footer' => $this->udtbp.'_options[view-footer]',
        'footer_color' => $this->udtbp.'_options[color-footer]',
        'udtbp_theme_override' => $this->udtbp.'_theme_override',
        'ascss' => UDTBP_ASSETS_CSS_URL,
        'asjs' => UDTBP_ASSETS_JS_URL,
        'adcss' => UDTBP_ADMIN_CSS_URL,
        'adjs' => UDTBP_ADMIN_JS_URL,
        'pucss' => UDTBP_PUBLIC_CSS_URL,
        'pujs' => UDTBP_PUBLIC_JS_URL
      ];
      wp_localize_script( $this->udtbp . '-admin-script', 'udtheme_admin_js_vars', $args_localize_script );
      }
    } // end enqueue_scripts()

    /**
     * REGISTER SETTINGS PAGE
     *
     * {@link https://coderwall.com/p/lw2suw/enqueue-scripts-styles-on-a-wordpress-option-page}
     * @since      3.0.0
     * @version    2.0.0     Redone following {@link https://github.com/rayman813/smashing-custom-fields/blob/master/smashing-fields-approach-1/smashing-fields.php}
    */
    public function udtbp_admin_menu() {
      $page_title = __( 'UDTheme Branding Settings' );
      $menu_title = __( 'UDTheme Branding' );
      $capability = 'manage_options';
      $slug = $this->udtbp;
      $callback = array( $this, 'display_plugin_admin_page' );
      $icon = 'dashicons-admin-plugins';
      $position = 100;

      $this->plugin_screen_hook_suffix = add_options_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    } // end function udtbp_admin_menu()

    /**
     * SANITIZE SETTINGS
     * Validates saved options
     *
     * @since      3.0.0
     * @param      array     $new_input[]  Holds sanitized input values
     * @param      array     $input[]      Submitted plugin options. Loops through $new_input
     * @return     array                   Array of validated plugin options
    */
    public function settings_sanitize( $input ) {
      $new_input = array();
      if(isset($input)) :
        foreach ( $input as $key => $val ) {
          if( $key == 'post-type' ) { // dont sanitize array
            $new_input[ $key ] = $val;
          }
          else {
            $new_input[ $key ] = sanitize_text_field( $val );
          }
        }
      endif;
      return $new_input;
    } // end settings_sanitize()

    /**
     * AJAX SAVE SETTINGS
     *
     * @since      3.0.0
     * @version    1.1.0     Added WP json functions
    */
    public function udtbp_settings_save_ajax() {
      if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        check_ajax_referer('_wpnonce', '_wpnonce' );
        $data = $_POST;
        unset( $data['option_page'], $data['action'], $data['_wpnonce'], $data['_wp_http_referer'] );
        if ( update_option('main_options', $data ) ) {
          die(1);
          wp_send_json_success( ___( 'Your settings were saved.' ) );
        }
        else {
          die (0);
          wp_send_json_error( ___( 'Your settings were not saved.' ) );
        }
      }
      die();
    }

    /**
     * RENDER SETTINGS TABS
     *
     * Creates and displays tab based GUI on plugin options page.
     *
     * @since      3.0.0
     * @version    1.5.0     Replaced single quotes with double quotes to eliminate (.) concatenation operator
     *                       Added ARIA controls
     * @return     mixed     The settings field
    */
    public function udtbp_render_tabs() {
      $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'header';
    ?>

      <ul id="udt_panel_mainmenu" class="tablist tabsList" role="tablist">
        <?php
        foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
          $active = $current_tab == $tab_key ? 'nav-tab-active' : '';
          $aria_selected = $current_tab == $tab_key ? 'true' : 'false';
          $tab_index = $current_tab == $tab_key ? '0' : '-1';
          ?>
          <li class="ui-state-default <?php echo esc_html( $active ); ?>" role="presentation">
            <a class="aria_selected ui-tabs-anchor" role="tab" aria-selected="<?php echo esc_html( $aria_selected ); ?>" aria-controls="<?php echo esc_html($tab_key ); ?>" id="udt_<?php echo esc_html( $tab_key ); ?>_settings" tabindex="<?php echo esc_html($tab_index ); ?>" href="?page=<?php echo esc_html($this->udtbp );?>&tab=<?php echo esc_html($tab_key ); ?>"> <?php echo esc_html( $tab_caption ); ?></a>
          </li>
        <?php
        }
        ?>
      </ul>
    <?php
    } // end udtbp_render_tabs()

    /**
     * PLUGIN SETTINGS LINK
     *
     * Add Support AND Settings Link on plugin page
     * @since      3.0.0
     * @param      array   $actions[]    Merges settings/support links on plugin page
     * @return     mixed                 The settings field
     * @link   https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
    */
    public function add_settings_link( $actions, $plugin_file ) {
      $str = sprintf( __('Support', UDTBP_NAME) );
      static $plugin;
      $settings = array( 'settings' => '<a class="'.$this->udtbp.'-settings-link" href="options-general.php?page='.$this->udtbp.'">' . __( 'Settings' ) . '</a>' );
      $site_link = array( 'support' => '<a title="' .__( 'Having problems? Submit a trouble ticket.' ). '" target="_blank" href="https://services.udel.edu/TDClient/Home/">' . $str . '</a>' );
      $actions = array_merge( $settings, $actions );
      $actions = array_merge( $site_link, $actions );
      return $actions;
    } // end add_settings_link()
    /**
     * ADMIN SETTINGS CALLBACK FUNCTION
     *
     * Callback function for the admin settings page.
     *
     * @since      3.0.0
    */
    public function display_plugin_admin_page(){
      include_once ( UDTBP_DIR . '/admin/views/udtbp-admin-display.php' );
    } // end display_plugin_admin_page()
  } // end class udtbp_Admin
endif;
