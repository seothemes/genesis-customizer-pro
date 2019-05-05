<?php

namespace GenesisCustomizer;

return [
	[
		'type'            => 'radio-buttonset',
		'settings'        => 'position',
		'label'           => esc_html__( 'Positioning', 'genesis-customizer-pro' ),
		'default'         => 'absolute',
		'choices'         => [
			'absolute' => esc_html__( 'Absolute', 'genesis-customizer-pro' ),
			'relative' => esc_html__( 'Relative', 'genesis-customizer-pro' ),
		],
		'output'          => [
			[
				'element'     => '.nav-primary',
				'property'    => 'position',
				'media_query' => _get_media_query( 'max' ),
			],
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'animation' ),
				'value'    => 'has-mobile-menu-left',
				'operator' => '!==',
			],
			[
				'setting'  => _get_setting( 'animation' ),
				'value'    => 'has-mobile-menu-right',
				'operator' => '!==',
			],
			[
				'setting'  => _get_setting( 'animation' ),
				'value'    => 'has-mobile-menu-center',
				'operator' => '!==',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'radio',
		'settings' => 'animation',
		'label'    => __( 'Animation', 'genesis-customizer-pro' ),
		'default'  => 'has-mobile-menu-top',
		'choices'  => [
			'has-mobile-menu-top'    => __( 'Slide down from top', 'genesis-customizer-pro' ),
			'has-mobile-menu-left'   => __( 'Slide in from left', 'genesis-customizer-pro' ),
			'has-mobile-menu-right'  => __( 'Slide in from right', 'genesis-customizer-pro' ),
			'has-mobile-menu-center' => __( 'Fade in from center', 'genesis-customizer-pro' ),
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'width',
		'label'    => __( 'Width', 'genesis-customizer-pro' ),
		'default'  => '90',
		'choices'  => [
			'min'  => 50,
			'max'  => 100,
			'step' => 1,
		],
		'output'   => [
			[
				'element'     => [
					'.has-mobile-menu-left .nav-primary',
					'.has-mobile-menu-right .nav-primary',
				],
				'property'    => 'width',
				'units'       => 'vw',
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'element'       => [
					'.has-mobile-menu-right .nav-primary.visible',
				],
				'property'      => 'transform',
				'value_pattern' => 'translateX(calc(100vw - $vw))',
				'media_query'   => _get_media_query( 'max' ),
			],
		],
		'required' => [
			[
				'setting'  => _get_setting( 'animation' ),
				'value'    => 'has-mobile-menu-top',
				'operator' => '!==',
			],
			[
				'setting'  => _get_setting( 'animation' ),
				'value'    => 'has-mobile-menu-center',
				'operator' => '!==',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'select',
		'settings' => 'alignment',
		'label'    => __( 'Menu Item Alignment', 'genesis-customizer-pro' ),
		'default'  => 'space-between',
		'choices'  => [
			'flex-start'    => __( 'Left', 'genesis-customizer-pro' ),
			'center'        => __( 'Center', 'genesis-customizer-pro' ),
			'flex-end'      => __( 'Right', 'genesis-customizer-pro' ),
			'space-between' => __( 'Full', 'genesis-customizer-pro' ),
		],
	],
];
