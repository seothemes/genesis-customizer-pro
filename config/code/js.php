<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'select',
		'settings' => 'output',
		'label'    => esc_html__( 'Output', 'genesis-customizer-pro' ),
		'default'  => 'inline',
		'choices'  => [
			'inline' => esc_html__( 'Inline', 'genesis-customizer-pro' ),
			'file'   => esc_html__( 'File', 'genesis-customizer-pro' ),
		],
	],
	[
		'type'     => 'radio-buttonset',
		'settings' => 'type',
		'label'    => esc_html__( 'Type', 'genesis-customizer-pro' ),
		'default'  => 'jquery',
		'choices'  => [
			'jquery'  => esc_html__( 'jQuery', 'genesis-customizer-pro' ),
			'vanilla' => esc_html__( 'Vanilla', 'genesis-customizer-pro' ),
		],
	],
	[
		'type'            => 'code',
		'settings'        => 'jquery',
		'default'         => '',
		'choices'         => [
			'language' => 'javascript',
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'type' ),
				'operator' => '===',
				'value'    => 'jquery',
			],
		],
	],
	[
		'type'            => 'code',
		'settings'        => 'vanilla',
		'default'         => '',
		'choices'         => [
			'language' => 'javascript',
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'type' ),
				'operator' => '===',
				'value'    => 'vanilla',
			],
		],
	],
];
