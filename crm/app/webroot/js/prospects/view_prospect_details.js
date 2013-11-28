$(document).ready(function(){

    $('#edit_prospect_button').click(function(){
        window.location.href = Crm.basePath+'editar-prospecto/'+ $('#prospect_id').val();
    });

    $('#schedule_event_button').click(function(){
        window.location.href = Crm.basePath+'agendar-evento/' + $('#prospect_id').val();
    });

    $('#back_button').click(function(){
        window.location.href = Crm.basePath;
    });
});