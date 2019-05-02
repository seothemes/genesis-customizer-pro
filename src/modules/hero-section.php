<?php

namespace GenesisCustomizer;

// Enable config.
add_filter( 'genesis-customizer_hero_settings_config', '__return_true' );

// Enable excerpts on pages.
add_post_type_support( 'page', 'excerpt' );

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

	if ( in_array( 'archive', $settings ) && _is_archive() ) {
		$has = 'archive';

	} elseif ( in_array( 'post', $settings ) && ( is_singular() && ! is_page() ) ) {
		$has = 'post';

	} elseif ( in_array( 'page', $settings ) && ( is_singular( 'page' ) && ! genesis_is_blog_template() || is_404() ) ) {
		$has = 'page';

	}

	if ( get_post_meta( get_the_ID(), 'hero_disabled', true ) ) {
		$has = false;
	}

	if ( ! current_theme_supports( 'hero-section' ) ) {
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
	remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_intro_text', 12, 3 );
	remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
	remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
	remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
	remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

	remove_filter( 'genesis_term_intro_text_output', 'wpautop' );
	remove_filter( 'genesis_author_intro_text_output', 'wpautop' );
	remove_filter( 'genesis_cpt_archive_intro_text_output', 'wpautop' );

	add_filter( 'woocommerce_show_page_title', '__return_null' );
	add_filter( 'genesis_search_title_output', '__return_false' );
	add_filter( 'genesis_attr_archive-title', __NAMESPACE__ . '\hero_archive_title_attr' );
	add_filter( 'genesis_attr_entry', __NAMESPACE__ . '\hero_entry_attr' );

	add_action( 'genesis_before_hero-section_wrap', 'the_custom_header_markup' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_posts_page_heading' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_date_archive_title' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_taxonomy_title_description' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_author_title_description' );
	add_action( 'genesis_customizer_hero_section', 'genesis_do_cpt_archive_title_description' );
	add_action( 'genesis_archive_title_descriptions', __NAMESPACE__ . '\do_archive_headings_intro_text', 12, 3 );
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
	if ( class_exists( 'WooCommerce' ) && \is_shop() ) {
		$title = get_the_title( \wc_get_page_id( 'shop' ) );

	} elseif ( is_home() && 'posts' === get_option( 'show_on_front' ) ) {
		$title = _get_value( 'hero_settings_latest-posts-title' );

	} elseif ( is_404() ) {
		$title = apply_filters( 'genesis_404_entry_title', esc_html__( 'Not found, error 404', 'genesis-customizer' ) );

	} elseif ( is_search() ) {
		$title = apply_filters( 'genesis_search_title_text', esc_html__( 'Search results for: ', 'genesis-customizer' ) . get_search_query() );

	} elseif ( genesis_is_blog_template() ) {
		ob_start();
		do_action( 'genesis_archive_title_descriptions', get_the_title(), '', 'posts-page-description' );
		$title = ob_get_clean();

	} elseif ( is_singular() ) {
		$title = get_the_title();
	}

	if ( isset( $title ) && $title ) {
		genesis_markup( [
			'open'    => '<h1 %s itemprop="headline">',
			'close'   => '</h1>',
			'content' => $title,
			'context' => 'hero-title',
		] );
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
	$excerpt = '';
	$id      = '';

	if ( _is_plugin_active( 'woocommerce' ) && \is_shop() ) {
		ob_start();
		\woocommerce_result_count();
		$excerpt = ob_get_clean();

	} elseif ( is_home() && 'posts' === get_option( 'show_on_front' ) ) {
		$excerpt = _get_value( 'hero_settings_latest-posts-subtitle' );

	} elseif ( is_home() ) {
		$id = get_option( 'page_for_posts' );

	} elseif ( is_search() ) {
		$id = get_page_by_path( 'search' );

	} elseif ( is_404() ) {
		$id = get_page_by_path( 'error-404' );

	} elseif ( ( is_singular() ) && ! is_singular( 'product' ) ) {
		$id = get_the_ID();
	}

	if ( $id ) {
		$excerpt = has_excerpt( $id ) ? do_shortcode( get_the_excerpt( $id ) ) : '';
	}

	if ( $excerpt ) {
		genesis_markup( [
			'open'    => '<p %s itemprop="description">',
			'close'   => '</p>',
			'content' => $excerpt,
			'context' => 'hero-subtitle',
		] );
	}
}

/**
 * Add intro text for archive headings to archive pages.
 *
 * @since 2.5.0
 *
 * @param string $heading    Optional. Archive heading, default is empty string.
 * @param string $intro_text Optional. Archive intro text, default is empty string.
 * @param string $context    Optional. Archive context, default is empty string.
 */
function do_archive_headings_intro_text( $heading = '', $intro_text = '', $context = '' ) {

	if ( $context && $intro_text ) {
		genesis_markup( [
			'open'    => '<p %s itemprop="description">',
			'close'   => '</p>',
			'content' => $intro_text,
			'context' => 'hero-subtitle',
		] );
	}
}

/**
 * Adds attributes to hero archive title markup.
 *
 * @since 1.0.0
 *
 * @param $atts
 *
 * @return array
 */
function hero_archive_title_attr( $atts ) {
	$atts['class']    = 'hero-title';
	$atts['itemprop'] = 'headline';

	return $atts;
}

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

/**
 * Display the hero section.
 *
 * @since  1.0.0
 *
 * @return void
 */
function hero_display() {
	genesis_markup( [
		'open'    => '<section %s role="banner">',
		'context' => 'hero-section',
	] );

	genesis_structural_wrap( 'hero-section', 'open' );

	genesis_markup( [
		'open'    => '<div %s>',
		'context' => 'hero-inner',
	] );

	do_action( 'genesis_customizer_hero_section' );

	genesis_markup( [
		'close'   => '</div>',
		'context' => 'hero-inner',
	] );

	genesis_structural_wrap( 'hero-section', 'close' );

	genesis_markup( [
		'close'   => '</section>',
		'context' => 'hero-section',
	] );
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
