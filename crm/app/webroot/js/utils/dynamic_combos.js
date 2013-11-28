function fill_select( combo_id, data, empty_text ){

    var select = $('#'+combo_id);
    select.empty();

    if( empty_text !== undefined ){
        select.append(
            $('<option></option>').html( empty_text ).val('')
        );
    }

    $.each( data,
        function( index, itemData){
            select.append(
                $('<option></option>').val(itemData.id).html( itemData.name )
            );
        }
    );


}

function bind_combo_to_combo( settings ){

    $('#'+settings.from).change(function(){

        var _id_ = $('#'+settings.from).val();
        
        $.post(
            settings.url,
            {id: _id_},
            function(data){
                fill_select( settings.to, data, settings.empty );
            },
            'json'
        );

    });
}

