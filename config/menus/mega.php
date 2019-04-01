<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'multicolor',
		'settings' => 'colors',
		'label'    => __( 'Colors', 'genesis-customizer' ),
		'choices'  => [
			'background' => __( 'Background', 'genesis-customizer' ),
			'border'     => __( 'Border', 'genesis-customizer' ),
			'link'       => __( 'Link', 'genesis-customizer' ),
			'link-hover' => __( 'Link Hover', 'genesis-customizer' ),
		],
		'default'  => [
			'background' => _get_color( 'white' ),
			'border'     => '',
			'link'       => '',
			'link-hover' => '',
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.mega-menu',
				'property' => 'background-color',
			],
			[
				'choice'   => 'border',
				'element'  => '.mega-menu',
				'property' => 'border-color',
			],
			[
				'choice'   => 'link',
				'element'  => '.mega-menu a',
				'property' => 'color',
			],
			[
				'choice'   => 'link-hover',
				'element'  => [
					'.mega-menu a:hover',
					'.mega-menu a:focus',
					'.mega-menu .current-menu-item > a',
				],
				'property' => 'color',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-0387',
		'default'  => '<hr>',
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing',
		'label'    => __( 'Spacing', 'genesis-customizer' ),
		'default'  => _get_size( 'l', '' ),
		'choices'  => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.mega-menu',
				'property' => 'padding',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'tip-2',
		'default'  => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p>',
			esc_html__( 'Tip:', 'genesis-customizer' ),
			esc_html__( 'Add widgets to the mega menu widget area from the', 'genesis-customizer' ),
			esc_attr( '"sidebar-widgets-mega-menu"' ),
			esc_html__( 'Mega Menu Widgets Section', 'genesis-customizer' )
		),
	],
];
