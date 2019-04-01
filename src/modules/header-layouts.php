<?php

namespace GenesisCustomizer;

add_filter( 'genesis_customizer_header_layouts', __NAMESPACE__ . '\extra_header_layouts' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $layouts
 *
 * @return array
 */
function extra_header_layouts( $layouts ) {
	$extra = [
		'has-logo-center' => _get_url() . 'assets/img/logo-center.gif',
		'has-logo-side'   => _get_url() . 'assets/img/logo-side.gif',
	];

	return array_merge_recursive( $layouts, $extra );
}
