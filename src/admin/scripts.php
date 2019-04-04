<?php

namespace GenesisCustomizer;


add_action( 'admin_print_scripts', __NAMESPACE__ . '\admin_inline_js', 100 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function admin_inline_js() {
	global $pagenow;

	if ( $pagenow === 'admin.php' && ( _get_handle() === $_GET['page'] ) ) {
		?>

        <script type='text/javascript'>
            (function (document, $) {
                $(function () {
                    $('#select-all').on('click', function () {
                        var checkBoxes = $('#genesis-customizer-modules input[type=checkbox]');
                        checkBoxes.prop("checked", true);
                    });
                    $('#deselect-all').on('click', function () {
                        var checkBoxes = $('#genesis-customizer-modules input[type=checkbox]');
                        checkBoxes.prop("checked", false);
                    });
                });
            })(document, jQuery);
        </script>
		<?php
	}
}
