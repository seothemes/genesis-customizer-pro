<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'radio-buttonset',
		'settings' => 'size',
		'label'    => esc_html__( 'Screen Size', 'genesis-customizer' ),
		'default'  => 'all',
		'choices'  => [
			'all'     => esc_html__( 'All', 'genesis-customizer' ),
			'mobile'  => esc_html__( 'Mobile', 'genesis-customizer' ),
			'desktop' => esc_html__( 'Desktop', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'tip',
		'default'  => sprintf(
			'<p><strong>%s</strong> %s <a href="%s" target="_blank">%s</a> %s</p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'The responsive breakpoint setting can be changed from the ', 'genesis-customizer' ),
			admin_url( 'admin.php?page=genesis-customizer&tab=general' ),
			esc_html__( 'General Settings', 'genesis-customizer' ),
			esc_html__( 'page', 'genesis-customizer' )
		),
	],
	[
		'type'            => 'code',
		'settings'        => 'all',
		'default'         => '',
		'choices'         => [
			'language' => 'css',
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'size' ),
				'operator' => '===',
				'value'    => 'all',
			],
		],
	],
	[
		'type'            => 'code',
		'settings'        => 'mobile',
		'default'         => '',
		'choices'         => [
			'language' => 'css',
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'size' ),
				'operator' => '===',
				'value'    => 'mobile',
			],
		],
	],
	[
		'type'            => 'code',
		'settings'        => 'desktop',
		'default'         => '',
		'choices'         => [
			'language' => 'css',
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'size' ),
				'operator' => '===',
				'value'    => 'desktop',
			],
		],
	],
];
