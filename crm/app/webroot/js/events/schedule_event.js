$(document).ready(function(){
    
    $('#schedule_event_form').validate();

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

function toggleTime(ckbLocal) {
    if(ckbLocal.checked) {
        var dtNow = new Date();
        var curr_hour = dtNow.getHours();
        var curr_min =dtNow.getMinutes();
        if (curr_hour < 12) {
            a_p = "am";
        } else {
            a_p = "pm";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        if (curr_hour < 10) {
            curr_hour = '0' + curr_hour;
        }
        curr_min = roundToHalf(curr_min);
        if (curr_min < 10) {
            curr_min = '0' + curr_min;
        }
        $('#event_date_field').val(dtNow.getDate() + '-' + (dtNow.getMonth()+1) + '-' + dtNow.getFullYear());
        $('#hours_field').val(curr_hour);
        $('#minutes_field').val(curr_min);
        $('#meridian_field').val(a_p);
    } else {
        $('#event_date_field').val('');
        $('#hours_field').val('01');
        $('#minutes_field').val('00');
        $('#meridian_field').val('am');
    }
}

function roundToHalf(value) {
    value = value/10;
    var converted = parseFloat(value); // Make sure we have a number
    var decimal = (converted - parseInt(converted, 10));
    decimal = Math.round(decimal * 10);
    if (decimal == 5) {
        return (parseInt(converted, 10)+0.5);
    }
    if ( (decimal < 3) || (decimal > 7) ) {
        return (Math.round(converted))*10;
    } else {
        return ((parseInt(converted, 10)+0.5))*10;
    }
}