/**
 * ADMIN JAVASCRIPT
 *
 * This file contains all custom jQuery plugins and code used on
 * the plugin admin screens. It contains all of the js
 * code necessary to enable the custom controls used in the live
 * previewer.
 *
 * PLEASE NOTE: The following jQuery plugin dependencies are
 * required in order for this file to run correctly:
 *
 * 1. jQuery      ( http://jquery.com/ )
 *
 * @todo    separate into individual JS components.
 * @todo    migrate remaining jQuery to ES5-6.
 * @todo    Remove IE 11 support by 6/2019.
 *
 * @since   1.4.2
 * @version 3.5.2
 */

(function( $ ) {
  'use strict';

$(function() {
  var notify = $('p.notify');
  var adcss = udtheme_admin_js_vars.adcss;
  var adjs = udtheme_admin_js_vars.adjs;
  var plugin_name = udtheme_admin_js_vars.plugin_name;
  var Header = udtheme_admin_js_vars.Header;
  var header_id = udtheme_admin_js_vars.header_id;
  var header_site_title = udtheme_admin_js_vars.header_site_title;
  var Footer = udtheme_admin_js_vars.Footer;
  var footer_id = udtheme_admin_js_vars.footer_id;
  var footer_color = udtheme_admin_js_vars.footer_color;

  var button = $('#udtbp_form input[type="submit"]');
  var Off = 'off';
  var On = 'on';
  var appendNotify = $('#ud-id-ht');
  var vHead = document.getElementById('#udtbp_options[view-header]');

  var siteTitle = document.getElementById('udtbp_header_options[header-title]');
  var view_footer = document.getElementById('udtbp_footer_options[view-footer]');

  var rad_blue_footer = document.getElementById('rad_blue_footer');
  var rad_white_footer = document.getElementById('rad_white_footer');


  // @todo this is so hacky, needs to be cleaned up.
  $('.box-content').on( 'click', '.udt_yes_no_button', function(e){
    e.preventDefault();

    var $click_area = $(this),
    $box_content              = $click_area.parents('.box-content'),
    $checkbox                 = $box_content.find('input[type="checkbox"]'),
    $radio                    = $box_content.find('input[type="radio"]'),
    $state                    = $box_content.find('.udt_yes_no_button');

    $state.toggleClass('udt_on_state udt_off_state');
    if ( $checkbox.is(':checked' ) ) {
      // check if header visibility is not checked
      $checkbox.prop('checked', false, function(){
        if( $('#udtbp_theme_override').is(':visible')){
          $( '#udtbp_theme_override' ).addClass( 'hide').fadeOut( 'fast' );
        }
      });

    } else {
      $checkbox.prop('checked', true);
      $( '#udtbp_theme_override' ).removeClass( 'hide').fadeIn( 'fast' );
    }

    if ( $radio.is(':checked' ) ) {
      // check if header visibility is not checked
      $radio.prop('checked', false, function(){
        if( $('#udtbp_theme_override').is(':visible')){
          $( '#udtbp_theme_override' ).addClass( 'hide').fadeOut( 'fast' );
        }
      });

    } else {
      $radio.prop('checked', true);
      $( '#udtbp_theme_override' ).removeClass( 'hide').fadeIn( 'fast' );
    }
  });  // end box-content on()
}); // end function

/**
 * SUPPORT TAB DIALOG
 * @link  https://github.com/salmanarshad2000/demos/blob/v1.0.0/jquery-ui-dialog/size-to-fit-content.html
 */
  $(function() {
    $('#dialog').dialog({
      autoOpen: false,
      resizable: false,
      title: 'link of fixed navigation',
      width: 'auto',
      closeOnEscape : true,
      show: {
        effect: 'fade',
        duration: 1000
      },
      hide: {
        effect: 'fade',
        duration: 1000
      }
    }); // end dialog()
    $('.dialogify').on('click', function(e) {
      e.preventDefault();
      $('#dialog').html("<img src='" + $(this).prop("href") + "' width='" + $(this).attr("data-width") + "' height='" + $(this).attr("data-height") + "'>");
      $('#dialog').dialog(
        'option',
        'position', {
          my: 'center',
          at: 'center',
          of: window
      }); // end dialog()
      if ($('#dialog').dialog('isOpen') == false) {
        $('#dialog').dialog('open');
      }
    });
  }); // end $(function)


$(function() {
  /**
   * SAVE VIA AJAX
   *
   * @since  3.0.0
   * @link https://stackoverflow.com/questions/10873537/saving-wordpress-settings-api-options-with-ajax
   * @link https://www.wpoptimus.com/434/save-plugin-theme-setting-options-ajax-wordpress/
   */
  function save_main_options_ajax() {
    $( '#udtbp-ajax-saving' ).hide();
    $( '#udtbp_theme_override' ).removeClass( 'hide').fadeIn( 'fast' );
    $('#udtbp_form').submit( function () {
      // $( '#udtbp-ajax-saving' ).show('fast').fadeIn( 'fast', function() {
      //   $(this).delay(500).fadeOut( 'fast' );
      // });// fadeIn()
      var b =  $(this).serialize();

      $.post(
        'options.php', b
      )
      .fail(
        function( response ) {
          console.log( 'error' );
          $('#wpbody-content').prepend('<div class="error"><p>'+response.error_message+'</p></div>');
      })
      .done(
        function() {
          // itemsArray.push(hInput.value);
          // localStorage.setItem('items', JSON.stringify(itemsArray));
          // liMaker(hInput.value);
          // hInput.value = "";
          // var items = [];
          // items[0] = $('#rad_white_footer') == '';
          // items[1] = ftcolorinput.prop('disabled',true);
          // localStorage.setItem("items", JSON.stringify(items));
          $( '#udtbp-ajax-saving' ).fadeOut( 'fast' );
          $('#udtbp-ajax-message')
          .css('background-color', '#090')
          .html('<p class="modal_header" tabindex="0">Settings saved successfully</p>')
          .fadeIn('slow', function() {
            $(this).delay(700).fadeOut('slow');
          });
          console.log('success');
          var i;
          var text = "";

          for (i = 0; i < b.length; i+= 1) {
              text += b[i];
          }
            console.log(text + "\n");
          }
        ); // end done()
      return false;
    }); // end submit()
  } // end save_main_options_ajax()
  save_main_options_ajax();
}); // end $(function)

})( jQuery ); // end top function

