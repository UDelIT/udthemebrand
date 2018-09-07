/**
   * JAVASCRIPT FEATURE DETECTION II
   * Checks for DeviceOrientation and DeviceMotion support (Mobile browsers)
   * @return   mixed|null        Load mobile CSS if TRUE
   * @link https://github.com/micku7zu/vanilla-tilt.js/issues/21
 */
function detectGyro() {
  //Check for support for DeviceOrientation event
  if(window.DeviceOrientationEvent) {
    window.addEventListener('deviceorientation', function(event) {
            var alpha = event.alpha;
            var beta = event.beta;
            var gamma = event.gamma;

            if(alpha!=null || beta!=null || gamma!=null){
              console.log('orientation supported');
            } else {
              console.log('look at me bitch');
            }
          }, false);
  }

  // Check for support for DeviceMotion events
  if(window.DeviceMotionEvent) {
  window.addEventListener('devicemotion', function(event) {
            var x = event.accelerationIncludingGravity.x;
            var y = event.accelerationIncludingGravity.y;
            var z = event.accelerationIncludingGravity.z;
            var r = event.rotationRate;

            if(r!=null)
            console.log('motion supported');
          });
  }
}


// window.addEventListener("devicemotion", function(event){
//   if(event.rotationRate.alpha || event.rotationRate.beta || event.rotationRate.gamma)
//   gyroPresent = true;
// });
