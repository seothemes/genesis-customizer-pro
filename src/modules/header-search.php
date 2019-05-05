<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds the Header Search module to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_header_search_config', '__return_true' );

add_action( 'genesis_after_title_area', __NAMESPACE__ . '\search_toggle', 20 );
/**
 * Display the search toggle button.
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
 * Display header search form.
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
	$close = _get_svg( 'close-button' );

	printf(
		'<div class="header-search %s"><div class="wrap">%s</div><button class="header-search-close">%s</button></div>',
		esc_attr( $style ),
		$form,
		$close
	);
}

add_filter( 'genesis_search_text', __NAMESPACE__ . '\search_input_text' );
/**
 * Modify the search input text.
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
 * Modify the search button text.
 *
 * @since 1.0.0
 *
 * @return string
 */
function search_button_text() {
	return _get_value( 'header_search_button-text' );
}

/**
 * Display search button.
 *
 * @since 1.0.0
 *
 * @param string $additional_classes Additional button classes.
 *
 * @return string
 */
function get_search_button( $additional_classes = '' ) {
	$location = _get_value( 'header_search_location' );
	$classes  = trim( 'header-search-toggle ' . $location . ' ' . $additional_classes );

	return sprintf(
		'<button class="%s">%s</button>',
		$classes,
		_get_svg( 'search-button' )
	);
}

add_filter( 'wp_nav_menu_items', __NAMESPACE__ . '\nav_menu_search', 10, 2 );
/**
 * Filter menu items, appending a search form.
 *
 * @since 1.0.0
 *
 * @param string $menu HTML string of list items.
 * @param object $args Menu arguments.
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
 * Add button class to search form.
 *
 * @since 1.0.0
 *
 * @param array $attr Search form attributes.
 *
 * @return array
 */
function search_form_has_button( $attr ) {
	$enabled = _get_value( 'header_search_enable-button' );

	if ( $enabled ) {
		$attr['class'] .= ' has-search-button';
	}

	return $attr;
}
