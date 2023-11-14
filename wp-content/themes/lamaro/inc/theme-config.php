<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Theme Configuration and Custom CSS initializtion
 */

/**
 * Global theme config for header/footer/sections/colors/fonts
 */
if ( !function_exists('lamaro_theme_config') ) {

	add_filter( 'ltx_get_theme_config', 'lamaro_theme_config', 10, 1 );
	function lamaro_theme_config() {

	    return array(
	    	'navbar'	=>	array(
				'white'  	=> esc_html__( 'Default. White Background', 'lamaro' ),
				'black'  	=> esc_html__( 'Black Background logo Left', 'lamaro' ),
				'transparent'  => esc_html__( 'Transparent for Homepage Slider', 'lamaro' ),		
			),
			'navbar-default' => 'white',

			'footer' => array(
				'default'  => esc_html__( 'Default', 'lamaro' ),		
			),
			'footer-default' => 'default',

			'color_main'	=>	'#CEBD88',
			'color_black'	=>	'#28364B',
			'color_gray'	=>	'#F1F0E8',
			'color_white'	=>	'#FFFFFF',
			'color_red'		=>	'#E14C38',
			'color_main_header'	=>	esc_html__( 'Sandy Yellow', 'lamaro' ),


			'font_main'					=>	'Raleway',
			'font_main_var'				=>	'regular',
			'font_main_weights'			=>	'600,700',
			'font_headers'				=>	'Playfair Display',
			'font_headers_var'			=>	'regular',
			'font_headers_weights'		=>	'',
			'font_subheaders'			=>	'Pinyon Script',
			'font_subheaders_var'		=>	'regular',
			'font_subheaders_weights'	=>	'',
		);
	}
}

/**
 *  Color Palette
 */
function lamaro_palette() {

	$cfg = lamaro_theme_config();

    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'Main', 'lamaro' ),
            'slug' => 'main-theme',
            'color' => $cfg['color_main'],
        ),
        array(
            'name' => esc_html__( 'Gray', 'lamaro' ),
            'slug' => 'gray',
            'color' => $cfg['color_gray'],
        ),
        array(
            'name' => esc_html__( 'Black', 'lamaro' ),
            'slug' => 'black',
            'color' => $cfg['color_black'],
        ),
        array(
            'name' => esc_html__( 'Red', 'lamaro' ),
            'slug' => 'red',
            'color' => $cfg['color_red'],
        ),        
    ) );
}
add_action( 'after_setup_theme', 'lamaro_palette', 10 );


/**
 * Get Google default font url
 */
if ( !function_exists('lamaro_font_url') ) {

	function lamaro_font_url() {

		$query_args = array( 'family' => 'Pinyon+Script|Playfair+Display:400,400i|Raleway:400,500,600,700', 'subset' => 'latin' );
		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		return esc_url( $font_url );
	}
}

/**
 * Gutenberg Color Palette
 */
function lamaro_gutenberg_palette() {

	$cfg = lamaro_theme_config();

    add_theme_support( 'editor-color-palette', array(
    	
        array(
            'name' => $cfg['color_main_header'],
            'slug' => 'main-theme',
            'color' => $cfg['color_main'],
        ),
        array(
            'name' => esc_html__( 'Gray', 'lamaro' ),
            'slug' => 'gray',
            'color' => $cfg['color_gray'],
        ),
        array(
            'name' => esc_html__( 'Black', 'lamaro' ),
            'slug' => 'black',
            'color' => $cfg['color_black'],
        ),
        array(
            'name' => esc_html__( 'Red', 'lamaro' ),
            'slug' => 'red',
            'color' => $cfg['color_red'],
        ),        
    ) );
}
add_action( 'after_setup_theme', 'lamaro_gutenberg_palette', 10 );

/**
 * Config used for lt-ext plugin to set Visual Composer configuration
 */
if ( !function_exists('lamaro_vc_config') ) {

	add_filter( 'ltx_get_vc_config', 'lamaro_vc_config', 10, 1 );
	function lamaro_vc_config( $value ) {

	    return array(
	    	'sections'	=>	array(
				esc_html__("Displaced floating section", 'lamaro') 		=> "displaced-top",				
			),
			'background' => array(
				esc_html__( "Main Color", 'lamaro' ) => "theme_color",
				esc_html__( "Second Color", 'lamaro' ) => "second",			
				esc_html__( "Gray", 'lamaro' ) => "gray",
				esc_html__( "White", 'lamaro' ) => "white",
				esc_html__( "Black", 'lamaro' ) => "black",			
			),
			'overlay'	=> array(
				esc_html__( "Black Overlay (60%)", 'lamaro' ) => "black",
				esc_html__( "Dark Overlay (75%)", 'lamaro' ) => "dark",
				esc_html__( "Black half block", 'lamaro' ) => "half",
				esc_html__( "Image Divider", 'lamaro' ) => "divider",
				esc_html__( "White Overlay", 'lamaro' ) => "white",
			),
		);
	}
}


