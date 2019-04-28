<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'radio',
		'settings' => 'enabled',
		'label'    => __( 'Enable On', 'genesis-customizer' ),
		'default'  => '',
		'choices'  => [
			'all'     => __( 'Desktop and Mobile', 'genesis-customizer' ),
			'desktop' => __( 'Desktop', 'genesis-customizer' ),
			'mobile'  => __( 'Mobile', 'genesis-customizer' ),
			''        => __( 'None', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
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
			'links'            => __( 'Links', 'genesis-customizer' ),
			'links-hover'      => __( 'Links Hover', 'genesis-customizer' ),
		],
		'default'  => [
			'background'       => _get_color( 'white' ),
			'site-title'       => _get_color( 'heading' ),
			'site-description' => _get_color( 'text' ),
			'text'             => _get_color( 'text' ),
			'links'            => _get_color( 'text' ),
			'links-hover'      => _get_color( 'accent' ),
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.has-sticky-header .site-header.shrink .primary-header',
				'property' => 'background-color',
			],
			[
				'choice'   => 'site-title',
				'element'  => '.has-sticky-header .site-header.shrink .site-title a',
				'property' => 'color',
			],
			[
				'choice'   => 'site-description',
				'element'  => '.has-sticky-header .site-header.shrink .site-description',
				'property' => 'color',
			],
			[
				'choice'   => 'text',
				'element'  => '.has-sticky-header .site-header.shrink .primary-header',
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.has-sticky-header .site-header.shrink .header-search-toggle svg',
				'property' => 'fill',
			],
			[
				'choice'   => 'links',
				'element'  => '.has-sticky-header .site-header.shrink a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => [
					'.has-sticky-header .site-header.shrink a:hover',
					'.has-sticky-header .site-header.shrink a:focus',
					'.shrink .menu-primary .current-menu-item > a',
					'.has-sticky-header .site-header.shrink .header-search-toggle:hover svg',
					'.has-sticky-header .site-header.shrink .header-search-toggle:focus svg',
				],
				'property' => 'color',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'tip',
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
		'settings'        => 'divider',
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
