$(document).ready(function(){

    bind_combo_to_combo( {
       from:  'status_categories_select_seguimiento',
       to:    'status_select_seguimiento',
       url:   Crm.basePath+'obtain-status-from-category',
       empty: 'Selecciona un status'
    });

    $('#EventViewForm').submit( function(event){


        var params = {
             'data[Event][id]'          : $('#follow_event_id').val(),
             'data[Event][prospect_id]' : $('#follow_event_prospect_id').val(),
             'data[Event][user_id]'     : $('#follow_event_user_id').val(),
             'data[Event][status_id]'   : $('#status_select_seguimiento').val(),
             'data[Event][comments]'    : $('#follow_event_comments').val(),

             'data[EventF][event]'      : $('#future_event_subject').val(),
             'data[EventF][date]'       : $('#event_date_field').val(),
             'data[EventF][hour]'       : $('#hours_field').val(),
             'data[EventF][minute]'     : $('#minutes_field').val(),
             'data[EventF][meridian]'   : $('#meridian_field').val(),
             'data[EventF][comments]'   : $('#future_comments').val()
        };

        $.post(
            Crm.basePath+'store-event-ajax',
            params,
            function(data){
                $('#follow_event_message').html(data);
            },
            ''
        );

        return false;
    });

});