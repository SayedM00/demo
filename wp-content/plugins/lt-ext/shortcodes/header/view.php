<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * HR Shortcode
 */

$args = get_query_var('like_sc_header');

$style = array();

if ( !empty($args['google_fonts']) AND empty($args['use_theme_fonts'])) {

	$google_fonts = explode('|', $args['google_fonts']);

	$google_fonts_family = explode( ':', $google_fonts[0] );
	$google_fonts_family = explode( '%3A', $google_fonts_family[1] );

	$google_fonts_family_weight = explode( ':', $google_fonts[1] );
	$google_fonts_family_style = explode( '%3A', $google_fonts_family_weight[1] );
	$google_fonts_family_weight = explode( '%20', $google_fonts_family_weight[1] );

	$google_fonts_family = $google_fonts_family[0];
	$subsets = $google_fonts_family_weight[0];

	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_family ), '//fonts.googleapis.com/css?family=' . $google_fonts_family .':' . $subsets );

	$style[] = 'font-family: '.esc_attr(str_replace('%20',' ', $google_fonts_family)).' !important';
	$style[] = 'font-weight: '.esc_attr($subsets);
	$style[] = 'font-style: '.esc_attr($google_fonts_family_style[2]);
}

if ( !empty($args['size_px'])) $style[] = 'font-size: '.esc_attr($args['size_px']).' !important';

$class = '';

if ( !empty($args['size_px_mobile'])) {

	$class_custom = 'ltx-header-mobile ltx-header-'.esc_attr($args['size_px_mobile']);
	wp_add_inline_style( 'lamaro-theme-style', '.'.$class_custom.' { @media (max-width: 768px) { font-size: '.esc_attr($args['size_px_mobile']).' !important } } ' );

	$class .= ' '.$class_custom;
}
	
if ( !empty($style)) $style = ' style="'.implode(';', $style).'" '; else $style = '';

if ( !empty($args['size']) AND $args['size'] != 'default' ) $class .= ' heading-'.$args['size'];
if ( !empty($args['style']) ) $class .= ' '.$args['style'];
if ( !empty($args['align']) AND $args['align'] != 'default' ) $class .= ' align-'.$args['align'];
if ( !empty($args['color']) AND $args['color'] != 'default' ) $class .= ' color-'.$args['color']; else $class .= ' color-black';
if ( !empty($args['subcolor']) AND $args['subcolor'] != 'default' ) $class .= ' subcolor-'.$args['subcolor'];
if ( !empty($args['bgheader']) ) $class .= ' text-bg';
if ( !empty($args['transform']) ) $class .= ' transform-'.$args['transform'];
if ( !empty($args['bg_image'] ) ) $class .= ' bg-image';
if ( !empty($args['shadow'] ) AND $args['shadow'] === 'true' ) $class .= ' shadow';

if ( !empty($args['subheader'] ) ) $class .= ' has-subheader';

if ( $args['style'] == 'theme-icon' ) {

	$class .= ' ltx-theme-header';
}

if ( $args['style'] == 'header-subheader') {

	$class .= ' theme-icon-second';
}

if ( !empty($args['icon']) ) {


	$class .= ' heading-icon-fa ';
}

if ( !empty( $args['icon_type'] ) ) $class .= ' icon-type-'.$args['icon_type'];

if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

if ( !empty($args['type']) ) $tag = $args['type']; else $tag = 'h2';
if ( !empty($args['subtype']) ) $subtag = $args['subtype'];

$class .= ' heading-tag-'. $tag;

if ( !empty($args['image']) AND $args['icon_type'] != 'bg' ) $class .= ' heading-icon';

if ( empty($subtag) ) {

	$subtag = 'h5';
}

echo '<div class="heading '. esc_attr( $class ) .'"'. $id . $style .'>';

if ( !empty($args['href']) ) {

	echo '<a href="'.esc_url($args['href']).'">';
}

