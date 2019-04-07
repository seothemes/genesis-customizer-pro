<?php

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_hero_settings_config', '__return_true' );

// Enable theme support by default.
add_theme_support( 'custom-header', [
	'header-selector'  => 'section.hero-section',
	'default_image'    => _get_url() . 'assets/img/hero-section.jpg',
	'header-text'      => false,
	'width'            => 1280,
	'height'           => 720,
	'flex-height'      => true,
	'flex-width'       => true,
	'uploads'          => true,
	'video'            => false,
	'wp-head-callback' => __NAMESPACE__ . '\custom_header',
] );

add_action( 'genesis_meta', __NAMESPACE__ . '\hero_init' );
/**
 * Initialize class.
 *
 * @since 3.3.0
 *
 * @return void
 */
function hero_init() {
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'hero-section' );
	add_filter( 'body_class', __NAMESPACE__ . '\hero_body_class' );

	if ( hero_enabled( _get_value( 'hero_settings_enable' ) ) ) {
		hero_setup();
	}
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $classes
 *
 * @return array
 */
function hero_body_class( $classes ) {
	$settings = (array) _get_value( 'hero_settings_enable' );

	if ( hero_enabled( $settings ) ) {
		$classes[] = 'has-hero-section';

	} else {
		$classes[] = 'no-hero-section';
	}

	return $classes;
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $settings
 *
 * @return bool|string
 */
function hero_enabled( $settings ) {
	$has = false;

	if ( in_array( 'archive', $settings ) && ( is_archive() || is_search() || is_home() || is_date() || class_exists( 'WooCommerce' ) && is_shop() || is_post_type_archive() || genesis_is_blog_template() ) ) {
		$has = 'archive';

	} elseif ( in_array( 'post', $settings ) && ( is_singular() && ! is_page() ) ) {
		$has = 'post';

	} elseif ( in_array( 'page', $settings ) && ( is_singular( 'page' ) && ! genesis_is_blog_template() || is_404() ) ) {
		$has = 'page';

	}

	if ( ! current_theme_supports( 'hero-section' ) ) {
		$has = false;
	}

	if ( is_singular() && 'none' === get_post_meta( get_the_ID(), '_hero_section', true ) ) {
		$has = false;
	}

	return $has;
}

/**
 * Sets up hero section.
 *
 * @since  1.5.0
 *
 * @return void
 */
function hero_setup() {
	if ( is_admin() ) {
		return;
	}

	if ( is_singular() && ! genesis_is_blog_template() ) {
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	}

	$breadcrumbs = _get_value( 'hero_settings_breadcrumbs' );

	if ( $breadcrumbs ) {
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
		add_action( 'genesis_customizer_hero_section', 'genesis_do_breadcrumbs', 30 );
	}

	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
	remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5, 3 );
	remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15, 3 );
	remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
	remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
	remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
	remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

	add_filter( 'woocommerce_show_page_title', '__return_null' );
	add_filter( 'genesis_search_title_output', '__return_false' );

	add_action( 'genesis_before_hero-section_wrap', 'the_custom_header_markup' );

	add_action( 'genesis_customizer_hero_section', 'genesis_do_posts_page_heading' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_date_archive_title' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_taxonomy_title_description' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_author_title_description' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_cpt_archive_title_description' );
	add_action( 'genesis_customizer_hero_section', __NAMESPACE__ . '\hero_title', 10 );
	add_action( 'genesis_customizer_hero_section', __NAMESPACE__ . '\hero_excerpt', 20 );
	add_action( 'be_title_toggle_remove', __NAMESPACE__ . '\hero_title_toggle' );
	add_action( 'genesis_before_content', __NAMESPACE__ . '\hero_remove_404_title' );
	add_action( 'genesis_before_content_sidebar_wrap', __NAMESPACE__ . '\hero_display' );
}

/**
 * Remove default title of 404 pages.
 *
 * @since  1.0.0
 *
 * @return void
 */
function hero_remove_404_title() {
	if ( is_404() ) {
		add_filter( 'genesis_markup_entry-title_open', '__return_false' );
		add_filter( 'genesis_markup_entry-title_content', '__return_false' );
		add_filter( 'genesis_markup_entry-title_close', '__return_false' );
	}
}

/**
 * Integrate with Genesis Title Toggle plugin.
 *
 * @since  1.0.0
 *
 * @author Bill Erickson
 * @link   http://billerickson.net/code/genesis-title-toggle-theme-integration
 *
 * @return void
 */
