<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'multicolor',
		'settings' => 'colors',
		'label'    => __( 'Colors', 'genesis-customizer-pro' ),
		'choices'  => [
			'text'       => __( 'Link Text', 'genesis-customizer-pro' ),
			'text-hover' => __( 'Link Text Hover', 'genesis-customizer-pro' ),
			'background' => __( 'Button Background', 'genesis-customizer-pro' ),
			'icon'       => __( 'Button Icon', 'genesis-customizer-pro' ),
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
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'checkbox',
		'settings' => 'enabled',
		'label'    => __( 'Show scroll to top link', 'genesis-customizer-pro' ),
		'default'  => true,
	],
	[
		'type'            => 'select',
		'settings'        => 'style',
		'label'           => __( 'Style', 'genesis-customizer-pro' ),
		'default'         => [
			'text',
		],
		'choices'         => [
			'text'   => __( 'Text Link', 'genesis-customizer-pro' ),
			'button' => __( 'Fixed Button', 'genesis-customizer-pro' ),
			'html'   => __( 'Custom HTML', 'genesis-customizer-pro' ),
		],
		'active_callback' => [
		],
	],
	[
		'type'            => 'text',
		'settings'        => 'text',
		'label'           => __( 'Text', 'genesis-customizer-pro' ),
		'default'         => __( 'Scroll to top', 'genesis-customizer-pro' ),
		'active_callback' => [
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
		'label'           => __( 'Custom HTML', 'genesis-customizer-pro' ),
		'default'         => '<a href="#top">' . __( 'Scroll to top', 'genesis-customizer-pro' ) . '</a>',
		'active_callback' => [
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
		'label'           => __( 'Button Size', 'genesis-customizer-pro' ),
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
				'setting'  => _get_setting( 'style' ),
				'value'    => 'button',
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'slider',
		'settings'        => 'radius',
		'label'           => __( 'Border Radius', 'genesis-customizer-pro' ),
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
				'setting'  => _get_setting( 'style' ),
				'value'    => 'button',
				'operator' => '===',
			],
		],
	],
];
