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
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.1.0
*/
?>
<?php
/**
 * VARIABLES USED
 */
$json_theme_list = json_decode( JSON_THEME_LIST );
$udtbp_assets_img_url = UDTBP_ASSETS_IMG_URL;
?>
<div id="saveResult"></div>
<div id="udt_wrap" class="wrap">
  <h1 id="icon-themes" class="udt_dash_icon">
    <img alt="" id="ud_primary_logo" src="<?php echo UDTBP_ASSETS_IMG_URL; ?>/logos/img-udlogo.svg" role="img" width="170" height="70">
    <!-- <svg class="color-svg">
      <use xlink:href="<?php //echo UDTBP_ASSETS_IMG_URL; ?>/ud-icons-footer--defs.svg#ud-img-circleud"></use>
    </svg> -->
    <div class="ud-header--title">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
  </div>
  </h1>
</div>
<?php
  $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'header';
  $this->udtbp_render_tabs();
?>
<div id="poststuff">
  <div id="post-body" class="metabox-holder columns-1">
    <form id="<?php echo esc_attr( $this->udtbp.'_form' )?>" method="post" action="options.php">
    <?php wp_nonce_field( $this->udtbp.'_nonce' );  ?>

      <div id="postbox-container-2" class="postbox-container">
      <?php
        $options = ( get_option( 'udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE );
        $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
        // If no tab or header

        switch ($tab) {
          case 'footer':
      ?>
        <div id="udt_footer_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="label_udt_footer_settings">
          <div class="inside">
          <?php
            settings_fields( 'udtbp_footer_options' );
            do_settings_sections( 'udtbp_footer-footer' );
          ?>
          <div class="clear"></div>
        </div>
        <div class="u-ta--center">
          <button type="submit" class="ud-btn button save-button" aria-pressed="false" id="<?php echo esc_attr( $this->udtbp.'-header-tab-save' );?>"><?php echo esc_html( 'Save Changes' ); ?></button>
        </div>
      </div>
      <?php
        break;

        case 'about':
      ?>
      <div id="udt_about_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="label_udt_about_settings">
        <div class="inside">
          <h2>About <?php echo esc_html( UDTBP_NAME ); ?> Plugin</h2>
          <p>The <?php echo esc_html( UDTBP_NAME ); ?> plugin allows a University department or college to display the official University of Delaware branded header and footer on a WordPress website.</p>
          <p>Site admins may choose to use a college or department-specific title in addition to the official University header and footer.</p>
          <p><strong>This plugin is ONLY to be used on official University of Delaware department web pages and websites in accordance with UD OCM guidelines.</strong></p>
          <div class="clear"></div>
        </div>
      </div>
      <?php
        break;

        case 'support':
      ?>
      <div id="udt_support_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="label_udt_support_settings">
        <div class="inside">
        <h2>Support and help information.</h2>
        <p>If you are experiencing problems with this plugin, contact the Support Center at (302) 831-6000 or <a href="mailto:consult@udel.edu">consult@udel.edu</a>.</p>
        <p>See the plugin <a href="https://github.com/UDelIT/udthemebrand/wiki/FAQs">FAQs</a> for more information.</p>
        <ul class="ud-grid--4 ud-align--jcc ud-norm--cards">
            <li class="drop ud-div--info">
              <div class="img"></div>
              <div class="text">
                <h3>Known Incompatible Themes</h3>
                <p><?php echo esc_html( UDTBP_NAME ); ?>  is designed to display a University branded header and footer at the top of each page. Some themes contain features that may cause the UD header to 'hide' beneath the menu or cause the branding to display incorrectly. ( <a href="<?php echo UDTBP_ADMIN_IMG_URL; ?>/incompatible_example.png" class="dialogify" aria-label="Example image of broken layout from incompatible theme." type="button" data-width="500" data-height="300">See example</a> ).</p>

                <ul id="support_list">
                <?php
                $json_theme_list = json_decode( JSON_THEME_LIST );
                   foreach ( $json_theme_list as $json ){
                     echo '<li>'.$json.'</li>';
                   }
                   ?>
                </ul>
              </div>
            </li>
            <li class="drop ud-div--email">
              <div class="img">
                <img alt="" id="" src="<?php echo UDTBP_ASSETS_IMG_URL; ?>/ud-icon--mail.svg" role="img" width="128" height="128">
              </div>
              <div class="text">
                <h2>
                  <a href="mailto:consult@udel.edu">Email consult@udel.edu</a>
                </h2>
                <p>Create an incident by email.</p>
              </div>
            </li>
            <li class="drop ud-div--phone">
              <div class="img">
                <img alt="" id="" src="<?php echo UDTBP_ASSETS_IMG_URL; ?>/ud-icon--phone.svg" role="img" width="110" height="110">
              </div>
              <div class="text">
                <h2>
                  <a href="tel:3028316000">Call the IT Support Center</a>
                </h2>
                <p>Speak directly with a support specialist.</p>
              </div>
            </li>
          </ul>
       </div>
      </div>

      <?php
        break;
        default:
      ?>
      <div id="udt_header_settings" class="postbox tabPanel" role="tabpanel" aria-labelledby="label_udt_header_settings">
        <div class="inside">
          <?php
          $options = get_option( 'udtbp_header_options' );
          settings_fields( 'udtbp_header_options' );
          do_settings_sections( 'udtbp_header-header' );
          ?>
          <div class="clear"></div>
        </div>
        <div class="u-ta--center">
          <button type="submit" class="ud-btn button save-button" aria-pressed="false" id="<?php echo esc_attr( $this->udtbp.'-header-tab-save' );?>"><?php _e( 'Save Changes' ); ?></button>
        </div>
      </div>
      <?php
        break;
      } // end switch
      ?>
    </div> <!-- end postbox-container-2 -->
  </form>
    </div>
  </div>
</div>
<div id="udtbp-ajax-saving" class="">
  <img src="<?php echo esc_url( UDTBP_ADMIN_IMG_URL.'/loader.gif' ); ?>" alt="loading" id="loading">
</div>
<div id="udtbp-ajax-message" class=""></div>
<div id="dialog" title="Dialog"></div>


