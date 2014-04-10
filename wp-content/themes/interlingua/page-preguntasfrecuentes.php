<?php
/*
Template Name: Preguntas Frecuentes
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
							<?php
                                                                        // Set up the objects needed
                                                                        $my_wp_query = new WP_Query();
                                                                        $all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));

                                                                        // Get the page as an Object
                                                                        $faq =  get_page_by_title('F.A.Q.');

                                                                        // Filter through all pages and find Portfolio's children
                                                                        $faq_children = get_page_children( $faq->ID, $all_wp_pages );

                                                                        ?>
	
								<div class="menu-faq wrap clearfix">
									<ul>
									    <?php if(count($faq_children)){ foreach($faq_children as $k => $page){ ?>			
										<li>
											<a href="<?php echo $page->guid; ?>" title="<?php echo $page->post_title; ?>"><?php echo $page->post_title; ?></a>
										</li>
											<?php } }else{  ?>
											<p><?php _e('No hay cursos de esta categoría'); ?></p>
											<?php } ?>
									</ul>
								</div>
								<!--Termina Menu Interno del Curso -->

							
										
								<section class="entry-content  wrap clearfix" itemprop="articleBody">
									<div class="titulo-faq"><?php echo get_the_title(); ?></div>
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


