<?php

namespace GenesisCustomizer;

add_filter( 'genesis_customizer_font_choices', __NAMESPACE__ . '\add_typekit_group', 20 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $custom
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
		'text'     => esc_attr__( 'Typekit', 'genesis-customizer' ),
		'children' => $children,
	];

	$custom['variants'] = $variants;

	return $custom;
}
