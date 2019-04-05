<?php

namespace GenesisCustomizer;

return [
	[
		'type'     => 'toggle',
		'settings' => 'child-theme-css',
		'label'    => esc_html__( 'Load child theme CSS', 'genesis-customizer' ),
		'tooltip'  => esc_html__( 'Prevents the child theme style.css file being loaded on the front end of the site.', 'genesis-customizer' ),
		'default'  => true,
	],
	[
		'type'     => 'toggle',
		'settings' => 'style-trump',
		'label'    => esc_html__( 'Genesis style trump', 'genesis-customizer' ),
		'tooltip'  => esc_html__( 'No, not Donald. Style trump means to load the child theme stylesheet at a later priority to override plugin styles.', 'genesis-customizer' ),
		'default'  => true,
	],
	[
		'type'     => 'custom',
		'settings' => 'spacer-938732',
		'default'  => '<div class="clearfix" style="padding: 100px"></div>',
	],
];
