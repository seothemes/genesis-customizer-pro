<?php

namespace GenesisCustomizer;

// Load class.
require_once _get_pro_path() . 'src/classes/class-admin-settings.php';

add_action( 'genesis_admin_menu', __NAMESPACE__ . '\admin_settings' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function admin_settings() {
	global $_genesis_customizer_settings;

	$_genesis_customizer_settings = new Admin_Settings();
}

add_filter( 'genesis_customizer_page_settings', __NAMESPACE__ . '\pro_page_settings' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $defaults
 *
 * @return array
 */
function pro_page_settings( $defaults ) {
	return array_merge_recursive( $defaults, [
		'hero_section'       => 'hero_disabled',
		'sticky_header'      => 'sticky_disabled',
		'transparent_header' => 'transparent_disabled',
	] );
}
