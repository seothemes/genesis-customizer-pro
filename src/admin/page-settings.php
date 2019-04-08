<?php

namespace GenesisCustomizer;

// Bail if module not enabled.
if ( ! _is_module_enabled( 'hero-section' ) ) {
	return;
}

add_action( 'add_meta_boxes', __NAMESPACE__ . '\add_hero_meta_box' );
/**
 * Adds meta box.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_hero_meta_box() {
	add_meta_box(
		_get_handle(),
		_get_name(),
		__NAMESPACE__ . '\render_hero_meta_box',
		[ 'post', 'page', 'product', 'portfolio' ],
		'side',
		'low'
	);
}

add_action( 'save_post', __NAMESPACE__ . '\save_meta_box' );
/**
 * Save the meta when the post is saved.
 *
 * @since 1.0.0
 *
 * @param int $post_id The ID of the post being saved.
 *
 * @return mixed
 */
function save_meta_box( $post_id ) {
	$handle = _get_handle();

	if ( ! isset( $_POST[ $handle . '_meta_box_nonce' ] ) ) {
		return $post_id;
	}

	if ( ! wp_verify_nonce( $_POST[ $handle . '_meta_box_nonce' ], $handle . '_meta_box_nonce_action' ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}

	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$settings = page_settings_array();

	foreach ( $settings as $setting => $post_meta_key ) {
		$value = isset( $_POST[ $post_meta_key ] ) ? 'yes' : '';

		update_post_meta( $post_id, $post_meta_key, $value );
	}

	return null;
}

/**
 * Render Meta Box content.
 *
 * @since 1.0.0
 *
 * @param object $post The post object.
 *
 * @return void
 */
function render_hero_meta_box( $post ) {
	$handle   = _get_handle();
	$settings = page_settings_array();
	$counter  = 0;

	foreach ( $settings as $setting => $post_meta_key ) {
		$disabled = get_post_meta( $post->ID, $post_meta_key, true );
		$checked  = 'yes' === $disabled ? $disabled : '';
		echo $counter === 0 ? '' : '<br>';
		$counter ++;

		?>
        <label for="<?php echo $post_meta_key ?>">
            <input type="checkbox" name="<?php echo $post_meta_key; ?>" id="<?php echo $post_meta_key ?>" value="" <?php checked( $checked, 'yes' ); ?>>
			<?php echo esc_html__( 'Disable ', 'genesis-customizer' ) . str_replace( '_', ' ', $setting ); ?>
        </label>
        <br>
		<?php
	}

	wp_nonce_field( $handle . '_meta_box_nonce_action', $handle . '_meta_box_nonce' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return array
 */
function page_settings_array() {
	return [
		'hero_section'       => 'hero_disabled',
		'sticky_header'      => 'sticky_disabled',
		'transparent_header' => 'transparent_disabled',
		'site_header'        => 'header_disabled',
		'site_footer'        => 'footer_disabled',
	];
}