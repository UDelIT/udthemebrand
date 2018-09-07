/**
  * LOADER JS
  * Plain JS module that loads CSS and JS files via JS Promises.
  * For IE 11 integration use _loader_ie.js
  * @since   3.1.0
*/
localforage.setItem('key', 'value').then(function () {
  return localforage.getItem('key');
}).then(function (value) {
  // we got our value
}).catch(function (err) {
  // we got an error
});

function createStyleSheetExecutor(url){
  return function (resolve, reject) {
    let element = document.createElement('link') // let not supported in IE 11
    element.setAttribute('rel', 'stylesheet')
    element.setAttribute('type', 'text/css')
    element.setAttribute('href', url)
    element.onload = () => resolve(url)
    element.onerror = () => reject(url)
    document.head.appendChild(element)
  }
}

/**
 * Creates a JavaScript executor for a Promise instance.
 *
 * @param {string} url JavaScript URL.
 *
 * @returns {Function}
 */
function createJavaScriptExecutor(url){
  return function (resolve, reject) {
    let element = document.createElement('script')
    element.setAttribute('src', url)
    element.onload = () => resolve(url)
    element.onerror = () => reject(url)
    document.head.appendChild(element)
  }
}
/**
 * Creates a promise to load a stylesheet.
 *
 * @param {string} url
 * @returns {Promise}
 * @constructor
 */
function StyleSheetPromise(url){
  return new Promise(createStyleSheetExecutor(url))
}

StyleSheetPromise.createExecutor = createStyleSheetExecutor

/**
 * Creates a promise to load a JavaScript.
 *
 * @param {string} url
 * @returns {Promise}
 * @constructor
 */
function JavaScriptPromise(url){
  return new Promise(createJavaScriptExecutor(url))
}

JavaScriptPromise.createExecutor = createJavaScriptExecutor

/**
 * Returns a promise that either resolves when all the stylesheets have been loaded or rejects
 * as soon as one of them fails to.
 *
 * @param {Array<string>}urls
 * @returns {Promise}
 */
StyleSheetPromise.all = function (urls) {
  let promises = []
  urls.forEach((url) => promises.push(new StyleSheetPromise(url)))
  return Promise.all(promises)
}

/**
 * Returns a promise that either resolves when all the javascript have been loaded or rejects
 * as soon as one of them fails to.
 *
 * @param {Array<string>}urls
 * @returns {Promise}
 */
JavaScriptPromise.all = function (urls) {
  let promises = []
  urls.forEach((url) => promises.push(new JavaScriptPromise(url)))
  return Promise.all(promises)
}

var exports
if ('undefined' !== typeof exports){
  exports.StyleSheetPromise = StyleSheetPromise
  exports.JavaScriptPromise = JavaScriptPromise
}

"use strict";
var stylesheets = [
  "https://www1.udel.edu/chris/!projects/UDformdev/deptforms/css/udit_style.css"
]
var javascripts = [
  "https://ajax.googleapis.com/"
]
var p1 = StyleSheetPromise.all(stylesheets).then(urls => {
  console.log('stylesheet resolved:', urls)
}).catch(urls => {
  console.log('stylesheet rejectd:', urls)
})
var p2 = JavaScriptPromise.all(javascripts).then(urls => {
  console.log('javascript resolved:', urls)
}).catch(urls => {
  console.log('javascript rejectd:', urls)
})
Promise.all([ p1, p2 ]).then((stylesheets, javascripts) => {
  console.log('resolved:', stylesheets, javascripts)
}).catch((stylesheets, javascripts) => {
  console.log('rejected:', stylesheets, javascripts)
})
// new StyleSheetPromise("http://some-domain-name/" + woohoo + ".js").then(url => {
//   console.log('fake resolve:', url)
// }).catch(url => {
//   console.log('fake reject:', url)
// })
