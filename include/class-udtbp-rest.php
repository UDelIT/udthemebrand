<?php
// https://torquemag.io/2017/06/creating-wordpress-settings-page-using-wordpress-rest-api/
// https://torquemag.io/2015/06/adding-custom-routes-wordpress-rest-api/
/**
 * this goes inside admin localize script
 *  $args_localize_script = [
        'strings' => array(
          'saved' => __( 'Settings Saved', 'text-domain' ),
          'error' => __( 'Error', 'text-domain' )
        ),
        'api'     => array(
          'url'   => esc_url_raw( rest_url( 'apex-api/v1/settings' ) ),
          'nonce' => wp_create_nonce( 'wp_rest' ),
          'plugin_name' => UDTBP_NAME,
          'ajaxurl' => admin_url( 'admin-ajax.php' ),
          'view_header' => $this->udtbp.'_options[view-header]',
          'header_site_title' => $this->custom_header_text,
          'view_footer' => $this->udtbp.'_options[view-footer]',
          'footer_color' => $this->udtbp.'_options[color-footer]',
          'udtbp_theme_override' => $this->udtbp.'_theme_override',
          'ascss' => UDTBP_ASSETS_CSS_URL,
          'asjs' => UDTBP_ASSETS_JS_URL,
          'adcss' => UDTBP_ADMIN_CSS_URL,
          'adjs' => UDTBP_ADMIN_JS_URL,
          'pucss' => UDTBP_PUBLIC_CSS_URL,
          'pujs' => UDTBP_PUBLIC_JS_URL
        )
 */
class Apex_API {
	/**
	 * Add routes
	 */
	public function add_routes( ) {
		register_rest_route( 'apex-api/v1', '/settings',
			array(
				'methods'         => 'POST',
				'callback'        => array( $this, 'update_settings' ),
				'args' => array(
					'industry' => array(
						'type' => 'string',
						'required' => false,
						'sanitize_callback' => 'sanitize_text_field'
					),
					'amount' => array(
						'type' => 'integer',
						'required' => false,
						'sanitize_callback' => 'absint'
					)
				),
				'permissions_callback' => array( $this, 'permissions' )
			)
		);
		register_rest_route( 'apex-api/v1', '/settings',
			array(
				'methods'         => 'GET',
				'callback'        => array( $this, 'get_settings' ),
				'args'            => array(
				),
				'permissions_callback' => array( $this, 'permissions' )
			)
		);
	}
	/**
	 * Check request permissions
	 *
	 * @return bool
	 */
	public function permissions(){
		return current_user_can( 'manage_options' );
	}
	/**
	 * Update settings
	 *
	 * @param WP_REST_Request $request
	 */
	public function update_settings( WP_REST_Request $request ){
		$settings = array(
			'industry' => $request->get_param( 'industry' ),
			'amount' => $request->get_param( 'amount' )
		);
		Apex_Settings::save_settings( $settings );
		return rest_ensure_response( Apex_Settings::get_settings())->set_status( 201 );
	}
	/**
	 * Get settings via API
	 *
	 * @param WP_REST_Request $request
	 */
	public function get_settings( WP_REST_Request $request ){
		return rest_ensure_response( Apex_Settings::get_settings());
	}
}
