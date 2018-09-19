<?php
/**
  * Class: UDTheme Branding Public
  *
  * The purpose of this class is to:
  * Enqueue public specific styles and scripts
  * Display public html
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/public
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.5.0
*/
if ( ! class_exists( 'udtbp_Public' ) ) :
  class udtbp_Public extends udtbp_Admin {
    private $udtbp;
    private $current_theme;

    /**
    * Public image URL Constant
    *
    * @since        3.0.0
    * @deprecated   deprecated since version 3.5.0
    * @var          string    $const_public_image    Used in place of defined CONST limitation in heredoc
    */

   /**
    * Public views URL Constant
    *
    * @since        3.0.4
    * @deprecated   deprecated since version 3.5.0
    * @var          string    $const_public_views    Used in place of defined CONST limitation in heredoc
    */

    /**
    * Current Theme and Current Theme CSS Override Arrays
    *
    * @since        3.0.0
    * @deprecated   deprecated since version 3.5.0
    * @var          array    $issues_theme_name    Replaced by JSON_THEME_LIST
    */

    /**
    * Incompatible themes list array.
    *
    * @since        3.0.1
    * @deprecated   deprecated since version 3.5.0
    * @var          array    $json_theme_list    Replaced by JSON_THEME_LIST
    */

    /**
    * The current footer color.
    *
    * @since    3.0.0
    * @access   public
    * @var      string    $color_footer          The option value for the footer color.
    *                                            Derived from Footer Settings Text and Image Color
    */
    public $color_footer;
    /**
     * CSS Style for position used in theme override styles.
     *
     * @since    3.0.1
     * @access   public
     * @var    string      $strcss_pos_rel        Defines position:relative !important for theme override CSS
     */
    public $strcss_pos_rel;
    /**
     * CSS Style for top location used in theme override styles.
     *
     * @since    3.0.0
     * @access   public
     * @var    string      $strcss_top_0          Defines top:0 !important for theme override CSS
     */
    public $strcss_top_0;
    /**
     * CLASS INITIALIZATION
     * Initiates the class and set its properties.
     *
     * @since    3.0.0
     */
    public function __construct( $udtbp, $current_theme ) {
      $this->udtbp = $udtbp;
      $this->current_theme = wp_get_theme();
      $this->udtbp_public_views_url = UDTBP_PUBLIC_VIEWS_URL;
      $this->udtbp_public_img_url = UDTBP_PUBLIC_IMG_URL;
      $this->udtbp_public_js_url = UDTBP_PUBLIC_JS_URL;
      $this->json_theme_list = JSON_THEME_LIST;
    }


    /**
     * SITE ICON REMOVE CONTROL
     *
     * Removes the ability to edit the site icon by users. Instead default OCM
     * approved site icons are dynamically added when plugin is activated.
     *
     * @since       3.5.0
     * @link        https://stackoverflow.com/questions/37953058/how-do-i-remove-the-ability-to-change-the-site-icon-in-wordpress
    */
    function udt_remove_styles_sections( $wp_customize ) {
      $wp_customize->remove_control( 'site_icon' );
    }

    /**
     * ADD SITE ICON
     *
     * Checks to see if user has added a site icon through the theme customizer
     * and if FALSE, loads the default UD branded icon.
     *
     * @since     3.0.0
     * @version   1.1.0       Add default favicon to $meta_tags array. Disabled conditional since removing functionality in theme Customizer.
     * {@link   https://developer.wordpress.org/reference/functions/wp_site_icon/}
    */

    public function udt_add_favicon() {
      // if ( ! has_site_icon() && ! is_customize_preview() ) {
      //   return;
      // }

      $meta_tags = [
        sprintf(
          '<link rel="icon" href="%s" sizes="32x32">',
          esc_url(
            get_site_icon_url( 32, UDTBP_PUBLIC_IMG_URL.'/touch/favicon.ico' )
          )
        ),
        sprintf(
          '<link rel="apple-touch-icon" href="%s" sizes="180x180">',
          esc_url(
            get_site_icon_url( 180, UDTBP_PUBLIC_IMG_URL.'/touch/apple-touch-icon-180x180.png' )
          )
        ),
        sprintf(
          '<link rel="icon" type="image/png" href="%s" sizes="192x192">',
          esc_url(
            get_site_icon_url( 192, UDTBP_PUBLIC_IMG_URL.'/touch/android-chrome-192x192.png' )
          )
        ),
        sprintf(
          '<link rel="mask-icon" color="#00539F" href="%s">',
          esc_url(
            get_site_icon_url( 256, UDTBP_PUBLIC_IMG_URL.'/touch/ud-img-logo--pinned.svg' )
          )
        ),
        sprintf(
          '<link rel="icon" type="image/png" href="%s" sizes="512x512">',
          esc_url(
            get_site_icon_url( 512, UDTBP_PUBLIC_IMG_URL.'/touch/android-chrome-512x512.png' )
          )
        ),
        sprintf(
          '<meta name="msapplication-TileImage" content="%s">',
          esc_url(
            get_site_icon_url( 270, UDTBP_PUBLIC_IMG_URL.'/touch/mediumtile.png' )
          )
        ),
      ];


      /**
      * SITE ICON FILTER
      * Filters the site icon meta tags, so Plugins can add their own.
      *
      * @since    3.0.0
      * @version  1.0.1  added stripslashes() to clean up data
      * @param    array   $meta_tags    Site Icon meta elements.
      */
      $meta_tags = apply_filters( 'site_icon_meta_tags', $meta_tags );
      $meta_tags = array_filter( $meta_tags );

      foreach ( $meta_tags as $meta_tag ) {
        echo stripslashes( $meta_tag )."\n";
      }
    } // end udt_add_favicon()

    /**
     * ENQUEUE PUBLIC JAVASCRIPT
     * This function is used to:
     * Register and enqueue public-specific javascript
     * Adds public specific javascript files.
     *
     * @since       3.0.0
     * @version     1.5.0   added localize script functionality to use variables in public js.
     * @return      mixed   null/string   Return early if no settings page is registered.
    */
    public function enqueue_scripts() {
      wp_deregister_script( $this->udtbp . '-public-script' );
      wp_register_script( $this->udtbp . '-public-script', UDTBP_PUBLIC_JS_URL . '/udtbp-public.js', array( 'jquery' ), UDTBP_VERSION, TRUE );
      wp_enqueue_script( $this->udtbp . '-public-script' );

      $args_localize_script = [
        'ascss' => UDTBP_ASSETS_CSS_URL,
        'asjs' => UDTBP_ASSETS_JS_URL,
        'adcss' => UDTBP_ADMIN_CSS_URL,
        'adjs' => UDTBP_ADMIN_JS_URL,
        'pucss' => UDTBP_PUBLIC_CSS_URL,
        'pujs' => UDTBP_PUBLIC_JS_URL
      ];
      wp_localize_script( $this->udtbp . '-public-script', 'udtheme_public_js_vars', $args_localize_script );
    } // end enqueue_scripts()
    /**
     * ENQUEUE PUBLIC CSS
     * This function is used to:
     * Register and enqueue public-specific stylesheets
     * Adds public specific stylesheets files.
     * Call styles only if plugin is enabled
     *
     * @since     3.0.0
     * @version   1.2     Append date to file name
     * @return    mixed   null/string    Return early if no settings page is registered.
    */
    public function enqueue_styles() {
      $kill_cache = date( 'mdY' );
      $options = ( get_option( 'udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE );
      $footer_options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );

      if ( isset( $options ) && !empty( $options ) ) {
       wp_deregister_style( $this->udtbp .'-public-styles' );
       wp_register_style( $this->udtbp .'-public-styles', UDTBP_PUBLIC_CSS_URL.'/minify.css.php', array(), $kill_cache, 'all' );
       wp_enqueue_style( $this->udtbp .'-public-styles' );
     }
    } // end enqueue_styles()
    /**
    * ADD PUBLIC INLINE CSS
    * Adds social icons color to CSS for display in page footer.
    * Applies CSS Overrides for public facing admin bar.
    *
    * @since     3.0.0
    * @version   2.0.0            Added switch case, removed admin bar CSS
    * @return    mixed   null/string    Return early if no settings page is registered.
    */
    public function udtbp_enqueue_inline_public_styles() {
      $text_hex_blue = '009EE1';
      $text_hex_white = 'FFF';

      $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
      if ( isset( $options ) && !empty( $options ) ) :
        $option = $options['color-footer'];
        $custom_social_css = '';
        switch ($option) {
          case "white":
            $option = $text_hex_white;
          break;
          case "blue":
            $option = $text_hex_blue;
          break;
          default:
            // added for brevity
        }
        ?>
        <style id="<?php echo esc_html( $this->udtbp.'-theme-social-css' ) ?>">
        <?php
        $custom_social_css .= ".ud-footer--social .icon {color: #".( $option )." !important;}"."\n";

        // if ( is_admin_bar_showing() ) :
        //   $custom_social_css .=
        //   "@media screen and (max-width:600px) {#wpadminbar {position: fixed !important;}}"."\n";
        //   "@media only screen and (max-width:48em) {#wpadminbar {position:fixed !important;}}"."\n";
        // endif;
        echo stripslashes( $custom_social_css );
        ?>
      </style>
      <?php
      else : $option = NULL;
      endif;
    } // end udtbp_enqueue_inline_public_styles
    /**
     * ENQUEUE PUBLIC INLINE CSS STYLES
     *
     * Check active theme and add CSS overrides to avoid plugin style conflicts.
     *
     * @since     3.0.0
     * @version   1.0.1   Removed Highland theme case statement because theme is deprecated.
     * @return    null    Return early if no settings page is registered.
     * @link   https://github.com/DevinVinson/no-sidebar-twentyfifteen/tree/master/nosidebar-twentyfifteen
     */
    public function udtbp_enqueue_inline_theme_styles() {
      $strcss_pos_rel = "position:relative !important;";
      $strcss_top_0 = "top:0px !important;";
      if (in_array($this->current_theme, json_decode($this->json_theme_list) )) :
        ?>
        <style id="udtbp-theme-override-css">
        <?php
        switch ( $this->current_theme ) {
          case 'Aaron' :
            echo '#site-navigation, .main-navigation{'. $strcss_pos_rel.' }';
          break;

          case 'Anjirai' :
            echo 'admin-bar.masthead-fixed .site-header {'. $strcss_top_0 . '}, .masthead-fixed .site-header {'. $strcss_pos_rel . ' ' . $strcss_top_0 . '}';
          break;

          case 'Boardwalk' :
            echo '.site-footer,.blog .site-footer,.site-header,.admin-bar .site-header{'. $strcss_pos_rel . ' ' . $strcss_top_0 . '}';
          break;

          case 'Cubic' :
            echo 'body.unfixed-header > .site-header{'. $strcss_pos_rel . '}
            body.unfixed-header > .sidebar {'. $strcss_pos_rel . '}
            .site-footer,.blog .site-footer,.site-header,.admin-bar .site-header{'. $strcss_pos_rel . ' ' . $strcss_top_0 . '}';
          break;

          case 'Divi' :
            echo '.ud-footer--logo a{cursor:pointer;}
            #top-header{z-index:4999 !important}
            body.admin-bar.et_fixed_nav #main-header,body.admin-bar.et_fixed_nav #top-header{' . $strcss_top_0 . '}
            .et_fixed_nav #main-header,.et_fixed_nav #top-header{'. $strcss_pos_rel . '}
            .et_fixed_nav.et_show_nav.et_secondary_nav_enabled.et_header_style_centered #page-container{margin-top:0 !important;
              padding-top:0 !important;}

            // #udtbp_footer{display: -webkit-flex;display: flex;-webkit-flex-wrap: wrap;flex-wrap: wrap;list-style: none;margin: 0;padding: 0;}
            // .ud_grid.ud_grid--gutters.ud_grid--full.large-ud_grid--fit{width:100%}';
          break;

          case 'Matheson' :
            echo '#footer{z-index:1 !important}.ud-norm--footer{z-index:11}.image-anchor {display: inline;}';
          break;

          case 'Radiate' :
            echo '#page {z-index:1 !important}body.admin-bar .header-wrap {' . $strcss_top_0 . '}.header-wrap {'. $strcss_pos_rel . ' ' . $strcss_top_0 . 'width: 100%;z-index: 9998 !important;}#parallax-bg {margin-top:182px;}';
          break;

          case 'Star' :
            echo '#site-navigation,.main-navigation {'. $strcss_pos_rel . ' ' . $strcss_top_0 . '}.ud-footer--social li a[href]::before {content: "" !important;}.ud-footer--social li a::before{display:none !important;margin:0 !important;line-height:inherit !important';
          break;

          case 'Swell Lite' :
            echo 'ul li {list-style: none !important;padding:inherit !important}.admin-bar #navigation.fixed-nav{margin-top: 0 !important}
            #navigation.fixed-nav {'. $strcss_pos_rel . '}';
          break;

          case 'Temptation' :
            echo '#parallax-bg{display:none !important;visibility:hidden !important}';
          break;

          case 'Tracks' :
            echo '#udtbp_footer{z-index:-1;background:#FFF}';
          break;

          case 'Twenty Twelve' :
            echo '#udtbp_footer {line-height: inherit !important;margin: 0 !important;max-width: 100% !important;padding: 1.125em 0 0 !important;font-size:10px !important;border-top: none !important;background:#FFF !important}

            #yellowbar {margin: 8px 0 0 !important}';
          break;

          case 'Twenty Fourteen' :
            echo '.masthead-fixed .site-header {'. $strcss_pos_rel . ' ' . $strcss_top_0 . '}';
          break;

          case 'Twenty Fifteen' :
            echo 'body::before{display: none !important;visibility:hidden !important}
            #page {overflow-y:hidden;}
            #sidebar{'. $strcss_pos_rel . 'z-index:1 !important}

            #udtbp_footer {'. $strcss_pos_rel . ' z-index:99 !important}

            @media only screen and ( min-width: 46.25em ){
              body::before{display: none !important;visibility:hidden !important}
              .sidebar {'. $strcss_pos_rel . 'z-index:1 !important}
              .site-header {margin: 0 !important;padding: 7.6923% !important;}
              .main-navigation {margin-bottom: 11.1111% !important;}
              .site-footer  {display: block;}
              .secondary {background-color: #FFF !important;margin: 7.6923% 7.6923% 0 !important;padding: 7.6923% 7.6923% 0 !important;}
            }';
          break;

          case 'Twenty Sixteen' :
            echo 'body.admin-bar:not(.custom-background-image)::before,body:not(.custom-background-image)::before{'. $strcss_pos_rel . ' ' . $strcss_top_0 . 'height:0 !important}';
          break;

          case 'Twenty Seventeen' :
            echo '.custom-header,#wp-custom-header {z-index:0;}
              .ud-norm--header,.ud-header--title {z-index:99}
              .site-navigation-fixed.navigation-top,.has-header-image .custom-header-media img,.has-header-video .custom-header-media video,.has-header-video .custom-header-media iframe{'. $strcss_pos_rel . '}';
          break;

          default :
            echo '';
          break;
        }
        ?>
        </style>
        <?php
      endif; // end in_array()
    } // end udtbp_enqueue_inline_theme_styles

    /**
     * Check If Admin Bar Is Visible.
     * Display admin bar if user is logged in on public facing pages.
     *
     * @since     3.0.0
     * @link   http://stackoverflow.com/questions/21277190/wordpress-admin-bar-not-showing-on-frontend
     */
    public function udtbp_show_admin_bar(){
      if( is_user_logged_in() ){
        add_filter( 'show_admin_bar', '__return_TRUE' , 1000 );
      }
    }
    /**
     * Including Header Front End
     * Hack to load content directly after opening <body> tag.
     *
     * @since     3.0.0
     * @param     string        $template
     * @link   http://maltpress.co.uk/2010/10/wordpress-injecting-code-after-the-body-tag-for-plugins/
     */
    public function custom_include( $template ) {
      ob_start();
      return $template;
    }
    /**
     * Hide Plugin html Condition
     * Checks if current page is either wp-login or register action.
     *
     * @since     3.0.0
     * @return    boolean   [If TRUE, hide plugin html]
     * @link   https://code.tutsplus.com/tutorials/wordpress-error-handling-with-wp_error-class-i--cms-21120
     * @link   http://stackoverflow.com/questions/10041200/interpolate-constant-not-variable-into-heredoc
     */
    public function body_inject() {
      global $pagenow;
      $quicklinks = new udtbp_QuickLinks();
      $this->quicklinks = udtbp_QuickLinks::quicklinks_header();
      $blow = $this->quicklinks;
      $homeUrl = get_home_url();

      if ( $pagenow !== 'wp-login.php' && ! isset ( $_GET['action'] ) ) {
        $show_custom_text = '';
        $quicklinks = '';
        wp_reset_query();
        $options = ( get_option('udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE);

        if ( isset( $options['header-title'] ) && ! empty( $options['header-title'] ) ) :
          $header_title = $options["header-title"];

          if( $header_title != NULL ) {
            $show_custom_text = <<<HTML
<div class="ud-header--title item item--full">
<div id="ud-id-site--title" class="ud-display--db ud-align--asstretch cell">
<a href="{$homeUrl}" aria-label="Go to the {$header_title} home page.">$header_title</a>
</div>
</div>
HTML;
          } // end $header_title != NULL
        endif; // isset header-title

        if( isset( $options["view-header"] ) && !empty( $options["view-header"] ) ) :
          $inject = <<<HTML
<div id="ud-id-head" class="ud-wrapper--grid ud-gtr-head">
<header class="ud-norm--header ud-header--logo item item--full">
<div class="ud-flex--df ud-align--asstretch cell">
<a href="https://www1.udel.edu/">
<img alt="Go to the University of Delaware home page." id="ud_primary_logo" src="{$this->udtbp_public_img_url}/logos/img-udlogo.svg" role="img" width="170" height="70">
</a>
<div class="ud-flex--df ud-align--jcfe ud-header--quicklinks">
<ul>
<li>
<a aria-label="Visit the University of Delaware (external link)" href="https://www.udel.edu/about/visit/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_visit">
<svg class="icon">
<use xlink:href="#ud-icon-visit"></use>
</svg>
 <p>Visit</p>
</a>
</li>
<li>
<a aria-label="Apply to the University of Delaware (external link)" href="https://www.udel.edu/apply/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_apply">
<svg class="icon">
<use xlink:href="#ud-icon-apply"></use>
</svg>
 <p>Apply</p>
</a>
</li>
<li>
<a aria-label="Give a gift to the University of Delaware (external link)" href="https://www.udel.edu/alumni-friends/give/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_give">
<svg class="icon">
<use xlink:href="#ud-icon-give"></use>
</svg>
 <p>Give</p>
</a>
</li>
</ul>
</div>
</div>
</header>
$show_custom_text
</div>
HTML;
          $content = ob_get_clean();
          $content = preg_replace( '#<body([^>]*)>#i',"<body$1>{$inject}",$content );
          echo $content;
        endif; // isset view-header
      } // end $pagenow check
    } // end body_inject()
    /**
    * PUBLIC SETTINGS CALLBACK FUNCTION
    * Callback function for the admin settings page.
    *
    * @since    3.0.0
    */
    public function front_end_footer() {
      $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
      if( isset( $options['view-footer'] ) && $options['view-footer'] != 0  ):
        include_once ( UDTBP_DIR . '/public/views/udtbp-public-footer-display.php' );
      endif;
    }
  } // end class udtbp_Public
endif;
