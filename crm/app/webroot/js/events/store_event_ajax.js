
function redirectEvent() {
    var t = setTimeout("redirectURL();",3000);
}

function redirectURL() {
    prospect_id = $('#prospect_id_select').val();
    if(prospect_id != '') {
        window.location = '../agendar-evento/' + prospect_id + '';
    }
}