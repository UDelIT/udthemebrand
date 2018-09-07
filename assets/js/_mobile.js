/**
  * LOADER JS
  * Plain JS module that loads CSS and JS files via JS Promises.
  * For IE 11 integration use _loader_ie.js
  * @since   3.1.0
*/
  /**
    * JAVASCRIPT FEATURE DETECTION
    * Checks for IE11 and Edge browsers
    * IntersectionObserver detection for Edge version >= 15
    * @return   mixed
  */
  // (function detectIE() {
  //   var isIE = ( /*@cc_on!@*/false ) || ( document.documentMode );
  //   var isEdge = ( !isIE ) && ( !!window.StyleMedia ) && ( window.IntersectionObserver );
  //   if ( ( isIE ) || ( isEdge ) ) {
  //     var head = document.head
  //     , link = document.createElement('link')
  //     link.type = 'text/css'
  //     link.rel = 'stylesheet'
  //     link.href = 'https://www1.udel.edu/chris/!projects/ITHF3/it/cs_s/assets/css/ie.css'
  //     head.appendChild( link )
  //   }
  //   else return false;
  // })();

(function detectIE() {
  var isIE = ( /*@cc_on!@*/false ) || ( document.documentMode );
  var isEdge = ( !isIE ) && ( !!window.StyleMedia ) && ( window.IntersectionObserver );
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
    ie = navigator.userAgent.match( /(MSIE |Trident.*rv[ :])([0-9]+)/ )[ 2 ];
    isIE;
  }
  catch( err ){
    console.log( 'Copy and paste this text in trouble ticket: ' + err );
  }

  if ( isMS ) {
    var head = document.head
      , link = document.createElement('link')
      link.type = 'text/css'
      link.rel = 'stylesheet'
      link.href = 'https://www1.udel.edu/chris/!projects/ITHF3/it/cs_s/assets/css/ie.css'
      head.appendChild( link )
  }
  else return false;

  if ( isIE ) {
    while ( i < arrayLength ) {
      el = document.createElement( 'script' );
      el.async = true
      el.defer = true
      el.src = 'https://www1.udel.edu/chris/!projects/ITHF3/it/cs_s/assets/js/' + polyIE[i] + '.js';
        fragment.appendChild( el );
    i++; }
  }
  else return false;
  if ( !isIE ) {
    var jsPromise = document.createElement('script')
        jsPromise.async = true
        jsPromise.src = 'https://www1.udel.edu/chris/!projects/ITHF3/it/cs_s/assets/js/_loader.js'
        fragment.appendChild( jsPromise );
  }
  else return false;
})();
