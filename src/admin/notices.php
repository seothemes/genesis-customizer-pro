<?php

namespace GenesisCustomizer;

add_action( 'admin_notices', __NAMESPACE__ . '\license_notice' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function license_notice() {
	if ( 'valid' === _get_license( 'status' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-error"><p>%s <strong>%s</strong> %s <a href="%s">%s</a></p></div>',
		esc_html__( 'Please activate your', 'genesis-customizer' ),
		esc_html__( 'Genesis Customizer Pro', 'genesis-customizer' ),
		esc_html__( 'license to enable automatic updates.', 'genesis-customizer' ),
		admin_url( 'admin.php?page=genesis-customizer&tab=license' ),
		esc_html__( 'License settings', 'genesis-customizer' )
	);
}
