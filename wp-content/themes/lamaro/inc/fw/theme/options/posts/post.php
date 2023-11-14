<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'main' => array(
		'title'   => 'LTX Post Format',
		'type'    => 'box',
		'options' => array(
			'featured'    => array(
				'label' => esc_html__( 'Featured Post', 'lamaro' ),
				'type'  => 'checkbox',
			),			
			'gallery'    => array(
				'label' => esc_html__( 'Gallery', 'lamaro' ),
				'desc' => esc_html__( 'Upload featured images for slider gallery post type', 'lamaro' ),
				'type'  => 'multi-upload',
			),				
		),
	),
);

