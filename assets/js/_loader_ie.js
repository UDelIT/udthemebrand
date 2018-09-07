/**
  * LOADER IE JS (FOR IE 11 ONLY)
  * Plain JS module that loads CSS and JS files via JS Promises.
  * For all other browser integration use _loader.js
  * @since   3.1.0
*/
'use strict';

function createStyleSheetExecutor(url) {
  return function (resolve, reject) {

    var element = document.createElement('link');

    element.setAttribute('rel', 'stylesheet');
    element.setAttribute('type', 'text/css');
    element.setAttribute('href', url);
    element.onload = function () {
      return resolve(url);
    };
    element.onerror = function () {
      return reject(url);
    };

    document.head.appendChild(element);
  };
}

/**
 * Creates a JavaScript executor for a Promise instance.
 *
 * @param {string} url JavaScript URL.
 *
 * @returns {Function}
 */
function createJavaScriptExecutor(url) {
  return function (resolve, reject) {

    var element = document.createElement('script');

    element.setAttribute('src', url);
    element.onload = function () {
      return resolve(url);
    };
    element.onerror = function () {
      return reject(url);
    };

    document.head.appendChild(element);
  };
}

/**
 * Creates a promise to load a stylesheet.
 *
 * @param {string} url
 *
 * @returns {Promise}
 *
 * @constructor
 */
function StyleSheetPromise(url) {
  return new Promise(createStyleSheetExecutor(url));
}

StyleSheetPromise.createExecutor = createStyleSheetExecutor;

/**
 * Creates a promise to load a JavaScript.
 *
 * @param {string} url
 *
 * @returns {Promise}
 *
 * @constructor
 */
function JavaScriptPromise(url) {
  return new Promise(createJavaScriptExecutor(url));
}

JavaScriptPromise.createExecutor = createJavaScriptExecutor;

/**
 * Returns a promise that either resolves when all the stylesheets have been loaded or rejects
 * as soon as one of them fails to.
 *
 * @param {Array<string>}urls
 *
 * @returns {Promise}
 */
StyleSheetPromise.all = function (urls) {

  var promises = [];

  urls.forEach(function (url) {
    return promises.push(new StyleSheetPromise(url));
  });

  return Promise.all(promises);
};

/**
 * Returns a promise that either resolves when all the javascript have been loaded or rejects
 * as soon as one of them fails to.
 *
 * @param {Array<string>}urls
 *
 * @returns {Promise}
 */
JavaScriptPromise.all = function (urls) {

  var promises = [];

  urls.forEach(function (url) {
    return promises.push(new JavaScriptPromise(url));
  });

  return Promise.all(promises);
};

var _exports;

if ('undefined' !== typeof _exports) {
  _exports.StyleSheetPromise = StyleSheetPromise;
  _exports.JavaScriptPromise = JavaScriptPromise;
}

"use strict";
var stylesheets = ["http://www.csszengarden.com/215/215.css""];
var javascripts = ["https://ajax.googleapis.com/ajax/", "https://ajax.googleapis.com/ajax/libs/", "https://ajax.googleapis.com/ajax/libs/webfont/"];
var p1 = StyleSheetPromise.all(stylesheets).then(function (urls) {
  console.log('stylesheet resolved:', urls);
}).catch(function (urls) {
  console.log('stylesheet rejectd:', urls);
});
var p2 = JavaScriptPromise.all(javascripts).then(function (urls) {
  console.log('javascript resolved:', urls);
}).catch(function (urls) {
  console.log('javascript rejectd:', urls);
});
Promise.all([p1, p2]).then(function (stylesheets, javascripts) {
  console.log('resolved:', stylesheets, javascripts);
}).catch(function (stylesheets, javascripts) {
  console.log('rejected:', stylesheets, javascripts);
});
