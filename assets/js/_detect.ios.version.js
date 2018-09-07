/**
  * DETECT iOS VERSION
  *
  * @see https://gist.github.com/rafaelrinaldi/5873671
  * window.MSStream used because Windows Phone can mimic Android and iOS
  *
  * @return {[type]} [description]
  */
 function iOSVersion() {
  if(window.MSStream){
    // There is some iOS in Windows Phone...
    // https://msdn.microsoft.com/en-us/library/hh869301(v=vs.85).aspx
    return false;
  }
  var match = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/),
      version;

  if (match !== undefined && match !== null) {
    version = [
      parseInt(match[1], 10),
      parseInt(match[2], 10),
      parseInt(match[3] || 0, 10)
    ];
    return parseFloat(version.join('.'));
  }

  return false;
}
