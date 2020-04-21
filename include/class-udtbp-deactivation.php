<?php
/**
	* Class: UDTheme Branding Deactivation (NOT IN USE)
	*
	* The purpose of this class is to:
	* Register deactivation hook
	* Fire deactivation hook
	*
	* This class defines all code necessary to run during the plugin's deactivation.
	*
	* @package     udtheme-brand
	* @subpackage  udtheme-brand/include
	* @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2020 University of Delaware
  * @version     3.5.4
 */
require_once plugin_dir_path( __FILE__ ) . 'interface-udtbp-current-user-check.php';
if ( ! class_exists( 'udtbp_Dectivation' ) ) :
  class udtbp_Dectivation implements udtbp_Current_User_Check {
    function udtbp_check_current_user($current_user) {
      if ( ! current_user_can( 'activate_plugins' ) )
      return;
    }
  /**
   * PLUGIN DEACTIVATION
   *
   * Hook fires when plugin is deactivated.
   *
   * @since    3.0.0
   */
 	public static function udtbp_deactivation_hook() {
 		echo "HELLO";
	}
} // end class udtbp_Dectivation
endif;
