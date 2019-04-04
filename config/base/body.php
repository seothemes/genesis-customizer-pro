<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'dimensions',
		'settings' => 'font-size',
		'label'    => __( 'Font Size', 'genesis-customizer' ),
		'default'  => [
			'mobile'  => _get_size( 'm' ),
			'desktop' => _get_size( 'm' ),
		],
		'choices'  => [
			'labels' => [
				'mobile'  => __( 'Mobile', 'genesis-customizer' ),
				'desktop' => __( 'Desktop', 'genesis-customizer' ),
			],
		],
		'output'   => [
			[
				'choice'      => 'mobile',
				'property'    => 'font-size',
				'element'     => 'body',
				'media_query' => _get_media_query( 'max' ),
			],
			[
				'choice'      => 'desktop',
				'property'    => 'font-size',
				'element'     => 'body',
				'media_query' => _get_media_query(),
			],
		],
	],
];
