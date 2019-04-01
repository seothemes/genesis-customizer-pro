<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'radio',
		'settings' => 'animation',
		'label'    => __( 'Animation', 'genesis-customizer' ),
		'default'  => 'has-mobile-menu-top',
		'choices'  => [
			'has-mobile-menu-top'    => __( 'Slide down from top', 'genesis-customizer' ),
			'has-mobile-menu-left'   => __( 'Slide in from left', 'genesis-customizer' ),
			'has-mobile-menu-right'  => __( 'Slide in from right', 'genesis-customizer' ),
			'has-mobile-menu-center' => __( 'Fade in from center', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'width',
		'label'    => __( 'Width', 'genesis-customizer' ),
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
				'media_query' => _get_media_query( 'max' ),
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
		'settings' => 'divider-3',
		'default'  => '<hr>',
	],
	[
		'type'     => 'select',
		'settings' => 'alignment',
		'label'    => __( 'Menu Item Alignment', 'genesis-customizer' ),
		'default'  => 'space-between',
		'choices'  => [
			'flex-start'    => __( 'Left', 'genesis-customizer' ),
			'center'        => __( 'Center', 'genesis-customizer' ),
			'flex-end'      => __( 'Right', 'genesis-customizer' ),
			'space-between' => __( 'Full', 'genesis-customizer' ),
		],
	],
];
