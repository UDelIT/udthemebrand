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
      ); // end tab.click
    } // end function a
  ); // tabList find

  // Set keydown events on tabList item for navigating tabs
  $(tabsList).delegate("a", "keydown", function (e) {
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
    } // end function e
  ); // end tabList delegate

  // Show the first tabPanel
  $(tabs).find(".tabPanel:first").attr("aria-hidden", "false").show();

  // Set state for the first tabsList li
  $(tabsList).find("li:first").addClass("current").find(" > a").attr({
    "aria-selected": "true",
    "tabindex": "0"
  });
};
