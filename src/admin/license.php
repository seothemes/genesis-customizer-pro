<?php

namespace GenesisCustomizer;

add_action( 'admin_init', __NAMESPACE__ . '\activate_pro_license' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function activate_pro_license() {
	if ( isset( $_POST[ _get_handle() . '_license_activate' ] ) ) {
		if ( ! check_admin_referer( 'gcpro_nonce', 'gcpro_nonce' ) ) {
			return;
		}

		$license    = trim( genesis_get_option( 'license', 'genesis-customizer-settings' ) );
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
			$base_url = admin_url( 'admin.php?page=' . _get_handle() );
			$redirect = add_query_arg( [
				'sl_activation' => 'false',
				'message'       => urlencode( $message ),
			], $base_url );
			wp_redirect( $redirect );
			exit();
		}

		// $license_data->license will be either "valid" or "invalid"
		$options = get_option( 'genesis-customizer-settings' );
		$options['status'] = $license_data->license;
		update_option( 'genesis-customizer-settings', $options );

		wp_redirect( admin_url( 'admin.php?page=' . _get_handle() ) );
		exit();
	}
}

