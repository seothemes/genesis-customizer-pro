<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'radio-image',
		'settings' => 'layout',
		'label'    => __( 'Desktop Layout', 'genesis-customizer' ),
		'default'  => 'has-logo-left',
		'priority' => 1,
		'choices'  => [
			'has-logo-left'   => _get_url() . 'assets/img/logo-left.gif',
			'has-logo-above'  => _get_url() . 'assets/img/logo-above.gif',
			'has-logo-right'  => _get_url() . 'assets/img/logo-right.gif',
			'has-logo-center' => _get_url() . 'assets/img/logo-center.gif',
			'has-logo-side'   => _get_url() . 'assets/img/logo-side.gif',
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider',
		'default'  => '<hr>',
		'priority' => 2,
	],
	[
		'type'     => 'radio-image',
		'settings' => 'mobile-layout',
		'label'    => __( 'Mobile Layout', 'genesis-customizer' ),
		'default'  => 'has-logo-left-mobile',
		'priority' => 3,
		'choices'  => [
			'has-logo-left-mobile'  => _get_url() . 'assets/img/mobile-layout-1.gif',
			'has-logo-right-mobile' => _get_url() . 'assets/img/mobile-layout-3.gif',
			'has-logo-above-mobile' => _get_url() . 'assets/img/mobile-layout-2.gif',
			'has-logo-below-mobile' => _get_url() . 'assets/img/mobile-layout-4.gif',
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'width',
		'label'    => __( 'Header Width', 'genesis-customizer' ),
		'default'  => '300',
		'priority' => 4,
		'choices'  => [
			'min'  => 100,
			'max'  => 600,
			'step' => 1,
		],
		'output'   => [
			[
				'element'     => '.has-logo-side .site-header',
				'property'    => 'width',
				'units'       => 'px',
				'media_query' => _get_media_query(),
			],
			[
				'element'     => '.has-logo-side .site-container',
				'property'    => 'padding-left',
				'units'       => 'px',
				'media_query' => _get_media_query(),
			],
		],
		'required' => [
			[
				'setting'  => _get_setting( 'layout' ),
				'value'    => 'has-logo-side',
				'operator' => '===',
			],
		],
	],
	[
		'type'     => 'slider',
		'settings' => 'vertical-spacing',
		'label'    => __( 'Vertical Spacing', 'genesis-customizer' ),
		'default'  => _get_size( 'xl', '' ),
		'priority' => 4,
		'choices'  => [
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		],
		'output'   => [
			[
				'element'       => '.has-logo-side .primary-header',
				'property'      => 'padding',
				'value_pattern' => '$px 0',
				'media_query'   => _get_media_query(),
			],
		],
		'required' => [
			[
				'setting'  => _get_setting( 'layout' ),
				'value'    => 'has-logo-side',
				'operator' => '===',
			],
		],
	],
	[
		'type'            => 'custom',
		'settings'        => 'tip',
		'priority'        => 6,
		'default'         => sprintf(
			'<hr><p><strong>%s</strong>%s<a href="javascript:wp.customize.section( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'Transparent header colors override the Primary Header defaults. They can be customized from the ', 'genesis-customizer' ),
			esc_attr( '"genesis-customizer_header_transparent"' ),
			esc_html__( 'Transparent Header Section', 'genesis-customizer' )
		),
		'active_callback' => function () {
			return _is_module_enabled( 'transparent-header' );
		},
	],
];
