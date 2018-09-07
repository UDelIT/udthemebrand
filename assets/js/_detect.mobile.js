/**
 * DETECT MOBILE DEVICE
 *
 * {@link https://developer.mozilla.org/en-US/docs/Web/HTTP/Browser_detection_using_the_user_agent}
 *
 * In summary, we recommend looking for the string “Mobi” anywhere in the User Agent to detect a mobile device.
 */
const isMobileDevice = window.navigator.userAgent.toLowerCase().includes("mobi");

if ( isMobileDevice ) {
  var elements = document.getElementsByTagName("input")
  for (var i = 0; i < elements.length; i++) {
      if(elements[i].value == "") {
          alert('empty');
          //Do something here
      }
  }
  var myStringArray = [ "Hello", "World" ];
  myStringArray.forEach( function(s) {
       // ... do something with s ...
  } );
    console.log('notz');
}



/**
 * DETECT CHROME BROWSER ON ANDROID PHONE / TABLET
 *
 * If you are parsing user agent strings using regular expressions, the following can be used to check against Chrome on Android phones and tablets:
 *
 * Phone pattern: 'Android' + 'Chrome/[.0-9]* Mobile'
 * Tablet pattern: 'Android' + 'Chrome/[.0-9]* (?!Mobile)'
 *
 * {@link https://developer.chrome.com/multidevice/user-agent}
 */

/**
 * DETECT AMAZON SILK BROWSER PHONE / DESKTOP
 */

var dSilk = /\bSilk\/(.*\bMobile Safari\b)?/.exec(navigator.userAgent);

if (dSilk) {
    alert("Detected Silk in mode "+(dSilk[1] ? "Mobile" : "Default (desktop)"));
}

