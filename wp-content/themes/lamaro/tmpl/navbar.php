<?php
/**
 * Navigation Bar
 */
$navbar_logo = $navlogo_class = $navbar_affix = '';
$navbar_layout = 'white';
$basket_icon = 'disabled';
$navbar_class = 'navbar-collapse collapse';
$navbar_mobile_width = '992';

if ( function_exists( 'FW' ) ) {

	$navbar_affix = fw_get_db_settings_option( 'navbar-affix' );
	$navbar_breakpoint = fw_get_db_settings_option( 'navbar-breakpoint' );

	$wrapper_affix = '';
	if ( $navbar_affix == 'affix' ) {

		$wrapper_affix = ' sticked';
	}

	if ( !empty($navbar_breakpoint) ) {

		$navbar_mobile_width = $navbar_breakpoint;
	}

	// Current page layout
	$navbar_layout = lamaro_get_navbar_layout('white');

	if ( $navbar_layout == 'white' ) {

		$navbar_logo = 'white';
	}	

	$basket_icon = fw_get_db_settings_option( 'basket-icon' );
	if ( empty($basket_icon) ) {

		$basket_icon = 'disabled';
	}	
}

if ( $navbar_layout != 'disabled' ):

	lamaro_the_topbar_block( $navbar_layout );

?>
<div id="nav-wrapper" class="navbar-layout-<?php echo esc_attr($navbar_layout); echo esc_attr($wrapper_affix); ?>">
	<div class="container">
		<nav class="navbar">
			<div class="navbar-top">
				<?php
					lamaro_the_navbar_social();
				?>				
				<div class="navbar-logo <?php echo esc_attr($navlogo_class); ?>">	
					<?php
						lamaro_the_logo($navbar_logo);
					?>
				</div>
				<?php
					lamaro_the_navbar_icons( $navbar_layout )
				?>
			</div>
			<div id="navbar" class="<?php echo esc_attr( $navbar_class ); ?>" data-spy="<?php echo esc_attr($navbar_affix); ?>" data-offset-top="200" data-mobile-screen-width="<?php echo esc_attr( $navbar_mobile_width ); ?>">
				<div class="toggle-wrap">
					<?php
						lamaro_the_logo('white');
					?>						
					<button type="button" class="navbar-toggle collapsed">
						<span class="close"><span class="">&times;</span></span>
					</button>							
					<div class="clearfix"></div>
				</div>
				<?php
					lamaro_get_wp_nav_menu();
				?>
				<div class="mobile-controls">
					<?php
						lamaro_the_navbar_icons( $navbar_layout, true );
					?>
				</div>				
			</div>
			<div class="navbar-controls">	
				<button type="button" class="navbar-toggle collapsed">
					<span class="icon-bar top-bar"></span>
					<span class="icon-bar middle-bar"></span>
					<span class="icon-bar bottom-bar"></span>
				</button>			
			</div>			
		</nav>
	</div>
</div>
<?php

endif;

