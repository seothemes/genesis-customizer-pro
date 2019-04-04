<?php

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_general_performance_config', '__return_true' );

add_action( 'genesis_setup', __NAMESPACE__ . '\load_child_theme_css', 15 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_child_theme_css() {
	$load  = _get_value( 'general_performance_child-theme-css' );
	$trump = _get_value( 'general_performance_style-trump' );

	if ( ! $load || $trump ) {
		remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	}

	if ( $trump ) {
		add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 999 );
	}
}
