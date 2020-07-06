$( document ).ready(function() 
{
    $('#new-password-form').submit(function(e)
	{	
		e.preventDefault(); // Empêche l'événement 
		let data_send_newPassword = 
		{ 
            'password' : $('#password').val(), 
            'newPassword' : $('#new-password').val(), 
            'newPasswordConfirmation' : $('#new-passwordConfirmation').val(), 
            'idMember' : $('#idMember').val(), 
		};
		let data_newPassword = data_send_newPassword;
		$.ajax({
			url: "../../handler/settings/password.php",
			method: "POST", 
			data: {data_newPassword},
			dataType: 'json',
			success: function(data_newPassword) 
			{
				alert(data_newPassword['msg']);
				if(data_newPassword['msg'] == "Votre mot de passe à était correctement modifier")
				{
					$.ajax({
						method: 'POST',
						url: "password.php",
						data: data_send_newPassword, //pass data1 to second request
						dataType: 'json',
						//success: window.location.href = "home.php",
					});
				}
           },
		   error: function (jqXHR, exception) 
		   {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				alert(msg);
			}
		  });
		  return false;
	});
});
