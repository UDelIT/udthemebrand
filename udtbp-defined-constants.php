<?php
/**
  * UDTheme Branding Constants
  *
  * The purpose of this class is to:
  * Define plugin constants for:
  * Admin and public specific directory paths
  * Plugin version
  * WordPress version
  * PHP version
  *
  * @package     udtheme-brand
  * @author      Christopher Leonard
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2019 University of Delaware
  * @version     3.5.3
*/
/**
  * Defines named constants that return the complete
  * directory location URL WITHOUT the trailing slash.
  *
  * Plugin Related CONSTANTS
  *
  * @since    3.0.0
  * @version  1.0.2                                  Updated versions
  * @var      string      UDTBP_NAME                 Defines plugin name.
  * @var      float       UDTBP_VERSION              Defines plugin version.
  * @var      float       UDTBP_REQ_PHP_VERSION      Defines required PHP version for plugin.
  * @var      float       UDTBP_REQ_WP_VERSION       Defines required WordPress version for this plugin.
  * @var      string      UDTBP_SLUG                 Defines plugin slug.
  * @var      string      UDTBP_FILE                 Defines plugin path to main file "udtheme-brand/udtbp.php".
  * @var      string      UDTBP_DIR                  Defines plugin filesystem path "/home/user/var/www/wordpress/wp-content/plugins/udtheme-brand/".
  * @var      string      UDTBP_URL                  Defines plugin URL path "example.com/wp-content/plugins/udtheme-brand".
*/
/**
  * Plugin CONSTANTS
  * @version  1.2.0    Removed Anjirai (deprecated) from $json_theme_list array
*/
const UDTBP_NAME             = 'UDTheme Branding';
const UDTBP_VERSION          = '3.5.3';
const UDTBP_REQ_PHP_VERSION  = '7.2';
const UDTBP_REQ_WP_VERSION   = '5.2.3';

/**
 * List of incompatible themes and latest tested version
 *
 * Theme...........Latest (date)..............CP
 * Aaron............3.5.....11/18.............3.0
 * Anjirai..........0.0.1...2/15 DEPRECATED...
 * Boardwalk........1.0.13..6/17..............1.0.4
 * Cubic............1.0.7...6/17..............1.0.4
 * Divi (fixed nav).3.17.6..11/18.............3.17.2
 * Matheson.........1.0.7...3/16..............1.0.3
 * Radiate..........1.2.9...9/18..............1.0.3
 * Star.............1.12....10/18 DEPRECATED..
 * Swell Lite.......1.6.5...8/18..............1.0.9
 * Temptation.......1.1.1...4/18 DEPRECATED...
 * Tracks...........1.66....11/18.............1.34
 * Twenty Twelve....2.5.....No OR CSS 5/18....1.3
 * Twenty Fourteen..2.2.....5/18..............1.2
 * Twenty Fifteen...2.0.....5/18..............1.9
 * Twenty Sixteen...1.5.....5/18..............1.4
 * Twenty Seventeen.1.7.....8/18..............1.4
 * @var array
 */
$json_theme_list = array(
  "Aaron",
  "Boardwalk",
  "Cubic",
  "Divi",
  "Matheson",
  "Radiate",
  "Swell Lite",
  "Tracks",
  "Twenty Fourteen",
  "Twenty Fifteen",
  "Twenty Sixteen",
  "Twenty Seventeen"
);

if ( !defined( 'JSON_THEME_LIST' ) )              define( 'JSON_THEME_LIST',     json_encode( $json_theme_list ) );


if ( !defined( 'UDTBP_SLUG' ) )             define( 'UDTBP_SLUG',    basename( ( __FILE__ ) ) );
if ( !defined( 'UDTBP_FILE' ) )             define( 'UDTBP_FILE',    plugin_basename( __FILE__ ) );
if ( !defined( 'UDTBP_DIR' ) )              define( 'UDTBP_DIR',     plugin_dir_path( __FILE__ ) );
if ( !defined( 'UDTBP_URL' ) )              define( 'UDTBP_URL',     plugin_dir_url( __FILE__ ) );

/**
  * ASSETS Related CONSTANTS
  *
  * @since  3.5.0
  * @var    string      UDTBP_ASSETS_URL            Defines plugin assets directory path "name.com/wp-content/plugins/udtheme-brand/assets".
  * @var    string      UDTBP_ASSETS_CSS_URL        Defines plugin assets CSS directory path "name.com/wp-content/plugins/udtheme-brand/assets/css".
  * @var    string      UDTBP_ASSETS_IMG_URL        Defines plugin assets IMG directory path "name.com/wp-content/plugins/udtheme-brand/assets/img".
  * @var    string      UDTBP_ASSETS_JS_URL        Defines plugin assets JS directory path "name.com/wp-content/plugins/udtheme-brand/assets/js".
  * @var    string      UDTBP_ASSETS_FONTS_URL         Defines plugin assets FONTS directory path "name.com/wp-content/plugins/udtheme-brand/assets/fonts".
  * @var    string      UDTBP_ASSETS_SUPPORT_URL         Defines plugin assets SUPPORT directory path "name.com/wp-content/plugins/udtheme-brand/assets/sup".
*/
if ( !defined( 'UDTBP_ASSETS_URL' ) )        define( 'UDTBP_ASSETS_URL',     UDTBP_URL . 'assets' );
if ( !defined( 'UDTBP_ASSETS_CSS_URL' ) )    define( 'UDTBP_ASSETS_CSS_URL', plugins_url( 'assets/css', __FILE__ ) );
if ( !defined( 'UDTBP_ASSETS_IMG_URL' ) )    define( 'UDTBP_ASSETS_IMG_URL', plugins_url( 'assets/img', __FILE__ ) );
if ( !defined( 'UDTBP_ASSETS_JS_URL' ) )    define( 'UDTBP_ASSETS_JS_URL', plugins_url( 'assets/js', __FILE__ ) );
if ( !defined( 'UDTBP_ASSETS_FONTS_URL' ) )     define( 'UDTBP_ASSETS_FONTS_URL', plugins_url( 'assets/fonts', __FILE__ ) );
if ( !defined( 'UDTBP_ASSETS_SUPPORT_URL' ) )     define( 'UDTBP_ASSETS_SUPPORT_URL', plugins_url( 'assets/sup', __FILE__ ) );

