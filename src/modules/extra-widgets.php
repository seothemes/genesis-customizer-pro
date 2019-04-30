<?php

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_header_above_config', '__return_true' );
add_filter( 'genesis-customizer_header_left_config', '__return_true' );
add_filter( 'genesis-customizer_header_below_config', '__return_true' );
add_filter( 'genesis-customizer_footer_above_config', '__return_true' );
add_filter( 'genesis-customizer_footer_below_config', '__return_true' );
add_filter( 'genesis-customizer_content_above_config', '__return_true' );
add_filter( 'genesis-customizer_content_below_config', '__return_true' );

add_action( 'genesis_before_header_wrap', __NAMESPACE__ . '\above_header' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function above_header() {
	$enabled = _get_value( 'header_above_enabled' );

	if ( 'hide' === $enabled ) {
		return;
	}

	genesis_widget_area( 'above-header', [
		'before' => sprintf( '<div class="above-header widget-area %s"><div class="wrap">', $enabled ),
		'after'  => '</div></div>',
	] );
}

add_action( 'genesis_before_title_area', __NAMESPACE__ . '\header_left', 5 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function header_left() {
	$enabled = _get_value( 'header_left_enable' );

	if ( 'hide' === $enabled ) {
		return;
	}

	genesis_widget_area( 'header-left-widget', [
		'before' => '<div class="header-left widget-area ' . $enabled . '">',
		'after'  => '</div>',
	] );
}

add_action( 'genesis_before_content_sidebar_wrap', __NAMESPACE__ . '\below_header' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function below_header() {
	$enabled = _get_value( 'header_below_enabled' );

	if ( 'hide' === $enabled ) {
		return;
	}

	genesis_widget_area( 'below-header', [
		'before' => sprintf( '<div class="below-header widget-area %s"><div class="wrap">', $enabled ),
		'after'  => '</div></div>',
	] );
}

add_action( 'genesis_before_content_sidebar_wrap', __NAMESPACE__ . '\above_content', 15 );
/**
 * Display the Above Footer widget area.
 *
 * @since 1.1.0
 *
 * @return void
 */
function above_content() {
	$enabled = _get_value( 'content_above_enabled' );

	if ( ! $enabled ) {
		return;
	}

	genesis_widget_area( 'above-content', [
		'before' => '<div class="above-content widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );
}

add_action( 'genesis_after_content_sidebar_wrap', __NAMESPACE__ . '\below_content' );
/**
 * Display the Above Footer widget area.
 *
 * @since 1.1.0
 *
 * @return void
 */
function below_content() {
	$enabled = _get_value( 'content_below_enabled' );

	if ( ! $enabled ) {
		return;
	}

	genesis_widget_area( 'below-content', [
		'before' => '<div class="below-content widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );
}

add_action( 'genesis_footer', __NAMESPACE__ . '\above_footer' );
/**
 * Display the Above Footer widget area.
 *
 * @since 1.1.0
 *
 * @return void
 */
function above_footer() {
	$enabled = _get_value( 'footer_above_enabled' );

	if ( ! $enabled ) {
		return;
	}

	genesis_widget_area( 'above-footer', [
		'before' => '<div class="above-footer widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );
}

add_action( 'genesis_footer', __NAMESPACE__ . '\below_footer', 12 );
/**
 * Display the Above Footer widget area.
 *
 * @since 1.1.0
 *
 * @return void
 */
function below_footer() {
	$enabled = _get_value( 'footer_below_enabled' );

	if ( ! $enabled ) {
		return;
	}

	genesis_widget_area( 'below-footer', [
		'before' => '<div class="below-footer widget-area"><div class="wrap">',
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
		'before' => '<li class="menu-item mobile-menu widget-area hide-desktop">',
		'after'  => '</li>',
	] );
	$widget = ob_get_clean();

	return $menu . $widget;
}

