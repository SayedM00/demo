<?php
/**
 * The default template for displaying standard post format
 */

$post_class = '';
$featured = get_query_var( 'lamaro_featured_disabled' );
if ( function_exists( 'FW' ) AND empty ( $featured ) ) {

	$featured_post = fw_get_db_post_option(get_The_ID(), 'featured');
	if ( !empty($featured_post) ) {

		$post_class = 'ltx-featured-post-none';
	}
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<?php 

		if ( has_post_thumbnail() ) {

			$lamaro_photo_class = 'photo';
        	$lamaro_layout = get_query_var( 'lamaro_layout' );

			$lamaro_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'full' );

			if ($lamaro_image_src[2] > $lamaro_image_src[1]) $lamaro_photo_class .= ' vertical';
			
		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($lamaro_photo_class).'">';

	    	if ( empty($lamaro_layout) OR $lamaro_layout == 'classic'  ) {

	    		the_post_thumbnail();
	    	}
	    		else
	    	if ( $lamaro_layout == 'two-cols'  ) {	    	

	    		the_post_thumbnail();
	    	}
	    		else {


				$sizes_hooks = array( 'lamaro-blog', 'lamaro-blog-full' );
				$sizes_media = array( '1199px' => 'lamaro-blog' );

				lamaro_the_img_srcset( get_post_thumbnail_id(), $sizes_hooks, $sizes_media );
    		}

		    echo '</a>';
		}


	?>
    <div class="description">
    	<?php

    	echo '<div class="blog-info blog-info-post-top"><ul>';
    		lamaro_the_blog_date(array('wrap' => 'li', 'cat_show' => true));
    	echo '</ul></div>';

    	?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
        <?php
			$lamaro_display_excerpt = get_query_var( 'ltx_display_excerpt' );

        	if ( !function_exists('FW') AND !has_post_thumbnail() )  {

        		$lamaro_display_excerpt = true;
        	}

        	if ( (!has_post_thumbnail() OR empty($lamaro_layout)) OR !empty( $lamaro_display_excerpt ) ):

        		if ( !empty( $lamaro_display_excerpt ) AND $lamaro_display_excerpt == 'visible' ):
        ?>
        <div class="text text-page">
			<?php
				add_filter( 'the_content', 'lamaro_excerpt' );
			    if( strpos( $post->post_content, '<!--more-->' ) ) {

			        the_content( esc_html__( 'Read more', 'lamaro' ) );
			    }
			    	else  {

			    	the_excerpt();
			    }	
			    remove_filter( 'the_content', 'lamaro_excerpt' );
			?>
        </div>            
    	<?php 
    			endif;
    		endif;
    	?>
    	<div class="blog-info">
    	<?php
			lamaro_the_post_info();
    	?>
    	</div>
    </div>    
</article>