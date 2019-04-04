<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'custom',
		'settings' => 'tip-1',
		'default'  => sprintf(
			'<p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'This is a widget area. Add or remove widgets from the  ', 'genesis-customizer' ),
			esc_attr( '"sidebar-widgets-below-header"' ),
			esc_html__( 'Below Header Widgets Screen', 'genesis-customizer' )
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
		'settings' => 'divider-1',
		'default'  => '<hr>',
		'required' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => 'none',
				'operator' => '!==',
			],
		],
	],
	[
		'type'        => 'radio-image',
		'settings'    => 'layout',
		'label'       => __( 'Layout', 'genesis-customizer' ),
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
		'required'    => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => 'none',
				'operator' => '!==',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-2',
		'default'  => '<hr>',
		'required' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => 'none',
				'operator' => '!==',
			],
		],
	],
	[
		'type'     => 'radio-buttonset',
		'settings' => 'type',
		'label'    => esc_html__( 'Text Alignment', 'genesis-customizer' ),
		'default'  => 'center',
		'choices'  => [
			'left'   => esc_html__( 'Left', 'genesis-customizer' ),
			'center' => esc_html__( 'Center', 'genesis-customizer' ),
			'right'  => esc_html__( 'Right', 'genesis-customizer' ),
		],
		'output'   => [
			[
				'element'       => '.below-header',
				'property'      => 'text-align',
			],
		],
		'required' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => 'none',
				'operator' => '!==',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-9832',
		'default'  => '<hr>',
	],
	[
		'type'     => 'multicolor',
		'settings' => 'color',
		'label'    => __( 'Colors', 'genesis-customizer' ),
		'choices'  => [
			'background'  => __( 'Background', 'genesis-customizer' ),
			'headings'    => __( 'Headings', 'genesis-customizer' ),
			'text'        => __( 'Text', 'genesis-customizer' ),
			'links'       => __( 'Links', 'genesis-customizer' ),
			'links-hover' => __( 'Links Hover', 'genesis-customizer' ),
		],
		'default'  => [
			'background'  => '',
			'headings'    => '',
			'text'        => '',
			'links'       => '',
			'links-hover' => '',
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.below-header',
				'property' => 'background-color',
			],
			[
				'choice'   => 'headings',
				'element'  => [
					'.below-header h1',
					'.below-header h2',
					'.below-header h3',
					'.below-header h4',
					'.below-header h5',
					'.below-header h6',
				],
				'property' => 'color',
			],
			[
				'choice'   => 'text',
				'element'  => '.below-header',
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.below-header a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => '.below-header a:hover, .footer-widgets a:focus',
				'property' => 'color',
			],
		],
		'required' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => 'none',
				'operator' => '!==',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-3',
		'default'  => '<hr>',
	],
	[
		'type'     => 'dimensions',
		'settings' => 'typography',
		'label'    => __( 'Typography', 'genesis-customizer' ),
		'default'  => [
			'mobile'  => _get_size( 's' ),
			'desktop' => '',
		],
		'choices'  => [
			'labels' => [
				'mobile'  => __( 'Font Size Mobile', 'genesis-customizer' ),
				'desktop' => __( 'Font Size Desktop', 'genesis-customizer' ),
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
		'required' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => 'none',
				'operator' => '!==',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-4',
		'default'  => '<hr>',
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing',
		'label'    => __( 'Spacing', 'genesis-customizer' ),
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
		'required' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => 'none',
				'operator' => '!==',
			],
		],
	],
];
