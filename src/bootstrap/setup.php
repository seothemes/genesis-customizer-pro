<?php

namespace GenesisCustomizer;

// Enable non module configs.
add_filter('genesis-customizer_general_breakpoints_module', '__return_true' );

add_filter( 'genesis_customizer_modules', __NAMESPACE__ . '\enabled_modules' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $defaults
 *
 * @return void
 */
function enabled_modules( $defaults ) {
	$options = get_option( 'genesis-customizer-settings' );

	foreach ( $defaults as $default => $name ) {
		if ( ! array_key_exists( $default, $options ) ) {
			unset( $defaults[ $default ] );
		}
	}

	return $defaults;
}

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
	$configs[] = _get_pro_path() . 'config';

	return $configs;
}

add_filter( 'genesis_customizer_panels', __NAMESPACE__ . '\add_pro_panels' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $defaults
 *
 * @return array
 */
function add_pro_panels( $defaults ) {
	return array_merge_recursive( $defaults, [
		'hero'        => __( 'Hero Section', 'genesis-customizer' ),
		'code'        => __( 'Custom Code', 'genesis-customizer' ),
		'woocommerce' => __( 'WooCommerce', 'genesis-customizer-pro' ),
		'edd'         => __( 'Easy Digital Downloads', 'genesis-customizer-pro' ),
	] );
}

add_filter( 'genesis_customizer_sections', __NAMESPACE__ . '\add_pro_sections' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $defaults
 *
 * @return array
 */
function add_pro_sections( $defaults ) {
	$modules = [
		'general'     => [
			'license'     => __( 'License', 'genesis-customizer' ),
			'performance' => __( 'Performance', 'genesis-customizer' ),
			'breakpoints' => __( 'Breakpoints', 'genesis-customizer' ),
			'typekit'     => __( 'Typekit', 'genesis-customizer' ),
		],
		'header'      => [
			'above-header' => __( 'Above Header', 'genesis-customizer' ),
			'transparent'  => __( 'Transparent Header', 'genesis-customizer' ),
			'sticky'       => __( 'Sticky Header', 'genesis-customizer' ),
			'search'       => __( 'Search', 'genesis-customizer' ),
		],
		'menus'       => [
			'mega' => __( 'Mega Menu', 'genesis-customizer' ),
		],
		'hero'        => [
			'settings' => __( 'Settings', 'genesis-customizer' ),
		],
		'archive'     => [
			'blog-layout' => __( 'Blog Layout', 'genesis-customizer' ),
		],
		'footer'      => [
			'above-footer'  => __( 'Above Footer', 'genesis-customizer' ),
			'scroll-to-top' => __( 'Scroll to Top', 'genesis-customizer' ),
		],
		'code'        => [
			'css' => __( 'Custom CSS', 'genesis-customizer' ),
			'js'  => __( 'Custom JS', 'genesis-customizer' ),
		],
		'woocommerce' => [
			'test' => __( 'Test Setting', 'genesis-customizer' ),
		],
		'edd'         => [],
	];

	return array_merge_recursive( $defaults, $modules );
}
