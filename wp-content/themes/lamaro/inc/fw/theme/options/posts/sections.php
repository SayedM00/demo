<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'theme_block' => array(
		'title'   => esc_html__( 'Theme Block', 'lamaro' ),
		'label'   => esc_html__( 'Theme Block', 'lamaro' ),
		'type'    => 'select',
		'choices' => array(
			'none'  => esc_html__( 'Not Assigned', 'lamaro' ),
			'before_footer'  => esc_html__( 'Before Footer', 'lamaro' ),
			'subscribe'  => esc_html__( 'Subscribe', 'lamaro' ),
			'top_bar'  => esc_html__( 'Top Bar', 'lamaro' ),
		),
		'value' => 'none',
	)
);


