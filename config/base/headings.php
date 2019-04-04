<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'dimensions',
		'settings' => 'h1',
		'label'    => __( 'H1 Font Size', 'genesis-customizer' ),
		'default'  => [
			'Mobile'  => '36px',
			'Desktop' => '36px',
		],
		'output'   => [
			[
				'choice'   => 'Mobile',
				'element'  => 'h1',
				'property' => 'font-size',
			],
			[
				'choice'      => 'Desktop',
				'element'     => 'h1',
				'property'    => 'font-size',
				'media_query' => _get_media_query(),
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-3',
		'default'  => '<hr>',
	],
	[
		'type'     => 'dimensions',
		'settings' => 'h2',
		'label'    => __( 'H2 Font Size', 'genesis-customizer' ),
		'default'  => [
			'Mobile'  => '28px',
			'Desktop' => '28px',
		],
		'output'   => [
			[
				'choice'   => 'Mobile',
				'element'  => 'h2',
				'property' => 'font-size',
			],
			[
				'choice'      => 'Desktop',
				'element'     => 'h2',
				'property'    => 'font-size',
				'media_query' => _get_media_query(),
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-4',
		'default'  => '<hr>',
	],
	[
		'type'     => 'dimensions',
		'settings' => 'h3',
		'label'    => __( 'H3 Font Size', 'genesis-customizer' ),
		'default'  => [
			'Mobile'  => '24px',
			'Desktop' => '24px',
		],
		'output'   => [
			[
				'choice'   => 'Mobile',
				'element'  => 'h3',
				'property' => 'font-size',
			],
			[
				'choice'      => 'Desktop',
				'element'     => 'h3',
				'property'    => 'font-size',
				'media_query' => _get_media_query(),
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-5',
		'default'  => '<hr>',
	],
	[
		'type'     => 'dimensions',
		'settings' => 'h4',
		'label'    => __( 'H4 Font Size', 'genesis-customizer' ),
		'default'  => [
			'Mobile'  => '22px',
			'Desktop' => '22px',
		],
		'output'   => [
			[
				'choice'   => 'Mobile',
				'element'  => 'h4',
				'property' => 'font-size',
			],
			[
				'choice'      => 'Desktop',
				'element'     => 'h4',
				'property'    => 'font-size',
				'media_query' => _get_media_query(),
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-6',
		'default'  => '<hr>',
	],
	[
		'type'     => 'dimensions',
		'settings' => 'h5',
		'label'    => __( 'H5 Font Size', 'genesis-customizer' ),
		'default'  => [
			'Mobile'  => '20px',
			'Desktop' => '20px',
		],
		'output'   => [
			[
				'choice'   => 'Mobile',
				'element'  => 'h5,legend',
				'property' => 'font-size',
			],
			[
				'choice'      => 'Desktop',
				'element'     => 'h5,legend',
				'property'    => 'font-size',
				'media_query' => _get_media_query(),
			],
		],
	],
	[
		'type'     => 'custom',
		'settings' => 'divider-7',
		'default'  => '<hr>',
	],
	[
		'type'     => 'dimensions',
		'settings' => 'h6',
		'label'    => __( 'H6 Font Size', 'genesis-customizer' ),
		'default'  => [
			'Mobile'  => '18px',
			'Desktop' => '18px',
		],
		'output'   => [
			[
				'choice'   => 'Mobile',
				'element'  => 'h6',
				'property' => 'font-size',
			],
			[
				'choice'      => 'Desktop',
				'element'     => 'h6',
				'property'    => 'font-size',
				'media_query' => _get_media_query(),
			],
		],
	],
];
