<?php

namespace GenesisCustomizer;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\custom_js_output' );
/**
 * Outputs Additional JS to site footer.
 *
 * @since  1.0.0
 *
 * @return void
 */
function custom_js_output() {
	$handle = _get_handle() . '-custom-js';
	$output = _get_value( 'code_js_output' );

	if ( 'inline' === $output || is_customize_preview() ) {
		add_action( 'wp_footer', __NAMESPACE__ . '\inline_js' );

	} else {
		wp_enqueue_script(
			$handle,
			admin_url( 'admin-ajax.php' ) . '?action=dynamic_js&wpnonce=' . wp_create_nonce( 'dynamic-js-nonce' ),
			[],
			_get_version(),
			'all'
		);
	}
}

/**
 * Outputs Additional JS to site footer.
 *
 * @since  1.0.0
 *
 * @return void
 */
function inline_js() {
	$output = _get_value( 'code_js_output' );

	if ( 'inline' !== $output && ! is_customize_preview() ) {
		return;
	}

	$jquery  = _get_value( 'code_js_jquery' );
	$vanilla = _get_value( 'code_js_vanilla' );

	if ( '' !== $jquery ) {
		?>
        <script type="text/javascript">
            jQuery(function ($) {
                "use strict";
				<?php echo $jquery . "\n"; ?>
            });
        </script>
		<?php
	}

	if ( '' !== $vanilla ) {
		?>
        <script type="text/javascript">
			<?php echo $vanilla . "\n"; ?>
        </script>
		<?php
	}
}

add_action( 'wp_ajax_dynamic_js', __NAMESPACE__ . '\dynamic_js' );
add_action( 'wp_ajax_nopriv_dynamic_js', __NAMESPACE__ . '\dynamic_js' );
/**
 * Load the dynamic CSS with ajax.
 *
 * @since 1.0.0
 *
 * @return void
 */
function dynamic_js() {
	$nonce = $_REQUEST['wpnonce'];

	if ( ! wp_verify_nonce( $nonce, 'dynamic-js-nonce' ) ) {
		die( __( 'Invalid nonce.', 'genesis-customizer' ) );

	} else {
		header( "Content-type: text/javascript; charset: UTF-8" );

		$jquery  = _get_value( 'code_js_jquery' );
		$vanilla = _get_value( 'code_js_vanilla' );
		$js      = $jquery ? 'jQuery(function($){"use strict";' . $jquery . '});' : '';
		$js      .= $vanilla;

		echo $js;
	}

	exit;
}
