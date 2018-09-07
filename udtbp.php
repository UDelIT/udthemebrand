<?php
/**
  * Plugin Name:       UDTheme Branding
  * Plugin URI:        https://bitbucket.org/itcssdev/udtheme-brand
  * Description:       The UDTheme Branding plugin allows a University department
  *                    or college to display the official University of Delaware
  *                    branded header and footer on a WordPress website.
  * Version:           3.1.0
  * Author:            Christopher Leonard - University of Delaware
  * Author URI:        https://sites.udel.edu/cleonard
  * License:           GPLv3
  * Text Domain:       udtheme-brand
  * Domain Path:       /languages
*/

/**
  * Function to begin execution of plugin
  * Loads core class files
  * The purpose of this file is to:
  * Loads required files to run plugin
  *
  * @package     udtheme-brand
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.1.0
*/

/**
 * Prevent direct access to this page.
 */
if ( ! defined( 'WPINC' ) ) {
  die( 'No soup for you!' );
}

/**
 * REGISTER ACTIVATION HOOK
 * The code that runs during plugin activation.
 * @todo implement this as a check for legacy plugin, options, etc. and remove them.
 */
function activate_udtbp() {
  //require_once plugin_dir_path( __FILE__ ) . 'include/class-udtbp-activation.php';
  //require_once plugin_dir_path( __FILE__ ) . 'error-scrape.php';

}
//
//require_once plugin_dir_path( __FILE__ ) . 'include/class-udtbp-activation.php';
/**
 * REGISTER DEACTIVATION HOOK
 * The code that runs during plugin deactivation.
 * @todo implement this as a check for legacy plugin, options, etc. and remove them.
 */
// function deactivate_udtbp() {
//   require_once plugin_dir_path( __FILE__ ) . 'include/class-udtbp-deactivation.php';
//   udtbp_Deactivation::udtbp_deactivation_hook();
// }

// register_activation_hook( __FILE__, 'activate_udtbp' );
// register_deactivation_hook( __FILE__, array( 'udtbp', 'deactivate_udtbp' ) );



/**
 * CLASS AUTOLOADER
 * The function responsible for auto loading classes.
 */
require plugin_dir_path( __FILE__ ) . 'udtbp-autoloader.php';
/**
 * CLASS UDTBP
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'include/class-udtbp.php';
/**
 * DEFINED CONSTANTS
 * The class responsible for defining constants.
 */
require plugin_dir_path(  __FILE__ ) . 'udtbp-defined-constants.php';
/**
 * RUN PLUGIN
 *
 * Begins execution of the plugin.
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.0
 */
if ( ! function_exists( 'run_udtbp' ) ) :
  function run_udtbp() {
    $plugin = new udtbp();
    $plugin->run();
  }
  run_udtbp();
else : echo "FFF";
  new udtbp_Activation();
  udtbp_Activation::udtbp_deactivation_hook();
endif;
