<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds licensing functions to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

use Alledia\EDD_SL_Plugin_Updater;

add_action( 'admin_init', __NAMESPACE__ . '\load_pro_updater' );
/**
 * Initialize plugin updater class.
 *
 * @since 1.0.0
 *
 * @return object
 */
function load_pro_updater() {
	return new EDD_SL_Plugin_Updater(
		_get_store_link(),
		_get_pro_path() . _get_pro_handle() . '.php',
		[
			'version'     => _get_pro_version(),
			'license'     => _get_license(),
			'item_id'     => _get_product_id(),
			'author'      => _get_author(),
			'url'         => home_url(),
			'wp_override' => true,
		]
	);
}

add_action( 'admin_init', __NAMESPACE__ . '\activate_pro_license' );
/**
 * Activates license when saving settings.
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

		$license = _get_license();

		$api_params = [
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_id'    => _get_product_id(),
			'url'        => home_url(),
		];

		$response = wp_remote_post( _get_store_link(), [
			'timeout'   => 15,
			'sslverify' => false,
			'body'      => $api_params,
		] );

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			$message = ( is_wp_error( $response ) && ! empty( $response->get_error_message() ) ) ? $response->get_error_message() : __( 'An error occurred, please try again.', 'genesis-customizer-pro' );

		} else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $license_data->success ) {
				switch ( $license_data->error ) {
					case 'expired':
						$message = sprintf(
							// Translators: License expiry date.
							__( 'Your license key expired on %s.', 'genesis-customizer-pro' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;
					case 'revoked':
						$message = __( 'Your license key has been disabled.', 'genesis-customizer-pro' );
						break;
					case 'missing':
						$message = __( 'Invalid license.', 'genesis-customizer-pro' );
						break;
					case 'invalid':
					case 'site_inactive':
						$message = __( 'Your license is not active for this URL.', 'genesis-customizer-pro' );
						break;
					case 'item_name_mismatch':
						// Translators: Plugin name.
						$message = sprintf( __( 'This appears to be an invalid license key for %s.', 'genesis-customizer-pro' ), _get_pro_name() );
						break;
					case 'no_activations_left':
						$message = __( 'Your license key has reached its activation limit.', 'genesis-customizer-pro' );
						break;
					default:
						$message = __( 'An error occurred, please try again.' );
						break;
				}
			}
		}

		// Check if anything passed on a message constituting a failure.
		if ( ! empty( $message ) ) {
			$base_url = admin_url( 'admin.php?page=' . $handle . '&tab=license' );
			$redirect = add_query_arg( [
				'sl_activation' => 'false',
				'message'       => urlencode( $message ),
			], $base_url );
			wp_redirect( $redirect );
			exit();
		}

		// $license_data->license will be either "valid" or "invalid".
		update_option( $handle . '-license-status', $license_data->license );

		wp_redirect( admin_url( 'admin.php?page=genesis-customizer&tab=license' ) );
		exit();
	}
}

add_action( 'admin_init', __NAMESPACE__ . '\deactivate_pro_license' );
/**
 * Deactivates license.
 *
 * @since 1.0.0
 *
 * @return void
 */
function deactivate_pro_license() {
	$handle = _get_handle();

	if ( isset( $_POST[ $handle . '_license_deactivate' ] ) ) {
		if ( ! check_admin_referer( $handle, $handle ) ) {
			return;
		}

		update_option( $handle . '-license-status', '' );
	}
}

/**
 * Sanitizes license key on save.
 *
 * @since 1.0.0
 *
 * @param string $new New license key value.
 *
 * @return string
 */
function sanitize_pro_license( $new ) {
	$old = _get_option( 'license-key' );

	if ( $old && $old !== $new ) {
		delete_option( 'genesis-customizer-license-status' );
	}

	return $new;
}


add_action( 'admin_notices', __NAMESPACE__ . '\pro_license_notice' );
/**
 * Display admin notice to enter license key.
 *
 * @since 1.0.0
 *
 * @return void
 */
function pro_license_notice() {
	if ( ! _is_pro_active() || 'valid' === _get_license( 'status' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-error"><p>%s <strong>%s</strong> %s <a href="%s">%s</a></p></div>',
		esc_html__( 'Please activate your', 'genesis-customizer-pro' ),
		esc_html__( 'Genesis Customizer Pro', 'genesis-customizer-pro' ),
		esc_html__( 'license to enable automatic updates.', 'genesis-customizer-pro' ),
		admin_url( 'admin.php?page=genesis-customizer&tab=license' ),
		esc_html__( 'License settings', 'genesis-customizer-pro' )
	);
}

add_action( 'admin_notices', __NAMESPACE__ . '\license_status_notices' );
/**
 * Displays license status admin notice.
 *
 * @since 1.0.0
 *
 * @return void
 */
function license_status_notices() {
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
					<p><?php esc_html_e( 'License activated', 'genesis-customizer-pro' ); ?></p>
				</div>
				<?php
				break;

			default:
				break;
		}
	}
}
