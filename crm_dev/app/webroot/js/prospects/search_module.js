
$(document).ready(function(){

    // Configuration of datepickers
    $( "#from_date" ).datepicker({
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

    $( "#to_date" ).datepicker({
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

    // Setup of dyunamic selects
    bind_combo_to_combo( {
       from:  'states_select',
       to:    'cities_select',
       url:   Crm.basePath+'obtain-states-cities',
       empty: 'Selecciona un municipio'
    });

    bind_combo_to_combo( {
       from:  'places_select',
       to:    'users_select',
       url:   Crm.basePath+'obtain-users-from-place'
    });

    // Action binding for buttons

    $('#add_prospect_button').click(function(){
       window.location.href = Crm.basePath+'agregar-prospecto';
    });

    $('#medium_category_select').change(function(){

        $('#medium_select').empty();
        $('#medium_category_select option:selected').each(function(){
            $.post(
                Crm.basePath+'obtain-media-from-category',
                {id: $(this).val()},
                function(data){
                    $.each( data,
                        function( index, itemData){
                            $('#medium_select').append(
                                $('<option></option>').val(itemData.id).html( itemData.name )
                            );
                        }
                    );
                },
                'json'
            );
        });
    });

    $('#status_category_select').change(function(){

        $('#status_select').empty();
        $('#status_category_select option:selected').each(function(){
            $.post(
                Crm.basePath+'obtain-status-from-category',
                {id: $(this).val()},
                function(data){
                    $.each( data,
                        function( index, itemData){
                            $('#status_select').append(
                                $('<option></option>').val(itemData.id).html( itemData.name )
                            );
                        }
                    );
                },
                'json'
            );
        });
    });

    $('#ProspectIndexForm').submit(function(){
        $('.cargando').show();
        $('#prospectos_asignados').hide();
        var search_params = {
            'data[Prospect][id]'                    : $('#search_prospect_id').val(),
            'data[Prospect][name]'                  : $('#search_prospect_name').val(),
            'data[Prospect][empresa]'               : $('#search_prospect_empresa').val(),
            'data[Prospect][email]'                 : $('#search_prospect_email').val(),
            'data[Prospect][phone_number]'          : $('#search_prospect_phone_number').val(),
            //'data[Prospect][lada]'                  : $('#search_prospect_lada').val(),
            'data[Prospect][plantel]'                  : $('#search_prospect_plantel').val(),
            'data[Prospect][estado]'             : $('#search_prospect_estado').val(),
            'data[Prospect][gender_id]'             : $('#search_prospect_gender_id').val(),
            'data[Prospect][state_id]'              : $('#states_select').val(),
            'data[Prospect][city_id]'               : $('#cities_select').val(),
            'data[Prospect][medium_category_id][]'  : $('#medium_category_select').val(),
            'data[Prospect][medium_id][]'           : $('#medium_select').val(),
            'data[Prospect][status_category_id][]'  : $('#status_category_select').val(),
            'data[Prospect][status_id][]'           : $('#status_select').val(),
            'data[Prospect][place_id]'              : $('#places_select').val(),
            'data[Prospect][user_id][]'             : $('#users_select').val(),
            'data[Prospect][tipo_fecha]'            : $('#prospect_tipo_fecha').val(),
            'data[Prospect][to_date]'               : $('#to_date').val(),
            'data[Prospect][from_date]'             : $('#from_date').val(),
            'data[Prospect][origin_id]'             : $('#search_prospect_origin_id').val()
        };


        $.post(
            Crm.basePath+'search-prospects-ajax',
            search_params,
            function(data){
                $(".cargando").hide();
                $('#prospectos_asignados').html(data);
                $('#prospectos_asignados').show();
            },
            ''
        );

        return false;
    });
});


