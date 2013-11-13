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

									<h1 class="page-title">
										<?php
											$parent_title = get_the_title($post->post_parent);
											echo $parent_title;?>
									</h1>
								<!--	<p class="byline vcard"><?php
										printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F jS, Y', 'bonestheme')), bones_get_the_author_posts_link());
									?></p> -->


								</header> <!-- end article header -->

								
								<!-- Comienza Menu Interno del Curso -->
								<div class="menu-cursos wrap clearfix">
									<?php
										// The Query
										query_posts('cat=3, &order=ASC' );

										// The Loop
										while ( have_posts() ) : the_post();
										    echo '<ul><li><a href="'.get_permalink().'">';
										    the_title();
										    echo '</a></li></ul>';
										endwhile;

										// Reset Query
										wp_reset_query();
									?>
								</div>
								<!--Termina Menu Interno del Curso -->

								<!-- Comienza Contenedor de Curso -->
									<div id="contenedor-curso" class="degradado-gris fullcol">
										<div class="contenedor-curso-interior wrap">
											<div class="contenedor-curso-informacion eightcol first">
												<div class="titulo-del-curso">
													<?php echo get_the_title(); ?>
												</div>
												<div class="subtitulo-del-curso">
													<?php
														echo(types_render_field( "subtitulo-curso", array( 'raw' => 'true'  ) ));
													?>
												</div>
											</div>
											<div class="contenedor-curso-formulario fourcol last"></div>
										</div>

										
									</div>

								<!-- Termina Contenedor de Curso -->




								<section class="entry-content clearfix" itemprop="articleBody">
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
