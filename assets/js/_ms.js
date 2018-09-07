/**
 * MICROSOFT BROWSER JAVASCRIPT
 *
 * This file contains vanilla JS scripts used in relation to
 * Microsoft browsers (IE 11, Edge > 15). It contains all of the js
 * code necessary to enable a friendly user experience where feature/functionality
 * support may not already be available.
 *
 * @since   3.1.0
 */
/**
  * FEATURE DETECTION
  * Checks for IE11 and Edge browsers
  * IntersectionObserver detection for Edge version >= 15
  *
  * @array    polyIE         [
  *                           _core.js.shim.min
  *                           _classList-polyfill   classList support for IE 11
  *                           svgxuse.min           svg support for IE 11
  *                          ]
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
   *  {@link https://coderwall.com/p/o9ws2g/why-you-should-always-append-dom-elements-using-documentfragments}
   */
    var el;
    var i = 0;
    var fragment = document.createDocumentFragment();
    var polyIE = ["_core.js.shim.min", "_classList-polyfill", "svgxuse.min"];
    // try _promise.js
    var arrayLength = polyIE.length;

  try {
    ie = navigator.userAgent.match( /(MSIE |Trident.*rv[ :])([0-9]+)/ )[ 2 ];
    isIE;
  }
  catch(err){
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


///////
// (function detectMS() {
//   try {
//     var isIE = /*@cc_on!@*/false || !!document.documentMode;
//     var isEdge = !isIE && !!window.StyleMedia;
//     return true;

//     var head = document.head
//      , link = document.createElement('link')
//      link.type = 'text/css'
//      link.rel = 'stylesheet'
//      link.href = 'https://www1.udel.edu/chris/!projects/UDformdev/deptforms/css/ie.css'
//      head.appendChild( link )
//   }
//   catch(e){
//     return false;
//     console.log("No MS CSS needed.")
//   }

//   try {
//     var isIE = /*@cc_on!@*/false || !!document.documentMode;
//     var isEdge = !isIE && !!window.StyleMedia;
//     return true;

//     var head = document.head
//      , link = document.createElement('link')
//      link.type = 'text/css'
//      link.rel = 'stylesheet'
//      link.href = 'https://www1.udel.edu/chris/!projects/UDformdev/deptforms/css/ie.css'
//      head.appendChild( link )
//   }
//   catch(e){
//     return false;
//     console.log("No MS CSS needed.")
//   }

//   var scriptEdge = document.createElement('script');
//   scriptEdge.async = true;
//   scriptEdge.src = "http://www.example.com/my-script.js";
//   target.appendChild(scriptEdge);
// })();


/**
 * CHECK FOR PROMISES SUPPORT
 *
 * IE 11 doesn't support documentMode so we load an ES6 polyfill.
 * @type {Boolean}
 * @return {}
 */
var documentModeSupported = false;
try {
  var options = Object.defineProperty({}, "documentmode", {
    get: function() {
      documentModeSupported = true;
      var head = document.head
     , link = document.createElement('script')
     link.type = 'text/javascript'
     link.rel = 'stylesheet'
     link.href = '"https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js" defer async'
     head.appendChild( link )
    }
  });

  window.addEventListener("test", null, options);
} catch(err) {}
