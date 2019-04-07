<?php

namespace GenesisCustomizer;

return [
	[
		'type'      => 'radio',
		'settings'  => 'enable',
		'label'     => __( 'Enable on', 'genesis-customizer' ),
		'default'   => 'hide',
		'transport' => 'refresh',
		'choices'   => [
			'show'         => __( 'Desktop and Mobile', 'genesis-customizer' ),
			'hide-mobile'  => __( 'Desktop', 'genesis-customizer' ),
			'hide-desktop' => __( 'Mobile', 'genesis-customizer' ),
			'hide'         => __( 'None', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-0',
		'default'  => '<hr>',
		'required' => [
			[
				'setting'  => _get_setting( 'enabled' ),
				'value'    => true,
				'operator' => '===',
			],
		],
	],
	[
		'type'     => 'multicolor',
		'settings' => 'color',
		'label'    => __( 'Colors', 'genesis-customizer' ),
		'choices'  => [
			'background'        => __( 'Header Search Background', 'genesis-customizer' ),
			'toggle-background' => __( 'Search Toggle Background', 'genesis-customizer' ),
			'toggle-text'       => __( 'Search Toggle Text', 'genesis-customizer' ),
			'close-background'  => __( 'Search Close Background', 'genesis-customizer' ),
			'close-text'        => __( 'Search Close Text', 'genesis-customizer' ),
			'input-background'  => __( 'Input Background', 'genesis-customizer' ),
			'input-text'        => __( 'Input Text', 'genesis-customizer' ),
			'input-border'      => __( 'Input Border', 'genesis-customizer' ),
		],
		'default'  => [
			'background'        => _get_color( 'border' ),
			'toggle-background' => _get_color( 'transparent' ),
			'toggle-text'       => _get_color( 'heading' ),
			'close-background'  => _get_color( 'transparent' ),
			'close-text'        => _get_color( 'heading' ),
			'input-background'  => '',
			'input-text'        => '',
			'input-border'      => '',
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.header-search',
				'property' => 'background',
			],
			[
				'choice'   => 'toggle-background',
				'element'  => 'button.header-search-toggle',
				'property' => 'background',
			],
			[
				'choice'   => 'toggle-text',
				'element'  => '.header-search-toggle svg',
				'property' => 'fill',
			],
			[
				'choice'   => 'close-background',
				'element'  => 'button.header-search-close',
				'property' => 'background',
			],
			[
				'choice'   => 'close-text',
				'element'  => '.header-search-close svg',
				'property' => 'fill',
			],
			[
				'choice'   => 'input-background',
				'element'  => '.header-search .search-form-input',
				'property' => 'background',
			],
			[
				'choice'   => 'input-text',
				'element'  => '.header-search .search-form-input',
				'property' => 'color',
			],
			[
				'choice'   => 'input-border',
				'element'  => '.header-search .search-form-input',
				'property' => 'border-color',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-1',
		'default'  => '<hr>',
	],
	[
		'type'     => 'select',
		'settings' => 'location',
		'label'    => __( 'Search toggle location', 'genesis-customizer' ),
		'default'  => 'right',
		'choices'  => [
			'left'  => __( 'Left', 'genesis-customizer' ),
			'right' => __( 'Right', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'select',
		'settings' => 'style',
		'label'    => __( 'Header search style', 'genesis-customizer' ),
		'default'  => 'push-down',
		'choices'  => [
			'push-down'   => __( 'Push Down', 'genesis-customizer' ),
			'drop-down'   => __( 'Drop Down', 'genesis-customizer' ),
			'full-screen' => __( 'Full Screen', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'text',
		'settings' => 'input-text',
		'label'    => __( 'Input Text', 'genesis-customizer' ),
		'default'  => __( 'Search this website', 'genesis-customizer' ),
	],
	[
		'type'            => 'text',
		'settings'        => 'button-text',
		'label'           => __( 'Button Text', 'genesis-customizer' ),
		'default'         => __( 'Search', 'genesis-customizer' ),
		'active_callback' => [
			'setting'  => _get_setting( 'button-type' ),
			'value'    => 'text',
			'operator' => '===',
		],
	],
	[
		'type'     => 'checkbox',
		'settings' => 'enable-button',
		'label'    => __( 'Display search form button', 'genesis-customizer' ),
		'default'  => false,
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-2',
		'default'  => '<hr>',
	],
	[
		'type'     => 'slider',
		'settings' => 'search-form-width',
		'label'    => __( 'Search Form Width', 'genesis-customizer' ),
		'default'  => '500',
		'choices'  => [
			'min'  => 200,
			'max'  => 1920,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.search-form',
				'property' => 'max-width',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'search-form-spacing',
		'label'    => __( 'Search Form Spacing', 'genesis-customizer' ),
		'default'  => _get_size( 'm', '' ),
		'choices'  => [
			'min'  => 0,
			'max'  => 40,
			'step' => 1,
		],
		'output'   => [
			[
				'element'       => '.header-search',
				'property'      => 'padding',
				'value_pattern' => '$px 0',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'search-input-spacing',
		'label'    => __( 'Search Input Spacing', 'genesis-customizer' ),
		'default'  => _get_size( 'm', '' ),
		'choices'  => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.search-form-input',
				'property' => 'padding',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'search-toggle-padding',
		'label'    => __( 'Search Toggle Padding', 'genesis-customizer' ),
		'default'  => '0',
		'choices'  => [
			'min'  => 0,
			'max'  => 40,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => 'button.header-search-toggle',
				'property' => 'padding',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'search-toggle-margin',
		'label'    => __( 'Search Toggle Margin', 'genesis-customizer' ),
		'default'  => _get_size( 'l', '' ),
		'choices'  => [
			'min'  => 0,
			'max'  => 40,
			'step' => 1,
		],
		'output'   => [
			[
				'element'     => '.header-search-toggle.left',
				'property'    => 'margin-left',
				'units'       => 'px',
				'media_query' => _get_media_query('max'),
			],
			[
				'element'     => '.header-search-toggle.right',
				'property'    => 'margin-right',
				'units'       => 'px',
				'media_query' => _get_media_query('max'),
			],
			[
				'element'     => '.header-search-toggle.left',
				'property'    => 'margin-right',
				'units'       => 'px',
				'media_query' => _get_media_query(),
			],
			[
				'element'     => '.header-search-toggle.right',
				'property'    => 'margin-left',
				'units'       => 'px',
				'media_query' => _get_media_query(),
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'search-toggle-size',
		'label'    => __( 'Search Toggle Size', 'genesis-customizer' ),
		'default'  => _get_size( 'l', '' ),
		'choices'  => [
			'min'  => 4,
			'max'  => 40,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.header-search-toggle svg',
				'property' => 'height',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'search-close-spacing',
		'label'    => __( 'Search Close Spacing', 'genesis-customizer' ),
		'default'  => _get_size( 'l', '' ),
		'choices'  => [
			'min'  => 0,
			'max'  => 40,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => 'button.header-search-close',
				'property' => 'padding',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'search-close-size',
		'label'    => __( 'Search Close Size', 'genesis-customizer' ),
		'default'  => _get_size( 'l', '' ),
		'choices'  => [
			'min'  => 4,
			'max'  => 40,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.header-search-close svg',
				'property' => 'height',
				'units'    => 'px',
			],
		],
	],
];
