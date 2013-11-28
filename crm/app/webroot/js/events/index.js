$(document).ready(function(){
    $('#spinner').css('display','none');
    bind_combo_to_combo( {
        from:  'place_id',
        to:    'users',
        url:   Crm.basePath+'obtain-users-from-place',
        empty: 'Selecciona un usuario'
    });
    
    $('#events_lookup').submit(function(){
      $('#spinner').css('display','block');
      $('#calendar').html('');
        var path=Crm.basePath+'events/get_events/'+$('#EventMonth').val()+'/'+$('#EventYear').val()+'/'+$('#place_id').val()+'/'+$('#users').val();
        $.post(
            path,
            function(data){
                $('#calendar').html(data);
                $('#spinner').css('display','none');
            },
            ''
        );

        return false;
    });
    
    //$('#events_lookup').submit();
});