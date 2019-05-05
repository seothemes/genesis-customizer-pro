<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'checkbox',
		'settings' => 'enabled',
		'label'    => __( 'Display Below Footer section', 'genesis-customizer-pro' ),
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
				'element'  => '.below-footer .wrap',
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
			'background'  => __( 'Background', 'genesis-customizer-pro' ),
			'text'        => __( 'Text', 'genesis-customizer-pro' ),
			'headings'    => __( 'Headings', 'genesis-customizer-pro' ),
			'links'       => __( 'Links', 'genesis-customizer-pro' ),
			'links-hover' => __( 'Links Hover', 'genesis-customizer-pro' ),
			'border'      => __( 'Border', 'genesis-customizer-pro' ),
		],
		'default'  => [
			'background'  => '',
			'text'        => '',
			'headings'    => '',
			'links'       => '',
			'links-hover' => '',
			'border'      => _get_color( 'border' ),
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.below-footer',
				'property' => 'background-color',
			],
			[
				'choice'   => 'text',
				'element'  => '.below-footer',
				'property' => 'color',
			],
			[
				'choice'   => 'headings',
				'element'  => [
					'.below-footer h1',
					'.below-footer h2',
					'.below-footer h3',
					'.below-footer h4',
					'.below-footer h5',
					'.below-footer h6',
				],
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.below-footer a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => '.below-footer a:hover, .below-footer a:focus',
				'property' => 'color',
			],
			[
				'choice'   => 'border',
				'element'  => '.below-footer',
				'property' => 'border-color',
			],
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
				'element'  => '.below-footer',
				'property' => 'padding-top',
				'units'    => 'px',
			],
			[
				'element'  => '.below-footer',
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
				'element'  => '.below-footer',
				'property' => 'border-top-width',
			],
			[
				'choice'   => 'border-bottom-width',
				'element'  => '.below-footer',
				'property' => 'border-bottom-width',
			],
		],
	],
];
