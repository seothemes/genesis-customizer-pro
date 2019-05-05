<?php
/**
 * Genesis Customizer Pro.
 *
 * This file adds the Mega Menu module to Genesis Customizer Pro.
 *
 * @package   GenesisCustomizerPro
 * @author    SEO Themes
 * @copyright 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_menus_mega_config', '__return_true' );

add_action( 'admin_init', __NAMESPACE__ . '\mega_menu_admin_class' );
/**
 * Initialize mega menu admin class.
 *
 * @since 1.0.0
 *
 * @return void
 */
function mega_menu_admin_class() {
	Mega_Menu_Admin::init();
}

add_filter( 'wp_edit_nav_menu_walker', __NAMESPACE__ . '\fields_walker', 99 );
/**
 * Replace default menu editor walker with ours
 *
 * We don't actually replace the default walker. We're still using it and
 * only injecting some HTMLs.
 *
 * @since   1.0.0
 *
 * @access  private
 * @wp_hook filter wp_edit_nav_menu_walker
 *
 * @param   string $walker Walker class name.
 *
 * @return  string Walker class name.
 */
function fields_walker( $walker ) {
	$walker = __NAMESPACE__ . '\Menu_Fields_Walker';

	return $walker;
}

add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\nav_class', 10, 2 );
/**
 * Adds mega menu class to nav menu.
 *
 * @since 1.0.0
 *
 * @param array  $classes Nav menu classes.
 * @param object $item    Nav menu object.
 *
 * @return array
 */
function nav_class( $classes, $item ) {
	$mega_menu = get_post_meta( $item->ID, 'menu-item-mega-menu', true );
	$classes[] = $mega_menu;

	return $classes;
}

add_action( 'genesis_after_title_area', __NAMESPACE__ . '\display_mega_menu', 20 );
/**
 * Display mega menu widget area.
 *
 * @since 1.0.0
 *
 * @return void
 */
function display_mega_menu() {
	genesis_widget_area(
		'mega-menu', [
			'before' => '<div class="mega-menu hide"><div class="wrap">',
			'after'  => '</div></div>',
		]
	);
}
