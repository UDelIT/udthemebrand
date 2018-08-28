<?php
/**
  * UDTheme Branding Footer Display
  *
  * Defines the core plugin class
  * Includes attributes and functions used in the admin and public areas
  *
  * The purpose of this file is to:
  * Display the UD branded footer on public-facing page.
  * Contains dynamic html that builds the footer on the page.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/public/views
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.5.0
 */
  wp_reset_query();
  if( isset( $options["color-footer"] ) && $options["color-footer"] != '' ) {
    $color_footer = $options["color-footer"];
  }
  /**
   * FOOTER HTML
   *
   * Code printed in page footer that displays branded styles and content.
   *
   * @since    1.4.2
   * @version  3.5.0        Updated layout using css grid, svg images
   */
?>
<div class="ud-wrapper--grid ud-gtr-foot">
  <footer class="item--full ud-norm--footer" role="contentinfo" itemscope="" itemtype="https://schema.org/WPFooter">
    <div class="ud-grid--2 ud-align--aic">
      <div class="ud-footer--logo">
        <a href="https://www.udel.edu" aria-labeledby="ud_circle_logo">
         <!--  <img alt="Go to the University of Delaware home page." id="ud_circle_logo" src="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/logos/img-ud-circle-logo.svg" role="img" width="130" height="130"> -->
         <svg class="color-svg">
            <use xlink:href="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/ud-icons-footer--defs.svg#ud-img-circleud"></use>
          </svg>
        </a>
      </div>
      <div class="ud-footer--social">
        <ul>
          <li>
            <a href="https://twitter.com/UDelaware" class="ud-icon" aria-label="Go to the UD Twitter page. (external link)">
              <svg class="icon">
                <use xlink:href="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/ud-icons-footer--defs.svg#ud-icon-twitter"></use>
              </svg>
            </a>
          </li>
          <li>
            <a href="https://www.facebook.com/udelaware" class="ud-icon" aria-label="Go to the UD Facebook page. (external link)">
              <svg class="icon">
                <use xlink:href="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/ud-icons-footer--defs.svg#ud-icon-facebook"></use>
              </svg>
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/udelaware" class="ud-icon" aria-label="Go to the UD Instagram page. (external link)">
              <svg class="icon">
                <use xlink:href="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/ud-icons-footer--defs.svg#ud-icon-instagram"></use>
              </svg>
            </a>
          </li>
          <li>
            <a href="https://www.youtube.com/udelaware/" class="ud-icon" aria-label="Go to the UD Youtube channel. (external link)">
              <svg class="icon">
                <use xlink:href="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/ud-icons-footer--defs.svg#ud-icon-youtube"></use>
              </svg>
            </a>
          </li>
          <li>
            <a href="https://www.pinterest.com/udelaware/" class="ud-icon" aria-label="Go to the UD Pinterest page. (external link)">
              <svg class="icon">
                <use xlink:href="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/ud-icons-footer--defs.svg#ud-icon-pinterest"></use>
              </svg>
            </a>
          </li>
          <li>
            <a href="https://www.linkedin.com/edu/school?id=18070" class="ud-icon" aria-label="Go to the UD Linkedin page. (external link)">
              <svg class="icon">
                <use xlink:href="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/ud-icons-footer--defs.svg#ud-icon-linkedin"></use>
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
  <div class="item item--full ud-footer--legal">
    <ul>
      <li>©<?php echo Date('Y'); ?> <span id="udid_cr" class="ud_copyright">University of Delaware</span><span class="ud_copyright sm hidden">UD</span></li>
      <li><a href="https://www.udel.edu/home/comments">Comments</a></li>
      <li><a href="https://www.udel.edu/home/legal-notices">Legal Notices</a></li>
      <li><a href="https://www.udel.edu/home/legal-notices/accessibility/">Accessibility Notice</a></li>
    </ul>
  </div>
</div>
<!-- <ul>
<?php
//$this->path = new udtbp_Social();
//$this->social_data = udtbp_Social::social_footer();
?>
</ul> -->
