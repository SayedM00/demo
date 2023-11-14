<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Gallery Shortcode
 */

$args = get_query_var('like_sc_gallery');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$list = fw_get_db_post_option( $args['cat'], 'photos' );

if ( !empty($list) ) {

	echo '<div class="gallery-sc '.esc_attr($class).'">';

	echo '<div class="items">';
		echo '<div class="row centered">';
	$item_class = '';

	if ( !empty($args['limit']) ) {

		$list = array_slice( $list, 0, $args['limit'] );
	}

?>
	<?php foreach ( $list as $item ) : ?>
	<div class="col-lg-5ths col-md-5ths col-sm-5ths col-ms-4 col-xs-6">
		<div class="item">
			<a href="<?php echo esc_url( $item['url'] ); ?>" class="swipebox photo">
				<?php echo wp_get_attachment_image( $item['attachment_id'], 'lamaro-gallery' ); ?><span class="fa fa-search"></span>
			</a>
		</div>
	</div>
	<?php endforeach; ?>

<?php

	echo '</div></div></div>';
}

