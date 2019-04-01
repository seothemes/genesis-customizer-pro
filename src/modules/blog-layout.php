<?php

namespace GenesisCustomizer;

add_action( 'genesis_before', __NAMESPACE__ . '\blog_setup', 15 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function blog_setup() {
	if ( ! _is_archive() ) {
		return;
	}

	add_action( 'genesis_after_header', __NAMESPACE__ . '\remove_entry_elements' );
	add_action( 'genesis_entry_header', __NAMESPACE__ . '\add_entry_elements' );
	add_filter( 'genesis_attr_entry', __NAMESPACE__ . '\featured_image_first' );
	add_filter( 'genesis_attr_entry-image-link', __NAMESPACE__ . '\featured_image_spacing' );
	add_filter( 'genesis_attr_content', __NAMESPACE__ . '\masonry_layout' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function remove_entry_elements() {
	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	add_filter( 'genesis_markup_entry-content_open', '__return_false' );
	add_filter( 'genesis_markup_entry-content_close', '__return_false' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_entry_elements() {
	$elements = _get_value( 'archive_blog-layout_order' );

	foreach ( $elements as $element ) {
		if ( 'genesis_do_post_content' === $element ) {
			printf( '<div %s>', genesis_attr( 'entry-content' ) );
		}

		$element();

		if ( 'genesis_do_post_content' === $element ) {
			printf( '</div>' );
		}
	}
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $atts
 *
 * @return mixed
 */
function featured_image_first( $atts ) {
	$order = _get_value( 'archive_blog-layout_order' );

	if ( isset( $order[0] ) && 'genesis_do_post_image' === $order[0] ) {
		$atts['class'] .= ' featured-image-first';
	}

	return $atts;
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function featured_image_spacing( $atts ) {
	$spacing = _get_value( 'archive_blog-layout_featured-image-spacing' );

	if ( $spacing ) {
		$atts['class'] .= ' no-spacing';
	}

	return $atts;
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function masonry_layout( $atts ) {
	$masonry = _get_value( 'archive_blog-layout_masonry' );

	if ( $masonry ) {
		$atts['class'] .= ' masonry';
	}

	return $atts;
}
