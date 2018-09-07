/**
  * INTERNET EXPLORER 6-11 FEATURE CHECK
  *
  * @since  3.0.0
  * @link https://gist.github.com/atsea/3d0aac8f5bdabd95b1a4f04dbc7eaefe
  */
  $(function () {

    if ( isIE ) {
      $( '#ud-id-foot' ).addClass( 'is_ie' );
    }
  }) // end $(function)
  /**
  * MICROSOFT EDGE FEATURE CHECK
  *
  * @since  3.0.0
  * @link https://gist.github.com/atsea/3d0aac8f5bdabd95b1a4f04dbc7eaefe
  */
  $(function () {

    if ( isEdge ) {
      $( '#ud-id-foot' ).addClass( 'is_edge' );
    }
  }) // end $(function)
