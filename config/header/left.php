<?php

namespace GenesisCustomizer;

return [
	[
		'type'      => 'radio',
		'settings'  => 'enable',
		'label'     => __( 'Enable on', 'genesis-customizer-pro' ),
		'default'   => 'hide-mobile',
		'transport' => 'refresh',
		'choices'   => [
			'show'         => __( 'Desktop and Mobile', 'genesis-customizer-pro' ),
			'hide-mobile'  => __( 'Desktop', 'genesis-customizer-pro' ),
			'hide-desktop' => __( 'Mobile', 'genesis-customizer-pro' ),
			'hide'         => __( 'None', 'genesis-customizer-pro' ),
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'tip',
		'default'  => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Quick Link: ', 'genesis-customizer-pro' ),
			esc_html__( 'Edit ', 'genesis-customizer-pro' ),
			esc_attr( '"sidebar-widgets-header-left-widget"' ),
			esc_html__( 'Header Left Widgets', 'genesis-customizer-pro' )
		),
	],
	[
		'type'     => 'multicolor',
		'settings' => 'colors',
		'label'    => __( 'Colors', 'genesis-customizer-pro' ),
		'choices'  => [
			'widget-title'   => __( 'Widget Title', 'genesis-customizer-pro' ),
			'widget-content' => __( 'Widget Content', 'genesis-customizer-pro' ),
		],
		'default'  => [
			'widget-title'   => '',
			'widget-content' => '',
		],
		'output'   => [
			[
				'choice'   => 'widget-title',
				'element'  => '.header-left .widget-title',
				'property' => 'color',
			],
			[
				'choice'   => 'widget-content',
				'element'  => '.header-left .widget',
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
		'settings' => 'vertical-spacing',
		'label'    => __( 'Vertical Spacing', 'genesis-customizer-pro' ),
		'default'  => '0',
		'choices'  => [
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.header-left',
				'property' => 'padding-top',
				'units'    => 'px',
			],
			[
				'element'  => '.header-left',
				'property' => 'padding-bottom',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing-left',
		'label'    => __( 'Spacing Left', 'genesis-customizer-pro' ),
		'default'  => '20',
		'choices'  => [
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.header-left',
				'property' => 'padding-left',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing-right',
		'label'    => __( 'Spacing Right', 'genesis-customizer-pro' ),
		'default'  => '20',
		'choices'  => [
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.header-left',
				'property' => 'padding-right',
				'units'    => 'px',
			],
		],
	],
];
