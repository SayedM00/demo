<?php
/**
 * Gallery post format
 */

$post_class = '';
if ( function_exists( 'FW' ) ) {

	$gallery_files = fw_get_db_post_option(get_The_ID(), 'gallery');
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<?php
		if ( !empty( $gallery_files ) ) {

			$autoplay = fw_get_db_settings_option( 'blog_gallery_autoplay' );

			echo '
			<div class="swiper-container ltx-post-gallery" data-autoplay="'.esc_attr($autoplay).'">
				<div class="swiper-wrapper">';

			foreach ( $gallery_files as $item ) {

				echo '<a href="'.esc_url(get_the_permalink()).'" class="swiper-slide">';
					echo wp_get_attachment_image( $item['attachment_id'], 'lamaro-blog-full' );
				echo '</a>';
			}

			echo '</div>
				<div class="arrows">
					<a href="#" class="arrow-left fa fa-arrow-left"></a>
					<a href="#" class="arrow-right fa fa-arrow-right"></a>
				</div>
				<div class="swiper-pages"></div>
			</div>';
		}
			else
		if ( has_post_thumbnail() ) {

			$lamaro_photo_class = 'photo';

		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($lamaro_photo_class).'">';

		    the_post_thumbnail();

		    echo '</a>';
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
