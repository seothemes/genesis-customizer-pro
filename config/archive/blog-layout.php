<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'select',
		'settings' => 'columns',
		'label'    => __( 'Columns', 'genesis-customizer' ),
		'default'  => 'has-1-columns',
		'choices'  => [
			'has-1-columns' => __( '1 Column', 'genesis-customizer' ),
			'has-2-columns' => __( '2 Column', 'genesis-customizer' ),
			'has-3-columns' => __( '3 Column', 'genesis-customizer' ),
			'has-4-columns' => __( '4 Column', 'genesis-customizer' ),
		],
	],
	[
		'type'     => 'checkbox',
		'settings' => 'masonry',
		'label'    => __( 'Enable masonry layout', 'genesis-customizer' ),
		'default'  => true,
	],
	[
		'type'     => 'checkbox',
		'settings' => 'featured-image-spacing',
		'label'    => __( 'Remove featured image spacing', 'genesis-customizer' ),
		'default'  => false,
	],
	[
		'type'     => 'custom',
		'settings' => 'tip-1',
		'default'  => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="javascript:wp.customize.control( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'The Featured Image Size and the Content Limit settings can be changed from the', 'genesis-customizer' ),
			esc_attr( '"genesis_image_size"' ),
			esc_html__( 'Content Archives Section', 'genesis-customizer' )
		),
	],
	[
		'type'        => 'sortable',
		'settings'    => 'order',
		'label'       => __( 'Element Order', 'genesis-customizer' ),
		'description' => esc_html__( 'Drag and drop the sortable items below to change the order of post elements. Click the eye icon to toggle an elements visibility.', 'genesis-customizer' ) . '<br>',
		'default'     => [
			'genesis_do_post_title',
			'genesis_post_info',
			'genesis_do_post_image',
			'genesis_do_post_content',
			'genesis_post_meta',
		],
		'choices'     => [
			'genesis_do_post_title'   => __( 'Entry Title', 'genesis-customizer' ),
			'genesis_post_info'       => __( 'Post Info', 'genesis-customizer' ),
			'genesis_do_post_image'   => __( 'Featured Image', 'genesis-customizer' ),
			'genesis_do_post_content' => __( 'Entry Content', 'genesis-customizer' ),
			'genesis_post_meta'       => __( 'Post Meta', 'genesis-customizer' ),
		],
	],
];
