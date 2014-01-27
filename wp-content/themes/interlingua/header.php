<?php
session_start();
if (isset($_SESSION["nombre"]) && isset($_SESSION["alumno"])) {
	$nombreAlumno = $_SESSION["nombre"];
	$matriculaAlumno = $_SESSION["alumno"];
}
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

			  /*var menuAlt = jQuery('#megaMenuToggle');
			  var menuAlt_offset = login.offset();
			  
			  jQuery(window).on('scroll', function() {
			    if(jQuery(window).scrollTop() > menuAlt_offset.top+253) {
			      menuAlt.addClass('menu-fijo');
			      menuAlt.addClass('menu-fix');
			      jQuery("#megaUber").addClass("menu-fix");
			      jQuery(".megaMenuToggle-icon").addClass("fixIconMenu");
			      jQuery("#megaUber").addClass("fixUlMenu");			  
			    } else {
			      menuAlt.removeClass('menu-fijo');
			      menuAlt.removeClass('menu-fix');			
			      jQuery("#megaUber").removeClass("menu-fix");      
			      jQuery(".megaMenuToggle-icon").removeClass("fixIconMenu");
			      jQuery("#megaUber").removeClass("fixUlMenu");			  
			    }
			});*/	

			  // action for login acceso alumnos
			  jQuery(".lnk-acceso").on("click",function(e){
			  	e.preventDefault();
			  	jQuery("#login_alumnos").css("-webkit-border-radius","0px");
			  	jQuery("#login_alumnos").css("border-radius","0px");
			  	jQuery("#toogleLogin").fadeToggle("slow",function(){			  		
                    //termina
			  	});
			  	// Gira flecha	
			  	state = jQuery(".lnk-acceso > img").attr("data-valid");
			  	
			  	if(state == undefined || state == "false"){             
			  		jQuery(".lnk-acceso > img").attr("data-valid","true");  
                	jQuery(".lnk-acceso > img").css("transform","rotate(180deg)");                    	
                }else{                                 
                	jQuery(".lnk-acceso > img").attr("data-valid","false");  
                	jQuery(".lnk-acceso > img").css("transform","rotate(360deg) !important");
                }
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

			  jQuery("#olvidaContrasena").on("click",function(e){
			  	e.preventDefault();
			  	jQuery("#loginfr").hide();
			  	jQuery("#toogleLogin").css("height","106px");
			  	jQuery(".txt-acceso").text("RECUPERAR CONTRASEÑA");
			  	jQuery("#recuperafr").fadeIn("slow");

			  	jQuery("#frmGetPass").on("submit",function(e){
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
		            			alert(data.mensaje);
		            			location.reload();
		            		}
		            	}
		            });
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



	<script src="<?php echo get_template_directory_uri(); ?>/library/reveal/jquery.reveal.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/library/reveal/reveal.css">

	<!-- chat -->
	<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
	$.src='//v2.zopim.com/?1qdTKWEfbdERJo2vkOeZvkwDidMTesBF';z.t=+new Date;$.
	type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
	</script>
	<!--End of Zopim Live Chat Script-->
<script>
$zopim(function() {
	$zopim.livechat.setOnStatus(function(data) {
		var zopim_ele = document.getElementsByClassName('zopim');
		var iframe = document.getElementsByTagName('iframe');
		var zopim_form = document.getElementsByClassName('form_container');
		var button_send = jQuery(iframe).contents().find('form').children("div.bottom").children(".submit");
		var input_name = jQuery(iframe).contents().find('form').children(".meshim_widget_widgets_ScrollableFrame");
		var form = jQuery(iframe).contents().find('form');
		var iframe_content = jQuery(iframe).contents();

		if(button_send.attr("value")=="Empezar a chatear"){
			jQuery(button_send).on("click",function(){				
				setTimeout(function(){
					var status = jQuery(iframe_content).find(".meshim_widget_components_chatWindow_PreChatOfflineForm").css("display");
					console.log(status);
					if(status == "none"){
						var name = jQuery(form).find(".input_name").attr("value");
						var email = jQuery(form).find(".input_email").attr("value");
						var phone_number = jQuery(form).find(".input_phone").attr("value");	
						var origin_id = 91;			
						
						jQuery.ajax({
				            type:"post",
				            url: "http://www.interlingua.com.mx/crm/registro",
				            data:{origin_id:origin_id,email:email, phone_number:phone_number, name:name},
				            dataType:"json",				            
				            success:function(data){
				            	console.log("success");
				            }
				        });
					}				
				},1000);
			});
		}

		if(button_send.attr("value")=="Enviar mensaje"){
			jQuery(button_send).on("click",function(){				
				setTimeout(function(){
					var status = jQuery(iframe_content).find(".meshim_widget_components_chatWindow_preChatOfflineForm_Form").css("display");
					console.log(status);
					if(status == "none"){
						var name = jQuery(form).find(".input_name").attr("value");
						var email = jQuery(form).find(".input_email").attr("value");
						var phone_number = jQuery(form).find(".input_phone").attr("value");	
						var origin_id = 91;			
						
						jQuery.ajax({
				            type:"post",
				            url: "http://www.interlingua.com.mx/crm/registro",
				            data:{origin_id:origin_id,email:email, phone_number:phone_number, name:name},
				            dataType:"json",				            
				            success:function(data){
				            	console.log("success");
				            }
				        });
					}				
				},1000);
			});
		}
	});
}); 
</script>
</head>

<body <?php body_class(); ?>>
	<?php if(is_page('gracias')){ ?>
		<!-- Google Code for Registro del Sitio Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1045194190;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "DK2lCOyyiwkQzsux8gM";
		var google_conversion_value = 0;
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1045194190/?value=0&amp;label=DK2lCOyyiwkQzsux8gM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
	<?php } ?>

	<?php if(is_page('gracias_teachers')){ ?>
		<!-- Google Code for Registro de Bolsa de Trabajo Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1045194190;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "K2kmCITXiAkQzsux8gM";
		var google_conversion_value = 0;
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1045194190/?value=0&amp;label=K2kmCITXiAkQzsux8gM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
	<?php } ?>
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
								<div id="loginfr">
									<form name="frmLogin" id="frmLogin" action="#" method="post">
										<input type="hidden" name="action" value="login" id="action" />
										<input type="hidden" name="ruta" value="<?php echo get_template_directory_uri(); ?>" id="ruta" />
										<label class="lblLog" for="usuario">Matrícula</label>
										<input type="text" name="usuario" value="" id="usuario" class="inptLog" required/>
										<label class="lblLog" for="usuario">Contraseña</label>
										<input type="password" name="pass" value="" id="pass" class="inptLog" required/>
										<input type="submit" name="sendLogin" value="Entrar" id="sendLogin" />
									</form>
									<a href="#" class="olvidaste" id="olvidaContrasena">¿Olvidaste tu contraseña?</a>
								</div>
								<div id="recuperafr">
									<form name="frmGetPass" id="frmGetPass" action="#" method="post">
										<input type="hidden" name="action" value="getPass" id="action" />
										<input type="hidden" name="ruta" value="<?php echo get_template_directory_uri(); ?>" id="ruta" />
										<label class="lblLog" for="matinpt">Matrícula</label>
										<input type="text" name="matinpt" value="" id="matinpt" class="inptLog" required/>

										<input type="submit" name="sendLogin" value="Enviar" id="sendLogin" />
									</form>
								</div>
							</div>
							<?php }else{  ?>
							<div id="login_alumnos">
								<!--span class="txt-acceso">BIENVENIDO <?php echo "<strong>".strtoupper($_SESSION["alumno"])."</strong>"; ?></span-->
								<span class="txt-acceso txt-acceso2">BIENVENIDO</span>
								<a class="lnk-acceso" href="#"><img src="<?php echo get_template_directory_uri(); ?>/library/images/down.png"></a>
							</div>
							<div id="toogleLogin" class="heightlog">
								<input type="hidden" name="ruta" value="<?php echo get_template_directory_uri(); ?>" id="ruta" />
								<div class="nombreSession"><?php echo $nombreAlumno;?></div>
								<div class="matriculaSession"><?php echo $matriculaAlumno;?></div>
								<a class="btnCuenta" href="http://interlingua.com.mx/clicker360/interlingua/acceso-a-alumnos/">Mi Cuenta</a> <br>
								<a class="btnCerrar" href="#" id="logout"> Cerrar Sesión</a>
							</div>
							<?php } ?>
						</div>

					</div>


			</header> <!-- end header -->