/**********************************************/
/**
 * GLOBAL VARIABLES
 */
// ASSETS
var ascss = udtheme_admin_js_vars.ascss;
var asjs = udtheme_admin_js_vars.asjs;
// ADMIN
var adcss = udtheme_admin_js_vars.adcss;
var adjs = udtheme_admin_js_vars.adjs;
// PUBLIC
var pucss = udtheme_admin_js_vars.pucss;
var pujs = udtheme_admin_js_vars.pujs;

// function getStorage() {
//   var data = localStorage.getItem("radios");
//   localStorage.removeItem('setHeader');

//   if (data != null) {
//     getDisabled = localStorage.radios;
//   }
//   console.log("getStorage" + getDisabled);
// }




////////////// HELPER FUNCTIONS //////////////

/**
 * DOCUMENT READY
 *
 * Helper function that mimics jQuery document.load
 *
 * @since         3.5.0
 * @usage         ready(func());
 * @see       {@link https://youmightnotneedjquery.com/#ready}
 */
function ready(fn) {
  if (document.readyState != "loading"){
    fn();
  } else  {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

/**
 * QUERYSELECTOR ALL
 *
 * Helper function for selecting a list of matching elements, context is optional
 *
 * @since         3.5.0
 * @usage:        var matches = help_qsa(".foo .bar");
 *                var container = help_qs(".foo");
 *                var matches = help_qsa(".bar", container);
 *
 * {@link         https://plainjs.com/javascript/selecting/select-dom-elements-by-css-selector-4/}
 */
function help_qsa(selector, context) {
  return (context || document).querySelectorAll(selector);
}

/**
 * QUERYSELECTOR
 *
 * Helper function for selecting the first matching element only, context is optional
 *
 * @since         3.5.0
 * {@link         https://plainjs.com/javascript/selecting/select-dom-elements-by-css-selector-4/}
 */
function help_qs(selector, context) {
  return (context || document).querySelector(selector);
}

/**
 * HASATTRIBUTE POLYFILL
 *
 * Helper function for element has attribute check. Polyfill
 *
 * @since         3.5.0
 * {@link         https://developer.mozilla.org/en-US/docs/Web/API/Element/hasAttribute#Polyfill}
 */
;(function(prototype) {
    prototype.hasAttribute = prototype.hasAttribute || function(name) {
        return !!(this.attributes[name] &&
                  this.attributes[name].specified);
    }
})(Element.prototype);
////////////// END HELPER FUNCTIONS //////////////


/**
  * JAVASCRIPT FEATURE DETECTION
  * Checks for IE11 and Edge browsers
  * IntersectionObserver detection for Edge version >= 15
  * Loads MS browser based polyfills due to limited API support.
  *
  * @since         [3.0.4]
  * @version       [3.5.2] Removed fetch and promise polyfills, not used won't use
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
  var polyIE = ["_core.js.shim.min", "_classList-polyfill", "svgxuse1.min"];
  var arrayLength = polyIE.length;

  try {
    isIE;
  }
  catch( err ){
    console.log( "Copy and paste this text in trouble ticket: " + err );
  }

  if ( isIE && !isEdge ) {
    /**
    *  ADD MS CLASS / LOAD IE CSS FUNCTION CALL
    */
    ready( addClassMS() );

    var head = document.head
        , link = document.createElement("link")
        link.type = "text/css"
        link.rel = "stylesheet"
        link.href = pucss + "/udtbp-ie-admin.css";
    head.appendChild( link )
  }
  else return false;


  if ( isIE ) {
    while ( i < arrayLength ) {
      el = document.createElement( "script" );
      el.async = true
      el.defer = true
      el.src = asjs + "/" + polyIE[i] + ".js";
        fragment.appendChild( el );
    i++; }
  }
  else return false;
  // if ( !isIE && !isEdge ) {
  //   alert();
  //   var jsPromise = document.createElement("script")
  //       jsPromise.async = true
  //       jsPromise.src = asjs + "/_loader.js"
  //       fragment.appendChild( jsPromise );
  // }
  // else return false;
})();

