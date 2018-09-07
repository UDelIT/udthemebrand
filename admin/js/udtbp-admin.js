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
 * @since   1.4.2
 * @version 3.1.0  added accessibility scripts.
 * @todo this file should be the base from which all other JS components are added.
 */
(function( $ ) {
  'use strict';

/**
 * ARIA Dialog Example (Modal)
 *
 * @link
 */


$(function() {
  // previous JS that controls radio sliders, localStorage etc.

  var groupInput = $('.grey-main input[type="radio"]');
  var hdstateinput = $('#header-state input[type="radio"]');
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
  var block = udtheme_admin_js_vars.block;
  var blank = udtheme_admin_js_vars.blank;
  var hdblank = $( header_id ).add( blank, Header );
  var hdblock = $('#' + header_id + block + 'Header');
  var switch_selection = $('.switch-selection');
  var footerText = 'Footer';
  var ftblank = $('#' + plugin_name + '-blankFooter');
  var ftblock = $('#' + plugin_name + '-blockFooter');
  var ftcolorh3 = $('#footer-color h3 ');
  var ftcolorsmall = $('#footer-color small');
  var ftcolor = $('#footer-color');
  var ftstateinput = $('#footer-state > input');
  var ftcolorinput =$('#footer-color > input');//input[name="sb_bar_footer_options[color-footer]"]');
  var ftError ='';

  var button = $('#udtbp_form input[type="submit"]');
  var Off = 'off';
  var On = 'on';
  var siteTitle = document.getElementById('udtbp_header_options[header-title]');
  var view_footer = document.getElementById('udtbp_footer_options[view-footer]');
  var vHead = $('#udtbp_options[view-header]')

  // SELECT TEXT WHEN FIELD IS FOCUSED
  // Used for Site Title field

  // document.getElementById("udtbp_header_options[header-title]").focus().value('');

  //   $('#udtbp_header_options[header-title]').on('keydown', function(e) {
  //       if( !/[a-z]|[A-Z]/.test( String.fromCharCode( e.which ) ) )
  //           return false;
  //   });

  vHead.on('change',function(){
    // http://stackoverflow.com/questions/8622336/jquery-get-value-of-selected-radio-button
    var selectedVal = "";
    var selected = vHead.checked;
    if (selected) {
      selectedVal = 1;
      localStorage.setItem('setHeader', 1);
    }
    else {
      selectedVal = 0;
      localStorage.removeItem('setHeader');
    }
  }); // end vHead on()



  // get localStorage value of footer color

  function loco() {
    var data = localStorage.getItem("items");
    localStorage.removeItem('setHeader');

    if (data != null) {
      ftcolorinput.prop("disabled", true);
    }
    console.log(data);
  };

  // STORE DATA ARRAY IN LOCALSTORAGE
  // http://stackoverflow.com/questions/3357553/how-to-store-an-array-in-localstorage
  var setClass = JSON.parse(localStorage.getItem('setClass')) || {};
  $.each(
    setClass, function() {
      $(this.selector).addClass(this.className);
    }
  );
  var addClassToLocalStorage = function(selector, className) {
    setClass[selector + ':' + className] = {
      selector: selector,
      className: className
    };
    localStorage.setItem('setClass', JSON.stringify(setClass));
  };
  var removeClassFromLocalStorage = function(selector, className) {
    delete setClass[selector + ':' + className];
    localStorage.setItem('setClass', JSON.stringify(setClass));
  };

  $('.box-content').on( 'click', '.udt_yes_no_button', function(e){
    e.preventDefault();

    var $click_area = $(this),
      $box_content              = $click_area.parents('.box-content'),
      $checkbox                 = $box_content.find('input[type="checkbox"]'),
      $radio                    = $box_content.find('input[type="radio"]'),
      $state                    = $box_content.find('.udt_yes_no_button');
      //$header_site_title       = $box_content.find('input[type=');

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

    /**********************************************/



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
          $( '#udtbp-ajax-saving' ).fadeOut( 'fast' );
          console.log('success');
          $('#udtbp-ajax-message')
          .css('background-color', '#090')
          .html('<p class="modal_header" tabindex="0">Settings saved successfully</p>')
          .fadeIn('slow', function() {
            $(this).delay(700).fadeOut('slow');
          });
          console.log('success');
        }
      ); // end done()
      return false;
    }); // end submit()
  } // end save_main_options_ajax()
    save_main_options_ajax();
}) // end $(function)

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
      'closeOnEscape' : true,
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
  }) // end $(function)
})( jQuery );




