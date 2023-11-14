<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Products Shortcode
 */

$args = get_query_var('like_sc_products_categories');

$query_args = array(
     'taxonomy'     => 'product_cat',
     'orderby'      => 'name',
     'show_count'   => 0,
     'pad_counts'   => 0,
     'hierarchical' => 1,
     'title_li'     => '',
     'hide_empty'   => 0
);

if ( !empty($args['ids']) ) {

	$query_args['include'] = esc_attr($args['ids']);
}

if ( !empty($args['orderby']) ) {

	$query_args['orderby'] = $args['orderby'];
}		

if ( !empty($args['limit'])) {

	$query_args['number'] = $args['limit'];
}

$cats = array();
$list = get_categories( $query_args );

foreach ($list as $cat) {

	if (esc_html($cat->name) == 'Uncategorized' OR empty($cat->name) ) continue;

	$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
    if ( !empty($thumbnail_id) ) {

    	$image = wp_get_attachment_url( $thumbnail_id );
    }
    	else {

    	$image = null;
    }

	if ($cat->category_parent == 0) {

	    $cats[$cat->term_id]['href'] = get_term_link($cat->slug, 'product_cat');
	    $cats[$cat->term_id]['name'] = $cat->name;
	    $cats[$cat->term_id]['description'] = $cat->description;
	    $cats[$cat->term_id]['image'] = $image;

	}
		else {

	    $cats[$cat->category_parent]['child'][$cat->term_id] = array(

	    	'href' => get_term_link($cat->slug, 'product_cat'),
	    	'name' => $cat->name,
	    	'image' => $image,
	    );		    
	}
}	

$cols = '';
if ( $args['columns'] == 1) {

	$cols = 'col-xs-12';
}
	else
if ( $args['columns'] == 2) {

	$cols = 'col-lg-6 col-md-6 col-sm-6 col-ms-12 col-xs-12';
}
	else
if ( $args['columns'] == 3) {

	$cols = 'col-lg-4 col-md-4 col-sm-6 col-ms-12 col-xs-12';
}
	else
if ( $args['columns'] == 4) {

	$cols = 'col-lg-3 col-md-6 col-sm-6 col-ms-12 col-xs-12';
}

if ( !empty($cats) ) {

	echo '<div class="ltx-products-cats-sc row centered">';	

	foreach ( $cats as $item ) {

		echo '<div class="'.esc_attr($cols).'">';
		echo '<a href="'.esc_url($item['href']).'" data-mh="ltx-woo-cats">';
			
			if ( !empty($item['image']) ) {

				echo '<span class="image"><img src="'.esc_url($item['image']).'" alt="'.esc_attr($item['name']).'"></span>';
			}
			echo '<h4 class="header">'.esc_html($item['name']).'</h4>';
			echo '<p>'.esc_html($item['description']).'</p>';

			if ( !empty( $args['more_text'] ) ) {

				echo '<span class="btn btn-xs">'.esc_html($args['more_text']).'</span>';
			}
		echo '</a>';
		echo '</div>';		
	} 

	echo '</div>';
}