/**
 * BODY ADD CLASS - MS BROWSERS JS
 *
 * Checks if clients are using  Microsoft browsers, if true then a class is added
 * to the body.
 *
 * @since         3.5.0
 */
function addClassMS() {
  document.body.classList.add( "is_ms" );
} // end addClassMS()

/**
 * BODY ADD CLASS - BRANDING PLUGIN JS
 *
 * If plugin is active then a plugin specific class is added
 * to the body. This reduces the risk of specificity issues.
 *
 * @since         3.5.0
 */
function addClassPlugin() {
  document.body.classList.add( "udtbp_active" );
} // end addClassPlugin()

ready(addClassPlugin());



// var cfls = localStorage.getItem("cf");
//   if(!cfls) {return false;}
//   if(cfls !="){
//       document.getElementById("ud-id-cf").classList.add(cfls);
//   } else {
//       document.getElementById("ud-id-cf").classList.remove(cfls);
//   }
/**
 * VISIBILITY CHECKBOX TOGGLE SWITCH
 * Assigns related display text and ARIA checked attributes
 * IE 11 doesn't support .forEach so we borrow the method from Array.prototype as a polyfill.
 */

var udARIA = {};//udtbp_theme_override
var s = document.querySelectorAll(".ud-switch, .switch, .save-button");
Array.prototype.forEach.call(s, function(elem) {
  elem.addEventListener("click", handleClickEvent, false);
  elem.addEventListener("change", handleChangeEvent, false);
  elem.addEventListener("keypress", udARIA.keyEvents, false);
});

function handleClickEvent(evt) {

  var clsb     = document.querySelector(".save-button");
  var pressed = clsb.getAttribute("aria-pressed") === "true";
  clsb.setAttribute("aria-pressed", String(!pressed));
// console.log("s" + s);
//   var el = evt.target;

Array.prototype.forEach.call(s, function(item, i){
  // if (  (item.hasAttribute("aria-pressed"))  && (item.type = "button") ) {
  //   item.setAttribute("aria-pressed", "true");
  // }
  // if (item.type = "button"){
  //   item.setAttribute("aria-pressed", true);
  // }
  // if (!item.type = "button"){
  //   item.setAttribute("aria-pressed", false);
  // }
  //item.setAttribute("id", array[i]);
});

}

