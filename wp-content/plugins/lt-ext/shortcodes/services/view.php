<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Services Shortcode
 */

$args = get_query_var('like_sc_services');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$class .= ' layout-'.$args['layout'].' ltx-style-'.$args['style'];

$query_args = array(
	'post_type' => 'services',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);

if ( !empty($args['ids']) ) $query_args['post__in'] = explode(',', esc_attr($args['ids']));
	else
if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'services-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['cat'])),
		)
    );
}


$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	if ( $args['layout'] == 'slider' ) {

		echo '<div class="services-sc '.esc_attr($class).'" '.$id.'>';
			echo '<div class="swiper-container services-slider" data-autoplay="0" data-cols="3">
				<div class="swiper-wrapper">';
	}
		else {

		echo '<div class="services-sc '.esc_attr($class).' row centered" '.$id.'>';
	}

	$x = $iteration = 0;
	while ( $query->have_posts() ):

		$query->the_post();
		$x++;

		$header = fw_get_db_post_option(get_The_ID(), 'header');
		$cut = fw_get_db_post_option(get_The_ID(), 'cut');
		$link = fw_get_db_post_option(get_The_ID(), 'link');
		$icon = fw_get_db_post_option(get_The_ID(), 'icon-v2');
		$price = fw_get_db_post_option(get_The_ID(), 'price');
		$term = fw_get_db_post_option(get_The_ID(), 'period');
		$vip = fw_get_db_post_option(get_The_ID(), 'popular');
		$class = 'ltx-service ltx-service-'.get_The_ID();

		if ( !empty( $price) )  {

			$price = str_replace(array('{{', '}}'), array('<span>', '</span>'), $price);
		}

		if ( empty($link) ) {

			$link = get_the_permalink();
		}

		$header = fw_get_db_post_option(get_The_ID(), 'header');
		if ( !empty( $header) )  {

			$header = str_replace(array('{{', '}}'), array('<span>', '</span>'), $header);
		}
			else {

			$header = get_the_title();
		}

		if ( $args['layout'] == 'photos' ) {

			?>
			<div class="col-lg-6 col-md-12 col-sm-12 col-ms-12">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			        <a href="<?php echo esc_url( $link ); ?>" class="image">
			        	<span>
				        <?php
				       		echo wp_get_attachment_image( get_post_thumbnail_id( get_The_ID()) , 'lamaro-service-square');
				        ?>  	
			        	</span>		   
				    </a>
				    <div class="descr">
					    <a href="<?php echo esc_url( $link ); ?>">
				        	<h4 class="header">
				        		<?php echo wp_kses_post($header); ?>				        	
				        	</h4>
				        </a>
						<?php
							if ( !empty($term) ) {

								echo '<span class="term">'.esc_html($term).'</span>';
							}

							if ( !empty($cut) ) {

								echo '<p>'.wp_kses_post($cut).'</p>';
							}	

							if ( !empty($price) ) {

								echo '<span class="price">'.wp_kses_post($price).'</span>';
							}

							if ( !empty($args['more_text']) ) {

								echo '<a href="'.esc_url( $link ).'" class="btn btn-xs">'.esc_html($args['more_text']).'</a>';
							}														
						?>				        	
				    </div>
				</article>
			</div>
			<?php
		}


		if ( $args['layout'] == 'slider' ) {

			?>
			<div class="swiper-slide" >
				<article data-mh="ltx-service" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			        <a href="<?php echo esc_url( $link ); ?>">
			        	<span class="image">
				        <?php
				       		echo wp_get_attachment_image( get_post_thumbnail_id( get_The_ID()) , 'lamaro-service');
				        ?>  
				        </span>
			        </a>				        			   
			        <a href="<?php echo esc_url( $link ); ?>">
			        	<h4 class="header">
			        		<?php echo wp_kses_post($header); ?>				        	
			        	</h4>
			        </a>				        			   
					<?php
						if ( !empty($cut) ) {

							echo '<p>'.wp_kses_post($cut).'</p>';
						}							

						if ( !empty($args['more_text']) ) {

							echo '<a href="'.esc_url( $link ).'" class="btn btn-xs">'.esc_html($args['more_text']).'</a>';
						}							
					?>				        	
				</article>
			</div>
			<?php
		}


	endwhile;

	if ( $args['layout'] == 'slider' ) {

		echo '</div>';
		echo '<div class="arrows">
				<a href="#" class="arrow-left fa fa-chevron-left"></a>
				<a href="#" class="arrow-right fa fa-chevron-right"></a>
			</div>';		
		echo '</div>';
	}
		else
	if ( $args['layout'] == 'list' ) {

		echo '</div>';
	}

	wp_reset_postdata();

	echo '</div>';
}

