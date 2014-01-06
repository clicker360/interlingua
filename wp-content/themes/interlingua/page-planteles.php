<?php
/*
Template Name: Planteles
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="twelvecol first clearfix " role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

								</header> <!-- end article header -->


								<div class="planteles-formulario eightcol clearfix">
									<div class="encabezado-planteles">¡Encuentra aquí tu INTERLINGUA® más cercano!</div>
									<div class="descripcion-planteles-interior">Contamos con más de 60 planteles a nivel nacional.</div>
									<div class="formulario-planteles">										
											<div class="formulario-estado">
												<select id="estado-form" name="estadolist">
												  <option >Elige tu Estado</option>
												  <option value="Estado1">Estado 1</option>
												  <option value="Estado2 ">Estado 2</option>
												  <option value="Estado3">Estado 3</option>
												</select>
											</div>

											<div class="formulario-plantel">
												<select id="plantel-form" name="plantellist">
												  <option value="volvo">Elige tu Plantel</option>
												  <option value="saab">Estado 1</option>
												  <option value="opel">Estado 2</option>
												  <option value="audi">Estado 3</option>
												</select>	
												</div>									
									</div>
								</div>

								<div class="planteles-informacion fourcol clearfix">
									<div class="nombre-plantel">INTERLINGUA® Plantel Satélite</div>
									<div class="direccion-plantel">Pabellón Las Torres Blvd. Manuel A. Camacho 3228 Local 19 Col. Boulevares 53140 Naucalpan, Estado de México</div>
									<div class="telefono-plantel">Tel. (55) 4430 2290 | satelite@interlingua.com.mx</div>
								</div>

								<div class="planteles-mapa fullcol">
									<!--<iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.mx/?ie=UTF8&amp;ll=19.342732,-99.050257&amp;spn=0.282154,0.528374&amp;t=m&amp;z=12&amp;output=embed"></iframe><br />-->
								</div>



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

						

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
