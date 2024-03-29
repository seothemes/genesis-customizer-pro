<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds the file autoloader to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

add_action( 'genesis_setup', __NAMESPACE__ . '\autoload_pro_files' );
/**
 * Loads pro files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_pro_files() {

	// Modules.
	$modules = apply_filters( 'genesis_customizer_modules', _get_pro_modules() );

	foreach ( $modules as $module => $name ) {
		$file_name = _get_pro_path() . 'src/modules/' . $module . '.php';

		require_once $file_name;
	}

	// Admin.
	if ( is_admin() ) {
		foreach ( glob( _get_pro_path() . 'src/admin/*.php' ) as $file_name ) {
			require_once $file_name;
		}
	}
}
