

<footer class="footer1" role="contentinfo">

	<div id="inner-footer" class="wrap clearfix">

		<nav role="navigation">
		</nav>

		<div id="footer-interior1" class="wrap clearfix">

			<div id="menu1" class="cincocol menu-footer clearfix">
				<span class="titulos-footer">Cursos</span><br><br>
				<ul class="lista-footer">
					<li><a href="http://www.interlingua.com.mx/?cursosregulares=semi-intensivo"> Regulares </a></li>
					<li><a href="http://www.interlingua.com.mx/?cursosjovenes=kids"> Niños / Jóvenes</a></li>
					<li><a href="http://www.interlingua.com.mx/empresas-2/">Empresas</a></li>
					<li><a href="http://www.interlingua.com.mx/?cursosdiversos=market-leader">Especiales</a></li>
					<li><a href="http://www.interlingua.com.mx/f-a-q/cursos/">F.A.Q.</a></li>
				</ul>
			</div>

			<div id="menu2" class="cincocol menu-footer clearfix">
				<span class="titulos-footer">Método</span><br><br>
				<ul class="lista-footer">
					<li><a href="http://www.interlingua.com.mx/?page_id=46">Nuestro Método</a></li>
					<li><a href="http://www.interlingua.com.mx/?page_id=52">Materiales y Certificaciones</a></li>
					<li><a href="http://www.interlingua.com.mx/f-a-q/metodo/">F.A.Q.</a></li>
				</ul>
			</div>

			<div id="menu3" class="cincocol menu-footer clearfix">
				<span class="titulos-footer">Interlingua</span><br><br>
				<ul class="lista-footer">
					<li><a href="http://www.interlingua.com.mx/?page_id=296">Filosofía</a></li>
					<li><a href="http://www.interlingua.com.mx/?page_id=32">Acceso a Alumnos</a></li>
					<li><a href="http://www.interlingua.com.mx/?page_id=304">Misión y Visión</a></li>
					<li><a href="http://www.interlingua.com.mx/?page_id=38">Obtén una Franquicia</a></li>
					<li><a href="http://www.interlingua.com.mx/?page_id=372">Facturación</a></li>
					<li><a href="http://www.interlingua.com.mx/?page_id=321">Responsabilidad Social</a></li>
					<li><a href="http://www.interlingua.com.mx/f-a-q/inscripciones/">F.A.Q.</a></li>
				</ul>
			</div>
			<div id="menu4" class="cincocol menu-footer clearfix">
				<span class="titulos-footer">Contacto</span><br><br>
				<ul class="lista-footer">
					<li><a href="http://www.interlingua.com.mx/alumnos/">Alumnos</a></li>
					<li><a href="http://www.interlingua.com.mx/empresas-2/">Empresas</a></li>
					<li><a href="http://www.interlingua.com.mx/franquicias/">Franquicias</a></li>
				</ul>
			</div>		
			<div id="social-footer" class="cincocol menu-footer clearfix">
				<span class="titulos-footer">Síguenos</span><br><br>
				<ul class="footer-centrado-social wrap">
					<li class="twitter-footer">
						<a href="https://twitter.com/Interlinguamx" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/twitter.png" alt="Logo Twitter"></a>
					</li>							
					<li class="facebook-footer">
						<a href="https://www.facebook.com/interlingua.mx?fref=ts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/facebook.png" alt="Logo Facebookr"></a>
					</li>	
					<li class="google-footer">
						<a href="https://plus.google.com/u/0/102755391403241662820/posts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/google.png" alt="Logo Google Plus"></a>
					</li>							
				</ul>
			</div>
		</div>
	</div> <!-- end #inner-footer -->
</footer>

		<footer class="footer2" role="contentinfo">

			<div id="footer-interior2" class="wrap clearfix">

				<div class="color-bco h-card sixcol first clearfix">
					<span itemscope itemtype="http://schema.org/Organization">
						Línea de atención al cliente<span class="p-tel" itemprop="telephone">01 800 1INGLES (464537)</span><br>
						Centro de información Cd. de México<span class="p-tel" itemprop="telephone">500 500 50</span>
					</span>
				</div>

				<div class="color-bco h-card sixcol last clearfix">
					<span itemscope itemtype="http://schema.org/Organization">
						Línea de atención al cliente<span class="p-tel" itemprop="telephone">01 800 1INGLES (464537)</span><br>
						Centro de información Cd. de México<span class="p-tel" itemprop="telephone">500 500 50</span>
					</span>
				</div>

			</div>

		</footer>


		<?php wp_footer(); ?>

	</div> <!-- Container -->

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

	</body>


                <?php } ?>

                </html> <!-- end page. what a ride! -->

