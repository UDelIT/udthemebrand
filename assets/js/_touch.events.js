function onetime(node, type, callback) {
  // create event
  document.addEventListener(type, function(e) {
    // remove event
    e.target.removeEventListener(e.type, arguments.callee);
    // call handler
    return callback(e);
  });
}

// // https://developer.mozilla.org/en-US/docs/Web/API/Touch_events/Using_Touch_Events
// // We can now use this function whenever we require a one-time only event:

// // one-time event
onetime(document.getElementById("myelement"), "click", handler);

// // handler function
function handler(e) {
  ['click', 'touchstart'].forEach(
    function(e){
      el_navicon.addEventListener(e,
        function(e) {
          e.preventDefault(),
          el_sidebar.classList.toggle("active"),
          el_nav.classList.remove("active"),
          [].forEach.call(el_overlay, function(e) {
            e.classList.remove("fadeOut, animated").classList.add("fadeIn, animated");
          });

        }, false);
    }
  ), // end on

  ['click', 'touchstart'].forEach(
    function(e){
      el_overlay.addEventListener(e,
        function(e) {
          e.preventDefault(),
          el_navicon.click(),
          this.classList.remove("fadeIn").classList.add("fadeOut")
        }, false);
    }
  ) // end on
} // end handler
