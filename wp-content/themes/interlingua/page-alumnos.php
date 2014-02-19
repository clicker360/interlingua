<?php
session_start();
if (!isset($_SESSION["id_alumno"])) {
	header("Location: http://www.interlingua.com.mx/");
	exit();
}
/*
Template Name: Alumnos
*/
?>

<?php get_header(); ?>
			<script type="text/javascript" charset="utf-8">
				jQuery(document).on("ready",index);
				function index(){
          jQuery(".audios").on("click",function(e){
            e.preventDefault();
            jQuery("#info-alumnos").hide();
            jQuery(".historial-calificaciones").hide();
            jQuery(".content-audios").fadeIn("slow");
          });
          jQuery(".calificaciones-alumnos").on("click",function(e){
            e.preventDefault();
            jQuery("#info-alumnos").hide();
            jQuery(".content-audios").hide();
            jQuery(".historial-calificaciones").fadeIn("slow");
          });
          jQuery(".inicio-calif").on("click",function(e){
            e.preventDefault();
            jQuery(".historial-calificaciones").hide();
            jQuery(".content-audios").hide();
            jQuery("#info-alumnos").fadeIn("slow");
          });
          //get Alumno
          ruta = jQuery("input[name=ruta]").val();
          jQuery.ajax({
              type:"post",
              url: ruta+"/core.php",
              data: {action:"getAlumno",matricula:"<?php echo $_SESSION['alumno']; ?>"},
              dataType:"json",
              error:function(){
                  alert("Error, por favor intentalo mas tarde.");
              },
              success:function(data){
                if(data.nombre!=null && data.nombre!=""){jQuery("#nombre-alumno").html(data.nombre)}else{jQuery(".nombre-alumno").hide();jQuery("#nombre-alumno").hide()}
                if(data.matricula!=null && data.matricula!=""){jQuery("#matricula-alumno").html(data.matricula)}else{jQuery(".matricula-alumno").hide();jQuery("#matricula-alumno").hide();}
                if(data.plantel!=null && data.plantel!=""){jQuery("#ciudad-alumno").html(data.plantel)}else{jQuery(".ciudad-alumno").hide();jQuery("#ciudad-alumno").hide();}
                if(data.curso!=null && data.curso!=""){jQuery("#curso-alumno").html(data.curso)}else{jQuery(".curso-alumno").hide();jQuery("#curso-alumno").hide();}
                if(data.horario!=null && data.horario!=""){jQuery("#hora-alumno").html(data.horario)}else{jQuery(".hora-alumno").hide();jQuery("#hora-alumno").hide();}
                if(data.nivel!=null && data.nivel!=""){jQuery("#nivel-alumno").html(data.nivel)}else{jQuery(".nivel-alumno").hide();jQuery("#nivel-alumno").hide();}
                if(data.email!=null && data.email!=""){jQuery("#campo-correo-alumno").html(data.email)}else{jQuery(".correo-alumno").hide();jQuery("#campo-correo-alumno").hide();}
                if(data.sexo!=null && data.sexo!=""){jQuery("#campo-sexo-alumno").html(data.sexo)}else{jQuery(".sexo-alumno").hide();jQuery("#campo-sexo-alumno").hide();}
                if(data.edad!=null && data.edad!=""){jQuery("#campo-edad-alumno").html(data.edad)}else{jQuery(".edad-alumno").hide();jQuery("#campo-edad-alumno").hide();}
                if(data.fecha_nacimiento!=null && data.fecha_nacimiento!=""){jQuery("#campo-nacimiento-alumno").html(data.fecha_nacimiento)}else{jQuery(".nacimiento-alumno").hide();jQuery("#campo-nacimiento-alumno").hide();}
                if(data.telefono_1!=null && data.telefono_1!=""){jQuery("#campo-telefono1-alumno").html(data.telefono_1)}else{jQuery(".telefono1-alumno").hide();jQuery("#campo-telefono1-alumno").hide();}
                if(data.telefono_2!=null && data.telefono_2!=""){jQuery("#campo-telefono2-alumno").html(data.telefono_2)}else{jQuery(".telefono2-alumno").hide();jQuery("#campo-telefono2-alumno").hide();}
                if(data.calle_num!=null && data.calle_num!=""){jQuery("#campo-calle-numero-alumno").html(data.calle_num)}else{jQuery(".calle-numero-alumno").hide();jQuery("#campo-calle-numero-alumno").hide();}
                if(data.colonia!=null && data.colonia!=""){jQuery("#campo-colonia-alumno").html(data.colonia)}else{jQuery(".colonia-alumno").hide();jQuery("#campo-colonia-alumno").hide();}
                if(data.poblacion!=null && data.poblacion!=""){jQuery("#campo-poblacion-alumno").html(data.poblacion)}else{jQuery(".poblacion-alumno").hide();jQuery("#campo-poblacion-alumno").hide();}
                if(data.cp!=null && data.cp!=""){jQuery("#campo-cp-alumno").html(data.cp)}else{jQuery(".cp-alumno").hide();jQuery("#campo-cp-alumno").hide();}
              }
          });
          jQuery.ajax({
              type:"post",
              url: ruta+"/core.php",
              data: {action:"getKardex",matricula:"<?php echo $_SESSION['alumno']; ?>"},
              dataType:"json",
              error:function(){
                  alert("Error, por favor intentalo mas tarde.");
              },
              success:function(data){
                jQuery("#tableAS400").html(data.table);
              }
          });
				}
			</script>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>
									


								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">

								<!-- Comienza Seccion Alumnos -->

        <div id="info-alumnos">

					<div class="menu-alumnos">
						<div class="inicio-alumnos">Inicio</div>
						<div class="calificaciones-alumnos">Calificaciones</div>
						<div class="audios gbg calificaciones-calif moveizq">Audios</div><div class="triangulo-der-1"></div>
					</div>
						<div class="datos-escuela-alumno">
						<div class="informacion-alumno">
							<div class="nombre-alumno">Nombre</div>
							<div class="matricula-alumno">Matrícula</div>
							<div class="ciudad-alumno">Plantel</div>
							<div class="curso-alumno">Curso</div>
							<div class="hora-alumno">Horario</div>
							<div class="nivel-alumno">Nivel</div>
						</div>
						<div class="informacion-alumno">
							<div id="nombre-alumno" class="nombre-alumno"></div>
              <div id="matricula-alumno" class="matricula-alumno"></div>
							<div id="ciudad-alumno" class="ciudad-alumno"></div>
							<div id="curso-alumno" class="curso-alumno"></div>
							<div id="hora-alumno" class="hora-alumno"></div>
							<div id="nivel-alumno" class="nivel-alumno"></div>
						</div>
					</div>

					<div class="datos-personales-titulo">Datos Personales</div>

					<div class="informacion-del-alumno">

						<div class="datos-personales-alumno">
							<div class="correo-alumno">Correo Electrónico:</div>
							<div class="sexo-alumno">Sexo:</div>
							<div class="edad-alumno">Edad:</div>
							<div class="nacimiento-alumno">Fecha de Nacimiento:</div>
							<div class="telefono1-alumno">Teléfono 1:</div>
							<div class="telefono2-alumno">Teléfono 2:</div>
							<div class="calle-numero-alumno">Calle y Número:</div>
							<div class="colonia-alumno">Colonia:</div>
							<div class="poblacion-alumno">Población:</div>
							<div class="cp-alumno">C.P:</div>
						</div>

						<div class="campos-datos-personales-alumno">
							<div id="campo-correo-alumno" class="campo-correo-alumno"></div>
							<div id="campo-sexo-alumno" class="campo-sexo-alumno"></div>
							<div id="campo-edad-alumno" class="campo-edad-alumno"></div>
							<div id="campo-nacimiento-alumno" class="campo-nacimiento-alumno"></div>
							<div id="campo-telefono1-alumno" class="campo-telefono1-alumno"></div>
							<div id="campo-telefono2-alumno" class="campo-telefono2-alumno"></div>
							<div id="campo-calle-numero-alumno" class="campo-calle-numero-alumno"></div>
							<div id="campo-colonia-alumno" class="campo-colonia-alumno"></div>
							<div id="campo-poblacion-alumno" class="campo-poblacion-alumno"></div>
							<div id="campo-cp-alumno" class="campo-cp-alumno"></div>
						</div>

					</div>

        </div>
				<div class="historial-calificaciones">
					<!--h1 class="page-title">Revisa tu historial académico</h1-->

					<div class="menu-calificaciones">
						<div class="inicio-calif">Inicio</div><div class="triangulo-der-1"></div>
						<div class="calificaciones-calif moveizq">Calificaciones</div><div class="triangulo-der"></div>
						<div class="audios gbg calificaciones-calif moveizq">Audios</div><div class="triangulo-der-1"></div>
					</div>

					<div class="calificaciones-tabla">
            <div id="tableAS400"></div>
					</div>
				</div>
			
			<!-- audios -->
			<div class="content-audios">
				<div class="menu-audios">
					<div class="inicio-calif">Inicio</div>
					<div class="calificaciones-alumnos">Calificaciones</div><div class="triangulo-der-1"></div>
					<div class="audios calificaciones-calif moveizq-aud">Audios</div><div class="triangulo-der"></div>
				</div>

				<div class="audios-tabla">
            		audios
				</div>
			</div>

					<?php the_content(); ?>
								</section> <!-- end article section -->

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

						<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
