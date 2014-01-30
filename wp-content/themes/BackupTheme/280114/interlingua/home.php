<?php get_header(); ?>

		<div class="slider-home">
			<?php putRevSlider( "home" ) ?>
		</div>

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
									                            lettersonly: true,
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
									                    jQuery("#country").html('<option value="">Elige tu estado</option>');
									                    jQuery.each(estados,function(index,value){
									                        jQuery("#country").append('<option value="'+value+'">'+value+'</option>');
									                    });                        
									                });
									                jQuery("#country").change(function(){
									                    jQuery.get("http://www.interlingua.com.mx/crm/prospects/getPlanteles/"+jQuery(this).val(),function(planteles){
									                        planteles = JSON.parse(planteles);      
									                        jQuery("#state").html('<option value="">Elige tu plantel</option>');
									                        jQuery.each(planteles,function(index,value){
									                            jQuery("#state").append('<option value="'+value+'">'+value+'</option>');
									                        });                        
									                    });
									                });

									                jQuery.get("http://www.interlingua.com.mx/crm/prospects/getEstados/",function(estados){
									                    estados = JSON.parse(estados);      
									                    jQuery("#cmbEstadosHome").html('<option value="">Elige tu estado</option>');
									                    jQuery.each(estados,function(index,value){
									                        jQuery("#cmbEstadosHome").append('<option value="'+value+'">'+value+'</option>');
									                    });                        
									                });
									                jQuery("#cmbEstadosHome").change(function(){
									                    jQuery.get("http://www.interlingua.com.mx/crm/prospects/getPlanteles/"+jQuery(this).val(),function(planteles){
									                        planteles = JSON.parse(planteles);      
									                        jQuery("#cmbSucursalesHome").html('<option value="">Elige tu plantel</option>');
									                        jQuery.each(planteles,function(index,value){
									                            jQuery("#cmbSucursalesHome").append('<option value="'+value+'">'+value+'</option>');
									                        });                        
									                    });
									                });


									                //redireccion a pagina del plantel
									               	jQuery("#state").on("change",function(){
									               		urlBase = window.location.origin+"/interlingua_sitio/faq/";

									                	jQuery.ajax({
												            type:"post",
												            url: "http://www.interlingua.com.mx/crm/prospects/getRutaPlantel?plantel="+jQuery(this).val(),
												            //data:{action:"getModel",marca:clave},
												            dataType:"json",
												            success:function(result){
												                window.location = urlBase+result.rutaPlantel;
												            }
												        });
									                });
									            });

 																	function slug(str) {
                                                                        str = str.replace(/^\s+|\s+$/g, ''); // trim
                                                                        str = str.toLowerCase();

                                                                        // remove accents, swap ñ for n, etc
                                                                        var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
                                                                        var to   = "aaaaaeeeeeiiiiooooouuuunc------";
                                                                        for (var i=0, l=from.length ; i<l ; i++) {
                                                                          str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                                                                        }

                                                                        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                                                                          .replace(/\s+/g, '-') // collapse whitespace and replace by -
                                                                          .replace(/-+/g, '-'); // collapse dashes

                                                                        return str;
                                                                      };

									        </script>

		<!-- Seccion Metodo -->	

			<div id="metodo" class="metodo-full">
				<div class="metodo-interior wrap">
					
					<div class="titulo-seccion-metodo wrap clearfix">
						Beneficios de estudiar en INTERLINGUA®
					</div>

					<div id="metodo1" class="metodo-segmento cursocol clearfix" align="center">						
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/metodo.png"?>									
						<div class="descripcion-metodo clearfix">Método de Aprendizaje</div>				
					</div>

					<div id="metodo2" class="metodo-segmento cursocol clearfix" align="center">										
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/horarios.png"?>										
						<div class="descripcion-metodo clearfix">Horarios Flexibles</div>				
					</div>

					<div id="metodo3" class="metodo-segmento cursocol clearfix" align="center">										
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/resultados.png"?>					
						<div class="descripcion-metodo clearfix">Resultados Comprobables</div>				
					</div>

					<div id="metodo4" class="metodo-segmento cursocol clearfix" align="center">										
								<img src="<?php echo get_template_directory_uri(); ?>/library/images/experiencia.png"?>						</a>				
						<div class="descripcion-metodo clearfix">Experiencia Agradable</div>				
					</div>

					<div id="boton-metodo" class="fullcol clearfix" align="center">
						<button type="button" class="boton-metodo"  onclick="location.href='http://www.interlingua.com.mx/nuestro-metodo/'">¡Conoce nuestro método!</button>
					</div>

				</div>
			</div>

		<!-- Seccion Cursos -->		

			<div id="cursos" class="cursos-full color1">
				<div class="cursos-interior wrap clearfix">
					
					<div class="titulo-seccion-cursos wrap clearfix">
						Tenemos el curso ideal para ti
					</div>

					<div id="curso1" class="curso-segmento cursocol clearfix" align="center">				
						<!-- <a href="http://dev.clicker360.com/interlingua_sitio/?cursos=intensivo" rel="nofollow">--> 
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/regulares.png"?>
						</a>				
						<div class="descripcion-curso fullcol clearfix">Regulares</div>				
					</div>

					<div id="curso2" class="curso-segmento cursocol clearfix" align="center">				
						<!-- <a href="http://dev.clicker360.com/interlingua_sitio/?cursos=intensivo" rel="nofollow">--> 
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/ninos.png"?>
						</a>				
						<div class="descripcion-curso fullcol clearfix">Niños / Jóvenes</div>				
					</div>

					<div id="curso3" class="curso-segmento cursocol clearfix" align="center">				
						<!-- <a href="http://dev.clicker360.com/interlingua_sitio/?cursos=intensivo" rel="nofollow">--> 
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/empresas.png"?>
						</a>				
						<div class="descripcion-curso fullcol clearfix">Empresas</div>				
					</div>


					<div id="curso4" class="curso-segmento cursocol clearfix" align="center">				
						<!-- <a href="http://dev.clicker360.com/interlingua_sitio/?cursos=intensivo" rel="nofollow">--> 
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/especiales.png"?>
						</a>				
						<div class="descripcion-curso fullcol clearfix">Especiales</div>				
					</div>

					<div id="boton-cursos" class="fullcol clearfix" align="center">
						<button type="button" class="boton-cursos"  onclick="location.href='http://www.interlingua.com.mx/cursosregulares/semi-intensivo/'">¡Inscríbete a uno de nuestros cursos!</button>
					</div>

				</div>
			</div>

		<!-- Seccion Test-->		

			<div id="test" class="test-full">
				<div class="test-interior wrap clearfix">

					<div class="titulo-seccion-test wrap clearfix">
						¿Qué tanto hablas inglés?
					</div>
				
					<div class="test-segmento fullcol clearfix" align="center">										
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/test.png"?>						
						<div class="descripcion-test clearfix">Te invitamos a realizar el siguiente test gratuito para que conozcas tu nivel del idioma inglés.</div>				
					</div>				

					<div id="boton-test" class="fullcol clearfix" align="center">
						<button type="button" class="boton-test"  onclick="location.href='http://www.interlingua.com.mx/?page_id=124'">¡Conoce tu nivel de inglés!</button>
					</div>

				</div>
			</div>

		<!-- Seccion Plantel-->

			<div id="planteles" class="planteles-full">
				<div class="planteles-interior wrap clearfix">
					<div class="titulo-seccion-planteles wrap clearfix">
							Encuentra tu plantel más cercano:
					</div>
					
						<div class="plantel-segmento fullcol clearfix" align="center">				
							<a href="<?php echo home_url(); ?>" rel="nofollow">
								<img src="<?php echo get_template_directory_uri(); ?>/library/images/mapa-planteles.png"?>
							</a>										
						</div>

						<div class="descripcion-planteles wrap clearfix">Te invitamos a localizar el plantel mas cercano. Visítanos y aprende inglés</div>				

						<div class="planteles-form-home wrap">
							
								<!-- <select id="estado-form-home"  name="carlist" form="carform">
								 <option value="volvo">Elige tu Estado</option>
								  <option value="estadp1">Estado de México</option>							  
								</select>	
							
								<select id="plantel-form-home" name="carlist" form="carform">
								  <option value="volvo">Elige tu Plantel</option>
								  <option value="estadp1">Satélite</option>							  
								</select>
													  		
							  	<input id="enviar-form-home" type="submit" onclick="location.href='http://dev.clicker360.com/interlingua_sitio/?page_id=56'" value="">
								-->	
													
						       <select id="country" class="country" name ="country"></select>															
						       <select name ="state" id ="state"></select>
										<br/> <br/>		
								
							  	
							  	<!-- <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country"></select>
								
								<select name ="state" id ="state"></select>-->

							</br></br>
								

							  	<!-- <input id="localiza-ubicacion" type="submit" value="Localiza mi ubicación">						 -->

						</div>

						<!-- <div class="boton-test fullcol clearfix" align="center">
							<button type="button" class="buton-home">¡Obtén una clase muestra GRATIS!</button>
						</div> -->

					</div>
			</div>

		<!-- Seccion Contacto-->

			<div id="contacto" class="contacto-full">
				<div class="trabajo-interior wrap clearfix">
					<div class="titulo-seccion-contacto wrap clearfix">
						Contáctanos y obtén una clase muestra  ¡GRATIS!
					</div>

					<div class="formulario-contacto-home wrap" align="center">
						<!--	<?php echo do_shortcode('[contact-form-7 id="129" title="contacto home"]'); ?> -->
						<div class="formulario-registro-Home wrap">

													<div id="formulario-Home">                           
							                            <form id="form1" method="post" action="http://www.interlingua.com.mx/crm/registro">
							                                <input type="hidden" name="origin_id" value="9" />
							                                <div id="nombre1Home">
							                                    <input type="text" id="txtNombreHome" name="name"  placeholder="Nombre Completo"/>
							                                </div>
							                                <div id="correo1Home">
							                                    <input type="text" id="txtCorreoHome" name="email" placeholder="Correo Electrónico"/>
							                                </div>
							                                <div id="lada1Home">
							                                    <input type="text" id="txtLadaHome" name="lada" maxlength="3" placeholder="LADA" />
							                                </div>
							                                <div id="telefono1Home">
							                                    <input type="text" id="txtTelefonoHome" name="phone_number" maxlength="8" placeholder="Teléfono" />
							                                </div>

							                                <div id="celular1Home">
							                                    <input type="text" id="txtCelularHome" name="mobile_number" maxlength="10" placeholder="Celular"/>
							                                </div>
							                                <div id="estado1Home">
							                                    <select id="cmbEstadosHome" name="estado">   
							                                    <option value="" selected="selected">Elige tu estado</option>                                     
							                                    </select>
							                                </div>						                               
							                                
							                                <div id="sucursal1Home">
							                                    <select id="cmbSucursalesHome" name="plantel">
							                                        <option value="" selected="selected">Elige tu plantel</option>
							                                    </select>
							                                </div>
							                                <input type="submit" id="btnEnviarHome" value="¡Quiero aprender inglés!" style="cursor:pointer" />
							                                <div id="politicas1Home">                                    
							                                    <input type="checkbox" id="chkPoliticasHome" name="termino" checked />
							                                    <div id="acepto1Home">
							                                        <a href="http://www.interlingua.com.mx/?page_id=71" target="_blank">Acepto las políticas de privacidad</a>
							                                    </div>
							                                </div>                                
							                            </form>
							                        </div> 

						</div>
				</div>
			</div> 

			
		<!-- Seccion Bolsa de Trabajo-->

			<div id="bolsa-trabajo" class="bolsa-trabajo-full">
				<div class="bolsa-trabajo-interior wrap clearfix">
					<div class="titulo-seccion-bolsa-trabajo wrap clearfix">
We are looking for English Teachers
					</div>
					<div class="subtitulo-seccion-bolsa-trabajo wrap clearfix">
Work in a fun and rewarding field!
					</div>
					
						<div class="bolsa-trabajo-segmento fullcol clearfix" align="center">				
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/maestros.png"?>								
						</div>

						<div class="bolsa-trabajo-segmento1 fullcol clearfix" align="center">
							<div class="descripcion-planteles wrap clearfix">Interact and network with all kinds of people while you make a significant difference in their lives. </div>
						</div>

						<div class="bolsa-trabajo-segmento2 fivecol clearfix">
							<div class="bolsa-trabajo-ofrecemos   clearfix"> </div>
						</div>

						<div class="boton-trabajo clearfix" align="center">
						<button type="button" class="boton-bolsa" onclick="location.href=' http://www.interlingua.com.mx/bolsa-de-trabajo-2/'">Join our team!</button>
					</div>
						


					</div>
			</div>



<?php get_footer(); ?>