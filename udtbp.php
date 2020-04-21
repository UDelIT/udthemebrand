<?php
/**
  * Plugin Name:       UDTheme Branding
  * Plugin URI:        https://bitbucket.org/itcssdev/udtheme-brand
  * Description:       A WCAG compliant plugin that allows a University department
  *                    or college to display the official University of Delaware
  *                    branded header and footer on a WordPress website.
  * Version:           3.5.4
  * Author:            Christopher Leonard - University of Delaware
  * Author URI:        https://sites.udel.edu/cleonard
  * License:           GPLv3
  * License URI:       https://bitbucket.org/itcssdev/udtheme-brand/src/master/LICENSE.md
  * Text Domain:       udtheme-brand
  * Domain Path:       /languages
*/
/**
  Copyright (c) 2012-2020 University of Delaware
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

  Please see LICENSE.md for the full license.
*/
/**
  * Function to begin execution of plugin
  * Loads core class files
  * The purpose of this file is to:
  * Loads required files to run plugin
  *
  * @package     udtheme-brand
  * @author      Christopher Leonard
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2020 University of Delaware
  * @version     3.5.4
*/
/**
 * Prevent direct access to this page.
 */
if ( ! defined( 'WPINC' ) ) {
  die( 'No soup for you!' );
}

/**
 * CLASS AUTOLOADER
 *
 * The function responsible for auto loading classes.
 */
require plugin_dir_path( __FILE__ ) . 'udtbp-autoloader.php';

/**
 * CLASS UDTBP
 *
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'include/class-udtbp.php';

/**
 * DEFINED CONSTANTS
 *
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
endif;
