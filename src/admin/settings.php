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

	return $settings;
}
