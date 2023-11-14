<?php
/**
 * The Template for displaying all single blog posts
 */

$lamaro_sidebar_hidden = false;
$lamaro_sidebar = 'right';
$blog_wrap_class = 'col-xl-7 col-xl-offset-1 col-lg-8 col-md-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$lamaro_sidebar = fw_get_db_settings_option( 'blog_post_sidebar' );

	if ( $lamaro_sidebar == 'left' ) {

		$blog_wrap_class = 'col-xl-7 col-xl-push-4 col-lg-8 col-lg-push-4 col-lg-offset-0 col-md-12 col-xs-12';	
	}
		else
	if ( $lamaro_sidebar == 'hidden' ) {

		$blog_wrap_class = 'col-xl-9 col-lg-10 col-md-12 col-xs-12';	
		$lamaro_sidebar_hidden = true;
	}
}

if ( !lamaro_check_active_sidebar() ) {

	$blog_wrap_class = 'col-xl-9 col-lg-8 col-md-12 col-xs-12';	
	$lamaro_sidebar_hidden = true;	
}

get_header(); ?>
<div class="inner-page margin-default">
    <div class="row row-eq-height_ <?php if ( $lamaro_sidebar_hidden ) echo 'centered'; ?>">  
        <div class="<?php echo esc_attr( $blog_wrap_class ); ?>">
            <section class="blog-post">
				<?php
					while ( have_posts() ) : 

						the_post();

						get_template_part( 'tmpl/content-post-full', get_post_format() );

						if ( comments_open() || get_comments_number() ) {

							comments_template();
						}

					endwhile;
				?>                    
            </section>
        </div>
	    <?php
	    if ( !$lamaro_sidebar_hidden ) {

            if ( $lamaro_sidebar == 'left' ) {

            	get_sidebar( 'left' );
            }
            	else  {

            	get_sidebar();
            }
	    }
	    ?>
    </div>
</div>
<?php

get_footer();
