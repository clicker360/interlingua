<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!-- drop Google Analytics Here -->
		<!-- end analytics -->

	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

				<div id="contenedor-izquierdo"  class="sixcol clearfix">
					<div class="logo-header" align="center">
						<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/logo.png" ?></a>
					</div>
				</div>

				<div id="contenedor-derecho"  class="sixcol clearfix">
					<div class="logos-redes fullcol clearfix">
						
							<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/twitter.png" ?></a>						
							<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/facebook.png" ?></a>
										
					</div>

					<div class="logos-redes fullcol clearfix">
						<div class="twitter-heade clearfix">
							<span class="telefono1">Línea de atención al cliente <strong>01 800 1INGLES (434537)</strong></span><br><span class="telefono2">Centro de información Cd. de México <strong>500 500 50</strong></span>
						</div>					
					</div>
				</div>

					<!-- <div id="contenedor-izquierdo"  class="sixcol first clearfix">
							<div class="logo-header">
								<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>../library/images/logo.png" ?></a>
							</div>
						</div> -->

						<!-- div id="contenedor-derecho" class="sixcol last clearfix">
							<div class="redes-header">								
								<div class="google-header fourcol">
									<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>../library/images/google.png" ?></a>
								</div>
								<div class="twitter-header fourcol">
									<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>../library/images/twitter.png" ?></a>
								</div>
								<div class="facebook-header fourcol">
									<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>../library/images/facebook.png" ?></a>
								</div>								
								<!--<div class="arrow-header">									
									<div class="flecha">
										<a  rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>../library/images/arrow.png" ?></a>
									</div>
									<div class="siguenos">¡Síguenos!</div>
								</div> 
							</div>
							<div class="telefonos-header">
								<span class="telefono1">Línea de atención al cliente <strong>01 800 1INGLES (434537)</strong></span><br><span class="telefono2">Centro de información Cd. de México <strong>500 500 50</strong></span>
							</div>
						</div> -->

						</div> <!-- end #inner-header -->

						<div id="contenedor-menu">

							<div id="contenedor-menu-interior"  class="wrap clearfix">
					
							<nav role="navigation">
								<?php bones_main_nav(); ?>
							</nav>

							</div>

						</div>


			</header> <!-- end header -->