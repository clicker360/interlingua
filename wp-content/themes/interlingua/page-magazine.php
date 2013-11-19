<?php
/*
Template Name: Interlingua Magazine
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="clearfix">

						<div id="main" class="twelvecol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><!--<?php the_title(); ?>--></h1>
									


								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <!-- end article section -->

								<div id="contenedor-curso" class="degradado-gris fullcol">
									<div class="contenedor-curso-interior wrap">
										<div class="contenedor-curso-informacion sevencol first">
											<div>
												<img src="http://dev.clicker360.com/interlingua_sitio/wp-content/themes/interlingua/library/images/logomagazine.png">
											</div>
											<div class="subtitulo-contacto">
												¿Qué es INTERLINGUA Magazine?
											</div>
											<div class="descripcion-contacto">
												Es la nueva herramienta interactiva que te ayudará a practicar, reforzar y mejorar lo aprendido en clase.
											</div>
											<div class="subtitulo-contacto">
												INTERLINGUA Magazine tiene para ti diversas actividades:
											</div>
											<div class="descripcion-contacto">
												<ul style="font-size: 14px;line-height: normal;color: #797979;">
													<li>Artículos y videos que se actualizan de forma semanal</li>
 													<li>Noticias y temas de actualidad</li>
  													<li>Ejercicios dinámicos</li>
  													<li>Desarrolla y acrecienta tu vocabulario en el idioma inglés</li>
  													<li>Revisa y mejora estructuras gramaticales</li>
												</ul>
											</div>
											<div class="descripcion-contacto" style="font-size: 24px;">
												INTERLINGUA Magazine ¡Es para todos!... No importa tu nivel actual de inglés.
											</div>
											<div class="subtitulo-contacto">
												¿Por qué INTERLINGUA Magazine?
											</div>
											<div class="descripcion-contacto"> 
												<ul style="font-size: 14px;line-height: normal;color: #797979;">
													<li>En cualquier momento, cualquier lugar: en tu computadora o laptop, ajustándose a tu agenda cotidiana</li>
													<li>Acceso fácil. No necesitas descargar un software o configuraciones especiales</li>
													<li>¡Aprenderás de forma sencilla, interactiva y eficaz!</li>
												</ul>
											</div>
											<div class="subtitulo-contacto">
												Por ser miembro de la comunidad INTERLINGUA podrás acceder a esta novedosa plataforma.
											</div>

										</div>
                                        <a href="http://interlingua.ispeakuspeak.com/security/login" target="_blank"><div id="btnEnviarMagazine" style="font-size: 22px;">Si ya estás registrado haz click aquí</div></a>
										<div class="contenedor-curso-formulario fivecol last">
											<div class="titulo-formulario" style="margin-bottom: 0;">
                                                ¡Regístrate ahora!
											</div>
											<div class="formulario-registro-cursos wrap">
												<div id="formulario-magazine">

							<form action="http://interlingua.clicker360.com/registro" name="frmReg" id="form1" method="post">
                                <!--<div style="" id="form1">-->
                                    <input type="hidden" name="origin_id" value="90" />
                                    <div id="matricula1Revista"><input type="text" name="matricula" id="txtMatriculaRevista" placeholder="Matrícula"></div>
                                    <div id="paterno1Revista"><input type="text" name="paterno" id="txtPaternoRevista" placeholder="Apellido Paterno"></div>
                                    <div id="materno1Revista"><input type="text" name="materno" id="txtMaternoRevista" placeholder="Apellido Materno"></div>
                                    <div id="nombre1Revista"><input type="text" name="name" id="txtNombreRevista" placeholder="Nombre Completo"></div>
                                    <div id="tipo1Revista"><select id="tipoRevista" name="tipotel">   
                                        <option value="0" selected="selected">Tipo de tel&eacute;fono</option> 
                                        <option value="Particular">Particular</option>
                                        <option value="Trabajo">Trabajo</option>
                                        <option value="Movil">Móvil</option>
                                        <option value="Otro">Otro</option>
                                    </select></div>
                                    <div id="telefono1Revista"><input type="text" name="phone_number" id="txtTelefonoRevista" placeholder="Tel&eacute;fono"></div>
                                    <div id="correo1Revista"><input type="text" name="email" id="txtCorreoRevista" placeholder="Correo Electrónico"></div>
                                    <input type="submit" value="Enviar" id="sendRevista" style="font-size:20px;">
                                    <div id="politicas1Revista">
                                    <input type="checkbox" id="chkPoliticasRevista" name="termino" checked />
                                    <div id="acepto1Revista"><a href="http://www.interlingua.com.mx/politicas-de-privacidad/" target="_blank">Acepto las políticas de privacidad</a></div>
									</div>
							</form>

							
							</div> </div>
										</div>
									</div>
								</div>

                                <div class="sombra-slider-curso wrap"><img src="http://dev.clicker360.com/interlingua_sitio/wp-content/themes/interlingua/library/images/sombra.png" title="" alt=""></div>

								<footer class="article-footer">
									<p class="clearfix"><?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>

								</footer> <!-- end article footer -->


							</article> <!-- end article -->

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e("This is the error message in the page-custom.php template.", "bonestheme"); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <!-- end #main -->

						<!--<?php get_sidebar(); ?>-->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<script>
jQuery(document).ready(function() {
    if (document.location.hash.indexOf("#error=") != '-1') {
        var errores = document.location.hash.replace('#error=', '');
        errores = JSON.parse(errores);
        document.location.hash = '';
        erroresString = '';
        for (var i in errores) {
            erroresString += errores[i] + '\n';
        }
        alert(erroresString);
    }

    // Vakida form de registro
    jQuery.validator.addMethod("accept", function(value, element, param) {
	  return value.match(new RegExp("." + param + "$"));
	});
    jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "*Debes seleccionar un tipo de tel&eacute;fono");
    jQuery("form[name=frmReg]").validate({
        rules: {
            matricula: {
                required: true
            },
            paterno: {
                required: true,
                accept: "[a-zA-Z]+"
                //lettersonly: true,
            },
            materno: {
                required: true,
                accept: "[a-zA-Z]+"
                //lettersonly: true,
            },
            name: {
                required: true,
                accept: "[a-zA-Z]+"
                //lettersonly: true,
            },
            email: {
                required: true,
                email: true,
                remote: "http://interlingua.clicker360.com/prospects/checkUnique"
                //remote: "http://localhost/interlingua/crm/prospects/checkUnique"
            },
            lada: {
                required: true,
                number: true,
                minlength: 2,
                maxlength: 3,
            },
            phone_number: {
                required: true,
                number: true,
                minlength: 7,
                maxlength: 8,
            },
            mobile_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            tipotel: {
                selectcheck: true
            },
            /*plantel: {
                required: true
            },*/
            termino: {
                required: true
            }
        },
        messages: {
            matricula: {
                required: '*Ingresa tu matrícula'
            },
            paterno: {
                required: '*Ingresa tu apellido paterno',
                accept: '*Solo letras para el apellido paterno'
            },
            materno: {
                required: '*Ingresa tu apellido materno',
                accept: '*Solo letras para el apellido materno'
            },
            name: {
                required: '*Ingresa tu nombre',
                accept: '*Solo letras para el nombre'
            },
            email: {
                required: '*Ingresa tu correo electr&oacute;nico',
                email: '*Ingresa un correo electr&oacute;nico correcto',
                remote: '*El correo electr&oacute;nico ya fue ingresado previamente',
            },
            lada: {
                required: '*Valida LADA',
                number: '*Solo n&uacute;meros',
                minlength: '*Solo 2 o 3 n&uacute;meros',
                maxlength: '*Solo 3 o 3 n&uacute;meros',
            },
            phone_number: {
                required: '*Valida n&uacute;mero telef&oacute;nico',
                number: '*Solo n&uacute;meros para el tel&eacute;fono',
                minlength: '*El tel&eacute;fono tiene que ser de 10 n&uacute;meros',
                maxlength: '*El tel&eacute;fono tiene que ser de 10 n&uacute;meros',
            },
            mobile_number: {
                required: '*Valida n&uacute;mero celular',
                number: '*Solo n&uacute;meros para el celular',
                minlength: '*El tel&eacute;fono celular tiene que ser de 10 n&uacute;meros',
                maxlength: '*El tel&eacute;fono celular tiene que ser de 10 n&uacute;meros'
            },
            plantel: {
                required: '*Debes seleccionar un plantel'
            },
            tipotel: {
                required: '*Debes seleccionar un tipo de tel&eacute;fono'
            },
            termino: {
                required: '*Debes aceptar términos y condiciones'
            }
        }
    });
    
    // Combo de estados y planteles
    jQuery.get("http://interlingua.clicker360.com/prospects/getEstados/",function(estados){
        estados = JSON.parse(estados);      
        jQuery("#estadoRevista").html('<option value="">Elige tu estado</option>');
        jQuery.each(estados,function(index,value){
            jQuery("#estadoRevista").append('<option value="'+value+'">'+value+'</option>');
        });                        
    });
    jQuery("#estadoRevista").change(function(){
        jQuery.get("http://interlingua.clicker360.com/prospects/getPlanteles/"+jQuery(this).val(),function(planteles){
            planteles = JSON.parse(planteles);      
            jQuery("#plantel").html('<option value="">Elige tu plantel</option>');
            jQuery.each(planteles,function(index,value){
                jQuery("#plantel").append('<option value="'+value+'">'+value+'</option>');
            });                        
        });
    });

});
</script>
<?php get_footer(); ?>