// var matches = help_qsa('.color-on svg');
// var container = help_qs('.foo');
//var matches = help_qsa('.bar', container);

function handleChangeEvent() {
  // global elements
  var clAxOn   = help_qs(".color-on");
  var clSvgOn  = document.getElementById("svg_on");
  var clAxOff  = help_qs(".color-off");
  var clSvgOff = document.getElementById("svg_off");

  // header elements
  var idVhcb   = document.getElementById("udtbp_header_options[view-header]");
  var idVh     = document.getElementById("ud-id-vh");
  var idHt     = document.getElementById("udtbp_header_options[header-title]");

  // footer elements
  var idVfcb   = document.getElementById("udtbp_footer_options[view-footer]");
  var idVf     = document.getElementById("ud-id-vf");
  var idCf     = document.getElementById("ud-id-cf");
  var idCf     = document.getElementById("ud-id-cf");
  var radios   = help_qsa("udtbp_footer_options[color-footer] input"), i = radios.length;

  // let itemsArray = localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : [];
  // localStorage.setItem('items', JSON.stringify(itemsArray));
  // var data = JSON.parse(localStorage.getItem('items'));

  if (idVfcb) {
    if (idVfcb.checked) {
      idVfcb.setAttribute("aria-checked", "true");
      idVf.classList.remove("color-off");
      idVf.classList.add("color-on");
      clSvgOn.classList.add("visible");
      clSvgOff.classList.remove("visible");
      // sibling.textContent = "ON";
      idCf.classList.remove("disabled");
      localStorage.setItem("vf_ls", idVfcb.checked);
      localStorage.setItem("cf", "on");
    }
    else {
      idVf.classList.add("color-off");
      idVf.classList.remove("color-on");
      clSvgOn.classList.remove("visible");
      clSvgOff.classList.add("visible");
      // sibling.textContent = "OFF";
      idCf.classList.add("disabled");

      localStorage.removeItem("cf", "on");
      localStorage.setItem("radios", JSON.stringify(radios));
    }

    if (document.getElementById("rad_blue_footer").checked) {
      idCf.classList.add("blue");
      idCf.classList.remove("white");
    }
    else if (document.getElementById("rad_white_footer").checked) {
      idCf.classList.remove("blue");
      idCf.classList.add("white");
    }
    else {
      idCf.classList.add("disabled");

    }



      while (i--) {
        radios[i].disabled = true;
      }
  }

  if (idVhcb) {
    if (idVhcb.checked) {
      idVhcb.setAttribute("aria-checked", "true");
      idVh.classList.remove("color-off");
      idVh.classList.add("color-on");
      clSvgOn.classList.add("visible");
      clSvgOff.classList.remove("visible");
      // sibling.textContent = "ON";
      idHt.classList.remove("disabled");
      idHt.removeAttribute("disabled");
      //localStorage.setItem("vh_ls", idVhcb.checked);
      //localStorage.setItem("ht", "on");
    }
    else {
      idVhcb.setAttribute("aria-checked", "false");
      idVh.classList.add("color-off");
      idVh.classList.remove("color-on");
      clSvgOn.classList.remove("visible");
      clSvgOff.classList.add("visible");
      // sibling.textContent = "OFF";
      idHt.classList.add("disabled");
      idHt.setAttribute("disabled", "true");

      // var radios = document.querySelectorAll("udtbp_footer_options[color-footer] input"), i = radios.length;
      // while (i--) {
      //   radios[i].disabled = true;
      // }

      localStorage.removeItem("ht", "on");
      localStorage.setItem("radios", JSON.stringify(radios));
    }
  }
}



// function ariaPressed() {
//   var toggle = document.querySelector('.save-button');

//   toggle.addEventListener('click', function (e) {
//     e.stopPropagation();
//     e.preventDefault();
//     var pressed = e.target.getAttribute('aria-pressed') === 'true';
//     e.target.setAttribute('aria-pressed', String(!pressed));
//   });
// }

