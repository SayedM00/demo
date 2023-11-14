<?php
/**
 * The default template for displaying standard post format
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="description">
    	<?php

    		alavion_get_the_post_headline();
    		
    	?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
        <?php
			$alavion_display_excerpt = true;
			
        	if ( (!has_post_thumbnail() OR empty($alavion_layout)) OR !empty( $alavion_display_excerpt ) ):

        		if ( !empty( $alavion_display_excerpt ) AND $alavion_display_excerpt == 'visible' ):
        ?>
        <div class="text text-page">
			<?php
				add_filter( 'the_content', 'alavion_excerpt' );
			    if( strpos( $post->post_content, '<!--more-->' ) ) {

			        the_content( esc_html__( 'Read more', 'alavion' ) );
			    }
			    	else  {

			    	the_excerpt();			    	
			    }	
				remove_filter( 'the_content', 'alavion_excerpt' );
			?>
        </div>            
    	<?php 
    			else :

	    			echo '<a href="'.esc_url( get_the_permalink() ).'" class="more-link">'.esc_html__( 'Read more', 'alavion' ).'</a>';

    			endif;
   			else:
		    	echo '<a href="'.esc_url( get_the_permalink() ).'" class="more-link">'.esc_html__( 'Read more', 'alavion' ).'</a>';
    		endif;
    	?>
    </div>    
</article>