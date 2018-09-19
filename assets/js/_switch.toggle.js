/**
 * VISIBILITY CHECKBOX TOGGLE SWITCH
 * Assigns related display text and ARIA checked attributes
 */

"use strict";

document.querySelectorAll(".switch").forEach(function (theSwitch) {
  theSwitch.addEventListener("click", handleClickEvent, false);
  theSwitch.addEventListener("change", handleChangeEvent, false);
});

function handleClickEvent(evt) {
  var el = evt.target;

  if (el.getAttribute("aria-checked") == "true") {
    el.setAttribute("aria-checked", "false");
  } else {
    el.setAttribute("aria-checked", "true");

  }
}

function handleChangeEvent() {
  var chk = document.getElementById("switch_1");
  var sibling = chk.nextElementSibling;
  if (chk.checked) {
    sibling.textContent = 'ON';
  } else {
    sibling.textContent = 'OFF';

  }
