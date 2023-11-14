<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

$lamaro_sidebar_hidden = false;
$lamaro_layout = 'classic';
$blog_class = '';

if ( function_exists('FW') ) {

	$blog_class = 'masonry';
	$lamaro_layout = fw_get_db_settings_option( 'blog_layout' );
}

if ( !lamaro_check_active_sidebar() ) {

	$lamaro_sidebar_hidden = true;	
}

get_header(); ?>
<div class="inner-page margin-default">
	<div class="row <?php if ( !lamaro_check_active_sidebar() ): ?>centered<?php else: ?>with-sidebar<?php endif; ?>">
        <div class="col-xl-9 col-lg-8 col-md-12 ltx-blog-wrap">
            <div class="blog blog-block layout-<?php echo esc_attr($lamaro_layout); ?>">
				<?php

				if ( $wp_query->have_posts() ) :

	            	echo '<div class="row '.esc_attr($blog_class).'">';
					while ( $wp_query->have_posts() ) : the_post();

						// Showing classic blog without framework
						if ( !function_exists( 'FW' ) ) {

							get_template_part( 'tmpl/content-post-one-col' );
						}
							else {

							set_query_var( 'lamaro_layout', $lamaro_layout );

							if ($lamaro_layout == 'three-cols') {

								get_template_part( 'tmpl/content-post-three-cols' );
							}
								else
							if ($lamaro_layout == 'two-cols') {

								get_template_part( 'tmpl/content-post-two-cols' );
							}
								else {

								get_template_part( 'tmpl/content-post-one-col' );
							}
						}

					endwhile;
					echo '</div>';
				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'tmpl/content', 'none' );

				endif;

				?>
				<?php
				if ( have_posts() ) {

					lamaro_paging_nav();
				}
	            ?>
	        </div>
	    </div>
	    <?php
	    if ( !$lamaro_sidebar_hidden ) {

            	get_sidebar();
	    }
	    ?>
	</div>
</div>
<?php

get_footer();