function hero_title_toggle() {
	remove_action( 'genesis_customizer_hero_section', __NAMESPACE__ . '\hero_title', 10 );
	remove_action( 'genesis_customizer_hero_section', __NAMESPACE__ . '\hero_excerpt', 20 );
}

/**
 * Display title in hero section.
 *
 * @since  1.0.0
 *
 * @return void
 */
function hero_title() {
	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		genesis_markup(
			[
				'open'    => '<h1 %s>',
				'close'   => '</h1>',
				'content' => get_the_title( wc_get_page_id( 'shop' ) ),
				'context' => 'entry-title',
			]
		);

	} elseif ( is_home() && 'posts' === get_option( 'show_on_front' ) ) {
		genesis_markup(
			[
				'open'    => '<h1 %s>',
				'close'   => '</h1>',
				'content' => apply_filters( 'genesis_customizer_latest_posts_title', esc_html( 'Latest Posts' ) ),
				'context' => 'entry-title',
			]
		);

	} elseif ( is_404() ) {
		genesis_markup(
			[
				'open'    => '<h1 %s>',
				'close'   => '</h1>',
				'content' => apply_filters( 'genesis_404_entry_title', esc_html( 'Not found, error 404' ) ),
				// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Parent theme prefix.
				'context' => 'entry-title',
			]
		);

	} elseif ( is_search() ) {
		genesis_markup(
			[
				'open'    => '<h1 %s>',
				'close'   => '</h1>',
				'content' => apply_filters( 'genesis_search_title_text', esc_html( 'Search results for: ' ) . get_search_query() ),
				// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Parent theme prefix.
				'context' => 'entry-title',
			]
		);

	} elseif ( genesis_is_blog_template() ) {
		do_action( 'genesis_archive_title_descriptions', get_the_title(), '', 'posts-page-description' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Parent theme prefix.

	} elseif ( is_singular() ) {
		genesis_do_post_title();
	}
}

/**
 * Display page excerpt.
 *
 * @since  1.0.0
 *
 * @return void
 */
function hero_excerpt() {
	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		woocommerce_result_count();

	} elseif ( is_home() && 'posts' === get_option( 'show_on_front' ) ) {
		printf( '<p class="entry-subtitle" itemprop="description">%s</p>', apply_filters( 'genesis_customizer_latest_posts_excerpt', esc_html( 'Showing the latest posts' ) ) );

	} elseif ( is_search() ) {
		$id = get_page_by_path( 'search' );

		if ( has_excerpt( $id ) ) {
			printf( '<p class="entry-subtitle" itemprop="description">%s</p>', do_shortcode( get_the_excerpt( $id ) ) );
		}

	} elseif ( is_404() ) {
		$id = get_page_by_path( 'error' );

		if ( has_excerpt( $id ) ) {
			printf( '<p class="entry-subtitle" itemprop="description">%s</p>', do_shortcode( get_the_excerpt( $id ) ) );
		}

	} elseif ( ( is_singular() ) && ! is_singular( 'product' ) ) {
		$id = get_the_ID();
		if ( has_excerpt( $id ) ) {
			printf( '<p class="entry-subtitle" itemprop="description">%s</p>', do_shortcode( get_the_excerpt() ) );
		}
	}
}

add_filter( 'genesis_attr_entry', __NAMESPACE__ . '\hero_entry_attr' );
/**
 * Adds attributes to hero section markup.
 *
 * @since 1.0.0
 *
 * @param $atts
 *
 * @return array
 */
function hero_entry_attr( $atts ) {
	if ( is_singular() ) {
		$atts['itemref'] = 'hero-section';
	}

	return $atts;
}

