<?php
/**
 * Class: UDTheme Branding Social
 *
 * Provides the content for social components for the plugin
 * The purpose of this class is to:
 * Render the social icons in the public-facing footer
 *
 * @package     udtheme-brand
 * @subpackage  udtheme-brand/include
 * @author      Christopher Leonard - University of Delaware
 * @license     GPLv3
 * @link        https://bitbucket.org/itcssdev/udtheme-brand
 * @copyright   Copyright (c) 2012-2018 University of Delaware
 * @version     3.5.0
 */
if ( ! class_exists( 'udtbp_Social' ) ) :
  class udtbp_Social {
    private $udtbp;
    /**
    * FOOTER SOCIAL ITEMS
    *
    * @since        3.0.0
    * @access       private
    * @var          array    $items[]    {name, url, icon}
    */
  public static function social_footer() {
    $items = [
      "twitter"   => [
        "url"     => "https://twitter.com/UDelaware",
        "icon"    => "twitter"
      ],
    	"facebook"  => [
      	"url"     => "https://www.facebook.com/udelaware",
       	"icon"    => "facebook"
      ],
     "instagram"  => [
        "url"     => "https://www.instagram.com/udelaware",
        "icon"    => "instagram"
      ],
     "youtube"    => [
       	"url"     => "https://www.youtube.com/udelaware",
       	"icon"    => "youtube"
       ],
     "pintrest"   => [
        "url"     => "https://www.pinterest.com/udelaware/",
        "icon"    => "pinterest"
      ],
     "linkedin"   => [
        "url"     => "https://www.linkedin.com/edu/school?id=18070",
        "icon"    => "linkedin"
      ]
    ]; // end $items
?>
    <ul>
    <?php
    foreach( $items as $key => $value ) :
    ?>
        <li>
          <a aria-label=" Go to the UD <?php echo esc_attr( $key ) ?> page (external link)" href="<?php echo esc_attr( $value['url'] ) ?>">
            <svg class="icon">
              <use xlink:href="#ud-icon-<?php echo esc_attr( $value['icon'] ) ?>"></use>
            </svg>
          </a>
        </li>
    <?php
    endforeach; // end foreach
    ?>
    </ul>
    <?php
    } // end social_footer()
  } // end udtbp_Social
endif;
