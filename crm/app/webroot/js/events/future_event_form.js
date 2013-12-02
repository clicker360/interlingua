$(document).ready(function(){

    $('#future_event_form').submit( function(event){


        var params = {
            'data[Event][subject]'      : $('#future_event_subject').val(),
            'data[Event][date]'         : $('#event_date_field').val(),
            'data[Event][hours]'        : $('#hours_field').val(),
            'data[Event][minutes]'      : $('#minutes_field').val(),
            'data[Event][meridian]'     : $('#meridian_field').val(),
            'data[Event][comments]'     : $('#future_comments').val(),
            'data[Event][prospect_id]'  : $('#future_event_prospect_id').val(),
            'data[Event][user_id]'      : $('#future_event_user_id').val()
        };

        $.post(
            Crm.basePath+'store-event-ajax',
            params,
            function(data){
                $('#future_event_message').html(data);
            },
            ''
        );

        return false;
    });

    // Configuration of datepickers
    $( "#event_date_field" ).datepicker({
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

});


