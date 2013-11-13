<?php
/*
Template Name: Page-Gracias
*/

$nivel = $_GET['niv'];
switch ($nivel) {
    case -1:
        $nivelTxt = "Preliminar";
        break;
    case 0:
        $nivelTxt = "Introducci&oacute;n";
        break;
    
    default:
        $nivelTxt = "Nivel ".$nivel;
        break;
}
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

								<!-- Comienza Contenedor de Curso -->
									<div id="contenedor-curso" class="degradado-gris fullcol">
										<div class="contenedor-curso-interior wrap">
											<div class="contenedor-curso-informacion sevencol first">
												<!--<div class="titulo-contacto">
													<?php echo get_the_title(); ?>
												</div>-->
												<div class="subtitulo-resultado-test">
													<?php
														echo(types_render_field( "subtitulo-contacto", array( 'raw' => 'true'  ) ));
													?>
												</div>
												<!--<div class="descripcion-contacto">
													<?php
														echo(types_render_field( "descripcion-contacto", array( 'raw' => 'true'  ) ));
													?>
												</div>-->
												<div class="resultado-test">
													<?php echo $nivelTxt;?>											
												</div>
												<div class="nota-test-fin">
													<?php
														echo(types_render_field( "nota-contacto", array( 'raw' => 'true'  ) ));
													?>
												</div>
											</div>
											<div class="contenedor-curso-formulario fivecol last">
												<section class="entry-content  wrap clearfix" itemprop="articleBody">
													<?php the_content(); ?>
												</section>
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


