<?php

namespace GenesisCustomizer;

// Enable config.
add_filter('genesis-customizer_header_transparent_module', '__return_true' );

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
	$header_layout       = _get_value( 'header_primary_layout' );
	$transparent_enabled = _get_value( 'header_transparent_enabled' );
	$has_different_logo  = _get_value( 'header_transparent_different-logo' );
	$different_logo      = _get_value( 'header_transparent_logo' );
	$page_templates      = [
		'blocks.php',
		'beaver-builder.php',
		'elementor_header_footer',
	];

	if ( 'no-transparent-header' !== $transparent_enabled && $has_different_logo && $different_logo ) {
		$classes[] = 'wp-custom-logo';
		$classes[] = 'has-transparent-logo';
	}

	if ( 'no-transparent-header' !== $transparent_enabled && 'has-logo-side' !== $header_layout && ( in_array( 'has-hero-section', $classes ) || is_page_template( $page_templates ) ) ) {
		$classes[] = $transparent_enabled;

	} else {
		$classes[] = 'no-transparent-header';
	}

	return $classes;
}
