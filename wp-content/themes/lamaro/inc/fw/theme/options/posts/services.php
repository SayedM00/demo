<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'cut'    => array(
				'label' => esc_html__( 'Short Description', 'lamaro' ),
				'type'  => 'textarea',
			),							
			'period'    => array(
				'label' => esc_html__( 'Term', 'lamaro' ),
				'type'  => 'text',
			),	
			'price'    => array(
				'label' => esc_html__( 'Price', 'lamaro' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'lamaro' ),
				'type'  => 'text',
			),					
			'link'    => array(
				'label' => esc_html__( 'External Link', 'lamaro' ),
				'type'  => 'text',
			),			
		),
	),
);

