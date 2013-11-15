<?php
session_start();
if (!isset($_SESSION["id_alumno"])) {
	header("Location: http://interlingua.com.mx/");
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
          jQuery(".calificaciones-alumnos").on("click",function(e){
            e.preventDefault();
            jQuery("#info-alumnos").hide();
            jQuery(".historial-calificaciones").fadeIn("slow");
          });
          jQuery(".inicio-calif").on("click",function(e){
            e.preventDefault();
            jQuery(".historial-calificaciones").hide();
            jQuery("#info-alumnos").fadeIn("slow");
          });
          //get Alumno
          ruta = jQuery("#ruta").val();
          jQuery.ajax({
              type:"post",
              url: ruta+"/core.php",
              data: {action:"getAlumno",matricula:$_SESSION["alumno"]},
              dataType:"json",
              error:function(){
                  alert("Error, por favor intentalo mas tarde.");
              },
              success:function(data){
                if(data.nombre!=""){jQuery("#nombre-alumno").html(data.nombre)}else{jQuery(".nombre-alumno").hide();jQuery("#nombre-alumno").hide()}
                if(data.matricula!=""){jQuery("#matricula-alumno").html(data.matricula)}else{jQuery(".matricula-alumno").hide();jQuery("#matricula-alumno").hide();}
                if(data.plantel!=""){jQuery("#ciudad-alumno").html(data.plantel)}else{jQuery(".ciudad-alumno").hide();jQuery("#ciudad-alumno").hide();}
                if(data.curso!=""){jQuery("#curso-alumno").html(data.curso)}else{jQuery(".curso-alumno").hide();jQuery("#curso-alumno").hide();}
                if(data.horario!=""){jQuery("#hora-alumno").html(data.horario)}else{jQuery(".hora-alumno").hide();jQuery("#hora-alumno").hide();}
                if(data.nivel!=""){jQuery("#nivel-alumno").html(data.nivel)}else{jQuery(".nivel-alumno").hide();jQuery("#nivel-alumno").hide();}
                if(data.email!=""){jQuery("#campo-correo-alumno").html(data.email)}else{jQuery(".correo-alumno").hide();jQuery("#campo-correo-alumno").hide();}
                if(data.sexo!=""){jQuery("#campo-sexo-alumno").html(data.sexo)}else{jQuery(".sexo-alumno").hide();jQuery("#campo-sexo-alumno").hide();}
                if(data.edad!=""){jQuery("#campo-edad-alumno").html(data.edad)}else{jQuery(".edad-alumno").hide();jQuery("#campo-edad-alumno").hide();}
                if(data.fecha_nacimiento!=""){jQuery("#campo-nacimiento-alumno").html(data.fecha_nacimiento)}else{jQuery(".nacimiento-alumno").hide();jQuery("#campo-nacimiento-alumno").hide();}
                if(data.telefono_1!=""){jQuery("#campo-telefono1-alumno").html(data.telefono_1)}else{jQuery(".telefono1-alumno").hide();jQuery("#campo-telefono1-alumno").hide();}
                if(data.telefono_2!=""){jQuery("#campo-telefono2-alumno").html(data.telefono_2)}else{jQuery(".telefono2-alumno").hide();jQuery("#campo-telefono2-alumno").hide();}
                if(data.calle_num!=""){jQuery("#campo-calle-numero-alumno").html(data.calle_num)}else{jQuery(".calle-numero-alumno").hide();jQuery("#campo-calle-numero-alumno").hide();}
                if(data.colonia!=""){jQuery("#campo-colonia-alumno").html(data.colonia)}else{jQuery(".colonia-alumno").hide();jQuery("#campo-colonia-alumno").hide();}
                if(data.poblacion!=""){jQuery("#campo-poblacion-alumno").html(data.poblacion)}else{jQuery(".poblacion-alumno").hide();jQuery("#campo-poblacion-alumno").hide();}
                if(data.cp!=""){jQuery("#campo-cp-alumno").html(data.cp)}else{jQuery(".cp-alumno").hide();jQuery("#campo-cp-alumno").hide();}
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
					</div>

					<div class="calificaciones-tabla">
						<table width="90%" class="tabla-calif">
                            <tr class="top-labels">
                              <td colspan="7">Cursos</td>
                              <td colspan="7">Calificaciones</td>
                            </tr>
                            <tr class="bg-labels">
                              <td width="10%">Plantel</td>
                              <td width="12%">Horario</td>
                              <td width="7%">Curso</td>
                              <td width="6%">Nivel</td>
                              <td width="6%">Aula</td>
                              <td width="7%">Faltas</td>
                              <td width="25%">Periodo</td>
                              <td width="8%">Escrita</td>
                              <td width="7%">Oral</td>
                              <td width="12%">Mak-Up</td>
                          
                            </tr>
                            <tr>
                              <td>Queretaro</td>
                              <td>1810-1930</td>
                              <td>S</td>
                              <td>IN</td>
                              <td>02</td>
                              <td>1</td>
                              <td>20080910-20081003</td>
                              <td>9.40</td>
                              <td>8.00</td>
                              <td>.00</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>1810-1930</td>
                              <td>S</td>
                              <td>1</td>
                              <td>10</td>
                              <td>0</td>
                              <td>20081006-20081028</td>
                              <td>9.60</td>
                              <td>8.00</td>
                              <td>.00</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>1810-1930</td>
                              <td>S</td>
                              <td>2</td>
                              <td>03</td>
                              <td>2</td>
                              <td>20081029-20081121</td>
                              <td>9.20</td>
                              <td>10.00</td>
                              <td>.00</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>1810-1930</td>
                              <td>S</td>
                              <td>3</td>
                              <td>03</td>
                              <td>0</td>
                              <td>20081124-20081216</td>
                              <td>9.20</td>
                              <td>8.00</td>
                              <td>.00</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                                    <td>1810-1930</td>
                                    <td>S</td>
                                    <td>4</td>
                                    <td>13</td>
                                    <td>2</td>
                                    <td>20090107-20090129</td>
                                    <td>9.20</td>
                                    <td>8.00</td>
                                    <td>.00</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>1810-1930</td>
                                    <td>S</td>
                                    <td>5</td>
                                    <td>04</td>
                                    <td>1</td>
                                    <td>20090130-20090224</td>
                                    <td>9.40</td>
                                    <td>8.00</td>
                                    <td>.00</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>1810-1930</td>
                                    <td>S</td>
                                    <td>6</td>
                                    <td>01</td>
                                    <td>1</td>
                                    <td>20090225-20090320</td>
                                    <td>8.60</td>
                                    <td>8.00</td>
                                    <td>.00</td>
                            </tr> 
                             <tr>
                              <td>&nbsp;</td>
                                    <td>1810-1930</td>
                                    <td>S</td>
                                    <td>7</td>
                                    <td>14</td>
                                    <td>4</td>
                                    <td>20090323-20090421</td>
                                    <td>8.80</td>
                                    <td>8.00</td>
                                    <td>.00</td
                            ></tr>  
                            <tr>
                              <td>&nbsp;</td>
                                    <td>1940-2100</td>
                                    <td>S</td>
                                    <td>8</td>
                                    <td>08</td>
                                    <td>4</td>
                                    <td>20090422-20090526</td>
                                    <td>9.40</td>
                                    <td>8.00</td>
                                    <td>.00</td>
                            </tr>  
                            <tr>
                              <td>&nbsp;</td>
                                    <td>1940-2100</td>
                                    <td>S</td>
                                    <td>9</td>
                                    <td>09</td>
                                    <td>0</td>
                                    <td>20090527-20090617</td>
                                    <td>8.60</td>
                                    <td>6.00</td>
                                    <td>.00</td>
                            </tr>  
                            <tr>
                              <td>&nbsp;</td>
                                    <td>1810-1930</td>
                                    <td>S</td>
                                    <td>10</td>
                                    <td>17</td>
                                    <td>3</td>
                                    <td>20090618-20090709</td>
                                    <td>9.40</td>
                                    <td>8.00</td>
                                    <td>.00</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                                    <td>1810-1930</td>
                                    <td>S</td>
                                    <td>11</td>
                                    <td>18</td>
                                    <td>0</td>
                                    <td>20090710-20090731</td>
                                    <td>.00</td>
                                    <td>.00</td>
                                    <td>.00</td>
                            </tr>
                          </table>

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
