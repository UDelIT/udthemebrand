<?php
require_once plugin_dir_path( __FILE__ ) . 'error-scrape.php';
/**
  * Class: UDTheme Branding Activation
  *
  * The purpose of this class is to:
  * Register activation hook
  * Fire activation hook
  *
  * This class defines all code necessary to run during the plugin's activation.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/include
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.5.0
 */
if ( ! class_exists( 'udtbp_Activation' ) ) :
  class udtbp_Activation {
    private $udtbp;
    private $current_version;
    private $legacy_args;

    /**
      * Initialize the class and set its properties.
      *
      * @since     3.0.0
      */
     public function __construct( $udtbp, $current_version, Array $legacy_args=array() ) {
      $this->udtbp = $udtbp;      $this->legacy_args =  $legacy_args;
      $this->udtbp_start_activation();
      $this->udtbp_requirements_check();
    }

  	/**
     * Register Activation Hook
     *
     * Register hooks that are fired when the plugin is activated.
     * When the plugin is deleted, the uninstall.php file is loaded.
     *
     * @since 3.0.0
    */
   /**
    * http://wordpress.stackexchange.com/questions/27850/deactivate-plugin-upon-deactivation-of-another-plugin
    * Deactivate plugin upon deactivation of another plugin
    */

   // register_activation_hook(__FILE__,'udtbp_start_activation');

    public function udtbp_start_activation()


    $this->udtbp_requirements_check(); //php and wp version check method
    $this->udtbp_activation_hook(); //    set transient on activation method
  }

    /**
     * PLUGIN REQUIREMENTS CHECK
     *
     * Before plugin is installed it checks to make sure the minimum required versions of WordPress and PHP are in place, otherwise abort install
     *
     * @since 3.0.0
    */
    public function udtbp_requirements_check() {
      global $wp_version;
      if ( version_compare( PHP_VERSION, UDTBP_REQ_PHP_VERSION, '<' ) ) {
      ?>
      <ul class="ul-disc">
        <li>
          <strong>PHP <?php echo UDTBP_REQ_PHP_VERSION; ?> version is the minimum requirement to install plugin.</strong>
          <em>( You're running version <?php echo PHP_VERSION; ?> )</em>
        </li>
      </ul>
    <?php
        return false;
      }

      if ( version_compare( $wp_version, UDTBP_REQ_WP_VERSION, '<' ) ) {
        ?>
      <ul class="ul-disc">
        <li>
          <strong>WordPress <?php echo UDTBP_REQUIRED_WP_VERSION; ?> version is the minimum requirement to install plugin.</strong>
          <em>( You're running version <?php echo $wp_version; ?> )</em>
        </li>
      </ul>
    <?php
        return false;
      }
      return true;
    } // end udtbp_requirements_check()

    /**
     * LEGACY VERSION ACTIVE CHECK
     *
     * Before plugin is installed it checks to make sure the legacy branding plugin is not active.
     * Sets and removes associated transients.
     *
     * @since 3.0.0
     * @return bool
     * @todo  Confirm if this is still needed. 8/21/18 CL
    */
    public function udtbp_deactivation_hook() {
      // https://stackoverflow.com/questions/38595044/wordpress-check-if-plugin-is-installed
      // // https://wordpress.stackexchange.com/questions/115437/installing-plugins-on-installation-activation/115447#115447
      $legacy_versions = array(
        "udbrand" => array(
          "name" => "UDBrand",
          "url"   => "/ud-branding/ud-branding.php"
        ),

        "udtheme" => array(
          "name" => "UDTheme Branding Plugin",
          "url"   => "/udtheme/udtheme.php"
        )
      ); // end $legacy_versions

      // https://stackoverflow.com/questions/38595044/wordpress-check-if-plugin-is-installed
      if( in_array( $legacy_versions, apply_filters( 'active_plugins', get_option('active_plugins' ) ) ) ){
        deactivate_plugins( array( $legacy_versions ) );
        add_action( 'update_option_active_plugins', 'udtbp_start_activation' );
      }

    //   function udtbp_deactivate_udtheme(){
    //   $dependent = plugins_url( '/udtheme/udtheme.php' );
    //   if( ! is_plugin_active($dependent) ) :
    //    add_action('update_option_active_plugins', 'ud_deactivate_udbrand');
    //   endif;
    // }

    // function udtbp_deactivate_udbrand(){
    //   $dependent_udbrand = plugins_url( '/ud-branding/ud-branding.php' );
    //   deactivate_plugins($dependent_udbrand);
    // }
      $set_transient = set_transient( 'udtbp_activation_transient', true, 5 );
    } // end function udtbp_deactivation_hook

    /**
     * INITIAL PLUGIN (DEPRECATED)
   * Never used {@link public function udtbp_initialize()} {@link bkup/deprecated_functions}
     *
     * @since       3.0.0
     * @deprecated  deprecated   3.5.0
    */





  /**
   * DISPLY PLUGIN UPDATED ADMIN NOTICE (DEPRECATED)
   *
   * Never used {@link public function udtbp_admin_notice_activate()} {@link bkup/deprecated_functions}
     *
     * @since       3.0.0
     * @deprecated  deprecated   3.5.0
   */
  } // end class udtbp_Activation
endif;
