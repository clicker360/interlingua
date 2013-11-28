$(document).ready(function(){

    $('#checkbox_cambiar').click(function(){
        $('#UserPassword').attr('disabled', ! $('#UserPassword').attr('disabled'));
    });

    $('#UserStoreUserForm').validate();
    
    $('#UserStoreUserForm').submit( function(){

        if(  true === $('#UserPassword').attr('disabled') ){
            $('#UserPassword').remove();
        }
    });
});

