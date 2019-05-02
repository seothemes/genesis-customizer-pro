<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'multicheck',
		'settings' => 'enable',
		'label'    => __( 'Enable on', 'genesis-customizer' ),
		'default'  => [],
		'choices'  => [
			'archive' => __( 'Blog/Archives', 'genesis-customizer' ),
			'page'    => __( 'Single Pages', 'genesis-customizer' ),
			'post'    => __( 'Single Posts', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'checkbox',
		'settings' => 'featured-image',
		'label'    => __( 'Use post/page featured image if available', 'genesis-customizer' ),
		'default'  => true,
	],
	[
		'type'     => 'checkbox',
		'settings' => 'breadcrumbs',
		'label'    => __( 'Move breadcrumbs inside hero section', 'genesis-customizer' ),
		'default'  => false,
	],
	[
		'type'     => 'checkbox',
		'settings' => 'divider',
		'label'    => __( 'Show divider line below title', 'genesis-customizer' ),
		'default'  => false,
		'output'   => [
			[
				'element'       => '.hero-section h1:after',
				'property'      => 'display',
				'value_pattern' => 'block',
				'exclude'       => [ false ],
			],
		],
	],
	[
		'type'     => 'checkbox',
		'settings' => 'negative',
		'label'    => __( 'Add negative spacing to content', 'genesis-customizer' ),
		'default'  => false,
		'output'   => [
			[
				'element'       => '.has-hero-section .content',
				'property'      => 'margin-top',
				'value_pattern' => '-3.2rem',
				'exclude'       => [ false ],
			],
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
			'text'          => __( 'Text', 'genesis-customizer' ),
			'headings'      => __( 'Headings', 'genesis-customizer' ),
			'links'         => __( 'Links', 'genesis-customizer' ),
			'links-hover'   => __( 'Links Hover', 'genesis-customizer' ),
			'inner-section' => __( 'Inner Section', 'genesis-customizer' ),
		],
		'default'  => [
			'text'          => _get_color( 'white' ),
			'headings'      => _get_color( 'white' ),
			'links'         => _get_color( 'white' ),
			'links-hover'   => '',
			'inner-section' => '',
		],
		'output'   => [
			[
				'choice'   => 'text',
				'element'  => '.hero-section',
				'property' => 'color',
			],
			[
				'choice'   => 'headings',
				'element'  => [
					'.hero-section h1',
					'.hero-section h2',
					'.hero-section h3',
					'.hero-section h4',
					'.hero-section h5',
					'.hero-section h6',
				],
				'property' => 'color',
			],
			[
				'choice'   => 'links',
				'element'  => '.hero-section a',
				'property' => 'color',
			],
			[
				'choice'   => 'links-hover',
				'element'  => '.hero-section a:hover, .hero-section a:focus',
				'property' => 'color',
			],
			[
				'choice'   => 'inner-section',
				'element'  => '.hero-inner',
				'property' => 'background-color',
			],
		],
	],
	[
		'type'      => 'multicolor',
		'settings'  => 'gradient',
		'label'     => __( 'Gradient Overlay', 'genesis-customizer' ),
		'transport' => 'refresh',
		'choices'   => [
			'left'  => __( 'Background Left', 'genesis-customizer' ),
			'right' => __( 'Background Right', 'genesis-customizer' ),
		],
		'default'   => [
			'left'  => _get_color( 'overlay' ),
			'right' => _get_color( 'overlay' ),
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'angle',
		'label'    => __( 'Gradient Angle', 'genesis-customizer' ),
		'default'  => 135,
		'choices'  => [
			'min'  => 0,
			'max'  => 360,
			'step' => 1,
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'slider',
		'settings' => 'container-width',
		'label'    => __( 'Container Width', 'genesis-customizer' ),
		'default'  => '1152',
		'choices'  => [
			'min'  => 256,
			'max'  => 1920,
			'step' => 32,
		],
		'output'   => [
			[
				'element'  => '.hero-section > .wrap',
				'property' => 'max-width',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing-mobile',
		'label'    => __( 'Spacing Mobile', 'genesis-customizer' ),
		'default'  => '60',
		'choices'  => [
			'min'  => 0,
			'max'  => 300,
			'step' => 10,
		],
		'output'   => [
			[
				'element'  => '.hero-section > .wrap',
				'property' => 'padding-top',
				'units'    => 'px',
			],
			[
				'element'  => '.hero-section > .wrap',
				'property' => 'padding-bottom',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing-desktop',
		'label'    => __( 'Spacing Desktop', 'genesis-customizer' ),
		'default'  => '100',
		'choices'  => [
			'min'  => 0,
			'max'  => 300,
			'step' => 10,
		],
		'output'   => [
			[
				'element'     => '.hero-section > .wrap',
				'property'    => 'padding-top',
				'units'       => 'px',
				'media_query' => _get_media_query(),
			],
			[
				'element'     => '.hero-section > .wrap',
				'property'    => 'padding-bottom',
				'units'       => 'px',
				'media_query' => _get_media_query(),
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing-inner-vertical',
		'label'    => __( 'Inner Section Vertical Spacing', 'genesis-customizer' ),
		'default'  => '0',
		'choices'  => [
			'min'  => 0,
			'max'  => 500,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.hero-inner',
				'property' => 'padding-top',
				'units'    => 'px',
			],
			[
				'element'  => '.hero-inner',
				'property' => 'padding-bottom',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'spacing-inner-horizontal',
		'label'    => __( 'Inner Section Horizontal Spacing', 'genesis-customizer' ),
		'default'  => '0',
		'choices'  => [
			'min'  => 0,
			'max'  => 500,
			'step' => 1,
		],
		'output'   => [
			[
				'element'  => '.hero-inner',
				'property' => 'padding-left',
				'units'    => 'px',
			],
			[
				'element'  => '.hero-inner',
				'property' => 'padding-right',
				'units'    => 'px',
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'radio-buttonset',
		'settings' => 'alignment',
		'label'    => __( 'Alignment', 'genesis-customizer' ),
		'default'  => 'center',
		'choices'  => [
			'flex-start' => _get_svg( 'alignleft' ),
			'center'     => _get_svg( 'aligncenter' ),
			'flex-end'   => _get_svg( 'alignright' ),
		],
		'output'   => [
			[
				'element'  => '.hero-section, .hero-inner',
				'property' => 'justify-content',
			],
			[
				'element'       => '.hero-section, .hero-inner',
				'property'      => 'text-align',
				'value_pattern' => 'left',
				'exclude'       => [ 'center', 'flex-end' ],
			],
			[
				'element'       => '.hero-section, .hero-inner',
				'property'      => 'text-align',
				'value_pattern' => 'center',
				'exclude'       => [ 'flex-start', 'flex-end' ],
			],
			[
				'element'       => '.hero-section, .hero-inner',
				'property'      => 'text-align',
				'value_pattern' => 'right',
				'exclude'       => [ 'flex-start', 'center' ],
			],
			[
				'element'       => '.hero-section h1:after',
				'property'      => 'margin-left',
				'value_pattern' => '0px',
				'exclude'       => [ 'center', 'flex-end' ],
			],
			[
				'element'       => '.hero-section h1:after',
				'property'      => 'margin-right',
				'value_pattern' => '0px',
				'exclude'       => [ 'flex-start', 'center' ],
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
	],
	[
		'type'     => 'text',
		'settings' => 'latest-posts-title',
		'label'    => __( 'Latest Posts Title', 'genesis-customizer' ),
		'default'  => __( 'Latest Posts', 'genesis-customizer' ),
	],
	[
		'type'     => 'text',
		'settings' => 'latest-posts-subtitle',
		'label'    => __( 'Latest Posts Subtitle', 'genesis-customizer' ),
		'default'  => __( 'Showing the latest posts', 'genesis-customizer' ),
	],
];
