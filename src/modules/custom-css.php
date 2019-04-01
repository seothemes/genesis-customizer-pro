<?php

namespace GenesisCustomizer;

add_action( 'wp_ajax_dynamic_css', __NAMESPACE__ . '\dynamic_css' );
add_action( 'wp_ajax_nopriv_dynamic_css', __NAMESPACE__ . '\dynamic_css' );
/**
 * Load the dynamic CSS with ajax.
 *
 * @since 1.0.0
 *
 * @return void
 */
function dynamic_css() {
	$nonce = $_REQUEST['wpnonce'];

	if ( ! wp_verify_nonce( $nonce, 'dynamic-css-nonce' ) ) {
		die( __( 'Invalid nonce.', 'genesis-customizer' ) );

	} else {
		header( "Content-type: text/css; charset: UTF-8" );
		echo generate_css();
	}

	exit;
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\responsive_css_output' );
/**
 * Outputs Additional JS to site footer.
 *
 * @since  1.0.0
 *
 * @return void
 */
function responsive_css_output() {
	$handle  = _get_handle() . '-responsive-css';

	if ( is_customize_preview() ) {
		$css = generate_css();
		wp_register_style( $handle, false );
		wp_enqueue_style( $handle );
		wp_add_inline_style( $handle, $css );

	} else {
		wp_enqueue_style(
			$handle,
			admin_url( 'admin-ajax.php' ) . '?action=dynamic_css&wpnonce=' . wp_create_nonce( 'dynamic-css-nonce' ),
			[],
			_get_version(),
			'all'
		);
	}
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return mixed|string
 */
function generate_css() {
	$breakpoint = _get_value( 'general_breakpoints_global' ) . 'px';
	$all        = _get_value( 'code_css_all' );
	$mobile     = _get_value( 'code_css_mobile' );
	$desktop    = _get_value( 'code_css_desktop' );
	$css        = $all ? $all : '';
	$css        .= $mobile ? "@media (max-width:{$breakpoint}){{$mobile}}" : '';
	$css        .= $desktop ? "@media (min-width:{$breakpoint}){{$desktop}}" : '';

	return minify( $css );
}
