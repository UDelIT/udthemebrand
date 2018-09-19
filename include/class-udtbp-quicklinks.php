<?php
/**
 * Class: UDTheme Branding Quick Links
 *
 * Provides the content for header quick links components for the plugin
 * The purpose of this class is to:
 * Render the quick link icons in the public-facing header
 *
 * @package     udtheme-brand
 * @subpackage  udtheme-brand/include
 * @author      Christopher Leonard - University of Delaware
 * @license     GPLv3
 * @link        https://bitbucket.org/itcssdev/udtheme-brand
 * @copyright   Copyright (c) 2012-2018 University of Delaware
 * @version     3.5.0
 */
if ( ! class_exists( 'udtbp_QuickLinks' ) ) :
  class udtbp_QuickLinks {
    private $udtbp;

    /**
    * HEADER QUICK LINKS ITEMS
    *
    * @since      3.5.0
    * @access     private
    * @var        array    $items[]    {name, url, icon, aria}
    */
    public static function quicklinks_header() {
      $items = [
        "visit"  => [
          "url"  => "/about/visit/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_visit",
          "icon" => "visit",
          "aria" => "Visit"
        ],
        "apply"  => [
          "url"  => "/apply/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_apply",
          "icon" => "apply",
          "aria" => "Apply to"
        ],
        "give"   => [
          "url"  => "/alumni-friends/give/?utm_source=homepage&amp;utm_medium=icon&amp;utm_campaign=header_give",
          "icon" => "give",
          "aria" => "Make a donation to"
        ]
      ]; // end $items
      ?>
      <ul>
       <?php
       foreach( $items as $key => $value ) :
        ?>
        <li>
         <a aria-label="<?php echo esc_attr( $key ) ?> the University of Delaware (external link)" href="https://www.udel.edu<?php echo esc_attr( $value['url'] ) ?>">
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
    } // end quicklinks_header()
  } // end udtbp_QuickLinks
endif;
