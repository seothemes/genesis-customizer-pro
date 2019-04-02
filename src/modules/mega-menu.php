<?php

namespace GenesisCustomizer;

// Enable config.
add_filter('genesis-customizer_menus_mega_module', '__return_true' );

add_action( 'admin_init', __NAMESPACE__ . '\admin_class' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function admin_class() {
	Mega_Menu_Admin::init();
}

add_filter( 'wp_edit_nav_menu_walker', __NAMESPACE__ . '\fields_walker', 99 );
/**
 * Replace default menu editor walker with ours
 *
 * We don't actually replace the default walker. We're still using it and
 * only injecting some HTMLs.
 *
 * @since   0.1.0
 * @access  private
 * @wp_hook filter wp_edit_nav_menu_walker
 *
 * @param   string $walker Walker class name
 *
 * @return  string Walker class name
 */
function fields_walker( $walker ) {
	$walker = __NAMESPACE__ . '\Menu_Fields_Walker';

	return $walker;
}

add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\nav_class', 10, 2 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $classes
 * @param $item
 *
 * @return array
 */
function nav_class( $classes, $item ) {
	$mega_menu = get_post_meta( $item->ID, 'menu-item-mega-menu', true );
	$classes[] = $mega_menu;

	return $classes;
}
