<?php

namespace GenesisCustomizer;

add_action( 'admin_menu', __NAMESPACE__ . '\pro_license_menu', 100 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function pro_license_menu() {
	add_submenu_page(
		'genesis',
		_get_name(),
		_get_name(),
		'install_themes',
		_get_pro_handle(),
		__NAMESPACE__ . '\pro_license_page'
	);
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function pro_license_page() {
	$license = get_option( _get_pro_handle() . '_license_key' );
	$status  = get_option( _get_pro_handle() . '_license_status' );
	?>
    <div class="wrap">
    <h2><?php echo _get_pro_name(); ?></h2>
    <form method="post" action="options.php">

		<?php settings_fields( _get_pro_handle() ); ?>

        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row" valign="top">
					<?php esc_html_e( 'License Key', 'genesis-customizer' ); ?>
                </th>
                <td>
                    <input id="<?php echo _get_pro_handle(); ?>_license_key"
                           name="<?php echo _get_pro_handle(); ?>_license_key" type="text" class="regular-text"
                           value="<?php esc_attr_e( $license ); ?>"/>
                    <label class="description"
                           for="<?php echo _get_pro_handle(); ?>_license_key"><?php _e( 'Enter your license key' ); ?></label>
                </td>
            </tr>
			<?php if ( false !== $license ) { ?>
                <tr valign="top">
                    <th scope="row" valign="top">
						<?php _e( 'Activate License' ); ?>
                    </th>
                    <td>
						<?php if ( $status !== false && $status == 'valid' ) { ?>
                            <span style="color:green;"><?php _e( 'active' ); ?></span>
							<?php wp_nonce_field( 'gcpro_nonce', 'gcpro_nonce' ); ?>
                            <input type="submit" class="button-secondary"
                                   name="<?php echo _get_pro_handle(); ?>_license_deactivate"
                                   value="<?php esc_html_e( 'Deactivate License', 'genesis-customizer' ); ?>"/>
						<?php } else {
							wp_nonce_field( 'gcpro_nonce', 'gcpro_nonce' ); ?>
                            <input type="submit" class="button-secondary"
                                   name="<?php echo _get_pro_handle(); ?>_license_activate"
                                   value="<?php esc_attr_e( 'Activate License', 'genesis-customizer' ); ?>"/>
						<?php } ?>
                    </td>
                </tr>
			<?php } ?>
            </tbody>
        </table>
		<?php submit_button(); ?>

    </form>
	<?php
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $new
 *
 * @return mixed
 */
function sanitize_pro_license( $new ) {
	$old = get_option( _get_pro_handle() . '_license_key' );

	if ( $old && $old !== $new ) {
		delete_option( _get_pro_handle() . '_license_status' );
	}

	return $new;
}


add_action( 'admin_init', __NAMESPACE__ . '\register_pro_license_option' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_pro_license_option() {
	$args = [
		'sanitize_callback' => __NAMESPACE__ . '\sanitize_pro_license',
	];

	register_setting(
		_get_pro_handle(),
		_get_pro_handle() . '_license_key',
		$args
	);
}

add_action( 'admin_init', __NAMESPACE__ . '\activate_pro_license' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function activate_pro_license() {
	if ( isset( $_POST[ _get_pro_handle() . '_license_activate' ] ) ) {
		if ( ! check_admin_referer( 'gcpro_nonce', 'gcpro_nonce' ) ) {
			return;
		}

		$license    = trim( get_option( _get_pro_handle() . '_license_key' ) );
		$api_params = [
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_id'    => _get_product_id(),
			'url'        => home_url(),
		];
		$response   = wp_remote_post(
			_get_store_url(),
			[
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			] );

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			$message = ( is_wp_error( $response ) && ! empty( $response->get_error_message() ) ) ? $response->get_error_message() : __( 'An error occurred, please try again.' );

		} else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $license_data->success ) {
				switch ( $license_data->error ) {
					case 'expired' :
						$message = sprintf(
							__( 'Your license key expired on %s.' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;
					case 'revoked' :
						$message = __( 'Your license key has been disabled.' );
						break;
					case 'missing' :
						$message = __( 'Invalid license.' );
						break;
					case 'invalid' :
					case 'site_inactive' :
						$message = __( 'Your license is not active for this URL.' );
						break;
					case 'item_name_mismatch' :
						$message = sprintf( __( 'This appears to be an invalid license key for %s.' ), _get_pro_name() );
						break;
					case 'no_activations_left':
						$message = __( 'Your license key has reached its activation limit.' );
						break;
					default :
						$message = __( 'An error occurred, please try again.' );
						break;
				}
			}
		}

		// Check if anything passed on a message constituting a failure
		if ( ! empty( $message ) ) {
			$base_url = admin_url( 'admin.php?page=' . _get_pro_handle() );
			$redirect = add_query_arg( [
				'sl_activation' => 'false',
				'message'       => urlencode( $message ),
			], $base_url );
			wp_redirect( $redirect );
			exit();
		}

		// $license_data->license will be either "valid" or "invalid"
		update_option( _get_pro_handle() . '_license_status', $license_data->license );
		wp_redirect( admin_url( 'admin.php?page=' . _get_pro_handle() ) );
		exit();
	}
}

