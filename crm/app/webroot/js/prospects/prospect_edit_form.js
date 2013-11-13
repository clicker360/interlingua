
$(document).ready(function(){

//    $('#ProspectStoreProspectForm').validate();

    $('#ProspectStoreProspectForm').submit(function(event){

        var params = {
             'data[Prospect][id]'            : $('#prospect_id').val(),
             'data[Prospect][name]'          : $('#prospect_name').val(),
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