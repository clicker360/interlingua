$(document).ready(function(){

   $('#refresh_unassigned').click(function(event){
        var append='/';
        if(Crm.user['level']<3){
            append+=Crm.user['place_id'];
        }
       $.ajax({
            type: 'POST',
            url : Crm.basePath+'obtain-unassigned-prospects'+append,
            data : [],
            success: function(data){
                $('#prospectos_no_asignados').html(data);
            },
            dataType : 'text/html'
       });
   });
});