/**
  * ADMIN Related CONSTANTS
  *
  * @since  3.0.0
  * @var    string      UDTBP_ADMIN_URL            Defines plugin admin directory path "name.com/wp-content/plugins/udtheme-brand/admin".
  * @var    string      UDTBP_ADMIN_CSS_URL        Defines plugin admin CSS directory path "name.com/wp-content/plugins/udtheme-brand/admin/css".
  * @var    string      UDTBP_ADMIN_IMG_URL        Defines plugin admin IMG directory path "name.com/wp-content/plugins/udtheme-brand/admin/img".
  * @var    string      UDTBP_ADMIN_JS_URL         Defines plugin admin JS directory path "name.com/wp-content/plugins/udtheme-brand/admin/js".
  * @var    string      UDTBP_ADMIN_VIEWS_URL      Defines plugin admin VIEWS directory path "name.com/wp-content/plugins/udtheme-brand/admin/views".
*/
if ( !defined( 'UDTBP_ADMIN_URL' ) )        define( 'UDTBP_ADMIN_URL',     UDTBP_URL . 'admin' );
if ( !defined( 'UDTBP_ADMIN_CSS_URL' ) )    define( 'UDTBP_ADMIN_CSS_URL', plugins_url( 'admin/css', __FILE__ ) );
if ( !defined( 'UDTBP_ADMIN_IMG_URL' ) )    define( 'UDTBP_ADMIN_IMG_URL', plugins_url( 'admin/img', __FILE__ ) );
if ( !defined( 'UDTBP_ADMIN_JS_URL' ) )     define( 'UDTBP_ADMIN_JS_URL', plugins_url( 'admin/js', __FILE__ ) );
if ( !defined( 'UDTBP_ADMIN_VIEWS_URL' ) )  define( 'UDTBP_ADMIN_VIEWS_URL', plugins_url( 'admin/views', __FILE__ ) );
/**
  * PUBLIC Related CONSTANTS
  *
  * @since  3.0.0
  * @var    string      UDTBP_PUBLIC_URL            Defines plugin public directory path "name.com/wp-content/plugins/udtheme-brand/public".
  * @var    string      UDTBP_PUBLIC_CSS_URL        Defines plugin public CSS directory path "name.com/wp-content/plugins/udtheme-brand/public/css".
  * @var    string      UDTBP_PUBLIC_IMG_URL        Defines plugin public IMG directory path "name.com/wp-content/plugins/udtheme-brand/public/img".
  * @var    string      UDTBP_PUBLIC_JS_URL         Defines plugin public JS directory path "name.com/wp-content/plugins/udtheme-brand/public/js".
  * @var    string      UDTBP_PUBLIC_VIEWS_URL      Defines plugin public VIEWS directory path "name.com/wp-content/plugins/udtheme-brand/public/views".

*/
if ( !defined( 'UDTBP_PUBLIC_URL' ) )       define( 'UDTBP_PUBLIC_URL',     UDTBP_URL . 'public' );
if ( !defined( 'UDTBP_PUBLIC_CSS_URL' ) )   define( 'UDTBP_PUBLIC_CSS_URL', plugins_url( 'public/css', __FILE__ ) );
if ( !defined( 'UDTBP_PUBLIC_IMG_URL' ) )   define( 'UDTBP_PUBLIC_IMG_URL', plugins_url( 'public/img', __FILE__ ) );
if ( !defined( 'UDTBP_PUBLIC_JS_URL' ) )    define( 'UDTBP_PUBLIC_JS_URL', plugins_url( 'public/js', __FILE__ ) );
if ( !defined( 'UDTBP_PUBLIC_VIEWS_URL' ) ) define( 'UDTBP_PUBLIC_VIEWS_URL', plugins_url( 'public/views', __FILE__ ) );
/**
  * OTHER Related CONSTANTS
  *
  * @since  3.0.0
  * @var    string      UDTBP_INCLUDE_URL            Defines plugin INCLUDE directory path "name.com/wp-content/plugins/udtheme-brand/include".
*/
if ( !defined( 'UDTBP_INCLUDE_URL' ) )      define( 'UDTBP_INCLUDE_URL',     UDTBP_URL . 'include' );
