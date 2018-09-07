/**
 * PUBLIC JAVASCRIPT
 *
 * This file contains vanilla JS scripts used in relation to public viewable web pages.
 * It contains all of the js code necessary to run / display the branding.
 *
 * @since   1.4.2
 * @version 3.1.0  added accessibility scripts.
 *
 */
/**
 * DOCUMENT READY
 *
 * Helper function that mimics jQuery document.load
 * {@link http://youmightnotneedjquery.com/#ready}
 */


function ready(fn) {
  if (document.readyState != 'loading'){
    fn();
  } else  {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

/**
 * GLOBAL VARIABLES
 */
// ASSETS
var ascss = udtheme_public_js_vars.ascss;
var asjs = udtheme_public_js_vars.asjs;
// ADMIN
var adcss = udtheme_public_js_vars.adcss;
var adjs = udtheme_public_js_vars.adjs;
// PUBLIC
var pucss = udtheme_public_js_vars.pucss;
var pujs = udtheme_public_js_vars.pujs;

/**
    * JAVASCRIPT FEATURE DETECTION
    * Checks for IE11 and Edge browsers
    * IntersectionObserver detection for Edge version >= 15
    * Loads MS browser based polyfills due to limited API support.
    * @return   mixed
  */
(function detectIE() {
  var isIE = ( ( /*@cc_on!@*/false ) || ( document.documentMode ) );
  var isEdge = ( !isIE ) && ( ( !!window.StyleMedia ) && ( window.IntersectionObserver ) );
  var isMS = [isIE, isEdge];

/**
   *  Instead of appending the elements directly to the document when they are
   *  created, append them to the DocumentFragment instead, and finish by adding
   *  that to the DOM.
   *  Now there's only one (big) DOM change happening, and because of that we're
   *  also keeping the recalculation, painting and layout to an absolute minimum.
   *
   *  @see https://coderwall.com/p/o9ws2g/why-you-should-always-append-dom-elements-using-documentfragments
   */
    var el;
    var i = 0;
    var fragment = document.createDocumentFragment();
    var polyIE = ["_core.js.shim.min", "_classList-polyfill", "svgxuse.min"];
    var arrayLength = polyIE.length;
  try {
    isIE;
  }
  catch( err ){
    console.log( 'Copy and paste this text in trouble ticket: ' + err );
  }

  if ( isMS ) {
    addClassMS();
    el = document.createElement( 'link' );
    el.type = 'text/css'
    el.rel = 'stylesheet'
    el.src = pucss + '/ie.css';
        fragment.appendChild( el );
  }
  else return false;

  if ( isIE ) {
    while ( i < arrayLength ) {
      el = document.createElement( 'script' );
      el.async = true
      el.defer = true
      el.src = asjs + '/' + polyIE[i] + '.js';
        fragment.appendChild( el );
    i++; }
  }
  else return false;
  if ( !isIE ) {
    var jsPromise = document.createElement('script')
        jsPromise.async = true
        jsPromise.src = asjs + '/_loader.js'
        fragment.appendChild( jsPromise );
  }
  else return false;
})();
/**
 * READY FUNCTIONS
 */
/**
 *  RESIZE EVENT FUNCTION CALL
 *  Adjust copyright text when window is < 720px
 */
ready( resizeEvent() );

/**
 *  ADD MS CLASS / LOAD IE CSS FUNCTION CALL
 */
ready( addClassMS() );

/**
 * DEVICE AND VIEWPORT SIZE JS
 *
 * Cross browser reliable and fast way of checking viewport widths.
 *
 * @since 3.1.0
 * @param  {[int]} decWidth [viewport width, no scrollbar]
 * @param  {[int]} wiwWidth [viewport width, scrollbar]
 * @return {[string]}        [Truncates 'University of Delaware' to 'UD' on smaller screens.]
 */
function resizeEvent() {
  var decWidth = document.documentElement.clientWidth;
  var crContainer = document.getElementById("udid_cr");
  var lnContainer = document.getElementById("udid_ln");
  var anContainer = document.getElementById("udid_an");

  if (decWidth < 719 ){
    crContainer.textContent = "UD";
    lnContainer.textContent = "Legal";
    anContainer.textContent = "Accessibility";
  }
  else {
    crContainer.textContent = "University of Delaware";
    lnContainer.textContent = "Legal Notices";
    anContainer.textContent = "Accessibility Notice";
  }
}


window.onresize = function() {
  resizeEvent();
};

/**
 * MS BROWSERS ADD CLASS JS
 *
 * Adds MS specific class to body to assist with MS browser specific styles.
 * Creates a link tag with ie.css
 *
 * @since 3.1.0
 * @param  {[int]} decWidth [viewport width, no scrollbar]
 * @param  {[int]} wiwWidth [viewport width, scrollbar]
 * @return {[string]}        [Adds MS specific classes to body tag.]
 */
function addClassMS() {
  document.body.classList.add( 'is_ms' );
} // end addClassMS()
// function winResize() {
//  var decWidth = document.documentElement.clientWidth;
//   var crContainer = document.querySelector( '.ud_copyright' );
//   var crText = crContainer.textContent;
//   var crTextMob = document.querySelector( '.ud_copyright' ).textContent.substring(0, 1) + document.querySelector( '.ud_copyright' ).textContent.substring(14,15);
//   if ( decWidth > 719 ) {
//     crText = document.querySelector( '.ud_copyright' ).textContent;
//     console.log('width:' + decWidth);
//     console.log('crtext:' + crText);
//   }
//   else {
//     crText = document.querySelector( '.ud_copyright' ).textContent = "UDZ";
//     console.log('width:' + decWidth);
//     console.log('crtextMob:' + crText);
//   }
//   console.log('tt' + document.querySelector( '.ud_copyright' ).textContent);
// }


  // clearTimeout(resizeTimeout)
  // resizeTimeout = setTimeout(removeViewportDimensions, 3000);
  //
function copyrightAdjust( decWidth ) {
  var wiwWidth = window.innerWidth;  // height of entire page content.




  // var copySpan = document.querySelectorAll( 'span.ud_copyright' ).textContent;
  // var copySpanSm = document.querySelectorAll( 'span.ud_copyright.sm' );
  // copySpan.classList.toggle( 'hidden', owidth < 720 );
  // copySpanSm.classList.toggle( 'hidden', owidth < 720 );
  // if ( owidth < 720 ) {
  //   udid_cr.classList.add.toggle();
  // }
}


(function () {
  var ua = navigator.userAgent.toLowerCase();
  if (ua.indexOf('safari') != -1) {
    if (!(ua.indexOf('chrome') > -1)) {

      // Safari only
      console.log("99 browsers and Safari's just one.");
      window.addEventListener("resize", function() {
        window.location.reload(false);
      }, false);
    }
  }
}());

  /**
  * INTERNET EXPLORER 6-11 FEATURE CHECK
  * @deprecated   3.1.0
  * @link bkup/deprecated_js/IE6-11.feature.check.js
  */
  /**
  * MICROSOFT EDGE FEATURE CHECK
  * @deprecated   3.1.0
  * @link bkup/deprecated_js/IE6-11.feature.check.js
  */

/**
 * FEATURE DETECTION CHECK FOR MS EDGE
 *
 * @link https://mobiforge.com/design-development/html5-pointer-events-api-combining-touch-mouse-and-pen
 */
if (window.PointerEvent) {
  //alert(' Pointer events are supported.');
}
