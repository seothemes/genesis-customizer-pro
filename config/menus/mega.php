<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'multicolor',
		'settings' => 'colors',
		'label'    => __( 'Colors', 'genesis-customizer-pro' ),
		'choices'  => [
			'background' => __( 'Background', 'genesis-customizer-pro' ),
			'title'      => __( 'Title', 'genesis-customizer-pro' ),
			'content'    => __( 'Content', 'genesis-customizer-pro' ),
			'link'       => __( 'Link', 'genesis-customizer-pro' ),
			'link-hover' => __( 'Link Hover', 'genesis-customizer-pro' ),
		],
		'default'  => [
			'background' => _get_color( 'background' ),
			'title'      => '',
			'content'    => '',
			'link'       => '',
			'link-hover' => '',
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.mega-menu .wrap',
				'property' => 'background-color',
			],
			[
				'choice'   => 'title',
				'element'  => '.mega-menu .widget-title',
				'property' => 'color',
			],
			[
				'choice'   => 'content',
				'element'  => '.mega-menu',
				'property' => 'color',
			],
			[
				'choice'   => 'link',
				'element'  => '.site-header .mega-menu .widget a',
				'property' => 'color',
			],
			[
				'choice'   => 'link-hover',
				'element'  => [
					'.site-header .mega-menu .widget a:hover',
					'.site-header .mega-menu .widget a:focus',
					'.site-header .mega-menu .widget .current-menu-item > a',
				],
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
		'type'     => 'slider',
		'settings' => 'spacing',
		'label'    => __( 'Spacing', 'genesis-customizer-pro' ),
		'default'  => _get_size( 'xl', '' ),
		'choices'  => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.mega-menu .wrap',
				'property' => 'padding',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'tip',
		'default'  => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip:', 'genesis-customizer-pro' ),
			esc_html__( 'Add widgets to the mega menu widget area from the', 'genesis-customizer-pro' ),
			esc_attr( '"sidebar-widgets-mega-menu"' ),
			esc_html__( 'Mega Menu Widgets Section', 'genesis-customizer-pro' )
		),
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
				'element' => '.mega-menu',
			],
		],
	],
];