/**
 * Attach keyEvents to toggle buttons
*/
udARIA.keyEvents = function (el) {
  var keyCode = el.keyCode || el.which;
/**
  * Map appropriate key commands to non button elements acting like buttons.
  * 9  = tab
  * 13  = enter
  * 32  = spacebar
  * 37  = arrow left
  * 38  = arrow up
  * 39  = arrow right
  * 40  = arrow down

  *
*/
  if (el.target.tagName !== 'BUTTON') {
    switch (keyCode) {
      case 32:
      case 13:
        el.stopPropagation();
        el.preventDefault();
        el.target.click();
        break;

      default:
        break;
    }
  }
};


ready(handleChangeEvent);
ready(udARIA.keyEvents);
/**
  * FOCUS WITHIN POLYFILL
  *
  * @since  3.5.0
  * @link https://gist.github.com/aFarkas/a7e0d85450f323d5e164
  */

 !function(t,e){"use strict";var i,n,s,c=[].slice,a=function(t){t.classList.remove("focus-within")},o=(s=function(){var t=e.activeElement;if(i=!1,n!==t)for(n=t,c.call(e.getElementsByClassName("focus-within")).forEach(a);t&&t.classList;)t.classList.add("focus-within"),t=t.parentNode},function(){i||(requestAnimationFrame(s),i=!0)});e.addEventListener("focus",o,!0),e.addEventListener("blur",o,!0),o()}(window,document);

(function ( w, doc, undefined ) {
  'use strict';
  var A11YswitchCheck;

  A11YswitchCheck = function ( ) {
    /**
     * Author: Scott O'Hara
     * Version: 0.1.0
     * License: https://github.com/scottaohara/a11y_styled_form_controls/blob/master/LICENSE
     */
    var el;

    /**
     * Initialize the instance, run all setup functions
     * and attach the necessary events.
     */
    this.init = function ( elm ) {
      el = elm;
      setRole ( el );
      attachEvents ( el );
    };

    /**
     * Check default state of element:
     * A toggle button is not particularly useful without JavaScript,
     * so ideally such a button would be set to hidden or disabled, if JS wasn't
     * around to make it function.
     */
    var setRole = function ( el ) {
      if ( el.getAttribute('type') === 'checkbox' ) {
        el.setAttribute('role', 'switch');
      }
      else {
        console.error(el.id + ' is not a checkbox...')
      }
    };

    /**
     * Attach keyEvents to toggle buttons
     *
     */
    var keyEvents = function ( e ) {
      var keyCode = e.keyCode || e.which;

      switch ( keyCode ) {
        case 13:
          e.preventDefault();
          e.target.click();
        break;
      }
    };

    /**
     * Events for toggle buttons
     */
    var attachEvents = function ( el ) {
      el.addEventListener('keypress', keyEvents, false);
    };

    return this;
  }; // A11YswitchCheck()

  w.A11YswitchCheck = A11YswitchCheck;
})( window, document );

/**
  * SWITCH CHECKBOX
  *
  * @since  3.5.0
  * Author: Scott O'Hara
  * Version: 0.1.0
  * License: https://github.com/scottaohara/a11y_styled_form_controls/blob/master/LICENSE
*/
!function(t,e,i){"use strict";var c;c=function(){var t;this.init=function(i){e(t=i),c(t)};var e=function(t){"checkbox"===t.getAttribute("type")?t.setAttribute("role","switch"):console.error(t.id+" is not a checkbox...")},i=function(t){switch(t.keyCode||t.which){case 13:t.preventDefault(),t.target.click()}},c=function(t){t.addEventListener("keypress",i,!1)};return this},t.A11YswitchCheck=c}(window,document);