// http://youmightnotneedjquery.com/#ready
function ready(fn) {
  if (document.readyState != 'loading'){
    fn();
  } else if (document.addEventListener) {
    document.addEventListener('DOMContentLoaded', fn);
  } else {
    document.attachEvent('onreadystatechange', function() {
      if (document.readyState != 'loading')
        fn();
    });
  }
}


ready(function(){
  var isIE = ( ( /*@cc_on!@*/false ) || ( document.documentMode ) );
  var isEdge = ( !isIE ) && ( ( !!window.StyleMedia ) && ( window.IntersectionObserver ) );
  var isMS = [isIE, isEdge];

  if ( owidth < 720 ) {
    hideonMobile();
  }
});

/**
 * GLOBAL VARIABLES
 */
// ASSETS
var ascss = udtheme_admin_js_vars.ascss;
var asjs = udtheme_admin_js_vars.asjs;
// ADMIN
var adcss = udtheme_admin_js_vars.adcss;
var adjs = udtheme_admin_js_vars.adjs;

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
 * MS BROWSERS ADD CLASS JS
 *
 * Cross browser reliable and fast way of checking viewport widths.
 *
 * @since 3.1.0
 * @param  {[int]} decWidth [viewport width, no scrollbar]
 * @param  {[int]} wiwWidth [viewport width, scrollbar]
 * @return {[string]}        [Adds MS specific classes to body tag.]
 */
function addClassMS() {
  document.body.classList.add( 'is_ms' );
} // end addClassMS()

/**
 * ACCESSIBILITY SCRIPTS
 * @link https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_switch_role
 * @todo migrate if statement into helper function.
 * IE 11 doesn't support .forEach so we borrow the method from Array.prototype as a polyfill.
 */

var switchComp = document.querySelectorAll(".switch, .save-button");

Array.prototype.forEach.call(switchComp, function(theSwitch) {
  theSwitch.addEventListener("click", handleClickEvent, false);
});

