<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'custom',
		'settings' => 'tip',
		'default'  => sprintf(
			'<p><strong>%s</strong> %s <a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer-pro' ),
			esc_html__( 'The transparent header settings only apply to pages with a hero section. The hero section can be enabled from the ', 'genesis-customizer-pro' ),
			esc_attr( '"genesis-customizer_hero_settings"' ),
			esc_html__( 'Hero Section Settings', 'genesis-customizer-pro' )
		),
	],
	[
		'type'     => 'radio',
		'settings' => 'enabled',
		'label'    => __( 'Enable On', 'genesis-customizer-pro' ),
		'default'  => '',
		'choices'  => [
			'all'     => __( 'Desktop and Mobile', 'genesis-customizer-pro' ),
			'desktop' => __( 'Desktop', 'genesis-customizer-pro' ),
			'mobile'  => __( 'Mobile', 'genesis-customizer-pro' ),
			''     => __( 'None', 'genesis-customizer-pro' ),
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
		'label'    => __( 'Colors', 'genesis-customizer-pro' ),
		'choices'  => [
			'background'                => __( 'Background', 'genesis-customizer-pro' ),
			'site-title'                => __( 'Site Title', 'genesis-customizer-pro' ),
			'site-description'          => __( 'Site Description', 'genesis-customizer-pro' ),
			'text'                      => __( 'Text', 'genesis-customizer-pro' ),
			'links'                     => __( 'Links', 'genesis-customizer-pro' ),
			'links-hover'               => __( 'Links Hover', 'genesis-customizer-pro' ),
			'above-header-background'   => __( 'Above Header Background', 'genesis-customizer-pro' ),
			'above-header-text'         => __( 'Above Header Text', 'genesis-customizer-pro' ),
			'nav-secondary-background'  => __( 'Secondary Menu Background', 'genesis-customizer-pro' ),
			'nav-secondary-links'       => __( 'Secondary Menu Links', 'genesis-customizer-pro' ),
			'nav-secondary-links-hover' => __( 'Secondary Menu Links Hover', 'genesis-customizer-pro' ),
		],
		'default'  => [
			'background'                => _get_color( 'transparent' ),
			'site-title'                => _get_color( 'white' ),
			'site-description'          => _get_color( 'white' ),
			'text'                      => _get_color( 'white' ),
			'links'                     => _get_color( 'white' ),
			'links-hover'               => _get_color( 'accent' ),
			'above-header-background'   => _get_color( 'transparent' ),
			'above-header-text'         => _get_color( 'white' ),
			'nav-secondary-background'  => _get_color( 'transparent' ),
			'nav-secondary-links'       => _get_color( 'white' ),
			'nav-secondary-links-hover' => _get_color( 'accent' ),
		],
		'output'   => [
			[
				'choice'   => 'background',
				'element'  => '.has-transparent-header .primary-header',
				'property' => 'background-color',
			],
			[
				'choice'   => 'site-title',
				'element'  => '.has-transparent-header .site-title a',
				'property' => 'color',
			],
			[
				'choice'   => 'site-description',
				'element'  => '.has-transparent-header .site-description',
				'property' => 'color',
			],
			[
				'choice'   => 'text',
				'element'  => '.has-transparent-header .primary-header',
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.has-transparent-header .header-search-toggle svg',
				'property' => 'fill',
			],
			[
				'choice'   => 'links',
				'element'  => '.has-transparent-header .site-header a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => [
					'.has-transparent-header .site-header a:hover',
					'.has-transparent-header .site-header a:focus',
					'.has-transparent-header .site-header .current-menu-item > a',
					'.has-transparent-header .header-search-toggle:hover svg',
					'.has-transparent-header .header-search-toggle:focus svg',
				],
				'property' => 'color',
			],
			[
				'choice'   => 'above-header-background',
				'element'  => '.has-transparent-header .above-header',
				'property' => 'background-color',
			],
			[
				'choice'   => 'above-header-text',
				'element'  => '.has-transparent-header .above-header',
				'property' => 'color',
			],
			[
				'choice'   => 'nav-secondary-background',
				'element'  => '.has-transparent-header .nav-secondary',
				'property' => 'background-color',
			],
			[
				'choice'   => 'nav-secondary-links',
				'element'  => '.has-transparent-header .nav-secondary a',
				'property' => 'color',
			],
			[
				'choice'   => 'nav-secondary-links-hover',
				'element'  => [
					'.has-transparent-header-desktop .nav-secondary a:hover',
					'.has-transparent-header-desktop .nav-secondary a:focus',
					'.has-transparent-header-desktop .nav-secondary .current-menu-item > a',
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
			esc_html__( 'Tip: ', 'genesis-customizer-pro' ),
			esc_html__( 'The site title and tagline visibility can be toggled from the ', 'genesis-customizer-pro' ),
			esc_attr( '"title_tagline"' ),
			esc_html__( 'Site Identity Section', 'genesis-customizer-pro' )
		),
	],
	[
		'type'     => 'checkbox',
		'settings' => 'different-logo',
		'label'    => __( 'Use different logo for transparent header', 'genesis-customizer-pro' ),
		'default'  => false,
	],
	[
		'type'            => 'image',
		'settings'        => 'logo',
		'label'           => __( 'Logo', 'genesis-customizer-pro' ),
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
		'label'           => __( 'Logo Width Mobile', 'genesis-customizer-pro' ),
		'default'         => '200',
		'choices'         => [
			'min'  => 0,
			'max'  => 600,
			'step' => 1,
		],
		'output'          => [
			[
				'element'     => '.transparent-logo',
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
		'label'           => __( 'Logo Width Desktop', 'genesis-customizer-pro' ),
		'default'         => '200',
		'choices'         => [
			'min'  => 0,
			'max'  => 600,
			'step' => 1,
		],
		'output'          => [
			[
				'element'     => '.transparent-logo',
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
		'label'           => __( 'Logo Spacing', 'genesis-customizer-pro' ),
		'default'         => '16',
		'choices'         => [
			'min'  => - 20,
			'max'  => 100,
			'step' => 1,
		],
		'output'          => [
			[
				'element'       => '.transparent-logo',
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
