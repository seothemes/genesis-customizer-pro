<?php

namespace GenesisCustomizer;

// Enable config.
add_filter('genesis-customizer_header_sticky_config', '__return_true' );

add_filter( 'body_class', __NAMESPACE__ . '\sticky_header_logo_class', 1000 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $classes
 *
 * @return array
 */
function sticky_header_logo_class( $classes ) {
	$has_different_logo = _get_value( 'header_sticky_different-logo' );
	$different_logo     = _get_value( 'header_sticky_logo' );

	if ( _has_sticky_header() && $has_different_logo && $different_logo ) {
		$classes[] = 'wp-custom-logo';
		$classes[] = 'has-sticky-logo';
	}

	return $classes;
}
