<?php
// from admin/class-udtbp-header-settings.php
public function custom_logo( $items ) {
    /**
     * HEADER PRIMARY LOGO
     *
     * @since       1.4.2
     * @version     1.0.0
     * @deprecated  3.5.0       no longer used
    */

    $options    = get_option( $this->udtbp . '_options', $items );
    $items =
      [
        NULL => 'Default (No College)',
        'lerner'  => 'Alfred Lerner College of Business &amp; Economics',
        'canr'    => 'College of Agriculture &amp; Natural Resources',
        'cas'     => 'College of Arts &amp; Sciences',
        'ceoe'    => 'College of Earth, Ocean, &amp; Environment',
        'cehd'    => 'College of Education &amp; Human Development',
        'engr'    => 'College of Engineering',
        'chs'     => 'College of Health Sciences'
      ];
    $option   = '';

    if ( isset( $options['custom-logo'] ) && ! empty( $options['custom-logo'] ) ) {$option = $options['custom-logo'];$custom_header_text = $items[$option];}
    else {$option = NULL;$custom_header_text = NULL;}
    ?>
    <div class="box-content">
      <label for="<?php echo esc_attr( $this->udtbp.'_options[custom-logo]' ) ?>">
        <select id="<?php echo esc_attr( $this->udtbp.'_options[custom-logo]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[custom-logo]' ) ?>" >
          <option style="color:#767676;" value="" disabled aria-disabled="true"><?php _e( 'Choose one...', $this->udtbp ); ?></option>
          <?php
          foreach ( $items as $key=>$value ) :
          ?>
          <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $option, $key ) ?> ><?php echo esc_attr( $value ); ?></option>
          <?php
          endforeach;
          ?>
        </select>
      </label>
      <input type="hidden" id="udt_custom_header_text" name="udt_custom_header_text" value="<?php echo esc_attr( $custom_header_text ); ?>">
      <div class="field_prompt"><?php _e( 'Displays UD logo with college title or UD logo only.', $this->udtbp ); ?></div>
    </div>
      <?php
      /**
      * UPDATE PRIMARY LOGO
      * Added to pass college text value to public view.
      * TODO: Is this sufficient
      * @since     3.0.0
      * @var       string         $custom_header_text            Hidden field that contains text value from selected option.
      */
      update_option( 'udt_custom_header_text', $custom_header_text );
    } // custom_logo()
