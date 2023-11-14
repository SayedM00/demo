<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Filters and Actions
 */

/**
 * Enqueue Google fonts style to admin
 *
 * @internal
 */
function lamaro_action_theme_admin_fonts() {

	wp_enqueue_style( 'lamaro-theme-admin-font', lamaro_font_url(), array(), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'lamaro_action_theme_admin_fonts' );

/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 * @internal
 */
if ( ! function_exists( 'lamaro_theme_setup' ) ) {

	function lamaro_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'lamaro', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'assets/css/editor-style.css', lamaro_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1120, 720, true );

		add_image_size( 'lamaro-service', 430, 280, true );	
		add_image_size( 'lamaro-service-square', 200, 200, true );	
		add_image_size( 'lamaro-blog-300', 300, 195, true );	
		add_image_size( 'lamaro-blog-featured', 495, 695, true );	
		add_image_size( 'lamaro-blog-tiny', 128, 84, true );	
		add_image_size( 'lamaro-blog', 470, 302, true );	
		add_image_size( 'lamaro-blog-full', 1120, 720, true );	
		add_image_size( 'lamaro-tiny-square', 70, 70, true );	
		add_image_size( 'lamaro-partners', 125, 125 );	
		add_image_size( 'lamaro-tiny', 130, 90, true );	
		add_image_size( 'lamaro-gallery', 755, 500, true );	
		add_image_size( 'lamaro-team', 290, 290, true );	

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

	}
}
add_action( 'init', 'lamaro_theme_setup' );

/**
 * Load Gutenberg stylesheet.
 */
function lamaro_block_assets() {

	wp_enqueue_style( 'lamaro-block-assets', get_theme_file_uri( '/assets/css/block-editor-style.css' ), false );
}
add_action( 'enqueue_block_editor_assets', 'lamaro_block_assets' );


function lamaro_add_woocommerce_support() {

    add_theme_support( 'woocommerce' );

    if ( function_exists( 'fw_get_db_settings_option' ) ) $wc_zoom = fw_get_db_settings_option( 'wc_zoom' );
	if ( !empty($wc_zoom) AND $wc_zoom == 'enabled') add_theme_support( 'wc-product-gallery-zoom' );

	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );   
}
add_action( 'after_setup_theme', 'lamaro_add_woocommerce_support' );
/**
 * Adjust content_width value for image attachment template.
 *
 * @internal
 */
function lamaro_action_theme_content_width() {

	if ( is_attachment() && wp_attachment_is_image() ) {
		
		$GLOBALS['content_width'] = 770;
	}
}

add_action( 'template_redirect', 'lamaro_action_theme_content_width' );

/**
 * Extend the default WordPress body classes.
 *
 * @param array $classes A list of existing body class values.
 *
 * @return array The filtered body class list.
 * @internal
 */
function lamaro_filter_theme_body_classes( $classes ) {

	global $wp_query;

	if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {

		$current_position = fw_ext_sidebars_get_current_position();
		if ( in_array( $current_position, array( 'full', 'left' ) )
		     || empty( $current_position )
		     || is_page_template( 'page-templates/full-width.php' )
		     || is_page_template( 'page-templates/contributors.php' )
		     || is_attachment()
		) {
			$classes[] = 'full-width';
		}
	} else {
		$classes[] = 'full-width';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	$sidebar_layout = 'right';
	$lamaro_pace = 'disabled';
	if ( function_exists( 'FW' ) ) {

		$lamaro_pace = fw_get_db_settings_option( 'page-loader' );
		if ( !empty($lamaro_pace) AND !empty($lamaro_pace['loader'])) $lamaro_pace = $lamaro_pace['loader'];
		
		$body_color = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'body-color' );
		if ( !empty($body_color) AND $body_color != 'default' ) $classes[] = "body-".esc_attr($body_color);

		$body_border = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'margin-layout' );
		if ( !empty($body_border) AND $body_border == 'body-border' ) $classes[] = "ltx-body-border";

		$sidebar_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'sidebar-layout' );

		$lamaro_footer_cols = lamaro_get_footer_cols_num();
	}
		else {

	}

	$classes[] = 'ltx-theme-header-icon';

	if ( empty($lamaro_footer_cols) ) {

		$classes[] = 'no-footer-widgets';
	}

	$classes[] = 'paceloader-'.esc_attr($lamaro_pace);

	if ( $sidebar_layout == 'hidden' OR is_page_template( 'page-templates/full-width.php' ) ) {

		$classes[] = 'full-width';
		$classes[] = 'no-sidebar';
	}


	return $classes;
}

add_filter( 'body_class', 'lamaro_filter_theme_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 *
 * @return array The filtered post class list.
 * @internal
 */
function lamaro_filter_theme_post_classes( $classes ) {

	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {

		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'lamaro_filter_theme_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string The filtered title.
 * @internal
 */
function lamaro_filter_theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'lamaro' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'lamaro_filter_theme_wp_title', 10, 2 );


/**
 * Flush out the transients used in lamaro_categorized_blog.
 *
 * @internal
 */
function lamaro_action_theme_category_transient_flusher() {

	delete_transient( 'lamaro_category_count' );
}

add_action( 'edit_category', 'lamaro_action_theme_category_transient_flusher' );
add_action( 'save_post', 'lamaro_action_theme_category_transient_flusher' );


function lamaro_theme_custom_framework_customizations_dir_rel_path($rel_path) {

    return '/inc/fw';
}
add_filter(
    'fw_framework_customizations_dir_rel_path', 
    'lamaro_theme_custom_framework_customizations_dir_rel_path'
);


/**
 * @param FW_Ext_Backups_Demo[] $demos
 * @return FW_Ext_Backups_Demo[]
 */
function lamaro_filter_theme_fw_ext_backups_demos( $demos ) {
	$demos_array = array(
		'lamaro-demo' => array(
			'title' => esc_html__( 'Lamaro Demo Content', 'lamaro' ),
			'screenshot' => 'http://updates.like-themes.com/lamaro/screenshot.png',
			'preview_link' => 'http://lamaro.like-themes.com/',
		),
	);

	$download_url = 'http://updates.like-themes.com/lamaro/?aiv='.esc_attr(wp_get_theme(get_template())->version);

	foreach ( $demos_array as $id => $data ) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url' => $download_url,
			'file_id' => $id,
		));
		$demo->set_title( $data['title'] );
		$demo->set_screenshot( $data['screenshot'] );
		$demo->set_preview_link( $data['preview_link'] );

		$demos[ $demo->get_id() ] = $demo;

		unset( $demo );
	}

	return $demos;
}
add_filter( 'fw:ext:backups-demo:demos', 'lamaro_filter_theme_fw_ext_backups_demos' );



