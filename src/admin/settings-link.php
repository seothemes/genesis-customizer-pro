<?php

namespace GenesisCustomizer;

$handle = _get_pro_handle();

add_filter( "plugin_action_links_$handle/$handle.php", __NAMESPACE__ . '\add_plugin_page_settings_link' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $links
 *
 * @return array
 */
function add_plugin_page_settings_link( $links ) {
	$links[] = sprintf(
		'<a href="%s">%s</a>',
		admin_url( 'admin.php?page=genesis-customizer' ),
		__( 'Settings', 'genesis-customizer' )
	);

	return $links;
}
