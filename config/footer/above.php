<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'checkbox',
		'settings' => 'enabled',
		'label'    => __( 'Display Above Footer section', 'genesis-customizer-pro' ),
		'default'  => true,
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'        => 'radio-image',
		'settings'    => 'layout',
		'label'       => __( 'Layout', 'genesis-customizer-pro' ),
		'default'     => 'space-between',
		'collapsible' => true,
		'choices'     => [
			'space-between' => _get_url() . 'assets/img/above-header-full.gif',
			'flex-start'    => _get_url() . 'assets/img/above-header-left.gif',
			'center'        => _get_url() . 'assets/img/above-header-center.gif',
			'flex-end'      => _get_url() . 'assets/img/above-header-right.gif',
		],
		'output'      => [
			[
				'element'  => '.above-footer .wrap',
				'property' => 'justify-content',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'multicolor',
		'settings' => 'colors',
		'label'    => __( 'Colors', 'genesis-customizer-pro' ),
		'choices'  => [
			'text'        => __( 'Text', 'genesis-customizer-pro' ),
			'headings'    => __( 'Headings', 'genesis-customizer-pro' ),
			'links'       => __( 'Links', 'genesis-customizer-pro' ),
			'links-hover' => __( 'Links Hover', 'genesis-customizer-pro' ),
			'border'      => __( 'Border', 'genesis-customizer-pro' ),
		],
		'default'  => [
			'text'        => '',
			'headings'    => '',
			'links'       => '',
			'links-hover' => '',
			'border'      => _get_color( 'border' ),
		],
		'output'   => [
			[
				'choice'   => 'text',
				'element'  => '.above-footer',
				'property' => 'color',
			],
			[
				'choice'   => 'headings',
				'element'  => [
					'.above-footer h1',
					'.above-footer h2',
					'.above-footer h3',
					'.above-footer h4',
					'.above-footer h5',
					'.above-footer h6',
				],
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.above-footer a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => '.above-footer a:hover, .above-footer a:focus',
				'property' => 'color',
			],
			[
				'choice'   => 'border',
				'element'  => '.above-footer',
				'property' => 'border-color',
			],
		],
	],
	[
		'type'      => 'multicolor',
		'settings'  => 'gradient',
		'label'     => __( 'Gradient Overlay', 'genesis-customizer-pro' ),
		'transport' => 'refresh',
		'choices'   => [
			'left'  => __( 'Background Left', 'genesis-customizer-pro' ),
			'right' => __( 'Background Right', 'genesis-customizer-pro' ),
		],
		'default'   => [
			'left'  => '',
			'right' => '',
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'angle',
		'label'    => __( 'Gradient Angle', 'genesis-customizer-pro' ),
		'default'  => '135',
		'choices'  => [
			'min'  => 0,
			'max'  => 360,
			'step' => 1,
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing',
		'label'    => __( 'Spacing', 'genesis-customizer-pro' ),
		'default'  => '60',
		'choices'  => [
			'min'  => 0,
			'max'  => 300,
			'step' => 10,
		],
		'output'   => [
			[
				'element'  => '.above-footer',
				'property' => 'padding-top',
				'units'    => 'px',
			],
			[
				'element'  => '.above-footer',
				'property' => 'padding-bottom',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'dimensions',
		'settings' => 'border-width',
		'label'    => __( 'Border Width', 'genesis-customizer-pro' ),
		'default'  => [
			'border-top-width'    => '',
			'border-bottom-width' => '1px',
		],
		'choices'  => [
			'labels' => [
				'border-top-width'    => __( 'Border Top Width', 'genesis-customizer-pro' ),
				'border-bottom-width' => __( 'Border Bottom Width', 'genesis-customizer-pro' ),
			],
		],
		'output'   => [
			[
				'choice'   => 'border-top-width',
				'element'  => '.above-footer',
				'property' => 'border-top-width',
			],
			[
				'choice'  => 'border-bottom-width',
				'element' => '.above-footer',
				'property' => 'border-bottom-width',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'background',
		'settings' => 'background',
		'label'    => __( 'Background Image', 'genesis-customizer-pro' ),
		'default'  => [
			'background-image'      => '',
			'background-repeat'     => '',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => '',
		],
		'output'   => [
			[
				'element' => '.above-footer',
			],
		],
	],
];
