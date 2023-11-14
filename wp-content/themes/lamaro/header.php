<?php
/**
 * The Header for theme
 *
 * Displays all of the <head>
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	lamaro_the_pageloader_overlay();
	$lamaro_header_class = lamaro_get_pageheader_class();
?>
	<div class="header-wrapper <?php echo esc_attr($lamaro_header_class); ?>">
<?php
		get_template_part( 'tmpl/navbar' ); 

		$pageheader_layout = lamaro_get_pageheader_layout();

		if ( $pageheader_layout != 'disabled' ) : ?>
		<header class="page-header">
		    <div class="container">   
		    	<?php
		    		lamaro_the_h1();			
					lamaro_the_breadcrumbs();
				?>	    
		    </div>	    
		</header>
		<?php endif; ?>
	</div>
	<div class="container main-wrapper">