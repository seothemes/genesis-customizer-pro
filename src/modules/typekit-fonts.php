<?php

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_general_typekit_config', '__return_true' );

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\load_typekit' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_typekit() {
	$id = _get_option( 'typekit-id' );

	wp_enqueue_style(
		_get_handle() . '-typekit',
		'https://use.typekit.net/' . esc_attr( $id ) . '.css',
		[],
		_get_version()
	);
}

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
	$fonts    = _get_option( 'typekit-font-family' );

	if ( ! is_array( $fonts ) ) {
		return $custom;
	}

	foreach ( $fonts as $key => $font ) {
		$children[] = [
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
		$field['choices'] = [
			'fonts' => apply_filters( 'genesis_customizer_font_choices', [] ),
		];
	}

	return $field;
}

add_filter( 'genesis_customizer_settings_fields', __NAMESPACE__ . '\typekit_settings_fields' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $settings
 *
 * @return mixed
 */
function typekit_settings_fields( $settings ) {
	$settings['typekit'] = [
		'title'       => __( 'Typekit', 'genesis-customizer' ),
		'description' => __( '', 'genesis-customizer' ),
		'priority'    => 6,
		'fields'      => [
			[
				'id'          => 'typekit-id',
				'label'       => __( 'Project ID', 'genesis-customizer' ),
				'description' => __( 'Enter your Typekit Project ID here. The Project ID can be found in your Web Project page https://fonts.adobe.com/my_fonts#web_projects-section', 'genesis-customizer' ),
				'type'        => 'text',
				'default'     => '',
				'placeholder' => '',
			],
			[
				'id'          => 'typekit-font-family',
				'label'       => __( 'Font Family', 'genesis-customizer' ),
				'description' => __( 'Enter the font family and font stack here. E.g museo-sans, sans-serif.', 'genesis-customizer' ),
				'type'        => 'text',
				'default'     => '',
				'placeholder' => 'museo-sans, sans-serif',
			],
			[
				'id'      => 'typekit-font-variants',
				'label'   => __( 'Font Variants', 'genesis-customizer' ),
				'type'    => 'checkbox_multi',
				'options' => [
					'100'  => __( '100', 'genesis-customizer' ),
					'100i' => __( '100 Italic', 'genesis-customizer' ),
					'200'  => __( '200', 'genesis-customizer' ),
					'200i' => __( '200 Italic', 'genesis-customizer' ),
					'300'  => __( '300', 'genesis-customizer' ),
					'300i' => __( '300 Italic', 'genesis-customizer' ),
					'400'  => __( '400', 'genesis-customizer' ),
					'400i' => __( '400 Italic', 'genesis-customizer' ),
					'500'  => __( '500', 'genesis-customizer' ),
					'500i' => __( '500 Italic', 'genesis-customizer' ),
					'600'  => __( '600', 'genesis-customizer' ),
					'600i' => __( '600 Italic', 'genesis-customizer' ),
					'700'  => __( '700', 'genesis-customizer' ),
					'700i' => __( '700 Italic', 'genesis-customizer' ),
					'800'  => __( '800', 'genesis-customizer' ),
					'800i' => __( '800 Italic', 'genesis-customizer' ),
					'900'  => __( '900', 'genesis-customizer' ),
					'900i' => __( '900 Italic', 'genesis-customizer' ),
				],
				'default' => [ '400' ],
			],
		],
	];

	return $settings;
}
