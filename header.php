<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300,700italic' rel='stylesheet' type='text/css'>
</head>
	
	<?php
		/* Tilføj særlige classes, hvis man befinder sig på forsiden */
		if( is_front_page() ):
			$b2b_classes = array('b2b-class', 'index-class');
		else:
			$b2b_classes = array('not-index');
		endif;
	
	?>
	
	<body <?php body_class( $b2b_classes ); ?>>
	
	<div class="wrapper">
	
		<!-- Primær navigation -->
		<div class="mobinav">
			<div class="mobibutton">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>
		</div>
		<?php wp_nav_menu(array('theme_location'=>'primary')); ?>