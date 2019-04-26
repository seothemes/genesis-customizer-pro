<?php

namespace GenesisCustomizer;

/**
 * Class Admin_Settings
 *
 * @package GenesisCustomizer
 */
class Admin_Settings extends \Genesis_Admin_Boxes {

	/**
	 * Admin_Settings constructor.
	 */
	public function __construct() {

		// Specify a unique page ID.
		$page_id = _get_handle();

		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = [
			'submenu' => [
				'parent_slug' => 'genesis',
				'page_title'  => _get_name(),
				'menu_title'  => _get_name(),
			],
		];

		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = [
			'screen_icon'       => 'options-general',
			'save_button_text'  => __( 'Save Settings', 'genesis-customizer' ),
			'reset_button_text' => __( 'Reset Settings', 'genesis-customizer' ),
			'save_notice_text'  => __( 'Settings saved.', 'genesis-customizer' ),
			'reset_notice_text' => __( 'Settings reset.', 'genesis-customizer' ),
		];

		// Give it a unique settings field.
		$settings_field = _get_handle() . '-settings';

		// Set the default values
		$defaults = [
			'license' => '',
		];

		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $defaults );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', [ $this, 'sanitization_filters' ] );
	}

	/**
	 * Set up Sanitization Filters
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 *
	 * @since 1.0.0
	 */
	public function sanitization_filters() {
		genesis_add_option_filter( 'no_html', $this->settings_field, [
			'license',
		] );
	}

	/**
	 * Description of expected behavior.
	 *
	 * @since 1.0.0
	 *
	 * @param $new
	 *
	 * @return mixed
	 */
	public function sanitize_pro_license( $new ) {
		$old = get_option( _get_pro_handle() . '_license_key' );

		if ( $old && $old !== $new ) {
			delete_option( _get_pro_handle() . '_license_status' );
		}

		return $new;
	}

	/**
	 * Description of expected behavior.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function help() {
		$screen = get_current_screen();
		$screen->add_help_tab( [
			'id'      => _get_handle(),
			'title'   => _get_name(),
			'content' => sprintf( '<p>%s</p>', __( 'Need help? Contact us', 'genesis-customizer' ) ),
		] );
	}

	/**
	 * Description of expected behavior.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function metaboxes() {
		\add_meta_box(
			'license',
			__( 'License Key', 'genesis-customizer' ),
			[ $this, 'license_fields', ],
			$this->pagehook,
			'main',
			'high'
		);

		\add_meta_box(
			'modules',
			__( 'Modules', 'genesis-customizer' ),
			[ $this, 'module_fields', ],
			$this->pagehook,
			'main',
			'high'
		);
	}

	/**
	 * Description of expected behavior.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function license_fields() {
		$handle  = _get_handle();
		$license = $this->get_field_value( 'license' );
		$status  = $this->get_field_value( 'status' );

		?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Enter license', 'genesis-customizer' ); ?></th>
                <td>
                    <input type="text" name="<?php echo $this->get_field_name( 'license' ); ?>"
                           id="<?php echo $this->get_field_id( 'license' ); ?>"
                           value="<?php echo esc_attr( $this->get_field_value( 'license' ) ); ?>" size="50"/>
                </td>
            </tr>
			<?php if ( false !== $license ) : ?>
                <tr valign="top">
                    <th scope="row" valign="top">
						<?php _e( 'Activate license' ); ?>
                    </th>
                    <td>
						<?php if ( $status === 'valid' ) { ?>
                            <b style="display:inline-block;padding:6px 6px 6px 0;color:green;"><?php _e( 'active' ); ?></b>
							<?php wp_nonce_field( $handle, $handle ); ?>
                            <input type="submit" class="button-secondary"
                                   name="<?php echo $handle; ?>_license_deactivate"
                                   value="<?php esc_html_e( 'Deactivate License', 'genesis-customizer' ); ?>"/>
						<?php } else {
							wp_nonce_field( $handle, $handle ); ?>
                            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_html_e( 'Save License', 'genesis-customizer' ) ?>">
                            <input type="submit" class="button-secondary"
                                   name="<?php echo $handle; ?>_license_activate"
                                   value="<?php esc_attr_e( 'Activate License', 'genesis-customizer' ); ?>"/>
						<?php } ?>
                    </td>
                </tr>
			<?php endif; ?>
        </table>
		<?php
	}

	/**
	 * Description of expected behavior.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function module_fields() {
		$modules = _get_pro_modules();

		?>
        <table id="genesis-customizer-modules" class="form-table">
            <tr valign="top">
                <th style="font-weight: normal;">
                    <input type="button" class="button primary" name="select-all" id="select-all" value="Select All"/>
                    &nbsp;
                    <input type="button" class="button primary" name="deselect-all" id="deselect-all" value="Deselect All"/>
                </th>
            </tr>
			<?php foreach ( $modules as $module => $title ) : ?>
				<?php $checked = $this->get_field_value( $module ); ?>
                <tr valign="top">
                    <th scope="row"><?php echo $title; ?></th>
                    <td>
                        <input type="checkbox" name="<?php echo $this->get_field_name( $module ); ?>" id="<?php echo $this->get_field_id( $module ); ?>" value="1" <?php checked( $checked ); ?> />
                    </td>
                </tr>
			<?php endforeach; ?>
        </table>

		<?php
	}
}

