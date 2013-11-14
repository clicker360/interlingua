<?php
	session_start();
?>
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
		<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function() {
			  //scrollTop for login
			  var menu = jQuery('#login_alumnos');
			  var menu_offset = menu.offset();
			  
			  jQuery(window).on('scroll', function() {
			    if(jQuery(window).scrollTop() > menu_offset.top-50) {
			      menu.addClass('menu-fijo');
			    } else {
			      menu.removeClass('menu-fijo');
			    }
			  });
			  
			  var login = jQuery('#toogleLogin');
			  var login_offset = login.offset();
			  
			  jQuery(window).on('scroll', function() {
			    if(jQuery(window).scrollTop() > login_offset.top+100) {
			      login.addClass('menu-fijo');
			    } else {
			      login.removeClass('menu-fijo');
			    }
			  });
			  
			  // action for login acceso alumnos
			  jQuery(".lnk-acceso").on("click",function(e){
			  	e.preventDefault();
			  	jQuery("#login_alumnos").css("-webkit-border-radius","0px");
			  	jQuery("#login_alumnos").css("border-radius","0px");
			  	jQuery("#toogleLogin").fadeToggle("slow",function(){
			  		//termina
			  	});
			  });
			  
			  jQuery("#frmLogin").on("submit",function(e){
				e.preventDefault();
				ruta = jQuery("#ruta").val();
				
				jQuery.ajax({
	            	type:"post",
	            	url: ruta+"/core.php",
	            	data: jQuery(this).serialize(),
	            	dataType:"json",
	            	error:function(){
	                	alert("Error, por favor intentalo mas tarde.");
	            	},
	            	success:function(data){
	            		//success
	            		if(data.error){
	            			alert(data.mensaje);
	            			location.reload();
	            		}else{
	            			window.location = data.url;	
	            		}
	            	}
	        	});
			  });
			  
			  jQuery("#logout").on("click",function(e){
			  	e.preventDefault();
			  	ruta = jQuery("#ruta").val();
			  	jQuery.post(ruta+"/core.php",{action:"logout"},function(data){
			  		window.location = data;
			  	});
			  });
			});
		</script>
		<style>
		#megaMenu ul.megaMenu > li.menu-item {
			margin-left : -2px;

	}
	</style>
	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8156648-1']);
  _gaq.push(['_setDomainName', 'interlingua.com.mx']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	
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
						
							<a href="https://twitter.com/Interlinguamx" target="_blank" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/twitter.png" ?></a>						
							<a href="https://www.facebook.com/interlingua.mx?ref=hl" target="_blank" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/facebook.png" ?></a>
							<a href="https://plus.google.com/u/2/102048105295600879797/posts" target="_blank" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/google.png" ?></a>
										
					</div>

					<div class="logos-redes fullcol clearfix">
						<div class="twitter-heade clearfix">
							<span class="telefono1">Línea de atención al cliente <strong>01 800 1INGLES (464537)</strong></span><br><span class="telefono2">Centro de información Cd. de México <strong>500 500 50</strong></span>
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
								
								<?php if (!isset($_SESSION["id_alumno"])) { ?>
								<div id="login_alumnos">
									<span class="txt-acceso">ACCESO A ALUMNOS</span>
									<a class="lnk-acceso" href="#"><img src="<?php echo get_template_directory_uri(); ?>/library/images/down.png"></a>
								</div>
								<div id="toogleLogin">
									<form name="frmLogin" id="frmLogin" action="#" method="post">
										<input type="hidden" name="action" value="login" id="action" />
										<input type="hidden" name="ruta" value="<?php echo get_template_directory_uri(); ?>" id="ruta" />
										<label class="lblLog" for="usuario">Nombre de usuario</label>
									    <input type="text" name="usuario" value="" id="usuario" class="inptLog" required/>
									    <label class="lblLog" for="usuario">Contraseña</label>
									    <input type="password" name="pass" value="" id="pass" class="inptLog" required/>
									   	<input type="submit" name="sendLogin" value="Entrar" id="sendLogin" />
									</form>
								</div>
								<?php }else{  ?>
								<div id="login_alumnos">
									<!--span class="txt-acceso">BIENVENIDO <?php echo "<strong>".strtoupper($_SESSION["alumno"])."</strong>"; ?></span-->
									<span class="txt-acceso txt-acceso2">BIENVENIDO</span>
									<a class="lnk-acceso" href="#"><img src="<?php echo get_template_directory_uri(); ?>/library/images/down.png"></a>
								</div>
								<div id="toogleLogin" class="heightlog">
									<input type="hidden" name="ruta" value="<?php echo get_template_directory_uri(); ?>" id="ruta" />
									<div class="nombreSession">Jonathan Álvarez</div>
									<div class="matriculaSession">09969869</div>
									<a class="btnCuenta" href="http://localhost/hugo/interlingua/acceso-a-alumnos/">Mi Cuenta</a> <br>
									<a class="btnCerrar" href="#" id="logout"> Cerrar Sesión</a>
								</div>
								<?php } ?>
							</div>

						</div>

	
			</header> <!-- end header -->