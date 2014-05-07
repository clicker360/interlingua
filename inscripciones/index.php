<?php
    //header('Location: http://www.interlingua.com.mx/buenfin');
?>
<!DOCTYPE>
<html lang="es">
    <head>
	<!-- Google Analytics Content Experiment code, A/B testing 2 [Cursos Regulares] -->

	<script>
	d = document, l = d.location;
	_udn = "interlingua.com.mx";
	_utcp = d.location;
	</script>

	<script>function utmx_section(){}function utmx(){}(function(){var
	k='16424260-2',d=document,l=d.location,c=d.cookie;
	if(l.search.indexOf('utm_expid='+k)>0)return;
	function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
	indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
	length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
	'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
	'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
	'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
	valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
	'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
	</script><script>utmx('url','A/B');</script>

	<!-- End of Google Analytics Content Experiment code, A/B testing 2 [Cursos Regulares] -->

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-8156648-1']);
            _gaq.push(['_setDomainName', 'interlingua.com.mx']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>

        <script>

            d = document, l = d.location;

            _udn = "interlingua.com.mx";

            _utcp = d.location;

        </script>



        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Interlingua</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Cabin:400,400italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Muli:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-validate.min.js"></script>
        <script type="text/javascript" src="js/additional-methods.js"></script>
    </head>




    <body>


        <script>


            $(document).ready(function() {
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


                /* Form */
                $("#form1").submit(function( event ){

                    if ($(this).valid()){
                        $("input:text,select").each(function(){
                            $(this).prop('readonly', true);
                        });

                        $("input:submit").prop('disabled', true);
                    }else{
                        event.preventDefault();
                    }
                });              


                $("#form1").validate({
                    rules: {
                        name: {
                            required: true,
                            lettersonly: true,
                        },
                        email: {
                            required: true,
                            email: true,
                            remote: "http://www.interlingua.com.mx/crm/prospects/checkUnique"  
                        },
                        lada: {
                              required: {
                                depends: function(element) {
                                    var telefono = $("#txtTelefono").val();
                                    if (telefono != "") {
                                        return true
                                    }else {
                                        return false
                                    }
                                }
                            },
                            number: true,
                            minlength: 2,
                            maxlength: 3,
                        },
                        phone_number: {
                            required: {
                                depends: function(element) {
                                    var telefono = $("#txtTelefono").val();
                                    var celular  = $("#txtCelular").val();
                                    if (telefono === "" && celular === "") {
                                        return true
                                    }else {
                                        return false
                                    }
                                }
                            },
                            number: true,
                            minlength: 7,
                            maxlength: 8,
                        },
                        mobile_number: {
                            required: false,
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
                            required: '*Ingresa tel&eacute;fono o celular',
                            number: '*Solo n&uacute;meros para el tel&eacute;fono',
                            minlength: '*El tel&eacute;fono tiene que ser de 10 n&uacute;meros',
                            maxlength: '*El tel&eacute; tiene que ser de 10 n&uacute;meros',
                        },
                        mobile_number: {
                            required: '*Valida n&uacute;mero celular',
                            number: '*Solo n&uacute;meros para el celular',
                            minlength: '*El tel&eacute;fono celular tiene que ser de 10 n&uacute;meros',
                            maxlength: '*El tel&eacute;fono celular tiene que ser de 10 n&uacute;meros'
                        },
                        estado: {
                            required: '*Debes seleccionar un estado'
                        },
                        plantel: {
                            required: '*Debes seleccionar un plantel'
                        },
                        termino: {
                            required: '*Debes aceptar términos y condiciones'
                        }
                    }
                });
                $.get("http://interlingua.clicker360.com/prospects/getEstados/",function(estados){
                    estados = JSON.parse(estados);      
                    $("#cmbEstados").html('<option value="">Elige tu estado</option>');
                    $.each(estados,function(index,value){
                        $("#cmbEstados").append('<option value="'+value+'">'+value+'</option>');
                    });                        
                });
                $("#cmbEstados").change(function(){
                    $.get("http://interlingua.clicker360.com/prospects/getPlanteles/"+$(this).val(),function(planteles){
                        planteles = JSON.parse(planteles);      
                        $("#cmbSucursales").html('<option value="">Elige tu plantel</option>');
                        $.each(planteles,function(index,value){
                            $("#cmbSucursales").append('<option value="'+value+'">'+value+'</option>');
                        });                        
                    });
                });
            });
        </script>

        <div id="pt1"></div>

        <div id="pagewrap">

            <header>
                <a href="http://www.interlingua.com.mx/"><div id="logo"></div></a>
                <div id="linea1">Línea de atención al cliente <strong>01 800 1 INGLÉS  (464537)</strong></div>
                <div id="linea2">Centro de información Cd. de México<strong> 500 500 50</strong></div>
            </header>

            <div id="contenido">
                <div id="wrap">
                    <section>
                        <div id="slogan">
                            <div id="slogantext"><strong>"Mis clases de inglés en INTERLINGUA me abrieron las puertas a muchas posibilidades de crecimiento laboral"</strong></div>
                            <div id="sloganfirma"><strong>Mariana González</strong></div>
                        </div>
                    </section>

                    <aside id="sidebar">	
                        <div id="p3">No dejes pasar la oportunidad</div>
                        <div id="p4">¡Regístrate y <strong>obtén una clase muestra GRATIS!</strong></div>
                        <div id="formulariodiv"> 



                            <form id="form1" method="post" action="http://www.interlingua.com.mx/crm/registro">
                            <!--<form id="form1" method="post" action="../crm/registro">-->
                                <input type="hidden" name="origin_id" value="3" />
                                <input type="hidden" name="gclid" id="gclid" value="<?php echo $_GET['gclid']?>">
                                <input type="hidden" name="medio" id="medio" value="<?php echo $_GET['M']?>">
                                <input type="hidden" name="micrositio" id="micrositio" value="/inscripciones">

                                <div id="nombre1">
                                    <input type="text" id="txtNombre" name="name"  placeholder="Nombre Completo"/>
                                </div>

                                <div id="correo1">
                                    <input type="text" id="txtCorreo" name="email" placeholder="Correo Electrónico"/>
                                </div>

                                <div id="lada1">
                                    <input type="text" id="txtLada" name="lada" maxlength="3" placeholder="LADA" />
                                </div>

                                <div id="telefono1">
                                    <input type="text" id="txtTelefono" name="phone_number" maxlength="8" placeholder="Teléfono" />
                                </div>
			<div id="celular1">
                                    <input type="text" id="txtCelular" name="mobile_number"   maxlength="10" placeholder="Celular"/>
                                </div>
                                <div id="estado1">
                                    <select id="cmbEstados" name="estado">
                                        <!--<option value="" selected="selected">Elige tu estado</option>
                                        <option value="Aguascalientes">Aguascalientes</option>
                                        <option value="Baja California">Baja California</option>
                                        <option value="Baja California Sur">Baja California Sur</option>
                                        <option value="Campeche">Campeche</option>
                                        <option value="Coahuila">Coahuila</option>
                                        <option value="Colima">Colima</option>
                                        <option value="Chiapas">Chiapas</option>
                                        <option value="Chihuahua">Chihuahua</option>
                                        <option value="Distrito Federal">Distrito Federal</option>
                                        <option value="Durango">Durango</option>
                                        <option value="Guanajuato">Guanajuato</option>
                                        <option value="Guerrero">Guerrero</option>
                                        <option value="Hidalgo">Hidalgo</option>
                                        <option value="Jalisco">Jalisco</option>
                                        <option value="Estado de México">Estado de México</option>
                                        <option value="Michoacán">Michoacán</option>
                                        <option value="Morelos">Morelos</option>
                                        <option value="Nayarit">Nayarit</option>
                                        <option value="Nuevo León">Nuevo León</option>
                                        <option value="Oaxaca">Oaxaca</option>
                                        <option value="Puebla">Puebla</option>
                                        <option value="Querétaro">Querétaro</option>
                                        <option value="Quintana Roo">Quintana Roo</option>
                                        <option value="San Luis Potosí">San Luis Potosí</option>
                                        <option value="Sinaloa">Sinaloa</option>
                                        <option value="Sonora">Sonora</option>
                                        <option value="Tabasco">Tabasco</option>
                                        <option value="Tamaulipas">Tamaulipas</option>
                                        <option value="Tlaxcala">Tlaxcala</option>
                                        <option value="Veracruz">Veracruz</option>
                                        <option value="Yucatán">Yucatán</option>
                                        <option value="Zacatecas">Zacatecas</option>-->
                                    </select>
                                </div>
                                <!--<div id="lada2">
                                    <input type="text" id="txtLada2" name="lada2" maxlength="3" placeholder="LADA" />
                                </div>-->
                                
                                <div id="sucursal1">
                                    <select id="cmbSucursales" name="plantel">
                                        <option value="" selected="selected">Elige tu plantel</option>
                                    </select>
                                </div>

                                <!--<script>
                                $("#cmbEstados").change(function () {
                                    if($(this).val() == "0") $(this).addClass("empty");
                                    else $(this).removeClass("empty")
                                });
                                $("#cmbEstados").change();
                                </script> -->


                                <!--<div id="errorestados"><span id="spEstados" style="display:none">* Requerido</span></div>-->


                                <input type="submit" id="btnEnviar" value="¡Quiero aprender inglés!" style="cursor:pointer" />

                                <div id="politicas1">
                                    <!--<div id="acepto1"><a href="politicas.html" target="_blank">Acepto las políticas de privacidad</a></div>-->
                                    <input type="checkbox" id="chkPoliticas" name="termino" checked ></input>
                                    <div id="acepto1">
                                        <a href="politicas.html" target="_blank">Acepto las políticas de privacidad</a>
                                    </div>
                                </div>

                                <!--<div id="politicas"> 
                                
                                <input type="checkbox" id="chkPoliticas" name="terminos" checked/> <a href="politicas.html" target="_blank">Acepto las políticas de privacidad</a>-->


                        </div>



                        </form>
                </div> 

            </div> 	 
        </aside>
        <div id="contenido1">
            <div id="sombra"></div>   
            <div id="lista1">
                <ul class="ok">
                    <li>Vuélvete bilingüe en 1 año</li>
                    <li>Cursos de lunes a viernes, sabatinos y dominicales</li>
                    <li>Estudia 1 hora diaria</li>
                    <li>Práctica oral desde del primer día</li>
                </ul>
            </div>

            <div id="lista2">
                <ul class="ok">
                    <li>Clases con 2 profesores diferentes</li>
                    <li>Aplicación del examen TOEIC® al final del curso</li>
                    <li>Material didáctico incluido </li>
                    <li>Certificación SEP</li>
                </ul>
            </div>
            <div id="social">
                <div id="interlingua"><a href="http://www.interlingua.com.mx" target="_blank"><img src="images/interlingua.png" width="33" height="33"></a></div>
                <div id="facebook"><a href="https://www.facebook.com/interlingua.mx?fref=ts" target="_blank"><img src="images/facebook.png" width="33" height="33"></a></div>
                <div id="twitter"><a href="https://twitter.com/Interlinguamx" target="_blank"><img src="images/twitter.png" width="33" height="33"></a></div>
            </div>

        </div>

        <footer>

            <div id="pie">
                <div id="copyright">Todos los derechos reservados © Interlingua 2014</div>
                <div id="aviso"><a href="politicas.html" target="_blank">Aviso Privacidad</a></div>

            </div>
        </footer>
	
	<script type="text/javascript">
	function setCookie(name, value, days){
	    var date = new Date();
	    date.setTime(date.getTime() + (days*24*60*60*1000)); 
	    var expires = "; expires=" + date.toGMTString();
	    document.cookie = name + "=" + value + expires;
	}
	function getParam(p){
	    var match = RegExp('[?&]' + p + '=([^&]*)').exec(window.location.search);
	    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
	}
	var gclid = getParam('gclid');
	if(gclid){
	    var gclsrc = getParam('gclsrc');
	    if(!gclsrc || gclsrc.indexOf('aw') !== -1){
		    setCookie('gclid', gclid, 90);
		}
	}
	</script> 

    <script type="text/javascript">
    setTimeout(function(){var a=document.createElement("script");
    var b=document.getElementsByTagName("script")[0];
    a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0021/1455.js?"+Math.floor(new Date().getTime()/3600000);
    a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
    </script>
</body>
</html>
