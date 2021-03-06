<?php
/*
Template Name: Pagina Cursos
*/
?>

<?php get_header(); ?>
		
		<style>
			.tablahorarios {
				border:8px #33b0be solid;
				font-family: 'Myriad Pro', Arial, Helvetica, sans-serif;
				box-shadow:#000;
				padding: 5px;
				-webkit-box-shadow: 2px 2px 5px rgba(50, 50, 50, 0.39);
				-moz-box-shadow:    2px 2px 5px rgba(50, 50, 50, 0.39);
				box-shadow:         2px 2px 5px rgba(50, 50, 50, 0.39);
				width: 100%;
			 }
			#tablita>tr:nth-child(odd) {background: #efefef;}
			.texto{
				font-family: 'Myriad Pro', Arial, Helvetica, sans-serif;
				font-size:18px;
				font-weight:bold;
				color:#33b0be;
			}
		</style>
		<?php
			// Get Horarios Plantel
			$idHorarios = types_render_field( "id-horarios", array( "raw" => "true"  ) );
			$tabla_horarios= '<div id="myModal" class="reveal-modal"><p class="texto">Plantel '.$idHorarios.'</p><table  border="0" cellpadding="0" cellspacing="0" class="tablahorarios">';
			$data = wp_excel_cms_get("horarios");
			$tabla_horarios.='<thead class="texto" valign="middle">
						          <th align="center">Curso</th>
								  <th align="center">Precio de contado</th>
							 	  <th align="center">Pagos parciales</th>
								  <th align="center">Horario</th>
							  <thead>
							  <tbody id="tablita">
								';
			if($idHorarios != ""){
				$restricciones = "";
				foreach($data as $horario){
					$tabla_horarios.="<tr>";
					$cont = 0;
					foreach ($horario as $key => $value) {
						if($horario[0]==$idHorarios && $value != ""){
							if($value != $idHorarios && $cont <= 4){
								if($cont == 2 || $cont == 3 && strstr($value, '$')==""){
									$value = "$ ".$value;
								}
								
								$tabla_horarios.="<td align='center'>".$value."</td>";
							}	
						
							if($horario[5] != "" && $cont == 5){
								$restricciones.=$value."<br>";
							}
						
						}
						$cont++;
					}
					$tabla_horarios.="</tr>";
				}
			}else{
				$tabla_horarios.="<tr><td colspan='4' align='center'><h3>No hay horarios disponibles para esta sucursal</h3></td></tr>";
			}
			$tabla_horarios.='</tbody></table><p class="texto">'.$restricciones.'</p><a class="close-reveal-modal">&#215;</a></div>';

			echo $tabla_horarios;

		?>
			
		
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
							                 var normalize = (function() {
									  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
									      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
									      mapping = {};
									
									  for(var i = 0, j = from.length; i < j; i++ )
									      mapping[ from.charAt( i ) ] = to.charAt( i );
									
									  return function( str ) {
									      var ret = [];
									      for( var i = 0, j = str.length; i < j; i++ ) {
										  var c = str.charAt( i );
										  if( mapping.hasOwnProperty( str.charAt( i ) ) )
										      ret.push( mapping[ c ] );
										  else
										      ret.push( c );
									      }
									      return ret.join( '' );
									  }
									
									})();
							                jQuery.get("http://www.interlingua.com.mx/crm/prospects/getEstados/",function(estados){
							                    estados = JSON.parse(estados);      
							                    jQuery("#country").html('<option value="">Elige tu estado</option>');
							                    jQuery.each(estados,function(index,value){
							                        jQuery("#country").append('<option value="'+value+'">'+value+'</option>');
							                    });                        
							                });
							                jQuery("#country").change(function(){							           
							                	edoSel = jQuery(this).val();
							                    jQuery.get("http://www.interlingua.com.mx/crm/prospects/getPlanteles/"+edoSel,function(planteles){
							                        planteles = JSON.parse(planteles); 
							                        jQuery("#state").html('<option value="">Elige tu plantel</option>');
							                        jQuery.each(planteles,function(index,value){
										    var valor_scape = normalize(value);
							                            jQuery("#state").append('<option value="'+valor_scape+'">'+value+'</option>');
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
										

									<div class="planteles-formulario eightcol clearfix">
									<div class="encabezado-planteles">¡Encuentra aquí tu INTERLINGUA® más cercano!</div>
									<div class="descripcion-planteles-interior">Contamos con más de 60 planteles a nivel nacional.</div>
									
								<div class="formulario-planteles">										
										<select  id="country" class="country" name ="country"></select>															
						        		<select  name ="state" id ="state"></select>
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

									<!--<?php echo(types_render_field( "boton-plantel", array( 'class' => 'boton-contacto-plantel', 'title' => 'Contactar' ) ));?> -->
									<br>
									<a href="#" style="padding:5px;font-size:15px;"  id="btnMod" data-reveal-id="myModal">Consulta los precios y horarios</a>
								</div>
								
								<div class="planteles-mapa fullcol">


								<?php 
									//selecciona origen de form
									$cursoReg = (types_render_field( "nombre-del-plantel", array( 'raw' => 'true'  ) ));
									switch ($cursoReg) {
										case 'INTERLINGUA® Aguascalientes':
											$origen = "29";
											$plantel = "Aguascalientes";
											break;
										case 'INTERLINGUA® Interlingua Tijuana, B.C.':
											$origen = "30";
											$plantel = "Tijuana";
											break;
										case 'INTERLINGUA® Campeche':
											$origen = "31";
											$plantel = "Campeche";
											break;
										case 'INTERLINGUA® Cd. del Carmen':
											$origen = "32";
											$plantel = "Cd. Del Carmen";
											break;
										case 'INTERLINGUA® Cd. Juarez, Chih.':
											$origen = "33";
											$plantel = "Cd. Juárez";
											break;
										case 'INTERLINGUA® Torreón Rincon La Rosita':
											$origen = "34";
											$plantel = "Rincón La Rosita";
											break;
										case 'INTERLINGUA® Bosque de las Lomas':
											$origen = "35";
											$plantel = "Bosques de las Lomas";
											break;
										case 'INTERLINGUA® Dakota 95-WTC ':
											$origen = "36";
											$plantel = "Dakota 95";
											break;
										case 'INTERLINGUA® El Rosario':
											$origen = "37";
											$plantel = "El Rosario";
											break;
										case 'INTERLINGUA® Fórum Buenavista':
											$origen = "38";
											$plantel = "Fórum Buenavista";
											break;
										case 'INTERLINGUA® Gran Sur':
											$origen = "39";
											$plantel = "Gran Sur";
											break;
										case 'INTERLINGUA® Jardin Balbuena':
											$origen = "40";
											$plantel = "Jardín Balbuena";
											break;
										case 'INTERLINGUA® Lindavista':
											$origen = "41";
											$plantel = "Lindavista";
											break;
										case 'INTERLINGUA® Zona Rosa':
											$origen = "42";
											$plantel = "Miramontes";
											break; 
										case 'INTERLINGUA® Parques Polanco':
											$origen = "43";
											$plantel = "Parques Polanco";
											break; 
										case 'INTERLINGUA® Picacho-Pedregal':
											$origen = "44";
											$plantel = "Picacho, Pedregal";
											break;
										case 'INTERLINGUA® Plaza Oriente':
											$origen = "45";
											$plantel = "Plaza Oriente";
											break;
										case 'INTERLINGUA® Plaza Polanco':
											$origen = "46";
											$plantel = "Plaza Polanco";
											break;
										case ' INTERLINGUA® Plaza Universidad':
											$origen = "47";
											$plantel = "Plaza Universidad";
											break;
										case 'INTERLINGUA® Puerta Alameda':
											$origen = "48";
											$plantel = "Puerta Alameda";
											break;
										case 'INTERLINGUA® Zona Rosa':
											$origen = "49";
											$plantel = "Zona Rosa";
											break;
										case 'INTERLINGUA® Atizapán':
											$origen = "50";
											$plantel = "Atizapán";
											break;
										case 'INTERLINGUA® Coacalco':
											$origen = "51";
											$plantel = "Coacalco";
											break;
										case 'INTERLINGUA® Cuautitlán Izcalli':
											$origen = "52";
											$plantel = "Cuautitlán Izcalli";
											break;
										case 'INTERLINGUA® Ecatépec':
											$origen = "53";
											$plantel = "Ecatepec";
											break;
										case 'INTERLINGUA® Interlomas':
											$origen = "54";
											$plantel = "Interlomas";
											break;
										case 'INTERLINGUA® Ixtapaluca Edo. de México.':
											$origen = "55";
											$plantel = "Ixtapaluca";
											break;
										case 'INTERLINGUA® Metepec':
											$origen = "56";
											$plantel = "Metepec";
											break;
										case 'INTERLINGUA® Nezahualcóyotl':
											$origen = "57";
											$plantel = "Nezahualcoyotl";
											break;
										case 'INTERLINGUA® Nicolás Romero':
											$origen = "58";
											$plantel = "Nicolás Romero";
											break;
										case 'INTERLINGUA® Patio Ecatepec':
											$origen = "59";
											$plantel = "Patio Ecatepec";
											break;
										case 'INTERLINGUA® Satélite':
											$origen = "60";
											$plantel = "Satélite";
											break;
										case 'INTERLINGUA® Tecamac':
											$origen = "61";
											$plantel = "Tecámac";
											break;
										case 'INTERLINGUA® Texcoco':
											$origen = "62";
											$plantel = "Texcoco";
											break;
										case 'INTERLINGUA® Tlanepantla':
											$origen = "63";
											$plantel = "Tlalnepantla";
											break;
										case 'INTERLINGUA® Toluca':
											$origen = "64";
											$plantel = "Toluca";
											break;
										case 'INTERLINGUA® Irapuato, Gto.':
											$origen = "65";
											$plantel = "Irapuato";
											break;
										case 'INTERLINGUA® Pachuca, Hgo.':
											$origen = "66";
											$plantel = "Pachuca";
											break;
										case 'INTERLINGUA® Tula, Hgo.':
											$origen = "67";
											$plantel = "Tula";
											break;
										case 'INTERLINGUA® Tulancingo, Hgo.':
											$origen = "68";
											$plantel = "Tulancingo";
											break;
										case 'INTERLINGUA® Guadalajara Av. México':
											$origen = "69";
											$plantel = "Av. México";
											break;
										case 'INTERLINGUA® Guadalajara Centro Sur':
											$origen = "70";
											$plantel = "Centro Sur";
											break;
										case 'INTERLINGUA® Morelia':
											$origen = "71";
											$plantel = "Morelia";
											break;
										case 'INTERLINGUA® Cuernavaca, Mor.':
											$origen = "72";
											$plantel = "Cuernavaca";
											break;
										case 'INTERLINGUA® Monterrey Chapultepec':
											$origen = "73";
											$plantel = "Chapultepec";
											break;
										case 'INTERLINGUA® Monterrey Linda Vista':
											$origen = "74";
											$plantel = "Monterrey Linda Vista";
											break;
										case 'INTERLINGUA® Sendero':
											$origen = "75";
											$plantel = "Sendero";
											break;
										case 'INTERLINGUA® Huexotitla':
											$origen = "76";
											$plantel = "Huexotitla";
											break;	
										case 'INTERLINGUA® La Paz':
											$origen = "77";
											$plantel = "La Paz";
											break;	
										case 'INTERLINGUA® Querétaro':
											$origen = "78";		
											$plantel = "Querétaro";
											break;
										case 'INTERLINGUA® Cancún, QR':
											$origen = "79";
											$plantel = "Cancún";
											break;
										case 'INTERLINGUA® Rio Verde S.L.P.':
											$origen = "80";
											$plantel = "Rioverde";
											break;
										case 'INTERLINGUA® San Luis Potosi':
											$origen = "81";
											$plantel = "San Luis Potosí";
											break;
										case 'INTERLINGUA® Culiacan, Sin.':
											$origen = "82";
											$plantel = "Culiacán";
											break;
										case 'INTERLINGUA® Hermosillo Satélite':
											$origen = "83";
											$plantel = "Hermosillo";
											break;
										case 'INTERLINGUA® Villahermosa, Tab.':
											$origen = "84";
											$plantel = "Villahermosa";
											break;
										case 'INTERLINGUA® Orizaba':
											$origen = "85";
											$plantel = "Orizaba";
											break;
										case 'INTERLINGUA® Sendero':
											$origen = "86";
											$plantel = "Poza Rica";
											break;
										case 'INTERLINGUA® Veracruz, Ver.':
											$origen = "87";
											$plantel = "Veracruz";
											break;
										case 'INTERLINGUA® Mérida Zona Macroplaza, Yuc.':
											$origen = "88";
											$plantel = "Zona Macroplaza";
											break;
										case 'INTERLINGUA® Mérica Zona Dorada, Yuc.':
											$origen = "89";
											$plantel = "Zona Dorada";
											break;
											
										default:
											# code...
											break;
									}
								?>
									
								<div class="prueba-mapa">			
									<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
									<script type="text/javascript">
										function initialize() {
											var latlng = new google.maps.LatLng(<?php echo(types_render_field( "longitud-mapa-plantel", array( 'raw' => 'true'  ) ));?>, <?php echo(types_render_field( "latitud-mapa-plantel", array( 'raw' => 'true'  ) ));?>);
											var latlngAlter = new google.maps.LatLng(<?php echo(types_render_field( "longitud-mapa-plantel", array( 'raw' => 'true'  ) ))+0.007;?>, <?php echo(types_render_field( "latitud-mapa-plantel", array( 'raw' => 'true'  ) ));?>);	
											var settings = {
												zoom: 15,
												center: latlngAlter,
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
													 '<form id="form1" method="post" action="http://www.interlingua.com.mx/crm/registro">'+
						                                '<input type="hidden" name="origin_id" value="<?php echo $origen;?>" />'+
						                                '<input type="hidden" name="plantel" value="<?php echo $plantel;?>" />'+
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
						                                        '<a href="http://www.interlingua.com.mx/politicas-de-privacidad/" target="_blank">Acepto las políticas de privacidad</a>'+
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
											
												infowindow.open(map,companyMarker);

											/*google.maps.event.addListener(companyMarker, 'click', function() {
												infowindow.open(map,companyMarker);

											});*/
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


