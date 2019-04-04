<?php

namespace GenesisCustomizer;

// Enable config.
add_filter('genesis-customizer_general_typekit_config', '__return_true' );

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\load_typekit' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_typekit() {
	$enable = _get_value( 'general_typekit_enable' );

	if ( $enable ) {
		$id = _get_value( 'general_typekit_kit' );

		wp_enqueue_style(
			_get_handle() . '-typekit',
			'https://use.typekit.net/' . esc_attr( $id ) . '.css',
			[],
			_get_version()
		);
	}
}

add_filter( _get_handle() . '_font_choices', __NAMESPACE__ . '\add_typekit_group', 20 );
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
	$fonts    = _get_value( 'general_typekit_fonts' );

	if ( ! is_array( $fonts ) ) {
		return $custom;
	}

	foreach ( $fonts as $key => $font ) {
		$children[]                         = [
			'id'   => $font['font_css_name'],
			'text' => $font['font_name'],
		];
		$variants[ $font['font_css_name'] ] = $font['font_variants'];
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
		$field['choices'] = _get_font_choices();
	}

	return $field;
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return array
 */
function _get_font_choices() {
	return [
		'fonts' => apply_filters( _get_handle() . '_font_choices', [] ),
	];
}
