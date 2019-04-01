<?php

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
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function pro_deactivation_notice() {
	if ( ! pro_is_compatible() ) {
		return printf(
			'<div class="notice notice-error"><p><b>%s</b> %s</p></div>',
			__( 'Genesis Customizer Pro', 'genesis-customizer-pro' ),
			__( 'requires the Genesis Customizer plugin to run and has been deactivated.', 'genesis-customizer-pro' )
		);

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function pro_is_compatible() {
	return function_exists( __NAMESPACE__ . '\autoload' );
}