add_filter( 'genesis_attr_hero-section', __NAMESPACE__ . '\hero_section_attr' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $atts
 *
 * @return array
 */
function hero_section_attr( $atts ) {
	$atts['id']   = 'hero-section';
	$atts['role'] = 'banner';

	return $atts;
}

/**
 * Display the hero section.
 *
 * @since  1.0.0
 *
 * @return void
 */
function hero_display() {
	genesis_markup( [
		'open'    => '<section %s>',
		'context' => 'hero-section',
	] );

	genesis_structural_wrap( 'hero-section', 'open' );

	do_action( 'genesis_customizer_hero_section' );

	genesis_structural_wrap( 'hero-section', 'close' );

	genesis_markup( [
		'close'   => '</section>',
		'context' => 'hero-section',
	] );
}

add_filter( 'genesis_customizer_sections', __NAMESPACE__ . '\other_hero_images', 15, 1 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return array
 */
function other_hero_images( $sections ) {
	$other_pages = [
		'search' => __( 'Search', 'genesis-customizer' ),
		'404'    => __( 'Error / 404', 'genesis-customizer' ),
	];

	foreach ( $other_pages as $other_page => $title ) {
		\Kirki::add_field( _get_handle(), [
			'type'     => 'image',
			'label'    => $title,
			'section'  => _get_handle() . '_hero_other',
			'settings' => $other_page . '-image',
			'default'  => '',
		] );
	}

	$new_sections['hero']['other'] = __( 'Other Pages', 'genesis-customizer' );

	$merged = array_merge_recursive( $sections, $new_sections );

	return $merged;
}

add_filter( 'genesis_customizer_sections', __NAMESPACE__ . '\archive_hero_images', 15, 1 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return array
 */
function archive_hero_images( $sections ) {
	$post_types = \Kirki_Helper::get_post_types();

	foreach ( $post_types as $post_type => $title ) {
		$exclude = [
			'post',
			'page',
			'attachment',
		];

		if ( in_array( $post_type, $exclude ) ) {
			continue;
		}

		\Kirki::add_field( _get_handle(), [
			'type'     => 'image',
			'label'    => $title,
			'section'  => _get_handle() . '_hero_archives',
			'settings' => $post_type . '-image',
			'default'  => '',
		] );
	}

	$new_sections['hero']['archives'] = __( 'Post Type Archives', 'genesis-customizer' );

	$merged = array_merge_recursive( $sections, $new_sections );

	return $merged;
}

add_filter( 'genesis_customizer_sections', __NAMESPACE__ . '\term_hero_images', 20, 1 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $sections
 *
 * @return array
 */
function term_hero_images( $sections ) {
	$taxonomies   = \Kirki_Helper::get_taxonomies();
	$new_sections = [];

	foreach ( $taxonomies as $taxonomy => $title ) {
		$new_sections['hero'][ $taxonomy ] = $title;

		$terms = \Kirki_Helper::get_terms( [ 'taxonomy' => $taxonomy ] );

		foreach ( $terms as $term => $name ) {
			\Kirki::add_field( _get_handle(), [
				'type'     => 'image',
				'label'    => $name,
				'section'  => _get_handle() . '_hero_' . $taxonomy,
				'settings' => 'term-' . $term,
				'default'  => '',
			] );
		}
	}

	$merged = array_merge_recursive( $sections, $new_sections );

	return $merged;
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
		'hero-section',
		'Hero Section',
		__NAMESPACE__ . '\render_hero_meta_box',
		[ 'post', 'page', 'product', 'portfolio' ],
		'side',
		'low'
	);
}

add_action( 'save_post', __NAMESPACE__ . '\save_hero_meta_box' );
/**
 * Save the meta when the post is saved.
 *
 * @since 1.0.0
 *
 * @param int $post_id The ID of the post being saved.
 *
 * @return mixed
 */
function save_hero_meta_box( $post_id ) {
	if ( ! isset( $_POST['hero_section_nonce'] ) ) {
		return $post_id;
	}

	if ( ! wp_verify_nonce( $_POST['hero_section_nonce'], 'hero_section_nonce_action' ) ) {
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

	if ( array_key_exists( 'hero_section', $_POST ) ) {
		update_post_meta( $post_id, '_hero_section', $_POST['hero_section'] );
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
	$value   = get_post_meta( $post->ID, '_hero_section', true );
	$value   = '' === $value ? 'site_default' : $value;
	$choices = [
		'site_default',
		'featured_image',
		'no_image',
		'none',
	];

	echo '<p>' . esc_html__( 'Overrides the default hero section value set in the Customizer.', 'genesis-customizer' ) . '</p>';

	foreach ( $choices as $choice ) {
		?>
		<label for="hero_section_<?php echo $choice; ?>">
			<input type="radio" name="hero_section"
			       id="hero_section_<?php echo $choice; ?>"
			       value="<?php echo $choice; ?>" <?php checked( $value, $choice ); ?> >
			<?php echo ucwords( str_replace( '_', ' ', $choice ) ); ?>
		</label>
		<br>
		<?php
	}

	wp_nonce_field( 'hero_section_nonce_action', 'hero_section_nonce' );
}
