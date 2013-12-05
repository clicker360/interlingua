$(document).ready(function(){

    // Acción para guardar en AS400 //
    $( "#frm_nacimiento" ).datepicker({
        showButtonPanel : true,
        dayNames        : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesMin     : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        dayNamesShort   : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames      : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        closeText       : 'Listo',
        currentText     : 'Hoy',
        dateFormat      : 'yymmdd',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"        
    });
    $( "#frm_rfcfecha" ).datepicker({
        showButtonPanel : true,
        dayNames        : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesMin     : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        dayNamesShort   : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames      : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        closeText       : 'Listo',
        currentText     : 'Hoy',
        dateFormat      : 'ymmdd',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+100"     
    });
    var guardar_as400 = false;
    $(".statusName").each(function(){
        var status = $(this).text();
        if (status == "Interesado en visitar" || status == "Cita programada"){
            //alert("Guarda en AS400");
            guardar_as400 = true;
        }
    });
    if (guardar_as400){
        var verifySaveAS400 = $("#verifySave").val();
        if (verifySaveAS400 == 0){  
            $("#btn-as400").html('<a style="text-decoration:none;border:0px;color:white;background:#EB7126;padding:7px;font-size:14px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;font-weight:bold;cursor:pointer;" id="btnSaveAS400" data-reveal-id="myModal">Guardar en AS400</a>');
            $("#btnSaveAS400").live("click", function(e){
                e.preventDefault();
                
                // Modal Save AS400
                var params = {
                    name : $("#prospect_name").val(),
                    apellido_paterno : $("#prospect_ap_paterno").val(),
                    apellido_materno : $("#prospect_ap_materno").val(),
                    email : $("#prospect_email").val(),
                    lada : $("#prospect_lada").val(),
                    telefono : $("#prospect_phone_number").val(),
                    celular : $("#prospect_mobile_number").val(),
                    medio_contacto : $("#prospect_medio_contacto").val(),
                    medio_publibidad : $("#prospect_medio_publicidad").val(),
                    fecha_nacimiento : $("#prospect_fecha_nacimiento").val(),
                    clave_AS400 : $("#prospect_as400").val(),
                    fecha_cita : $("#prospects_fecha_cita").val(),
                    plantel : $("#prospPlantel").val(),
                    estado : $("#propsEdo").val()
                };

                // Load datos a modal
                $("#frm_nombre").val(params.name);
                $("#frm_apmat").val(params.apellido_materno);
                $("#frm_appat").val(params.apellido_paterno);
                $("#frm_estado").val(params.estado);
                $("#frm_localidad").val(params.plantel);
                $("#frm_lada").val(params.lada);
                $("#frm_telefono").val(params.telefono);
                $("#frm_email").val(params.email);
                $("#frm_fax").val(params.celular);
                fecha_format = params.fecha_nacimiento.split("-");
                $("#frm_nacimiento").val(fecha_format[2]+fecha_format[1]+fecha_format[0]);

                // Save AS400
                $("#savefrmmodal").live("click",function(e){
                    e.preventDefault();

                    $.ajax({
                        type:"post",
                        url: "http://localhost/www/interlingua/crm/prospects/saveAS400", //cambiar url
                        data: $("#frm_mo").serialize(),
                        dataType:"json",
                        error:function(){
                            alert("Error, por favor intentalo mas tarde.");
                        },
                        success:function(data){
                            if (data.error){
                                $("#frm_mo").find("input[type=text],select").css( "border", "" );
                                $.each(data.focus, function( index, value ) {
                                    $("#"+value).css({
                                        "border":"1px solid #DD4B39"
                                    });
                                });
                                $("#msj_error").html(data.mensaje);
                                $("#msj_error").fadeIn("slow");
                            }else{
                                $("#frm_mo").find("input[type=text],select").css( "border", "" );
                                //$("#msj_error").html(data.mensaje);
                                //$("#msj_error").fadeIn("slow");
                                // Save CRM True -> Save AS400
                                var params = {
                                     'data[Prospect][id]': $('#prospect_id').val(),
                                     'data[Prospect][save_AS400]': '1'
                                };
                                $.post(
                                    Crm.basePath+'store-prospect-ajax',
                                    params,
                                    function(data){
                                        $('#store_prospect_message').html(data);
                                    },
                                    ''
                                );
                                alert("El prospecto se registro correctamente en el sistema AS400");
                                console.log(data.mat);
                                window.location=data.mensaje;
                            }
                        }
                    });
                });
            });   
        }
    }

    //$('#ProspectStoreProspectForm').validate();
    // Configuration of datepickers
    $( "#prospects_fecha_cita" ).datepicker({
        showButtonPanel : true,
        dayNames        : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesMin     : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        dayNamesShort   : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames      : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        closeText       : 'Listo',
        currentText     : 'Hoy',
        dateFormat      : 'dd-mm-yy',
        changeMonth: true,
        changeYear: true   
    });

    $( "#prospect_fecha_nacimiento" ).datepicker({
        showButtonPanel : true,
        dayNames        : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesMin     : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        dayNamesShort   : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames      : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        closeText       : 'Listo',
        currentText     : 'Hoy',
        dateFormat      : 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"        
    });


    var hours   = [ '01', '02', '03', '04','05','06','07','08','09','10','11','12'];
    var minutes = [ '00','05','10','15', '20','25','30','35','40','45','50','55'];

    $.each( hours, function( index, elem){
        $('#hours_field').append( $('<option></option>').val(elem).html( elem ) );
    });

    $.each( minutes, function( index, elem){
        $('#minutes_field').append( $('<option></option>').val(elem).html( elem ) );
    });

    $('#ProspectStoreProspectForm').submit(function(event){

        var params = {
             'data[Prospect][id]'            : $('#prospect_id').val(),
             'data[Prospect][name]'          : $('#prospect_name').val(),
             'data[Prospect][apellido_paterno]': $('#prospect_ap_paterno').val(),
             'data[Prospect][apellido_materno]': $('#prospect_ap_materno').val(),
             'data[Prospect][email]'         : $('#prospect_email').val(),
             'data[Prospect][area_code]'     : $('#prospect_area_code').val(),
             'data[Prospect][lada]'     : $('#prospect_lada').val(),
             'data[Prospect][asesor]'     : $('#prospect_asesor').val(),
             'data[Prospect][no_prospecto]'     : $('#prospect_no_prospecto').val(),
             'data[Prospect][servicio]'      : $('#prospect_servicio').val(),
             'data[Prospect][plantel]'       : $('#prospect_plantel').val(),
             'data[Prospect][phone_number]'  : $('#prospect_phone_number').val(),
             'data[Prospect][mobile_number]' : $('#prospect_mobile_number').val(),
             'data[Prospect][origin_id]'     : $('#prospect_origin_id').val(),
             'data[Prospect][state_id]'      : $('#states_select').val(),
             'data[Prospect][city_id]'       : $('#cities_select').val(),
             'data[Prospect][media_id]'      : $('#media_select').val(),
             'data[Prospect][comments]'      : $('#prospect_comments').val(),
             'data[Prospect][gender_id]'     : $('#prospect_gender_id').val(),
             'data[Prospect][medio_contacto]': $('#prospect_medio_contacto').val(),
             'data[Prospect][medio_publicidad]': $('#prospect_medio_publicidad').val(),
             'data[Prospect][fecha_nacimiento]': $('#prospect_fecha_nacimiento').val(),
             'data[Prospect][fecha_cita]': $('#prospects_fecha_cita').val(),
             'data[Prospect][clave_as_400]': $('#prospect_as400').val(),
             'data[Prospect][origin_id]'     : $('#ProspectOriginId').val()
        };
        console.log(params);

        $.post(
            Crm.basePath+'store-prospect-ajax',
            params,
            function(data){
                $('#store_prospect_message').html(data);
            },
            ''
        );


        return false;
    })
});