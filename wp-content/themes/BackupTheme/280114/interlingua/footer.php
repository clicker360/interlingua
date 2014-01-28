		<!--	<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<nav role="navigation">
							<?php bones_footer_links(); ?>
									</nav>

					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>

				</div> <!-- end #inner-footer -->

			<!--	</footer> <!-- end footer -->

		<!--	</div> <!-- end #container -->

		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>

	</body>

</html> <!-- end page. what a ride! -->


<footer class="footer1" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<nav role="navigation">
											</nav>

					<div id="footer-interior1" class="wrap clearfix">
						<div id="menu1" class="cincocol menu-footer clearfix">
							<span class="titulos-footer">Cursos</span><br><br>
								<a href="http://www.interlingua.com.mx/?cursosregulares=semi-intensivo"> Regulares </a><br>
								<a href="http://www.interlingua.com.mx/?cursosjovenes=kids"> Niños / Jóvenes</a><br>
								<a href="http://www.interlingua.com.mx/empresas-2/">Empresas</a><br>
								<a href="http://www.interlingua.com.mx/?cursosdiversos=market-leader">Especiales</a><br>
								<a href="http://www.interlingua.com.mx/f-a-q/cursos/">F.A.Q.</a>
						</div>
						<div id="menu2" class="cincocol menu-footer clearfix">
							<span class="titulos-footer">Método</span><br><br>
								<a href="http://www.interlingua.com.mx/?page_id=46">Nuestro Método</a><br>
								<a href="http://www.interlingua.com.mx/?page_id=52">Materiales y Certificaciones</a><br>
								<a href="http://www.interlingua.com.mx/f-a-q/metodo/">F.A.Q.</a>
						</div>
						<div id="menu3" class="cincocol menu-footer clearfix">
							<span class="titulos-footer">Interlingua</span><br><br>
								<a href="http://www.interlingua.com.mx/?page_id=296">Filosofía</a><br>
								<a href="http://www.interlingua.com.mx/?page_id=32">Acceso a Alumnos</a><br>
								<a href="http://www.interlingua.com.mx/?page_id=304">Misión y Visión</a><br>
								<a href="http://www.interlingua.com.mx/?page_id=38">Obtén una Franquicia</a><br>
								<a href="http://www.interlingua.com.mx/?page_id=372">Facturación</a><br>
								<a href="http://www.interlingua.com.mx/?page_id=321">Responsabilidad Social<br>
								<a href="http://www.interlingua.com.mx/f-a-q/inscripciones/">F.A.Q.</a>
						</div>
						<div id="menu4" class="cincocol menu-footer clearfix">
							<span class="titulos-footer">Contacto</span><br><br>
								<a href="http://www.interlingua.com.mx/alumnos/">Alumnos</a><br>
								<a href="http://www.interlingua.com.mx/empresas-2/">Empresas</a><br>
								<a href="http://www.interlingua.com.mx/franquicias/">Franquicias</a>
						</div>
						<div id="social-footer" class="cincocol menu-footer clearfix">
							<span class="titulos-footer">Síguenos</span><br><br>
							<div class="footer-centrado-social wrap">
							<div class="twitter-footer">
									<a href="https://twitter.com/Interlinguamx" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/twitter.png" ?=""></a>
								</div>							
								
								<div class="facebook-footer">
									<a href="https://www.facebook.com/interlingua.mx?fref=ts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/facebook.png" ?=""></a>
								</div>	

								<div class="google-footer">
									<a href="https://plus.google.com/u/0/102755391403241662820/posts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/google.png" ?=""></a>
								</div>							
						</div>
					</div>
				

				</div> <!-- end #inner-footer -->

			</footer>

<footer class="footer2" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<nav role="navigation">
					</nav>

				<div id="footer-interior2" class="wrap clearfix">
					<p class="copyright">Todos los derechos reservados © Interlingua 2013<br><a href="http://www.interlingua.com.mx/?page_id=71">Aviso de Privacidad</a> / <a href="http://www.interlingua.com.mx/aviso-legal/">Aviso Legal</a></p>
					<p class="privacidad">Centro de información Cd. de México 500 500 50<br>Línea de atención al cliente 01 800 1 INGLÉS (464537)</p>
				</div>

				</div> <!-- end #inner-footer -->

			</footer>
                    <?php if(is_home()){ ?>    
               <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery(".menu-item").children('a').click(function(e){
                        e.preventDefault();
                        var href = jQuery(this).attr('href');
                        if(href.substring(0,1) == '#'){
                            var top = jQuery(href).offset().top;
                            jQuery('body,html').animate({
                                'scrollTop' : top 
                            },1000);
                        }else{
                            window.location = href;
                        }                        
                    });
                });
                </script>

                

                <?php } ?>