/**
  * SWITCH TOGGLE BUTTONS
  *
  * @since  3.5.0
  * Author: Scott O'Hara
  * Version: 0.1.0
  * License: https://github.com/scottaohara/a11y_styled_form_controls/blob/master/LICENSE
*/
// !function(t,e,i){"use strict";var s;s=function(){var t;this.init=function(e){i(t=e),s(t),a(t),n(t),r(t),o(t)};var i=function(t){"disabled"!==t.getAttribute("data-toggle-btn")&&t.removeAttribute("disabled"),t.removeAttribute("hidden")},s=function(t){t.hasAttribute("aria-pressed")||t.setAttribute("aria-pressed",t.hasAttribute("data-toggle-btn-pressed"))},a=function(t){"BUTTON"!==t.tagName&&(t.setAttribute("role","button"),t.hasAttribute("href")||t.hasAttribute("disabled")||(t.tabIndex=0))},r=function(t){var i=t.querySelector("[data-toggle-btn-ui]")||t.querySelector(".toggle-switch__ui");if(!i){var s=e.createElement("span");t.appendChild(s),i=t.querySelector("span")}i.classList.contains("toggle-switch__ui")||i.classList.add("toggle-switch__ui"),i.setAttribute("aria-hidden","true")},n=function(t){t.classList.contains("toggle-switch")||t.classList.add("toggle-switch"),(t.hasAttribute("data-switch-btn-labels")||t.classList.contains("toggle-switch--labels"))&&t.classList.add("toggle-switch--labels")},c=function(t){this.setAttribute("aria-pressed","true"===this.getAttribute("aria-pressed")?"false":"true")},u=function(t){var e=t.keyCode||t.which;if("BUTTON"!==t.target.tagName)switch(e){case 32:case 13:t.stopPropagation(),t.preventDefault(),t.target.click()}},o=function(t){t.addEventListener("click",c,!1),t.addEventListener("keypress",u,!1)};return this},t.A11yToggleButton=s}(window,document);
// (function ( w, doc, undefined ) {
//   'use strict';
//   var A11yToggleButton;

//   A11yToggleButton = function ( ) {
//     /**
//      * Author: Scott O'Hara
//      * Version: 0.1.0
//      * License: https://github.com/scottaohara/a11y_styled_form_controls/blob/master/LICENSE
//      */
//     var el;

//     /**
//      * Initialize the instance, run all setup functions
//      * and attach the necessary events.
//      */
//     this.init = function ( elm ) {
//       el = elm;
//       checkState ( el );
//       setPressed ( el );
//       setButton ( el );
//       setClasses ( el );
//       setSwitchUI ( el );
//       attachEvents ( el );
//     };

//     /**
//      * Check default state of element:
//      * A toggle button is not particularly useful without JavaScript,
//      * so ideally such a button would be set to hidden or disabled, if JS wasn't
//      * around to make it function.
//      */
//     var checkState = function ( el ) {
//       // Unless a toggle button is specifically meant to be disabled,
//       // when JS is available, remove the disabled attribute so these
//       // buttons can be used.
//       if ( el.getAttribute('data-toggle-btn') !== "disabled" ) {
//         el.removeAttribute('disabled');
//       }

//       // reveal any hidden instances
//       el.removeAttribute('hidden');
//     };

//     /**
//      * A toggle button won't register as a toggle button if an aria-pressed
//      * isn't present prior to user interaction.
//      *
//      * e.g. a button that is pressed, and then acquires an aria-pressed='true'
//      * attribute will NOT always be announced as a toggle button.
//      *
//      * Check for the presence of aria-pressed and if not there, run additional
//      * checks to determine if this button should be set to true or false by default.
//      */
//     var setPressed = function ( el ) {
//       if ( !el.hasAttribute('aria-pressed') ) {
//         el.setAttribute('aria-pressed', el.hasAttribute('data-toggle-btn-pressed'))
//       }
//     }

//     /**
//      * Enhance elements to buttons
//      * If the element is not a button, then add a role button.
//      * If it is not an a[href], or already have a tabindex, then
//      * provide a tabindex=0 so it can be keyboard focusable.
//      */
//     var setButton = function ( el ) {
//       if ( el.tagName !== 'BUTTON' ) {
//         el.setAttribute('role', 'button');

//         if ( !el.hasAttribute('href') && !el.hasAttribute('disabled') ) {
//           el.tabIndex = 0;
//         }
//       }
//     }

//     /**
//      * Create Switch UI
//      * If a button is missing an inner element to
//      * wrap the accessible name and serve as the
//      * basis for the switch UI, then create a span
//      * and append it to the button element.
//      */
//     var setSwitchUI = function ( el ) {
//       var switchUI = el.querySelector('[data-toggle-btn-ui]') || el.querySelector('.toggle-switch__ui');

//       if ( !switchUI ) {
//         var newUI = doc.createElement('span');
//         el.appendChild(newUI);
//         switchUI = el.querySelector('span');
//       }

