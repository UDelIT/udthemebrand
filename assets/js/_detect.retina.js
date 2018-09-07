 /**
   * JAVASCRIPT FEATURE DETECTION II
   * Checks for DeviceOrientation and DeviceMotion support (Mobile browsers)
   * @return   mixed|null        Load mobile CSS if TRUE
   * @link https://github.com/micku7zu/vanilla-tilt.js/issues/21
 */
function detectRetina() {
  var divElement = document.querySelector("#dpiExample");

  var query = "(-webkit-min-device-pixel-ratio: 2), (min-device-pixel-ratio: 2), (min-resolution: 192dpi)";

  if (window.devicePixelRatio(query).matches) {
    divElement.innerText = "High-DPI / Retina!";
  } else {
    divElement.innerText = "NOT High DPI / Retina!";
  }
}
