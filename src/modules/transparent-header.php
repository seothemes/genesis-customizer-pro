<?php

namespace GenesisCustomizer;

// Enable config.
add_filter('genesis-customizer_header_transparent_config', '__return_true' );

add_filter( 'body_class', __NAMESPACE__ . '\transparent_header_logo_class', 1000 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $classes
 *
 * @return array
 */
function transparent_header_logo_class( $classes ) {
	$has_different_logo  = _get_value( 'header_transparent_different-logo' );
	$different_logo      = _get_value( 'header_transparent_logo' );

	if ( _has_transparent_header() && $has_different_logo && $different_logo ) {
		$classes[] = 'wp-custom-logo';
		$classes[] = 'has-transparent-logo';
	}

	return $classes;
}
