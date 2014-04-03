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
								
							
								
										
								<section class="entry-content  wrap clearfix" itemprop="articleBody">
									
								 <!-- end article section -->

								<!-- Comienza Template Planteles -->

								 <!-- Comienza Script Formulario -->								
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
							                            remote: "http://interlingua.clicker360.com/prospects/checkUnique"
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
							                jQuery.get("http://interlingua.clicker360.com/prospects/getEstados/",function(estados){
							                    estados = JSON.parse(estados);      
							                    jQuery("#cmbEstados").html('<option value="">Elige tu estado</option>');
							                    jQuery.each(estados,function(index,value){
							                        jQuery("#cmbEstados").append('<option value="'+value+'">'+value+'</option>');
							                    });                        
							                });
							                jQuery("#cmbEstados").change(function(){
							                    jQuery.get("http://interlingua.clicker360.com/prospects/getPlanteles/"+$(this).val(),function(planteles){
							                        planteles = JSON.parse(planteles);      
							                        jQuery("#cmbSucursales").html('<option value="">Elige tu plantel</option>');
							                        jQuery.each(planteles,function(index,value){
							                            jQuery("#cmbSucursales").append('<option value="'+value+'">'+value+'</option>');
							                        });                        
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
										

									<div class="planteles-formulario eightcol clearfix">
									<div class="encabezado-planteles">¡Encuentra aquí tu INTERLINGUA® más cercano!</div>
									<div class="descripcion-planteles-interior">Contamos con más de 60 planteles a nivel nacional.</div>
									
								<div class="formulario-planteles">										
										<select onchange="print_state('state',this.selectedIndex);" id="country" class="country" name ="country"></select>															
						        		<select onchange="window.location = '<?php echo get_bloginfo('url'); ?>/plantel/interlingua-'+slug(jQuery(this).val());" name ="state" id ="state"></select>
										<br/> <br/>					
									</div> 

								</div>

								<div class="planteles-informacion fourcol clearfix">
									<div class="nombre-plantel">
										<?php echo(types_render_field( "nombre-del-plantel", array( 'raw' => 'true'  ) ));?>
									</div>
									<div class="direccion-plantel">
										<?php echo(types_render_field( "direccion-del-plantel", array( 'raw' => 'true'  ) ));?>
									</div>
									<div class="telefono-plantel">
										<?php echo(types_render_field( "telefono-plantel", array( 'raw' => 'true'  ) ));?>										
									</div>

									<div class="correo-plantel">										
										<?php echo(types_render_field( "correo-plantel", array( 'raw' => 'true'  ) ));?>
									</div>

									<?php echo(types_render_field( "boton-plantel", array( 'class' => 'boton-contacto-plantel', 'title' => 'Contactar' ) ));?>
								</div>
								
								<div class="planteles-mapa fullcol">
									
								<div class="prueba-mapa">
										
												<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
												<script type="text/javascript">
													function initialize() {
														var latlng = new google.maps.LatLng(<?php echo(types_render_field( "longitud-mapa-plantel", array( 'raw' => 'true'  ) ));?>, <?php echo(types_render_field( "latitud-mapa-plantel", array( 'raw' => 'true'  ) ));?>);
														var settings = {
															zoom: 15,
															center: latlng,
															mapTypeControl: true,
															mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
															navigationControl: true,
															navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
															mapTypeId: google.maps.MapTypeId.ROADMAP};
														var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
														var contentString = '<div id="contentido-formulario-">'+
															'<div id="siteNotice">'+
															'</div>'+
															'<h2 id="firstHeading" class="firstHeading"><?php echo(types_render_field( "nombre-del-plantel", array( 'raw' => 'true'  ) ));?></h2>'+
															'<div id="bodyContent">'+
															'<div id="formulariodiv">'+
																 '<form id="form1" method="post" action="http://interlingua.clicker360.com/registro">'+
									                                '<input type="hidden" name="origin_id" value="15" />'+
									                                '<div id="nombre1">'+
									                                    '<input type="text" id="txtNombre" name="name"  placeholder="Nombre Completo"/>'+
									                                '</div>'+
									                                '<div id="correo1">'+
									                                    '<input type="text" id="txtCorreo" name="email" placeholder="Correo Electrónico"/>'+
									                                '</div>'+									                                
									                                '<div id="telefono1">'+
									                                    '<input type="text" id="txtTelefono" name="phone_number" maxlength="8" placeholder="Teléfono" />'+
									                                '</div>'+
									                                '<div id="celular1">'+
									                                    '<input type="text" id="txtCelular" name="mobile_number" maxlength="10" placeholder="Celular"/>'+
									                                '</div>'+
									                               // '<div id="estado1">'+
									                               //     '<select id="cmbEstados" name="estado">'+
									                                //    	 '<option value="" selected="selected">Elige tu Estado</option>'+									                                       
									                               //     '</select>'+
									                               // '</div>'+
									                              //  '<div id="sucursal1">'+
									                                //    '<select id="cmbSucursales" name="plantel">'+
									                               //         '<option value="" selected="selected">Elige tu plantel</option>'+
									                               //     '</select>'+
									                            //    '</div>'+
									                                '<input type="submit" id="btnEnviar" value="¡Quiero aprender inglés!" style="cursor:pointer" />'+
									                                '<div id="politicas1">'+									                                    
									                                    '<input type="checkbox" id="chkPoliticas" name="termino" checked />'+
									                                    '<div id="acepto1">'+
									                                        '<a href="http://dev.clicker360.com/interlingua_sitio/?page_id=71" target="_blank">Acepto las políticas de privacidad</a>'+
									                                    '</div>'+
									                                '</div>'+					                                
									                            '</form>'+
									                        '</div>'+ 
															'</div>'+
															'<br>'+ 
															'<br>'+
															'<br>'+
															'</div>';
														var infowindow = new google.maps.InfoWindow({
															content: contentString
														});
														var infowindow = new google.maps.InfoWindow({
															content: contentString
														});
														
														var companyImage = new google.maps.MarkerImage('<?php echo(types_render_field( "imagen-marcador-mapa", array( 'raw' => 'true'  ) ));?>',
															new google.maps.Size(200,100),
															new google.maps.Point(0,0),
															new google.maps.Point(50,50)
														);

														var companyShadow = new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/library/images/logo_shadow.png',
															new google.maps.Size(130,50),
															new google.maps.Point(0,0),
															new google.maps.Point(65, 50));

														var companyPos = new google.maps.LatLng(<?php echo(types_render_field( "longitud-mapa-plantel", array( 'raw' => 'true'  ) ));?>, <?php echo(types_render_field( "latitud-mapa-plantel", array( 'raw' => 'true'  ) ));?>);

														var companyMarker = new google.maps.Marker({
															position: companyPos,
															map: map,
															icon: companyImage,
															shadow: companyShadow,
															title:"Interlingua",
															zIndex: 3});
														
														google.maps.event.addListener(companyMarker, 'click', function() {
															infowindow.open(map,companyMarker);

														});
													}</script>
											</head>
											<body onload="initialize()">
												<div id="map_canvas" style="width:100%; height:700px"></div>
											</body>
								</div>

								

								

								</section>
								<!-- Terminaa Template Planteles -->							


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


