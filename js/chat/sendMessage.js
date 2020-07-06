$( document ).ready(function() 
{
	let idSender = $('#idUser').val();
    $('#new-sendMessage-form').submit(function(e)
	{	
		let receiver = $('#pseudoReceiver').val();
		e.preventDefault(); // Empêche l'événement 
		let content = $('#sendMessage').val();
		if (content.length > 140)
		{
			alert("Message trop long (140 caractères max)");
		}
		else if (receiver == "undefined user")
		{
			alert("Vous ne pouvez pas envoyer un message à un utilisateur qui n'existe pas.");
		}
		else
		{
			let data_send_newMessage = 
			{ 
				'message' : $('#sendMessage').val(), 
				'idMember' : idSender, 
				'receiver' : $('#pseudoReceiver').val(), 
			};
			let data_newMessage = data_send_newMessage;
			$.ajax({
				url: "../../handler/chat/sendMessage.php",
				method: "POST", 
				data: {data_newMessage},
				//dataType: 'json',
				success: function(data_newMessage) 
				{
					alert("message bien envoyé");
					// alert(data_newMessage['msg']);
					// if(data_newMessage['msg'] == "Votre mot de passe à était correctement modifier")
					// {
					// 	$.ajax({
					// 		method: 'POST',
					// 		url: "sendMessage.php",
					// 		data: data_send_newMessage, //pass data1 to second request
					// 		dataType: 'json',
					// 		//success: window.location.href = "home.php",
					// 	});
					// }
				}, error: function(jqXHR, exception) {
				handleAjaxError(jqXHR, exception);
				}
				});
		}
		  return false;
	});
});
