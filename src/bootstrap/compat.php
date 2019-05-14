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

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$parent_theme = wp_get_theme()->parent();

if ( ! is_plugin_active( 'genesis-customizer/genesis-customizer.php' ) || ! $parent_theme || 'Genesis' !== $parent_theme->get( 'Name' ) ) {

	add_action( 'plugins_loaded', __NAMESPACE__ . '\pro_init_deactivation' );
	/**
	 * Initialize deactivation functions.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function pro_init_deactivation() {
		if ( current_user_can( 'activate_plugins' ) ) {
			add_action( 'admin_init', __NAMESPACE__ . '\pro_deactivate' );
			add_action( 'admin_notices', __NAMESPACE__ . '\pro_deactivation_notice' );
		}
	}

	/**
	 * Deactivate the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function pro_deactivate() {
		$file = 'genesis-customizer-pro/genesis-customizer-pro.php';

		deactivate_plugins( plugin_basename( $file ) );
	}

	/**
	 * Show deactivation admin notice.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function pro_deactivation_notice() {
		printf(
			'<div class="notice notice-error"><p><b>%s</b> %s</p></div>',
			esc_html__( 'Genesis Customizer Pro', 'genesis-customizer-pro' ),
			esc_html__( 'requires the Genesis Customizer plugin to run and has been deactivated.', 'genesis-customizer-pro' )
		);

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}

	return false;
}

// Return true if checks passed.
return true;
