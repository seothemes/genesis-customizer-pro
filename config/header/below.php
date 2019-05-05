<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'custom',
		'settings' => 'tip',
		'default'  => sprintf(
			'<p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer-pro' ),
			esc_html__( 'This is a widget area. Add or remove widgets from the  ', 'genesis-customizer-pro' ),
			esc_attr( '"sidebar-widgets-below-header"' ),
			esc_html__( 'Below Header Widgets Screen', 'genesis-customizer-pro' )
		),
	],
	[
		'type'     => 'radio',
		'settings' => 'enabled',
		'label'    => __( 'Enable on', 'genesis-customizer-pro' ),
		'default'  => 'hide-mobile',
		'choices'  => [
			'show'         => __( 'Desktop and Mobile', 'genesis-customizer-pro' ),
			'hide-mobile'  => __( 'Desktop', 'genesis-customizer-pro' ),
			'hide-desktop' => __( 'Mobile', 'genesis-customizer-pro' ),
			'hide'         => __( 'None', 'genesis-customizer-pro' ),
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
		'label'       => __( 'Layout', 'genesis-customizer-pro' ),
		'default'     => 'center',
		'collapsible' => true,
		'choices'     => [
			'space-between' => _get_url() . 'assets/img/above-header-full.gif',
			'flex-start'    => _get_url() . 'assets/img/above-header-left.gif',
			'center'        => _get_url() . 'assets/img/above-header-center.gif',
			'flex-end'      => _get_url() . 'assets/img/above-header-right.gif',
		],
		'output'      => [
			[
				'element'  => '.below-header .wrap',
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
		'type'     => 'radio-buttonset',
		'settings' => 'type',
		'label'    => esc_html__( 'Text Alignment', 'genesis-customizer-pro' ),
		'default'  => 'center',
		'choices'  => [
			'left'   => esc_html__( 'Left', 'genesis-customizer-pro' ),
			'center' => esc_html__( 'Center', 'genesis-customizer-pro' ),
			'right'  => esc_html__( 'Right', 'genesis-customizer-pro' ),
		],
		'output'   => [
			[
				'element'  => '.below-header',
				'property' => 'text-align',
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
		'label'    => __( 'Colors', 'genesis-customizer-pro' ),
		'choices'  => [
			'background'  => __( 'Background', 'genesis-customizer-pro' ),
			'headings'    => __( 'Headings', 'genesis-customizer-pro' ),
			'text'        => __( 'Text', 'genesis-customizer-pro' ),
			'links'       => __( 'Links', 'genesis-customizer-pro' ),
			'links-hover' => __( 'Links Hover', 'genesis-customizer-pro' ),
		],
		'default'  => [
			'background'  => _get_color( 'background' ),
			'headings'    => _get_color( 'heading' ),
			'text'        => _get_color( 'text' ),
			'links'       => _get_color( 'accent' ),
			'links-hover' => _get_color( 'accent' ),
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.below-header:before',
				'property' => 'background-color',
			],
			[
				'choice'   => 'headings',
				'element'  => [
					'.below-header .wrap h1',
					'.below-header .wrap h2',
					'.below-header .wrap h3',
					'.below-header .wrap h4',
					'.below-header .wrap h5',
					'.below-header .wrap h6',
				],
				'property' => 'color',
			],
			[
				'choice'   => 'text',
				'element'  => '.below-header .wrap',
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.below-header .wrap a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => '.below-header .wrap a:hover, .below-header .wrap a:focus',
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
		'type'     => 'dimensions',
		'settings' => 'typography',
		'label'    => __( 'Typography', 'genesis-customizer-pro' ),
		'default'  => [
			'mobile'  => _get_size( 's' ),
			'desktop' => '',
		],
		'choices'  => [
			'labels' => [
				'mobile'  => __( 'Font Size Mobile', 'genesis-customizer-pro' ),
				'desktop' => __( 'Font Size Desktop', 'genesis-customizer-pro' ),
			],
		],
		'output'   => [
			[
				'choice'   => 'mobile',
				'element'  => '.below-header, .below-header a',
				'property' => 'font-size',
			],
			[
				'choice'      => 'desktop',
				'element'     => '.below-header, .below-header a',
				'property'    => 'font-size',
				'media_query' => _get_media_query(),
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
		'default'  => _get_size( 'xl', '' ),
		'choices'  => [
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		],
		'output'   => [
			[
				'element'       => '.below-header',
				'property'      => 'padding',
				'value_pattern' => '$px 0',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'        => 'background',
		'settings'    => 'background-image',
		'label'       => esc_html__( 'Background Image', 'genesis-customizer-pro' ),
		'default'     => [
			'background-image'    => '',
			'background-repeat'   => 'repeat',
			'background-position' => 'center center',
			'background-size'     => 'cover',
		],
		'output'      => [
			[
				'element' => '.below-header',
			],
		],
	],
];
