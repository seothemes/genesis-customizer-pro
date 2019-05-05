<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds helpers functions to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

/**
 * Retrieve plugin information.
 *
 * @since 1.0.0
 *
 * @param string $header File header information to retrieve.
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
 * Returns the name of the plugin.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_name() {
	return _get_pro_data( 'Name' );
}

/**
 * Returns the plugin handle.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_handle() {
	return _get_pro_data( 'TextDomain' );
}

/**
 * Returns the plugin version.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_pro_version() {
	return _get_pro_data( 'Version' );
}

/**
 * Returns the EDD store link.
 *
 * @since 1.0.0
 *
 * @return string
 */
function _get_store_link() {
	return _get_pro_data( 'PluginURI' );
}

/**
 * Return the EDD product ID.
 *
 * @since 1.0.0
 *
 * @return int
 */
function _get_product_id() {
	return _get_pro_data( 'ProductID' );
}

/**
 * Return the license key or status.
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
 * Return array of Pro modules.
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
