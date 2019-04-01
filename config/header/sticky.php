<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'radio',
		'settings' => 'enabled',
		'label'    => __( 'Enable On', 'genesis-customizer' ),
		'default'  => 'no-sticky-header',
		'choices'  => [
			'has-sticky-header'         => __( 'Desktop and Mobile', 'genesis-customizer' ),
			'has-sticky-header-desktop' => __( 'Desktop', 'genesis-customizer' ),
			'has-sticky-header-mobile'  => __( 'Mobile', 'genesis-customizer' ),
			'no-sticky-header'          => __( 'None', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-1',
		'default'  => '<hr>',
	],
	[
		'type'     => 'multicolor',
		'settings' => 'colors',
		'label'    => __( 'Colors', 'genesis-customizer' ),
		'choices'  => [
			'background'       => __( 'Background', 'genesis-customizer' ),
			'site-title'       => __( 'Site Title', 'genesis-customizer' ),
			'site-description' => __( 'Site Description', 'genesis-customizer' ),
			'text'             => __( 'Text', 'genesis-customizer' ),
			'menu-links'       => __( 'Links', 'genesis-customizer' ),
			'menu-links-hover' => __( 'Links Hover', 'genesis-customizer' ),
		],
		'default'  => [
			'background'       => _get_color( 'white' ),
			'site-title'       => _get_color( 'heading' ),
			'site-description' => _get_color( 'text' ),
			'text'             => _get_color( 'text' ),
			'menu-links'       => _get_color( 'text' ),
			'menu-links-hover' => _get_color( 'accent' ),
		],
		'output'   => [
			/**
			 * Desktop
			 */
			[
				'choice'      => 'background',
				'element'     => '.has-sticky-header-desktop .shrink .primary-header',
				'property'    => 'background-color',
				'media_query' => _get_media_query(),
			],
			[
				'choice'      => 'site-title',
				'element'     => '.has-sticky-header-desktop .shrink .site-title a',
				'property'    => 'color',
				'media_query' => _get_media_query(),
			],
			[
				'choice'      => 'site-description',
				'element'     => '.has-sticky-header-desktop .shrink .site-description',
				'property'    => 'color',
				'media_query' => _get_media_query(),
			],
			[
				'choice'      => 'text',
				'element'     => '.has-sticky-header-desktop .shrink .primary-header',
				'property'    => 'color',
				'media_query' => _get_media_query(),
			],
			[
				'choice'      => 'menu-links',
				'element'     => '.has-sticky-header-desktop .shrink .menu-item a',
				'property'    => 'color',
				'media_query' => _get_media_query(),
			],
			[
				'choice'      => 'menu-links-hover',
				'element'     => [
					'.has-sticky-header-desktop .shrink .menu-item a:hover',
					'.has-sticky-header-desktop .shrink .menu-item a:focus',
					'.shrink .menu-primary .current-menu-item > a',
				],
				'property'    => 'color',
				'media_query' => _get_media_query(),
			],

			/**
			 * Mobile
			 */
			[
				'choice'      => 'background',
				'element'     => '.has-sticky-header-mobile .shrink .primary-header',
				'property'    => 'background-color',
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'choice'      => 'site-title',
				'element'     => '.has-sticky-header-mobile .shrink .site-title a',
				'property'    => 'color',
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'choice'      => 'site-description',
				'element'     => '.has-sticky-header-mobile .shrink .site-description',
				'property'    => 'color',
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'choice'      => 'text',
				'element'     => '.has-sticky-header-mobile .shrink .primary-header',
				'property'    => 'color',
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'choice'      => 'menu-links',
				'element'     => '.has-sticky-header-mobile .shrink a',
				'property'    => 'color',
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'choice'      => 'menu-links-hover',
				'element'     => [
					'.has-sticky-header-mobile .shrink a:hover',
					'.has-sticky-header-mobile .shrink a:focus',
					'.shrink .menu-primary .current-menu-item > a',
				],
				'property'    => 'color',
				'media_query' => _get_media_query( 'max' ),
			],

			/**
			 * Both
			 */
			[
				'choice'   => 'background',
				'element'  => '.has-sticky-header .shrink .primary-header',
				'property' => 'background-color',
			],
			[
				'choice'   => 'site-title',
				'element'  => '.has-sticky-header .shrink .site-title a',
				'property' => 'color',
			],
			[
				'choice'   => 'site-description',
				'element'  => '.has-sticky-header .shrink .site-description',
				'property' => 'color',
			],
			[
				'choice'   => 'text',
				'element'  => '.has-sticky-header .shrink .primary-header',
				'property' => 'color',
			],
			[
				'choice'   => 'menu-links',
				'element'  => '.has-sticky-header .shrink a',
				'property' => 'color',
			],
			[
				'choice'   => 'menu-links-hover',
				'element'  => [
					'.has-sticky-header .shrink a:hover',
					'.has-sticky-header .shrink a:focus',
					'.shrink .menu-primary .current-menu-item > a',
				],
				'property' => 'color',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'tip-1387',
		'default'  => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'The site title and tagline visibility can be toggled from the ', 'genesis-customizer' ),
			esc_attr( '"title_tagline"' ),
			esc_html__( 'Site Identity Section', 'genesis-customizer' )
		),
	],
	[
		'type'     => 'checkbox',
		'settings' => 'different-logo',
		'label'    => __( 'Use different logo for transparent header', 'genesis-customizer' ),
		'default'  => false,
	],
	[
		'type'            => 'image',
		'settings'        => 'logo',
		'label'           => __( 'Logo', 'genesis-customizer' ),
		'default'         => '',
		'choices'         => [
			'save_as' => 'id',
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'different-logo' ),
				'value'    => true,
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'custom',
		'settings'        => 'divider-5',
		'default'         => '<hr>',
		'active_callback' => [
			[
				'setting'  => _get_setting( 'different-logo' ),
				'value'    => true,
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'slider',
		'settings'        => 'logo-width-mobile',
		'label'           => __( 'Logo Width Mobile', 'genesis-customizer' ),
		'default'         => '200',
		'choices'         => [
			'min'  => 0,
			'max'  => 600,
			'step' => 1,
		],
		'output'          => [
			[
				'element'     => '.sticky-logo',
				'property'    => 'width',
				'units'       => 'px',
				'media_query' => _get_media_query( 'max' ),
			],
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'different-logo' ),
				'value'    => true,
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'slider',
		'settings'        => 'logo-width-desktop',
		'label'           => __( 'Logo Width Desktop', 'genesis-customizer' ),
		'default'         => '200',
		'choices'         => [
			'min'  => 0,
			'max'  => 600,
			'step' => 1,
		],
		'output'          => [
			[
				'element'     => '.sticky-logo',
				'property'    => 'width',
				'units'       => 'px',
				'media_query' => _get_media_query(),
			],
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'different-logo' ),
				'value'    => true,
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'slider',
		'settings'        => 'logo-spacing',
		'label'           => __( 'Logo Spacing', 'genesis-customizer' ),
		'default'         => '16',
		'choices'         => [
			'min'  => - 20,
			'max'  => 100,
			'step' => 1,
		],
		'output'          => [
			[
				'element'       => '.sticky-logo',
				'property'      => 'margin',
				'value_pattern' => '$px 0',
			],
		],
		'active_callback' => [
			[
				'setting'  => _get_setting( 'different-logo' ),
				'value'    => true,
				'operator' => '===',
			],
		],
	],
];
