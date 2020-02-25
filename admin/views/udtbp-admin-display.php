  <?php
/**
  * UDTheme Branding Admin Display
  *
  * The purpose of this page is to:
  * Display admin html
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/admin/views
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2019 University of Delaware
  * @version     3.5.3
*/
?>
<?php
/**
 * VARIABLES USED
 */

$udtbp_assets_img_url = esc_url( UDTBP_ASSETS_IMG_URL, UDTBP_NAME );
$udtbp_admin_img_url = esc_url( UDTBP_ADMIN_IMG_URL, UDTBP_NAME );
$udtbp_assets_img_url = esc_url( UDTBP_ASSETS_IMG_URL, UDTBP_NAME );
$strAlt = sprintf( __('', UDTBP_NAME) );
?>
<div id="saveResult"></div>


<div id="ud-id-head" class="ud-wrapper--grid ud-gtr-head">
  <header class="ud-norm--header ud-header--logo item item--full" role="banner" aria-label="UD branded header content" >
    <div class="uflex uflex--asstretch cell">
      <img alt="University of Delaware" id="ud_primary_logo" src="<?php echo $udtbp_assets_img_url; ?>/logos/img-udlogo.svg" role="img" width="170" height="70">
    </div>
  </header>
  <div class="ud-header--title item item--full" role="banner" aria-labelledby="u-link--title">
    <div id="ud-id-site--title" class="ublock uflex--asstretch cell">
      <h1 id="u-link--title"><?php echo __( get_admin_page_title() ); ?></h1>
    </div>
  </div>
</div>
<div id="udt_wrap" class="wrap">
  <h1 id="icon-themes" class="udt_dash_icon"></h1>
</div>

<?php
  $this->udtbp_render_tabs();
  $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'header';

?>
<div id="poststuff">
  <div id="post-body" class="metabox-holder columns-2">

      <div id="postbox-container-2" class="postbox-container">
        <form class="ud-class--form" id="<?php echo esc_attr( $this->udtbp.'_form' )?>" method="post" action="options.php"><?php
          wp_nonce_field( $this->udtbp.'_nonce' );

          $options = ( get_option( 'udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE );
          $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
        // If no tab or header

          switch ( $current_tab ) {
            case 'footer':
        ?>
          <div id="udt_footer_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="id-label-footer-settings">
            <h2 id="id-label-footer-settings" class="screen-reader-text">This tab allows you to configure your footer brand settings.</h2>
        <div class="inside">
          <?php
            settings_fields( 'udtbp_footer_options' );
            do_settings_sections( 'udtbp_footer-footer' );
          ?>
          <div class="clear"></div>
           <div class="ud-cont--button">
          <button type="submit" class="ud-btn button save-button" aria-pressed="false" id="<?php echo esc_attr( $this->udtbp.'-footer-tab-save' );?>"><?php echo __( 'Save Changes' ); ?>
            <svg id="ud-icon--arrow" role="presentation" aria-label="arrow icon" focusable="false" class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
              <g fill="none" stroke="#2175FF" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
                <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
              </g>
            </svg>
          </button>
        </div>
        </div>
          </div> <!-- end udt_footer_settings -->
        <?php
            break;

            case 'about':
        ?>
          <div id="udt_about_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="label_udt_about_settings">
            <div class="inside">
              <h2 class="subheadline">About <?php echo __( UDTBP_NAME ); ?> Plugin</h2>
              <p>The <?php echo __( UDTBP_NAME ); ?> plugin allows a University department or college to display the official University of Delaware branded header and footer on a WordPress website. The plugin is also WCAG Level AA Compliant.</p>
              <p>Site administrators may choose to use a college or department-specific title in addition to the official University header and footer.</p>
              <p>
                <strong>This plugin is ONLY to be used on official University of Delaware department web pages and websites in accordance with UD OCM guidelines.</strong>
              </p>
              <div class="clear"></div>
            </div>
          </div>
        <?php
            break;

           // case 'support':
        ?>
        <?php
           // break;

            default:
        ?>
          <div id="udt_header_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="id-label-header-settings">
            <h2 id="id-label-header-settings" class="screen-reader-text">This tab allows you to configure your header brand settings.</h2>
            <div class="inside">
              <?php
              $options = get_option( 'udtbp_header_options' );
              settings_fields( 'udtbp_header_options' );
              do_settings_sections( 'udtbp_header-header' );
              ?>
              <div class="clear"></div>
              <div class="ud-cont--button">
                <button type="submit" class="ud-btn button save-button" aria-pressed="false" id="<?php echo esc_attr( $this->udtbp.'-header-tab-save' );?>"><?php echo __( 'Save Changes' ); ?><svg id="ud-icon--arrow" role="presentation" aria-label="arrow icon" focusable="false" class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><g fill="none" stroke="#2175FF" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10"><circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle><path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path></g></svg></button>
              </div>
            </div>
          </div>
        <?php
            break;
          } // end switch
        ?>
        </form>
      </div> <!-- end postbox-container-2 -->

      <div id="postbox-container-1" class="postbox-container">
        <div id="udt_support_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="id-label-support-settings">
            <h2 id="id-label-support-settings" class="screen-reader-text">This tab provides support information for the branding plugin.</h2>
          <div class="inside">
            <h2>Support information</h2>
            <p>If you are experiencing problems with this plugin, contact the Support Center at <a href="tel:3028316000">(302) 831-6000</a> or <a href="mailto:askit@udel.edu">askit@udel.edu</a>.</p>
            <p>See the plugin <a href="https://github.com/UDelIT/udthemebrand/wiki/FAQs">FAQs</a> for more information.</p>
            <h2>Known Incompatible Themes</h2>
            <p>Themes with fixed navigation enabled may cause the branding to display incorrectly.</p>

            <ul id="support_list">
             <?php
             $json_theme_list = json_decode( JSON_THEME_LIST );
             foreach ( $json_theme_list as $json ){
              echo '<li>'.$json.'</li>';
              }
              ?>
            </ul>
            <h2>Deprecated Themes</h2>
            <p>These themes are no longer supported.</p>

            <ul id="legacy_list">
             <li>Anjirai <small>last update 2015</small></li>
             <li>Highwind <small>last update 2014</small></li>
             <li>Star</li>
             <li>Temptation</li>
            </ul>
            <div class="clear"></div>
          </div>
        </div>
      </div> <!-- end postbox-container-1 -->
  </div>
</div>
<div id="udtbp-ajax-saving" class="">
  <img src="<?php echo $udtbp_admin_img_url; ?>/loader.gif" alt="loading" id="loading">
</div>
<div id="udtbp-ajax-message" class=""></div>
<div id="dialog" title="Dialog"></div>
