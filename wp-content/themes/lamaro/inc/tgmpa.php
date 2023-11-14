<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * TGM Plugin Activation
 */

require_once get_template_directory() . '/tgm-plugin-activation/class-tgm-plugin-activation.php';

if ( !function_exists('lamaro_action_theme_register_required_plugins') ) {

	function lamaro_action_theme_register_required_plugins() {

		$config = array(

			'id'           => 'lamaro',
			'menu'         => 'lamaro-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => false,
			'is_automatic' => false,
		);

		tgmpa( array(

			array(
				'name'      => esc_html__('Unyson', 'lamaro'),
				'slug'      => 'unyson',
				'source'   	=> 'http://updates.like-themes.com/plugins/unyson/unyson-fork.zip',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('LT Extension', 'lamaro'),
				'slug'      => 'lt-ext',
				'source'   	=> get_template_directory() . '/inc/plugins/lt-ext.zip',
				'version'   => '2.1.5',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('WPBakery Page Builder', 'lamaro'),
				'slug'      => 'js_composer',
				'source'   	=> 'http://updates.like-themes.com/plugins/js_composer/js_composer.zip',
				'required'  => true,
			),		
			array(
				'name'      => esc_html__('Envato Market', 'lamaro'),
				'slug'      => 'envato-market',
				'source'   	=> get_template_directory() . '/inc/plugins/envato-market.zip',
				'required'  => false,
			),													
			array(
				'name'      => esc_html__('Breadcrumb-navxt', 'lamaro'),
				'slug'      => 'breadcrumb-navxt',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Contact Form 7', 'lamaro'),
				'slug'      => 'contact-form-7',
				'required'  => true,
			),
			array(
				'name'       => esc_html__('MailChimp for WordPress', 'lamaro'),
				'slug'       => 'mailchimp-for-wp',
				'required'   => false,
			),		
			array(
				'name'       => esc_html__('WooCommerce', 'lamaro'),
				'slug'       => 'woocommerce',
				'required'   => false,
			),
			array(
				'name'      => esc_html__('Post-views-counter', 'lamaro'),
				'slug'      => 'post-views-counter',
				'required'  => false,
			),			
			array(
				'name'      => esc_html__('User Profile Picture', 'lamaro'),
				'slug'      => 'metronet-profile-picture',
				'required'  => false,
			),								
		), $config);
	}
}
add_action( 'tgmpa_register', 'lamaro_action_theme_register_required_plugins' );
