<?php
/**
  * UDTheme Branding Minify
  *
  * The purpose of this file is to:
  * Minimize all plugin related CSS stylesheets into a single file
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/public/css
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2020 University of Delaware
  * @version     3.5.4
*/
header( 'Content-type: text/css; charset: UTF-8' );
ob_start( "compress" );

function compress( $buffer ) {
/**
  * @since       3.0.0
  * @version     2.0.0              new partials CSS and files replace prev. CSS
  * @param       string             $buffer
  * @link                           https://ikreativ.com/combine-minify-css-with-php/
  * @link                           https://stackoverflow.com/questions/9862904/css-merging-with-php
*/
      /* remove comments */
      $buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
      /* remove tabs, spaces, newlines, etc. */
      $buffer = str_replace( array ( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $buffer );
      return $buffer;
  }

  /**
   * your css files
    * @todo replace this process and file with JS build of scss files.
    * Assets/css is newer than public/css for below files. UPDATE!
  */
  // include( 'normalize.css' );
  // include( 'wcag.css' );
  // include( 'header.css' );
  // include( 'footer.css' );


  include( '../../assets/css/_fonts.css' );
  include( '../../assets/css/_helper-classes.css' );
  include( '../../assets/css/_wcag.css' );
  include( '_branding.css' );
  include( '_grid.css' );
  include( '_flexbox.css' );

  ob_end_flush();
