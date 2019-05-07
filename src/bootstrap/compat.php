<?php
/**
 * Genesis Customizer Pro.
 *
 * This file checks for plugin compatibility before loading Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

add_action( 'plugins_loaded', __NAMESPACE__ . '\pro' );
/**
 * Check compatibility (after base plugin is loaded).
 *
 * @since 1.0.0
 *
 * @return void
 */
function pro() {
	if ( ! pro_is_compatible() ) {
		if ( ! function_exists( 'deactivate_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		deactivate_plugins( plugin_dir_path( dirname( __DIR__ ) ) . 'genesis-customizer-pro.php' );
	}
}

add_action( 'admin_notices', __NAMESPACE__ . '\pro_deactivation_notice' );
/**
 * Display deactivation notice.
 *
 * @since 1.0.0
 *
 * @return string
 */
function pro_deactivation_notice() {
	if ( ! pro_is_compatible() ) {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		return printf(
			'<div class="notice notice-error"><p><b>%s</b> %s</p></div>',
			esc_html( _get_pro_name() ),
			esc_html__( 'requires the Genesis Customizer plugin to run and has been deactivated.', 'genesis-customizer-pro' )
		);

	} else {
		return '';
	}
}

/**
 * Check if Pro is compatible.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function pro_is_compatible() {
	return function_exists( __NAMESPACE__ . '\autoload_files' );
}
