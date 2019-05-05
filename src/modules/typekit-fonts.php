<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds the Typekit Fonts module to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

add_filter( 'genesis_customizer_font_choices', __NAMESPACE__ . '\add_typekit_group', 20 );
/**
 * Adds typekit font choices to typography controls.
 *
 * @since 1.0.0
 *
 * @param array $custom Custom fonts.
 *
 * @return mixed
 */
function add_typekit_group( $custom ) {
	$children = [];
	$variants = [];
	$option   = get_option( 'custom-typekit-fonts' );
	$fonts    = $option['custom-typekit-font-details'];

	if ( ! is_array( $fonts ) ) {
		return $custom;
	}

	foreach ( $fonts as $key => $font ) {
		$children[] = [
			'id'   => $font['slug'],
			'text' => $font['family'],
		];

		$variants[ $font['slug'] ] = $font['weights'];
	}

	$custom['families']['typekit'] = [
		'text'     => esc_attr__( 'Typekit', 'genesis-customizer-pro' ),
		'children' => $children,
	];

	$custom['variants'] = $variants;

	return $custom;
}
