<?php
/**
  * UNINSTALLER
  *
  * Fired when the plugin is uninstalled.
  *
  * @package     udtheme-brand
  * @author      Christopher Leonard
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2020 University of Delaware
  * @version     3.5.4
  */
}
/**
 * @todo         Add functionality to remove DB tables and all plugin related files.
 */
// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  die( "I'm afraid I can't do that Dave." );
}
delete_option( 'udt_custom_header_text', $custom_header_text );
