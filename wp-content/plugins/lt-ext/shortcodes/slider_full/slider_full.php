<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Slider
 */

// Shortcode fields configuration
if ( !function_exists( 'ltx_vc_slider_full_params' ) ) {

	function ltx_vc_slider_full_params() {

		$fields = array(

			array(
				"param_name" => "autoplay",
				"heading" => esc_html__("Autoplay (ms)", 'lt-ext'),
				"description" => esc_html__("0 - autoplay is disabled", 'lt-ext'),
				"std"	=>	"0",				
				"admin_label" => true,
				"type" => "textfield"
			),
			array(
				'type' => 'param_group',
				'param_name' => 'ltx_vc_slider_full_params',
				'heading' => esc_html__( 'Items', 'lt-ext' ),
				"description" => wp_kses_data( __("Add slide items", 'lt-ext') ),
				'value' => urlencode( json_encode( array(
					array(
						'header' => '',
					),
				) ) ),
				'params' => array(
					array(
						'param_name' => 'header',
						'heading' => esc_html__( 'Header', 'lt-ext' ),
						'type' => 'textarea',
						"description" => esc_html__("Use {{ brackets }} to add subheader ", 'lt-ext'),
						'admin_label' => true,
					),
					array(
						'param_name' => 'descr',
						'heading' => esc_html__( 'Description', 'lt-ext' ),
						'type' => 'textarea',
						'admin_label' => false,
					),											
					array(
						'param_name' => 'href',
						'heading' => esc_html__( 'Href', 'lt-ext' ),
						'type' => 'textfield',
					),
					array(
						"param_name" => "image",
						"heading" => esc_html__("Background image", 'lt-ext'),
						"type" => "attach_image"
					),															
				),
			),	
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_slider_full' ) ) {

	function like_sc_slider_full($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_slider_full', $atts, array_merge( array(

			'arrows'			=> 'enabled',
			'ltx_vc_slider_full_params'		=> '',
			'pagination'		=> 'enabled',
			'effect'			=> 'flip',
			'image_status'		=> 'visible',
			'autoplay'		=> 0,
			'background'		=> '',
			'background_status'	=> 'hidden',
			'category_filter'	=> '',

			), array_fill_keys(array_keys(ltx_vc_default_params(true)), null) )
		);

		$atts['items'] = json_decode ( urldecode( $atts['ltx_vc_slider_full_params'] ), true );

		return like_sc_output('slider_full', $atts, $content);
	}

	if (ltx_vc_inited()) add_shortcode("like_sc_slider_full", "like_sc_slider_full");
}


// Adding shortcode to VC
if (!function_exists('ltx_vc_slider_full_add')) {

	function ltx_vc_slider_full_add() {
		
		vc_map( array(
			"base" => "like_sc_slider_full",
			"name" 	=> esc_html__("Slider Full Screen", 'lt-ext'),
//			"description" => esc_html__("slider_full", 'lt-ext'),
			"class" => "like_sc_slider_full",
//			"icon"	=>	ltxGetPluginUrl('/shortcodes/slider_full/swiper_slider.png'),
			"category" => esc_html__('LTX-Themes', 'lt-ext'),
			"params" => array_merge(
				ltx_vc_slider_full_params(),
				ltx_vc_default_params()
			),
		) );
	}

	if (ltx_vc_inited()) add_action('vc_before_init', 'ltx_vc_slider_full_add', 30);
}


