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

