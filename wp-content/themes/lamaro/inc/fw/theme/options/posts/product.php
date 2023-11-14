<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'image_bg'    => array(
		'label' => esc_html__( 'Background Image', 'lamaro' ),
		'desc' => esc_html__( 'Will replace page header background image', 'lamaro' ),
		'type'  => 'upload',
	),				
);

