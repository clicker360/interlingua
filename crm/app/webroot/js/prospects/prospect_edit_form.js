$(document).ready(function(){

    // Acción para guardar en AS400
    var guardar_as400 = false;
    $(".statusName").each(function(){
        var status = $(this).text();
        if (status == "Interesado en visitar" || status == "Cita programada" || status == "Inscrito"){
            //alert("Guarda en AS400");
            guardar_as400 = true;
        }
    });
    if (guardar_as400){
        $("#btn-as400").html('<input style="border:0px;color:white;background:#EB7126;padding:5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;font-weight:bold;cursor:pointer;" id="btnSaveAS400" type="button" value="Guardar en AS400" />');
        $("#btnSaveAS400").live("click", function(e){
            e.preventDefault();
            alert("verificar bandera para guardar");
        });
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
        dateFormat      : 'dd-mm-yy'
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
        dateFormat      : 'dd-mm-yy'
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