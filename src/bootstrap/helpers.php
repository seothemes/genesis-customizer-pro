<?php

namespace GenesisCustomizer;

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $header
 *
 * @return string|array|null
 */
function _get_pro_data( $header = '' ) {
	static $data = null;

	if ( is_null( $data ) ) {
		$data = get_file_data( _get_pro_path() . 'genesis-customizer-pro.php', [
			'Name'        => 'Plugin Name',
			'Version'     => 'Version',
			'PluginURI'   => 'Plugin URI',
			'TextDomain'  => 'Text Domain',
			'Description' => 'Description',
			'Author'      => 'Author',
			'AuthorURI'   => 'Author URI',
			'DomainPath'  => 'Domain Path',
			'Network'     => 'Network',
			'ProductID'   => 'EDD Product',
		], 'plugin' );
	}

	if ( array_key_exists( $header, $data ) ) {
		return $data[ $header ];
	}

	return $data;
}

/**
 * Returns the plugin path.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_path() {
	return plugin_dir_path( dirname( __DIR__ ) );
}

/**
 * Returns the plugin url.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_url() {
	return plugin_dir_url( dirname( __DIR__ ) );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_name() {
	return _get_pro_data( 'Name' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_handle() {
	return _get_pro_data( 'TextDomain' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_version() {
	return _get_pro_data( 'Version' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_store_url() {
	return _get_pro_data( 'PluginURI' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return int
 */
function _get_product_id() {
	return _get_pro_data( 'ProductID' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param string $key_or_status Return the license key or status.
 *
 * @return string
 */
function _get_license( $key_or_status = 'key' ) {
	return trim( get_option( "genesis-customizer-license-$key_or_status" ) );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return array
 */
function _get_pro_modules() {
	$modules = [];

	foreach ( glob( _get_pro_path() . 'src/modules/*.php' ) as $module ) {
		$id    = basename( $module, '.php' );
		$title = ucwords( str_replace( '-', ' ', $id ) );

		$modules[ $id ] = $title;
	}

	return $modules;
}