//       if ( !switchUI.classList.contains('toggle-switch__ui') ) {
//         switchUI.classList.add('toggle-switch__ui');
//       }

//       // after confirming a switchUI element exists:
//       switchUI.setAttribute('aria-hidden', 'true');
//     };

//     /**
//      * Setup the classes for the toggle buttons
//      */
//     var setClasses = function ( el ) {
//       // if the default class for this component doesn't exist, add it
//       if ( !el.classList.contains('toggle-switch') ) {
//         el.classList.add('toggle-switch');
//       }

//       // if a switch ui should display the text 'on' and 'off'
//       if ( el.hasAttribute('data-switch-btn-labels') || el.classList.contains('toggle-switch--labels') ) {
//         el.classList.add('toggle-switch--labels');
//       };
//     }

//     /**
//      * Toggle the Button's state (aria-pressed=t/f)
//      */
//     var toggleState = function ( e ) {
//       this.setAttribute('aria-pressed', this.getAttribute('aria-pressed') === 'true' ? 'false' : 'true');
//     };

//     /**
//      * Attach keyEvents to toggle buttons
//      */
//     var keyEvents = function ( e ) {
//       var keyCode = e.keyCode || e.which;

//       /**
//        * If the element is not a real button, then
//        * map the appropriate key commands.  If it is,
//        * well buttons' already know how to do this then :)
//        */
//       if ( e.target.tagName !== 'BUTTON' ) {
//         switch ( keyCode ) {
//           case 32:
//           case 13:
//             e.stopPropagation();
//             e.preventDefault();
//             e.target.click();
//             break;

//           default:
//             break;
//         }
//       }
//     };

//     /**
//      * Events for toggle buttons
//      */
//     var attachEvents = function ( el ) {
//       el.addEventListener('click', toggleState, false);
//       el.addEventListener('keypress', keyEvents, false);
//     };

//     return this;
//   }; // A11yToggleButton()

//   w.A11yToggleButton = A11yToggleButton;
// })( window, document );

// some other file.js
// var selector = '[data-switch-btn]';
// var elList = document.querySelectorAll(selector);
// var i;
// for ( i = 0; i < elList.length; i++ ) {
//   var a11ybtn = new A11yToggleButton();
//   a11ybtn.init( elList[i] );
// };


// checkbox
// var selector = '[data-check-switch]';
// var elList = document.querySelectorAll(selector);
// var i;
// for ( i = 0; i < elList.length; i++ ) {
//   var a11ySwitch = new A11YswitchCheck();
//   a11ySwitch.init( elList[i] );
// };







// const btns = document.querySelectorAll('.btn');

// const getBtnState = function (radio) {
//   [].forEach.call(radio, function(radios) {
//     if (window.localStorage.getItem(radios.id) == 'disabled') {
//       radios.disabled = true
//     }
//   })
// };

  /*
* @function toggleCheckBox
*
* @desc Toogles the state of a checkbox and updates image indicating state based on aria-checked values
*
* @param   {Object}  event  -  Standard W3C event object
*
*/

// function toggleCheckbox(event) {

//   var node = event.currentTarget
//   var image = node.getElementsByTagName('img')[0]

//   var state = node.getAttribute('aria-checked').toLowerCase()

//   if (event.type === 'click' ||
//       (event.type === 'keydown' && event.keyCode === 32)
//       ) {
//           if (state === 'true') {
//             node.setAttribute('aria-checked', 'false')
//             image.src = 'https://www.w3.org/TR/2016/WD-wai-aria-practices-1.1-20160317/examples/checkbox/images/checkbox-unchecked-black.png'
//           }
//           else {
//             node.setAttribute('aria-checked', 'true')
//             image.src = 'https://www.w3.org/TR/2016/WD-wai-aria-practices-1.1-20160317/examples/checkbox/images/checkbox-checked-black.png'
//           }

//     event.preventDefault()
//     event.stopPropagation()
//   }

// }

/*
* @function focusCheckBox
*
* @desc Adds focus to the class name of the checkbox
*
* @param   {Object}  event  -  Standard W3C event object
*/

// function focusCheckbox(event) {
//   event.currentTarget.className += ' focus'
// }

