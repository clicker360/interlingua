<?php
/*
Template Name: Pagina Cursos
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


								</header> <!-- end article header -->

								
								<!-- Comienza Menu Interno del Curso -->
								<div class="menu-cursos wrap clearfix">
									<ul>
										<?php $argsVideos = array(
											'cat'		=> 5,
											'post_type' => 'cursos',
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
												<div class="titulo-del-curso">
													<?php echo get_the_title(); ?>
												</div>
												<div class="subtitulo-del-curso">
													<?php
														echo(types_render_field( "subtitulo-curso", array( 'raw' => 'true'  ) ));
													?>
												</div>
												<div class="descripcion-del-curso">
													<?php
														echo(types_render_field( "descripcion-curso", array( 'raw' => 'true'  ) ));
													?>
												</div>
												<div class="nota-del-curso">
													<?php
														echo(types_render_field( "nota-curso", array( 'raw' => 'true'  ) ));
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
													<?php echo do_shortcode('[contact-form-7 id="59" title="Contact form 1"]'); ?>
												</div>
											</div>
										</div>
									</div>
									<div class="sombra-slider-curso wrap"><img src="<?php bloginfo('template_directory'); ?>/library/images/sombra.png" title="" alt="" /></div>									
								<!-- Termina Contenedor de Curso -->

								<!-- Comienza Slider Tipo de Cursos -->	
								<div class="contenedor-slider-cursos fullcol">
									<div class="slider-tipo-cursos wrap">
										<div class="slider-curso-1 cursocol clearfix">
											<div class="imagen-slider-curso" align="center"><img src="<?php bloginfo('template_directory'); ?>/library/images/curso-regular-color.png" title="" alt="" /></div>
											<div class="titulo-slider-curso">REGULARES</div>
											<div class="descripcion-slider-curso">El curso más popular de INTERLINGUA® ¡En un año serás Bilingüe!</div>
											<div class="boton-slider-curso"><input type="button" id="boton-slider-cursos" value="Leer más"></div>
										</div>									

										<div class="slider-curso-2 cursocol clearfix">
											<div class="imagen-slider-curso" align="center"><img src="<?php bloginfo('template_directory'); ?>/library/images/curso-jovenes-grises.png" title="" alt="" /></div>
											<div class="titulo-slider-curso">NIÑOS / JÓVENES</div>
											<div class="descripcion-slider-curso">El curso más popular de INTERLINGUA® ¡En un año serás Bilingüe!</div>
											<div class="boton-slider-curso" ><input  type="button" id="boton-slider-cursos" value="Leer más"></div>
										</div>

										<div class="slider-curso-3 cursocol clearfix">
											<div class="imagen-slider-curso" align="center"><img src="<?php bloginfo('template_directory'); ?>/library/images/curso-empresas-grises.png" title="" alt="" /></div>
											<div class="titulo-slider-curso">EMPRESAS</div>
											<div class="descripcion-slider-curso">El curso más popular de INTERLINGUA® ¡En un año serás Bilingüe!</div>
											<div class="boton-slider-curso"><input type="button" id="boton-slider-cursos" value="Leer más"></div>
										</div>

										<div class="slider-curso-4 cursocol clearfix">
											<div class="imagen-slider-curso" align="center"><img src="<?php bloginfo('template_directory'); ?>/library/images/curso-especiales-grises.png" title="" alt="" /></div>
											<div class="titulo-slider-curso">ESPECIALES</div>
											<div class="descripcion-slider-curso">El curso más popular de INTERLINGUA® ¡En un año serás Bilingüe!</div>
											<div class="boton-slider-curso"><input type="button" id="boton-slider-cursos" value="Leer más"></div>
										</div>
									</div>
								</div>
								<!-- Termina Slider Tipo de Curso -->
										
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


