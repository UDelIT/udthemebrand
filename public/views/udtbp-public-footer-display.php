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
   * @since         1.4.2
   * @version       3.5.0    Updated: [css grid/flexbox layout, accessibility, svg images]
   */
?>
<div id="ud-id-foot" class="ud-wrapper--grid ud-gtr-foot">
  <footer class="item--full ud-norm--footer" itemscope="" itemtype="https://schema.org/WPFooter">
    <div class="ud-grid--2 ud-align--aic">
      <div class="ud-footer--logo">
        <a href="https://www.udel.edu" aria-labeledby="ud_circle_logo">
         <img alt="Go to the University of Delaware home page." id="ud_circle_logo" src="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/logos/img-ud-circle-logo.svg" role="img" width="130" height="130">
          <span class="screen-reader-text">Go to the University of Delaware home page.</span>
        </a>
      </div>
      <div class="ud-footer--social">
        <?php
          $social = new udtbp_Social();
          echo $social->social_footer();
        ?>
      </div>
    </div>
  </footer>
  <div class="item item--full ud-footer--legal">
    <ul>
      <li>©<?php echo Date('Y'); ?> <span id="udid_cr" class="ud_copyright">University of Delaware</span></li>
      <li><a href="https://www.udel.edu/home/comments">Comments</a></li>
      <li><a href="https://www.udel.edu/home/legal-notices"><span id="udid_ln" class="ud_copyright">Legal Notices</span></a></li>
      <li><a href="https://www.udel.edu/home/legal-notices/accessibility/"><span id="udid_an" class="ud_copyright">Accessibility Notice</span></a></li>
    </ul>
  </div>
</div>

