<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds Pro admin settings to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

$handle = _get_pro_handle();

add_filter( "plugin_action_links_$handle/$handle.php", __NAMESPACE__ . '\pro_settings_link' );
/**
 * Adds settings link to Pro plugin.
 *
 * @since 1.0.0
 *
 * @param array $links Plugin links.
 *
 * @return array
 */
function pro_settings_link( $links ) {
	$links[] = sprintf(
		'<a href="%s">%s</a>',
		admin_url( 'admin.php?page=genesis-customizer' ),
		__( 'Settings', 'genesis-customizer-pro' )
	);

	return $links;
}

add_filter( 'genesis_customizer_page_settings', __NAMESPACE__ . '\pro_page_settings' );
/**
 * Adds extra settings to meta box.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default meta box settings.
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
 * Adds extra admin settings tabs.
 *
 * @since 1.0.0
 *
 * @param array $settings Default settings.
 *
 * @return array
 */
function pro_settings_fields( $settings ) {
	$settings['modules'] = [
		'title'       => __( 'Modules', 'genesis-customizer-pro' ),
		'description' => __( 'Enable or disable Genesis Customizer modules here.', 'genesis-customizer-pro' ),
		'priority'    => 2,
		'fields'      => [
			[
				'id'      => 'modules',
				'label'   => __( 'Modules', 'genesis-customizer-pro' ),
				'type'    => 'checkbox_multi',
				'options' => _get_pro_modules(),
				'default' => array_keys( _get_pro_modules() ),
			],
		],
	];

	$settings['license'] = [
		'title'       => __( 'License', 'genesis-customizer-pro' ),
		'description' => __( 'Enter your license key below and click "Save Settings". Once your settings have been saved, click "Activate License".', 'genesis-customizer-pro' ),
		'priority'    => 3,
		'fields'      => [
			[
				'id'          => 'license-key',
				'label'       => __( 'License Key', 'genesis-customizer-pro' ),
				'type'        => 'license',
				'default'     => '',
				'placeholder' => '',
				'callback'    => __NAMESPACE__ . '\sanitize_pro_license',
			],
		],
	];

	return $settings;
}
