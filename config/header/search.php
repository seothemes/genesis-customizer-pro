<?php

namespace GenesisCustomizer;

return [
	[
		'type'      => 'radio',
		'settings'  => 'enable',
		'label'     => __( 'Enable on', 'genesis-customizer-pro' ),
		'default'   => 'hide',
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
		'settings' => 'divider',
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
		'label'    => __( 'Colors', 'genesis-customizer-pro' ),
		'choices'  => [
			'background'        => __( 'Header Search Background', 'genesis-customizer-pro' ),
			'toggle-background' => __( 'Search Toggle Background', 'genesis-customizer-pro' ),
			'toggle-text'       => __( 'Search Toggle Text', 'genesis-customizer-pro' ),
			'close-background'  => __( 'Search Close Background', 'genesis-customizer-pro' ),
			'close-text'        => __( 'Search Close Text', 'genesis-customizer-pro' ),
			'input-background'  => __( 'Input Background', 'genesis-customizer-pro' ),
			'input-text'        => __( 'Input Text', 'genesis-customizer-pro' ),
			'input-border'      => __( 'Input Border', 'genesis-customizer-pro' ),
			'submit-background' => __( 'Submit Background', 'genesis-customizer-pro' ),
			'submit-text'       => __( 'Submit Text', 'genesis-customizer-pro' ),
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
			'submit-background' => '',
			'submit-text'       => '',
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
			[
				'choice'   => 'submit-background',
				'element'  => '.header-search .search-form-submit',
				'property' => 'background-color',
			],
			[
				'choice'   => 'submit-text',
				'element'  => '.header-search .search-form-submit',
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
		'type'     => 'select',
		'settings' => 'location',
		'label'    => __( 'Search toggle location', 'genesis-customizer-pro' ),
		'default'  => 'right',
		'choices'  => [
			'left'  => __( 'Left', 'genesis-customizer-pro' ),
			'right' => __( 'Right', 'genesis-customizer-pro' ),
		],
	],
	[
		'type'     => 'select',
		'settings' => 'style',
		'label'    => __( 'Header search style', 'genesis-customizer-pro' ),
		'default'  => 'push-down',
		'choices'  => [
			'push-down'   => __( 'Push Down', 'genesis-customizer-pro' ),
			'drop-down'   => __( 'Drop Down', 'genesis-customizer-pro' ),
			'full-screen' => __( 'Full Screen', 'genesis-customizer-pro' ),
		],
	],
	[
		'type'     => 'text',
		'settings' => 'input-text',
		'label'    => __( 'Input Text', 'genesis-customizer-pro' ),
		'default'  => __( 'Search this website', 'genesis-customizer-pro' ),
	],
	[
		'type'            => 'text',
		'settings'        => 'button-text',
		'label'           => __( 'Button Text', 'genesis-customizer-pro' ),
		'default'         => __( 'Search', 'genesis-customizer-pro' ),
		'active_callback' => [
			'setting'  => _get_setting( 'button-type' ),
			'value'    => 'text',
			'operator' => '===',
		],
	],
	[
		'type'     => 'checkbox',
		'settings' => 'enable-button',
		'label'    => __( 'Display search form button', 'genesis-customizer-pro' ),
		'default'  => false,
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'slider',
		'settings' => 'search-form-width',
		'label'    => __( 'Search Form Width', 'genesis-customizer-pro' ),
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
		'label'    => __( 'Search Form Spacing', 'genesis-customizer-pro' ),
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
		'label'    => __( 'Search Input Spacing', 'genesis-customizer-pro' ),
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
		'label'    => __( 'Search Toggle Padding', 'genesis-customizer-pro' ),
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
		'label'    => __( 'Search Toggle Margin', 'genesis-customizer-pro' ),
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
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'element'     => '.header-search-toggle.right',
				'property'    => 'margin-right',
				'units'       => 'px',
				'media_query' => _get_media_query( 'max' ),
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
		'label'    => __( 'Search Toggle Size', 'genesis-customizer-pro' ),
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
		'label'    => __( 'Search Close Spacing', 'genesis-customizer-pro' ),
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
		'label'    => __( 'Search Close Size', 'genesis-customizer-pro' ),
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
