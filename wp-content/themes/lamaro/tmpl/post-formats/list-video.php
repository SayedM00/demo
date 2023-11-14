<?php
/**
 * Video Post Format
 */

$post_class = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>	
	<?php
	if ( has_post_thumbnail() ) {

		$lamaro_photo_class = 'photo swipebox';

		echo '<div class="ltx-wrapper">';
		    echo '<a href="'.esc_url(lamaro_find_http(get_the_content())).'" class="'.esc_attr($lamaro_photo_class).'">';

			    the_post_thumbnail();
			    echo '<span></span>';

		    echo '</a>';
		echo '</div>';
	}
		else {

		if ( !empty(wp_oembed_get(lamaro_find_http(get_the_content()))) ) {

			echo '<div class="ltx-wrapper">';
				echo wp_oembed_get(lamaro_find_http(get_the_content()));	
			echo '</div>';
		}
	}

	$headline = 'date';

	?>
    <div class="description">  
    	<?php

    	echo '<div class="blog-info blog-info-post-top"><ul>';
    		lamaro_the_blog_date(array('wrap' => 'li', 'cat_show' => true));
    	echo '</ul></div>';

    	?>    
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
    	<div class="blog-info">
    	<?php
			lamaro_the_post_info( );
    	?>
    	</div>
    </div>  	
</article>