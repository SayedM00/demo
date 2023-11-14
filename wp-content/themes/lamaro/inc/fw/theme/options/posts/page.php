<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$lamaro_choices =  array();
$lamaro_choices['default'] = esc_html__( 'Default', 'lamaro' );

$lamaro_color_schemes = fw_get_db_settings_option( 'items' );
if ( !empty($lamaro_color_schemes) ) {

	foreach ($lamaro_color_schemes as $v) {

		$lamaro_choices[$v['slug']] = esc_html( $v['name'] );
	}
}

$lamaro_theme_config = lamaro_theme_config();
$lamaro_sections_list = lamaro_get_sections();


$options = array(
	'general' => array(
		'title'   => esc_html__( 'Page settings', 'lamaro' ),
		'type'    => 'box',
		'options' => array(		
			'general-box' => array(
				'title'   => __( 'General Settings', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(

					'margin-layout'    => array(
						'label' => esc_html__( 'Content Margin', 'lamaro' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Margins control for content', 'lamaro' ),
						'choices' => array(
							'default'  => esc_html__( 'Top And Bottom', 'lamaro' ),
							'top'  => esc_html__( 'Top Only', 'lamaro' ),
							'bottom'  => esc_html__( 'Bottom Only', 'lamaro' ),
							'disabled' => esc_html__( 'Margin Removed', 'lamaro' ),
						),
						'value' => 'default',
					),			
					'topbar-layout'    => array(
						'label' => esc_html__( 'Topbar section', 'lamaro' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array('default' => 'Default') + array('hidden' => 'Hidden') + $lamaro_sections_list['top_bar'],						
						'value'	=> 'default',
					),						
					'navbar-layout'    => array(
						'label' => esc_html__( 'Navbar', 'lamaro' ),
						'type'    => 'select',
						'choices' => $lamaro_theme_config['navbar'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'lamaro' ) ),
						'value' => $lamaro_theme_config['navbar-default'],
					),								
					'header-layout'    => array(
						'label' => esc_html__( 'Page Header', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'lamaro' ),
							'disabled' => esc_html__( 'Hidden', 'lamaro' ),
						),
						'value' => 'default',
					),	
					'before-footer-layout'    => array(
						'label' => esc_html__( 'Before Footer', 'lamaro' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array('default' => 'Default') + array('' => 'Hidden') + $lamaro_sections_list['before_footer'],						
						'value'	=> 'default',
					),						
					'subscribe-layout'    => array(
						'label' => esc_html__( 'Subscribe Block', 'lamaro' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Subscribe block before footer. Can be edited from Sections Menu.', 'lamaro' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'lamaro' ),
							'disabled' => esc_html__( 'Hidden', 'lamaro' ),
						),
						'value' => 'default',
					),					
					'footer-layout'    => array(
						'label' => esc_html__( 'Footer', 'lamaro' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before footer. Edited in Widgets menu.', 'lamaro' ),
						'choices' => $lamaro_theme_config['footer'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'lamaro' ) ),
						'value' => $lamaro_theme_config['footer-default'],
					),														
					'color-scheme'    => array(
						'label' => esc_html__( 'Color Scheme', 'lamaro' ),
						'type'    => 'select',
						'choices' => $lamaro_choices,
						'value' => 'default',
					),								
				),											
			),	
			'cpt' => array(
				'title'   => esc_html__( 'Blog / Gallery', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(				
					'sidebar-layout'    => array(
						'label' => esc_html__( 'Blog Sidebar', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'hidden' => esc_html__( 'Hidden', 'lamaro' ),
							'left'  => esc_html__( 'Sidebar Left', 'lamaro' ),
							'right'  => esc_html__( 'Sidebar Right', 'lamaro' ),
						),
						'value' => 'hidden',
					),						
					'blog-layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'lamaro' ),
						'description'   => esc_html__( 'Used only for blog pages.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'lamaro' ),
							'classic'  => esc_html__( 'One Column', 'lamaro' ),
							'two-cols' => esc_html__( 'Two Columns', 'lamaro' ),
							'three-cols' => esc_html__( 'Three Columns', 'lamaro' ),
						),
						'value' => 'default',
					),
					'gallery-layout'    => array(
						'label' => esc_html__( 'Gallery Layout', 'lamaro' ),
						'description'   => esc_html__( 'Used only for gallery pages.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'lamaro' ),
							'col-2' => esc_html__( 'Two Columns', 'lamaro' ),
							'col-3' => esc_html__( 'Three Columns', 'lamaro' ),
							'col-4' => esc_html__( 'Four Columns', 'lamaro' ),
						),
						'value' => 'default',
					),					
				)
			)	
		)
	),
);

unset($options['general']['options']['general-box']['options']['topbar-layout']);
unset($options['general']['options']['general-box']['options']['before-footer-layout']);
unset($options['general']['options']['general-box']['options']['color-scheme']);

