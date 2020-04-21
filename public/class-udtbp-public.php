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
  * @copyright   Copyright (c) 2012-2020 University of Delaware
  * @version     3.5.4
*/
if ( ! class_exists( 'udtbp_Public' ) ) :
  class udtbp_Public extends udtbp_Admin {
    private $udtbp;
    private $current_theme;
    public $color_footer;

    /**
     * CSS Style for position used in theme override styles.
     *
     * @since      3.0.1
     * @access     public
     * @var        string    $strcss_pos_rel   Defines position:relative !important for theme override CSS
    */
    public $strcss_pos_rel;

    /**
     * CSS Style for top location used in theme override styles.
     *
     * @since      3.0.0
     * @access     public
     * @var        string    $strcss_top_0     Defines top:0 !important for theme override CSS
    */
    public $strcss_top_0;

    /**
     * CLASS INITIALIZATION
     *
     * Initiates the class and set its properties.
     *
     * @since      3.0.0
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
     * @since      3.5.0
     * @link       https://stackoverflow.com/questions/37953058/how-do-i-remove-the-ability-to-change-the-site-icon-in-wordpress
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
     * @since      3.0.0
     * @version    1.5.0     Updated sizes, brand. Added IEConfig.xml content.
     *                       Disabled conditional since removing functionality in theme Customizer.
     * {@link   https://developer.wordpress.org/reference/functions/wp_site_icon/}
    */

    public function udt_add_favicon() {
      // $meta_tags = [
      //   sprintf(
      //     '<link rel="icon" href="%s" sizes="32x32">',
      //     esc_url(
      //       get_site_icon_url( 32, UDTBP_PUBLIC_IMG_URL.'/touch/favicon.ico' )
      //     )
      //   ),
      //   sprintf(
      //     '<link rel="apple-touch-icon" href="%s" sizes="180x180">',
      //     esc_url(
      //       get_site_icon_url( 180, UDTBP_PUBLIC_IMG_URL.'/touch/apple-touch-icon-180x180.png' )
      //     )
      //   ),
      //   sprintf(
      //     '<link rel="icon" type="image/png" href="%s" sizes="192x192">',
      //     esc_url(
      //       get_site_icon_url( 192, UDTBP_PUBLIC_IMG_URL.'/touch/android-chrome-192x192.png' )
      //     )
      //   ),
      //   sprintf(
      //     '<link rel="mask-icon" color="#00539F" href="%s">',
      //     esc_url(
      //       get_site_icon_url( 256, UDTBP_PUBLIC_IMG_URL.'/touch/ud-img-logo--pinned.svg' )
      //     )
      //   ),
      //   sprintf(
      //     '<link rel="icon" type="image/png" href="%s" sizes="512x512">',
      //     esc_url(
      //       get_site_icon_url( 512, UDTBP_PUBLIC_IMG_URL.'/touch/android-chrome-512x512.png' )
      //     )
      //   ),
      //   sprintf(
      //     '<meta name="msapplication-TileImage" content="%s">',
      //     esc_url(
      //       get_site_icon_url( 270, UDTBP_PUBLIC_IMG_URL.'/touch/mediumtile.png' )
      //     )
      //   ),
      // ];

      $meta_tags = [
        sprintf(
          '<link rel="shortcut icon" href="%s" sizes="32x32">',
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
          '<meta name="msapplication-TileColor" content="%s">',
          esc_html( '#EEEEEE' )
        ),
        sprintf(
          '<meta name="msapplication-square70x70logo" content="%s">',
          esc_url(
            get_site_icon_url( 270, UDTBP_PUBLIC_IMG_URL.'/touch/favicon-128x128.png' )
          )
        ),
        sprintf(
          '<meta name="msapplication-square150x150logo" content="%s">',
          esc_url(
            get_site_icon_url( 270, UDTBP_PUBLIC_IMG_URL.'/touch/favicon-270x270.png' )
          )
        ),
        sprintf(
          '<meta name="msapplication-TileImage" content="%s">',
          esc_url(
            get_site_icon_url( 270, UDTBP_PUBLIC_IMG_URL.'/touch/favicon-270x270ms.png' )
          )
        ),
        sprintf(
          '<meta name="msapplication-config" content="%s">',
          esc_html( 'none' )
        )
      ];
      /**
       * SITE ICON FILTER
       * Filters the site icon meta tags, so Plugins can add their own.
       *
       * @since     3.0.0
       * @version   1.0.1     added stripslashes() to clean up data
       * @param     array     $meta_tags[]    array of Site Icon meta elements.
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
     * @since      3.0.0
     * @version    1.5.0     added localize script functionality to use variables in public js.
     * @return     mixed     null/string   Return early if no settings page is registered.
    */
    public function enqueue_scripts() {
      wp_deregister_script( $this->udtbp . '-public-script' );
      wp_register_script( $this->udtbp . '-public-script', UDTBP_PUBLIC_JS_URL . '/udtbp-public.min.js', array( 'jquery' ), UDTBP_VERSION, TRUE );
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
     *
     * This function is used to:
     * Register and enqueue public-specific stylesheets
     * Adds public specific stylesheets files.
     * Call styles only if plugin is enabled
     *
     * @since      3.0.0
     * @version    1.2       Append date to file name
     * @return     mixed     null/string    Return early if no settings page is registered.
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
     * @since      3.0.0
     * @version    2.0.0                    Added switch case, removed admin bar CSS
     * @return     mixed     null/string    Return early if no settings page is registered.
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
     * @since      3.0.0
     * @version    1.0.1     Removed Highland theme case statement because theme is deprecated.
     * @return     null      Return early if no settings page is registered.
     * @link   https://github.com/DevinVinson/no-sidebar-twentyfifteen/tree/master/nosidebar-twentyfifteen
     * @todo       migrate switch to JSON. Styles to array.
    */
    public function udtbp_enqueue_inline_theme_styles() {
      $impt         = " !important;";
      $cssor_p_rel  = "position:relative !important;";
      $cssor_top_0  = "top:0px !important;";
      $cssor_pos    = $cssor_p_rel . $cssor_top_0;
      $cssor_zi_1   = "z-index:1 !important";
      $cssor_zi_100 = "z-index:100 !important";
      $cssor_zi_max = "z-index:9999 !important";
      $cssor_srhide = "display: none !important;visibility:hidden !important";
      if ( in_array( $this->current_theme, json_decode( $this->json_theme_list ) )) :
        ?>
        <style id="udtbp-theme-override-css">
        <?php
        switch ( $this->current_theme ) {
          case 'Aaron' :
            echo '#site-navigation,
                  .main-navigation{'
                    . $cssor_p_rel .
                  '}';
          break;

          case 'Boardwalk' :
            echo '.site-footer,
                  .blog .site-footer,
                  .site-header,
                  .admin-bar .site-header{'
                    . $css_pos .
                  '}';
          break;

          case 'Cubic' :
            echo 'body.unfixed-header > .site-header,
                  body.unfixed-header > .sidebar,
                  .site-footer,
                  .blog .site-footer,
                  .site-header,
                  .admin-bar .site-header {'
                    . $cssor_p_rel .
                  '}';
          break;

          case 'Divi' :
            echo '.ud-footer--logo a {
                    cursor:pointer;
                  }
                  #top-header{'
                    . $cssor_zi_max .
                  '}
                  body.admin-bar.et_fixed_nav #main-header,
                  body.admin-bar.et_fixed_nav #top-header{'
                    . $cssor_top_0 .
                  '}
                  .et_fixed_nav #main-header,
                  .et_fixed_nav #top-header{ '
                    . $cssor_p_rel .
                  '}
                  .et_fixed_nav.et_show_nav.et_secondary_nav_enabled.et_header_style_centered #page-container,
                  .et_fixed_nav.et_show_nav.et_secondary_nav_enabled #page-container,
                  .et_non_fixed_nav.et_transparent_nav.et_show_nav.et_secondary_nav_enabled #page-container {
                    margin-top:0' . $impt .
                    'padding-top:0' . $impt .
                  '}';
          break;

          case 'Matheson' :
            echo '#footer{'
                    . $cssor_zi_1 .
                  '}
                  .ud-norm--footer{'
                    . $cssor_zi_100 .
                  '}
                  .image-anchor {
                    display: inline' . $impt .
                  '}';
          break;

          case 'Radiate' :
            echo '#page {'
                    . $cssor_zi_1 .
                  '}
                  body.admin-bar .header-wrap {'
                    . $cssor_top_0 .
                  '}
                  .header-wrap {'
                    . $css_pos .
                    'width: 100%;'
                    . $cssor_zi_max .
                  '}
                  #parallax-bg {
                    margin-top:182px;
                  }';
          break;

          case 'Star' :
            echo '#site-navigation,
                  .main-navigation {'
                    . $css_pos .
                  '}
                  .ud-footer--social li a[href]::before {
                    content: "" ' . $impt .
                  '}
                  .ud-footer--social li a::before{
                    display:none '. $impt .
                    'margin:0 ' . $impt .
                    'line-height:inherit ' . $impt .
                  '}';
          break;

          case 'Swell Lite' :
            echo 'ul li {
                    list-style: none ' . $impt .
                    'padding:inherit ' . $impt .
                  '}
                  .admin-bar #navigation.fixed-nav{
                    margin-top: 0 ' . $impt .
                  '}
                  #navigation.fixed-nav {'
                    . $cssor_p_rel .
                  '}';
          break;

          case 'Temptation' :
            echo '#parallax-bg{'
                    . $cssor_srhide .
                  '}';
          break;

          case 'Tracks' :
            echo '#udtbp_footer{
                    z-index:-1;
                    background:white
                  }';
          break;

          case 'Twenty Twelve' :
            echo '#masthead > hgroup {'
                    . $cssor_srhide .
                  '}
                  #udtbp_footer {
                    line-height: inherit '. $impt .
                    'margin: 0 '. $impt .
                    'max-width: 100% '. $impt .
                    'padding: 1.125em 0 0 '. $impt .
                    'font-size:10px '. $impt .
                    'border-top: none '. $impt .
                    'background:white '. $impt .
                  '}
                  #yellowbar {
                    margin: 8px 0 0 '. $impt .
                  '}';
          break;

          case 'Twenty Fourteen' :
            echo 'h1.site-title,
                  h2.site-description {'
                    . $cssor_srhide .
                  '}
                  #page {
                    margin: 0 auto ' . $impt .
                  '}
                  .masthead-fixed .site-header {'
                    . $css_pos .
                  '}';
          break;

          case 'Twenty Fifteen' :
            echo 'body::before,
                  p.site-branding{'
                    . $cssor_srhide .
                  '}
                  #page {
                    overflow-y:hidden
                  }
                  #sidebar{'
                    . $cssor_p_rel . $cssor_zi_1 .
                  '}
                  .ud-gtr-foot {'
                    . $cssor_p_rel . $cssor_zi_100 .
                  '}

                  @media only screen and ( min-width: 46.25em ){
                    body::before{'
                      . $cssor_srhide .
                    '}
                    .sidebar { '
                      . $cssor_p_rel . $cssor_zi_1 .
                    '}
                    .site-header {
                      margin: 0 '. $impt .
                      'padding: 7.6923% ' . $impt .
                    '}
                    .main-navigation {
                      margin-bottom: 11.1111% ' . $impt .
                    '}
                    .site-footer  {
                      display: block;
                    }
                    .secondary {
                      background-color: #FFF ' . $impt .
                      'margin: 7.6923% 7.6923% 0 ' . $impt .
                      'padding: 7.6923% 7.6923% 0 ' . $impt .
                    '}
                  }';
          break;

          case 'Twenty Sixteen' :
            echo 'body.admin-bar:not(.custom-background-image)::before,
                  body:not(.custom-background-image)::before{'
                    . $css_pos .
                    'height:0 '  . $impt .
                  '}';
          break;

          case 'Twenty Seventeen' :
            echo '.custom-header,#wp-custom-header {
                    z-index:0
                  }
                  .ud-norm--header,
                  .ud-header--title {'
                    . $cssor_zi_100 .
                  '}
                  .site-navigation-fixed.navigation-top,
                  .has-header-image .custom-header-media img,
                  .has-header-video .custom-header-media video,
                  .has-header-video .custom-header-media iframe{'
                    . $cssor_p_rel .
                  '}';
          break;

          default :
          break;
        }
        ?>
        </style>
        <?php
      endif; // end in_array()
    } // end udtbp_enqueue_inline_theme_styles

    /**
     * ADMIN BAR VISIBILITY
     *
     * Display admin bar if user is logged in on public facing pages.
     *
     * @since      3.0.0
     * @link   https://stackoverflow.com/questions/21277190/wordpress-admin-bar-not-showing-on-frontend
    */
    public function udtbp_show_admin_bar(){
      if( is_user_logged_in() ){
        add_filter( 'show_admin_bar', '__return_TRUE' , 1000 );
      }
    }

    /**
     * GET NAV MENU ITEMS BY LOCATION (NOT YET IN USE)
     *
     * Used to locate theme primary menu and prepend UD OCM Quick Links.
     * @todo goal is to implement by version 3.6
     * @param $location The menu location id
     */
    public function get_nav_menu_items_by_location( $location, $args = [] ) {
      // Get all locations
      $locations = get_nav_menu_locations();
      // Get object id by location
      $object = wp_get_nav_menu_object( $locations[$location] );
      // Get menu items by menu name
      $menu_items = wp_get_nav_menu_items( $object->name, $args );
      // Return menu post objects
      return $menu_items;
    }

    /**
     * HEADER FRONT END INJECTION
     *
     * Hack to load content directly after opening <body> tag.
     *
     * @since      3.0.0
     * @param      string        $template
     * @link   http://maltpress.co.uk/2010/10/wordpress-injecting-code-after-the-body-tag-for-plugins/
     */
    public function custom_include( $template ) {
      ob_start();
      return $template;
    }

    /**
     * HIDE PLUGIN ON NON PLUGIN PAGES
     *
     * Hide Plugin html Condition
     * Checks if current page is either wp-login or register action.
     *
     * @since      3.0.0
     * @version    1.2.0 Improved styles and accessibility
     * @return     boolean   [If TRUE, hide plugin html]
     * @link   https://code.tutsplus.com/tutorials/wordpress-error-handling-with-wp_error-class-i--cms-21120
     * @link   http://stackoverflow.com/questions/10041200/interpolate-constant-not-variable-into-heredoc
    */
    public function body_inject() {
      global $pagenow;
      // $quicklinks = new udtbp_QuickLinks();
      // $this->quicklinks = udtbp_QuickLinks::quicklinks_header();
     // $blow = $this->quicklinks;
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
<div class="ud-header--title item item--full" role="banner" aria-labelledby="u-link--title">
<div id="ud-id-site--title" class="ublock uflex--asstretch cell">
<a id="u-link--title" href="{$homeUrl}" aria-label="Go to the {$header_title} home page">$header_title</a>
</div>
</div>
HTML;
          } // end $header_title != NULL
        endif; // isset header-title

        if( isset( $options["view-header"] ) && !empty( $options["view-header"] ) ) :
          $inject = <<<HTML

<div id="ud-id-head" class="ud-wrapper--grid ud-gtr-head">
<header class="ud-norm--header ud-header--logo item item--full" role="banner" aria-label="UD branded header content">
<div class="uflex uflex--asstretch cell">
<a id="u-link--img_logo" href="https://www1.udel.edu/" aria-label="Go to the University of Delaware home page.">
<img alt="University of Delaware" id="ud_primary_logo" src="{$this->udtbp_public_img_url}/logos/img-udlogo.svg" role="img" width="170" height="70">
</a>
</div>
</header>
$show_custom_text
</div>
HTML;

// <div class="ud-flex--df ud-align--jcfe ud-header--quicklinks">
// <ul>
// <li>
// <a aria-label="Visit the University of Delaware (external link)" href="https://www.udel.edu/about/visit/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_visit">
// <svg class="icon">
// <use xlink:href="#ud-icon-visit"></use>
// </svg>
//  <p>Visit</p>
// </a>
// </li>
// <li>
// <a aria-label="Apply to the University of Delaware (external link)" href="https://www.udel.edu/apply/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_apply">
// <svg class="icon">
// <use xlink:href="#ud-icon-apply"></use>
// </svg>
//  <p>Apply</p>
// </a>
// </li>
// <li>
// <a aria-label="Give a gift to the University of Delaware (external link)" href="https://www.udel.edu/alumni-friends/give/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_give">
// <svg class="icon">
// <use xlink:href="#ud-icon-give"></use>
// </svg>
//  <p>Give</p>
// </a>
// </li>
// </ul>
// </div>
          $content = ob_get_clean();
          $content = preg_replace( '#<body([^>]*)>#i',"<body$1>{$inject}",$content );
          echo $content;
        endif; // isset view-header
      } // end $pagenow check
    } // end body_inject()

    /**
    * PUBLIC SETTINGS CALLBACK FUNCTION
    *
    * Callback function for the admin settings page.
    *
    * @since       3.0.0
    */
    public function front_end_footer() {
      $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
      if( isset( $options['view-footer'] ) && $options['view-footer'] != 0  ):
        include_once ( UDTBP_DIR . '/public/views/udtbp-public-footer-display.php' );
      endif;
    }
  } // end class udtbp_Public
endif;
