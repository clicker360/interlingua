<?php
/*
Template Name: Contacto Franquicias
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="clearfix">

						<div id="main" class="twelvecol first clearfix " role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header wrap">

									<h2 class="curso-titulo">
										<?php
											$category = get_the_category();
											if($category[0]){
											echo $category[0]->cat_name.'';
											}
										?>

									</h2>
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
									                            //remote: "http://www.interlingua.com.mx/crm/prospects/checkUnique"
									                            //remote: "http://localhost/interlingua/crm/prospects/checkUnique"
									                        },

									                        medio_contacto: {
									                            required: true,									                            
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

									                        comments: {
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

									                        medio: {
									                            required: '*Ingresa el medio_contacto',									                           
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

									                        comments: {
									                            required: '*Escribe tu comentario'
									                        },

									                        termino: {
									                            required: '*Debes aceptar términos y condiciones'
									                        }
									                    }
									                });
									                jQuery.get("http://www.interlingua.com.mx/crm/prospects/getEstados/",function(estados){
									                    estados = JSON.parse(estados);      
									                    jQuery("#cmbEstadosFranquicias").html('<option value="">Elige tu estado</option>');
									                    jQuery.each(estados,function(index,value){
									                        jQuery("#cmbEstadosFranquicias").append('<option value="'+value+'">'+value+'</option>');
									                    });                        
									                });
									                jQuery("#cmbEstadosFranquicias").change(function(){
									                    jQuery.get("http://www.interlingua.com.mx/crm/prospects/getPlanteles/"+jQuery(this).val(),function(planteles){
									                        planteles = JSON.parse(planteles);      
									                        jQuery("#cmbSucursalesFranquicias").html('<option value="">Elige tu plantel</option>');
									                        jQuery.each(planteles,function(index,value){
									                            jQuery("#cmbSucursalesFranquicias").append('<option value="'+value+'">'+value+'</option>');
									                        });                        
									                    });
									                });
									       //          jQuery("#form1").live('submit', function(e){
									       //          	e.preventDefault();
												    //     var isvalidate = jQuery("#form1").valid();
												    //     alert("test");											        
												    // });
									            });
									        </script>

								</header> <!-- end article header -->


								<!--Termina Menu Interno del Curso -->

								<!-- Comienza Contenedor de Curso -->
									<div id="contenedor-curso" class="degradado-gris fullcol">
										<div class="contenedor-curso-interior wrap">
											<div class="contenedor-curso-informacion sevencol first">
												<h1 class="titulo-contacto">
													<?php echo get_the_title(); ?>
													<span class="subtitulo-contacto">
														<?php
															echo(types_render_field( "subtitulo-contacto", array( 'raw' => 'true'  ) ));
														?>
													</span>
												</h1>
												<p class="descripcion-contacto">
													<?php
														echo(types_render_field( "descripcion-contacto", array( 'raw' => 'true'  ) ));
													?>
												</p>
												<p class="nota-contacto">
													<?php
														echo(types_render_field( "nota-contacto", array( 'raw' => 'true'  ) ));
													?>
												</p>
											</div>
											<div class="contenedor-curso-formulario fivecol last">
												<h3 class="titulo-formulario">
													<?php
														echo(types_render_field( "titulo-formulario", array( 'raw' => 'true'  ) ));
													?>
												</h3>
												<div class="formulario-registro-cursos wrap">

													<div id="formulario-franquicias">                           
							                            <!--<form id="form1" method="post" action="http://www.interlingua.com.mx/crm/registro">-->
							                            <form id="form1" method="post" action="http://www.interlingua.com.mx/crm/prospects/sendMailContact?tipo=franquicias">
							                                <input type="hidden" name="origin_id" value="14" />
							                                <div id="nombre1Franquicias">
							                                    <input type="text" id="txtNombreFranquicias" name="name"  placeholder="Nombre Completo"/>
							                                </div>
							                                <div id="correo1Franquicias">
							                                    <input type="text" id="txtCorreoFranquicias" name="email" placeholder="Correo Electrónico"/>
							                                </div>

							                                <div id="lada1Franquicias">
							                                    <input type="text" id="txtLadaFranquicias" name="lada" maxlength="3" placeholder="LADA" />
							                                </div>
							                                <div id="telefono1Franquicias">
							                                    <input type="text" id="txtTelefonoFranquicias" name="phone_number" maxlength="8" placeholder="Teléfono" />
							                                </div>

							                                <div id="celular1Franquicias">
							                                    <input type="text" id="txtCelularFranquicias" name="mobile_number" maxlength="10" placeholder="Celular"/>
							                                </div>
							                                <div id="estado1Franquicias">
							                                    <select id="cmbEstadosFranquicias" name="estado">   
							                                    <option value="" selected="selected">Elige tu estado</option>                                     
							                                    </select>
							                                </div>							                               
							                                
							                                <div id="sucursal1Franquicias">
							                                    <select id="cmbSucursalesFranquicias" name="plantel">
							                                        <option value="" selected="selected">Elige tu plantel</option>
							                                    </select>
							                                </div>

							                                 <div id="medio1Franquicias">
							                                    <input type="text" id="txtMedioFranquicias" name="medio_contacto"  placeholder="¿Por qué medio enteró de nuestra Franquicia?"/>
							                                </div>	

							                                <div id="comentario1Franquicias">
							                                    <textarea cols=20 rows=10 id="txtComentarioFranquicias" name="comments"  placeholder="Escribe tu Comentario"></textarea>
							                                </div>

							                              

							                                <input type="submit" id="btnEnviarFranquicias" value="¡Quiero informaci&oacute;n!" style="cursor:pointer" />
							                                <div id="politicas1Franquicias">                                    
							                                    <input type="checkbox" id="chkPoliticasFranquicias" name="termino" checked />
							                                    <div id="acepto1Franquicias">
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


