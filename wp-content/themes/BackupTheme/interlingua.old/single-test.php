<div class="loader"><img class="img-loader" src="<?php echo get_template_directory_uri(); ?>/library/images/ajax-loader.gif"></div>
<?php
/*
Template Name: Test Online
*/
?>
<?php get_header(); ?>
<style>
	.invisible{
		display: none;
	}
    .loader{
    	background: rgba(255,255,255,0.4);
        position: fixed; 
        width: 100%;
        height: 100%;
        z-index: 9999;
        display: none;
    }
    .img-loader{
        position: absolute;
        left: 50%;
        top: 48%;
    }
</style>
<div id="content">
	<div id="inner-content" class="wrap clearfix">
		<div id="main" class="sevencol first clearfix " role="main">
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
					</header>
                <!--<div id="contenedor-curso" class="degradado-gris fullcol">-->
					<section class="entry-content wrap clearfix" itemprop="articleBody">
						<div class="planteles-formulario twelvecol clearfix ">
							<div class="titulo-contacto">Test</div>
                            <div class="subtitulo-contacto">
                                ¿Conoces tu nivel de ingl&eacute;s?
                            </div>
							<div class="descripcion-test-int">
								Registra tu nombre, correo electrónico y teléfonos, así como el plantel de tu preferencia. Una vez terminado el Test, un ejecutivo te contactará para brindarte la información necesaria para inscribirte.
							</div>
                            <div class="imagen-test-inicio">
                                <img src="http://dev.clicker360.com/interlingua_sitio/wp-content/uploads/2013/10/maestra-fondo.jpg">
                            </div>
						</div>
						
						<div class="twelvecol clearfix formulario-registro-cursos wrap">  
							<form action="http://crm.interlingua.com.mx/crm/registro" name="frmReg" id="frmReg" method="post">
                                <div style="" id="ctn-registro">
                                    <input type="hidden" name="origin_id" value="90" />
                                    <input type="hidden" name="result_examen" id="result_examen" value="" />
									<input type="hidden" name="niv_test" id="niv_test" value="" />
                                    <div id="nombre1Test"><input type="text" name="name" id="txtNombreTest" placeholder="Nombre Completo"></div>
                                    <!--<label for="email">Correo Electrónico :</label><br>-->
                                    <div id="correo1Test"><input type="text" name="email" id="txtCorreoTest" placeholder="Correo Electrónico"></div>
                                    <!--<label for="lada">LADA :</label><br>-->
                                    <div id="lada1Test"><input type="text" name="lada" id="txtLadaTest" placeholder="LADA" maxlength="3"></div>
                                    <!--<label for="phone_number">Tel&eacute;fono :</label><br>-->
                                    <div id="telefono1Test"><input type="text" name="phone_number" id="txtTelefonoTest" placeholder="Tel&eacute;fono" maxlength="8"></div>
                                    <!--<label for="mobile_number">Celular :</label><br>-->
                                    <div id="celular1Test"><input type="text" name="mobile_number" id="txtCelularTest" placeholder="Celular" maxlength="10"></div>
									<!--<label for="estado">Estado :</label><br>-->
									<div id="estado1Test"><select id="estado" name="estado">   
								   		<option value="" selected="selected">Elige tu estado</option>                                
								   	</select></div>
								   	<!--<label for="plantel">plantel :</label><br>-->
								   	<div id="sucursal1Test"><select id="plantel" name="plantel">
	                                    <option value="" selected="selected">Elige tu plantel</option>
	                                </select></div>
                                    <input type="submit" value="Enviar" id="sendtest">
                                    <div id="politicas1Test">
                                    <input type="checkbox" id="chkPoliticasCursos" name="termino" checked />
                                    <div id="acepto1Test"><a href="http://dev.clicker360.com/interlingua_sitio/?page_id=71" target="_blank">Acepto las políticas de privacidad</a></div>
									</div></div>
							</form>	
						</div>
					</section><!-- Terminaa Template Planteles -->						

					<footer class="article-footer">
						<p class="clearfix"><?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>
					</footer><!-- end article footer -->
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
		<?php get_sidebar(); ?> 
	</div> <!-- end #inner-content -->
