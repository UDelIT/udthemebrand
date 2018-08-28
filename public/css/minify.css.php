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
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.5.0
*/
header( 'Content-type: text/css; charset: UTF-8' );
ob_start( "compress" );

function compress( $buffer ) {
/**
  * @since       3.0.0
  * @version     2.0.0              new partials CSS and files replace prev. CSS
  * @param       string             $buffer
  * @link                           https://ikreativ.com/combine-minify-css-with-php/
  * @link                           http://stackoverflow.com/questions/9862904/css-merging-with-php
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
  */
  // include( 'normalize.css' );
  // include( 'wcag.css' );
  // include( 'header.css' );
  // include( 'footer.css' );

  include( '_fonts.css' );
  include( '_normalize.css' );
  include( '_branding.css' );
  include( '_grid.css' );
  include( '_flexbox.css' );
  include( '_wcag.css' );
  ob_end_flush();
