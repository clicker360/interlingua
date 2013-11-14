$(document).ready(function(){

    bind_combo_to_combo( {
        from:  'lugar_id',
        to:    'user',
        url:   Crm.basePath+'obtain-users-from-place',
        empty: 'Selecciona un usuario'
    });
    $(".rango_especial").change(function(){
        $("input#ReporteTipo4").attr('checked','checked');
    });
    $(".dia_especifico").change(function(){
        $("input#ReporteTipo5").attr('checked','checked');
    });

});