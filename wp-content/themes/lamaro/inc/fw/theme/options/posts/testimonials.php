<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'subheader'    => array(
				'label' => esc_html__( 'Subheader', 'lamaro' ),
				'type'  => 'text',
			),
			'rate'    => array(
				'type'    => 'select',
				'label' => esc_html__( 'Rate', 'lamaro' ),				
				'description'   => esc_html__( 'Null for hidden', 'lamaro' ),
				'choices' => array(
					0,1,2,3,4,5
				),
			),						
		),
	),		
);

unset($options['main']['options']['subheader']);

