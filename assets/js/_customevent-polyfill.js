/**
	* CUSTOMEVENT POLYFILL FOR IE / EDGE
  * polyfill the CustomEvent() constructor functionality in Internet Explorer 9 +
  *
  * {@link https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent#Polyfill}
  *
  * @since   3.1.0
 */
(function () {
  if ( typeof window.CustomEvent === "function" ) return false;

  function CustomEvent ( event, params ) {
    params = params || { bubbles: false, cancelable: false, detail: undefined };
    var evt = document.createEvent( 'CustomEvent' );
    evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
    return evt;
   }

  CustomEvent.prototype = window.Event.prototype;

  window.CustomEvent = CustomEvent;
})();