/*
* @function blurCheckBox
*
* @desc Adds focus to the class name of the checkbox
*
* @param   {Object}  event  -  Standard W3C event object
*/

function blurCheckbox(event) {
  event.currentTarget.className = event.currentTarget.className .replace(' focus','')
}

/**
 * ACCESSIBILITY SCRIPTS
 * @link https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_switch_role
 * {@todo migrate if statement into helper function.}
 * IE 11 doesn't support .forEach so we borrow the method from Array.prototype as a polyfill.
 */


/**
 * STANDARD ARIA TABS
 *
 * @link https://codepen.io/jeffsmith/pen/YqrzOa
 */
/*
    We used the thorough analysis and scripting of Jason Kiss for these ARIA tabs.
    See Accessible ARIA Tabs: http:// www.accessibleculture.org/articles/2010/08/aria-tabs/
    for his analysis, examples and conclusions. Thanks, Jason!
*/
// function ariaTabs() {
//   var tabs = $("#udt_panel_mainmenu");

//   // For each individual tab DIV, set class and aria role attributes, and hide it
//   $(tabs).find("> #postbox-container-2").attr({
//       "class": "tabPanel",
//       "role": "tabpanel",
//       "aria-hidden": "true"
//   }).hide();

//   // Get the list of tab links
//   var tabsList = tabs.find("ul:first").attr({
//       "class": "tabsList",
//       "role": "tablist"
//   });

//   // For each item in the tabs list...
//   $(tabsList).find("li > a").each(
//       function(a){
//           var tab = $(this);

//           // Create a unique id using the tab link's href
//           var tabId = "tab-" + tab.attr("href").slice(1);

//           // Assign tab id, aria and tabindex attributes to the tab control, but do not remove the href
//           tab.attr({
//               "id": tabId,
//               "role": "tab",
//               "aria-selected": "false",
//               "tabindex": "-1"
//           }).parent().attr("role", "presentation");

//           // Assign aria attribute to the relevant tab panel
//           $(tabs).find(".tabPanel").eq(a).attr("aria-labelledby", tabId);

//           // Set the click event for each tab link
//           tab.click(
//               function(e){
//                   // Prevent default click event
//                   e.preventDefault();

//                   // Change state of previously selected tabList item
//                   $(tabsList).find("> li.current").removeClass("current").find("> a").attr({
//                       "aria-selected": "false",
//                       "tabindex": "-1"
//                   });

//                   // Hide previously selected tabPanel
//                   $(tabs).find(".tabPanel:visible").attr("aria-hidden", "true").hide();

//                   // Show newly selected tabPanel
//                   $(tabs).find(".tabPanel").eq(tab.parent().index()).attr("aria-hidden", "false").show();

//                   // Set state of newly selected tab list item
//                   tab.attr({
//                       "aria-selected": "true",
//                       "tabindex": "0"
//                   }).parent().addClass("current");
//                   tab.focus();
//               }
//           );
//       }
//   );

//   // Set keydown events on tabList item for navigating tabs
//   $(tabsList).delegate("a", "keydown",
//       function (e) {
//           var tab = $(this);
//           switch (e.which) {
//               case 37: case 38:
//                   if (tab.parent().prev().length!=0) {
//                       tab.parent().prev().find("> a").click();
//                   } else {
//                       $(tabsList).find("li:last > a").click();
//                   }
//                   break;
//               case 39: case 40:
//                   if (tab.parent().next().length!=0) {
//                       tab.parent().next().find("> a").click();
//                   } else {
//                       $(tabsList).find("li:first > a").click();
//                   }
//                   break;
//           }
//       }
//   );

//   // Show the first tabPanel
//   $(tabs).find(".tabPanel:first").attr("aria-hidden", "false").show();

//   // Set state for the first tabsList li
//   $(tabsList).find("li:first").addClass("current").find(" > a").attr({
//       "aria-selected": "true",
//       "tabindex": "0"
//   });
// };

/**
 * FEATURE DETECTION CHECK FOR MS EDGE
 *
 * @link https://mobiforge.com/design-development/html5-pointer-events-api-combining-touch-mouse-and-pen
 */
if (window.PointerEvent) {
  //alert(' Pointer events are supported.');
}