</div> <!-- end #content -->

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

    // Vakida form de registro
    jQuery.validator.addMethod("accept", function(value, element, param) {
	  return value.match(new RegExp("." + param + "$"));
	});
    jQuery("#frmReg").validate({
        rules: {
            name: {
                required: true,
                accept: "[a-zA-Z]+"
                //lettersonly: true,
            },
            email: {
                required: true,
                email: true,
                remote: "http://crm.interlingua.com.mx/crm/prospects/checkUnique"
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
                accept: '*Solo letras para el nombre'
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
    
    // Combo de estados y planteles
    jQuery.get("http://crm.interlingua.com.mx/crm/prospects/getEstados/",function(estados){
        estados = JSON.parse(estados);      
        jQuery("#estado").html('<option value="">Elige tu estado</option>');
        jQuery.each(estados,function(index,value){
            jQuery("#estado").append('<option value="'+value+'">'+value+'</option>');
        });                        
    });
    jQuery("#estado").change(function(){
        jQuery.get("http://crm.interlingua.com.mx/crm/prospects/getPlanteles/"+jQuery(this).val(),function(planteles){
            planteles = JSON.parse(planteles);      
            jQuery("#plantel").html('<option value="">Elige tu plantel</option>');
            jQuery.each(planteles,function(index,value){
                jQuery("#plantel").append('<option value="'+value+'">'+value+'</option>');
            });                        
        });
    });

    // Section Test
    jQuery("#sendtest").on("click",function(e){
    	e.preventDefault();

    	var form = jQuery("#frmReg");
    	
    	if (form.valid()){
    		jQuery("#ctn-registro").addClass("invisible");
            jQuery(".planteles-formulario").addClass("invisible");

    		jQuery.ajax({
	            type:"post",
	            url: "http://crm.interlingua.com.mx/crm/prospects/randomQuestion",
	            //data:{action:"send",email:inptMail},
	            dataType:"json",
                beforeSend: function() {
                    jQuery(".loader").fadeIn("slow");
                },
	            success:function(data){
	            	jQuery("#ctn-registro").after(data.test);
		    		jQuery("#ctn-preguntas").hide();
		    		jQuery("#ctn-preguntas").fadeIn("slow");
                    jQuery(".loader").css("display","none");
	            }
	        });
    	}
    });

    jQuery("#sendValidate").live("click",function(e){
        e.preventDefault();
        var nivel = jQuery(this).attr("data-nivel");
        var flag = jQuery("#fla").attr("value");
        var result = new Array();
        var counter = 0;
        jQuery("input[data-sel=inpt"+nivel+"]:checked").each(function(){
            idP = jQuery(this).attr("data-id");
            resp = jQuery(this).attr("value");
            result[counter] = idP+"_"+resp;
            counter++; 
        });
        var itemVal = result.toString();
        jQuery.ajax({
            type:"post",
            url: "http://crm.interlingua.com.mx/crm/prospects/validaTest",
            data: {items:itemVal,niv:nivel,fla:flag},
            dataType:"json",
            beforeSend: function() {
                jQuery(".loader").fadeIn("slow");
            },
            success:function(data){
                if (data.option == "random"){
                    jQuery.ajax({
                        type:"post",
                        url: "http://crm.interlingua.com.mx/crm/prospects/randomQuestion",
                        data:{nivel:data.nivel,flag:data.flag},
                        dataType:"json",
                        success:function(data){
                            jQuery("#ctn-registro").after(data.test);
                            jQuery("#ctn-preguntas").hide();
                            jQuery("#ctn-preguntas").fadeIn("slow");
                            jQuery("#ctn-registro").nextAll().css("display","none");
                            jQuery("#ctn-registro").next().fadeIn("slow");
                            jQuery(".loader").css("display","none");
                        }
                    });
                }else{
               		switch (data.nivel) {
				        case -1:
				            nvl = "Preliminar";
				            break;
				        case 0:
				            nvl = "Introducci&oacute;n";
				            break;
				        
				        default:
				            nvl = data.nivel;
				            break;
				    }
                    jQuery("#result_examen").val("nivel : "+nvl);
					jQuery("#niv_test").val(data.nivel);
                    jQuery("#frmReg").submit();
                }
            }
        });
    });
});
</script>
<?php get_footer(); ?>