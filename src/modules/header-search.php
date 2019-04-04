<?php

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_header_search_config', '__return_true' );

add_action( 'genesis_after_title_area', __NAMESPACE__ . '\search_toggle', 20 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function search_toggle() {
	$enable = _get_value( 'header_search_enable' );

	if ( 'show' === $enable || 'hide-desktop' === $enable ) {
		echo get_search_button( 'hide-desktop' );
	}
}

add_action( 'genesis_after_header_wrap', __NAMESPACE__ . '\search_form', 20 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function search_form() {
	$enable = _get_value( 'header_search_enable' );

	if ( 'hide' === $enable ) {
		return;
	}

	$style = _get_value( 'header_search_style' );
	$form  = get_search_form( false );
	$close = '<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 1006 1010"><path d="M603 504l362-362a69 69 0 1 0-98-98L505 406 143 44a69 69 0 1 0-98 98l362 362L45 866a69 69 0 1 0 98 98l362-362 362 362a69 69 0 1 0 98-98L603 504z"/></svg>';

	printf(
		'<div class="header-search %s"><div class="wrap">%s</div><button class="header-search-close">%s</button></div>',
		$style,
		$form,
		$close
	);
}

add_filter( 'genesis_search_text', __NAMESPACE__ . '\search_input_text' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return string
 */
function search_input_text() {
	return _get_value( 'header_search_input-text' );
}

add_filter( 'genesis_search_button_text', __NAMESPACE__ . '\search_button_text' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return string
 */
function search_button_text() {
	return _get_value( 'header_search_button-text' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param string $additional_classes
 *
 * @return string
 */
function get_search_button( $additional_classes = '' ) {
	$icon = sprintf( '<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 1006 1010"><path d="M978 880L740 641a400 400 0 1 0-98 98l239 238c27 27 70 27 97 0s27-70 0-97zM200 624a300 300 0 1 1 425 0 300 300 0 0 1-425 0z"/></svg>' );

	$location = _get_value( 'header_search_location' );
	$classes  = trim( 'header-search-toggle ' . $location . ' ' . $additional_classes );

	return sprintf(
		'<button class="%s">%s</button>',
		$classes,
		$icon
	);
}

add_filter( 'wp_nav_menu_items', __NAMESPACE__ . '\nav_menu_search', 10, 2 );
/**
 * Filter menu items, appending a search form.
 *
 * @since 1.1.0
 *
 * @param string   $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */
function nav_menu_search( $menu, $args ) {
	$settings = get_option( 'genesis-settings', false );

	if ( isset( $settings['nav_extras'] ) && 'search' === $settings['nav_extras'] ) {
		return $menu;
	}

	if ( has_nav_menu( 'primary' ) && 'primary' !== $args->theme_location ) {
		return $menu;
	}

	if ( ! has_nav_menu( 'primary' ) && 'secondary' !== $args->theme_location ) {
		return $menu;
	}

	$enable = _get_value( 'header_search_enable' );

	if ( 'hide' === $enable || 'hide-desktop' === $enable ) {
		return $menu;
	}

	return $menu . get_search_button( 'hide-mobile' );
}

add_filter( 'genesis_attr_search-form', __NAMESPACE__ . '\search_form_has_button' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $attr
 *
 * @return void
 */
function search_form_has_button( $attr ) {
	$enabled = _get_value( 'header_search_enable-button' );

	if ( $enabled ) {
		$attr['class'] .= ' has-search-button';
	}

	return $attr;
}
