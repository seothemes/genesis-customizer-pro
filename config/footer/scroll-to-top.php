<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'multicolor',
		'settings' => 'colors',
		'label'    => __( 'Colors', 'genesis-customizer' ),
		'choices'  => [
			'text'       => __( 'Link Text', 'genesis-customizer' ),
			'text-hover' => __( 'Link Text Hover', 'genesis-customizer' ),
			'background' => __( 'Button Background', 'genesis-customizer' ),
			'icon'       => __( 'Button Icon', 'genesis-customizer' ),
		],
		'default'  => [
			'text'       => '',
			'text-hover' => '',
			'background' => _get_color( 'heading' ),
			'icon'       => _get_color( 'white' ),
		],
		'output'   => [
			[
				'choice'   => 'text',
				'element'  => '.scroll-to-top',
				'property' => 'color',
			],
			[
				'choice'   => 'text-hover',
				'element'  => '.scroll-to-top:hover, .scroll-to-top:focus',
				'property' => 'color',
			],
			[
				'choice'   => 'background',
				'element'  => '.scroll-to-top-icon',
				'property' => 'background-color',
			],
			[
				'choice'   => 'icon',
				'element'  => '.scroll-to-top-icon svg',
				'property' => 'fill',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-2',
		'default'  => '<hr>',
	],
	[
		'type'     => 'checkbox',
		'settings' => 'enabled',
		'label'    => __( 'Show scroll to top link', 'genesis-customizer' ),
		'default'  => true,
	],
	[
		'type'            => 'select',
		'settings'        => 'style',
		'label'           => __( 'Style', 'genesis-customizer' ),
		'default'         => [
			'text',
		],
		'choices'         => [
			'text'   => __( 'Text Link', 'genesis-customizer' ),
			'button' => __( 'Fixed Button', 'genesis-customizer' ),
			'html'   => __( 'Custom HTML', 'genesis-customizer' ),
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => true,
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'text',
		'settings'        => 'text',
		'label'           => __( 'Text', 'genesis-customizer' ),
		'default'         => __( 'Scroll to top', 'genesis-customizer' ),
		'active_callback' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => true,
				'operator' => '===',
			],
			[
				'setting'  => _get_setting( 'style' ),
				'value'    => 'text',
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'textarea',
		'settings'        => 'html',
		'label'           => __( 'Custom HTML', 'genesis-customizer' ),
		'default'         => '<a href="#top">' . __( 'Scroll to top', 'genesis-customizer' ) . '</a>',
		'active_callback' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => true,
				'operator' => '===',
			],
			[
				'setting'  => _get_setting( 'style' ),
				'value'    => 'html',
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'slider',
		'settings'        => 'size',
		'label'           => __( 'Button Size', 'genesis-customizer' ),
		'default'         => '30',
		'choices'         => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
		'output'          => [
			[
				'element'  => '.scroll-to-top-icon',
				'property' => 'height',
				'units'    => 'px',
			],
			[
				'element'  => '.scroll-to-top-icon',
				'property' => 'width',
				'units'    => 'px',
			],
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => true,
				'operator' => '===',
			],
			[
				'setting'  => _get_setting( 'style' ),
				'value'    => 'button',
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'slider',
		'settings'        => 'radius',
		'label'           => __( 'Border Radius', 'genesis-customizer' ),
		'default'         => '4',
		'choices'         => [
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		],
		'output'          => [
			[
				'element'  => '.scroll-to-top-icon',
				'property' => 'border-radius',
				'units'    => 'px',
			],
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => true,
				'operator' => '===',
			],
			[
				'setting'  => _get_setting( 'style' ),
				'value'    => 'button',
				'operator' => '===',
			],
		],
	],
];