/*
* Adding additional TinyMCE options
*/
if ( !function_exists('lamaro_mce_before_init_insert_formats') ) {

	add_filter('mce_buttons_2', 'lamaro_wpb_mce_buttons_2');
	function lamaro_wpb_mce_buttons_2( $buttons ) {

	    array_unshift($buttons, 'styleselect');
	    return $buttons;
	}

	add_filter( 'tiny_mce_before_init', 'lamaro_mce_before_init_insert_formats' );
	function lamaro_mce_before_init_insert_formats( $init_array ) {  

	    $style_formats = array(

	        array(  
	            'title' => esc_html__('Main Color', 'lamaro'),
	            'block' => 'span',  
	            'classes' => 'color-main',
	            'wrapper' => true,
	        ),  
	        array(  
	            'title' => esc_html__('White Color', 'lamaro'),
	            'block' => 'span',  
	            'classes' => 'color-white',
	            'wrapper' => true,   
	        ),
	        array(  
	            'title' => esc_html__('Large Text', 'lamaro'),
	            'block' => 'span',  
	            'classes' => 'text-lg',
	            'wrapper' => true,
	        ),    
	        array(  
	            'title' => 'List Checkbox',
	            'selector' => 'ul',
	            'classes' => 'check',
	        ),          
	    );  
	    $init_array['style_formats'] = json_encode( $style_formats );  
	     
	    return $init_array;  
	} 
}


/**
 * Register widget areas.
 *
 */
if ( !function_exists('lamaro_action_theme_widgets_init') ) {

	add_action( 'widgets_init', 'lamaro_action_theme_widgets_init' );
	function lamaro_action_theme_widgets_init() {

		$span_class = 'widget-icon';

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Default', 'lamaro' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'lamaro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="header-widget ltx-theme-header">',
			'after_title'   => '<span class="'.esc_attr($span_class).'"></span></h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar WooCommerce', 'lamaro' ),
			'id'            => 'sidebar-wc',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'lamaro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="header-widget ltx-theme-header">',
			'after_title'   => '<span class="'.esc_attr($span_class).'"></span></h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'lamaro' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'lamaro' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget ltx-theme-header">',
			'after_title'   => '<span class="'.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'lamaro' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'lamaro' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget ltx-theme-header">',
			'after_title'   => '<span class="'.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'lamaro' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'lamaro' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget ltx-theme-header">',
			'after_title'   => '<span class="'.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'lamaro' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'lamaro' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget ltx-theme-header">',
			'after_title'   => '<span class="'.esc_attr($span_class).'"></span></h3>',
		) );			

	}
}



/**
 * Additional styles init
 */
if ( !function_exists('lamaro_css_style') ) {

	add_action( 'wp_enqueue_scripts', 'lamaro_css_style', 10 );
	function lamaro_css_style() {

		global $wp_query;

		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array(), '1.0' );

		wp_enqueue_style( 'lamaro-plugins-css', get_template_directory_uri() . '/assets/css/plugins.css', array(), wp_get_theme()->get('Version') );

		wp_enqueue_style( 'lamaro-theme-style', get_stylesheet_uri(), array( 'bootstrap', 'lamaro-plugins-css' ), wp_get_theme()->get('Version') );
	}
}


/**
 * Wp-admin styles and scripts
 */
if ( !function_exists('lamaro_admin_init') ) {

	add_action( 'after_setup_theme', 'lamaro_admin_init' );
	function lamaro_admin_init() {

		add_action("admin_enqueue_scripts", 'lamaro_admin_scripts');
	}

	function lamaro_admin_scripts() {

		if ( function_exists('fw_get_db_settings_option') ) {

			$fontello['css'] = fw_get_db_settings_option( 'fontello-css' );
			$fontello['eot'] = fw_get_db_settings_option( 'fontello-eot' );
			$fontello['ttf'] = fw_get_db_settings_option( 'fontello-ttf' );
			$fontello['woff'] = fw_get_db_settings_option( 'fontello-woff' );
			$fontello['woff2'] = fw_get_db_settings_option( 'fontello-woff2' );
			$fontello['svg'] = fw_get_db_settings_option( 'fontello-svg' );

			if ( !empty($fontello['css']) AND !empty( $fontello['eot']) AND  !empty( $fontello['ttf']) AND  !empty( $fontello['woff']) AND  !empty( $fontello['woff2']) AND  !empty( $fontello['svg']) ) {

				wp_enqueue_style(  'lamaro-fontello',  $fontello['css']['url'], array(), wp_get_theme()->get('Version') );

				$randomver = wp_get_theme()->get('Version');
				$css_content = "@font-face {
				font-family: 'lamaro-fontello';
				  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."');
				  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."#iefix') format('embedded-opentype'),
				       url('". esc_url ( $fontello['woff2']['url']. "?" . $randomver )."') format('woff2'),
				       url('". esc_url ( $fontello['woff']['url']. "?" . $randomver )."') format('woff'),
				       url('". esc_url ( $fontello['ttf']['url']. "?" . $randomver )."') format('truetype'),
				       url('". esc_url ( $fontello['svg']['url']. "?" . $randomver )."#" . pathinfo(wp_basename( $fontello['svg']['url'] ), PATHINFO_FILENAME)  . "') format('svg');
				  font-weight: normal;
				  font-style: normal;
				}";

				wp_add_inline_style( 'lamaro-fontello', $css_content );
			}

			wp_enqueue_script( 'lamaro-theme-admin', get_template_directory_uri() . '/assets/js/scripts-admin.js', array( 'jquery' ) );
		}
	}
}