if ( !empty($args['icon']) ) {

	echo '<span class="heading-icon-fa-wrap bg-'.esc_attr($args['icon_bg']).' '.esc_attr($args['icon']).' "></span><div class="heading-content">';
}

if ( !empty($args['subheader']) ) {

	$subtag = 'h4';
	$subclass_add = '';

	if ( $args['sr'] == 'default' ) $subclass_add = 'ltx-sr-id-'.$args['id'].mt_rand().' ltx-sr ltx-sr-effect-fade_in ltx-sr-el-block ltx-sr-delay-100 ltx-sr-duration-300 ltx-sr-sequences-50';

	echo '<'. esc_attr($subtag) .' class="subheader '.esc_attr($subclass_add).'">'. wp_kses_post( trim( $args['subheader'] ) ) .'</'. esc_attr($subtag) .'>';
}


if ( !empty($args['image']) AND $args['icon_type'] != 'bg' ) {

	$image = ltx_get_attachment_img_url( $args['image'] );
	$image_class = '';
	if ( $args['icon_bg'] != 'transparent' ) {

		$image_class .= ' icon-'.$args['icon_bg'];

		echo '<span class="heading-icon-wrap '.esc_attr($image_class).'"><img src="' . $image[0] . '" class="heading-icon" alt="'.esc_attr($args['header']).'"></span><div class="heading-content">';
	}
		else {
		
		echo '<img src="' . $image[0] . '" class="heading-icon '.esc_attr($image_class).'" alt="'.esc_attr($args['header']).'"><div class="heading-content">';

	}

}

if (!empty($args['header'])) {

	$header_class_add = '';
	if ( $args['sr'] == 'default' ) {

		$header_class_add = 'ltx-sr-id-'.$args['id'].mt_rand().' ltx-sr ltx-sr-effect-fade_in ltx-sr-el-block ltx-sr-delay-0 ltx-sr-duration-1000 ltx-sr-sequences-0';
	}

	echo '<'. esc_attr($tag) .$style.' class="header '.esc_attr($header_class_add).'">';

		echo wp_kses_post( $args['header'] );

		if ( $args['style'] == 'inline' OR $subtag == 'span'  ) {

			if ( $subtag == 'span') $subclass = " sub-nl"; else $subclass = '';
			echo ' <span class="subheader'.esc_attr($subclass).'">'. wp_kses_post( trim( $args['subheader'] ) ) .'</span>';
		}

	echo '</'. esc_attr($tag) .'>';
}
/*
if ( !empty($args['subheader']) AND $args['style'] != 'inline' AND $args['style'] != 'head-subheader' AND $subtag != 'span' ) {

	echo '<'. esc_attr($subtag) .' class="subheader">'. wp_kses_post( trim( $args['subheader'] ) ) .'</'. esc_attr($subtag) .'>';
}
*/
if (( !empty($args['image']) AND $args['icon_type'] != 'bg' )  OR !empty($args['icon']) ) {

	echo '</div>';
}

if ( !empty($args['image']) AND $args['icon_type'] == 'after' ) {

	$image = ltx_get_attachment_img_url( $args['image'] ); 

	echo '<img src="' . $image[0] . '" class="heading-image-after" alt="'.esc_attr($args['header']).'">';
}
	else
if ( !empty($args['image']) AND $args['icon_type'] == 'bg' ) {

	$image = ltx_get_attachment_img_url( $args['image'] ); 

	echo '<img src="' . $image[0] . '" class="heading-image-bg" alt="'.esc_attr($args['header']).'">';
}
	else		
if ( !empty($args['icon_fontawesome']) AND $args['icon_type'] == 'bg'  ) {

	echo '<span class="icon-'. esc_attr( $args['icon_type'] ).' '. esc_attr($args['icon_fontawesome']) .'"></span>';
}

if (!empty($args['bgheader'])) {

	echo '<p class="header-text">'. esc_html( $args['bgheader'] ) .'</p>';
}

if ( !empty($args['href']) ) {

	echo '</a>';
}

echo '</div>';