function handleClickEvent(evt) {
  let el = evt.target;

  if ( (el.getAttribute("aria-checked") == "true") || (el.getAttribute("aria-pressed") == "true") ){
      el.setAttribute("aria-checked", "false");
      el.getAttribute("aria-pressed", "false");
  } else {
      el.setAttribute("aria-checked", "true");
      el.setAttribute("aria-pressed", "true");
  }
}

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
function ariaTabs() {
  var tabs = $("#udt_panel_mainmenu");

  // For each individual tab DIV, set class and aria role attributes, and hide it
  $(tabs).find("> #postbox-container-2").attr({
      "class": "tabPanel",
      "role": "tabpanel",
      "aria-hidden": "true"
  }).hide();

  // Get the list of tab links
  var tabsList = tabs.find("ul:first").attr({
      "class": "tabsList",
      "role": "tablist"
  });

  // For each item in the tabs list...
  $(tabsList).find("li > a").each(
      function(a){
          var tab = $(this);

          // Create a unique id using the tab link's href
          var tabId = "tab-" + tab.attr("href").slice(1);

          // Assign tab id, aria and tabindex attributes to the tab control, but do not remove the href
          tab.attr({
              "id": tabId,
              "role": "tab",
              "aria-selected": "false",
              "tabindex": "-1"
          }).parent().attr("role", "presentation");

          // Assign aria attribute to the relevant tab panel
          $(tabs).find(".tabPanel").eq(a).attr("aria-labelledby", tabId);

          // Set the click event for each tab link
          tab.click(
              function(e){
                  // Prevent default click event
                  e.preventDefault();

                  // Change state of previously selected tabList item
                  $(tabsList).find("> li.current").removeClass("current").find("> a").attr({
                      "aria-selected": "false",
                      "tabindex": "-1"
                  });

                  // Hide previously selected tabPanel
                  $(tabs).find(".tabPanel:visible").attr("aria-hidden", "true").hide();

                  // Show newly selected tabPanel
                  $(tabs).find(".tabPanel").eq(tab.parent().index()).attr("aria-hidden", "false").show();

                  // Set state of newly selected tab list item
                  tab.attr({
                      "aria-selected": "true",
                      "tabindex": "0"
                  }).parent().addClass("current");
                  tab.focus();
              }
          );
      }
  );

  // Set keydown events on tabList item for navigating tabs
  $(tabsList).delegate("a", "keydown",
      function (e) {
          var tab = $(this);
          switch (e.which) {
              case 37: case 38:
                  if (tab.parent().prev().length!=0) {
                      tab.parent().prev().find("> a").click();
                  } else {
                      $(tabsList).find("li:last > a").click();
                  }
                  break;
              case 39: case 40:
                  if (tab.parent().next().length!=0) {
                      tab.parent().next().find("> a").click();
                  } else {
                      $(tabsList).find("li:first > a").click();
                  }
                  break;
          }
      }
  );

  // Show the first tabPanel
  $(tabs).find(".tabPanel:first").attr("aria-hidden", "false").show();

  // Set state for the first tabsList li
  $(tabsList).find("li:first").addClass("current").find(" > a").attr({
      "aria-selected": "true",
      "tabindex": "0"
  });
};

/**
 * W3C ARIA JAVASCRIPT - RADIO BUTTONS
 *
 * This file contains ARIA related scripts that dynamically update element
 * attributes according to WCAG AA specs.
 *
 * This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 *   https://www.w3.org/TR/2016/WD-wai-aria-practices-1.1-20160317/examples/radio/js/radio.js
 *
 * @since   3.5.0
 * @version 1.0.0
 */

var KEYCODE = {
    DOWN: 40,
    LEFT: 37,
    RIGHT: 39,
    SPACE: 32,
    UP: 38
}

window.addEventListener('load', function() {

  var radiobuttons = document.querySelectorAll('[role=radio]');

  for(var i = 0; i < radiobuttons.length; i++ ) {
    var rb = radiobuttons[i];

    console.log(rb.tagName + " " + rb.id)

    rb.addEventListener('click', clickRadioGroup);
    rb.addEventListener('keydown', keyDownRadioGroup);
    rb.addEventListener('focus', focusRadioButton);
    rb.addEventListener('blur', blurRadioButton);
  }

});

/*
* @function firstRadioButton
*
* @desc Returns the first radio button
*
* @param   {Object}  event  =  Standard W3C event object
*/

function firstRadioButton(node) {

  var first = node.parentNode.firstChild;

  while(first) {
    if (first.nodeType === Node.ELEMENT_NODE) {
      if (first.getAttribute("role") === 'radio') return first;
    }
    first = first.nextSibling;
  }

  return null;
}

/*
* @function lastRadioButton
*
* @desc Returns the last radio button
*
* @param   {Object}  event  =  Standard W3C event object
*/

function lastRadioButton(node) {

  var last = node.parentNode.lastChild;

  while(last) {
    if (last.nodeType === Node.ELEMENT_NODE) {
      if (last.getAttribute("role") === 'radio') return last;
    }
    last = last.previousSibling;
  }

  return last;
}

/*
* @function nextRadioButton
*
* @desc Returns the next radio button
*
* @param   {Object}  event  =  Standard W3C event object
*/

