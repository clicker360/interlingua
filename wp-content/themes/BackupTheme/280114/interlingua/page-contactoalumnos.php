<?php
/*
Template Name: Contacto Alumnos
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="clearfix">

						<div id="main" class="twelvecol first clearfix " role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header wrap">

									<h1 class="curso-titulo">
										<?php
											$category = get_the_category();
											if($category[0]){
											echo $category[0]->cat_name.'';
											}
										?>

									</h1>
								<!--	<p class="byline vcard"><?php
										printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F jS, Y', 'bonestheme')), bones_get_the_author_posts_link());
									?></p> -->

								<!-- Comienza Script Contacto -->

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
									                jQuery("#form1").validate({
									                    rules: {
									                        name: {
									                            required: true,
									                            //lettersonly: true,
									                        },
									                        email: {
									                            required: true,
									                            email: true,
									                            remote: "http://www.interlingua.com.mx/crm/prospects/checkUnique"
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
									                        estado: {
									                            required: true
									                        },
									                        plantel: {
									                            required: true
									                        },									                     

									                        termino: {
									                            required: true

									                        }
									                    },
									                    messages: {
									                        name: {
									                            required: '*Ingresa tu nombre',
									                            lettersonly: '*Solo letras para el nombre'
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
									                        estado: {
									                            required: '*Debes seleccionar un estado'
									                        },									                       

									                        termino: {
									                            required: '*Debes aceptar términos y condiciones'
									                        }
									                    }
									                });	
									                jQuery.get("http://www.interlingua.com.mx/crm/prospects/getEstados/",function(estados){
									                    estados = JSON.parse(estados);      
									                    jQuery("#cmbEstadosAlumnos").html('<option value="">Elige tu estado</option>');
									                    jQuery.each(estados,function(index,value){
									                        jQuery("#cmbEstadosAlumnos").append('<option value="'+value+'">'+value+'</option>');
									                    });                        
									                });
									                jQuery("#cmbEstadosAlumnos").change(function(){
									                    jQuery.get("http://www.interlingua.com.mx/crm/prospects/getPlanteles/"+jQuery(this).val(),function(planteles){
									                        planteles = JSON.parse(planteles);      
									                        jQuery("#cmbSucursalesAlumnos").html('<option value="">Elige tu plantel</option>');
									                        jQuery.each(planteles,function(index,value){
									                            jQuery("#cmbSucursalesAlumnos").append('<option value="'+value+'">'+value+'</option>');
									                        });                        
									                    });
									                });
									            });
									        </script>

								</header> <!-- end article header -->

								
								<!-- Comienza Menu Interno del Curso -->
							<!-- 	<div class="menu-cursos wrap clearfix">
									<ul>
										<?php $argsVideos = array(
											//'cat'		=> 9,
											'post_type' => 'contacto',
											);

											$myVideos = new WP_Query( $argsVideos ); ?>
											<?php if ($myVideos -> have_posts()) : 
											while ($myVideos -> have_posts()) : $myVideos -> the_post(); ?>
										<li>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</li>
											<?php endwhile; ?>
											<?php else : ?>
											<p><?php _e('No hay cursos de esta categoría'); ?></p>
											<?php endif; wp_reset_query(); ?>
									</ul>
								</div>
								
							

								<!--Termina Menu Interno del Curso -->

								<!-- Comienza Contenedor de Curso -->
									<div id="contenedor-curso" class="degradado-gris fullcol">
										<div class="contenedor-curso-interior wrap">
											<div class="contenedor-curso-informacion sevencol first">
												<div class="titulo-contacto">
													<?php echo get_the_title(); ?>
												</div>
												<div class="subtitulo-contacto">
													<?php
														echo(types_render_field( "subtitulo-contacto", array( 'raw' => 'true'  ) ));
													?>
												</div>
												<div class="descripcion-contacto">
													<?php
														echo(types_render_field( "descripcion-contacto", array( 'raw' => 'true'  ) ));
													?>
												</div>
												<div class="nota-contacto">
													<?php
														echo(types_render_field( "nota-contacto", array( 'raw' => 'true'  ) ));
													?>
												</div>
											</div>
											<div class="contenedor-curso-formulario fivecol last">
												<div class="titulo-formulario">
													<?php
														echo(types_render_field( "titulo-formulario", array( 'raw' => 'true'  ) ));
													?>
												</div>
												<div class="formulario-registro-cursos wrap">

													<div id="formulario-alumnos">                           
							                            <form id="form1" method="post" action="http://www.interlingua.com.mx/crm/registro">
							                                <input type="hidden" name="origin_id" value="28" />
							                                <div id="nombre1Alumnos">
							                                    <input type="text" id="txtNombreAlumnos" name="name"  placeholder="Nombre Completo"/>
							                                </div>
							                                <div id="correo1Alumnos">
							                                    <input type="text" id="txtCorreoAlumnos" name="email" placeholder="Correo Electrónico"/>
							                                </div>

							                                <div id="lada1Alumnos">
							                                    <input type="text" id="txtLadaAlumnos" name="lada" maxlength="3" placeholder="LADA" />
							                                </div>
							                                <div id="telefono1Alumnos">
							                                    <input type="text" id="txtTelefonoAlumnos" name="phone_number" maxlength="8" placeholder="Teléfono" />
							                                </div>

							                                <div id="celular1Alumnos">
							                                    <input type="text" id="txtCelularAlumnos" name="mobile_number" maxlength="10" placeholder="Celular"/>
							                                </div>
							                                <div id="estado1Alumnos">
							                                    <select id="cmbEstadosAlumnos" name="estado">   
							                                    <option value="" selected="selected">Elige tu estado</option>                                     
							                                    </select>
							                                </div>							                               
							                                
							                                <div id="sucursal1Alumnos">
							                                    <select id="cmbSucursalesAlumnos" name="plantel">
							                                        <option value="" selected="selected">Elige tu plantel</option>
							                                    </select>
							                                </div>							                             
							                              

							                                <input type="submit" id="btnEnviarAlumnos" value="¡Quiero aprender inglés!" style="cursor:pointer" />
							                                <div id="politicas1Alumnos">                                    
							                                    <input type="checkbox" id="chkPoliticasAlumnos" name="termino" checked />
							                                    <div id="acepto1Alumnos">
							                                        <a href="http://www.interlingua.com.mx/politicas-de-privacidad/" target="_blank">Acepto las políticas de privacidad</a>
							                                    </div>
							                                </div>                                
							                            </form>
							                        </div> 
													<!--<?php echo do_shortcode('[contact-form-7 id="59" title="Contact form 1"]'); ?>-->
												</div>
											</div>
										</div>
									</div>
									<div class="sombra-slider-curso wrap"><img src="<?php bloginfo('template_directory'); ?>/library/images/sombra.png" title="" alt="" /></div>									
								<!-- Termina Contenedor de Curso -->
								
										
								<section class="entry-content  wrap clearfix" itemprop="articleBody">
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

					<!--	<?php get_sidebar(); ?> -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>


