<?php

namespace GenesisCustomizer;

add_action( 'genesis_setup', __NAMESPACE__ . '\autoload_pro_files' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_pro_files() {
	foreach ( glob( _get_pro_path() . 'src/modules/*.php' ) as $file_name ) {
		if ( file_exists( $file_name ) ) {
			require_once $file_name;
		}
	}

	if ( is_admin() ) {
		foreach ( glob( _get_pro_path() . 'src/admin/*.php' ) as $file_name ) {
			if ( file_exists( $file_name ) ) {
				require_once $file_name;
			}
		}
	}
}
