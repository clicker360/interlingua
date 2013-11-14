$(document).on("ready",function(){
	$("#btnEnviar").on("click",function(e){
		e.preventDefault();
		var id = $("#idU").val();
		var email = $("#emailU").val();
		var name = $("#nameU").val();
		$.ajax({
			type: 'POST',
			url: 'include/functions.php',
			data: {action:"send_email", idU:id, emailU:email, nameU:name},
			dataType:'json',
			error: function(){
				alert("Error, intentalo mas tarde.");
			},
			success: function(result){
				if (result.error){
					alert("Ocurrio un error, intentalo de nuevo");
				}else{
					window.location = "gracias.html";
				}
			}
		});
	});
});