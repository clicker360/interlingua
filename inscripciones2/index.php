<?php
    header('Location: http://www.interlingua.com.mx/buenfin');
?>
<!DOCTYPE>
<html lang="es">
<head>

  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8156648-1']);
  _gaq.push(['_setDomainName', 'interlingua.com.mx']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script>

d=document,l=d.location;

_udn = "interlingua.com.mx";

_utcp = d.location;

</script>



	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title>Interlingua - Inglés para la vida</title>
	<link href="style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Cabin:400,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Muli:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
  <link type="text/css" rel="stylesheet" href="lightbox-form.css">
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-validate.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
	
  <!-- Add fancyBox main JS and CSS files -->
  <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.4"></script>
  <link rel="stylesheet" type="text/css" href="js/jquery.fancybox.css?v=2.1.4" media="screen" />

 
  
  <script type="text/javascript">
    $(document).ready(function() {
      /*
       *  Simple image gallery. Uses default settings
       */

      $('.fancybox').fancybox({
          'width': 500,
          'height': 400,
          'autoSize': false

        });
    });
  </script>

  </head>

  


<body>


<script>


$(document).ready(function(){
$("#form1").validate({
           rules:{
               name:{
                   required: true,
                   lettersonly:true,

               },
               email:{
                   required: true,
                   email: true
               },
               lada:{
                   required: true,
                   number: true,
                   minlength: 2,
                   maxlength: 3,
               },
               phone_number:{
                   required: true,
                   number: true,
                   minlength: 7,
                   maxlength: 8,
               },
               estado:{
                   required: true
               },
               termino:{
                   required: true
               }
           },
           messages:{
               name:{
                  required: '*Ingresa tu nombre',
                  lettersonly:'*Solo letras para el nombre'
               },
               email:{
                   required: '*Ingresa tu correo electr&oacute;nico',
                   email: '*Ingresa un correo electr&oacute;nico correcto',
               },
               lada:{
                   required: '*Valida LADA',
                   number: '*Solo n&uacute;meros',
                   minlength: '*Solo 2 o 3 n&uacute;meros',
                   maxlength: '*Solo 3 o 3 n&uacute;meros',
               },
               phone_number:{
                   required: '*Valida n&uacute;mero telef&oacute;nico',
                   number: '*Solo n&uacute;meros para el tel&eacute;fono',
                   minlength: '*El tel&eacute;fono tiene que ser de 10 n&uacute;meros',
                   maxlength: '*El tel&eacute; tiene que ser de 10 n&uacute;meros',
               },
               estado:{
                   required: '*Debes seleccionar un estado'
               },
               termino:{
                   required: '*Debes aceptar términos y condiciones'
               }
           }
       });
});
</script>

	<div id="pt1"></div>

	<div id="pagewrap">

		<header>
			<div id="logo"></div>
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
			  <div id="p3"><img src="images/clasemuestra.png"></div>
				<!--<div id="p4">¡Regístrate y <strong>obtén una clase muestra GRATIS!</strong></div>-->
        <div id="p5">Inscríbete a uno de los cursos de Interlingua y obtén una herramienta para la vida</div>
				<div id="formulariodiv"> 

<!--<script>
$("#cmbEstados").change(function () {
    if($(this).val() == "0") $(this).addClass("empty");
    else $(this).removeClass("empty")
});
$("#cmbEstados").change();
</script> -->


 <!--<div id="errorestados"><span id="spEstados" style="display:none">* Requerido</span></div>-->


<input type="submit" href="registro.html" class="fancybox fancybox.iframe" id="btnEnviar" value="¡Aparta tu lugar aquí!" style="cursor:pointer" />

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
                <div id="copyright">Todos los derechos reservados © Interlingua 2013</div>
                <div id="aviso"><a href="politicas.html" target="_blank">Aviso Privacidad</a></div>

            </div>
	</footer>

</body>
</html>