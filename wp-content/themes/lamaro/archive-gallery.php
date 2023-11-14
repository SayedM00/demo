<?php
/**
 * Gallery page
 */

// Getting gallery layout
if ( function_exists( 'fw_get_db_settings_option' ) ) {

	$lamaro_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'gallery-layout' );
	if ( empty($lamaro_layout) ) $lamaro_layout = fw_get_db_settings_option( 'gallery_layout' );
}
?>
<?php get_header(); ?>

<div class="gallery-page inner-page margin-default gallery-<?php echo esc_attr( $lamaro_layout ); ?>">
	<div class="row ">

		<?php
			if ( get_query_var( 'paged' ) ) {

				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {

				$paged = get_query_var( 'page' );
			} else {

				$paged = 1;
			}

			$wp_query = new WP_Query( array(
				'post_type' => 'gallery',
				'paged' => (int) $paged,
			) );

			
			if ( ! empty($lamaro_layout) && $lamaro_layout == 'col-3' ) {

				$lamaro_grid = 3;
			}
				elseif ( ! empty($lamaro_layout) && $lamaro_layout == 'col-4' ) {

				$lamaro_grid = 4;
			}
				else {

				$lamaro_grid = 2;
			}

			if ( $wp_query->have_posts() ) :
				while ( $wp_query->have_posts() ) : $wp_query->the_post();

					lamaro_get_template_part( 'tmpl/content', 'ltx-gallery', array(
						'grid' => $lamaro_grid,
					) );

				endwhile;
			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'tmpl/content', 'none' );

			endif;
		?>  
	</div>
	<?php
	if ( have_posts() ) {

		lamaro_paging_nav();
	}
	?>        
</div>            
<?php get_footer(); ?>