function nextRadioButton(node) {

  var next = node.nextSibling;

  while(next) {
    if (next.nodeType === Node.ELEMENT_NODE) {
      if (next.getAttribute("role") === 'radio') return next;
    }
    next = next.nextSibling;
  }

  return null;
}

/*
* @function previousRadioButton
*
* @desc Returns the previous radio button
*
* @param   {Object}  event  =  Standard W3C event object
*/

function previousRadioButton(node) {

  var prev = node.previousSibling;

  while(prev) {
    if (prev.nodeType === Node.ELEMENT_NODE) {
      if (prev.getAttribute("role") === 'radio') return prev;
    }
    prev = prev.previousSibling;
  }

  return null;
}

/*
* @function getImage
*
* @desc Gets the image for radio box
*
* @param   {Object}  event  =  Standard W3C event object
*/

function getImage(node) {

  var child = node.firstChild;

  while(child) {
    if (child.nodeType === Node.ELEMENT_NODE) {
      if (child.tagName === 'IMG') return child;
    }
    child = child.nextSibling;
  }

  return null;
}

/*
* @function setRadioButton
*
* @desc Toogles the state of a radio button
*
* @param   {Object}  event  -  Standard W3C event object
*
*/

function setRadioButton(node, state) {
  var image = getImage(node);

  if (state == 'true') {
    node.setAttribute('aria-checked', 'true')
    node.tabIndex = 0;
    node.focus()
  }
  else {
    node.setAttribute('aria-checked', 'false')
    node.tabIndex = -1;
  }
}

/*
* @function clickRadioGroup
*
* @desc
*
* @param   {Object}  node  -  DOM node of updated group radio buttons
*/

function clickRadioGroup(event) {
  var type = event.type;

  if (type === 'click') {
    // If either enter or space is pressed, execute the funtion

    var node = event.currentTarget;

    var radioButton = firstRadioButton(node);

    while (radioButton) {
      setRadioButton(radioButton, "false");
      radioButton = nextRadioButton(radioButton);
    }

    setRadioButton(node, "true");

    event.preventDefault();
    event.stopPropagation();
  }
}

/*
* @function keyDownRadioGroup
*
* @desc
*
* @param   {Object}   node  -  DOM node of updated group radio buttons
*/

function keyDownRadioGroup(event) {
  var type = event.type;
  var next = false;

  if(type === "keydown"){
    var node = event.currentTarget;

    switch (event.keyCode) {
      case KEYCODE.DOWN:
      case KEYCODE.RIGHT:
        var next = nextRadioButton(node);
        if (!next) next = firstRadioButton(node); //if node is the last node, node cycles to first.
        break;

      case KEYCODE.UP:
      case KEYCODE.LEFT:
        next = previousRadioButton(node);
        if (!next) next = lastRadioButton(node); //if node is the last node, node cycles to first.
        break;

      case KEYCODE.SPACE:
        next = node;
        break;
    }

    if (next) {
      var radioButton = firstRadioButton(node);

      while (radioButton) {
        setRadioButton(radioButton, "false");
        radioButton = nextRadioButton(radioButton);
      }

      setRadioButton(next, "true");

      event.preventDefault();
      event.stopPropagation();
    }
  }
}

/*
* @function focusRadioButton
*
* @desc Adds focus styling to label element encapsulating standard radio button
*
* @param   {Object}  event  -  Standard W3C event object
*/

function focusRadioButton(event) {
  event.currentTarget.className += ' focus';
}

/*
* @function blurRadioButton
*
* @desc Adds focus styling to the label element encapsulating standard radio button
*
* @param   {Object}  event  -  Standard W3C event object
*/

function blurRadioButton(event) {
   event.currentTarget.className = event.currentTarget.className.replace(' focus','');
}




/**
 * FEATURE DETECTION CHECK FOR MS EDGE
 *
 * @link https://mobiforge.com/design-development/html5-pointer-events-api-combining-touch-mouse-and-pen
 */
if (window.PointerEvent) {
  //alert(' Pointer events are supported.');
}
