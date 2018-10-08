<?php
/**
  * Class: UDTheme
  *
  * Defines the core plugin class
  * Includes attributes and functions used in the admin and public areas
  *
  * The purpose of this class is to:
  * Define internationalization
  * Load plugin dependencies
  * Define admin-specific hooks
  * Define public-specific hooks
  * Maintain the unique identifier and current version of the plugin.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/include
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.5.0
  *
*/
if ( ! class_exists( 'udtbp' ) ) :
	class udtbp {
		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    3.0.0
		 * @access   protected
		 * @var      string    $loader    Maintains and registers all hooks for the plugin.
		 */
		protected $loader;
		/**
		 * The ID of this plugin.
		 *
		 * @since    1.4.2
		 * @access   protected
		 * @var      string         $udtbp           The ID of this plugin.
		*/
		 protected $udtbp;
		 /**
		 * The current version.
		 *
		 * @since    NA
		 * @access   protected
		 * @var      string    			$current_version    The current version used in Activation class.
		 */
		protected $current_version;
		/**
		 * The current theme.
		 *
		 * @since    3.0.0
		 * @access   protected
		 * @var      string    			$current_theme    The current theme.
		 */
		protected $current_theme;
		/**
		 * The current screen.
		 *
		 * @since    3.0.0
		 * @access   protected
		 * @var      string    			$current_screen    The current screen.
		 */
		protected $current_screen;
		/**
		 * The current selected color of Footer.
		 *
		 * @since    3.0.0
		 * @access   protected
		 * @var      string    				$color_footer    The chosen footer color.
		 */
		protected $color_footer;
		/**
		 * Define the core functionality of the plugin.
		 *
		 * Set the plugin name and the plugin version that can be used throughout the plugin.
		 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
		 * the public-facing side of the site.
		 *
		 * @since    3.0.0
		 */
		public function __construct() {
			$this->udtbp = 'udtbp';
			$this->current_theme = wp_get_theme();
			$this->udtbp_load_dependencies();
			$this->udtbp_define_admin_hooks();
			$this->udtbp_define_public_hooks();
		}
		/**
		 * DEPENDENCY LOAD
		 *
		 * Load the required dependencies for this plugin.
		 * Include the following files that make up the plugin:
		 * - udtbp_Loader 						Orchestrates the hooks of the plugin.
		 * - udtbp_i18n 							Defines internationalization functionality.
		 * - udtbp_Admin 							Defines all hooks for the dashboard.
		 * - udtbp_Admin_Notices 		  Defines all hooks for dashboard notices.
		 * - udtbp_Header_Settings 		Defines all header sections, settings and options.
		 * - udtbp_Footer_Settings 		Defines all footer sections, settings and options.
		 * - udtbp_Public 						Defines all hooks for the public side of the site.
		 *
		 * Create an instance of the loader which will be used to register the hooks
		 * with WordPress.
		 *
		 * @since    3.0.0
		 * @version  1.5.0   added udtbp_Support_Settings
		 * @access   private
		 * @see 		 udtbp-autoloader.php
		 */
		private function udtbp_load_dependencies() {
			$this->loader = new udtbp_Loader();
		}
		/**
		 * REGISTER ADMIN RELATED HOOKS.
		 *
		 * @since    	2.0.0
		 * @version   1.5.0      Added: [$settings_init_support]. Removed: [Admin Pointer Class]
		 * @access   	private
		 * @var				string     $plugin_admin								Variable that creates udtbp_Admin class instance.
		 * @var				string     $plugin_admin_notices				Variable that creates udtbp_Admin_Notices class instance.
		 * @var				string     $settings_init_header				Variable that creates udtbp_Header_Settings class instance.
		 * @var				string     $settings_init_footer				Variable that creates udtbp_Footer_Settings class instance.
		 * @var				string     $plugin_basename							Variable that defines plugin basename e.g., udtheme-brand/udtbp.php.
		 */
		private function udtbp_define_admin_hooks() {
			//$plugin_activation = new udtbp_Activation( $this->get_udtbp(), UDTBP_VERSION );

			$plugin_admin = new udtbp_Admin( $this->get_udtbp(), UDTBP_VERSION, $this->wp_get_theme() );
			$plugin_admin_notices = new udtbp_Admin_Notices( $this->get_udtbp(), $this->wp_get_theme() );
			$settings_init_header = new udtbp_Header_Settings( $this->get_udtbp(), UDTBP_VERSION );
			$settings_init_footer = new udtbp_Footer_Settings( $this->get_udtbp() );
			$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->udtbp . '.php' );

			$this->loader->add_action( 'load-'.$this->udtbp, $plugin_admin, 'udtbp_on_load_page' );

			//$this->loader->add_action( 'admin_init', $plugin_activation, 'udtbp_start_activation' );

			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles', 10 );
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'udtbp_enqueue_inline_admin_styles', 999 );
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
			$this->loader->add_action( 'admin_notices', $plugin_admin_notices, 'udtbp_theme_override_notices', 999 );
			$this->loader->add_action( 'admin_menu', $plugin_admin, 'udtbp_admin_menu' );
			$this->loader->add_action( 'admin_init', $settings_init_header, 'settings_api_init' );
			$this->loader->add_action( 'admin_init', $settings_init_footer, 'settings_api_init' );
			// $this->loader->add_action( 'plugins_loaded', $plugin_admin, 'udtbp_check_current_user' );
			$this->loader->add_action( 'wp_ajax_udtbp_save_ajax', $plugin_admin, 'udtbp_save_ajax' );
			$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_settings_link', 10, 2 );
		} // end udtbp_define_admin_hooks()
		/**
		* ADD PLUGIN SCRIPTS AND STYLES TO PLUGIN OPTIONS PAGE ONLY
		*
		* @since    3.0.0
		* @access   private
		* @example 	http://pressing-matters.io/the-definitive-guide-to-adding-javascript-css-to-wordpress/
		*/
		private function udtbp_on_load_page() {
		  $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, array( $this->udtbp, 'udtbp_define_admin_hooks' ) );
		} // end udtbp_on_load_page()
		/**
		 * REGISTER PUBLIC RELATED HOOKS.
		 *
		 * @since    3.0.0
		 * @version  1.1.0			Added Customize Register hook for removing site icon functionality
		 * @access   private
		 * @var			 string     $plugin_public							Variable that creates udtbp_Public class instance.
		 */
		private function udtbp_define_public_hooks() {
			$plugin_public = new udtbp_Public( $this->get_udtbp(), UDTBP_VERSION, $this->wp_get_theme() );

			$this->loader->add_filter( 'wp_head', $plugin_public, 'udt_add_favicon' );
			$this->loader->add_action( 'customize_register', $plugin_public, 'udt_remove_styles_sections', 20 );
			$this->loader->add_action( 'wp_footer', $plugin_public, 'front_end_footer' );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 999 );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'udtbp_enqueue_inline_public_styles', 998 );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'udtbp_enqueue_inline_theme_styles', 99999999 );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 999 );
			$this->loader->add_action( 'init', $plugin_public, 'udtbp_show_admin_bar' );
			$this->loader->add_filter( 'template_include', $plugin_public, 'custom_include', 1 );
			$this->loader->add_filter( 'shutdown', $plugin_public, 'body_inject', 0 );
		}
		/**
		 * EXECUTE HOOKS
		 * Run the loader to execute all of the hooks with WordPress.
		 *
		 * @since    3.0.0
		 */
		public function run() {
			$this->loader->run();
		}
		/**
		 * GET PLUGIN NAME
		 * The name of the plugin used to uniquely identify it within the context of
		 * WordPress and to define internationalization functionality.
		 *
		 * @since    	3.0.0
		 * @return    string    The name of the plugin.
		 */
		public function get_udtbp() {
			return $this->udtbp;
		}
		/**
		 * GET HOOKS
		 * The reference to the class that orchestrates the hooks with the plugin.
		 *
		 * @since    	3.0.0
		 * @return    udtbp_Loader    Orchestrates the hooks of the plugin.
		 */
		public function get_loader() {
			return $this->loader;
		}
		/**
		 * GET PLUGIN VERSION
		 * Retrieve the version number of the plugin.
		 *
		 * @since    	3.0.0
		 * @return    string    The version number of the plugin.
		 */
		public function get_version() {
			return UDTBP_VERSION;
		}
		/**
		 * GET CURRENT THEME
		 * Retrieve the current theme.
		 *
		 * @since    	3.0.0
		 * @return    string    The current theme.
		 */
		public function wp_get_theme() {
			return $this->current_theme;
		}
	} // end class udtbp
endif;
