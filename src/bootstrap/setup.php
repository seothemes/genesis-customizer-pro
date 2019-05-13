<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds setup functions to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

// Enable non module configs.
add_filter( 'genesis-customizer_header_primary_config', '__return_true' );
add_filter( 'genesis-customizer_menus_mobile_config', '__return_true' );

add_action( 'init', __NAMESPACE__ . '\pro_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 *
 * @return void
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
 * Returns array of enabled modules.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default modules.
 *
 * @return array
 */
function enabled_modules( $defaults ) {
	$options = _get_option( 'modules', [] );

	if ( ! is_array( $options ) ) {
		return $defaults;
	}

	foreach ( $defaults as $default => $name ) {
		if ( ! in_array( $default, $options, true ) ) {
			unset( $defaults[ $default ] );
		}
	}

	return $defaults;
}

add_filter( 'genesis_customizer_config', __NAMESPACE__ . '\load_pro_config' );
/**
 * Adds Pro config directory.
 *
 * @since 1.0.0
 *
 * @param array $configs Default config directories.
 *
 * @return array
 */
function load_pro_config( $configs ) {
	$configs[] = _get_pro_path() . 'config';

	return $configs;
}

add_filter( 'genesis_customizer_panels', __NAMESPACE__ . '\add_pro_panels' );
/**
 * Adds Pro Customizer panels.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default Customizer panels.
 *
 * @return array
 */
function add_pro_panels( $defaults ) {
	return array_merge_recursive( $defaults, [
		'code'        => __( 'Custom Code', 'genesis-customizer-pro' ),
		'woocommerce' => __( 'WooCommerce', 'genesis-customizer-pro' ),
		'edd'         => __( 'Easy Digital Downloads', 'genesis-customizer-pro' ),
	] );
}

add_filter( 'genesis_customizer_sections', __NAMESPACE__ . '\add_pro_sections' );
/**
 * Adds Pro Customizer section.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default Customizer sections.
 *
 * @return array
 */
function add_pro_sections( $defaults ) {
	$modules = [
		'header'      => [
			'left'        => __( 'Header Left', 'genesis-customizer-pro' ),
			'above'       => __( 'Above Header', 'genesis-customizer-pro' ),
			'below'       => __( 'Below Header', 'genesis-customizer-pro' ),
			'transparent' => __( 'Transparent Header', 'genesis-customizer-pro' ),
			'sticky'      => __( 'Sticky Header', 'genesis-customizer-pro' ),
			'search'      => __( 'Search', 'genesis-customizer-pro' ),
		],
		'menus'       => [
			'mega' => __( 'Mega Menu', 'genesis-customizer-pro' ),
		],
		'content'     => [
			'above' => __( 'Above Content', 'genesis-customizer-pro' ),
			'below' => __( 'Below Content', 'genesis-customizer-pro' ),
		],
		'archive'     => [
			'blog-layout' => __( 'Blog Layout', 'genesis-customizer-pro' ),
		],
		'footer'      => [
			'above'         => __( 'Above Footer', 'genesis-customizer-pro' ),
			'below'         => __( 'Below Footer', 'genesis-customizer-pro' ),
			'scroll-to-top' => __( 'Scroll to Top', 'genesis-customizer-pro' ),
		],
		'code'        => [
			'css' => __( 'Custom CSS', 'genesis-customizer-pro' ),
			'js'  => __( 'Custom JS', 'genesis-customizer-pro' ),
		],
		'woocommerce' => [
			'test' => __( 'Test Setting', 'genesis-customizer-pro' ),
		],
		'edd'         => [],
	];

	return array_merge_recursive( $defaults, $modules );
}

add_action( 'admin_init', __NAMESPACE__ . '\set_default_modules' );
/**
 * Sets default modules.
 *
 * @since 1.0.0
 *
 * @return void
 */
function set_default_modules() {
	if ( _get_option( 'modules', [] ) ) {
		return;
	}

	$modules = _get_pro_modules();
	$new     = [];

	foreach ( $modules as $id => $title ) {
		$new[] = $id;
	}

	update_option( 'genesis-customizer-modules', $new );
}

add_action( 'genesis_setup', __NAMESPACE__ . '\load_child_theme_css', 15 );
/**
 * Loads child theme CSS.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_child_theme_css() {
	$load  = _get_option( 'child-theme-css' );
	$trump = _get_option( 'style-trump' );

	if ( ! $load || $trump ) {
		remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	}

	if ( $trump ) {
		add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 999 );
	}
}
