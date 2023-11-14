<?php
/**
 * Audio Post Format
 */

$post_class = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<div class="ltx-wrapper">
		<?php

		if ( has_post_thumbnail() ) {

			$lamaro_photo_class = 'photo';

		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($lamaro_photo_class).'">';

			    the_post_thumbnail();

		    echo '</a>';
		}

		$mp3 = lamaro_find_http(get_the_content());

		echo wp_audio_shortcode(
			array('src'	=>	esc_url($mp3))
		);

		$headline = 'inline';

		?>
	</div>
    <div class="description">  
 
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
    	<div class="blog-info">
    	<?php

    	echo '<div class="blog-info blog-info-post-top"><ul>';
    		lamaro_the_blog_date(array('wrap' => 'li', 'cat_show' => true));
    	echo '</ul></div>';

    	?>   
    	</div>
    </div>   	
</article>