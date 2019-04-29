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

	$custom['families']['custom_fonts'] = [
		'text'     => esc_attr__( 'Typekit', 'genesis-customizer' ),
		'children' => $children,
	];

	$custom['variants'] = $variants;

	return $custom;
}

add_filter( 'genesis_customizer_field', __NAMESPACE__ . '\add_font_choices', 10, 2 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $field
 *
 * @return mixed
 */
function add_font_choices( $field ) {
	if ( $field['type'] === 'typography' ) {
		$field['choices'] = [
			'fonts' => apply_filters( 'genesis_customizer_font_choices', [] ),
		];
	}

	return $field;
}
