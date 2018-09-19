/**
 * SUPPORT TAB DIALOG
 * @link  https://github.com/salmanarshad2000/demos/blob/v1.0.0/jquery-ui-dialog/size-to-fit-content.html
 */
  $(function() {
    $('#dialog').dialog({
      autoOpen: false,
      resizable: false,
      title: 'link of fixed navigation',
      width: 'auto',
      'closeOnEscape' : true,
      show: {
        effect: 'fade',
        duration: 1000
      },
      hide: {
        effect: 'fade',
        duration: 1000
      }
    }); // end dialog()
    $('.dialogify').on('click', function(e) {
      e.preventDefault();
      $('#dialog').html("<img src='" + $(this).prop("href") + "' width='" + $(this).attr("data-width") + "' height='" + $(this).attr("data-height") + "'>");
      $('#dialog').dialog(
        'option',
        'position', {
          my: 'center',
          at: 'center',
          of: window
      }); // end dialog()
      if ($('#dialog').dialog('isOpen') == false) {
        $('#dialog').dialog('open');
      }
    });
  }) // end $(function)
