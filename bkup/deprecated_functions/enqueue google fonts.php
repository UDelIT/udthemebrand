<?php
// from class-udtbp.php
/**
 * ENQUEUE GOOGLE FONTS ADMIN (DEPRECATED)
 *
 * This function is used to:
 * Register and enqueue admin-specific Google Fonts
 *
 * @since       3.0.0
 * @deprecated  3.5.0       No longer used. Replaced by OCM specific fonts. 8/10/18 CL
 * @link        https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
*/
   public function udtbp_add_google_fonts() {
     $fonts     = array();
     $subsets   = urlencode( 'latin,latin-ext' );
     $poppins   = _x( 'on', 'Poppins font: on or off' );

     if ( 'off' !== $poppins ) {
      $fonts[] = 'Poppins:400,400italic, 600';
     }
     $family = urlencode( implode( '|', $fonts ) );
     wp_register_style( $this->udtbp . '-google-fonts', 'https://fonts.googleapis.com/css?family='.$family . '&subset=' . $subsets );
     wp_enqueue_style( $this->udtbp . '-google-fonts' );
   } // end udtbp_add_google_fonts
