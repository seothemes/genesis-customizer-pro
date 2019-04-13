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
		'settings' => 'tip-3981',
		'default'  => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="%s">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'The Blog page layout can be changed from the ', 'genesis-customizer' ),
			admin_url( 'post.php?post=' . get_option( 'page_for_posts' ) . '&action=edit' ),
			esc_html__( 'Edit Page screen', 'genesis-customizer' )
		),
		'active_callback' => function () {
			return 'page' === get_option( 'show_on_front' );
		},
	],
	[
		'type'            => 'custom',
		'settings'        => 'tip-2793',
		'default'         => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="%s">%s</a>%s</p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'To change the Blog page layout, first set a Static Front Page and a Page for posts from ', 'genesis-customizer' ),
			admin_url( 'options-reading.php' ),
			esc_html__( 'Reading Settings', 'genesis-customizer' ),
			esc_html__( 'page, then navigate to the Edit Page screen for the Posts Page and select the layout.', 'genesis-customizer' )
		),
		'active_callback' => function () {
			return 'posts' === get_option( 'show_on_front' );
		},
	],
	[
		'type'        => 'sortable',
		'settings'    => 'order',
		'label'       => __( 'Element Order', 'genesis-customizer' ),
		'description' => esc_html__( 'Drag and drop the sortable items below to change the order of post elements. Click the eye icon to toggle an elements visibility.', 'genesis-customizer' ) . '<br>&nbsp;',
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
	[
		'type'     => 'custom',
		'settings' => 'tip-8731',
		'default'  => sprintf(
			'<hr><p><strong>%s</strong> %s <a href="javascript:wp.customize.control( %s ).focus();">%s</a></p><hr>',
			esc_html__( 'Tip: ', 'genesis-customizer' ),
			esc_html__( 'The Featured Image Size and the Content Limit settings can be changed from the', 'genesis-customizer' ),
			esc_attr( '"genesis_image_size"' ),
			esc_html__( 'Content Archives Section', 'genesis-customizer' )
		),
	],
];
