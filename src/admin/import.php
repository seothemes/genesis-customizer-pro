<?php

namespace GenesisCustomizer;

add_filter( 'genesis_customizer_theme_demos', __NAMESPACE__ . '\pro_merlin_local_import_files' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $demos
 *
 * @return array
 */
function pro_merlin_local_import_files( $demos ) {
	$demos[] = [
		'import_file_name'             => 'Business Pro (Elementor)',
		'local_import_file'            => _get_pro_path() . 'assets/demo/business-pro/content.xml',
		'local_import_widget_file'     => _get_pro_path() . 'assets/demo/business-pro/widgets.wie',
		'local_import_customizer_file' => _get_pro_path() . 'assets/demo/business-pro/customizer.dat',
		'import_preview_image_url'     => 'https://genesiscustomizer.test/wp-content/uploads/2019/03/mockup-1024x597.png',
		'import_notice'                => __( 'A special note for this import.', 'genesis-customizer' ),
		'preview_url'                  => 'https://genesiscustomizer.com',
	];

	return $demos;
}
