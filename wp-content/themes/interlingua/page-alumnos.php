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
							<div class="nombre-alumno">Jonathan Álvarez</div>
							<div class="matricula-alumno">09969869</div>
							<div class="ciudad-alumno">Polanco, DF.</div>
							<div class="curso-alumno">Semi-Intensivo</div>
							<div class="hora-alumno">18:10 p.m.</div>
							<div class="nivel-alumno">10</div>
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
							<div class="campo-correo-alumno">jonathan.alvarez@clicker360.com</div>
							<div class="campo-sexo-alumno">Masculino</div>
							<div class="campo-edad-alumno">31 años</div>
							<div class="campo-nacimiento-alumno">09 / 09 / 1981</div>
							<div class="campo-telefono1-alumno">(55) 55456511</div>
							<div class="campo-telefono2-alumno">(55) 55456511</div>
							<div class="campo-calle-numero-alumno">Platón 178</div>
							<div class="campo-colonia-alumno">Polanco</div>
							<div class="campo-poblacion-alumno">Ciudad de México, DF</div>
							<div class="campo-cp-alumno">011500</div>
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
