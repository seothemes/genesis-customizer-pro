<?php

namespace GenesisCustomizer;

add_action( 'genesis_before_header_wrap', __NAMESPACE__ . '\above_header' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function above_header() {
	$enabled = _get_value( 'header_above-header_enabled' );

	if ( 'hide' === $enabled ) {
		return;
	}

	genesis_widget_area( 'above-header', [
		'before' => sprintf( '<div class="above-header widget-area %s"><div class="wrap">', $enabled ),
		'after'  => '</div></div>',
	] );
}

add_action( 'genesis_footer', __NAMESPACE__ . '\above_footer', 11 );
/**
 * Display the Above Footer widget area.
 *
 * @since 1.1.0
 *
 * @return void
 */
function above_footer() {
	$enabled = _get_value( 'footer_above-footer_enabled' );

	if ( ! $enabled ) {
		return;
	}

	genesis_widget_area( 'above-footer', [
		'before' => '<div class="above-footer widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );
}


add_filter( 'genesis_nav_items', __NAMESPACE__ . '\display_mobile_menu_widget_area', 10, 2 );
add_filter( 'wp_nav_menu_items', __NAMESPACE__ . '\display_mobile_menu_widget_area', 10, 2 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param       $menu
 * @param array $args
 *
 * @return string
 */
function display_mobile_menu_widget_area( $menu, $args ) {
	$args = (array) $args;

	if ( has_nav_menu( 'secondary' ) && 'secondary' !== $args['theme_location'] ) {
		return $menu;
	}

	if ( ! has_nav_menu( 'secondary' ) && 'primary' !== $args['theme_location'] ) {
		return $menu;
	}

	ob_start();
	genesis_widget_area( 'mobile-menu', [
		'before' => '<li class="menu-item mobile-menu widget-area">',
		'after'  => '</li>',
	] );
	$widget = ob_get_clean();

	return $menu . $widget;
}

add_action( 'genesis_after_title_area', __NAMESPACE__ . '\display_mega_menu', 20 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function display_mega_menu() {
	genesis_widget_area( 'mega-menu', [
		'before' => '<div class="mega-menu">',
		'after'  => '</div>',
	] );
}
