<?php

namespace GenesisCustomizer;

$handle = _get_pro_handle();

add_filter( "plugin_action_links_$handle/$handle.php", __NAMESPACE__ . '\pro_settings_link' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $links
 *
 * @return array
 */
function pro_settings_link( $links ) {
	$links[] = sprintf(
		'<a href="%s">%s</a>',
		admin_url( 'admin.php?page=genesis-customizer' ),
		__( 'Settings', 'genesis-customizer' )
	);

	return $links;
}

add_filter( 'genesis_customizer_page_settings', __NAMESPACE__ . '\pro_page_settings' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $defaults
 *
 * @return array
 */
function pro_page_settings( $defaults ) {
	return array_merge_recursive( $defaults, [
		'hero_section'       => 'hero_disabled',
		'sticky_header'      => 'sticky_disabled',
		'transparent_header' => 'transparent_disabled',
	] );
}

add_filter( 'genesis_customizer_settings_fields', __NAMESPACE__ . '\pro_settings_fields' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $settings
 *
 * @return mixed
 */
function pro_settings_fields( $settings ) {
	$settings['modules'] = [
		'title'       => __( 'Modules', 'genesis-customizer' ),
		'description' => __( 'Enable or disable Genesis Customizer modules here.', 'genesis-customizer' ),
		'priority'    => 2,
		'fields'      => [
			[
				'id'      => 'modules',
				'label'   => __( 'Modules', 'genesis-customizer' ),
				'type'    => 'checkbox_multi',
				'options' => _get_pro_modules(),
				'default' => array_keys( _get_pro_modules() ),
			],
		],
	];

	$settings['license'] = [
		'title'       => __( 'License', 'genesis-customizer' ),
		'description' => __( 'Enter your license key to enable automatic updates.', 'genesis-customizer' ),
		'priority'    => 3,
		'fields'      => [
			[
				'id'          => 'license-key',
				'label'       => __( 'License Key', 'genesis-customizer' ),
				'type'        => 'license',
				'default'     => '',
				'placeholder' => __( '', 'genesis-customizer' ),
				'callback'    => __NAMESPACE__ . '\sanitize_pro_license',
			],
		],
	];

	if ( _is_module_enabled( 'typekit-fonts' ) ) {

		$settings['typekit'] = [
			'title'       => __( 'Typekit', 'genesis-customizer' ),
			'description' => __( '', 'genesis-customizer' ),
			'priority'    => 6,
			'fields'      => [
				[
					'id'      => 'typekit-enable',
					'label'   => __( 'Enable', 'genesis-customizer' ),
					'type'    => 'radio',
					'options' => [
						'enable'  => __( 'Enable &nbsp;', 'genesis-customizer' ),
						'disable' => __( 'Disable', 'genesis-customizer' ),
					],
					'default' => 'disable',
				],
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
	}

	return $settings;
}
