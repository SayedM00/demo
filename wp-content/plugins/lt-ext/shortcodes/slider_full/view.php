<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * slider_full Shortcode
 */

$args = get_query_var('like_sc_slider_full');

$id = $class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$query_args = array(
	'post_type' => 'slider_full',
	'post_status' => 'publish',
	'posts_per_page' => 0,	
);

if ( !empty($args['category_filter']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'slider_full-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['category_filter'])),
		)
    );
}

if ( !empty($atts['arrows']) AND $atts['arrows'] == 'enabled' ) $atts['arrows'] = true; else $atts['arrows'] = '';
if ( !empty($atts['pagination']) AND $atts['pagination'] == 'enabled' ) $atts['pagination'] = true; else $atts['pagination'] = '';

if ( !empty($atts['items']) ) {

	$cols = 4;
	if ( sizeof($atts['items']) == 3 ) $cols = 3;
	if ( sizeof($atts['items']) == 2 ) $cols = 2;
	if ( sizeof($atts['items']) == 1 ) $cols = 1;

	echo '<div class="'.esc_attr($class).'" '.$id.'>';
	echo '	<div class="ltx-slider-fc swiper-container" data-autoplay="'.esc_attr($atts['autoplay']).'" data-arrows="'.esc_attr($atts['arrows']).'" data-cols="'.esc_attr($cols).'">';
	echo '<div class="swiper-wrapper">';


	foreach ( $atts['items'] as $item ) {

		$image = wp_get_attachment_image_src( $item['image'], 'full' );

		$item['header'] = str_replace(array('{{', '}}'), array('<span>', '</span>'), $item['header']);

		echo '<div class="swiper-slide">';
			echo '<a href="'.esc_url($item['href']).'" class="inner" style="background-image: url('.$image[0].');">';

				echo '<div class="info">';
					echo '<div class="head"><h4>'.wp_kses_post($item['header']).'</h4>';
					echo '<span class="fa fa-arrow-right"></span></div>';
					echo '<p>'.esc_html($item['descr']).'</p>';
				echo '</div>';
			echo '</a>';
		echo '</div>';

	}

	echo '		</div>';
	if ( !empty($atts['arrows']) ) echo '<div class="swiper-arrows"><a href="#" class="arrow-left fa fa-arrow-left"></a><a href="#" class="arrow-right  fa fa-arrow-right"></a></div>';
	echo '	</div>';		
	echo '</div>';	
}


