<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$lamaro_theme_config = lamaro_theme_config();
$lamaro_sections_list = lamaro_get_sections();

$navbar_custom_assign = array();

if ( !empty( $lamaro_theme_config['navbar'] ) AND is_array($lamaro_theme_config['navbar']) AND sizeof( $lamaro_theme_config['navbar']) > 1 ) {

	$menus = get_terms('nav_menu');
	if ( !empty($menus) ) {

		$list = array();
		foreach ( $menus as $item ) {

			$list[$item->term_id] = $item->name;
		}

		foreach ( $lamaro_theme_config['navbar'] as $key => $val) {

			$navbar_custom_assign['navbar-'.$key.'-assign'] = array(
				'label' => sprintf( esc_html__( 'Navbar %s Assign', 'lamaro' ), ucwords($key) ),
				'type'    => 'select',
				'desc' => esc_html__( 'You can assign additional menus for inner navbar.', 'lamaro' ),
				'value' => 'default',
				'choices' => array('default' => esc_html__( 'Default', 'lamaro' )) + $list,
			);
		}

		$navbar_custom_assign = array();
	}
}

$options = array(
	'general' => array(
		'title'   => esc_html__( 'General', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => esc_html__( 'General Settings', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(						
					'page-loader'    => array(
						'type'    => 'multi-picker',
						'picker'       => array(
							'loader' => array(
								'label'   => esc_html__( 'Page Loader', 'lamaro' ),
								'type'    => 'select',
								'choices' => array(
									'disabled' => esc_html__( 'Disabled', 'lamaro' ),
									'image' => esc_html__( 'Image', 'lamaro' ),
									'enabled' => esc_html__( 'Theme Loader', 'lamaro' ),
								),
								'value' => 'enabled'
							)
						),						
						'choices' => array(
							'image' => array(
								'loader_img'    => array(
									'label' => esc_html__( 'Page Loader Image', 'lamaro' ),
									'type'  => 'upload',
								),
							),
						),
						'value' => 'enabled',
					),	
					'google_api'    => array(
						'label' => esc_html__( 'Google Maps API Key', 'lamaro' ),
						'desc'  => esc_html__( 'Required for contacts page, also used in widget', 'lamaro' ),
						'type'  => 'text',
					),								
				),
			),
			'logo' => array(
				'title'   => esc_html__( 'Logo and Media', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(	
					'logo-box' => array(
						'title'   => esc_html__( 'Logo', 'lamaro' ),
						'type'    => 'box',
						'options' => array(			
							'favicon'    => array(
								'html' => esc_html__( 'To change Favicon go to Appearance -> Customize -> Site Identity', 'lamaro' ),
								'type'  => 'html',
							),							
							'logo'    => array(
								'label' => esc_html__( 'Logo', 'lamaro' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo 2x', 'lamaro' ),
								'type'  => 'upload',
							),	
							'theme-icon-main'    => array(
								'label' => esc_html__( 'Theme Icon', 'lamaro' ),
								'desc'  => esc_html__( 'Used for headers', 'lamaro' ),
								'type'  => 'upload',
							),
						),
					),
				),
			),				
		),
	),
	'header' => array(
		'title'   => esc_html__( 'Header', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(
			'header-box-2' => array(
				'title'   => esc_html__( 'Navbar', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'navbar-default'    => array(
						'label' => esc_html__( 'Navbar Default', 'lamaro' ),
						'type'    => 'select',
						'value' => $lamaro_theme_config['navbar-default'],
						'choices' => $lamaro_theme_config['navbar'],
					),	
					'navbar-default-force'    => array(
						'label' => esc_html__( 'Navbar Default Override', 'lamaro' ),
						'desc'   => esc_html__( 'By default every page can have unqiue navbar setting. You can override them here.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled. Every page uses its own settings', 'lamaro' ),
							'force'  => esc_html__( 'Enabled. Override all site pages and use Navbar Default', 'lamaro' ),
						),
						'value' => 'disabled',
					),						
					'navbar-affix'    => array(
						'label' => esc_html__( 'Navbar Sticked', 'lamaro' ),
						'desc'   => esc_html__( 'May not work with all navbar types', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'' => esc_html__( 'Allways Static', 'lamaro' ),
							'affix'  => esc_html__( 'Sticked', 'lamaro' ),
						),
						'value' => '',
					),
					'navbar-breakpoint'    => array(
						'label' => esc_html__( 'Navbar Mobile Breakpoint, px', 'lamaro' ),
						'desc'   => esc_html__( 'Mobile menu will be displayed in viewports below this value', 'lamaro' ),
						'type'    => 'text',
						'value' => '992',
					),												
					$navbar_custom_assign,
				)
			),
			'header-box-topbar' => array(
				'title'   => esc_html__( 'Topbar', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'topbar-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'You can edit topbar in sections menu of dashboard', 'lamaro' ),
					),					
					'topbar'    => array(
						'label' => esc_html__( 'Topbar visibility', 'lamaro' ),
						'desc'   => esc_html__( 'You can edit topbar layout in Sections menu', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always Visible', 'lamaro' ),
							'desktop'  => esc_html__( 'Desktop Visible', 'lamaro' ),
							'desktop-tablet'  => esc_html__( 'Desktop and Tablet Visible', 'lamaro' ),
							'mobile'  => esc_html__( 'Mobile only Visible', 'lamaro' ),
							'hidden' => esc_html__( 'Hidden', 'lamaro' ),
						),
						'value' => 'hidden',
					),					
					'topbar-section'    => array(
						'label' => esc_html__( 'Topbar section', 'lamaro' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $lamaro_sections_list['top_bar'],						
						'value'	=> '',
					),						
				)
			),			
			'header-box-icons' => array(
				'title'   => esc_html__( 'Icons and Elements', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(		
					'icons-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'Icons can be displayed in topbar using shortcode: [ltx-navbar-icons]', 'lamaro' ),
					),																
					'navbar-icons' => array(
		                'label' => esc_html__( 'Navbar / Topbar Icons', 'lamaro' ),
		                'desc' => esc_html__( 'Depends on theme style', 'lamaro' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'box-options' => array(
							'type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'picker'       => array(
									'type_radio' => array(
										'label'   => esc_html__( 'Type', 'lamaro' ),
										'type'    => 'radio',
										'choices' => array(
											'search' => esc_html__( 'Search', 'lamaro' ),
											'basket'  => esc_html__( 'WooCommerce Cart', 'lamaro' ),
											'profile'  => esc_html__( 'User Profile', 'lamaro' ),
											'social'  => esc_html__( 'Social Icon', 'lamaro' ),
										),
									)
								),
								'choices'      => array(
									'basket'  => array(
										'count'    => array(
											'label' => esc_html__( 'Count', 'lamaro' ),
											'type'    => 'select',
											'choices' => array(
												'show' => esc_html__( 'Show count label', 'lamaro' ),
												'hide'  => esc_html__( 'Hide count label', 'lamaro' ),
											),
											'value' => 'show',
										),											
									),
									'profile'  => array(
					                    'header' => array(
					                        'label' => esc_html__( 'Non-logged header', 'lamaro' ),
					                        'type' => 'text',
					                        'value' => '',
					                    ),										
									),
									'social'  => array(
					                    'text' => array(
					                        'label' => esc_html__( 'Label', 'lamaro' ),
					                        'type' => 'text',
					                    ),
					                    'href' => array(
					                        'label' => esc_html__( 'External Link', 'lamaro' ),
					                        'type' => 'text',
					                        'value' => '#',
					                    ),											
									),		
								),
								'show_borders' => false,
							),	  														                	
							'icon-type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'value'        => array(
									'icon_radio' => 'default',
								),
								'picker'       => array(
									'icon_radio' => array(
										'label'   => esc_html__( 'Icon', 'lamaro' ),
										'type'    => 'radio',
										'choices' => array(
											'default'  => esc_html__( 'Default', 'lamaro' ),
											'fa' => esc_html__( 'FontAwesome', 'lamaro' )
										),
										'desc'    => esc_html__( 'For social icons you need to use FontAwesome in any case.',
											'lamaro' ),
									)
								),
								'choices'      => array(
									'default'  => array(
									),
									'fa' => array(
										'icon_v2'  => array(
											'type'  => 'icon-v2',
											'label' => esc_html__( 'Select Icon', 'lamaro' ),
										),										
									),
								),
								'show_borders' => false,
							),
							'icon-visible'        => array(
								'label'   => esc_html__( 'Visibility', 'lamaro' ),
								'type'    => 'radio',
								'value'    => 'hidden-mob',								
								'choices' => array(
									'hidden-mob'  => esc_html__( 'Hidden on mobile', 'lamaro' ),
									'visible-mob' => esc_html__( 'Visible on mobile', 'lamaro' )
								),
							),							
							'profile-name'        => array(
								'label'   => esc_html__( 'Profile Name', 'lamaro' ),
								'type'    => 'radio',
								'value'    => 'hidden',								
								'choices' => array(
									'hidden'  => esc_html__( 'Hidden', 'lamaro' ),
									'visible' => esc_html__( 'Visible', 'lamaro' )
								),
							),								
		                ),
                		'template' => '{{- type.type_radio }}',		                
                    ),
					'basket-icon'    => array(
						'label' => esc_html__( 'Basket icon in navbar', 'lamaro' ),
						'desc'   => esc_html__( 'As replacement for basket in topbar in mobile view', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Hidden', 'lamaro' ),
							'mobile'  => esc_html__( 'Visible on Mobile', 'lamaro' ),
						),
						'value' => 'disabled',
					),	
/*					
					'navbar_btn'    => array(
						'label' => esc_html__( 'Navbar Button Header', 'lamaro' ),
						'desc'  => esc_html__( 'Displayed after default white navbar', 'lamaro' ),
						'type'  => 'text',
					),	
					'navbar_btn_href'    => array(
						'label' => esc_html__( 'Navbar Button Href', 'lamaro' ),
						'value'	=> '#',
						'type'  => 'text',
					),					
					'navbar-search'    => array(
						'label' => esc_html__( 'Navbar Search', 'lamaro' ),
						'desc'   => esc_html__( 'Display after navbar with bottom border', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Hidden', 'lamaro' ),
							'visible'  => esc_html__( 'Visible on Desktop', 'lamaro' ),
						),
						'value' => 'disabled',
					),	
*/										
				),
			),
			'header-box-1' => array(
				'title'   => esc_html__( 'Page Header H1', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'pageheader-display'    => array(
						'label' => esc_html__( 'Page Header Visibility', 'lamaro' ),
						'desc'   => esc_html__( 'Status of Page Header with H1 and Breadcrumbs', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'lamaro' ),
							'disabled'  => esc_html__( 'Force Hidden on all Pages', 'lamaro' ),
						),
						'value' => 'fixed',
					),		
					'pageheader-overlay'    => array(
						'label' => esc_html__( 'Page Header Overlay', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'enabled' => esc_html__( 'Enabled', 'lamaro' ),
							'disabled'  => esc_html__( 'Disabled', 'lamaro' ),
						),
						'value' => 'enabled',
					),										
					'header_bg'    => array(
						'label' => esc_html__( 'Inner Header Background', 'lamaro' ),
						'desc'  => esc_html__( 'By default header is gray, you can replace it with background image', 'lamaro' ),
						'type'  => 'upload',
					),  				
					'header_fixed'    => array(
						'label' => esc_html__( 'Background parallax', 'lamaro' ),
						'desc'   => esc_html__( 'Parallax effect requires large images', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'lamaro' ),
							'fixed'  => esc_html__( 'Enabled', 'lamaro' ),
						),
						'value' => 'fixed',
					),
					'header_position'    => array(
						'label' => esc_html__( 'Background images position X Y', 'lamaro' ),
						'desc'   => esc_html__( 'For example "50% 50%"', 'lamaro' ),
						'type'    => 'text',
						'value' => '50% -50%',
					),										        
					'featured_bg'    => array(
						'label' => esc_html__( 'Featured Images as Background', 'lamaro' ),
						'desc'  => esc_html__( 'Use Featured Image for Page as Header Background', 'lamaro' ),
						'type'    => 'select',						
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'lamaro' ),
							'enabled' => esc_html__( 'Enabled', 'lamaro' ),
						),
						'value' => 'disabled',
					),	
					'header_overlay'    => array(
						'label' => esc_html__( 'Inner PageHeader Underline', 'lamaro' ),
						'desc'  => esc_html__( 'Image will be placed over pageheader', 'lamaro' ),
						'type'  => 'upload',
					),
				),
			),
		),
	),	
	'footer' => array(
		'title'   => esc_html__( 'Footer', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(

			'footer-box-1' => array(
				'title'   => esc_html__( 'Widgets', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'footer-layout-default'    => array(
						'label' => esc_html__( 'Footer Default Style', 'lamaro' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before copyright. Edited in Widgets menu.', 'lamaro' ),
						'choices' => $lamaro_theme_config['footer'],
						'value' => $lamaro_theme_config['footer-default'],
					),						
					'footer_widgets'    => array(
						'label' => esc_html__( 'Enable Footer Widgets', 'lamaro' ),
						'desc'   => esc_html__( 'Widgets controled in Appearance -> Widgets. Column will be hidden, then no active widgets exists', 'lamaro' ),	
						'type'  => 'checkbox',
						'value'	=> 'true',
					),					
					'footer_bg'    => array(
						'label' => esc_html__( 'Footer Background', 'lamaro' ),
						'type'  => 'upload',
					),		
					'footer-box-1-1' => array(
						'title'   => esc_html__( 'Desktop widgets visibility', 'lamaro' ),
						'type'    => 'box',
						'options' => array(

							'footer_1_hide'    => array(
								'label' => esc_html__( 'Footer 1', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),						
							),
							'footer_2_hide'    => array(
								'label' => esc_html__( 'Footer 2', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),	
							),
							'footer_3_hide'    => array(
								'label' => esc_html__( 'Footer 3', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),	
							),
							'footer_4_hide'    => array(
								'label' => esc_html__( 'Footer 4', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),	
							),
						)
					),
					'footer-box-1-2' => array(
						'title'   => esc_html__( 'Notebook widgets visibility', 'lamaro' ),
						'type'    => 'box',
						'options' => array(

							'footer_1__hide_md'    => array(
								'label' => esc_html__( 'Footer 1', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),						
							),
							'footer_2_hide_md'    => array(
								'label' => esc_html__( 'Footer 2', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),	
							),
							'footer_3_hide_md'    => array(
								'label' => esc_html__( 'Footer 3', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),	
							),
							'footer_4_hide_md'    => array(
								'label' => esc_html__( 'Footer 4', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),	
							),
						)
					),					
					'footer-box-1-3' => array(
						'title'   => esc_html__( 'Mobile widgets visibility', 'lamaro' ),
						'type'    => 'box',
						'options' => array(
							'footer_1_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 1', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),
							),
							'footer_2_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 2', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),
							),
							'footer_3_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 3', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),
							),
							'footer_4_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 4', 'lamaro' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'lamaro'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'lamaro'),
								),
							),														
						)
					)
				),
			),
			'footer-box-subscribe' => array(
				'title'   => esc_html__( 'Subscribe and Other', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'footer-sections'    => array(
						'html' => esc_html__( 'You can edit all items in Sections menu of dashboard.', 'lamaro' ),
						'type'  => 'html',
					),							
					'subscribe-section'    => array(
						'label' => esc_html__( 'Subscribe block', 'lamaro' ),
						'desc' => esc_html__( 'Section displayed before widgets on every page. You can hide in on certain page in page settings.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $lamaro_sections_list['subscribe'],						
						'value'	=> '',
					),
					'before-footer-section'    => array(
						'label' => esc_html__( 'Before Footer section', 'lamaro' ),
						'desc' => esc_html__( 'Section displayed under all content before subscribe/widgets.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $lamaro_sections_list['before_footer'],
						'value'	=> '',
					),					
				),
			),	
			'footer-box-2' => array(
				'title'   => esc_html__( 'Go Top', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(															
					'go_top_visibility'    => array(
						'label' => esc_html__( 'Go Top Visibility', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always visible', 'lamaro' ),
							'desktop' => esc_html__( 'Desktop Only', 'lamaro' ),
							'mobile' => esc_html__( 'Mobile Only', 'lamaro' ),
							'hidden' => esc_html__( 'Hidden', 'lamaro' ),
						),						
						'value'	=> 'visible',
					),		
					'go_top_pos'    => array(
						'label' => esc_html__( 'Go Top Position', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'floating'  => esc_html__( 'Floating', 'lamaro' ),
							'static' => esc_html__( 'Static at the footer', 'lamaro' ),
						),						
						'value'	=> 'floating',
					),		
					'go_top_img'    => array(
						'label' => esc_html__( 'Go Top Image', 'lamaro' ),
						'type'  => 'upload',
					),		
					'go_top_text'    => array(
						'label' => esc_html__( 'Go Top Text', 'lamaro' ),
						'type'  => 'text',
					),														
				),
			),
			'footer-box-3' => array(
				'title'   => esc_html__( 'Copyrights', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(																							
					'copyrights'    => array(
						'label' => esc_html__( 'Copyrights', 'lamaro' ),
						'type'  => 'wp-editor',
					),									
				),
			),					
		),
	),	
	'layout' => array(
		'title'   => esc_html__( 'Posts Layout', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(

			'layout-box-1' => array(
				'title'   => esc_html__( 'Blog Posts', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(

					'blog_layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'lamaro' ),
						'desc'   => esc_html__( 'Default blog page layout.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'lamaro' ),
							'two-cols' => esc_html__( 'Two Columns', 'lamaro' ),
							'three-cols' => esc_html__( 'Three Columns', 'lamaro' ),
						),
						'value' => 'classic',
					),				
					'blog_list_sidebar'    => array(
						'label' => esc_html__( 'Blog List Sidebar', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'lamaro' ),
							'left' => esc_html__( 'Left', 'lamaro' ),
							'right' => esc_html__( 'Right', 'lamaro' ),
						),
						'value' => 'right',
					),				
					'blog_post_sidebar'    => array(
						'label' => esc_html__( 'Blog Post Sidebar', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'lamaro' ),
							'left' => esc_html__( 'Left', 'lamaro' ),
							'right' => esc_html__( 'Right', 'lamaro' ),
						),
						'value' => 'right',
					),																				
					'excerpt_auto'    => array(
						'label' => esc_html__( 'Excerpt Classic Blog Size', 'lamaro' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'lamaro' ),
						'value'	=> 350,
						'type'  => 'short-text',
					),
					'excerpt_masonry_auto'    => array(
						'label' => esc_html__( 'Excerpt Masonry Blog Size', 'lamaro' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'lamaro' ),
						'value'	=> 150,
						'type'  => 'short-text',
					),
					'blog_gallery_autoplay'    => array(
						'label' => esc_html__( 'Gallery post type autoplay, ms', 'lamaro' ),
						'desc'  => esc_html__( 'Set 0 to disable autoplay', 'lamaro' ),
						'type'  => 'text',
						'value' => '4000',
					),						
				)
			),
			'layout-box-2' => array(
				'title'   => esc_html__( 'Services', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(	
					'services_list_layout'    => array(
						'label' => esc_html__( 'Services List Layout', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'lamaro' ),
							'two-cols' => esc_html__( 'Two Columns', 'lamaro' ),
							'three-cols' => esc_html__( 'Three Columns', 'lamaro' ),
						),
						'value' => 'two-cols',
					),						
					'services_list_sidebar'    => array(
						'label' => esc_html__( 'Services List Sidebar', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'lamaro' ),
							'left' => esc_html__( 'Left', 'lamaro' ),
							'right' => esc_html__( 'Right', 'lamaro' ),
						),
						'value' => 'hidden',
					),				
					'services_post_sidebar'    => array(
						'label' => esc_html__( 'Services Post Sidebar', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'lamaro' ),
							'left' => esc_html__( 'Left', 'lamaro' ),
							'right' => esc_html__( 'Right', 'lamaro' ),
						),
						'value' => 'hidden',
					),					
				)
			),
			'layout-box-3' => array(
				'title'   => esc_html__( 'WooCommerce', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'shop_list_sidebar'    => array(
						'label' => esc_html__( 'WooCommerce List Sidebar', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'lamaro' ),
							'left' => esc_html__( 'Left', 'lamaro' ),
							'right' => esc_html__( 'Right', 'lamaro' ),
						),
						'value' => 'left',
					),				
					'shop_post_sidebar'    => array(
						'label' => esc_html__( 'WooCommerce Product Sidebar', 'lamaro' ),
						'desc'   => esc_html__( 'Blog Post Sidebar', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'lamaro' ),
							'left' => esc_html__( 'Left', 'lamaro' ),
							'right' => esc_html__( 'Right', 'lamaro' ),
						),
						'value' => 'hidden',
					),											
					'excerpt_wc_auto'    => array(
						'label' => esc_html__( 'Excerpt WooCommerce Size', 'lamaro' ),
						'desc'  => esc_html__( 'Automaticly cuts description for products', 'lamaro' ),
						'value'	=> 50,
						'type'  => 'short-text',
					),		
					'wc_zoom'    => array(
						'label' => esc_html__( 'WooCommerce Product Hover Zoom', 'lamaro' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Enables mouse hover zoom in single product page', 'lamaro' ),
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'lamaro' ),
							'enabled' => esc_html__( 'Enabled', 'lamaro' ),
						),
						'value' => 'disabled',
					),
					'wc_columns'    => array(
						'label' => esc_html__( 'Columns number', 'lamaro' ),
						'desc'  => esc_html__( 'Overrides default WooCommerce settings', 'lamaro' ),
						'type'  => 'text',
						'value' => '3',
					),
					'wc_per_page'    => array(
						'label' => esc_html__( 'Products per Page', 'lamaro' ),
						'type'  => 'text',
						'value' => '6',
					),
					'wc_show_list_excerpt'    => array(
						'label' => esc_html__( 'Display Excerpt in Shop List', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'lamaro' ),
							'enabled' => esc_html__( 'Enabled', 'lamaro' ),
						),
						'value' => 'disabled',
					),					
					'wc_show_list_rate'    => array(
						'label' => esc_html__( 'Display Rate in Shop List', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'lamaro' ),
							'enabled' => esc_html__( 'Enabled', 'lamaro' ),
						),
						'value' => 'disabled',
					),
					'wc_show_list_attr'    => array(
						'label' => esc_html__( 'Display Attributes in Shop List', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'lamaro' ),
							'enabled' => esc_html__( 'Enabled', 'lamaro' ),
						),
						'value' => 'enabled',
					),															
				)
			),
			'layout-box-4' => array(
				'title'   => esc_html__( 'Gallery', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(													
					'gallery_layout'    => array(
						'label' => esc_html__( 'Default Gallery Layout', 'lamaro' ),
						'desc'   => esc_html__( 'Default galley page layout.', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'col-2' => esc_html__( 'Two Columns', 'lamaro' ),
							'col-3' => esc_html__( 'Three Columns', 'lamaro' ),
							'col-4' => esc_html__( 'Four Columns', 'lamaro' ),
						),
						'value' => 'col-2',
					),						
				)
			)
		)
	),
	'fonts' => array(
		'title'   => esc_html__( 'Fonts', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(

			'fonts-box' => array(
				'title'   => esc_html__( 'Fonts Settings', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'font-main'                => array(
						'label' => __( 'Main Font', 'lamaro' ),
						'type'  => 'typography-v2',
						'desc'	=>	esc_html__( 'Use https://fonts.google.com/ to find font you need', 'lamaro' ),
						'value'      => array(
							'family'    => $lamaro_theme_config['font_main'],
							'subset'    => 'latin-ext',
							'variation' => $lamaro_theme_config['font_main_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-main-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'lamaro' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "800,900"', 'lamaro' ),
						'type'  => 'text',
						'value'  => $lamaro_theme_config['font_main_weights'],							
					),											
					'font-headers'                => array(
						'label' => __( 'Headers Font', 'lamaro' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $lamaro_theme_config['font_headers'],
							'subset'    => 'latin-ext',
							'variation' => $lamaro_theme_config['font_headers_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-headers-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'lamaro' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'lamaro' ),
						'type'  => 'text',
						'value'  => $lamaro_theme_config['font_headers_weights'],						
					),
					'font-subheaders'                => array(
						'label' => __( 'SubHeaders Font', 'lamaro' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $lamaro_theme_config['font_subheaders'],
							'subset'    => 'latin-ext',
							'variation' => $lamaro_theme_config['font_subheaders_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-subheaders-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'lamaro' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'lamaro' ),
						'type'  => 'text',
						'value'  => $lamaro_theme_config['font_subheaders_weights'],						
					),							
				),
			),
			'fontello-box' => array(
				'title'   => esc_html__( 'Fontello', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
					'fontello-css'    => array(
						'label' => esc_html__( 'Fontello Codes CSS', 'lamaro' ),
						'desc'  => esc_html__( 'Upload *-codes.css postfix file here', 'lamaro' ),
						'type'  => 'upload',
						'images_only' => false,
					),		
					'fontello-ttf'    => array(
						'label' => esc_html__( 'Fontello TTF', 'lamaro' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-eot'    => array(
						'label' => esc_html__( 'Fontello EOT', 'lamaro' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-woff'    => array(
						'label' => esc_html__( 'Fontello WOFF', 'lamaro' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-woff2'    => array(
						'label' => esc_html__( 'Fontello WOFF2', 'lamaro' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-svg'    => array(
						'label' => esc_html__( 'Fontello SVG', 'lamaro' ),
						'type'  => 'upload',
						'images_only' => false,
					),												
				),
			),

		),
	),	
	'social' => array(
		'title'   => esc_html__( 'Social', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(
			'social-box' => array(
				'title'   => esc_html__( 'Social', 'lamaro' ),
				'type'    => 'tab',
				'options' => array(
                    'social-header' => array(
                        'label' => esc_html__( 'Header before social', 'lamaro' ),
                        'type' => 'text',
                        'value' => '',
                    ),						
					'target-social'    => array(
						'label' => esc_html__( 'Open social links in', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'self'  => esc_html__( 'Same window', 'lamaro' ),
							'blank' => esc_html__( 'New window', 'lamaro' ),
						),
						'value' => 'self',
					),															
		            'social-icons' => array(
		                'label' => esc_html__( 'Social Icons', 'lamaro' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'desc' => esc_html__( 'Visible in inner page header', 'lamaro' ),
		                'box-options' => array(
		                    'icon_v2' => array(
		                        'label' => esc_html__( 'Icon', 'lamaro' ),
		                        'type'  => 'icon-v2',
		                    ),
		                    'text' => array(
		                        'label' => esc_html__( 'Text', 'lamaro' ),
		                        'desc' => esc_html__( 'If needed', 'lamaro' ),
		                        'type' => 'text',
		                    ),
		                    'href' => array(
		                        'label' => esc_html__( 'Link', 'lamaro' ),
		                        'type' => 'text',
		                        'value' => '#',
		                    ),		                    
		                ),
                		'template' => '{{- text }}',		                
                    ),								
				),
			),
		),
	),	
	'colors' => array(
		'title'   => esc_html__( 'Colors Schemes', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(			
			'schemes-box' => array(
				'title'   => esc_html__( 'Additional Color Schemes Settings', 'lamaro' ),
				'type'    => 'box',
				'options' => array(
					'advice'    => array(
						'html' => esc_html__( 'You also need to change the global settings in Appearance -> Customize -> Lamaro settings', 'lamaro' ),
						'type'  => 'html',
					),	
					'items' => array(
						'label' => esc_html__( 'Theme Color Schemes', 'lamaro' ),
						'type' => 'addable-box',
						'value' => array(),
						'desc' => esc_html__( 'Can be selected in page settings', 'lamaro' ),
						'box-options' => array(
							'slug' => array(
								'label' => esc_html__( 'Scheme ID', 'lamaro' ),
								'type' => 'text',
								'desc' => esc_html__( 'Required Field', 'lamaro' ),
								'value' => '',
							),							
							'name' => array(
								'label' => esc_html__( 'Scheme Name', 'lamaro' ),
								'desc' => esc_html__( 'Required Field', 'lamaro' ),
								'type' => 'text',
								'value' => '',
							),
							'logo'    => array(
								'label' => esc_html__( 'Logo Black Background', 'lamaro' ),
								'type'  => 'upload',
							),
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White Background', 'lamaro' ),
								'type'  => 'upload',
							),		
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black Background 2x', 'lamaro' ),
								'type'  => 'upload',
							),
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White Background 2x', 'lamaro' ),
								'type'  => 'upload',
							),		
							'main-color'  => array(
								'label' => esc_html__( 'Main Color', 'lamaro' ),
								'type'  => 'color-picker',
							),
							'second-color' => array(
								'label' => esc_html__( 'Second Color', 'lamaro' ),
								'type'  => 'color-picker',
							),
							'gray-color' => array(
								'label' => esc_html__( 'Gray Color', 'lamaro' ),
								'type'  => 'color-picker',
							),								
							'black-color' => array(
								'label' => esc_html__( 'Black Color', 'lamaro' ),
								'type'  => 'color-picker',
							),	
							'white-color' => array(
								'label' => esc_html__( 'White Color', 'lamaro' ),
								'type'  => 'color-picker',
							),								
						),
						'template' => '{{- name }}',
					),
				),
			),
		),
	),	
	'popup' => array(
		'title'   => esc_html__( 'Popup', 'lamaro' ),
		'type'    => 'tab',
		'options' => array(
			'popup-box' => array(
				'title'   => esc_html__( 'Popup settings', 'lamaro' ),
				'type'    => 'box',
				'options' => array(						
					'popup-status'    => array(
						'label'   => esc_html__( 'Status', 'lamaro' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'lamaro' ),
							'enabled'  => esc_html__( 'Enabled', 'lamaro' ),
						),
						'value' => 'disabled'
					),						
					'popup-hours'    => array(
						'label' => esc_html__( 'Period hidden, days', 'lamaro' ),
						'type'  => 'text',
						'value'	=>	'24',
					),						
					'popup-text'    => array(
						'label' => esc_html__( 'Popup text', 'lamaro' ),
						'type'  => 'wp-editor',
					),
					'popup-bg'    => array(
						'label' => esc_html__( 'Popup Background', 'lamaro' ),
						'type'  => 'upload',
					),					
					'popup-yes'    => array(
						'label' => esc_html__( 'Yes button', 'lamaro' ),
						'type'  => 'text',
						'value'	=>	'Yes',
					),	
					'popup-no'    => array(
						'label' => esc_html__( 'No button', 'lamaro' ),
						'type'  => 'text',
						'value'	=>	'No',
					),																
					'popup-no-link'    => array(
						'label' => esc_html__( 'No link', 'lamaro' ),
						'type'  => 'text',
						'value'	=>	'https://google.com',
					),																
				),	
			),
		),
	),
);

unset($options['colors']);
unset($options['popup']);
unset($options['header']['header-box-topbar']);

if ( function_exists('ltx_share_buttons_conf') ) {

	$share_links = ltx_share_buttons_conf();

	$share_links_options = array();
	if ( !empty($share_links) ) {

		$share_links_options = array(

			'share_icons_hide' => array(
                'label' => esc_html__( 'Hide all share icons block', 'lamaro' ),
                'type'  => 'checkbox',
                'value'	=>	false,
            ),
		);
		foreach ( $share_links as $key => $item ) {

			$state = fw_get_db_settings_option( 'share_icon_' . $key );

			$value = false;
			if ( is_null($state) AND $item['active'] == 1 ) {

				$value = true;
			}

			$share_links_options[] =
			array(
				'share_icon_'.$key => array(
	                'label' => $item['header'],
	                'type'  => 'checkbox',
	                'value'	=>	$value,
	            ),
			);
		}
	}

	$share_links_options['share-add'] = array(

        'label' => esc_html__( 'Custom Share Buttons', 'lamaro' ),
        'type' => 'addable-box',
        'value' => array(),
        'desc' => esc_html__( 'You can use {link} and {title} variables to set url. E.g. "http://www.facebook.com/sharer.php?u={link}"', 'lamaro' ),
        'box-options' => array(
            'icon' => array(
                'label' => esc_html__( 'Icon', 'lamaro' ),
                'type'  => 'icon-v2',
            ),
            'header' => array(
                'label' => esc_html__( 'Header', 'lamaro' ),
                'type' => 'text',
            ),
            'link' => array(
                'label' => esc_html__( 'Link', 'lamaro' ),
                'type' => 'text',
                'value' => '',
            ),		  
            'color' => array(
                'label' => esc_html__( 'Color', 'lamaro' ),
                'type' => 'color-picker',
                'value' => '',
            ),		              
        ),
		'template' => '{{- header }}',		                
    );

	$options['social']['options']['share-box'] = array(
		'title'   => esc_html__( 'Share Buttons', 'lamaro' ),
		'type'    => 'tab',
		'options' => $share_links_options,
	);
}

