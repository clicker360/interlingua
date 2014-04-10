<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ADT Contigo</title>

<link href="css/origami-receptive.css" rel="stylesheet" type="text/css" />
<link href="css/mobileSkinCJ.css" rel="stylesheet" type="text/css" />

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
  
  <script type="text/javascript">
  function checkvalue(){
	var flag=0;
	$(".fieldset").each( function() {
		if($(this).val() == ''){
			flag++
			}
	 } );
	 if(flag > 0){
		 alert("Aun faltan " +  flag + " campos por llenar");
		 return false;
		 }
		 else{ 
		 return true;
		 }
}

  
  $(document).ready(function() {
	  	$("#vervideo").click(function(e) {
	  	$('#lightbox').removeClass('hide');
		$('#videoo').removeClass('hide');
		$('<iframe id="vimeo" name="vimeo" src="http://player.vimeo.com/video/52247334?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=008FCC" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen>').appendTo('#videoo');
			})
	$("#cerrarvideo").click(function(e) {
	  	$('#lightbox').addClass('hide');
		$('#videoo').addClass('hide');
		$('#vimeo').remove();
			})
		$("#lightbox").click(function(e) {
	  	$('#lightbox').addClass('hide');
		$('#videoo').addClass('hide');
		$('#vimeo').remove();
			})
  	})
  </script>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35955506-1']);
  _gaq.push(['_setDomainName', 'adtconmigo.mx']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div class="lightbox hide" id="lightbox">
  <div class="lightcenterdiv hide"  id="videoo">
  <h3 class="first">ADT siempre listo para responder</h3>
  <a href="#null" id="cerrarvideo"><img src="images/cerrar.jpg" width="24" height="24" class="last"></a>
 </div>
</div>

<div class=" spx-1 maxwid1200px margRL-auto" >
    <div class="spx-1 BgI-1 first">
        <div class="spx-10 marg-T5px marg-L1pr first bgWh fullOnPhone alineCenter">
        <img src="images/adt-logo.gif" width="221" height="128" alt="ADT" /> 
        </div>
        <div class="spx-8 last marg-L1-5pr marg-R1-5pr fullOnPhone">
        <div class="spx-1 Bg-3 last  padd-5pr marg-T20px fullOnPhone ShwDivB10px">
          <div class="spx-1 Bg-2">
            <div class="spx-2"><h1>Para que nunca tengas que decir "si hubiera"</h1></div>		
            <form id="enviar " method="post" action="crm/registro"  onsubmit="return checkvalue();" >
              <div class="spx-1">
                <label >Nombre:</label>
                <input name="nombre" type="text" id="nombre"  class="big fieldset" alt="text"/>
              </div>			  			
              <div class="spx-1">
                <label >Teléfono:</label>
                <input name="lada" type="text" class="lada small" id="lada" maxlength="3" /> 
                <input name="telefono" type="text" class="telefono medium fieldset"  alt="num" id="telefono" maxlength="12" />
              </div>				
              <div class="spx-1">
                <label  >C.P.:</label>
                <input name="cp" type="text" id="cp"  class="big fieldset"  alt="numb"/>
              </div>
              <div class="spx-1">
                <label  >E-mail:</label>
                <input name="email" type="text" id="Email"  class="big fieldset" alt="email"/>
                </div>
              <div class="spx-1">
                <label >Servicio:</label>
                <div class="col-6  marg-L5px">
                  <label class="radio" >Residencial</label>  
                  <input name="servicio" type="radio" class="radio" id="servicio_0" value="Residencial">
                  <label class="radio" >Oficina</label>
                  <input type="radio" name="servicio" class="radio" value="radio" id="servicio_1" >
                  <label class="radio" >Comercial</label>
                  <input type="radio" name="servicio" class="radio" value="radio" id="servicio_2" >
                  </div>
                </div>
              <div class="spx-1 alineCenter">
                <button type="submit" class=" brRad-3px button marg-T10px marg-B20px">Quiero protegerme ahora</button>
              </div>
              </form>
          </div>
        </div>
         <div class="spx-1 bgWh first padd-5pr marg-T10px fullOnPhone ShwDivB10px">
          <div class="spx-1">
          <div class="spx-11 first padd-10px">
            <img src="images/icon-robo.png" width="42" height="42" alt="robo" /> 
            </div>
            <h3 class="first marg-T10px marg-L10pr">Protégete de Robos</h3>
            <div class="spx-1  padd-5pr"><p class="clear marg-T10px">Con el sistema activo, al detectarse cualquier señal de intrusión en tu hogar o negocio, de inmediato se recibirá una señal en nuestra Central de Monitoreo ADT en donde un operador verificará el evento y dará aviso a las autoridades para brindarle toda la ayuda necesaria.</p></div>
            <div class="spx-1 alineCenter"><a id="vervideo" class="radius button" href="#niull">Ver video</a></div>
          </div>
          </div>
          </div>
         <!--Monito precupado-->
    <div class="spx-8 first marg-L5pr hiddeOnPhone" style="position:relative; z-index:0;">
    <img src="images/me-robaron.png" width="342" height="546" alt="me robaron" />
    </div>
    </div>
     <div class="spx-9A bgWh  fullOnPhone marg-L5pxPh ShwDivB3px marg-T15px padd-B10px">
        <div class="spx-10 first padd-10px">
            <img src="images/icon-incendio.png" width="42" height="42" alt="protegete contra incendios" /> 
       </div>
       <h3 class="first marg-T10px">Incendio</h3>
                            <div class="spx-2 padd-LR5pr"><p class="clear marg-T20px" style="min-height:130px;">Con solo presionar un botón, ante un conato de incendio nuestra Central de Monitoreo ADT verificará el evento y contactará a la unidad de bomberos más cercana, para asistirle.</p>
                            </div>
                            <div class="spx-2 alineCenter"><a href="#" class="radius button small">Protégete ahora</a></div>
                            
  </div>
             <div class="spx-9A bgWh  fullOnPhone marg-L1-5pr marg-L5pxPh ShwDivB3px marg-T15px  padd-B10px">
        <div class="spx-10 first padd-10px">
            <img src="images/icon-medica.png" width="42" height="42" alt="protegete contra incendios" /> 
            </div>
                            <h3 class="first marg-T10px">Emergencia <br />
                            médica</h3>
                            <div class="spx-2 padd-LR5pr">
                            <p class="clear " style="min-height:130px;">Al necesitar asistencia Médica de emergencia, con solo presionar un botón, obtendrás toda la ayuda necesaria, ya que te brindamos el soporte telefónico necesario en lo que las unidades de emergencia se dirigen a tu apoyo.</p>
                            </div>
                            <div class="spx-2 alineCenter"><a href="#" class="radius button small">Protégete ahora</a></div>
                            
        </div>
             <div class="spx-9A bgWh  fullOnPhone marg-L1-5pr marg-L5pxPh ShwDivB3px marg-T15px  padd-B10px">
        <div class="spx-10 first padd-10px">
            <img src="images/icon-panico.png" width="42" height="42" alt="protegete contra incendios" /> 
            </div>
                            <h3 class="first marg-T10px">Pánico</h3>
                           <div class="spx-2 padd-LR5pr"> <p class="clear marg-T20px" style="min-height:130px;">Al recibir una señal de emergencia en nuestra Central de Monitoreo ADT, siguiendo procedimientos que aseguren el bienestar de las personas y se confirme la emergencia, notificamos de inmediato a las autoridades correspondientes.</p></div>
                            <div class="spx-2 alineCenter"><a href="#" class="radius button small">Protégete ahora</a></div>
                            
        </div>
</div>

<div class="spx-1 Bg-4 clear padd-B15px padd-T10px marg-T15px">
		<p class="padd-1em">&copy; ADT 2012 <a href="terminos.html">términos y condiciones</a></p>
	</div>
</body>
</html>
