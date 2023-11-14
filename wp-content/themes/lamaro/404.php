<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header();

	$page = get_posts( array(
		'name' => '404-layout',
		'post_type' => 'page',
	) );

	if ( $page ) {
		
		echo do_shortcode( $page[0]->post_content );
	}
		else {
		?>
		<section class="page-404 page-404-default">
			<div class="container">
				<div class="center">				
					<h2><?php echo esc_html__( '404', 'lamaro' ) ?></h2>
					<div class="heading  heading-large header-inline align-center color-main subcolor-second transform-default heading-tag-h3">
						<h3><?php echo esc_html__( 'Oops! Page Not Found', 'lamaro' ) ?></h3>
					</div>
					<p class="center-404">
						<?php echo esc_html__( 'The page you are looking for was moved, removed, renamed or might never existed.', 'lamaro' ); ?></strong>
					</p>
					<div class="ltx-empty-space"></div>
					<a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="btn  btn-xs btn-default color-hover-default align-center"><?php echo esc_html__( 'Home Page', 'lamaro' ) ?></a>
				</div>
			</div>
		</section>				
		<?php
	}

get_footer();

