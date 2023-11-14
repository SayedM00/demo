<?php
/**
 * The default template for displaying inline posts
 */

?>
<article id="post-<?php the_ID(); ?>">
	<?php 
		if ( has_post_thumbnail() ) {

			$lamaro_photo_class = 'photo';
        	$lamaro_layout = get_query_var( 'lamaro_layout' );

			$lamaro_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'full' );

			if ($lamaro_image_src[2] > $lamaro_image_src[1]) $lamaro_photo_class .= ' vertical';
			
		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($lamaro_photo_class).'">';

	    		the_post_thumbnail();

		    echo '</a>';
		}
	?>
    <div class="description">
   		<?php

   			lamaro_get_the_cats_archive();
   			
   		?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
        <?php if ( !has_post_thumbnail() ): ?>
        <div class="text text-page">
			<?php
				add_filter( 'the_content', 'lamaro_excerpt' );
			    if( strpos( $post->post_content, '<!--more-->' ) ) {

			        the_content( esc_html__( 'Read more', 'lamaro' ) );
			    }
			    	else  {

			    	the_excerpt();
			    }	
			?>
        </div>            
    	<?php endif; ?>
    	<div class="blog-info">
    	<?php
			lamaro_the_post_info();
    	?>
    	</div>
    </div>  
</article>