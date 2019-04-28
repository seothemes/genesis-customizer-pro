<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'custom',
		'settings' => 'tip',
		'default'  => sprintf(
			'<p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'This is a widget area. Add or remove widgets from the  ', 'genesis-customizer' ),
			esc_attr( '"sidebar-widgets-above-header"' ),
			esc_html__( 'Above Header Widgets Screen', 'genesis-customizer' )
		),
	],
	[
		'type'     => 'radio',
		'settings' => 'enabled',
		'label'    => __( 'Enable on', 'genesis-customizer' ),
		'default'  => 'hide-mobile',
		'choices'  => [
			'show'         => __( 'Desktop and Mobile', 'genesis-customizer' ),
			'hide-mobile'  => __( 'Desktop', 'genesis-customizer' ),
			'hide-desktop' => __( 'Mobile', 'genesis-customizer' ),
			'hide'         => __( 'None', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'        => 'radio-image',
		'settings'    => 'layout',
		'label'       => __( 'Layout', 'genesis-customizer' ),
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
				'element'  => '.above-header .wrap',
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
		'settings' => 'color',
		'label'    => __( 'Colors', 'genesis-customizer' ),
		'choices'  => [
			'background'  => __( 'Background', 'genesis-customizer' ),
			'text'        => __( 'Text', 'genesis-customizer' ),
			'links'       => __( 'Links', 'genesis-customizer' ),
			'links-hover' => __( 'Links Hover', 'genesis-customizer' ),
		],
		'default'  => [
			'background'  => _get_color( 'heading' ),
			'text'        => _get_color( 'border' ),
			'links'       => _get_color( 'border' ),
			'links-hover' => _get_color( 'white' ),
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.above-header',
				'property' => 'background-color',
			],
			[
				'choice'   => 'text',
				'element'  => '.above-header',
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.above-header a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => '.above-header a:hover, .above-header a:focus',
				'property' => 'color',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'typography',
		'settings' => 'typography',
		'label'    => __( 'Typography', 'genesis-customizer' ),
		'default'  => [
			'font-family' => '',
			'font-size'   => _get_size( 'xs' ),
			'variant'     => 'bolder',
			'line-height' => '1',
		],
		'output'   => [
			[
				'element' => '.above-header',
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
		'settings' => 'height',
		'label'    => __( 'Height', 'genesis-customizer' ),
		'default'  => '40',
		'choices'  => [
			'min'  => 20,
			'max'  => 200,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.above-header',
				'property' => 'height',
				'units'    => 'px',
			],
		],
	],
];
