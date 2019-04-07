<?php

namespace GenesisCustomizer;

add_action( 'admin_init', __NAMESPACE__ . '\load_pro_updater' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return object
 */
function load_pro_updater() {
	if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
		require_once _get_pro_path() . 'src/classes/class-edd-sl-plugin-updater.php';
	}

	return new \EDD_SL_Plugin_Updater(
		_get_store_url(),
		_get_pro_path() . _get_pro_handle() . '.php',
		[
			'version'     => _get_pro_version(),
			'license'     => _get_license_key(),
			'item_id'     => _get_product_id(),
			'author'      => _get_author(),
			'url'         => home_url(),
			'wp_override' => true,
		]
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
	$handle = _get_handle();

	if ( isset( $_POST[ $handle . '_license_activate' ] ) ) {
		if ( ! check_admin_referer( $handle, $handle ) ) {
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
			$base_url = admin_url( 'admin.php?page=' . $handle );
			$redirect = add_query_arg( [
				'sl_activation' => 'false',
				'message'       => urlencode( $message ),
			], $base_url );
			wp_redirect( $redirect );
			exit();
		}

		// $license_data->license will be either "valid" or "invalid"
		$options           = get_option( $handle . '-settings' );
		$options['status'] = $license_data->license;
		update_option( $handle . '-settings', $options );

		wp_redirect( admin_url( 'admin.php?page=' . $handle ) );
		exit();
	}
}

add_action( 'admin_notices', __NAMESPACE__ . '\license_admin_notices' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function license_admin_notices() {
	if ( isset( $_GET['sl_activation'] ) && ! empty( $_GET['message'] ) ) {
		switch ( $_GET['sl_activation'] ) {
			case 'false':
				$message = urldecode( $_GET['message'] );
				?>
                <div class="error">
                    <p><?php echo esc_html( $message ); ?></p>
                </div>
				<?php
				break;
				
			case 'true':
				?>
                <div class="success">
                    <p><?php esc_html_e( 'License activated', 'genesis-customizer' ); ?></p>
                </div>
				<?php
				break;

			default:
				break;
		}
	}
}
