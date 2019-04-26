<?php

namespace GenesisCustomizer;

// Enable non module configs.
add_filter( 'genesis-customizer_general_breakpoints_config', '__return_true' );
add_filter( 'genesis-customizer_header_primary_config', '__return_true' );
add_filter( 'genesis-customizer_menus_mobile_config', '__return_true' );

add_action( 'init', __NAMESPACE__ . '\pro_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function pro_textdomain() {
	\load_plugin_textdomain(
		_get_pro_handle(),
		false,
		basename( _get_pro_path() ) . '/assets/lang'
	);
}

add_filter( 'genesis_customizer_modules', __NAMESPACE__ . '\enabled_modules' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $defaults
 *
 * @return array
 */
function enabled_modules( $defaults ) {
	$options = get_option( 'genesis-customizer-settings', [] );

	if ( ! is_array( $options ) ) {
		return $defaults;
	}

	foreach ( $defaults as $default => $name ) {
		if ( ! array_key_exists( $default, $options ) ) {
			unset( $defaults[ $default ] );
		}
	}

	return $defaults;
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
			'left'        => __( 'Header Left', 'genesis-customizer' ),
			'above'       => __( 'Above Header', 'genesis-customizer' ),
			'below'       => __( 'Below Header', 'genesis-customizer' ),
			'transparent' => __( 'Transparent Header', 'genesis-customizer' ),
			'sticky'      => __( 'Sticky Header', 'genesis-customizer' ),
			'search'      => __( 'Search', 'genesis-customizer' ),
		],
		'menus'       => [
			'mega' => __( 'Mega Menu', 'genesis-customizer' ),
		],
		'content'     => [
			'above' => __( 'Above Content', 'genesis-customizer' ),
			'below' => __( 'Below Content', 'genesis-customizer' ),
		],
		'archive'     => [
			'blog-layout' => __( 'Blog Layout', 'genesis-customizer' ),
		],
		'footer'      => [
			'above'         => __( 'Above Footer', 'genesis-customizer' ),
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

register_activation_hook( _get_pro_path() . _get_pro_handle() . '.php', __NAMESPACE__ . '\activation_hook' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function activation_hook() {
	$modules = _get_pro_modules();
	$new     = [];

	foreach ( $modules as $module => $title ) {
		$new[ $module ] = 1;
	}

	$new['status'] = 'invalid';

	genesis_update_settings( $new, _get_handle() . '-settings' );
}
