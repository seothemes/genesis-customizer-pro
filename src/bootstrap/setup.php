<?php

namespace GenesisCustomizer;

add_action( 'genesis_setup', __NAMESPACE__ . '\load_pro_updater' );
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

	$license_key = trim( get_option( _get_pro_handle() . '_license_key' ) );

	return new \EDD_SL_Plugin_Updater(
		_get_store_url(),
		_get_pro_path() . _get_pro_handle() . '.php',
		[
			'version'     => _get_pro_version(),
			'license'     => $license_key,
			'item_id'     => _get_product_id(),
			'author'      => _get_author(),
			'url'         => home_url(),
			'wp_override' => true,
		]
	);
}

add_filter( 'genesis_customizer_config', __NAMESPACE__ . '\load_pro_config' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $configs
 *
 * @return array
 */
function load_pro_config( $configs ) {
	$configs[] = _get_pro_path() . '/config';

	return $configs;
}