<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256">
  <defs>
    <style>
    #ud-img-circleud circle {fill: #0051ad;}
    .ud-footer--logo a:hover #ud-img-circleud circle {fill: white;}
      svg:hover {fill: white;}
    </style>
    <symbol id="ud-icon-twitter" role="img" aria-label="twitter icon" viewBox="0 0 256 256">
      <path d="M228.9,76.1c.2,2.3.2,4.5.2,6.8,0,69-52.4,148.6-148.2,148.6A146.3,146.3,0,0,1,1,208a104.9,104.9,0,0,0,77.2-21.6,52.3,52.3,0,0,1-48.7-36.2c8,1.1,15.1,1.2,23.6-1A52.3,52.3,0,0,1,11.3,97.9v-.6a51.7,51.7,0,0,0,23.5,6.6A52.4,52.4,0,0,1,18.7,34.1,148.5,148.5,0,0,0,126.1,88.7C114.8,34.2,179.9,3.5,214.9,41a103.1,103.1,0,0,0,33-12.6A52.5,52.5,0,0,1,225,57.2a107.3,107.3,0,0,0,30-8.1,113.4,113.4,0,0,1-26.1,27Z"></path>
    </symbol>
    <symbol id="ud-icon-facebook" role="img" aria-label="facebook icon" viewBox="0 0 256 256">
      <path d="M102.1,93.4H76V128h26.1V231.5h43.4V128h31.3L180,93.4H145.2V78.7c0-8.6,1.7-11.3,9.5-11.3h25V24.5H147.1c-31.2,0-45,13.7-45,39.7Z"></path>
    </symbol>
    <symbol id="ud-icon-instagram" role="img" aria-label="instagram icon" viewBox="0 0 256 256">
      <path d="M128,74.9A53.1,53.1,0,1,0,181.1,128,53,53,0,0,0,128,74.9Zm0,87.6A34.5,34.5,0,1,1,162.5,128,34.6,34.6,0,0,1,128,162.5Zm67.6-89.7a12.4,12.4,0,1,1-12.3-12.4A12.3,12.3,0,0,1,195.6,72.8Zm35.2,12.5c-.8-16.6-4.6-31.3-16.7-43.4s-26.8-15.8-43.4-16.7-68.3-.9-85.4,0S54.1,29.8,41.9,41.9,26.1,68.7,25.2,85.3s-.9,68.3,0,85.4,4.6,31.3,16.7,43.4,26.8,15.8,43.4,16.7,68.3.9,85.4,0,31.3-4.6,43.4-16.7,15.8-26.8,16.7-43.4.9-68.3,0-85.4ZM208.7,189A35,35,0,0,1,189,208.7c-13.6,5.4-45.9,4.2-61,4.2s-47.4,1.2-61-4.2A35.3,35.3,0,0,1,47.3,189c-5.4-13.6-4.1-45.9-4.1-61S42,80.6,47.3,67A35,35,0,0,1,67,47.3c13.6-5.4,46-4.2,61-4.2s47.4-1.2,61,4.2A34.7,34.7,0,0,1,208.7,67c5.4,13.6,4.2,45.9,4.2,61S214.1,175.4,208.7,189Z"></path>
    </symbol>
    <symbol id="ud-icon-youtube" role="img" aria-label="youtube icon" viewBox="0 0 256 256">
      <path d="M65.2,24.5H77l8.4,31.9,7.7-31.9h12.6L91.2,71.9v32.7H79.7V71.9Zm39.2,36.2V88.9c0,10.4,5,15.5,16.1,15.5,8.4,0,15.3-6.2,15.3-15.5V60.7C138,40.6,104.4,39.4,104.4,60.7Zm21.4,28.2c0,3.5-1.6,5.1-4.3,5.1a4.9,4.9,0,0,1-5-5.1V61.5c0-8.7,9.3-7.8,9.3,0Zm40-43.6V90c-1.8,1.6-4.5,4.3-6.1,4.3s-2.6-1.6-2.6-4.3V45.3H146v49c0,6.1,1.6,10.3,7.7,10.3,3.4,0,7.6-1.6,12.6-7.7v6.9h11.1V45.3Zm18.7,119.5c-5.6,0-3.9,7.4-4.2,13.1h9.5v-6.2C188.7,167.2,187.9,164.8,184.5,164.8Zm-40,0c-.8,0-1.6.8-2.7,1.6v35.1a4.1,4.1,0,0,0,2.7,1.6c1.5.8,4.2.8,5-.8s.8-1.6.8-3.4c0-31.9.3-32.5-.8-33.6S146,163.7,144.5,164.8Zm40.8-44.7c-22.1-.8-93.5-.8-115.7,0s-27.1,16.2-27.1,55.1,2.6,53.2,27.1,55.1c22.2,1.6,94.6,1.6,116.8,0s26.3-16.2,27.1-55.1C212.4,136.3,209,121.7,185.3,120.1ZM80.7,211.9H68.8V147.5H57V136.3H92.8v11.2H81v64.4Zm31.4,0v-5.8a13.8,13.8,0,0,1-6.1,5c-6.1,3.5-12.6,3.5-12.6-8.5V156h10.2c.8,43.9-1.8,46.6,2.7,46.6,1.8,0,5-2.6,6-4.2V156h10.3v55.9Zm49.2-11.2c0,7-2.6,12-9.5,12a11.8,11.8,0,0,1-9.4-5v4.2H132.1V136.3h10.3v24c2.6-2.7,5-5.1,9.4-5.1,7.7,0,10.3,6.1,10.3,13.9Zm38.5-15.4H180.3c0,13.5-1,18.1,4.2,18.1s4.2-3.5,4.2-12H199c-.6,3.4,3.6,22.4-15.3,22.4-10.2,0-14.5-6.9-14.5-17.3v-25c0-9.6,6.1-16.3,15.3-16.3s14.5,6.1,14.5,16.3Z"></path>
    </symbol>
    <symbol id="ud-icon-linkedin" role="img" aria-label="linkedin icon" viewBox="0 0 256 256">
      <path d="M66.7,47.1c0,12.5-9.6,22.6-22,22.6S23,59.6,23,47.1s9.6-22.6,22-22.6S66.7,34.3,66.7,47.1Zm0,40.4H23v144H66.7Zm70.1,0H93.1v144h43.7V155.8c0-42.3,52.5-46,52.5,0v75.4H233V140.6c0-70.9-77.8-68.3-96.2-33.2Z"></path>
    </symbol>
    <symbol id="ud-icon-pinterest" role="img" aria-label="pinterest icon" viewBox="0 0 256 256">
      <path d="M132.8,24.5C76.3,24.5,48,65.1,48,98.7c0,20.6,7.7,38.8,24.3,45.4,2.6,1.1,5,0,5.8-2.9,3.3-12.9,3.9-12.5.8-16.3-4.8-5.6-7.7-12.8-7.7-23.2,0-30.2,22.4-56.9,58.4-56.9,32,0,49.3,19.5,49.3,45.7,0,34.1-15.2,63.3-37.6,63.3-12.5,0-21.6-10.5-18.6-23,3.4-15,10.4-31.3,10.4-42.2s-5.4-17.9-16-17.9c-12.8,0-23,13.1-23,30.7a44.9,44.9,0,0,0,3.8,18.7S85.1,175.4,82.7,185c-4.6,19.2-.8,42.7-.3,45.1a1.7,1.7,0,0,0,2.9.8c1.1-1.6,16.3-20.3,21.4-39,1.3-5.3,8.2-32.5,8.2-32.5,4,8,16.3,14.6,29.1,14.6,38.1,0,64-34.7,64-81.4C208,57.3,178.1,24.5,132.8,24.5Z"></path>
    </symbol>
    <symbol id="ud-img-circleud" role="img" aria-label="ud circle logo" viewBox="0 0 200 200">
      <circle class="fill--current fill--ltblue" id="circle" cx="100" cy="100" r="100"></circle>
      <path id="M" class="fill--current fill--white" fill="currentColor" d="M142.7 166.9c0-.5-.1-1.1-.1-1.7-.1.6-.3 1.2-.4 1.6l-.5 1.6h-.7l-.4-1.5-.3-1.7c0 .6-.1 1.2-.1 1.7v1.6h-.8l.3-4.1h1.1l.4 1.4a7 7 0 0 1 .3 1.4h.1l.3-1.4.4-1.4h1.2l.2 4.1h-.9z"></path>
      <path id="T" class="fill--current fill--white" fill="currentColor" d="M137 165.2h-1v-.8h2.9v.8h-1v3.3h-.9z"></path>
      <path id="D" class="fill--current fill--white" fill="currentColor" d="M74.2 72.5h38.4c28.1 0 42.5 16.9 42.5 45s-17.1 50.4-45.8 50.4H74.2v-3.5c10.4-1.5 9.9-.9 9.9-13.5V89.5c0-12.7.5-12-9.9-13.5zm21.2 76c0 14.9 2.9 15 13.9 15 18.3 0 32.5-11.4 32.5-45.8 0-25.9-11.8-40.9-34-40.9H95.4z"></path>
      <path id="U" class="fill--current fill--white" fill="currentColor" d="M69.6 83.4c0 16.7 3.9 29.4 19.5 29.4s21.8-11 21.8-30v-33a53.8 53.8 0 0 0-.6-6.4c-.5-4.3-4.1-5.9-9-6.5v-3.1H126v3.1c-5 .6-8.5 2.2-9 6.5a53.8 53.8 0 0 0-.6 6.4v33.5c0 25.5-14.3 35-27.8 35-22.3 0-29.2-12.8-29.2-34.3V48.6c0-11 .4-10.4-9-11.7v-3.1h28.1v3.1c-9.4 1.3-8.9.7-8.9 11.7z"></path>
    </symbol>
    <symbol id="ud-icon-apply" role="img" aria-label="apply icon" viewBox="0 0 256 256">
      <path d="M239.7 90L136.6 58.3a29.6 29.6 0 0 0-17.2 0L16.3 90a8.7 8.7 0 0 0 0 16.9l17.9 5.5a29.8 29.8 0 0 0-6.6 17.3 11.4 11.4 0 0 0-.9 19.6l-9.4 42.5a5.8 5.8 0 0 0 5.7 7.1h20.8a5.8 5.8 0 0 0 5.7-7.1l-9.4-42.5c7.2-5.1 6.7-14.9-.7-19.4a17.6 17.6 0 0 1 7.7-13.6c76.5 22.9 76.7 26.2 89.5 22.2l103.1-31.6a8.7 8.7 0 0 0 0-16.9zm-99.6 59.8c-17.4 5.4-24.2-.7-77.8-16.4l-5.2 41.9c0 13.1 31.7 23.6 70.9 23.6s70.9-10.5 70.9-23.6l-5.2-41.9z"></path>
    </symbol>
    <symbol id="ud-icon-visit" role="img" aria-label="visit icon" viewBox="0 0 256 256">
      <path d="M121.1,214.4C70,140.3,60.5,132.7,60.5,105.5a67.5,67.5,0,0,1,135,0c0,27.2-9.5,34.8-60.6,108.9a8.3,8.3,0,0,1-13.8,0Zm6.9-80.8a28.2,28.2,0,1,0-28.1-28.1A28.1,28.1,0,0,0,128,133.6Z"></path>
    </symbol>
    <symbol id="ud-icon-give" role="img" aria-label="give icon" viewBox="0 0 256 256">
      <path d="M207.5 94.4h-15c11.1-21.5-5-45.4-27.6-45.4-14.8 0-24.3 7.6-36.5 24.3C116.1 56.6 106.6 49 91.8 49c-22.9 0-38.6 24.3-27.6 45.4H48.5a11.4 11.4 0 0 0-11.3 11.4v28.4a5.7 5.7 0 0 0 5.7 5.7h4.3v55.7a11.3 11.3 0 0 0 11.3 11.3l137.6.2a11.4 11.4 0 0 0 11.4-11.4v-55.8h5.6a5.7 5.7 0 0 0 5.7-5.7v-28.4a11.4 11.4 0 0 0-11.3-11.4zm-115.7 0a14.2 14.2 0 1 1 0-28.3c7 0 12.3 1.1 30.5 28.3zm46.4 85.3a4 4 0 0 1-4 4h-14a4 4 0 0 1-4-4V119a4 4 0 0 1 4-4h14a4 4 0 0 1 4 4zm26.7-85.3h-30.6c18.3-27.1 23.4-28.3 30.6-28.3a14.2 14.2 0 1 1 0 28.3z"></path>
    </symbol>
  </defs>
</svg>
