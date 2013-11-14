$(document).ready(function(){

    $('#edit_prospect_form').validate();

    bind_combo_to_combo( {
       from:  'places_select',
       to:    'users_select',
       url:   Crm.basePath+'obtain-users-from-place',
       empty: 'Selecciona un usuario'
    });

    bind_combo_to_combo( {
       from:  'medium_categories_select',
       to:    'media_select',
       url:   Crm.basePath+'obtain-media-from-category',
       empty: 'Selecciona un medio'
    });

    bind_combo_to_combo( {
       from:  'states_select',
       to:    'cities_select',
       url:   Crm.basePath+'obtain-states-cities',
       empty: 'Selecciona un municipio'
    });
    $( "#ProspectFechaNacimiento" ).datepicker({        
        changeMonth: true,
        changeYear: true,
        yearRange: "-90:+0",
        showButtonPanel: true,
        dayNames        : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesMin     : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        dayNamesShort   : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames      : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        closeText       : 'Listo',
        currentText     : 'Hoy',
        dateFormat      : 'dd-mm-yy'
    });
    $( "#ProspectFechaCita" ).datepicker({        
        changeMonth: true,
        changeYear: true,
        yearRange: "-90:+0",
        showButtonPanel: true,
        dayNames        : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesMin     : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        dayNamesShort   : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames      : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        closeText       : 'Listo',
        currentText     : 'Hoy',
        dateFormat      : 'dd-mm-yy'
    });
});