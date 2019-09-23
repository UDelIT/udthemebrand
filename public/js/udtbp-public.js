/**
 * PUBLIC JAVASCRIPT
 *
 * This file contains vanilla JS scripts used in relation to public viewable web pages.
 * It contains all of the js code necessary to run / display the branding.
 *
 * @since   1.4.2
 * @version 3.5.3
 */
/**
  * DOCUMENT READY
    * Helper function that mimics jQuery document.load
  * @link https://youmightnotneedjquery.com/#ready
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
    * Configured in wp_localize_scripts() so we can pass php data to javascript
 */
// ASSETS
var ascss = udtheme_public_js_vars.ascss;
var asjs  = udtheme_public_js_vars.asjs;
// ADMIN
var adcss = udtheme_public_js_vars.adcss;
var adjs  = udtheme_public_js_vars.adjs;
// PUBLIC
var pucss = udtheme_public_js_vars.pucss;
var pujs  = udtheme_public_js_vars.pujs;
/**
  * JAVASCRIPT FEATURE DETECTION
    * Checks for IE11 and Edge browsers
    * IntersectionObserver detection for Edge version >= 15
    * Loads MS browser based polyfills due to limited API support.
*/
(function detectIE() {
  var isIE = ( ( /*@cc_on!@*/false ) || ( document.documentMode ) );
  var isEdge = ( !isIE ) && ( ( !!window.StyleMedia ) && ( window.IntersectionObserver ) );
  var isMS = [isIE, isEdge];
/*
  * Instead of appending the elements directly to the document when they are
  * created, append them to the DocumentFragment instead, and finish by adding
  * that to the DOM.
  * Now there's only one (big) DOM change happening, and because of that we're
  * also keeping the recalculation, painting and layout to an absolute minimum.
  *
  * @link https://coderwall.com/p/o9ws2g/why-you-should-always-append-dom-elements-using-documentfragments
*/
  var el;
  var i = 0;
  var fragment = document.createDocumentFragment();
  var polyIE = ["_core.js.shim.min", "_classList-polyfill", "svgxuse1.min"];
  var arrayLength = polyIE.length;
  try {
    isIE;
  }
  catch( err ){
    console.log( 'Copy and paste this text in trouble ticket: ' + err );
  }

  if ( isIE && !isEdge ) {
    /**
      * ADD MS CLASS / LOAD IE CSS FUNCTION CALL
        * Adds a custom class to body tag for easier control of MS browsers
    */
    ready( addClassMS() );

    var head = document.head
        , link = document.createElement('link')
        link.type = 'text/css'
        link.rel = 'stylesheet'
        link.href = pucss + '/ie.css';
    head.appendChild( link )
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
  // if ( !isIE ) {
  //   var jsPromise = document.createElement('script')
  //       jsPromise.async = true
  //       jsPromise.src = asjs + '/_loader.js'
  //       fragment.appendChild( jsPromise );
  // }
  // else return false;
})();

/**
  * DEVICE AND VIEWPORT SIZE JS
    * Cross browser reliable and fast way of checking viewport widths.
 * @param          int       decWidth [viewport width, no scrollbar]
 * @param          int       wiwWidth [viewport width, scrollbar]
 * @return         string    [Truncates 'University of Delaware' to 'UD' on smaller screens.]
 * @since          3.1.0
 * @link           https://ryanve.com/lab/dimensions/
*/
function resizeEvent() {
  var clientWidth = document.documentElement.clientWidth;
  var crContainer = document.getElementById("udid_cr");
  var lnContainer = document.getElementById("udid_ln");
  var anContainer = document.getElementById("udid_an");

  /**
    * iOS RESIZE BUG FIX
      * Supposedly fixed in High Sierra 10.13.5
   * @link https://stackoverflow.com/questions/8898412/iphone-ipad-triggering-unexpected-resize-events/24212316#24212316
   * @link https://hackernoon.com/onresize-event-broken-in-mobile-safari-d8469027bf4d
  */
  // if (document.documentElement.clientWidth != clientWidth) {
  //   clientWidth = document.documentElement.clientWidth;
  if (clientWidth < 719 ){
    crContainer.textContent = "UD";
    lnContainer.textContent = "Legal";
    anContainer.textContent = "Accessibility";
  }
  else {
   crContainer.textContent = "University of Delaware";
   lnContainer.textContent = "Legal Notices";
   anContainer.textContent = "Accessibility Notice";
  }
  // }
}

/**
  * FIRE RESIZE METHOD ON WINDOW RESIZE JS
*/
window.onresize = function() {
  resizeEvent();
};

/**
  * MS BROWSERS ADD CLASS JS
    * Adds MS specific class to body to assist with MS browser specific styles.
 * @since 3.5.0
 */
function addClassMS() {
  document.body.classList.add( 'is_ms' );
} // end addClassMS()

/**
  * ALL OTHER BROWSERS ADD CLASS JS
    * Adds specific class to body to assist with plugin specific styles.
 * @since 3.5.0
 * ADD CLASS TO HTML
    * Adds specific class to html to hide CSS outline on a and button elements
 */
function addClassActive() {
  document.body.classList.add( 'udtbp_active' );
  document.documentElement.classList.add( 'no-focus--outline' );
} // end addClassActive()


// Listen to tab events to enable outlines (accessibility improvement)
document.body.addEventListener('keyup', function(e) {
  if ( e.which === 9 && document.documentElement.classList.contains( 'no-focus--outline' ) ) /* tab */ {
    document.documentElement.classList.remove('no-focus-outline');
  }
});


/**
  * DISPLAY CURRENT YEAR
 * @since          3.5.3
*/
function showYear() {
  var curYr = new Date().getFullYear();
  var it = document.getElementById('uid-date');
  it.insertAdjacentHTML('afterend', curYr);
  alert('me' + curYr);
}
/**
 * READY FUNCTIONS
 */
 /**
 *  SHOWYEAR FUNCTION CALL
 *  Dynamically display year in footer
 */
ready( showYear() );
/**
 *  RESIZE EVENT FUNCTION CALL
 *  Adjust copyright text when window is < 720px
 */
ready( resizeEvent() );

/**
 *  ADD ACTIVE AND FOCUS CLASSES FUNCTION CALL
 *  Adjust readability for accessibility and ensure plugin styles don't get
 *  overridden.
 */
ready( addClassActive () );
